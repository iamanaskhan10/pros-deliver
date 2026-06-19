<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Order;
use App\Models\Rating;
use App\Models\JobPost;
use App\Models\Project;
use App\Models\UserLang;
use App\Models\Portfolio;
use App\Models\UserSkill;
use App\Models\UserEarning;
use App\Models\CategoryUser;
use Illuminate\Http\Request;
use App\Models\SocialProfile;
use App\Http\Controllers\Controller;
use App\Helper\InfluencerResponseTimeHelper;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class ProfileDetailsController extends Controller
{
    // freelancer profile details
    public function profile_details($username)
    {
        $user = User::with('user_introduction')
            ->select(['id', 'image', 'user_type', 'first_name', 'last_name', 'country_id', 'state_id', 'check_work_availability', 'user_verified_status', 'load_from', 'github_id', 'created_at', 'is_pro', 'pro_expire_date'])
            ->where('username', $username)
            ->first();

        if ($user) {
            $user_category = CategoryUser::where('user_id', $user->id)->get();
            $total_earning = UserEarning::where('user_id', $user->id)->first();
            $complete_orders_in_total = Order::whereHas('user')->where('freelancer_id', $user->id)->where('status', 3)->count();
            $complete_orders = Order::select('id', 'identity', 'status', 'freelancer_id')->whereHas('user')->whereHas('rating')->where('freelancer_id', $user->id)->where('status', 3)->latest()->paginate(5);
            $active_orders_count = Order::where('freelancer_id', $user->id)->whereHas('user')->where('status', 1)->count();
            $skills = UserSkill::select('skill')->where('user_id', $user->id)->first()->skill ?? '';
            $languages = UserLang::select('lang')->where('user_id', $user->id)->first()->lang ?? '';
            $social_profiles = SocialProfile::where('user_id', $user->id)->get() ?? '';

            $projects = new LengthAwarePaginator([], 0, 6);
            $jobs = new LengthAwarePaginator([], 0, 6);
            if ($user->user_type == 2) {
                $projects = Project::with('project_history')
                    ->whereHas('project_creator')
                    ->where('user_id', $user->id)
                    ->withCount('orders')
                    ->when(!auth('web')->check() || auth('web')->user()->username !== $username, function ($q) {
                        $q->where('project_on_off', 1)
                        ->where('status', 1)
                        ->where('project_approve_request', 1);
                    })
                    ->latest()
                    ->paginate(6);
            } else {
                $jobs = JobPost::with('job_creator', 'job_skills')
                    ->whereHas('job_creator')
                    ->where('on_off', '1')
                    ->where('user_id', $user->id)
                    ->withCount('job_proposals')
                    ->where('status', '1')
                    ->where('job_approve_request', '1')
                    ->latest()
                    ->paginate(6);
                $complete_orders_in_total = Order::whereHas('user')->where('user_id', $user->id)->where('status', 3)->count();
            }

            $freelancer_reviews = Rating::with(['sender'])
                ->whereHas('order', function ($query) use ($user) {
                    $query->where('freelancer_id', $user->id)->where('status', 3);
                })
                ->where('sender_type', 1)
                ->latest()
                ->paginate(5);

            $responseTimes = InfluencerResponseTimeHelper::getAverageResponseTime($user->id);

            //pro project view count
            if (moduleExists('PromoteInfluencer') && $user->is_pro_freelancer && auth('web')->id() !== $user->id) {
                $current_date = \Carbon\Carbon::now()->toDateTimeString();
                \Modules\PromoteInfluencer\Entities\PromotionProjectList::where('identity', $user->id)
                    ->where('type', 'profile')
                    ->where('expire_date', '>=', $current_date)
                    ->increment('click');
            }

            $portfolios = Portfolio::where('user_id', $user->id)
                ->when(!(Auth::guard('web')->check() && Auth::guard('web')->user()->id == $user->id), function($query) {
                    return $query->where('status', 1);
                })
                ->when((Auth::guard('web')->check() && Auth::guard('web')->user()->id == $user->id), function($query) {
                    return $query->whereIn('status', [0, 1]);
                })
                ->latest()
                ->get();

            return view('frontend.profile-details2.profile-details', compact([
                'username',
                'user_category',
                'skills',
                'languages',
                'social_profiles',
                'projects',
                'jobs',
                'user',
                'total_earning',
                'complete_orders',
                'complete_orders_in_total',
                'active_orders_count',
                'freelancer_reviews',
                'responseTimes',
                'portfolios',
            ]));
        } else {
            return back();
        }
    }

    // freelancer portfolio details
    public function portfolio_details(Request $request)
    {
        $portfolioDetails = Portfolio::where('id', $request->id)->first();
        $username = User::select('username')->where('id', $portfolioDetails->user_id)->first();
        $username = $username->username;

        return view('frontend.profile-details.portfolio-details', compact('portfolioDetails', 'username'))->render();
    }

    public function profile_reviews(Request $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $sortOption = $request->get('review_sort');
        $perPage = 5;

        $reviews = Rating::with(['sender'])
            ->whereHas('order', fn($q) => $q->where('freelancer_id', $user->id)->where('status', 3))
            ->where('sender_type', 1);

        if ($sortOption == 2) {
            $reviews->where('created_at', '>=', now()->subWeek())->latest();
        } elseif ($sortOption == 3) {
            $reviews->oldest();
        } else {
            $reviews->latest();
        }

        $freelancer_reviews = $reviews->paginate($perPage);

        return view('frontend.profile-details2.partials.review-list', compact('freelancer_reviews'))->render();
    }

    public function toggleEarning(Request $request)
    {
        $request->validate([
            'show_earning' => 'required|in:0,1',
        ]);

        $userId = auth()->id();

        if (!$userId) {
            return response()->json([
                'status'  => 'error',
                'message' => __('Authentication required'),
            ], 401);
        }

        try {
            // Try to get existing record
            $userEarning = \App\Models\UserEarning::firstOrCreate(
                ['user_id' => $userId],
                [
                    'show_earning'      => (int) $request->show_earning,
                    'total_earning'     => 0,
                    'total_withdraw'    => 0,
                    'remaining_balance' => 0,
                ]
            );

            // If record already exists, just update show_earning
            if (!$userEarning->wasRecentlyCreated) {
                $userEarning->update([
                    'show_earning' => (int) $request->show_earning,
                ]);
            }

            return response()->json([
                'status'  => 'success',
                'message' => __('Earning visibility updated successfully'),
            ]);
        } catch (\Exception $e) {
            
            return response()->json([
                'status'  => 'error',
                'message' => __('Something went wrong while updating earning visibility.'),
            ], 500);
        }
    }
}
