<?php $__env->startSection('site_title', __('User Login')); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .autoLogin {
            border: none;
            background-color: green;
            color: #fff;
            border-radius: 5px;
            padding: 5px;
            transition: all 300ms;
            cursor: pointer;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- login Area Starts -->
    <section class="login-area pat-100 pab-100">
        <div class="container">
            <div class="row gy-5 align-items-center justify-content-center">
                <div class="col-lg-5">
                    <div class="login-wrapper">
                        <div class="login-wrapper-contents">
                            <h3 class="login-wrapper-contents-title">
                                <?php echo e(get_static_option('login_page_title') ?? __('Log In ')); ?></h3>
                            <?php if (isset($component)) { $__componentOriginal4bb59b834d778ff0cb72af5a473e2885 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4bb59b834d778ff0cb72af5a473e2885 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.validation.error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('validation.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4bb59b834d778ff0cb72af5a473e2885)): ?>
<?php $attributes = $__attributesOriginal4bb59b834d778ff0cb72af5a473e2885; ?>
<?php unset($__attributesOriginal4bb59b834d778ff0cb72af5a473e2885); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4bb59b834d778ff0cb72af5a473e2885)): ?>
<?php $component = $__componentOriginal4bb59b834d778ff0cb72af5a473e2885; ?>
<?php unset($__componentOriginal4bb59b834d778ff0cb72af5a473e2885); ?>
<?php endif; ?>
                            <div class="error-message"></div>
                            <form class="login-wrapper-contents-form custom-form" id="user_auto_login_form" method="post"
                                action="<?php echo e(route('user.login')); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="single-input mt-4">
                                    <label class="label-title mb-2"><?php echo e(__('Email Or User Name')); ?></label>
                                    <input class="form--control" type="text" name="username" id="username"
                                        placeholder="<?php echo e(__('Email Or User Name')); ?>">
                                </div>
                                <div class="single-input mt-4">
                                    <label class="label-title mb-2"> <?php echo e(__('Password')); ?> </label>
                                    <div class="single-input-inner">
                                        <input class="form--control" type="password" name="password" id="password"
                                            placeholder="<?php echo e(__('Type Password')); ?>">
                                        <div class="icon toggle-password">
                                            <div class="show-icon"> <i class="fa-regular fa-eye-slash"></i> </div>
                                            <span class="hide-icon"> <i class="fa-regular fa-eye"></i> </span>
                                        </div>
                                    </div>
                                </div>
                                <button id="signin_form" class="submit-btn w-100 mt-4" type="submit">
                                    <?php echo e(get_static_option('login_page_button_title') ?? __('Sign In Now')); ?> </button>
                                <span class="account color-light mt-3"><?php echo e(__("Don't have an account?")); ?> <a
                                        class="color-one" href="<?php echo e(route('user.register')); ?>"> <?php echo e(__('SignUp Now')); ?></a>
                                </span>
                            </form>
                            <div class="single-checkbox mt-3">
                                <div class="checkbox-inline">
                                    <input class="check-input" name="remember" type="checkbox" id="remember">
                                    <label class="checkbox-label" for="remember"> <?php echo e(__('Remember Me')); ?> </label>
                                </div>
                                <div class="forgot-password">
                                    <a href="<?php echo e(route('user.forgot.password')); ?>"
                                        class="forgot-btn color-one"><?php echo e(__('Forgot Password')); ?> </a>
                                </div>
                            </div>

                            
                            <?php if(url()->current() == 'https://influencer.bytesed.com/login'): ?>
                                <div class="mt-5">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><?php echo e(__('Username')); ?></th>
                                                <th><?php echo e(__('Password')); ?></th>
                                                <th><?php echo e(__('Action')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody style="border-top: none;">
                                            <tr>
                                                <td id="freelancer_username">influencer</td>
                                                <td id="freelancer_password">12345678</td>
                                                <td><button type="button" class="autoLogin"
                                                        id="freelancerLogin"><?php echo e(__('Influencer Login')); ?></button></td>
                                            </tr>
                                            <tr>
                                                <td id="client_username">client</td>
                                                <td id="client_password">12345678</td>
                                                <td><button type="button" class="autoLogin"
                                                        id="clientLogin"><?php echo e(__('Client Login')); ?></button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                            

                            <?php if(get_static_option('login_page_social_login_enable_disable') == 'on'): ?>
                                <div class="login-bottom-contents">
                                    <div class="or-contents mb-3">
                                        <span class="or-contents-para"> <?php echo e(__('Or')); ?> </span>
                                    </div>
                                    <div class="login-others">
                                        <div class="login-others-single">
                                            <a href="<?php echo e(route('login.google.redirect')); ?>" data-provider="google"
                                                class="login-others-single-btn w-100">
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
                                                <span class="login-para"> <?php echo e(__('Sign In With Google')); ?> </span>
                                            </a>
                                        </div>
                                        <div class="login-others-single">
                                            <a href="<?php echo e(route('login.facebook.redirect')); ?>" data-provider="facebook"
                                                class="login-others-single-btn w-100">
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
                                                <span class="login-para"> <?php echo e(__('Sign In With Facebook')); ?> </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none">
                    <div class="login-right">
                        <div class="login-right-item">
                            <div class="login-right-shapes">
                                <div class="login-right-thumb">
                                    <?php if(empty(get_static_option('login_page_sidebar_image'))): ?>
                                        <img src="<?php echo e(asset('assets/static/single-page/login_page.png')); ?>"
                                            alt="loginImg">
                                    <?php else: ?>
                                        <?php echo render_image_markup_by_attachment_id(get_static_option('login_page_sidebar_image')); ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="login-right-contents text-white">
                                <h4 class="login-right-contents-title">
                                    <?php echo e(get_static_option('login_page_sidebar_title') ?? __('Login and start discover')); ?>

                                </h4>
                                <p class="login-right-contents-para">
                                    <?php echo e(get_static_option('login_page_sidebar_description') ?? __('Once login you will see the magic of influencer marketplace.')); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login Area end -->

    <!-- Social Login Role Selection Modal -->
    <div class="modal fade" id="socialRoleModal" tabindex="-1" aria-labelledby="socialRoleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4">
                <h5 class="modal-title mb-3">
                    <?php echo e(get_static_option('register_page_choose_role_title') ?? __('Choose a Role')); ?></h5>

                <div class="choose-account-flex d-flex mt-4">
                    <div class="choose-account-single select-social-role" data-role="2">
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
                                <?php echo e(get_static_option('register_page_choose_join_freelancer_title') ?? __('Join as a Influencer')); ?>

                            </h6>
                        </div>
                    </div>
                    <div class="choose-account-single select-social-role" data-role="1">
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
                                <?php echo e(get_static_option('register_page_choose_join_client_title') ?? __('Join as a Client')); ?>

                            </h6>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary w-100 mt-3"
                    id="confirmSocialRole"><?php echo e(__('Continue')); ?></button>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('script'); ?>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                let selectedSocialProvider = null;
                let selectedUserRole = null;
                //auto login
                $(document).on('click', '#clientLogin', function() {
                    let el = $(this);
                    let username = $('#client_username').text();
                    let passwrord = $('#client_password').text();
                    $('#username').val(username);
                    $('#password').val(passwrord);

                    $('#signin_form').trigger('click');

                });

                $(document).on('click', '#freelancerLogin', function() {
                    let el = $(this);
                    let username = $('#freelancer_username').text();
                    let passwrord = $('#freelancer_password').text();
                    $('#username').val(username);
                    $('#password').val(passwrord);

                    $('#signin_form').trigger('click');

                });

                $(document).on('click', '#signin_form', function(e) {
                    e.preventDefault();
                    let el = $(this);
                    let erContainer = $(".error-message");
                    erContainer.html('');
                    el.text('<?php echo e(__('Please Wait..')); ?>');
                    $.ajax({
                        url: "<?php echo e(route('user.login')); ?>",
                        type: "POST",
                        data: {
                            username: $('#username').val(),
                            password: $('#password').val(),
                            remember: $('#remember').is(':checked') ? 1 : 0,
                            _token: "<?php echo e(csrf_token()); ?>"
                        },
                        error: function(data) {
                            var errors = data.responseJSON;
                            erContainer.html('<div class="alert alert-danger"></div>');
                            if (errors && errors.errors) {
                                $.each(errors.errors, function(index, value) {
                                    erContainer.find('.alert.alert-danger').append(
                                        '<p>' + value + '</p>');
                                });
                            } else {
                                erContainer.find('.alert.alert-danger').append(
                                    '<p><?php echo e(__('Something went wrong. Please try again.')); ?></p>');
                            }
                            el.text('<?php echo e(__('Sign In Now')); ?>');
                        },
                        success: function(data) {
                            $('.alert.alert-danger').remove();
                            if (data.status == 'client-login') {
                                el.text('<?php echo e(__('Redirecting')); ?>..');
                                erContainer.html('<div class="alert alert-' + data.type +
                                    '">' + data.msg + '</div>');
                                let redirectPath = "<?php echo e(route('client.dashboard')); ?>";
                                <?php if(!empty(request()->get('return'))): ?>
                                    redirectPath =
                                        "<?php echo e(url('/' . request()->get('return'))); ?>";
                                <?php endif; ?>
                                setTimeout(function(){
                                    window.location = redirectPath;
                                }, 500);
                            } else if (data.status == 'influencer-login') {
                                el.text('<?php echo e(__('Redirecting')); ?>..');
                                erContainer.html('<div class="alert alert-' + data.type +
                                    '">' + data.msg + '</div>');
                                let redirectPath = "<?php echo e(route('influencer.dashboard')); ?>";

                                <?php if(!empty(request()->get('return'))): ?>
                                    redirectPath =
                                        "<?php echo e(url('/' . request()->get('return'))); ?>";
                                <?php endif; ?>

                                setTimeout(function(){
                                    window.location = redirectPath;
                                }, 500);
                            } else {
                                erContainer.html('<div class="alert alert-' + data.type +
                                    '">' + data.msg + '</div>');
                                el.text('<?php echo e(__('Sign In Now')); ?>');
                            }
                        }
                    });
                });

                // Social login
                $('.login-others-single-btn').on('click', function(e) {
                    e.preventDefault();
                    selectedSocialProvider = $(this).data('provider');
                    selectedUserRole = null;

                    // Show modal
                    $('#socialRoleModal').modal('show');
                });

                // Select role
                $(document).on('click', '.select-social-role', function() {
                    $('.select-social-role').removeClass('active');
                    $(this).addClass('active');
                    selectedUserRole = $(this).data('role');
                });

                // Confirm role
                $('#confirmSocialRole').on('click', function() {
                    if (!selectedUserRole) {
                        toastr_warning_js("<?php echo e(__('Please select account type to continue')); ?>");
                        return;
                    }

                    let redirectUrl = '';
                    if (selectedSocialProvider === 'google') {
                        redirectUrl = '<?php echo e(route('login.google.redirect')); ?>' + '?user_type=' +
                            selectedUserRole;
                    } else if (selectedSocialProvider === 'facebook') {
                        redirectUrl = '<?php echo e(route('login.facebook.redirect')); ?>' + '?user_type=' +
                            selectedUserRole;
                    }

                    if (redirectUrl) {
                        window.location.href = redirectUrl;
                    }
                });
            });
        }(jQuery));
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/prosdeliver/public_html/core/resources/views/frontend/user/user-login.blade.php ENDPATH**/ ?>