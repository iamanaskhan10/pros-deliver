<?php

namespace App\Http\Controllers\Frontend\Client;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use App\Models\Order;
use App\Models\Project;
use App\Models\JobProposal;
use App\Models\OrderWorkHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Modules\Wallet\Entities\Wallet;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::guard('web')->user();
        $user_id = $user->id;

        // Common Data
        $wallet_balance = Wallet::where('user_id', $user_id)->first();
        $total_wallet_balance = $wallet_balance->balance ?? 0;
        $total_jobs = JobPost::where('user_id', $user_id)->count();
        $complete_order = Order::where('status', 3)->where('user_id', $user_id)->count();
        $active_order = Order::where('status', 1)->where('user_id', $user_id)->count();

        // 1. Spending Analytics
        $total_spend = Order::where('user_id', $user_id)
            ->whereIn('payment_status', ['complete'])
            ->sum('price');

        // Monthly Spend (12 Months)
        $months = [];
        $monthly_spend_data = [];
        for ($i = 11; $i >= 0; $i--) {
            $monthDate = now()->subMonths($i);
            $months[] = $monthDate->format('M Y');
            $monthly_spend_data[] = round(Order::where('user_id', $user_id)
                ->whereIn('payment_status', ['complete'])
                ->whereYear('created_at', $monthDate->year)
                ->whereMonth('created_at', $monthDate->month)
                ->sum('price'), 2);
        }

        // Spend per Top 5 Campaigns
        $campaign_spend = Order::where('orders.user_id', $user_id)
            ->where('is_project_job', 'job')
            ->whereIn('payment_status', ['complete'])
            ->join('job_posts', 'orders.identity', '=', 'job_posts.id')
            ->select('job_posts.title', DB::raw('SUM(orders.price) as total_amount'))
            ->groupBy('job_posts.id', 'job_posts.title')
            ->orderByDesc('total_amount')
            ->take(5)
            ->get();
        $campaign_spend_labels = $campaign_spend->pluck('title');
        $campaign_spend_data = $campaign_spend->pluck('total_amount');

        // 2. Hiring Funnel Analytics
        $total_proposals = JobProposal::where('client_id', $user_id)->count();
        $avg_proposals_per_job = $total_jobs > 0 ? round($total_proposals / $total_jobs, 1) : 0;
        
        $jobs_with_hires = JobPost::where('user_id', $user_id)
            ->whereHas('job_proposals', function($q){
                $q->where('is_hired', 1);
            })->count();
        $hire_rate = $total_jobs > 0 ? round(($jobs_with_hires / $total_jobs) * 100, 1) : 0;

        $time_to_hire = DB::table('orders')
            ->join('job_posts', 'orders.identity', '=', 'job_posts.id')
            ->where('orders.user_id', $user_id)
            ->where('orders.is_project_job', 'job')
            ->select(DB::raw('AVG(DATEDIFF(orders.created_at, job_posts.created_at)) as avg_days'))
            ->first();
        $avg_time_to_hire = round($time_to_hire->avg_days ?? 0, 1);

        $proposal_range = JobProposal::where('client_id', $user_id)
            ->select(DB::raw('MIN(amount/1) as min_price, MAX(amount/1) as max_price'))
            ->first();

        // 3. Influencer Utilization Analytics
        $influencer_stats = Order::where('user_id', $user_id)
            ->select('freelancer_id', DB::raw('count(*) as order_count'))
            ->groupBy('freelancer_id')
            ->get();
        $unique_influencers_count = $influencer_stats->count();
        $repeat_hires = $influencer_stats->where('order_count', '>', 1)->count();
        $repeat_hire_rate = $unique_influencers_count > 0 ? round(($repeat_hires / $unique_influencers_count) * 100, 1) : 0;
        $avg_spend_per_influencer = $unique_influencers_count > 0 ? round($total_spend / $unique_influencers_count, 2) : 0;

        // 4. Campaign Management (Operational)
        $total_refunds = Order::where('user_id', $user_id)->sum('refund_amount');
        $delayed_orders = Order::where('user_id', $user_id)
            ->where('status', 1) // Active
            ->whereRaw('DATE_ADD(created_at, INTERVAL CAST(SUBSTRING_INDEX(delivery_time, " ", 1) AS UNSIGNED) DAY) < NOW()')
            ->count();

        // Latest Data for UI
        $latest_orders_query = Order::where('user_id', $user_id)->whereHas('freelancer');
        if (get_static_option('project_enable_disable') == 'disable') {
            $latest_orders_query->where('is_project_job', '!=', 'project');
        }
        $latest_orders = $latest_orders_query->latest()->take(5)->get();
        $my_jobs = JobPost::select('id', 'title', 'slug')->where('user_id', $user_id)->latest()->take(5)->get();

        return view('frontend.user.client.dashboard.dashboard', compact([
            'total_wallet_balance', 'total_jobs', 'complete_order', 'active_order', 'latest_orders', 'my_jobs',
            'total_spend', 'months', 'monthly_spend_data', 'campaign_spend_labels', 'campaign_spend_data',
            'avg_proposals_per_job', 'hire_rate', 'avg_time_to_hire', 'proposal_range',
            'unique_influencers_count', 'repeat_hire_rate', 'avg_spend_per_influencer',
            'total_refunds', 'delayed_orders'
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
