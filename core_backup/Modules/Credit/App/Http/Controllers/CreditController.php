<?php

namespace Modules\Credit\App\Http\Controllers;

use App\Helper\PaymentGatewayRequestHelper;
use App\Http\Controllers\Controller;
use App\Mail\BasicMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Modules\Credit\App\Models\Credit;
use Modules\Credit\App\Models\UserCredit;
use App\Models\User;
use Modules\Credit\App\Services\CreditLogicService;

class CreditController extends Controller
{
    private const CANCEL_ROUTE = 'client.credit.buy.payment.cancel.static';

    public function credit_payment_cancel_static()
    {
        return view('credit::client.credit.cancel');
    }

    //display credit history
    public function credit_history()
    {
        $user = Auth::guard('web')->user();
        $userId = $user->id;

        // ✅ Get credit purchase history (latest first)
        $creditPurchases = Credit::where('user_id', $userId)
            ->latest()
            ->paginate(10);

        // ✅ Get current credit balance (safe fallback to 0)
        $creditBalance = $user->getCreditBalanceAttribute();

        return view('credit::client.credit.credit-history', compact(
            'creditPurchases',
            'creditBalance'
        ));
    }

    // pagination
    function pagination(Request $request)
    {
        if($request->ajax()){
            $user_id = Auth::guard('web')->user()->id;
            $creditPurchases = Credit::where('user_id',$user_id)->latest()->paginate(10);
            return view('credit::client.credit.search-result', compact('creditPurchases'))->render();
        }
    }

    // search history
    public function search_history(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $search = trim(strip_tags($request->string_search));

        $creditPurchases = Credit::where('user_id', $userId)
            ->where(function ($query) use ($search) {
                $query->where('created_at', 'LIKE', "%{$search}%")
                    ->orWhere('payment_gateway', 'LIKE', "%{$search}%")
                    ->orWhere('transaction_id', 'LIKE', "%{$search}%")
                    ->orWhere('payment_status', 'LIKE', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        if ($creditPurchases->total() >= 1) {
            return view('credit::client.credit.search-result', compact('creditPurchases'))->render();
        }

        return response()->json(['status' => 'nothing']);
    }


    //deposit balance to credit
    public function deposit(Request $request)
    {
        $min_credits = (int) get_static_option('min_credits_purchase', 5);
        $request->validate([
            'credits' => 'required|numeric|min:' . $min_credits,
        ]);

        if($request->selected_payment_gateway === 'manual_payment') {
            $request->validate([
                'manual_payment_image' => 'required|mimes:jpg,jpeg,png,pdf'
            ]);
        }

        $user = Auth::guard('web')->user();
        $user_id = $user->id;
        session()->put('user_id',$user_id);
        
        $credits = (int)$request->credits;
        $credit_price = (float) get_static_option('credit_price_usd', 10);
        $total = $credits * $credit_price;

        $name = $user->first_name.' '.$user->last_name;
        $email = $user->email;
        $user_type = $user->user_type == 1 ? 'client' : 'influencer';
        $payment_status = $request->selected_payment_gateway === 'manual_payment' ? 'pending' : '';
        
        // Ensure user has a UserCredit record
        $user_credit = UserCredit::firstOrCreate(
            ['user_id' => $user_id],
            ['credit_balance' => 0]
        );

        $deposit = Credit::create([
            'user_id' => $user_id,
            'credits' => $credits,
            'payment_gateway' => $request->selected_payment_gateway,
            'payment_status' => $payment_status,
            'status' => 1,
        ]);

        $last_deposit_id = $deposit->id;
        $title = __('Buy Credits');
        $description = sprintf(__('Order id #%1$d Email: %2$s, Name: %3$s, Credits: %4$d'),$last_deposit_id,$email,$name, $credits);

        if($request->selected_payment_gateway === 'manual_payment') {
            if($request->hasFile('manual_payment_image')){
                $manual_payment_image = $request->manual_payment_image;
                $img_ext = $manual_payment_image->extension();

                $manual_payment_image_name = 'manual_attachment_'.time().'.'.$img_ext;
                if(in_array($img_ext,['jpg','jpeg','png','pdf'])){
                    $manual_image_path = 'assets/uploads/manual-payment/';
                    $manual_payment_image->move($manual_image_path,$manual_payment_image_name);
                    Credit::where('id',$last_deposit_id)->update([
                        'manual_payment_image'=>$manual_payment_image_name
                    ]);
                }else{
                    return back()->with(toastr_warning(__('Image type not supported')));
                }
            }

            try {
                $message_body = __('Hello, a ').' '.$user_type. __(' just purchased credits. Please check and confirm.').'</br>'.'<span class="verify-code">'.__('Purchase ID: ').$last_deposit_id.'</span>';
                Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                    'subject' => __('Credit Purchase Confirmation'),
                    'message' => $message_body
                ]));
                Mail::to($email)->send(new BasicMail([
                    'subject' => __('Credit Purchase Confirmation'),
                    'message' => __('Manual purchase success. Your credits will be added after admin approval.').'</br>'.'<span class="verify-code">'.__('Purchase ID: ').$last_deposit_id.'</span>'
                ]));
            } catch (\Exception $e) {
                //
            }
            toastr_success('Manual purchase success. Your credits will be added after admin approval');
            return back();

        }else{
            $ipn_params = [$total, $title, $description, $last_deposit_id, $email, $name];

            if ($request->selected_payment_gateway === 'paypal') {
                try {
                    return PaymentGatewayRequestHelper::paypal()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('client.paypal.ipn.credit'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'paytm'){
                try {
                    return PaymentGatewayRequestHelper::paytm()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('client.paytm.ipn.credit'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif ($request->selected_payment_gateway === 'mollie'){
                try {
                    return PaymentGatewayRequestHelper::mollie()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('client.mollie.ipn.credit'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'stripe'){
                try {
                    return PaymentGatewayRequestHelper::stripe()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('client.stripe.ipn.credit'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'razorpay'){
                try {
                    return PaymentGatewayRequestHelper::razorpay()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('client.razorpay.ipn.credit'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'flutterwave'){
                try {
                    return PaymentGatewayRequestHelper::flutterwave()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('client.flutterwave.ipn.credit'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'paystack'){
                try {
                    return PaymentGatewayRequestHelper::paystack()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('paystack.ipn.all'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'sslcommerce'){
                try {
                    return PaymentGatewayRequestHelper::sslcommerz()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('sslcommerce.ipn.all'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'xendit'){
                try {
                    return PaymentGatewayRequestHelper::xendit()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('xendit.ipn.all'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'payfast'){
                try {
                    return PaymentGatewayRequestHelper::payfast()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('client.payfast.ipn.credit'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'cashfree'){
                try {
                    return PaymentGatewayRequestHelper::cashfree()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('client.cashfree.ipn.credit'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'instamojo'){
                try {
                    return PaymentGatewayRequestHelper::instamojo()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('client.instamojo.ipn.credit'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'marcadopago'){
                try {
                    return PaymentGatewayRequestHelper::marcadopago()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('client.marcadopago.ipn.credit'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'midtrans'){
                try {
                    return PaymentGatewayRequestHelper::midtrans()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('client.midtrans.ipn.credit'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'squareup'){
                try {
                    return PaymentGatewayRequestHelper::squareup()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('client.squareup.ipn.credit'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'cinetpay'){
                try {
                    return PaymentGatewayRequestHelper::cinetpay()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('client.cinetpay.ipn.credit'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'paytabs'){
                try {
                    return PaymentGatewayRequestHelper::paytabs()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('client.paytabs.ipn.credit'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'billplz'){
                try {
                    return PaymentGatewayRequestHelper::billplz()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('client.billplz.ipn.credit'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'zitopay'){
                try {
                    return PaymentGatewayRequestHelper::zitopay()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('client.zitopay.ipn.credit'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'toyyibpay'){
                try {
                    return PaymentGatewayRequestHelper::toyyibpay()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('client.toyyibpay.ipn.credit'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'authorize_dot_net'){
                try {
                    return PaymentGatewayRequestHelper::authorizenet()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('client.authorize.ipn.credit'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'pagali'){
                try {
                    return PaymentGatewayRequestHelper::pagalipay()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('client.pagali.ipn.credit'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'sitesway'){
                try {
                    return PaymentGatewayRequestHelper::sitesway()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('client.siteways.ipn.credit'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'iyzipay'){
                try {
                    return PaymentGatewayRequestHelper::iyzipay()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('client.iyzipay.ipn.credit'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'kineticpay'){
                try {
                    return PaymentGatewayRequestHelper::kineticpay()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('client.kineticpay.ipn.credit'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'awdpay'){
                try {
                    return PaymentGatewayRequestHelper::awdpay()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('client.awdpay.ipn.credit'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'yoomoney'){
                try {
                    return PaymentGatewayRequestHelper::yoomoney()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('yoomoney.ipn.all'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
            elseif($request->selected_payment_gateway === 'coinpayments'){
                try {
                    return PaymentGatewayRequestHelper::coinpayments()->charge_customer($this->buildPaymentArg(...$ipn_params, ipn_route: route('coinpayment.ipn.all'), source: 'client-credit'));
                }catch (\Exception $e){
                    toastr_error($e->getMessage());
                    return back();
                }
            }
        }
    }

    public function unlock_influencer(Request $request)
    {
        $request->validate([
            'influencer_id' => 'required|integer|exists:users,id'
        ]);

        $client_id = Auth::guard('web')->id();
        $influencer_id = $request->influencer_id;

        $result = CreditLogicService::unlockInfluencer($influencer_id, $client_id);

        if ($result['status']) {
            return response()->json([
                'status' => 'success',
                'message' => $result['message']
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => $result['message']
        ], 400);
    }

    private function buildPaymentArg($total,$title,$description,$last_deposit_id,$email,$name,$ipn_route,$source=null)
    {
        $type = $source == 'freelancer-credit' ? 'freelancer' : 'client';
        $redirect_route = route($type.'.credit.history');

        return [
            'amount' => $total,
            'title' => $title,
            'description' => $description,
            'ipn_url' => $ipn_route,
            'order_id' => $last_deposit_id,
            'track' => \Str::random(36),
            'cancel_url' => route(self::CANCEL_ROUTE,$last_deposit_id),
            'success_url' => $redirect_route,
            'email' => $email,
            'name' => $name,
            'payment_type' => $source,
        ];
    }
}
