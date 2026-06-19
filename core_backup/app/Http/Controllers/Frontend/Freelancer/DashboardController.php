<?php

namespace App\Http\Controllers\Frontend\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Rating;
use App\Models\JobProposal;
use Illuminate\Support\Facades\DB;
use Modules\Wallet\Entities\Wallet;
use Modules\Wallet\Entities\WalletHistory;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::guard('web')->user();
        $user_id = $user->id;

        // Common Data
        $wallet_balance = Wallet::where('user_id', $user_id)->first();
        $total_wallet_balance = $wallet_balance->balance ?? 0;
        $total_project = Project::where('user_id', $user_id)->count();
        $complete_order = Order::where('status', 3)->whereHas('user')->where('freelancer_id', $user_id)->count();
        $active_order = Order::where('status', 1)->whereHas('user')->where('freelancer_id', $user_id)->count();

        $latest_orders_query = Order::where('freelancer_id', $user_id)->whereHas('user')->where('payment_status', 'complete');
        if (get_static_option('project_enable_disable') == 'disable') {
            $latest_orders_query->where('is_project_job', '!=', 'project');
        }

        if ($user->user_type == 1 && Session::get('user_role') == 'freelancer') {
            $latest_orders_query->where('order_type', 'freelancer_order');
        }
        
        $latest_orders = $latest_orders_query->latest()->take(5)->get();
        $my_projects = Project::select('id', 'title', 'slug')->where('user_id', $user_id)->latest()->take(5)->get();

        // 1. Analytics: Earnings & Work Volume over time (12 months)
        $months = [];
        $earningsData = [];
        $ordersCompletedData = [];
        for ($i = 11; $i >= 0; $i--) {
            $monthDate = now()->subMonths($i);
            $months[] = $monthDate->format('M Y');

            $monthOrders = Order::where('freelancer_id', $user_id)
                ->where('status', 3)
                ->whereYear('created_at', $monthDate->year)
                ->whereMonth('created_at', $monthDate->month);

            $ordersCompletedData[] = $monthOrders->count();
            // Earnings = Price - Commission
            $earningsData[] = round($monthOrders->sum(DB::raw('price - commission_amount')), 2);
        }

        // 2. Performance Metrics
        $totalIncome = Order::where('freelancer_id', $user_id)->where('status', 3)->sum(DB::raw('price - commission_amount'));
        $avgOrderValue = $complete_order > 0 ? round($totalIncome / $complete_order, 2) : 0;

        $highestPayingOrder = Order::where('freelancer_id', $user_id)
            ->where('status', 3)
            ->with('user')
            ->orderByDesc('price')
            ->first();
        $highestPayingClient = $highestPayingOrder?->user?->fullname ?? 'N/A';

        // 3. Job vs Project Income
        $jobIncome = Order::where('freelancer_id', $user_id)->where('status', 3)->where('is_project_job', 'job')->sum(DB::raw('price - commission_amount'));
        $projectIncome = Order::where('freelancer_id', $user_id)->where('status', 3)->where('is_project_job', 'project')->sum(DB::raw('price - commission_amount'));

        // 4. Acceptance Rate
        $totalProposals = JobProposal::where('freelancer_id', $user_id)->count();
        $acceptedProposals = JobProposal::where('freelancer_id', $user_id)->where('is_hired', 1)->count();
        $acceptanceRate = $totalProposals > 0 ? round(($acceptedProposals / $totalProposals) * 100, 2) : 0;

        // 5. Avg Delivery Time (Days)
        $avgDeliveryDays = DB::table('order_work_histories')
            ->where('freelancer_id', $user_id)
            ->whereNotNull('start_date')
            ->whereNotNull('end_date')
            ->avg(DB::raw('DATEDIFF(end_date, start_date)')) ?? 0;
        $avgDeliveryDays = round($avgDeliveryDays, 1);

        // 6. Repeat Client Rate
        $clientOrderCounts = Order::where('freelancer_id', $user_id)
            ->select('user_id', DB::raw('count(*) as count'))
            ->groupBy('user_id')
            ->get();
        $totalClients = $clientOrderCounts->count();
        $repeatClients = $clientOrderCounts->where('count', '>', 1)->count();
        $repeatClientRate = $totalClients > 0 ? round(($repeatClients / $totalClients) * 100, 2) : 0;

        // 7. Performance Score (0-100)
        $allOrders = Order::where('freelancer_id', $user_id)->count();
        $completionRate = $allOrders > 0 ? ($complete_order / $allOrders) * 100 : 0;
        $avgRating = Rating::where('sender_type', 1)->whereHas('order', function ($q) use ($user_id) {
            $q->where('freelancer_id', $user_id);
        })->avg('rating') ?? 0;

        // Score formula: (0.4 * completionRate) + (0.3 * (avgRating * 20)) + (0.3 * repeatClientRate)
        $performanceScore = round((0.4 * $completionRate) + (0.3 * ($avgRating * 20)) + (0.3 * $repeatClientRate), 1);

        return view('frontend.user.influencer.dashboard.dashboard', compact([
            'total_wallet_balance', 'total_project', 'complete_order', 'active_order', 'latest_orders', 'my_projects',
            'months', 'earningsData', 'ordersCompletedData', 'avgOrderValue', 'highestPayingClient',
            'jobIncome', 'projectIncome', 'acceptanceRate', 'avgDeliveryDays', 'repeatClientRate', 'performanceScore'
        ]));
    }

    public function switch_profile(Request $request)
    {
        $request->validate([
            'role' => 'required|in:client,freelancer',
        ]);
        Session::put('user_role', $request->role);
        return response()->json([
            'status' => 'success',
            'user_role' => Session::get('user_role')
        ]);
    }
}
