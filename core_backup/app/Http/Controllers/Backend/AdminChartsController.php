<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Subscription\Entities\UserSubscription;
use Modules\Wallet\Entities\WithdrawRequest;

class AdminChartsController extends Controller
{
    public function index(Request $request)
    {
        // 0. Parse Filter Dates
        if ($request->filter_type == 'this_week') {
            $startDate = Carbon::now()->startOfWeek();
            $endDate = Carbon::now()->endOfWeek();
            $filterLabel = __('This Week');
        } elseif ($request->filter_type == 'this_year') {
            $startDate = Carbon::now()->startOfYear();
            $endDate = Carbon::now()->endOfYear();
            $filterLabel = __('This Year');
        } elseif ($request->filter_type == 'custom' && $request->start_date && $request->end_date) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $filterLabel = $startDate->format('d M, Y') . ' - ' . $endDate->format('d M, Y');
        } else {

            $startDate = Carbon::now()->subDays(29)->startOfDay();
            $endDate = Carbon::now()->endOfDay();
            $filterLabel = __('Last 30 Days');
        }

        // Export Check
        if ($request->has('export_csv')) {
             return $this->exportCsv($startDate, $endDate);
        }

        // 1. Orders by Status (Pie Chart) - Filtered
        $orderStatusCounts = Order::select('status', DB::raw('count(*) as total'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('status')
            ->get()
            ->pluck('total', 'status')
            ->toArray();

        // Map status codes to names
        $statusLabels = [
            0 => 'Pending', 1 => 'Active', 2 => 'Delivered', 3 => 'Completed',
            4 => 'Cancelled', 5 => 'Declined', 6 => 'Suspended', 7 => 'On Hold'
        ];

        $chartOrderLabels = [];
        $chartOrderData = [];
        foreach ($orderStatusCounts as $status => $count) {
            $chartOrderLabels[] = $statusLabels[$status] ?? 'Unknown';
            $chartOrderData[] = $count;
        }

        // 2. Revenue (Mixed Orders + Subscriptions) - Smart Grouping
        // If range > 90 days, show Monthly. Else show Daily.
        $diffInDays = $startDate->diffInDays($endDate);
        $groupBy = $diffInDays > 90 ? 'month' : 'day';
        
        $months = []; // X-Axis Labels (can be days or months)
        $revenueData = [];

        if ($groupBy === 'month') {
            // Iterate months
            $period = \Carbon\CarbonPeriod::create($startDate->startOfMonth(), '1 month', $endDate->endOfMonth());
            foreach ($period as $dt) {
                $months[] = $dt->format('M Y');
                
                $orderRev = Order::where('status', 3)
                    ->whereYear('created_at', $dt->year)
                    ->whereMonth('created_at', $dt->month)
                    ->sum('commission_amount');

                $subRev = UserSubscription::where('payment_status', 'complete')
                    ->whereYear('created_at', $dt->year)
                    ->whereMonth('created_at', $dt->month)
                    ->sum('price');
                
                $revenueData[] = $orderRev + $subRev;
            }
        } else {
            // Iterate days
            $period = \Carbon\CarbonPeriod::create($startDate, '1 day', $endDate);
            foreach ($period as $dt) {
                $months[] = $dt->format('d M');
                
                $orderRev = Order::where('status', 3)
                    ->whereDate('created_at', $dt)
                    ->sum('commission_amount');
                
                $subRev = UserSubscription::where('payment_status', 'complete')
                    ->whereDate('created_at', $dt)
                    ->sum('price');
                
                $revenueData[] = $orderRev + $subRev;
            }
        }
        $revenueChartLabel = ($groupBy === 'month') ? __('Monthly Revenue') : __('Daily Revenue');


        // 3. Payment Gateway Usage (Orders) (Doughnut) - Filtered
        $gatewayCounts = Order::select('payment_gateway', DB::raw('count(*) as total'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('payment_gateway')
            ->get();
        
        $gatewayLabels = $gatewayCounts->pluck('payment_gateway')->map(function($g){ return ucfirst(str_replace('_', ' ', $g)); })->toArray();
        $gatewayData = $gatewayCounts->pluck('total')->toArray();

        $userGrowthLabels = [];
        $userGrowthData = [];

        if ($groupBy === 'month') {
             $period = \Carbon\CarbonPeriod::create($startDate->startOfMonth(), '1 month', $endDate->endOfMonth());
             foreach ($period as $dt) {
                $userGrowthLabels[] = $dt->format('M Y');
                $userGrowthData[] = User::whereYear('created_at', $dt->year)
                    ->whereMonth('created_at', $dt->month)->count();
            }
        } else {
             $period = \Carbon\CarbonPeriod::create($startDate, '1 day', $endDate);
             foreach ($period as $dt) {
                $userGrowthLabels[] = $dt->format('d M');
                $userGrowthData[] = User::whereDate('created_at', $dt)->count();
            }
        }

        // 5. Subscription vs One-Time Orders (Pie) - Filtered
        $totalSubscriptions = UserSubscription::where('payment_status', 'complete')
             ->whereBetween('created_at', [$startDate, $endDate])->count();
        $totalOrders = Order::where('status', 3)
             ->whereBetween('created_at', [$startDate, $endDate])->count();

        // --- NEW BUSINESS METRICS ---
        
        // A. Platform GMV (Total Completed Order Value)
        $total_gmv = Order::where('status', 3)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('price');

        // B. Total Commission Earned (Platform Revenue)
        $order_commissions = Order::where('status', 3)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('commission_amount');
        $sub_revenue = UserSubscription::where('payment_status', 'complete')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('price');
        $total_commission = $order_commissions + $sub_revenue;

        // C. Influencer Success Rate
        $orders_query = Order::whereBetween('created_at', [$startDate, $endDate]);
        $all_orders_count = (clone $orders_query)->count();
        $completed_orders_count = (clone $orders_query)->where('status', 3)->count();
        $success_rate = $all_orders_count > 0 ? round(($completed_orders_count / $all_orders_count) * 100, 2) : 0;

        // D. Client Lifetime Value (CLV) - Average spent per unique client
        $unique_clients_count = Order::where('status', 3)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->distinct('user_id')
            ->count('user_id');
        $avg_clv = $unique_clients_count > 0 ? round($total_gmv / $unique_clients_count, 2) : 0;

        // E. Fraud Indicators
        // 1. Fast Completions (Completed in < 1 hour)
        $fast_completions = Order::where('status', 3)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->whereRaw('TIMESTAMPDIFF(HOUR, created_at, updated_at) < 1')
            ->count();
        
        // 2. Cancellation Rate
        $cancelled_orders_count = Order::where('status', 4) // Cancelled
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();
        $cancellation_rate = $all_orders_count > 0 ? round(($cancelled_orders_count / $all_orders_count) * 100, 2) : 0;

        // F. Withdrawal Stats
        $total_withdrawals = WithdrawRequest::where('status', 1) // Completed
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('amount');
        $withdrawal_count = WithdrawRequest::where('status', 1)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        return view('backend.pages.charts.index', compact(
            'chartOrderLabels', 'chartOrderData',
            'months', 'revenueData', 'revenueChartLabel',
            'gatewayLabels', 'gatewayData',
            'userGrowthLabels', 'userGrowthData',
            'totalSubscriptions', 'totalOrders',
            'startDate', 'endDate', 'filterLabel',
            'total_gmv', 'total_commission', 'success_rate', 'avg_clv',
            'fast_completions', 'cancellation_rate', 'total_withdrawals', 'withdrawal_count'
        ));
    }

    private function exportCsv($startDate, $endDate)
    {
        $filename = "analytics_report_" . $startDate->format('Ymd') . "_" . $endDate->format('Ymd') . ".csv";
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Date', 'New Users', 'Orders Completed', 'Revenue'];

        $callback = function() use ($startDate, $endDate, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            $period = \Carbon\CarbonPeriod::create($startDate, '1 day', $endDate);

            foreach ($period as $dt) {
                $newUsers = User::whereDate('created_at', $dt)->count();
                $orders = Order::where('status', 3)->whereDate('created_at', $dt)->count();
                
                $orderRev = Order::where('status', 3)->whereDate('created_at', $dt)->sum('commission_amount');
                $subRev = UserSubscription::where('payment_status', 'complete')->whereDate('created_at', $dt)->sum('price');
                $revenue = $orderRev + $subRev;

                fputcsv($file, [$dt->format('Y-m-d'), $newUsers, $orders, $revenue]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
