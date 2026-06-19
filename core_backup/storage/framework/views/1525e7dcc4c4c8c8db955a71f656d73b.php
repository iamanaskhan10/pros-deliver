<?php $__env->startSection('site_title', __('Dashboard')); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .total_balance {
            background-color: #e3e1ff !important;
        }

        .single-profile-settings-header {
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;

            .btn-profile {
                padding-left: 10px;
                padding-right: 10px;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <main>
        <!-- Profile Settings area Starts -->
        <div class="responsive-overlay"></div>
        <div class="profile-settings-area pat-100 pab-100">
            <div class="container">
                <div class="row g-4">
                    <?php echo $__env->make('frontend.user.layout.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <div class="col-xl-9 col-lg-8">
                        <div class="profile-settings-wrapper influencer">

                            <div class="single-profile-settings">
                                <div class="single-profile-settings-header d-flex">
                                    <div class="single-profile-settings-header-flex mb-4">
                                        <?php if (isset($component)) { $__componentOriginaldd5d165d00da56cf3441fe2a6f4754db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.form-title','data' => ['title' => __('Dashboard'),'class' => 'inf-title title6 black_text fw_bold']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.form-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Dashboard')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('inf-title title6 black_text fw_bold')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db)): ?>
<?php $attributes = $__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db; ?>
<?php unset($__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldd5d165d00da56cf3441fe2a6f4754db)): ?>
<?php $component = $__componentOriginaldd5d165d00da56cf3441fe2a6f4754db; ?>
<?php unset($__componentOriginaldd5d165d00da56cf3441fe2a6f4754db); ?>
<?php endif; ?>
                                    </div>
                                    <?php if(get_static_option('profile_switch_enable_disable') == 'enable'): ?>
                                        <div class="profile-switch-header">
                                            <select class="switch-profile-select" id="switch_profile">
                                                <option value="freelancer" <?php if(Session::get('user_role') == 'freelancer'): ?> selected <?php endif; ?>><?php echo e(__('As Influencer')); ?></option>
                                                <option value="client" <?php if(Session::get('user_role') == 'client'): ?> selected <?php endif; ?>><?php echo e(__('As Brand')); ?></option>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="single-profile-settings-inner">
                                    <div class="row g-4">

                                        <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                            <div class="myJob-wrapper-single-balance total_balance">
                                                <div class="myJob-wrapper-single-balance-contents text-center">
                                                    <div class="icon-wraper balance-icon">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M8.51018 5.8408H15.4862L17.6956 1.76193C17.7666 1.6307 17.7941 1.48026 17.774 1.33239C17.7539 1.18451 17.6873 1.04686 17.5838 0.939355C17.4803 0.831852 17.3452 0.760074 17.1982 0.734408C17.0512 0.708741 16.8999 0.730516 16.766 0.796583C15.1849 1.57724 13.8023 1.2441 12.2014 0.858552C10.6182 0.477224 8.8241 0.0450364 6.69405 0.760489C6.59684 0.793149 6.50794 0.846679 6.4336 0.917325C6.35926 0.987972 6.30128 1.07403 6.26371 1.16945C6.22615 1.26488 6.20991 1.36737 6.21614 1.46973C6.22237 1.57209 6.25092 1.67186 6.29979 1.76202L8.51018 5.8408Z"
                                                                fill="#8280FF" />
                                                            <path
                                                                d="M16.2232 7.53203C16.1318 7.43738 16.0398 7.34206 15.9472 7.24609H8.0522C7.95973 7.34194 7.86772 7.43725 7.77616 7.53203C6.35064 9.00691 5.00411 10.4001 4.00178 11.9595C2.84931 13.7527 2.3125 15.5105 2.3125 17.4917C2.3125 19.7905 3.55192 21.5455 5.89666 22.567C7.90211 23.4407 10.3221 23.624 11.9991 23.624C13.6884 23.624 16.1218 23.4406 18.1214 22.5666C20.4541 21.5471 21.6871 19.7923 21.6871 17.4917C21.6871 15.5106 21.1502 13.7527 19.9978 11.9595C18.9955 10.4001 17.6489 9.00691 16.2232 7.53203ZM12.1437 14.0446C12.6473 14.1505 13.168 14.2602 13.6146 14.5546C14.1949 14.9371 14.4892 15.5283 14.4892 16.3119C14.4892 17.3462 13.7338 18.2215 12.7021 18.5003V18.863C12.7021 19.0495 12.628 19.2283 12.4961 19.3602C12.3643 19.492 12.1854 19.5661 11.9989 19.5661C11.8125 19.5661 11.6336 19.492 11.5018 19.3602C11.3699 19.2283 11.2958 19.0495 11.2958 18.863V18.5003C10.2641 18.2215 9.5087 17.3462 9.5087 16.3119C9.5087 16.1254 9.58278 15.9465 9.71464 15.8147C9.84651 15.6828 10.0253 15.6087 10.2118 15.6087C10.3983 15.6087 10.5772 15.6828 10.709 15.8147C10.8409 15.9465 10.915 16.1254 10.915 16.3119C10.915 16.7947 11.4012 17.1873 11.9989 17.1873C12.5966 17.1873 13.0829 16.7945 13.0829 16.3119C13.0829 15.7681 12.9107 15.643 11.8541 15.4207C11.3506 15.3148 10.8299 15.2051 10.3833 14.9108C9.80294 14.5282 9.5087 13.937 9.5087 13.1535C9.5087 12.1185 10.2641 11.2427 11.2958 10.9638V10.6023C11.2958 10.4159 11.3699 10.237 11.5018 10.1052C11.6336 9.9733 11.8125 9.89922 11.9989 9.89922C12.1854 9.89922 12.3643 9.9733 12.4961 10.1052C12.628 10.237 12.7021 10.4159 12.7021 10.6023V10.9637C13.7338 11.2426 14.4892 12.1183 14.4892 13.1533C14.4892 13.3398 14.4151 13.5187 14.2832 13.6505C14.1514 13.7824 13.9725 13.8565 13.786 13.8565C13.5996 13.8565 13.4207 13.7824 13.2889 13.6505C13.157 13.5187 13.0829 13.3398 13.0829 13.1533C13.0829 12.6699 12.5966 12.2768 11.9989 12.2768C11.4012 12.2768 10.915 12.67 10.915 13.1533C10.9151 13.6974 11.0874 13.8223 12.1439 14.0446H12.1437Z"
                                                                fill="#8280FF" />
                                                        </svg>
                                                    </div>
                                                    <p class="myJob-wrapper-single-balance-para"><?php echo e(__('Wallet Balance')); ?>

                                                    </p>
                                                    <h4
                                                        class="inf-title lg-font black_text fw_bold contract_single__balance-price">
                                                        <?php echo e(float_amount_with_currency_symbol($total_wallet_balance) ?? 0.0); ?>

                                                    </h4>
                                                </div>
                                            </div>
                                        </div>

                                        <?php if(get_static_option('project_enable_disable') != 'disable'): ?>
                                            <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                                <a
                                                    href="<?php echo e(route('influencer.profile.details', Auth::guard('web')->user()->username)); ?>">
                                                    <div class="myJob-wrapper-single-balance">
                                                        <div class="myJob-wrapper-single-balance-contents text-center">
                                                            <div class="icon-wraper total-project-icon">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M15.75 1.5H14.121C13.812 0.627 12.978 0 12 0C11.022 0 10.188 0.627 9.8775 1.5H8.25C7.836 1.5 7.5 1.836 7.5 2.25V5.25C7.5 5.664 7.836 6 8.25 6H15.75C16.164 6 16.5 5.664 16.5 5.25V2.25C16.5 1.836 16.164 1.5 15.75 1.5Z"
                                                                        fill="#FFBB38" />
                                                                    <path
                                                                        d="M19.5 3H18V5.25C18 6.4905 16.9905 7.5 15.75 7.5H8.25C7.0095 7.5 6 6.4905 6 5.25V3H4.5C3.6735 3 3 3.6735 3 4.5V22.5C3 23.3415 3.6585 24 4.5 24H19.5C20.3415 24 21 23.3415 21 22.5V4.5C21 3.6585 20.3415 3 19.5 3ZM11.781 16.281L8.781 19.281C8.634 19.4265 8.442 19.5 8.25 19.5C8.058 19.5 7.866 19.4265 7.719 19.281L6.219 17.781C5.9265 17.4885 5.9265 17.013 6.219 16.7205C6.5115 16.428 6.987 16.428 7.2795 16.7205L8.25 17.6895L10.719 15.2205C11.0115 14.928 11.487 14.928 11.7795 15.2205C12.072 15.513 12.0735 15.987 11.781 16.281ZM11.781 10.281L8.781 13.281C8.634 13.4265 8.442 13.5 8.25 13.5C8.058 13.5 7.866 13.4265 7.719 13.281L6.219 11.781C5.9265 11.4885 5.9265 11.013 6.219 10.7205C6.5115 10.428 6.987 10.428 7.2795 10.7205L8.25 11.6895L10.719 9.2205C11.0115 8.928 11.487 8.928 11.7795 9.2205C12.072 9.513 12.0735 9.987 11.781 10.281ZM17.25 18H14.25C13.836 18 13.5 17.664 13.5 17.25C13.5 16.836 13.836 16.5 14.25 16.5H17.25C17.664 16.5 18 16.836 18 17.25C18 17.664 17.664 18 17.25 18ZM17.25 12H14.25C13.836 12 13.5 11.664 13.5 11.25C13.5 10.836 13.836 10.5 14.25 10.5H17.25C17.664 10.5 18 10.836 18 11.25C18 11.664 17.664 12 17.25 12Z"
                                                                        fill="#FFBB38" />
                                                                </svg>
                                                            </div>
                                                            <p class="myJob-wrapper-single-balance-para">
                                                                <?php echo e(__('Total Projects')); ?></p>
                                                            <h4
                                                                class="inf-title lg-font black_text fw_bold contract_single__balance-price">
                                                                <?php echo e($total_project ?? 0); ?></h4>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                            <div class="myJob-wrapper-single-balance">
                                                <div class="myJob-wrapper-single-balance-contents text-center">
                                                    <div class="icon-wraper complete-order-icon">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M22.8994 20.2932L21.3697 8.93372C21.2836 8.29298 20.971 7.70948 20.4894 7.28892C20.0081 6.86836 19.3874 6.63497 18.7429 6.63497H17.0596V5.76305C17.0596 2.97328 14.7901 0.703125 11.9997 0.703125C9.20942 0.703125 6.9395 2.97328 6.9395 5.76305V6.63497H5.25641C4.61169 6.63497 3.99144 6.86836 3.50989 7.28892C3.02834 7.70948 2.71569 8.29298 2.62958 8.93372L1.09991 20.2932C0.994859 21.0727 1.2133 21.7993 1.73141 22.3916C2.24952 22.9839 2.93961 23.2966 3.72673 23.2966H20.2725C21.0599 23.2966 21.7496 22.9839 22.2679 22.3916C22.786 21.7993 23.0044 21.0727 22.8994 20.2932ZM8.43945 10.7305C8.43945 11.1444 8.10369 11.4791 7.6895 11.4791C7.27531 11.4791 6.93955 11.1444 6.93955 10.7305V8.13666H8.43945V10.7305ZM8.43945 5.76305C8.43945 3.80114 10.0367 2.20261 11.9997 2.20261C13.9627 2.20261 15.5597 3.80114 15.5597 5.76305V6.63497H8.43945V5.76305ZM17.0596 10.7305C17.0596 11.1444 16.724 11.4791 16.3096 11.4791C15.8957 11.4791 15.5597 11.1444 15.5597 10.7305V8.13666H17.0596V10.7305Z"
                                                                fill="#4AD991" />
                                                        </svg>
                                                    </div>
                                                    <p class="myJob-wrapper-single-balance-para"><?php echo e(__('Complete Order')); ?>

                                                    </p>
                                                    <h4
                                                        class="inf-title lg-font black_text fw_bold contract_single__balance-price">
                                                        <?php echo e($complete_order ?? 0); ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                            <div class="myJob-wrapper-single-balance">
                                                <div class="myJob-wrapper-single-balance-contents text-center">
                                                    <div class="icon-wraper active-order-icon">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M16 1.25H4C3.63879 1.24974 3.28107 1.32069 2.94731 1.4588C2.61355 1.5969 2.31028 1.79946 2.05487 2.05487C1.79946 2.31028 1.5969 2.61355 1.4588 2.94731C1.32069 3.28107 1.24974 3.63879 1.25 4V20C1.24974 20.3612 1.32069 20.7189 1.4588 21.0527C1.5969 21.3865 1.79946 21.6897 2.05487 21.9451C2.31028 22.2005 2.61355 22.4031 2.94731 22.5412C3.28107 22.6793 3.63879 22.7503 4 22.75H13.49C12.2323 21.9858 11.2594 20.831 10.7196 19.4619C10.1799 18.0928 10.1031 16.5847 10.501 15.1679C10.8988 13.751 11.7494 12.5034 12.923 11.6153C14.0965 10.7273 15.5284 10.2478 17 10.25C17.5916 10.2484 18.1806 10.3292 18.75 10.49V4C18.7503 3.63879 18.6793 3.28107 18.5412 2.94731C18.4031 2.61355 18.2005 2.31028 17.9451 2.05487C17.6897 1.79946 17.3865 1.5969 17.0527 1.4588C16.7189 1.32069 16.3612 1.24974 16 1.25ZM10 10.75H5C4.80109 10.75 4.61032 10.671 4.46967 10.5303C4.32902 10.3897 4.25 10.1989 4.25 10C4.25 9.80109 4.32902 9.61032 4.46967 9.46967C4.61032 9.32902 4.80109 9.25 5 9.25H10C10.1989 9.25 10.3897 9.32902 10.5303 9.46967C10.671 9.61032 10.75 9.80109 10.75 10C10.75 10.1989 10.671 10.3897 10.5303 10.5303C10.3897 10.671 10.1989 10.75 10 10.75ZM12 6.75H5C4.80109 6.75 4.61032 6.67098 4.46967 6.53033C4.32902 6.38968 4.25 6.19891 4.25 6C4.25 5.80109 4.32902 5.61032 4.46967 5.46967C4.61032 5.32902 4.80109 5.25 5 5.25H12C12.1989 5.25 12.3897 5.32902 12.5303 5.46967C12.671 5.61032 12.75 5.80109 12.75 6C12.75 6.19891 12.671 6.38968 12.5303 6.53033C12.3897 6.67098 12.1989 6.75 12 6.75Z"
                                                                fill="#FF9871" />
                                                            <path
                                                                d="M17 11.25C15.8628 11.25 14.7511 11.5872 13.8055 12.219C12.8599 12.8509 12.1229 13.7489 11.6877 14.7996C11.2525 15.8502 11.1386 17.0064 11.3605 18.1218C11.5824 19.2372 12.13 20.2617 12.9341 21.0659C13.7383 21.87 14.7628 22.4177 15.8782 22.6395C16.9936 22.8614 18.1498 22.7475 19.2004 22.3123C20.2511 21.8771 21.1491 21.1401 21.781 20.1945C22.4128 19.2489 22.75 18.1372 22.75 17C22.7481 15.4756 22.1418 14.0141 21.0638 12.9362C19.9859 11.8582 18.5244 11.2519 17 11.25ZM19.03 16.53L17.03 18.53C16.9605 18.5998 16.8779 18.6552 16.787 18.6929C16.696 18.7307 16.5985 18.7502 16.5 18.7502C16.4015 18.7502 16.304 18.7307 16.213 18.6929C16.1221 18.6552 16.0395 18.5998 15.97 18.53L14.97 17.53C14.8963 17.4613 14.8372 17.3785 14.7962 17.2865C14.7552 17.1945 14.7332 17.0952 14.7314 16.9945C14.7296 16.8938 14.7482 16.7938 14.7859 16.7004C14.8236 16.607 14.8797 16.5222 14.951 16.451C15.0222 16.3797 15.107 16.3236 15.2004 16.2859C15.2938 16.2482 15.3938 16.2296 15.4945 16.2314C15.5952 16.2332 15.6945 16.2552 15.7865 16.2962C15.8785 16.3372 15.9613 16.3963 16.03 16.47L16.5 16.939L17.97 15.47C18.0387 15.3963 18.1215 15.3372 18.2135 15.2962C18.3055 15.2552 18.4048 15.2332 18.5055 15.2314C18.6062 15.2296 18.7062 15.2482 18.7996 15.2859C18.893 15.3236 18.9778 15.3797 19.049 15.451C19.1203 15.5222 19.1764 15.607 19.2141 15.7004C19.2518 15.7938 19.2704 15.8938 19.2686 15.9945C19.2668 16.0952 19.2448 16.1945 19.2038 16.2865C19.1628 16.3785 19.1037 16.4613 19.03 16.53Z"
                                                                fill="#FF9871" />
                                                        </svg>
                                                    </div>
                                                    <p class="myJob-wrapper-single-balance-para"><?php echo e(__('Active Order')); ?>

                                                    </p>
                                                    <h4
                                                        class="inf-title lg-font black_text fw_bold contract_single__balance-price">
                                                        <?php echo e($active_order ?? 0); ?></h4>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Analytics Row 1: Marketplace Score & Key Metrics -->
                                    <div class="row g-4 mt-2">
                                        <div class="col-xxl-4 col-lg-5">
                                            <div class="myJob-wrapper-single-balance bg-white" style="border: 1px solid #e2e8f0;">
                                                <div class="myJob-wrapper-single-balance-contents text-center">
                                                    <p class="myJob-wrapper-single-balance-para mb-2"><?php echo e(__('Marketplace Trust Score')); ?></p>
                                                    <div class="d-flex align-items-center justify-content-center gap-3">
                                                        <h2 class="inf-title lg-font black_text fw_bold mb-0"><?php echo e($performanceScore); ?>%</h2>
                                                    </div>
                                                    <div class="progress mt-3" style="height: 8px;">
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo e($performanceScore); ?>%; border-radius: 4px;" aria-valuenow="<?php echo e($performanceScore); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="text-muted d-block mt-2"><?php echo e(__('Based on completion, ratings & loyalty')); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-8 col-lg-7">
                                            <div class="row g-3">
                                                <div class="col-sm-6">
                                                    <div class="p-3 bg-white radius-10" style="border: 1px solid #e2e8f0;">
                                                        <span class="text-muted d-block mb-1"><?php echo e(__('Avg Delivery Time')); ?></span>
                                                        <h5 class="fw_bold"><?php echo e($avgDeliveryDays); ?> <?php echo e(__('Days')); ?></h5>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="p-3 bg-white radius-10" style="border: 1px solid #e2e8f0;">
                                                        <span class="text-muted d-block mb-1"><?php echo e(__('Acceptance Rate')); ?></span>
                                                        <h5 class="fw_bold"><?php echo e($acceptanceRate); ?>%</h5>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="p-3 bg-white radius-10" style="border: 1px solid #e2e8f0;">
                                                        <span class="text-muted d-block mb-1"><?php echo e(__('Repeat Client Rate')); ?></span>
                                                        <h5 class="fw_bold"><?php echo e($repeatClientRate); ?>%</h5>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                   <div class="p-3 bg-white radius-10" style="border: 1px solid #e2e8f0;">
                                                       <span class="text-muted d-block mb-1"><?php echo e(__('Avg Order Value')); ?></span>
                                                       <h5 class="fw_bold"><?php echo e(preg_replace('/\.00(?!\d)/', '', float_amount_with_currency_symbol($avgOrderValue))); ?></h5>
                                                   </div>
                                               </div>
                                               <div class="col-12 mt-2">
                                                   <div class="p-3 bg-white radius-10" style="border: 1px solid #e2e8f0; background: #f8fafc !important;">
                                                       <span class="text-muted d-block mb-1"><?php echo e(__('Highest Paying Client')); ?></span>
                                                       <h5 class="fw_bold text-primary mb-0"><?php echo e($highestPayingClient ?? 'N/A'); ?></h5>
                                                   </div>
                                               </div>
                                           </div>
                                    </div>

                                    <!-- Analytics Row 2: Charts -->
                                    <div class="row g-4 mt-2">
                                        <div class="col-lg-8">
                                            <div class="single-profile-settings h-100 mb-0 shadow-sm border-0">
                                                <div class="single-profile-settings-header p-0 mb-3">
                                                    <h5 class="inf-title title6 black_text fw_bold"><?php echo e(__('Earnings & Orders (Last 12 Months)')); ?></h5>
                                                </div>
                                                <div class="single-profile-settings-inner p-0">
                                                    <canvas id="earningsChart" style="height: 400px; width: 100%;"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="single-profile-settings h-100 mb-0 shadow-sm border-0">
                                                <div class="single-profile-settings-header p-0 mb-3">
                                                    <h5 class="inf-title title6 black_text fw_bold"><?php echo e(__('Income Source')); ?></h5>
                                                </div>
                                                <div class="single-profile-settings-inner p-0">
                                                    <canvas id="incomeSourceChart" style="height: 400px; width: 100%;"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mt-4 mb-4">
                                </div>
                            </div>

                            
                            <div class="single-profile-settings">
                                <div class="single-profile-settings-header">
                                    <div class="single-profile-settings-header-flex mb-4">
                                        <?php if (isset($component)) { $__componentOriginaldd5d165d00da56cf3441fe2a6f4754db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.form-title','data' => ['title' => __('Latest Orders'),'class' => 'inf-title title6 black_text fw_bold']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.form-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Latest Orders')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('inf-title title6 black_text fw_bold')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db)): ?>
<?php $attributes = $__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db; ?>
<?php unset($__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldd5d165d00da56cf3441fe2a6f4754db)): ?>
<?php $component = $__componentOriginaldd5d165d00da56cf3441fe2a6f4754db; ?>
<?php unset($__componentOriginaldd5d165d00da56cf3441fe2a6f4754db); ?>
<?php endif; ?>
                                        <a href="<?php echo e(route('influencer.order.all')); ?>" class="btn-profile btn-bg-1">
                                            <?php echo e(__('All Orders')); ?>

                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="single-profile-settings-inner">
                                    <div class="custom_table style-04">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th><?php echo e(__('Budget')); ?></th>
                                                    <th><?php echo e(__('Delivery Time')); ?></th>
                                                    <th><?php echo e(__('Payment Status')); ?></th>
                                                    <th><?php echo e(__('Create Date')); ?></th>
                                                    <th class="text-center"><?php echo e(__('Order Details')); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $latest_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td><?php echo e(float_amount_with_currency_symbol($order->price) ?? ''); ?>

                                                        </td>
                                                        <td><?php echo e(__($order->delivery_time) ?? ''); ?></td>
                                                        <td><span class="inf-status-badge success"><span
                                                                    class="dot"></span><?php echo e(__($order->payment_status) ?? ''); ?></span>
                                                        </td>
                                                        <td><?php echo e($order->created_at->toFormattedDateString()); ?></td>
                                                        <td class="text-center"><a
                                                                href="<?php echo e(route('influencer.order.details', $order->id)); ?>"
                                                                class="btn-profile btn-bg-1"><?php echo e(__('Order Details')); ?> <i
                                                                    class="fas fa-arrow-right"></i></a></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center">
                                                            <?php if (isset($component)) { $__componentOriginal8ae006de3c3ee1480e4c628ec92ae42e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ae006de3c3ee1480e4c628ec92ae42e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.not-found-dash','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.not-found-dash'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8ae006de3c3ee1480e4c628ec92ae42e)): ?>
<?php $attributes = $__attributesOriginal8ae006de3c3ee1480e4c628ec92ae42e; ?>
<?php unset($__attributesOriginal8ae006de3c3ee1480e4c628ec92ae42e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8ae006de3c3ee1480e4c628ec92ae42e)): ?>
<?php $component = $__componentOriginal8ae006de3c3ee1480e4c628ec92ae42e; ?>
<?php unset($__componentOriginal8ae006de3c3ee1480e4c628ec92ae42e); ?>
<?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            
                            <?php if(get_static_option('project_enable_disable') != 'disable'): ?>
                                <div class="single-profile-settings">
                                    <div class="single-profile-settings-header">
                                        <div class="single-profile-settings-header-flex">
                                            <?php if (isset($component)) { $__componentOriginaldd5d165d00da56cf3441fe2a6f4754db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.form-title','data' => ['title' => __('Latest Project'),'class' => 'inf-title title6 black_text fw_bold']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.form-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Latest Project')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('inf-title title6 black_text fw_bold')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db)): ?>
<?php $attributes = $__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db; ?>
<?php unset($__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldd5d165d00da56cf3441fe2a6f4754db)): ?>
<?php $component = $__componentOriginaldd5d165d00da56cf3441fe2a6f4754db; ?>
<?php unset($__componentOriginaldd5d165d00da56cf3441fe2a6f4754db); ?>
<?php endif; ?>
                                            <a href="<?php echo e(route('influencer.profile.details', Auth::guard('web')->user()->username)); ?>"
                                                class="btn-profile btn-bg-1"> <?php echo e(__('All Project')); ?> <i
                                                    class="fas fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="single-profile-settings-inner mt-4">
                                        <div class="custom_table style-04">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th><?php echo e(__('Title')); ?></th>
                                                        <th><?php echo e(__('Action')); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__empty_1 = true; $__currentLoopData = $my_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <tr>
                                                            <td><?php echo e($project->title); ?></td>
                                                            <td>
                                                                <div class="action-icon-btn-wraper">
                                                                    <a href="<?php echo e(route('influencer.project.edit', $project->id)); ?>"
                                                                        class="btn-icon btn-icon-primary edit_info_show_hide">
                                                                        <i class="fa-regular fa-pen-to-square"></i> </a>
                                                                    <?php if($project?->orders_count == 0): ?>
                                                                        <?php if (isset($component)) { $__componentOriginal3fbf901b7a9605f7e0b569a62d1c4715 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3fbf901b7a9605f7e0b569a62d1c4715 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.table.delete','data' => ['class' => 'btn-icon btn-icon-danger delete_project_iocn swal_delete_button','url' => route(
                                                                                'influencer.project.delete',
                                                                                $project->id,
                                                                            )]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status.table.delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('btn-icon btn-icon-danger delete_project_iocn swal_delete_button'),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route(
                                                                                'influencer.project.delete',
                                                                                $project->id,
                                                                            ))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3fbf901b7a9605f7e0b569a62d1c4715)): ?>
<?php $attributes = $__attributesOriginal3fbf901b7a9605f7e0b569a62d1c4715; ?>
<?php unset($__attributesOriginal3fbf901b7a9605f7e0b569a62d1c4715); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3fbf901b7a9605f7e0b569a62d1c4715)): ?>
<?php $component = $__componentOriginal3fbf901b7a9605f7e0b569a62d1c4715; ?>
<?php unset($__componentOriginal3fbf901b7a9605f7e0b569a62d1c4715); ?>
<?php endif; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                        <tr>
                                                            <td colspan="2" class="text-center">
                                                                <?php if (isset($component)) { $__componentOriginal8ae006de3c3ee1480e4c628ec92ae42e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ae006de3c3ee1480e4c628ec92ae42e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.not-found-dash','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.not-found-dash'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8ae006de3c3ee1480e4c628ec92ae42e)): ?>
<?php $attributes = $__attributesOriginal8ae006de3c3ee1480e4c628ec92ae42e; ?>
<?php unset($__attributesOriginal8ae006de3c3ee1480e4c628ec92ae42e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8ae006de3c3ee1480e4c628ec92ae42e)): ?>
<?php $component = $__componentOriginal8ae006de3c3ee1480e4c628ec92ae42e; ?>
<?php unset($__componentOriginal8ae006de3c3ee1480e4c628ec92ae42e); ?>
<?php endif; ?>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Profile Settings area end -->
    </main>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <?php if (isset($component)) { $__componentOriginal54c16274d3d0b2e3d7bba6b79dadebcb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal54c16274d3d0b2e3d7bba6b79dadebcb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sweet-alert.sweet-alert2-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sweet-alert.sweet-alert2-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal54c16274d3d0b2e3d7bba6b79dadebcb)): ?>
<?php $attributes = $__attributesOriginal54c16274d3d0b2e3d7bba6b79dadebcb; ?>
<?php unset($__attributesOriginal54c16274d3d0b2e3d7bba6b79dadebcb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal54c16274d3d0b2e3d7bba6b79dadebcb)): ?>
<?php $component = $__componentOriginal54c16274d3d0b2e3d7bba6b79dadebcb; ?>
<?php unset($__componentOriginal54c16274d3d0b2e3d7bba6b79dadebcb); ?>
<?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).on('click', '.swal_delete_button', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '<?php echo e(__('Are you sure to delete?')); ?>',
                text: '<?php echo e(__('You would not be able to revert this item!')); ?>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "<?php echo e(__('Yes, Delete it!')); ?>"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.swal_form_submit_btn').trigger('click');
                }
            });
        });

        $(document).ready(function() {
            // Global Currency Config
            const siteCurrencySymbol = "<?php echo e(site_currency_symbol()); ?>";
            const currencySymbolPosition = "<?php echo e(get_static_option('site_currency_symbol_position')); ?>";

            function formatCurrency(value) {
                let formatted = Math.round(value).toString();
                if (currencySymbolPosition === 'left' || currencySymbolPosition === '') {
                    return siteCurrencySymbol + formatted;
                } else {
                    return formatted + siteCurrencySymbol;
                }
            }

            // 1. Earnings & Orders Chart (Mixed)
            new Chart(document.getElementById("earningsChart"), {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($months, 15, 512) ?>,
                    datasets: [
                        {
                            label: "<?php echo e(__('Earnings')); ?>",
                            backgroundColor: "rgba(130, 128, 255, 0.7)",
                            borderColor: "#8280FF",
                            borderWidth: 1,
                            data: <?php echo json_encode($earningsData, 15, 512) ?>,
                            yAxisID: 'yEarning',
                        },
                        {
                            label: "<?php echo e(__('Orders Completed')); ?>",
                            type: 'line',
                            borderColor: "#4AD991",
                            backgroundColor: "rgba(74, 217, 145, 0.1)",
                            data: <?php echo json_encode($ordersCompletedData, 15, 512) ?>,
                            fill: true,
                            tension: 0.4,
                            yAxisID: 'yOrder',
                            pointRadius: 4,
                            pointHitRadius: 10
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    scales: {
                        yEarning: {
                            type: 'linear',
                            position: 'left',
                            title: { display: true, text: "<?php echo e(__('Earnings')); ?>" },
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return formatCurrency(value);
                                }
                            }
                        },
                        yOrder: {
                            type: 'linear',
                            position: 'right',
                            title: { display: true, text: "<?php echo e(__('Orders')); ?>" },
                            grid: { drawOnChartArea: false },
                            beginAtZero: true,
                            ticks: { precision: 0 }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.dataset.yAxisID === 'yEarning') {
                                        label += formatCurrency(context.parsed.y);
                                    } else {
                                        label += context.parsed.y;
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });

            // 2. Income Source Chart (Pie/Doughnut)
            new Chart(document.getElementById("incomeSourceChart"), {
                type: 'doughnut',
                data: {
                    labels: ["<?php echo e(__('Jobs')); ?>", "<?php echo e(__('Projects')); ?>"],
                    datasets: [{
                        data: [<?php echo e($jobIncome); ?>, <?php echo e($projectIncome); ?>],
                        backgroundColor: ["#FF9871", "#FFBB38"],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom' }
                    }
                }
            });
        });

        $(document).on('change', '#switch_profile', function(e){
            e.preventDefault();
            let role = $(this).val();
            $.ajax({
                url: "<?php echo e(route('influencer.switch.profile')); ?>",
                type: 'post',
                data: {role:role},
                success: function(res){
                    if(res.status == 'success'){
                        toastr_success_js("<?php echo e(__('Profile switched successfully.')); ?>");
                        if(res.user_role == 'client'){
                            window.location.href = "<?php echo e(route('client.dashboard')); ?>";
                        }else{
                            window.location.href = "<?php echo e(route('influencer.dashboard')); ?>";
                        }
                    }
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/prosdeliver/public_html/core/resources/views/frontend/user/influencer/dashboard/dashboard.blade.php ENDPATH**/ ?>