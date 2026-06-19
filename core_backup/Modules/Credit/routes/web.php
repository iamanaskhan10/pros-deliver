<?php

use Illuminate\Support\Facades\Route;
use Modules\Credit\App\Http\Controllers\AdminCreditController;
use Modules\Credit\App\Http\Controllers\ClientCreditDepositController;
use Modules\Credit\App\Http\Controllers\CreditController;
use Modules\Credit\App\Http\Controllers\CreditSettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['as' => 'admin.', 'prefix' => 'admin/credit', 'middleware' => ['auth:admin', 'setlang']], function () {
    Route::controller('CreditSettingsController')->group(function () {
        Route::match(['get','post'],'influencer-contact-info-settings','influencer_contact_info_settings')->name('influencer.contact.info.settings');
    });

    Route::controller(AdminCreditController::class)->group(function () {
        Route::get('credit/history','credit_history')->name('credit.history')->permission('credit-list');
        Route::get('credit/details/{id}','credit_history_details')->name('credit.history.details')->permission('credit-history-details');
        Route::post('credit/change-status/{id}','credit_change_status')->name('credit.history.status')->permission('credit-complete-manual-deposit-status');
        Route::get('credit/paginate/data', 'pagination')->name('credit.paginate.data');
        Route::get('credit/search-history', 'credit_search_history')->name('credit.search');
    });
});

Route::group(['prefix'=>'client/credit','as'=>'client.','middleware'=>['auth','userEmailVerify','Google2FA','globalVariable', 'maintains_mode','setlang']],function() {
    Route::controller(CreditController::class)->group(function () {
        Route::get('history','credit_history')->name('credit.history');
        Route::get('paginate/data', 'pagination')->name('credit.paginate.data');
//        Route::get('search-history', 'search_history')->name('wallet.search');
        Route::post('deposit', 'deposit')->name('credit.deposit');
        Route::post('unlock-influencer', 'unlock_influencer')->name('credit.unlock.influencer');
        Route::get('credit-cancel-static','credit_payment_cancel_static')->name('credit.buy.payment.cancel.static');
    });

    Route::controller(ClientCreditDepositController::class)->group(function () {
        Route::get('paypal-ipn','paypal_ipn_for_credit')->name('paypal.ipn.credit');
        Route::post('paytm-ipn','paytm_ipn_for_credit')->name('paytm.ipn.credit');
        Route::get('mollie/ipn','mollie_ipn_for_credit')->name('mollie.ipn.credit');
        Route::get('stripe/ipn','stripe_ipn_for_credit')->name('stripe.ipn.credit');
        Route::post('razorpay-ipn','razorpay_ipn_for_credit')->name('razorpay.ipn.credit');
        Route::get('flutterwave/ipn','flutterwave_ipn_for_credit')->name('flutterwave.ipn.credit');
        Route::get('midtrans-ipn','midtrans_ipn_for_credit')->name('midtrans.ipn.credit');
        Route::get('payfast-ipn','payfast_ipn_for_credit')->name('payfast.ipn.credit');
        Route::get('cashfree-ipn','cashfree_ipn_for_credit')->name('cashfree.ipn.credit');
        Route::get('instamojo-ipn','instamojo_ipn_for_credit')->name('instamojo.ipn.credit');
        Route::get('marcadopago-ipn','marcadopago_ipn_for_credit')->name('marcadopago.ipn.credit');
        Route::get('squareup-ipn','squareup_ipn_for_credit' )->name('squareup.ipn.credit');
        Route::post('cinetpay-ipn', 'cinetpay_ipn_for_credit' )->name('cinetpay.ipn.credit');
        Route::post('paytabs-ipn','paytabs_ipn_for_credit' )->name('paytabs.ipn.credit');
        Route::post('billplz-ipn','billplz_ipn_for_credit' )->name('billplz.ipn.credit');
        Route::post('zitopay-ipn','zitopay_ipn_for_credit' )->name('zitopay.ipn.credit');
        Route::post('toyyibpay-ipn','toyyibpay_ipn_for_credit' )->name('toyyibpay.ipn.credit');
        Route::get('authorize-ipn','authorizenet_ipn_for_credit' )->name('authorize.ipn.credit');
        Route::post('pagali-ipn','pagali_ipn_for_credit' )->name('pagali.ipn.credit');
        Route::post('siteways-ipn','siteways_ipn_for_credit' )->name('siteways.ipn.credit');
        Route::post('iyzipay-ipn','iyzipay_ipn_for_credit' )->name('iyzipay.ipn.credit');
        Route::post('kineticpay-ipn','kineticpay_ipn_for_credit' )->name('kineticpay.ipn.credit');
        Route::post('awdpay-ipn','awdpay_ipn_for_credit' )->name('awdpay.ipn.credit');
    });
});
