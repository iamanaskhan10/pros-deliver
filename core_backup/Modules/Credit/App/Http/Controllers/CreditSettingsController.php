<?php

namespace Modules\Credit\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CreditSettingsController extends Controller
{
    public function influencer_contact_info_settings(Request $request)
    {
        // Handle GET: show form
        if ($request->isMethod('get')) {
            return view('credit::backend.influencer-contact-info-settings');
        }

        // Handle POST: save settings
        $validator = Validator::make($request->all(), [
            'contact_visibility' => 'required|in:free,paid',
            'credits_per_unlock' => 'required_if:contact_visibility,paid|integer|min:1',
            'credit_price_usd' => 'required_if:contact_visibility,paid|numeric|min:0.01|max:9999.99',
            'min_credits_purchase' => 'required_if:contact_visibility,paid|integer|min:1|max:10000',
        ]);

        // Custom error messages (optional but helpful)
        $validator->setAttributeNames([
            'contact_visibility' => __('Contact Info Visibility'),
            'credits_per_unlock' => __('Credits Required per Influencer'),
            'credit_price_usd' => __('Credit Unit Price (USD)'),
            'min_credits_purchase' => __('Minimum Purchase Amount'),
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Save global settings
        $settings = [
            'influencer_contact_visibility'    => $request->contact_visibility,
        ];

        // Only save credit-related fields if mode is "paid"
        if ($request->contact_visibility === 'paid') {
            $settings['influencer_credits_per_unlock'] = (int) $request->credits_per_unlock;
            $settings['credit_price_usd']               = round((float) $request->credit_price_usd, 2);
            $settings['min_credits_purchase']           = (int) $request->min_credits_purchase;
        }

        foreach ($settings as $key => $value) {
            update_static_option($key, $value);
        }

        toastr_success(__('Influencer Contact Info Settings Updated Successfully.'));
        return back();
    }

}
