<?php

namespace Modules\Subscription\Http\Controllers\Frontend;

use App\Helper\PaymentGatewayRequestHelper;
use App\Mail\BasicMail;
use App\Models\AdminNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Modules\Subscription\Entities\Subscription;
use Modules\Subscription\Entities\UserSubscription;
use Modules\Wallet\Entities\Wallet;
use Stripe\Customer;
use Stripe\Stripe;
use Stripe\StripeClient;

class BuySubscriptionController extends Controller
{
    private const CANCEL_ROUTE = 'subscriptions.buy.payment.cancel.static';
    public function subscription_payment_cancel_static()
    {
        return view('subscription::frontend.subscriptions.cancel');
    }

    //buy subscription
    public function buy_subscription(Request $request)
    {
        if(isset($request->subscription_id)){
            $user = Auth::user();
            $subscription_details = Subscription::with('subscription_type:id,validity')->select(['id','subscription_type_id','price','limit'])
                ->where('id',$request->subscription_id)
                ->where('status','1')->first();

            if($subscription_details){
                $expire_date = Carbon::now()->addDays($subscription_details?->subscription_type?->validity);
                $title = __('Buy Subscription');
                $total = $subscription_details->price;
                $limit = $subscription_details->limit;
                $name = $user->first_name.' '.$user->last_name;
                $email = $user->email;
                $user_type = $user->user_type == 1 ? 'client' : 'influencer';
                $payment_status = $request->selected_payment_gateway === 'wallet' ? 'complete' : 'pending';
                $status = $request->selected_payment_gateway === 'wallet' ? 1 : 0;
                session()->put('user_id',$user->id);
                session()->put('user_type',$user_type);

                if($request->selected_payment_gateway === 'manual_payment')
                {
                    $request->validate(['manual_payment_image' => 'required|mimes:jpg,jpeg,png,pdf']);

                    if($request->hasFile('manual_payment_image')){
                        $manual_payment_image = $request->manual_payment_image;
                        $img_ext = $manual_payment_image->extension();

                        $manual_payment_image_name = 'manual_attachment_'.time().'.'.$img_ext;
                        if(in_array($img_ext,['jpg','jpeg','png','pdf'])){
                            $manual_image_path = 'assets/uploads/manual-payment/subscription';
                            $manual_payment_image->move($manual_image_path,$manual_payment_image_name);

                            $buy_subscription = UserSubscription::create([
                                'user_id' => $user->id,
                                'subscription_id' => $subscription_details->id,
                                'price' => $total,
                                'limit' => $limit,
                                'expire_date' => $expire_date,
                                'payment_gateway' => $request->selected_payment_gateway,
                                'manual_payment_payment' => $manual_payment_image,
                                'payment_status' => $payment_status,
                                'status' => $status,
                            ]);
                            $last_subscription_id = $buy_subscription->id;
                            $this->adminNotification($last_subscription_id,$user->id);
                        }else{
                            return back()->with(toastr_warning(__('Image type not supported')));
                        }
                    }

                    $this->sendEmail($name,$last_subscription_id,$email);
                    toastr_success('Subscription purchase success. Your subscription will be usable after admin approval');
                    return redirect()->route($user_type.'.'.'subscriptions.all');
                }
                elseif($request->selected_payment_gateway === 'wallet')
                {
                    $wallet_balance = Wallet::select('balance')->where('user_id',$user->id)->first();
                    if(isset($wallet_balance) && $wallet_balance->balance > $total){
                        $buy_subscription = UserSubscription::create([
                            'user_id' => $user->id,
                            'subscription_id' => $subscription_details->id,
                            'price' => $total,
                            'limit' => $limit,
                            'expire_date' => $expire_date,
                            'payment_gateway' => $request->selected_payment_gateway,
                            'payment_status' => $payment_status,
                            'status' => $status,
                        ]);
                        $last_subscription_id = $buy_subscription->id;
                        $this->adminNotification($last_subscription_id,$user->id);
                        Wallet::where('user_id',$user->id)->update(['balance'=> $wallet_balance->balance - $total]);

                    }else{
                        return back()->with(toastr_warning(__('Please deposit to your wallet and try again')));
                    }
                    $this->sendEmail($name,$last_subscription_id,$email);
                    toastr_success('Subscription purchase success. Your subscription will be usable after admin approval');
                    return redirect()->route($user_type.'.'.'subscriptions.all');
                }
                else
                {
                    $buy_subscription = UserSubscription::create([
                        'user_id' => $user->id,
                        'subscription_id' => $subscription_details->id,
                        'price' => $total,
                        'limit' => $limit,
                        'expire_date' => $expire_date,
                        'payment_gateway' => $request->selected_payment_gateway,
                    ]);

                    $last_subscription_id = $buy_subscription->id;
                    $description = sprintf(__('Order id #%1$d Email: %2$s, Name: %3$s'),$last_subscription_id,$email,$name);

                    if ($request->selected_payment_gateway === 'paypal') {
                        try {
                            return PaymentGatewayRequestHelper::paypal()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('bs.paypal.ipn.subscription')));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif($request->selected_payment_gateway === 'paytm'){
                        try {
                            return PaymentGatewayRequestHelper::paytm()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('bs.paytm.ipn.subscription')));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif ($request->selected_payment_gateway === 'mollie'){
                        try {
                            return PaymentGatewayRequestHelper::mollie()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('bs.mollie.ipn.subscription')));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif ($request->selected_payment_gateway === 'stripe') {
                        $enableRecurring = get_static_option('stripe_subscription_enabled');
                        try {
                            if ($enableRecurring == 'on') {
                                // Check for any active subscription (any plan)
                                $existingSubscription = UserSubscription::where('user_id', $user->id)
                                    ->where('status', 1)
                                    ->where('expire_date', '>', Carbon::now())
                                    ->where('payment_gateway', 'stripe')
                                    ->where('is_recurring_subscription', 1)
                                    ->first();

                                if ($existingSubscription) {
                                    // Check if the user is trying to switch to the same plan
                                    if ($existingSubscription->subscription_id == $subscription_details->id) {
                                        $buy_subscription->delete();
                                        toastr_error(__('You already have an active subscription for this plan.'));
                                        return back();
                                    }

                                    // Update the existing subscription (upgrade/downgrade)
                                    return $this->updateStripeSubscription($request, $total, $title, $description, $email, $name, $user_type, $last_subscription_id, $existingSubscription);
                                }

                                // Create a new subscription
                                return $this->createStripeSubscription($request, $total, $title, $description, $email, $name, $user_type, $last_subscription_id);
                            } else {
                                // One-time payment flow
                                $buy_subscription->update(['is_recurring_subscription' => 0]);
                                return PaymentGatewayRequestHelper::stripe()->charge_customer(
                                    $this->buildPaymentArg(
                                        $total, $title, $description, $last_subscription_id, $email, $name, $user_type,
                                        route('bs.stripe.ipn.subscription')
                                    )
                                );
                            }
                        } catch (\Exception $e) {
                            $buy_subscription->delete();
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif($request->selected_payment_gateway === 'razorpay'){
                        try {
                            return PaymentGatewayRequestHelper::razorpay()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('bs.razorpay.ipn.subscription')));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif($request->selected_payment_gateway === 'flutterwave'){
                        try {
                            return PaymentGatewayRequestHelper::flutterwave()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('bs.flutterwave.ipn.subscription')));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif($request->selected_payment_gateway === 'paystack'){
                        try {
                            return PaymentGatewayRequestHelper::paystack()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('paystack.ipn.all'),'subscription'));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif($request->selected_payment_gateway === 'sslcommerce'){
                        try {
                            return PaymentGatewayRequestHelper::sslcommerz()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('sslcommerce.ipn.all'),'subscription'));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif($request->selected_payment_gateway === 'xendit'){
                        try {
                            return PaymentGatewayRequestHelper::xendit()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('xendit.ipn.all'),'subscription'));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif($request->selected_payment_gateway === 'payfast'){
                        try {
                            return PaymentGatewayRequestHelper::payfast()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('bs.payfast.ipn.subscription')));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif($request->selected_payment_gateway === 'cashfree'){
                        try {
                            return PaymentGatewayRequestHelper::cashfree()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('bs.cashfree.ipn.subscription')));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif($request->selected_payment_gateway === 'instamojo'){
                        try {
                            return PaymentGatewayRequestHelper::instamojo()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('bs.instamojo.ipn.subscription')));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif($request->selected_payment_gateway === 'marcadopago'){
                        try {
                            return PaymentGatewayRequestHelper::marcadopago()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('bs.marcadopago.ipn.subscription')));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }

                    }
                    elseif($request->selected_payment_gateway === 'midtrans'){
                        try {
                            return PaymentGatewayRequestHelper::midtrans()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('bs.midtrans.ipn.subscription')));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif($request->selected_payment_gateway === 'squareup'){
                        try {
                            return PaymentGatewayRequestHelper::squareup()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('bs.squareup.ipn.subscription')));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif($request->selected_payment_gateway === 'cinetpay'){
                        try {
                            return PaymentGatewayRequestHelper::cinetpay()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('bs.cinetpay.ipn.subscription')));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif($request->selected_payment_gateway === 'paytabs'){

                        try {
                            return PaymentGatewayRequestHelper::paytabs()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('bs.paytabs.ipn.subscription')));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif($request->selected_payment_gateway === 'billplz'){
                        try {
                            return PaymentGatewayRequestHelper::billplz()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('bs.billplz.ipn.subscription')));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif($request->selected_payment_gateway === 'zitopay'){
                        try {
                            return PaymentGatewayRequestHelper::zitopay()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('bs.zitopay.ipn.subscription')));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif($request->selected_payment_gateway === 'toyyibpay'){
                        try {
                            return PaymentGatewayRequestHelper::toyyibpay()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('bs.toyyibpay.ipn.subscription')));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif($request->selected_payment_gateway === 'authorize_dot_net'){
                        try {
                            return PaymentGatewayRequestHelper::authorizenet()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('bs.authorize.ipn.subscription')));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif($request->selected_payment_gateway === 'pagali'){
                        try {
                            return PaymentGatewayRequestHelper::pagalipay()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('bs.pagali.ipn.subscription')));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif($request->selected_payment_gateway === 'sitesway'){
                        try {
                            return PaymentGatewayRequestHelper::sitesway()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('bs.siteways.ipn.subscription')));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif($request->selected_payment_gateway === 'iyzipay'){
                        try {
                            return PaymentGatewayRequestHelper::iyzipay()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('bs.iyzipay.ipn.subscription')));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif($request->selected_payment_gateway === 'kineticpay'){
                        try {
                            return PaymentGatewayRequestHelper::kineticpay()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('bs.kineticpay.ipn.subscription')));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif($request->selected_payment_gateway === 'awdpay'){
                        try {
                            return PaymentGatewayRequestHelper::awdpay()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('bs.awdpay.ipn.subscription')));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                    elseif($request->selected_payment_gateway === 'yoomoney'){
                        try {
                            return PaymentGatewayRequestHelper::yoomoney()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('yoomoney.ipn.all'),'subscription'));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }

                    elseif($request->selected_payment_gateway === 'coinpayments'){
                        try {
                            return PaymentGatewayRequestHelper::coinpayments()->charge_customer($this->buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,route('coinpayment.ipn.all'),'subscription'));
                        }catch (\Exception $e){
                            toastr_error($e->getMessage());
                            return back();
                        }
                    }
                }
            }
        }
    }

    private function buildPaymentArg($total,$title,$description,$last_subscription_id,$email,$name,$user_type,$ipn_route,$source=null)
    {
        return [
            'amount' => $total,
            'title' => $title,
            'description' => $description,
            'ipn_url' => $ipn_route,
            'order_id' => $last_subscription_id,
            'track' => \Str::random(36),
            'cancel_url' => route(self::CANCEL_ROUTE,$last_subscription_id),
            'success_url' => route($user_type.'.'.'subscriptions.all'),
            'email' => $email,
            'name' => $name,
            'payment_type' => $source,
        ];
    }

  //send email
    private function sendEmail($name,$last_subscription_id,$email)
    {
        //Send subscription email to admin
        try {
            $message = get_static_option('user_subscription_purchase_admin_email_message') ?? __('A user just purchase a subscription.');
            $message = str_replace(["@name","@subscription_id"],[$name, $last_subscription_id], $message);
            Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                'subject' => get_static_option('user_subscription_purchase_admin_email_subject') ?? __('Subscription purchase email'),
                'message' => $message
            ]));
        } catch (\Exception $e) {

        }

        //Send subscription email to user
        try {
            $message = get_static_option('user_subscription_purchase_message') ?? __('Your subscription purchase successfully completed.');
            $message = str_replace(["@name","@subscription_id"],[$name, $last_subscription_id], $message);
            Mail::to($email)->send(new BasicMail([
                'subject' => get_static_option('user_subscription_purchase_subject') ?? __('Subscription purchase email'),
                'message' => $message
            ]));
        } catch (\Exception $e) {

        }
    }

    //admin notification
    private function adminNotification($last_subscription_id,$user_id)
    {
        AdminNotification::create([
            'identity'=>$last_subscription_id,
            'user_id'=>$user_id,
            'type'=>__('Buy Subscription'),
            'message'=>__('User subscription purchase'),
        ]);
    }
    protected function createStripeSubscription($request, $total, $title, $description, $email, $name, $user_type, $last_subscription_id)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        // Retrieve the UserSubscription and associated Subscription
        $userSubscription = UserSubscription::findOrFail($last_subscription_id);
        $subscription = Subscription::findOrFail($userSubscription->subscription_id);

        // Validate that stripe_price_id exists
        if (empty($subscription->stripe_price_id)) {
            $userSubscription->delete();
            throw new \Exception(__('No Stripe price ID found for the selected subscription.'));
        }

        // Check for an existing Stripe customer
        $existingCustomerSubscription = UserSubscription::where('user_id', $userSubscription->user_id)
            ->whereNotNull('stripe_customer_id')
            ->where('payment_gateway', 'stripe')
            ->first();

        $customerId = $existingCustomerSubscription ? $existingCustomerSubscription->stripe_customer_id : null;
        if (!$customerId) {
            // Create a new customer
            $customer = $stripe->customers->create([
                'email' => $email,
                'name' => $name,
            ]);
            $customerId = $customer->id;
        }

        // Create a Checkout Session for subscription
        $session = $stripe->checkout->sessions->create([
            'customer' => $customerId,
            'mode' => 'subscription',
            'line_items' => [[
                'price' => $subscription->stripe_price_id,
                'quantity' => 1,
            ]],
            'success_url' => route('bs.stripe.subscription.ipn') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('subscriptions.buy.payment.cancel.static'),
        ]);

        // Update the user subscription
        $userSubscription->update([
            'subscription_id' => $request->subscription_id,
            'stripe_customer_id' => $customerId,
            'stripe_session_id' => $session->id,
            'stripe_subscription_id' => null,
            'stripe_price_id' => $subscription->stripe_price_id,
            'status' => 0,
            'payment_status' => 'processing',
            'price' => $total,
            'is_recurring_subscription' => 1,
        ]);

        return view('subscription::stripe.stripe-subscription', [
            'session_id' => $session->id,
            'public_key' => env('STRIPE_PUBLIC'),
            'success_url' => route('bs.stripe.subscription.ipn') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('subscriptions.buy.payment.cancel.static'),
        ]);
    }

    protected function updateStripeSubscription($request, $total, $title, $description, $email, $name, $user_type, $last_subscription_id, $existingSubscription)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        try {
            // Check if Stripe subscription is enabled
            if (get_static_option('stripe_subscription_enabled') !== 'on') {
                throw new \Exception(__('Stripe subscriptions are currently disabled.'));
            }

            // Retrieve the UserSubscription and associated Subscription
            $userSubscription = UserSubscription::findOrFail($last_subscription_id);
            $subscription = Subscription::findOrFail($request->subscription_id);

            // Validate that stripe_price_id exists
            if (empty($subscription->stripe_price_id)) {
                $userSubscription->delete();
                throw new \Exception(__('No Stripe price ID found for the selected subscription.'));
            }

            // Use the existing Stripe customer and subscription
            $stripeCustomerId = $existingSubscription->stripe_customer_id;
            if (!$stripeCustomerId) {
                $userSubscription->delete();
                throw new \Exception(__('No Stripe customer ID found for the existing subscription.'));
            }

            $stripeSubscriptionId = $existingSubscription->stripe_subscription_id;
            if (!$stripeSubscriptionId) {
                $userSubscription->delete();
                throw new \Exception(__('No Stripe subscription ID found for the existing subscription.'));
            }

            // Retrieve the existing Stripe subscription to get the subscription item ID
            $stripeSubscription = $stripe->subscriptions->retrieve($stripeSubscriptionId, []);
            $subscriptionItemId = $stripeSubscription->items->data[0]->id ?? null;

            if (!$subscriptionItemId) {
                $userSubscription->delete();
                throw new \Exception(__('No subscription item found for the existing subscription.'));
            }

            // Update the Stripe subscription with immediate billing cycle reset
            $updatedSubscription = $stripe->subscriptions->update($stripeSubscriptionId, [
                'items' => [
                    [
                        'id' => $subscriptionItemId,
                        'price' => $subscription->stripe_price_id,
                    ],
                ],
                'proration_behavior' => 'create_prorations', // This will create a proration for immediate payment
                'payment_behavior' => 'allow_incomplete',
                'billing_cycle_anchor' => 'now',  // Reset billing cycle to now
            ]);


            // Calculate the new connect points (limit) based on carry_forward_connect
            $newSubscriptionLimit = $subscription->limit; // New subscription's connect points
            $currentLimit = $existingSubscription->limit; // Current subscription's connect points
            $newLimit = $newSubscriptionLimit; // Default to new subscription's limit

            // Validate limit values
            if (!is_numeric($newSubscriptionLimit) || !is_numeric($currentLimit)) {
                throw new \Exception(__('Invalid connect points value for subscription.'));
            }


            if (get_static_option('carry_forward_connect') === 'on') {
                // Determine if it's an upgrade or downgrade based on price
                $isUpgrade = $total > $existingSubscription->price;

                if ($isUpgrade) {
                    // Upgrade: Add new plan's quota to current limit
                    $newLimit = $currentLimit + $newSubscriptionLimit;
                } else {
                    // Downgrade: Handle more gracefully
                    $downgradeBehavior = get_static_option('downgrade_connect_behavior', 'preserve_current');

                    switch ($downgradeBehavior) {
                        case 'preserve_current':
                            // Keep current connects if higher than new plan limit
                            $newLimit = max($currentLimit, $newSubscriptionLimit);

                            break;
                        default:
                            // Default to preserving current connects
                            $newLimit = max($currentLimit, $newSubscriptionLimit);
                    }
                }
            } else {
                // Reset to the new subscription's limit without carrying forward
                $newLimit = $newSubscriptionLimit;
            }

            \Log::info("Final newLimit={$newLimit} for user subscription ID={$existingSubscription->id}");

            // Update the existing UserSubscription record with new plan details
            $existingSubscription->update([
                'subscription_id' => $request->subscription_id,
                'stripe_price_id' => $subscription->stripe_price_id,
                'price' => $total,
                'limit' => $newLimit, // Update the connect points immediately
                'start_date' => Carbon::createFromTimestamp($updatedSubscription->current_period_start),
                'expire_date' => Carbon::createFromTimestamp($updatedSubscription->current_period_end),
                'status' => $updatedSubscription->status === 'active' ? 1 : 0,
                'payment_status' => $updatedSubscription->status === 'active' ? 'complete' : 'processing',
                'is_recurring_subscription' => 1,
                'updated_at' => Carbon::now(),
            ]);

            // Delete the new UserSubscription record since we're updating the existing one
            $userSubscription->delete();

            // Notify user of successful update
            toastr_success(__('Subscription plan updated successfully. You have been charged the full amount for the new plan and your billing cycle has been reset.'));
            return redirect()->route('influencer.subscriptions.all');

        } catch (\Stripe\Exception\ApiErrorException $e) {
            if (isset($userSubscription)) {
                $userSubscription->delete();
            }

            toastr_error(__('Stripe error: ') . $e->getMessage());
            return redirect()->route('influencer.subscriptions.all');

        } catch (\Exception $e) {

            if (isset($userSubscription)) {
                $userSubscription->delete();
            }

            toastr_error(__('Failed to update subscription: ') . $e->getMessage());
            return redirect()->route('influencer.subscriptions.all');
        }
    }

}
