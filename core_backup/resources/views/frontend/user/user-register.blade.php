@extends('frontend.layout.master')
@section('site_title', __('User Register'))
@section('style')
    <link href="{{ asset('assets/common/css/intlTelInput.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.2/build/css/intlTelInput.css">
@endsection
@section('content')
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- login Area Starts -->
    <section class="choose-account-area pat-100 pab-100 user_type_area">
        <div class="container">
            <div class="choose-account center-text">
                <h4 class="choose-account-title">
                    {{ get_static_option('register_page_choose_role_title') ?? __('Choose a Role') }}</h4>
                <p class="choose-account-para mt-2">
                    {{ get_static_option('register_page_choose_role_subtitle') ?? __('Choose a role from below to continue signing up') }}
                </p>
                <div class="choose-account-flex mt-4">
                    <div class="choose-account-single selected join_as_a_freelancer">
                        <div class="choose-account-single-thumb">
                            <svg width="46" height="30" viewBox="0 0 46 30" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.54688 5.87042C7.54688 9.10739 10.1103 11.7416 13.262 11.7416C16.4137 11.7416 18.9771 9.1082 18.9771 5.87042C18.9771 2.63263 16.4137 0 13.262 0C10.1103 0 7.54688 2.63344 7.54688 5.87042ZM17.3949 5.87042C17.3949 8.21144 15.5408 10.1171 13.2612 10.1171C10.9816 10.1171 9.12747 8.21225 9.12747 5.87042C9.12747 3.52859 10.9816 1.62458 13.2612 1.62458C15.5408 1.62458 17.3949 3.5294 17.3949 5.87042Z"
                                    fill="white" />
                                <path
                                    d="M45.2093 28.3741H35.3905L38.5533 17.7575C38.6268 17.5113 38.5817 17.2441 38.4331 17.0369C38.2844 16.8298 38.0488 16.708 37.7974 16.708H23.3246C22.2334 14.1704 19.7941 12.4922 17.056 12.4922H9.46219C5.67637 12.4922 2.59584 15.6593 2.59584 19.5518V26.3409C2.59584 26.4059 2.61798 26.4636 2.63221 26.5245C2.69625 27.2093 2.92397 27.8428 3.29244 28.3749H0.79069C0.353439 28.3749 0 28.7388 0 29.1872C0 29.6356 0.353439 29.9995 0.79069 29.9995H45.2093C45.6466 29.9995 46 29.6356 46 29.1872C46 28.7388 45.6466 28.3741 45.2093 28.3741ZM4.17722 19.5518C4.17722 16.5553 6.54771 14.1168 9.46219 14.1168H17.056C18.9189 14.1168 20.6006 15.1281 21.5495 16.708H20.7422C20.3951 16.708 20.0883 16.9411 19.9863 17.2831L16.6828 28.3733H15.8217C16.1364 27.8388 16.2922 27.2304 16.259 26.6017C16.2163 25.8097 15.8913 25.064 15.3449 24.5027C14.7527 23.8935 13.9652 23.5588 13.127 23.5588H9.38866V20.2236C9.38866 19.7752 9.03522 19.4113 8.59797 19.4113C8.16072 19.4113 7.80728 19.7752 7.80728 20.2236V23.8951C7.80728 24.6059 8.37025 25.1842 9.0621 25.1842H13.127C13.5422 25.1842 13.9328 25.3507 14.2269 25.6521C14.4981 25.9307 14.6594 26.3003 14.68 26.6918C14.7013 27.102 14.5534 27.5025 14.2617 27.8185C13.9367 28.1718 13.4797 28.3741 13.0084 28.3741H6.33422C5.14581 28.3741 4.1788 27.3806 4.1788 26.1598V19.5526L4.17722 19.5518ZM18.3345 28.3741L21.3257 18.3326H36.7276L33.7364 28.3741H18.3345Z"
                                    fill="white" />
                            </svg>
                            <div class="rounded-select"></div>
                        </div>
                        <div class="choose-account-single-contents mt-3">
                            <h6 class="choose-account-single-contents-title">
                                {{ get_static_option('register_page_choose_join_freelancer_title') ?? __('Join as a Influencer') }}
                            </h6>
                        </div>
                    </div>
                    <div class="choose-account-single join_as_a_client">
                        <div class="choose-account-single-thumb">
                            <svg width="46" height="30" viewBox="0 0 46 30" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M38.1918 12.2906C39.9821 11.0545 41.1531 9.0541 41.1531 6.79426C41.1531 3.04776 37.9485 0 34.0092 0C30.0698 0 26.8652 3.04776 26.8652 6.79426C26.8652 9.0541 28.0362 11.0545 29.8257 12.2898C26.2335 12.9561 23.3552 15.5233 22.3849 18.8416L21.1704 15.415C21.0643 15.115 20.7682 14.913 20.4357 14.913H0.774687C0.525136 14.913 0.29031 15.0273 0.145384 15.2204C-0.000316515 15.4135 -0.0390667 15.6611 0.0407587 15.886L4.87445 29.4988C4.98063 29.7988 5.27591 30 5.60838 30H40.3316C43.4572 30 46 27.5817 46 24.6091V21.3034C46 16.8405 42.6349 13.1146 38.1918 12.2906ZM33.4651 16.4557H34.5509L36.3644 23.4652H31.657L33.4651 16.4557ZM34.6485 14.9816H33.3674L32.7374 13.5907H35.2778L34.6485 14.9816ZM28.4152 6.79426C28.4152 3.86074 30.9246 1.47413 34.0092 1.47413C37.0937 1.47413 39.6031 3.86074 39.6031 6.79426C39.6031 9.72778 37.0937 12.1144 34.0092 12.1144C30.9246 12.1144 28.4152 9.72778 28.4152 6.79426ZM23.5745 22.1967V21.2953C23.5745 17.2436 26.8822 13.9202 31.0634 13.6202L32.043 15.7828L29.9605 23.8551C28.8724 24.4042 28.1207 25.4825 28.1207 26.7363C28.1207 27.3805 28.3199 27.9974 28.6888 28.5259H25.8189L25.5694 27.8227L23.5761 22.196L23.5745 22.1967ZM1.85427 16.3879H19.8801L23.3335 26.1319L24.1821 28.5266H6.16483L1.85427 16.3879ZM44.45 24.6098C44.45 26.7694 42.6024 28.5266 40.3316 28.5266H31.5516C31.0541 28.5266 30.5829 28.3394 30.2248 27.9981C29.8668 27.6583 29.6699 27.2102 29.6699 26.737C29.6699 25.7457 30.5139 24.9393 31.5516 24.9393H37.833C38.9854 24.9393 39.9232 24.0475 39.9232 22.9515V21.0587C39.9232 20.6518 39.576 20.3216 39.1482 20.3216C38.7204 20.3216 38.3732 20.6518 38.3732 21.0587V22.9515C38.3732 23.1984 38.1949 23.3893 37.9547 23.4423L35.973 15.7828L36.9518 13.6202C41.1376 13.9195 44.4492 17.2473 44.4492 21.3034V24.6091L44.45 24.6098Z"
                                    fill="white" />
                            </svg>
                            <div class="rounded-select"></div>
                        </div>
                        <div class="choose-account-single-contents mt-3">
                            <h6 class="choose-account-single-contents-title">
                                {{ get_static_option('register_page_choose_join_client_title') ?? __('Join as a Client') }}
                            </h6>
                        </div>
                    </div>
                </div>

                <div class="btn-wrapper mt-4 text-center">
                    <span
                        class="inf-cmn-btn style3 btn-profile btn-bg-1 continue_to_info">{{ get_static_option('register_page_continue_button_title') ?? __('Continue') }}</span>
                </div>
                <div class="mt-3 fw_medium black_text">{{ __('Already have an account') }} <a
                        href="{{ route('user.login') }}" class="primary_text">{{ __('Sign In') }}</a></div>

                {{-- Social login --}}
                @if (get_static_option('login_page_social_login_enable_disable') == 'on')
                    <div class="login-bottom-contents">
                        <div class="or-contents mb-3">
                            <span class="or-contents-para"> {{ __('Or') }} </span>
                        </div>
                        <div class="login-others">
                            <div class="login-others-single">
                                <a href="{{ route('login.google.redirect') }}" data-provider="google"
                                    class="login-others-single-btn w-100 social-login-btn">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_2075_2826)">
                                            <path
                                                d="M4.43242 12.0855L3.73625 14.6845L1.19176 14.7383C0.431328 13.3279 0 11.7141 0 9.9993C0 8.34105 0.403281 6.77731 1.11813 5.40039H1.11867L3.38398 5.8157L4.37633 8.06742C4.16863 8.67293 4.05543 9.32293 4.05543 9.9993C4.05551 10.7334 4.18848 11.4367 4.43242 12.0855Z"
                                                fill="#FBBB00" />
                                            <path
                                                d="M19.8242 8.13281C19.939 8.73773 19.9989 9.36246 19.9989 10.0009C19.9989 10.7169 19.9236 11.4152 19.7802 12.0889C19.2934 14.3812 18.0214 16.3828 16.2594 17.7993L16.2588 17.7987L13.4055 17.6532L13.0017 15.1323C14.1709 14.4466 15.0847 13.3735 15.566 12.0889H10.2188V8.13281H15.644H19.8242Z"
                                                fill="#518EF8" />
                                            <path
                                                d="M16.2595 17.7975L16.2601 17.798C14.5464 19.1755 12.3694 19.9996 9.99965 19.9996C6.19141 19.9996 2.88043 17.8711 1.19141 14.7387L4.43207 12.0859C5.27656 14.3398 7.45074 15.9442 9.99965 15.9442C11.0952 15.9442 12.1216 15.648 13.0024 15.131L16.2595 17.7975Z"
                                                fill="#28B446" />
                                            <path
                                                d="M16.382 2.30219L13.1425 4.95438C12.2309 4.38461 11.1534 4.05547 9.99906 4.05547C7.39246 4.05547 5.17762 5.73348 4.37543 8.06813L1.11773 5.40109H1.11719C2.78148 2.19231 6.13422 0 9.99906 0C12.4254 0 14.6502 0.864297 16.382 2.30219Z"
                                                fill="#F14336" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_2075_2826">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span class="login-para"> {{ __('Sign In With Google') }} </span>
                                </a>
                            </div>
                            <div class="login-others-single">
                                <a href="{{ route('login.facebook.redirect') }}" data-provider="facebook"
                                    class="login-others-single-btn w-100 social-login-btn">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_2082_2663)">
                                            <path
                                                d="M14 7C14 10.494 11.4401 13.39 8.09375 13.915V9.02344H9.7248L10.0352 7H8.09375V5.68695C8.09375 5.13324 8.365 4.59375 9.23453 4.59375H10.1172V2.87109C10.1172 2.87109 9.31602 2.73438 8.55012 2.73438C6.95133 2.73438 5.90625 3.70344 5.90625 5.45781V7H4.12891V9.02344H5.90625V13.915C2.55992 13.39 0 10.494 0 7C0 3.13414 3.13414 0 7 0C10.8659 0 14 3.13414 14 7Z"
                                                fill="#1877F2" />
                                            <path
                                                d="M9.7248 9.02344L10.0352 7H8.09375V5.68693C8.09375 5.13335 8.36495 4.59375 9.2345 4.59375H10.1172V2.87109C10.1172 2.87109 9.31613 2.73438 8.55025 2.73438C6.9513 2.73438 5.90625 3.70344 5.90625 5.45781V7H4.12891V9.02344H5.90625V13.9149C6.26265 13.9709 6.62791 14 7 14C7.37209 14 7.73735 13.9709 8.09375 13.9149V9.02344H9.7248Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_2082_2663">
                                                <rect width="14" height="14" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span class="login-para"> {{ __('Sign In With Facebook') }} </span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>

    <section class="login-area pat-100 pab-100 user_info_area">
        <div class="container">
            <div class="row gy-5 justify-content-between">
                <div class="col-lg-5">
                    <div class="login-wrapper">
                        <div class="login-wrapper-contents">
                            <h3 class=" inf-title login-wrapper-contents-title">
                                {{ get_static_option('register_page_title') ?? __('Register') }}</h3>

                            <div class="error-message"></div>

                            <form class="login-wrapper-form custom-form" method="post"
                                action="{{ route('user.register') }}">
                                @csrf
                                <input type="hidden" name="user_type" id="user_type" value="2">
                                <div class="input-flex-item">
                                    <div class="single-input mt-4">
                                        <label class="label-title mb-2"> {{ __('First Name') }} </label>
                                        <input class="form--control is-required" type="text" name="first_name"
                                            id="first_name" placeholder="{{ __('Type First Name') }}">
                                    </div>
                                    <div class="single-input mt-4">
                                        <label class="label-title mb-2"> {{ __('Last Name') }} </label>
                                        <input class="form--control is-required" type="text" name="last_name"
                                            id="last_name" placeholder="{{ __('Type Last Name') }}">
                                    </div>
                                </div>
                                <div class="single-input mt-4">
                                    <label class="label-title mb-2"> {{ __('User Name') }} </label>
                                    <input class="form--control is-required" type="text" name="username"
                                        id="username" placeholder="{{ __('Type User Name') }}">
                                    <span id="user_name_availability"></span>
                                </div>
                                <div class="single-input mt-0">
                                    <label class="label-title mb-2"> {{ __('Email Address') }} </label>
                                    <input class="form--control is-required" type="text" name="email"
                                        id="email" placeholder="{{ __('Type Email') }}">
                                    <span id="email_availability"></span>
                                </div>

                                <div class="single-input mt-0" id="phone_number_container">
                                    <label class="label-title mb-2">{{ __('Phone Number') }}</label>
                                    <input class="form--control is-required" type="tel" name="phone_number"
                                        id="phone_number" placeholder="">
                                    <span id="phone_number_availability"></span>
                                </div>

                                <div class="input-flex-item">
                                    <div class="single-input mt-0">
                                        <label class="label-title mb-2"> {{ __('Create Password') }} </label>
                                        <div class="single-input-inner">
                                            <input class="form--control is-required" type="password" name="password"
                                                id="password" placeholder="{{ __('Type Password') }}">
                                            <div class="icon toggle-password">
                                                <div class="show-icon"> <i class="fa-regular fa-eye-slash"></i> </div>
                                                <span class="hide-icon"> <i class="fa-regular fa-eye"></i> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-input mt-0">
                                        <label class="label-title mb-2"> {{ __('Confirm Password') }} </label>
                                        <div class="single-input-inner">
                                            <input class="form--control is-required" type="password"
                                                name="confirm_password" id="confirm_password"
                                                placeholder="{{ __('Confirm Password') }}">
                                            <div class="icon toggle-password">
                                                <div class="show-icon"> <i class="fa-regular fa-eye-slash"></i> </div>
                                                <span class="hide-icon"> <i class="fa-regular fa-eye"></i> </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span id="check_password_match"></span>
                                <br>
                                <input type="checkbox" class="form-check-input is-required" id="terms_condition"
                                    name="terms_condition">
                                <label class="form-check-label" for="toc_and_privacy">
                                    {{ __('Accept all') }}
                                    <a target="_blank" href="{{ url(get_static_option('toc_page_link') ?? '') }}"
                                        class="fw-bold">{{ __('Terms and Conditions') }}</a> &amp;
                                    <a target="_blank" href="{{ url(get_static_option('privacy_policy_link') ?? '') }}"
                                        class="fw-bold">{{ __('Privacy Policy') }}</a>
                                </label>

                                @if (!empty(get_static_option('site_google_captcha_enable')))
                                    <div class="col-md-12 my-3">
                                        <div class="g-recaptcha is-required" id="recaptcha_element_register"
                                            data-sitekey="{{ get_static_option('recaptcha_site_key') ?? '' }}"></div>
                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                        @endif
                                    </div>
                                @endif
                                <button class="submit-btn w-100 mt-4 sign_up_now_button" type="submit">
                                    {{ get_static_option('register_page_button_title') ?? __('Register Now') }}
                                    <span id="user_register_load_spinner"></span>
                                </button>
                                <span class="account color-light mt-3"> {{ __('Already have an account?') }} <a
                                        class="color-one" href="{{ route('user.login') }}"> {{ __('Login') }} </a>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-6 col-lg-7">
                    <div class="started-wrapper started-side-padding">
                        <div class="started-wrapper-video ">
                            <div class="started-single">
                                <div class="started-single-flex">
                                    <div class="started-single-thumb">
                                        <svg width="50px" height="50px" viewBox="0 0 50 50" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>Group 2</title>
                                            <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd">
                                                <g id="Shake---Exisiting-Exchange-User-3"
                                                    transform="translate(-668.000000, -548.000000)">
                                                    <g id="Group-9" transform="translate(668.000000, 76.000000)">
                                                        <g id="Group-2" transform="translate(0.000000, 472.000000)">
                                                            <circle id="Oval" fill="#FFFFFF" cx="25"
                                                                cy="25" r="25" />
                                                            <g id="Group" transform="translate(14.285714, 9.821429)"
                                                                fill-rule="nonzero">
                                                                <path
                                                                    d="M20.0096795,4.64411403 L16.6346795,1.63945565 C13.9933751,-0.735193721 9.88467949,-0.492882561 7.53685341,2.12407797 L1.76511428,8.47263036 C4.21076645,5.9525943 8.22163602,5.9525943 10.8140273,8.2303192 L11.0096795,8.42416813 L14.0912012,11.1380531 C14.5314186,11.525751 15.1672882,11.4772887 15.5585925,11.0411287 L16.4390273,10.071884 L20.0585925,6.09798099 C20.4498969,5.71028314 20.4498969,5.03181189 20.0096795,4.64411403 Z"
                                                                    id="Path" fill="#FCD147" />
                                                                <path
                                                                    d="M18.297723,11.7195999 L16.4879404,10.071884 L15.6075056,11.0411287 C15.2162012,11.4772887 14.5803317,11.4772887 14.1401143,11.1380531 L11.0585925,8.42416813 L7.43902732,12.4465334 C7.04772297,12.8826935 7.09663602,13.5127025 7.53685341,13.9004003 L12.0857665,17.9227656 L12.3303317,18.1166145 C14.922723,20.3943394 15.3140273,24.3682425 13.1618534,27.0336652 L18.8357665,20.7820373 C21.1835925,18.1166145 20.9390273,14.0942493 18.297723,11.7195999 Z"
                                                                    id="Path" fill="#6CC5A4" />
                                                                <path
                                                                    d="M12.3303317,18.1166145 L12.0857665,17.9227656 L8.46620123,21.9451309 C8.07489689,22.381291 7.43902732,22.381291 6.99880993,22.0420553 L3.91728819,19.3281703 L0.297722972,23.3020734 C-0.0935813757,23.7382334 -0.0446683322,24.3682425 0.395549059,24.7559403 L3.77054906,27.7605987 C6.31402732,30.0383236 10.2270708,29.8929369 12.6238099,27.5182875 C12.672723,27.4698253 12.672723,27.4213631 12.721636,27.4213631 L13.0640273,27.0336652 C15.3140273,24.3682425 14.8738099,20.4428017 12.3303317,18.1166145 Z"
                                                                    id="Path" fill="#902A75" />
                                                                <path
                                                                    d="M7.53685341,13.9004003 C7.09663602,13.5127025 7.09663602,12.8826935 7.43902732,12.4465334 L11.0585925,8.42416813 L10.8629404,8.27878143 C8.27054906,5.9525943 4.21076645,6.00105653 1.81402732,8.52109259 C-0.729450941,11.1380531 -0.58271181,15.3058051 2.15641862,17.7289167 L4.01511428,19.3766326 L7.09663602,22.0905176 C7.53685341,22.4782154 8.17272297,22.4297532 8.56402732,21.9935931 L12.1835925,17.9712278 L7.53685341,13.9004003 Z"
                                                                    id="Path" fill="#ED2376" />
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="started-single-contents">
                                        <h3 class="inf-title started-single-contents-title">
                                            {{get_static_option('register_page_sidebar_title') ?? __('The Creator Marketplace') }}
                                        </h3>
                                        <p class="started-single-contents-para">{{ get_static_option('register_page_sidebar_description') ?? __('Influencer is a marketplace where you can buy or sell digital creative services. The platform helps individual influencers, photographers, writers, and musicians collaborate and transact with marketers. Creatives list
                                            projects on the site and Marketers buy creative deals through a streamlined chat experience.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="started-single">
                                <div class="started-single-flex">
                                    <div class="started-single-thumb">
                                        <svg width="50px" height="50px" viewBox="0 0 50 50" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>Group 4</title>
                                            <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd">
                                                <g id="Shake---Exisiting-Exchange-User-3"
                                                    transform="translate(-668.000000, -676.000000)">
                                                    <g id="Group-9" transform="translate(668.000000, 76.000000)">
                                                        <g id="Group-4" transform="translate(0.000000, 600.000000)">
                                                            <g id="Group-2-Copy" fill="#FFFFFF">
                                                                <circle id="Oval" cx="25" cy="25"
                                                                    r="25" />
                                                            </g>
                                                            <g id="create" transform="translate(14.000000, 15.000000)"
                                                                fill="#56D9AB" fill-rule="nonzero">
                                                                <path
                                                                    d="M0.44,16.6188 C-0.0296212668,17.2127175 -0.11849046,18.0227943 0.2112,18.7044 C0.538089198,19.3779151 1.22255915,19.8039976 1.9712,19.8000554 L5.28,19.8000554 C6.52785207,19.7995431 7.71682248,19.2692608 8.55094231,18.3411557 C9.38506209,17.4130506 9.78587243,16.1744219 9.65359998,14.9336 L19.162,6.21280002 C20.0787905,5.38844988 20.4652314,4.12510483 20.1664904,2.92893937 C19.8677494,1.73277391 18.9326979,0.799470144 17.7359756,0.502967561 C16.5392533,0.206464976 15.2766335,0.595268779 14.454,1.5136 L5.71999998,11.0264 C4.48347595,10.902124 3.25206259,11.3065506 2.33000027,12.1397596 C1.40793795,12.9729687 0.881227079,14.1572471 0.880000002,15.4 C0.879868561,15.8451318 0.724236353,16.2762331 0.44,16.6188 Z M15.752,2.706 C16.1259371,2.2321539 16.7388735,2.01533319 17.3275889,2.14864973 C17.9163043,2.28196626 18.3760337,2.74169571 18.5093503,3.33041108 C18.6426668,3.91912644 18.4258461,4.53206291 17.952,4.906 L9.03319998,13.1076 C8.66771521,12.5074082 8.1637918,12.0034848 7.5636,11.638 L15.752,2.706 Z M1.8172,17.7056 C2.34919065,17.0549756 2.639877,16.2404321 2.64,15.4 C2.64023265,14.5966658 3.00622776,13.837145 3.6344,13.3364 C4.09953518,12.9593224 4.68123576,12.7555717 5.28,12.76 C5.49491855,12.7588707 5.70917086,12.7839899 5.91799998,12.8348 C6.87558474,13.0627254 7.62389633,13.8093363 7.854,14.7664 C8.049906,15.5628034 7.8645524,16.405024 7.3524,17.0456 C6.84973339,17.6761904 6.08641926,18.0424516 5.28,18.04 L1.9668,18.04 C1.89187425,18.0448557 1.82177477,18.002796 1.7908,17.9344 C1.75238574,17.8598368 1.76281436,17.7694555 1.8172,17.7056 L1.8172,17.7056 Z"
                                                                    id="Shape" />
                                                                <path
                                                                    d="M3.52,3.08 C3.03398942,3.08 2.64,3.47398942 2.64,3.96 L2.64,4.84 L1.76,4.84 C1.27398942,4.84 0.880000002,5.23398942 0.880000002,5.71999998 C0.880000002,6.20601057 1.27398942,6.6 1.76,6.6 L2.64,6.6 L2.64,7.48000002 C2.64,7.96601055 3.03398942,8.35999998 3.52,8.35999998 C4.00601058,8.35999998 4.4,7.96601055 4.4,7.48000002 L4.4,6.6 L5.28,6.6 C5.76601059,6.6 6.16000002,6.20601057 6.16000002,5.71999998 C6.16000002,5.23398942 5.76601059,4.84 5.28,4.84 L4.4,4.84 L4.4,3.96 C4.4,3.47398942 4.00601058,3.08 3.52,3.08 Z"
                                                                    id="Path" />
                                                                <path
                                                                    d="M21.12,14.52 C21.12,14.0339894 20.7260106,13.64 20.24,13.64 L18.48,13.64 L18.48,11.88 C18.48,11.3939894 18.0860106,11 17.6,11 C17.1139894,11 16.72,11.3939894 16.72,11.88 L16.72,13.64 L14.96,13.64 C14.4739894,13.64 14.08,14.0339894 14.08,14.52 C14.08,15.0060106 14.4739894,15.4 14.96,15.4 L16.72,15.4 L16.72,17.16 C16.72,17.6460106 17.1139894,18.04 17.6,18.04 C18.0860106,18.04 18.48,17.6460106 18.48,17.16 L18.48,15.4 L20.24,15.4 C20.7260106,15.4 21.12,15.0060106 21.12,14.52 Z"
                                                                    id="Path" />
                                                                <circle id="Oval" cx="9.23119998" cy="1.76"
                                                                    r="1.32" />
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="started-single-contents">
                                        <h3 class="inf-title started-single-contents-title"> {{get_static_option('register_page_sidebar_title_two') ?? __('Create an Account Today') }} </h3>
                                        <p class="started-single-contents-para">{{ get_static_option('register_page_sidebar_description_two') ?? __('Influencer is a marketplace where you can buy or sell digital creative services. The platform helps individual influencers, photographers, writers, and musicians collaborate and transact with marketers. Creatives list
                                            Projects on the site and Marketers buy creative deals through a streamlined chat experience.') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-wrapper mt-5">
                                <a href="{{ route('jobs.all') }}"
                                    class="cmn-btn btn-outline-1 color-one">{{ __('View Marketplace') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- login Area end -->
@endsection

{{-- register script --}}
@section('script')
    <script src="{{ asset('assets/common/js/intlTelInput.min.js') }}"></script>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {

                const phoneOtpVerify = "{{ get_static_option('phone_otp_verify') }}"; // 'on' or 'off'
                const phoneContainer = document.getElementById('phone_number_container');

                if (phoneOtpVerify !== 'on') {
                    phoneContainer.style.display = 'none'; // hide if not 'on'
                }
                const input = document.querySelector("#phone_number");
                const iti = window.intlTelInput(input, {
                    initialCountry: "us",
                    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.2/build/js/utils.js"
                });

                // continue
                $('.user_info_area').hide();

                //choose user type
                $(document).on('click', '.join_as_a_client', function() {
                    $('#user_type').val('1')
                })
                $(document).on('click', '.join_as_a_freelancer', function() {
                    $('#user_type').val('2')
                })
                $(document).on('click', '.continue_to_info', function() {
                    $('.user_info_area').show();
                    $('.user_type_area').hide();
                });

                $(document).on('keyup', '#username', function() {
                    let username = $(this).val();
                    let usernameRegex = /^[a-zA-Z0-9]+$/;
                    if (usernameRegex.test(username) && username != '') {
                        $.ajax({
                            url: "{{ route('user.name.availability') }}",
                            type: 'post',
                            data: {
                                username: username
                            },
                            success: function(res) {
                                if (res.status == 'available') {
                                    $("#user_name_availability").html(
                                        "<span style='color: green;'>" + res.msg +
                                        "</span>");
                                } else {
                                    $("#user_name_availability").html(
                                        "<span style='color: red;'>" + res.msg +
                                        "</span>");
                                }
                            }
                        });
                    } else {
                        $("#user_name_availability").html(
                            "<span style='color: red;'>{{ __('Enter valid username') }}</span>");
                    }
                });

                $(document).on('keyup', '#phone_number', function() {
                    let number = iti.getNumber(); // Always get normalized E.164 format

                    if (iti.isValidNumber()) {
                        $.ajax({
                            url: "{{ route('user.phone.number.availability') }}",
                            type: 'post',
                            data: {
                                phone_number: number
                            },
                            success: function(res) {
                                if (res.status == 'available') {
                                    $("#phone_number_availability").html(
                                        "<span style='color: green;'>" + res.msg +
                                        "</span>");
                                } else {
                                    $("#phone_number_availability").html(
                                        "<span style='color: red;'>" + res.msg +
                                        "</span>");
                                }
                            }
                        });
                    } else {
                        $("#phone_number_availability").html(
                            "<span style='color: red;'>{{ __('Enter valid phone number') }}</span>"
                        );
                    }
                });

                $(document).on('keyup', '#email', function() {
                    let email = $(this).val();
                    let emailRegex = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
                    if (emailRegex.test(email) && email != '') {
                        $.ajax({
                            url: "{{ route('user.email.availability') }}",
                            type: 'post',
                            data: {
                                email: email
                            },
                            success: function(res) {
                                if (res.status == 'available') {
                                    $("#email_availability").html(
                                        "<span style='color: green;'>" + res.msg +
                                        "</span>");
                                } else {
                                    $("#email_availability").html(
                                        "<span style='color: red;'>" + res.msg +
                                        "</span>");
                                }
                            }
                        });
                    } else {
                        $("#email_availability").html(
                            "<span style='color: red;'>{{ __('Enter valid email') }}</span>");
                    }
                });

                //remove realtime validation
                $(document).on('click', '.is-required', function(e) {
                    if ($(this).is(':checkbox')) {
                        $(this).css('outline', ''); // Clear the outline for checkboxes
                    } else {
                        $(this).css('border', ''); // Clear the border for other inputs
                    }
                });

                //confirm signup
                $(document).on('click', '.sign_up_now_button', function(e) {
                    e.preventDefault()
                    $('#user_register_load_spinner').html('<i class="fas fa-spinner fa-pulse"></i>')

                    let isValid = true;
                    $('.is-required').each(function() {
                        if ($(this).is(':checkbox')) {
                            // Check if checkbox is required and not checked
                            if (!$(this).is(':checked')) {
                                $(this).css('outline',
                                    '1px solid red'
                                    ); // Using outline for checkbox since border doesn't apply well
                                isValid = false;
                            } else {
                                $(this).css('outline',
                                    ''); // Clear outline if checkbox is checked
                            }
                        } else {
                            // For all other input types
                            if ($.trim($(this).val()) === '') {
                                $(this).css('border', '1px solid red');
                                isValid = false;
                            } else {
                                $(this).css('border', '');
                            }
                        }
                    });

                    let first_name = $('#first_name').val();
                    let last_name = $('#last_name').val();
                    let username = $('#username').val();
                    let email = $('#email').val();
                    let password = $('#password').val();
                    let confirm_password = $('#confirm_password').val();
                    let user_type = $('#user_type').val();
                    // 🟢 Get full E.164 phone number
                    let phone_number = '';
                    if (phoneOtpVerify === 'on') {
                        if (iti.isValidNumber()) {
                            phone_number = iti.getNumber();
                        } else {
                            $('#phone_number').css('border', '1px solid red');
                            $('#user_register_load_spinner').html('');
                            return; // stop submit if number invalid
                        }
                    }
                    let terms_condition = $('#terms_condition:checked').val();

                    let recaptchaResponse;
                    if (document.getElementById('recaptcha_element_register')) {
                        recaptchaResponse = grecaptcha.getResponse();
                    }

                    let erContainer = $(".error-message");
                    erContainer.html('');

                    $.ajax({
                        url: "{{ route('user.register') }}",
                        type: 'post',
                        data: {
                            user_type: user_type,
                            first_name: first_name,
                            last_name: last_name,
                            username: username,
                            email: email,
                            phone_number: phone_number,
                            password: password,
                            confirm_password: confirm_password,
                            terms_condition: terms_condition,
                            recaptchaResponse: recaptchaResponse
                        },
                        error: function(res) {
                            let errors = res.responseJSON;
                            erContainer.html('<div class="alert alert-danger"></div>');
                            $.each(errors.errors, function(index, value) {
                                erContainer.find('.alert.alert-danger').append(
                                    '<p>' + value + '</p>');
                            });
                            $('#user_register_load_spinner').html('')
                        },
                        success: function(res) {
                            if (res.status == 'brand') {
                                window.location.href = "{{ route('client.profile') }}";
                            }
                            if (res.status == 'influencer') {
                                window.location.href = "{{ route('influencer.profile') }}";
                            }
                        }
                    });
                })

                if (!$('#user_type').val() || $('#user_type').val() === '') {
                    $('.join_as_a_freelancer').trigger('click');
                }

                $(document).on('click', '.social-login-btn', function(e) {
                    e.preventDefault();

                    let provider = $(this).data('provider'); // facebook / google
                    let user_type = $('#user_type').val();   // selected role

                    // Generate route dynamically
                    let redirectUrl = '';
                    if (provider === 'google') {
                        redirectUrl = '{{ route('login.google.redirect') }}' + '?user_type=' + user_type;
                    } else if (provider === 'facebook') {
                        redirectUrl = '{{ route('login.facebook.redirect') }}' + '?user_type=' + user_type;
                    }

                    if (redirectUrl) {
                        window.location.href = redirectUrl;
                    }
                });

            });
        }(jQuery));
    </script>
@endsection
