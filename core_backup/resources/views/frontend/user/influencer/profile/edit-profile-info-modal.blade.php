<!-- Profile Settings Popup Starts -->
<div class="popup-overlay"></div>
<form id="edit_profile_form" method="post">
    @csrf
    <div class="popup-fixed profile-popup">
        <div class="popup-contents">
            <span class="popup-contents-close popup-close"> <i class="fas fa-times"></i> </span>
            <h2 class="popup-contents-title"> {{ __('Personal Information') }} </h2>
            <x-notice.general-notice :description="__('Notice: Except state and city all fields are required. Your identity verify documents info must be similar your personal info.')" />
            <div class="popup-contents-form custom-form profile-border-top">
                <div class="error_msg_container"></div>
                <div class="single-flex-input">
                    <x-form.text :title="__('First Name')" :type="__('text')" :name="'first_name'" :id="'first_name'" :placeholder="__('Type First Name')" :value="Auth::guard('web')->user()->first_name ?? '' "/>
                    <x-form.text :title="__('Last Name')" :type="__('text')" :name="'last_name'" :id="'last_name'" :placeholder="__('Type Last Name')" :value="Auth::guard('web')->user()->last_name ?? '' "/>
                </div>
                <div class="single-flex-input">
                    <x-form.email :title="__('Your Email')" :type="__('email')" :name="'email'" :id="'email'" :placeholder="__('Type Email')" :value="Auth::guard('web')->user()->email ?? '' "/>
                    <x-form.text :title="__('Professional Title')" :type="__('text')" :name="'github_id'" :id="'github_id'" :placeholder="__('Type Professional Title')" :value="Auth::guard('web')->user()->github_id ?? '' "/>
                </div>

                <div id="phone_number_container">
                    @php
                        $isPhoneEditable = !empty(get_static_option('user_edit_phone_enable'));
                    @endphp

                    <x-form.phone
                            :title="__('Your Phone')"
                            :type="__('tel')"
                            :name="'phone_number'"
                            :id="'phone_number'"
                            :placeholder="__('Type Phone number')"
                            :value="Auth::guard('web')->user()->phone ?? ''"
                            :class="$isPhoneEditable ? 'is-required' : ''"
                            :readonly="!$isPhoneEditable"
                            :disabled="!$isPhoneEditable"
                            :style="!$isPhoneEditable ? 'background-color: #e9ecef; cursor: not-allowed;' : ''"
                    />

                    @if(!$isPhoneEditable)
                        <small class="text-muted d-block mt-1">
                            <i class="fas fa-lock"></i> {{ __('Phone number editing is disabled.') }}
                        </small>
                    @endif

                    <span id="phone_number_availability"></span>
                </div>

                @if(get_static_option('phone_otp_verify') == 'on')
                    <div id="phone_verification_wrapper" style="margin-top: 10px;"></div>
                    
                    <!-- Templates for JS to inject/show -->
                    <div id="phone_verification_templates" style="display: none;">
                        <button type="button" id="btn_send_otp" class="btn btn-sm btn-info mt-2">{{ __('Send OTP') }}</button>
                        
                        <div id="otp_input_group" class="mt-3">
                            <label class="label-title">{{ __('Enter OTP') }}</label>
                            <div class="d-flex" style="gap: 10px;">
                                <input type="text" id="phone_otp_input" class="form-control" placeholder="123456" style="max-width: 150px;">
                                <button type="button" id="btn_verify_otp" class="btn btn-sm btn-success">{{ __('Verify') }}</button>
                            </div>
                            <div class="mt-2">
                                <span id="otp_timer" class="text-muted small"></span>
                                <a href="javascript:void(0)" id="btn_resend_otp_new" class="text-primary small ml-2" style="display: none;">{{ __('Resend OTP') }}</a>
                            </div>
                        </div>

                        <div id="phone_verified_badge" class="mt-2 text-success" style="font-weight: bold; display: flex; align-items: center; gap: 5px;">
                            <i class="fas fa-check-circle"></i> {{ __('Phone Verified') }}
                        </div>
                    </div>
                @endif

                <div class="single-flex-input">
                    <x-form.country-dropdown :title="__('Select Your Country')" :id="'country_id'"/>
                </div>
                <div class="single-flex-input">
                    <x-form.state-dropdown :title="__('Select Your State')" :id="'state_id'"/>
                    <x-form.city-dropdown :title="__('Select Your City')" :id="'city_id'"/>
                </div>
            </div>
            <div class="popup-contents-btn flex-btn profile-border-top justify-content-end">
                <a href="javascript:void(0)" class="btn-profile btn-outline-gray btn-hover-danger color-one popup-close"> <i class="las la-arrow-left"></i> {{__('Cancel')}} </a>
                <button type="submit" class="btn-profile btn-bg-1">{{ __('Update Profile') }}</button>
            </div>
        </div>
    </div>
</form>
</div>
<!-- Profile Settings Popup Ends -->
