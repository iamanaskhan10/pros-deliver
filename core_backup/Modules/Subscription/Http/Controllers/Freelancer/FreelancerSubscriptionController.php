<?php

namespace Modules\Subscription\Http\Controllers\Freelancer;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\Subscription\Entities\UserSubscription;
use Stripe\StripeClient;

class FreelancerSubscriptionController extends Controller
{
    public function all_subscription()
    {
        $user_id = auth()->user()->id;
        $all_subscriptions = UserSubscription::with('subscription:id,subscription_type_id')->latest()->where('user_id',$user_id)->paginate(10);
        $total_limit = UserSubscription::where('user_id',$user_id)->where('payment_status','complete')->whereDate('expire_date', '>', Carbon::now())->sum('limit');
        return view('subscription::frontend.influencer.subscription.subscription',compact('all_subscriptions','total_limit'));
    }

    // pagination
    function pagination(Request $request)
    {
        if($request->ajax()){
            $user_id = Auth::guard('web')->user()->id;
            $all_subscriptions = $request->search_tring == ''
                ? UserSubscription::where('user_id',$user_id)->latest()->paginate(10)
                : UserSubscription::where('user_id',$user_id)->where('created_at', 'LIKE', "%". strip_tags($request->string_search) ."%")->paginate(10);
            return view('subscription::frontend.influencer.subscription.search-result', compact('all_subscriptions'))->render();
        }
    }

    // search category
    public function search_history(Request $request)
    {
        $all_subscriptions = UserSubscription::where('user_id',Auth::guard('web')->user()->id)->where('created_at', 'LIKE', "%". strip_tags($request->string_search) ."%")->paginate(10);
        return $all_subscriptions->total() >= 1 ? view('subscription::frontend.influencer.subscription.search-result', compact('all_subscriptions'))->render() : response()->json(['status'=>__('nothing')]);
    }

    public function redirectToBillingPortal(Request $request)
    {
        try {
            // Get the authenticated user (adjust based on your auth system)
            $user = $request->user();
            if (!$user) {
                toastr_error('User not authenticated');
                return redirect()->route('login');
            }

            // Retrieve the user's active subscription
            $userSubscription = UserSubscription::where('user_id', $user->id)
                ->where('stripe_customer_id', '!=', null)
                ->where('payment_gateway', 'stripe')
                ->where('is_recurring_subscription', 1)
                ->first();

            if (!$userSubscription || !$userSubscription->stripe_customer_id) {
                toastr_error('No active Stripe subscription found');
                return redirect()->route('influencer.subscriptions.all');
            }

            // Initialize Stripe client
            $stripe = new StripeClient(env('STRIPE_SECRET'));

            // Create a Customer Portal session
            $session = $stripe->billingPortal->sessions->create([
                'customer' => $userSubscription->stripe_customer_id,
                'return_url' => route('influencer.subscriptions.all'),
            ]);

            // Redirect to the Customer Portal
            return redirect()->away($session->url);
        } catch (Exception $e) {
            \Log::error("Error creating billing portal session: {$e->getMessage()}");
            toastr_error('Unable to access billing portal');
            return redirect()->route('influencer.subscriptions.all');
        }
    }
}
