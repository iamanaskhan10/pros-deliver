<?php

namespace Modules\Subscription\Http\Controllers\Frontend;

use App\Mail\BasicMail;
use App\Models\AdminNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Modules\Subscription\Entities\Subscription;
use Modules\Subscription\Entities\UserSubscription;
use Stripe\StripeClient;
use Stripe\Webhook;
use Xgenious\Paymentgateway\Facades\XgPaymentGateway;

class BuySubscriptionIPNController extends Controller
{
    protected function cancel_page()
    {
        return redirect()->route('subscriptions.buy.payment.cancel.static');
    }

    public function paypal_ipn_for_subscription()
    {
        $paypal = XgPaymentGateway::paypal();
        $paypal->setClientId(get_static_option('paypal_sandbox_client_id') ?? get_static_option('paypal_live_client_id')); // provide sandbox id if payment env set to true, otherwise provide live credentials
        $paypal->setClientSecret(get_static_option('paypal_sandbox_client_secret') ?? get_static_option('paypal_live_client_secret')); // provide sandbox id if payment env set to true, otherwise provide live credentials
        $paypal->setAppId(get_static_option('paypal_sandbox_app_id') ?? get_static_option('paypal_live_app_id')); // provide sandbox id if payment env set to true, otherwise provide live credentials
        $paypal->setEnv(get_static_option('paypal_test_mode') === 'on' ? true : false); //env must set as boolean, string will not work
        $payment_data = $paypal->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $user_id = session()->get('user_id');
            $user_type = session()->get('user_type');
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_jobs_mail($order_id,$user_id);
            toastr_success('Subscription purchase success');
            return redirect()->route($user_type.'.'.'subscriptions.all');
        }
        return $this->cancel_page();
    }
    public function paytm_ipn_for_subscription()
    {
        $paytm = XgPaymentGateway::paytm();
        $paytm->setMerchantId(get_static_option('paytm_merchant_mid'));
        $paytm->setMerchantKey(get_static_option('paytm_merchant_key'));
        $paytm->setMerchantWebsite(get_static_option('paytm_merchant_website') ?? 'WEBSTAGING');
        $paytm->setChannel(get_static_option('paytm_channel') ?? 'WEB');
        $paytm->setIndustryType(get_static_option('paytm_industry_type') ?? 'Retail');
        $paytm->setEnv(get_static_option('paytm_test_mode') == 'on' ? true : false); //env must set as boolean, string will not work
        $payment_data = $paytm->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $user_id = session()->get('user_id');
            $user_type = session()->get('user_type');
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_jobs_mail($order_id,$user_id);
            toastr_success('Subscription purchase success');
            return redirect()->route($user_type.'.'.'subscriptions.all');
        }
        return $this->cancel_page();
    }
    public function mollie_ipn_for_subscription()
    {
        $mollie_key = get_static_option('mollie_public_key');
        $mollie = XgPaymentGateway::mollie();
        $mollie->setApiKey($mollie_key);
        $mollie->setEnv(get_static_option('mollie_test_mode') == 'on' ? true : false); //env must set as boolean, string will not work
        $payment_data = $mollie->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $user_id = session()->get('user_id');
            $user_type = session()->get('user_type');
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_jobs_mail($order_id,$user_id);
            toastr_success('Subscription purchase success');
            return redirect()->route($user_type.'.'.'subscriptions.all');
        }
        return $this->cancel_page();
    }
    public function stripe_ipn_for_subscription()
    {
        $stripe = XgPaymentGateway::stripe();
        $stripe->setSecretKey(get_static_option('stripe_secret_key'));
        $stripe->setPublicKey(get_static_option('stripe_public_key'));
        $stripe->setEnv(get_static_option('stripe_test_mode') == 'on' ? true : false); //env must set as boolean, string will not work
        $payment_data = $stripe->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $user_id = session()->get('user_id');
            $user_type = session()->get('user_type');
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_jobs_mail($order_id,$user_id);
            toastr_success('Subscription purchase success');
            return redirect()->route($user_type.'.'.'subscriptions.all');
        }
        return $this->cancel_page();
    }


    public function stripe_subscription_ipn(Request $request)
    {
        $session_id = $request->get('session_id');

        if (!$session_id) {
            toastr_error('Invalid session ID');
            return $this->cancel_page();
        }

        try {
            $stripe = new StripeClient(get_static_option('stripe_secret_key'));
            $session = $stripe->checkout->sessions->retrieve($session_id, [
                'expand' => ['subscription', 'customer']
            ]);

            if (!$session || $session->payment_status !== 'paid') {
                toastr_error('Payment not completed');
                return $this->cancel_page();
            }

            $stripeSubscription = $session->subscription;
            $stripeCustomer = $session->customer;

            $subscription = $stripe->subscriptions->retrieve($stripeSubscription->id, []);

            if ($subscription->status !== 'active') {
                toastr_error('Subscription is not active');
                return $this->cancel_page();
            }

            // Query UserSubscription with broader criteria to handle webhook updates
            $userSubscription = UserSubscription::where('stripe_session_id', $session_id)
                ->where('stripe_customer_id', $stripeCustomer->id)
                ->first();

            if (!$userSubscription) {
                toastr_error('Subscription not found');
                return $this->cancel_page();
            }

            // Update only if not already finalized by webhook
            if ($userSubscription->status === 0 && ($userSubscription->payment_status === 'processing' || is_null($userSubscription->payment_status))) {
                $userSubscription->update([
                    'stripe_subscription_id' => $stripeSubscription->id,
                    'status' => 0,
                    'payment_status' => 'processing',
                    'is_recurring_subscription' => 1,
                    'start_date' => Carbon::createFromTimestamp($subscription->current_period_start),
                    'expire_date' => Carbon::createFromTimestamp($subscription->current_period_end),
                ]);

            }

            $user_id = session()->get('user_id');
            if ($user_id) {
                // Send email only if not already sent by webhook
                if ($userSubscription->status !== 1 || $userSubscription->payment_status !== 'complete') {
                    $this->send_jobs_mail($userSubscription->id, $user_id);
                }
                toastr_success('Subscription purchase successful');
            } else {
                \Log::warning("No user_id found in session", [
                    'user_subscription_id' => $userSubscription->id
                ]);
            }

            return redirect()->route(session()->get('user_type') . '.subscriptions.all');

        } catch (\Stripe\Exception\ApiErrorException $e) {
            toastr_error('An error occurred while processing the subscription');
            return $this->cancel_page();

        } catch (\Exception $e) {
            toastr_error('An unexpected error occurred');
            return $this->cancel_page();
        }
    }

    public function stripe_webhook(Request $request)
    {
        // Retrieve the webhook secret from .env
        $endpoint_secret = get_static_option('stripe_webhook_secret');

        // Get the raw payload and signature header
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $event = null;

        try {
            // Verify the webhook signature
            $event = Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response()->json(['error' => 'Invalid signature'], 400);
        }


        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                return $this->handleCheckoutSessionCompleted($session);

            case 'invoice.payment_succeeded':
                $invoice = $event->data->object;
                return $this->handleInvoicePaymentSucceeded($invoice);

            case 'customer.subscription.updated':
                $subscription = $event->data->object;
                return $this->handleSubscriptionUpdated($subscription);

            case 'invoice.created':
                $invoice = $event->data->object;
                return $this->handleInvoiceCreated($invoice);
            case 'invoice.paid':
                $invoice = $event->data->object;
                return $this->handleInvoicePaid($invoice);
            case 'invoice.payment_failed':
                $invoice = $event->data->object;
                return $this->handleInvoicePaymentFailed($invoice);

            case 'customer.subscription.deleted':
                $subscription = $event->data->object;
                return $this->handleSubscriptionDeleted($subscription);
            default:
                \Log::info("Received unhandled event type", ['event_type' => $event->type]);
        }

        return response()->json(['status' => 'success'], 200);
    }

    protected function handleInvoicePaid($invoice)
    {
        try {
            $stripeSubscriptionId = $invoice->subscription;
            if (!$stripeSubscriptionId) {
                return response()->json(['status' => 'success'], 200);
            }

            $userSubscription = UserSubscription::where('stripe_subscription_id', $stripeSubscriptionId)->first();
            if (!$userSubscription) {
                return response()->json(['status' => 'error', 'message' => 'UserSubscription not found'], 404);
            }

            $stripe = new StripeClient(get_static_option('stripe_secret_key'));
            $subscription = $stripe->subscriptions->retrieve($stripeSubscriptionId, []);

            // Retrieve the associated Subscription model
            $subscriptionModel = Subscription::find($userSubscription->subscription_id);
            if (!$subscriptionModel) {
                return response()->json(['status' => 'error', 'message' => 'Subscription not found'], 404);
            }

            // Calculate the new connect points (limit) based on carry_forward_connect
            $newSubscriptionLimit = $subscriptionModel->limit; // New subscription's connect points
            $currentLimit = $userSubscription->limit; // Current subscription's connect points
            $newLimit = $newSubscriptionLimit; // Default to new subscription's limit

            // Validate limit values
            if (!is_numeric($newSubscriptionLimit) || !is_numeric($currentLimit)) {
                return response()->json(['status' => 'error', 'message' => 'Invalid connect points value for subscription'], 400);
            }

            if (get_static_option('carry_forward_connect') === 'on') {
                // Add new plan's quota to current limit for renewal
                $newLimit = $currentLimit + $newSubscriptionLimit;
            } else {
                // Reset to the new subscription's limit without carrying forward
                $newLimit = $newSubscriptionLimit;
            }

            \Log::info("Final newLimit={$newLimit} for user subscription ID={$userSubscription->id} on renewal");

            // Update subscription with new limit and other details
            $userSubscription->update([
                'start_date' => Carbon::createFromTimestamp($subscription->current_period_start),
                'expire_date' => Carbon::createFromTimestamp($subscription->current_period_end),
                'limit' => $newLimit, // Update the connect points
                'status' => $subscription->status === 'active' ? 1 : 0,
                'payment_status' => 'complete',
            ]);

            return response()->json(['status' => 'success'], 200);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json(['status' => 'error', 'message' => 'Stripe API error: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Unexpected error: ' . $e->getMessage()], 500);
        }
    }

    protected function handleInvoiceCreated($invoice)
    {
        try {
            $stripeSubscriptionId = $invoice->subscription;
            if (!$stripeSubscriptionId) {
                return response()->json(['status' => 'success'], 200);
            }

            $userSubscription = UserSubscription::where('stripe_subscription_id', $stripeSubscriptionId)->first();
            if (!$userSubscription) {
                return response()->json(['status' => 'error', 'message' => 'UserSubscription not found'], 404);
            }

            return response()->json(['status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Unexpected error'], 500);
        }
    }

    protected function handleCheckoutSessionCompleted($session)
    {
        if ($session->mode !== 'subscription' || !$session->subscription || !$session->customer) {
            return response()->json(['status' => 'error', 'message' => 'Invalid checkout session'], 400);
        }

        $stripeSubscriptionId = $session->subscription;
        $stripeCustomerId = $session->customer;
        $sessionId = $session->id;

        try {
            $stripe = new StripeClient(get_static_option('stripe_secret_key'));
            $subscription = $stripe->subscriptions->retrieve($stripeSubscriptionId, []);

            if (!in_array($subscription->status, ['active', 'incomplete'])) {
                return response()->json(['status' => 'error', 'message' => 'Subscription not in acceptable state'], 400);
            }

            $userSubscription = UserSubscription::where('stripe_session_id', $sessionId)
                ->where('status', 0)
                ->where(function ($query) {
                    $query->where('payment_status', 'processing')
                        ->orWhereNull('payment_status');
                })
                ->first();

            if (!$userSubscription) {
                return response()->json(['status' => 'error', 'message' => 'UserSubscription not found'], 404);
            }

            // Update the subscription with confirmed details from Stripe
            $userSubscription->update([
                'stripe_subscription_id' => $stripeSubscriptionId,
                'status' => $subscription->status === 'active' ? 1 : 0,
                'payment_status' => $subscription->status === 'active' ? 'complete' : 'incomplete',
                'start_date' => Carbon::createFromTimestamp($subscription->current_period_start),
                'expire_date' => Carbon::createFromTimestamp($subscription->current_period_end),
                'is_recurring_subscription' => 1,
            ]);

            $user_id = $userSubscription->user_id ?? null;
            if ($user_id) {
                $this->send_jobs_mail($userSubscription->id, $user_id);
            } else {
                \Log::warning("No user_id found for subscription", [
                    'user_subscription_id' => $userSubscription->id
                ]);
            }

            return response()->json(['status' => 'success'], 200);

        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json(['status' => 'error', 'message' => 'Stripe API error'], 500);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Unexpected error'], 500);
        }
    }

    protected function handleInvoicePaymentSucceeded($invoice)
    {
        try {
            $stripeSubscriptionId = $invoice->subscription;

            if (!$stripeSubscriptionId) {
                return response()->json(['status' => 'success'], 200);
            }

            $userSubscription = UserSubscription::where('stripe_subscription_id', $stripeSubscriptionId)->first();

            if (!$userSubscription) {
                return response()->json(['status' => 'error', 'message' => 'UserSubscription not found'], 404);
            }

            // Get the latest subscription details from Stripe
            $stripe = new StripeClient(get_static_option('stripe_secret_key'));
            $subscription = $stripe->subscriptions->retrieve($stripeSubscriptionId, []);

            // Update subscription dates based on the latest Stripe data
            $userSubscription->update([
                'start_date' => Carbon::createFromTimestamp($subscription->current_period_start),
                'expire_date' => Carbon::createFromTimestamp($subscription->current_period_end),
                'status' => $subscription->status === 'active' ? 1 : 0,
                'payment_status' => $subscription->status === 'active' ? 'complete' : 'incomplete',
            ]);

            return response()->json(['status' => 'success'], 200);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Unexpected error'], 500);
        }
    }

// New method to handle subscription updates
    protected function handleSubscriptionUpdated($subscription)
    {
        try {
            $stripeSubscriptionId = $subscription->id;
            $userSubscription = UserSubscription::where('stripe_subscription_id', $stripeSubscriptionId)->first();
            if (!$userSubscription) {
                return response()->json(['status' => 'error', 'message' => 'UserSubscription not found'], 404);
            }

            // Skip redundant updates for already canceled subscriptions
            if ($userSubscription->status === 0 && $subscription->status === 'canceled' && $userSubscription->expire_date <= Carbon::now()) {
                return response()->json(['status' => 'success'], 200);
            }

            $cancellationDetails = $subscription->cancellation_details ?? null;
            $cancelAtPeriodEnd = $subscription->cancel_at_period_end ?? false;

            $updateData = [
                'start_date' => Carbon::createFromTimestamp($subscription->current_period_start),
                'expire_date' => Carbon::createFromTimestamp($subscription->current_period_end),
                'status' => $subscription->status === 'active' ? 1 : 0,
                'payment_status' => $subscription->status === 'active' ? 'complete' : ($subscription->status === 'canceled' ? 'canceled' : 'incomplete'),
            ];

            if ($cancelAtPeriodEnd) {
                $updateData['status'] = 2; // Pending cancellation
            } elseif ($subscription->status === 'canceled') {
                $updateData['expire_date'] = Carbon::now(); // Immediate cancellation
            }

            $userSubscription->update($updateData);

            return response()->json(['status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Unexpected error'], 500);
        }
    }

// New method to handle failed payments
    protected function handleInvoicePaymentFailed($invoice)
    {
        try {
            $stripeSubscriptionId = $invoice->subscription;
            if (!$stripeSubscriptionId) {
                return response()->json(['status' => 'success'], 200);
            }

            $userSubscription = UserSubscription::where('stripe_subscription_id', $stripeSubscriptionId)->first();
            if (!$userSubscription) {
                return response()->json(['status' => 'error', 'message' => 'UserSubscription not found'], 404);
            }

            $userSubscription->update([
                'payment_status' => 'failed',
                // Keep status as active until Stripe cancels the subscription after retry attempts
            ]);

            return response()->json(['status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Unexpected error'], 500);
        }
    }

    protected function handleSubscriptionDeleted($subscription)
    {
        try {
            $stripeSubscriptionId = $subscription->id;
            $userSubscription = UserSubscription::where('stripe_subscription_id', $stripeSubscriptionId)->first();

            if (!$userSubscription) {
                return response()->json(['status' => 'error', 'message' => 'UserSubscription not found'], 404);
            }

            $cancellationDetails = $subscription->cancellation_details ?? null;

            // Update subscription to reflect immediate cancellation
            $userSubscription->update([
                'status' => 0, // Inactive status
                'payment_status' => 'canceled',
                'expire_date' => Carbon::now(),
            ]);

            // Handle refund for immediate cancellation (if applicable)
            $refund = $this->handleRefundForImmediateCancellation($userSubscription, $subscription);


            return response()->json(['status' => 'success'], 200);
        } catch (\Exception $e) {

            return response()->json(['status' => 'error', 'message' => 'Unexpected error'], 500);
        }
    }

    protected function handleRefundForImmediateCancellation($userSubscription, $subscription)
    {
        try {
            $stripe = new StripeClient(get_static_option('stripe_secret_key'));
            // Retrieve the latest invoice for the subscription
            $invoices = $stripe->invoices->all([
                'subscription' => $subscription->id,
                'limit' => 1,
                'status' => 'paid' // Ensure only paid invoices are considered
            ]);

            if (empty($invoices->data)) {
                return false;
            }

            $latestInvoice = $invoices->data[0];
            $chargeId = $latestInvoice->charge;

            if (!$chargeId) {
                return false;
            }

            // Check if the charge is refundable
            $charge = $stripe->charges->retrieve($chargeId);
            if ($charge->refunded || $charge->amount_refunded >= $charge->amount) {
                return false;
            }

            // Calculate prorated refund amount
            $refundAmount = $this->calculateProratedRefundAmount($latestInvoice, $subscription);
            if ($refundAmount <= 0 || $refundAmount > ($charge->amount - $charge->amount_refunded)) {
                return false;
            }

            // Issue refund using charge ID
            $refund = $stripe->refunds->create([
                'charge' => $chargeId,
                'amount' => $refundAmount,
                'reason' => 'requested_by_customer',
                'metadata' => [
                    'user_subscription_id' => $userSubscription->id,
                    'subscription_id' => $subscription->id,
                    'cancellation_reason' => $subscription->cancellation_details->reason ?? 'none'
                ]
            ]);

            return $refund;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    protected function calculateProratedRefundAmount($invoice, $subscription)
    {
        $periodStart = $subscription->current_period_start;
        $periodEnd = $subscription->current_period_end;
        $now = Carbon::now()->timestamp;

        // Calculate the total period duration and used duration
        $totalPeriod = $periodEnd - $periodStart;
        $usedPeriod = $now - $periodStart;

        if ($totalPeriod <= 0 || $usedPeriod < 0) {
            return 0;
        }

        // Calculate the unused portion as a fraction
        $unusedFraction = 1 - ($usedPeriod / $totalPeriod);
        $refundAmount = round($invoice->amount_paid * $unusedFraction);

        return $refundAmount;
    }

    public function razorpay_ipn_for_subscription()
    {
        $razorpay = XgPaymentGateway::razorpay();
        $razorpay->setApiKey(get_static_option('razorpay_api_key'));
        $razorpay->setApiSecret(get_static_option('razorpay_api_secret'));
        $razorpay->setEnv(get_static_option('razorpay_test_mode') == 'on' ? true : false); //env must set as boolean, string will not work
        $payment_data = $razorpay->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $user_id = session()->get('user_id');
            $user_type = session()->get('user_type');
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_jobs_mail($order_id,$user_id);
            toastr_success('Subscription purchase success');
            return redirect()->route($user_type.'.'.'subscriptions.all');
        }
        return $this->cancel_page();
    }
    public function flutterwave_ipn_for_subscription()
    {
        $flutterwave = XgPaymentGateway::flutterwave();
        $flutterwave->setPublicKey(get_static_option('flw_public_key'));
        $flutterwave->setSecretKey(get_static_option('flw_secret_key'));
        $flutterwave->setEnv(get_static_option('flutterwave_test_mode') == 'on' ? true : false); //env must set as boolean, string will not work
        $payment_data = $flutterwave->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $user_id = session()->get('user_id');
            $user_type = session()->get('user_type');
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_jobs_mail($order_id,$user_id);
            toastr_success('Subscription purchase success');
            return redirect()->route($user_type.'.'.'subscriptions.all');
        }
        return $this->cancel_page();
    }
    public function paystack_ipn_for_subscription()
    {
        $paystack = XgPaymentGateway::paystack();
        $paystack->setPublicKey(get_static_option('paystack_public_key') ?? '');
        $paystack->setSecretKey(get_static_option('paystack_secret_key') ?? '');
        $paystack->setMerchantEmail(get_static_option('paystack_merchant_email') ?? '');

        $payment_data = $paystack->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $user_id = session()->get('user_id');
            $user_type = session()->get('user_type');
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_jobs_mail($order_id,$user_id);
            toastr_success('Subscription purchase success');
            return redirect()->route($user_type.'.'.'subscriptions.all');
        }
        return $this->cancel_page();
    }
    public function cashfree_ipn_for_subscription()
    {
        $cashfree = XgPaymentGateway::cashfree();
        $cashfree->setAppId(get_static_option('cashfree_app_id') ?? '');
        $cashfree->setSecretKey(get_static_option('cashfree_secret_key') ?? '');
        $cashfree->setEnv(get_static_option('cashfree_test_mode') == 'on' ? true : false); //env must set as boolean, string will not work
        $payment_data = $cashfree->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $user_id = session()->get('user_id');
            $user_type = session()->get('user_type');
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_jobs_mail($order_id,$user_id);
            toastr_success('Subscription purchase success');
            return redirect()->route($user_type.'.'.'subscriptions.all');
        }
        return $this->cancel_page();
    }
    public function instamojo_ipn_for_subscription()
    {
        $instamojo = XgPaymentGateway::instamojo();
        $instamojo->setClientId(get_static_option('instamojo_client_id') ?? '');
        $instamojo->setSecretKey(get_static_option('instamojo_client_secret') ?? '');
        $instamojo->setEnv(get_static_option('instamojo_test_mode') == 'on' ? true : false);
        $payment_data = $instamojo->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $user_id = session()->get('user_id');
            $user_type = session()->get('user_type');
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_jobs_mail($order_id,$user_id);
            toastr_success('Subscription purchase success');
            return redirect()->route($user_type.'.'.'subscriptions.all');
        }
        return $this->cancel_page();
    }
    public function marcadopago_ipn_for_subscription()
    {

        $marcadopago = XgPaymentGateway::mercadopago();
        $marcadopago->setClientId(get_static_option('marcadopago_client_id') ?? '');
        $marcadopago->setClientSecret(get_static_option('marcadopago_client_secret') ?? '');
        $marcadopago->setEnv(get_static_option('marcadopago_test_mode') == 'on' ? true : false); ////true mean sandbox mode , false means live mode
        $payment_data = $marcadopago->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $user_id = session()->get('user_id');
            $user_type = session()->get('user_type');
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_jobs_mail($order_id,$user_id);
            toastr_success('Subscription purchase success');
            return redirect()->route($user_type.'.'.'subscriptions.all');
        }
        return $this->cancel_page();
    }
    public function payfast_ipn_for_subscription()
    {
        $payfast = XgPaymentGateway::payfast();
        $payfast->setMerchantId(get_static_option('payfast_merchant_id' ?? ''));
        $payfast->setMerchantKey(get_static_option('payfast_merchant_key' ?? ''));
        $payfast->setPassphrase(get_static_option('payfast_passphrase' ?? ''));
        $payfast->setEnv(get_static_option('payfast_test_mode') == 'on' ? true : false); //env must set as boolean, string will not work
        $payment_data = $payfast->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $user_id = session()->get('user_id');
            $user_type = session()->get('user_type');
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_jobs_mail($order_id,$user_id);
            toastr_success('Subscription purchase success');
            return redirect()->route($user_type.'.'.'subscriptions.all');
        }
        return $this->cancel_page();
    }
    public function midtrans_ipn_for_subscription()
    {

        $midtrans = XgPaymentGateway::midtrans();
        $midtrans->setClientKey(get_static_option('midtrans_client_key') ?? '');
        $midtrans->setServerKey(get_static_option('midtrans_server_key') ?? '');
        $midtrans->setEnv(get_static_option('midtrans_test_mode') == 'on' ? true : false); //true mean sandbox mode , false means live mode
        $payment_data = $midtrans->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $user_id = session()->get('user_id');
            $user_type = session()->get('user_type');
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_jobs_mail($order_id,$user_id);
            toastr_success('Subscription purchase success');
            return redirect()->route($user_type.'.'.'subscriptions.all');
        }
        return $this->cancel_page();
    }
    public function squareup_ipn_for_subscription()
    {
        $squareup = XgPaymentGateway::squareup();
        $squareup->setLocationId(get_static_option('squareup_location_id') ?? '');
        $squareup->setAccessToken(get_static_option('squareup_access_token') ?? '');
        $squareup->setApplicationId(get_static_option('squareup_application_id') ?? '');
        $squareup->setEnv(get_static_option('squareup_test_mode') == 'on' ? true : false);
        $payment_data = $squareup->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $user_id = session()->get('user_id');
            $user_type = session()->get('user_type');
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_jobs_mail($order_id,$user_id);
            toastr_success('Subscription purchase success');
            return redirect()->route($user_type.'.'.'subscriptions.all');
        }
        return $this->cancel_page();
    }
    public function cinetpay_ipn_for_subscription()
    {
        $cinetpay = XgPaymentGateway::cinetpay();
        $cinetpay->setAppKey(get_static_option('cinetpay_app_key') ?? '');
        $cinetpay->setSiteId(get_static_option('cinetpay_site_id'));
        $cinetpay->setEnv(get_static_option('cinetpay_test_mode') == 'on' ? true : false);

        $payment_data = $cinetpay->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $user_id = session()->get('user_id');
            $user_type = session()->get('user_type');
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_jobs_mail($order_id,$user_id);
            toastr_success('Subscription purchase success');
            return redirect()->route($user_type.'.'.'subscriptions.all');
        }
        return $this->cancel_page();
    }
    public function paytabs_ipn_for_subscription()
    {
        $paytabs = XgPaymentGateway::paytabs();
        $paytabs->setProfileId(get_static_option('paytabs_profile_id') ?? '');
        $paytabs->setRegion(get_static_option('paytabs_region') ?? '');
        $paytabs->setServerKey(get_static_option('paytabs_server_key') ?? '');
        $paytabs->setEnv(get_static_option('paytabs_test_mode') == 'on' ? true : false);
        $payment_data = $paytabs->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $user_id = session()->get('user_id');
            $user_type = session()->get('user_type');
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_jobs_mail($order_id,$user_id);
            toastr_success('Subscription purchase success');
            return redirect()->route($user_type.'.'.'subscriptions.all');
        }
        return $this->cancel_page();
    }
    public function billplz_ipn_for_subscription()
    {
        $billplz = XgPaymentGateway::billplz();
        $billplz->setKey(get_static_option('billplz_key') ?? '');
        $billplz->setVersion('v4');
        $billplz->setXsignature(get_static_option('billplz_xsignature') ?? '');
        $billplz->setCollectionName(get_static_option('billplz_collection_name') ?? '');
        $billplz->setEnv(get_static_option('billplz_test_mode') == 'on' ? true : false);
        $payment_data = $billplz->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $user_id = session()->get('user_id');
            $user_type = session()->get('user_type');
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_jobs_mail($order_id,$user_id);
            toastr_success('Subscription purchase success');
            return redirect()->route($user_type.'.'.'subscriptions.all');
        }
        return $this->cancel_page();
    }
    public function zitopay_ipn_for_subscription()
    {
        $zitopay = XgPaymentGateway::zitopay();
        $zitopay->setUsername(get_static_option('zitopay_username') ?? '');
        $zitopay->setEnv(get_static_option('zitopay_test_mode') == 'on' ? true : false);
        $payment_data = $zitopay->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $user_id = session()->get('user_id');
            $user_type = session()->get('user_type');
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_jobs_mail($order_id,$user_id);
            toastr_success('Subscription purchase success');
            return redirect()->route($user_type.'.'.'subscriptions.all');
        }
        return $this->cancel_page();
    }
    public function toyyibpay_ipn_for_subscription()
    {
        $toyyibpay = XgPaymentGateway::toyyibpay();
        $toyyibpay->setUserSecretKey(get_static_option('toyyibpay_secrect_key') ?? '');
        $toyyibpay->setCategoryCode(get_static_option('toyyibpay_category_code') ?? '');
        $toyyibpay->setEnv(get_static_option('toyyibpay_test_mode') == 'on' ? true : false);
        $payment_data = $toyyibpay->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $user_id = session()->get('user_id');
            $user_type = session()->get('user_type');
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_jobs_mail($order_id,$user_id);
            toastr_success('Subscription purchase success');
            return redirect()->route($user_type.'.'.'subscriptions.all');
        }
        return $this->cancel_page();
    }
    public function authorizenet_ipn_for_subscription()
    {
        $authorizenet = XgPaymentGateway::authorizenet();
        $authorizenet->setMerchantLoginId(get_static_option('authorize_dot_net_login_id') ?? '');
        $authorizenet->setMerchantTransactionId(get_static_option('authorize_dot_net_transaction_id') ?? '');
        $authorizenet->setEnv(get_static_option('authorize_dot_net_test_mode') == 'on' ? true : false);

        $payment_data = $authorizenet->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $user_id = session()->get('user_id');
            $user_type = session()->get('user_type');
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_jobs_mail($order_id,$user_id);
            toastr_success('Subscription purchase success');
            return redirect()->route($user_type.'.'.'subscriptions.all');
        }
        return $this->cancel_page();
    }
    public function pagali_ipn_for_subscription()
    {
        $pagalipay = XgPaymentGateway::pagalipay();
        $pagalipay->setPageId(get_static_option('pagali_page_id') ?? '');
        $pagalipay->setEntityId(get_static_option('pagali_entity_id') ?? '');
        $pagalipay->setEnv(get_static_option('pagali_test_mode') == 'on' ? true : false);
        $payment_data = $pagalipay->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $user_id = session()->get('user_id');
            $user_type = session()->get('user_type');
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_jobs_mail($order_id,$user_id);
            toastr_success('Subscription purchase success');
            return redirect()->route($user_type.'.'.'subscriptions.all');
        }
        return $this->cancel_page();
    }
    public function siteways_ipn_for_subscription()
    {
        $sitesway = XgPaymentGateway::sitesway();
        $sitesway->setBrandId(get_static_option('sitesway_brand_id') ?? '');
        $sitesway->setApiKey(get_static_option('sitesway_api_key') ?? '');
        $sitesway->setEnv(get_static_option('sitesway_test_mode') == 'on' ? true : false);
        $payment_data = $sitesway->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $user_id = session()->get('user_id');
            $user_type = session()->get('user_type');
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_jobs_mail($order_id,$user_id);
            toastr_success('Subscription purchase success');
            return redirect()->route($user_type.'.'.'subscriptions.all');
        }
        return $this->cancel_page();
    }

    public function iyzipay_ipn_for_subscription()
    {
        $iyzipay = XgPaymentGateway::iyzipay();
        $iyzipay->setSecretKey(get_static_option('iyzipay_secret_id') ?? '');
        $iyzipay->setApiKey(get_static_option('iyzipay_api_key') ?? '');
        $iyzipay->setEnv(get_static_option('iyzipay_test_mode') == 'on' ? true : false);
        $payment_data = $iyzipay->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $user_id = session()->get('user_id');
            $user_type = session()->get('user_type');
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_jobs_mail($order_id,$user_id);
            toastr_success('Subscription purchase success');
            return redirect()->route($user_type.'.'.'subscriptions.all');
        }
        return $this->cancel_page();
    }

    public function kineticpay_ipn_for_subscription()
    {
        $kineticpay = XgPaymentGateway::kineticpay();
        $kineticpay->setMerchantKey(get_static_option('kineticpay_merchant_key') ?? '');
        $kineticpay->setCurrency(self::globalCurrency());
        $kineticpay->setEnv(get_static_option('kineticpay_test_mode') == 'on' ? true : false); // this must be type of boolean , string will not work
        $kineticpay->setExchangeRate(self::usdConversionValue()); // if INR not set as currency
        $payment_data = $kineticpay->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $user_id = session()->get('user_id');
            $user_type = session()->get('user_type');
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_jobs_mail($order_id,$user_id);
            toastr_success('Subscription purchase success');
            return redirect()->route($user_type.'.'.'subscriptions.all');
        }
        return $this->cancel_page();
    }

    public function awdpay_ipn_for_subscription()
    {
        $awdpay = XgPaymentGateway::awdpay();
        $awdpay->setPrivateKey(get_static_option('awdpay_private_key') ?? '');
        $awdpay->setLogoUrl(get_static_option('awdpay_logo_url') ?? '');
        $awdpay->setEnv(get_static_option('awdpay_test_mode') == 'on' ? true : false);
        $awdpay->setCurrency(self::globalCurrency());
        $payment_data = $awdpay->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $user_id = session()->get('user_id');
            $user_type = session()->get('user_type');
            $this->update_database($order_id, $payment_data['transaction_id']);
            $this->send_jobs_mail($order_id,$user_id);
            toastr_success('Subscription purchase success');
            return redirect()->route($user_type.'.'.'subscriptions.all');
        }
        return $this->cancel_page();
    }


    public function send_jobs_mail($last_subscription_id,$user_id)
    {
        if(empty($last_subscription_id)){ return redirect()->route('homepage');}

        $user = User::select(['id','first_name','last_name','email'])->where('id',$user_id)->first();

        //Send subscription email to admin
        try {
            $message = get_static_option('user_subscription_purchase_admin_email_message') ?? __('A user just purchase a subscription.');
            $message = str_replace(["@name","@subscription_id"],[$user->first_name.' '.$user->last_name, $last_subscription_id], $message);
            Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                'subject' => get_static_option('user_subscription_purchase_admin_email_subject') ?? __('Subscription purchase email'),
                'message' => $message
            ]));
        } catch (\Exception $e) {}

        //Send subscription email to user
        try {
            $message = get_static_option('user_subscription_purchase_message') ?? __('Your subscription purchase successfully completed.');
            $message = str_replace(["@name","@subscription_id"],[$user->first_name.' '.$user->last_name, $last_subscription_id], $message);
            Mail::to($user->email)->send(new BasicMail([
                'subject' => get_static_option('user_subscription_purchase_subject') ?? __('Subscription purchase email'),
                'message' => $message
            ]));
        } catch (\Exception $e) {}
    }
    private function update_database($last_subscription_id, $transaction_id)
    {
        $subscription_details = UserSubscription::find($last_subscription_id);
        UserSubscription::where('id', $last_subscription_id)->where('user_id',$subscription_details->user_id)
            ->update([
                'payment_status' => 'complete',
                'status' => 1,
                'transaction_id' => $transaction_id,
            ]);

        AdminNotification::create([
            'identity'=>$last_subscription_id,
            'user_id'=>$subscription_details->user_id,
            'type'=>__('Buy Subscription'),
            'message'=>__('User subscription purchase'),
        ]);
    }
}
