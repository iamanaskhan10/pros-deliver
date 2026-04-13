<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserEmailandPhoneVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth('web')->check()) {
            $user = auth('web')->user();

            // Phone verification check (if globally enabled)
            if (get_static_option('phone_otp_verify') === 'on') {
                if (empty($user->phone_otp_verify) || $user->phone_otp_verify != 1) {
                    toastr_warning('Please verify your phone number to continue.');
                    return redirect()->route('email.verify');
                }
            }

            // Email verification check
            // Check if email verification is disabled in settings. If disabled, skip the check.
            if (!empty(get_static_option('user_email_verify_settings_enable_disable')) && get_static_option('user_email_verify_settings_enable_disable') == 'disable') {
                // Verification is disabled, do nothing
            } else {
                // Verification is enabled (or setting is missing), so check the user status
                if (isset($user->is_email_verified) && $user->is_email_verified == 0) {
                    toastr_warning('Please verify your email to continue.');
                    return redirect()->route('email.verify');
                }
            }
        }

        return $next($request);
    }
}