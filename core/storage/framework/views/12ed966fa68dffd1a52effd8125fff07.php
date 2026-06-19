<?php $__env->startSection('title', __('Payment Gateway Settings')); ?>

<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginalbc1bcd20222d67be5eb46ea1d22a74fa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbc1bcd20222d67be5eb46ea1d22a74fa = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('media.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbc1bcd20222d67be5eb46ea1d22a74fa)): ?>
<?php $attributes = $__attributesOriginalbc1bcd20222d67be5eb46ea1d22a74fa; ?>
<?php unset($__attributesOriginalbc1bcd20222d67be5eb46ea1d22a74fa); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbc1bcd20222d67be5eb46ea1d22a74fa)): ?>
<?php $component = $__componentOriginalbc1bcd20222d67be5eb46ea1d22a74fa; ?>
<?php unset($__componentOriginalbc1bcd20222d67be5eb46ea1d22a74fa); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalc9b7b8cd21a48778d8b7d695ecb54651 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc9b7b8cd21a48778d8b7d695ecb54651 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.summernote.summernote-css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('summernote.summernote-css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc9b7b8cd21a48778d8b7d695ecb54651)): ?>
<?php $attributes = $__attributesOriginalc9b7b8cd21a48778d8b7d695ecb54651; ?>
<?php unset($__attributesOriginalc9b7b8cd21a48778d8b7d695ecb54651); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc9b7b8cd21a48778d8b7d695ecb54651)): ?>
<?php $component = $__componentOriginalc9b7b8cd21a48778d8b7d695ecb54651; ?>
<?php unset($__componentOriginalc9b7b8cd21a48778d8b7d695ecb54651); ?>
<?php endif; ?>
    <style>
        .accordion-wrapper .card {
            margin-bottom: 20px;
        }

        .card {
            border: none;
            border-radius: 4px;
            background-color: #fff;
            -webkit-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
        }

        .summernote-wrapper .note-editing-area {
            height: 400px;
        }

        .note-editor.note-airframe .note-editing-area .note-editable, .note-editor.note-frame .note-editing-area .note-editable {
            height: 100%;
        }

        .select2-container {
            font-size: initial;
            display: grid;
            width: 100% !important;
        }

        .select2-dropdown {
            z-index: 1060 !important;
        }

        .select2-container--default .select2-results__option--selected {
            background-color: #ddd;
            padding: 0 6px;
        }

        .select2-results .select2-results__option {
            padding: 0 6px;
            color: var(--heading-color);
            font-size: 15px;
        }

        .select2-container--default .select2-results__option--selected {
            background-color: unset !important;
        }

        .select2-container {
            display: grid !important;
            z-index: 9992;
            display: grid;
            width: 100% !important;
        }

        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: #1967D2 !important;
            color: white;
        }

        .select2-container--open .select2-dropdown--below {
            border: 1px solid #aaa;
            box-shadow: 0 5px 16px #aaa;
        }

        .select2-container--default .select2-search--inline .select2-search__field {
            line-height: 1;
        }

        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da !important;
            height: 38px !important;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid var(--border-color);
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 38px !important;
            width: 42px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: var(--paragraph-color) !important;
            line-height: 38px !important;
        }

        .note-editor.note-airframe .note-editing-area .note-editable,
        .note-editor.note-frame .note-editing-area .note-editable {
            height: 250px;
        }

        .popup-contents-form .single-input .select2-container {
            z-index: 9992 !important;
        }
    </style>
    <?php if (isset($component)) { $__componentOriginal7a9f1fc0e33dbb5b6865e47c39fccade = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7a9f1fc0e33dbb5b6865e47c39fccade = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select2.select2-css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select2.select2-css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7a9f1fc0e33dbb5b6865e47c39fccade)): ?>
<?php $attributes = $__attributesOriginal7a9f1fc0e33dbb5b6865e47c39fccade; ?>
<?php unset($__attributesOriginal7a9f1fc0e33dbb5b6865e47c39fccade); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7a9f1fc0e33dbb5b6865e47c39fccade)): ?>
<?php $component = $__componentOriginal7a9f1fc0e33dbb5b6865e47c39fccade; ?>
<?php unset($__componentOriginal7a9f1fc0e33dbb5b6865e47c39fccade); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="dashboard__body">
        <div class="row">
            <div class="col-lg-12">
                <div class="customMarkup__single">
                    <div class="customMarkup__single__item">
                        <h4 class="customMarkup__single__title"><?php echo e(__('Payment Gateway Settings')); ?></h4>
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
                        <div class="customMarkup__single__inner mt-4">
                            <form action="<?php echo e(route('admin.payment.settings.gateway')); ?>" method="POST"
                                  enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="accordion-wrapper">
                                    <div id="accordion-payment">

                                        <div class="card">
                                            <div class="card-header" id="paypal_settings">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#paypal_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('Paypal Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="paypal_settings_content" class="collapse show"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">
                                                    <div class="payment-notice alert alert-warning">
                                                        <p><?php echo e(__('Notice: If PayPal does not support your currency, it will convert the value of your currency to USD based on the current exchange rate of your currency.')); ?></p>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable Paypal')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox" id="paypal_gateway"
                                                               name="paypal_gateway"
                                                               <?php if(!empty(get_static_option('paypal_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="paypal_gateway"><?php echo e(__('Enable Paypal')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable Test Mode For Paypal')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="paypal_test_mode" name="paypal_test_mode"
                                                               <?php if(!empty(get_static_option('paypal_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="paypal_test_mode"><?php echo e(__('Enable Test Mode For Paypal')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('Paypal Logo'),'name' => 'paypal_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Paypal Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('paypal_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="paypal_sandbox_client_id"
                                                               class="label-title mt-3"><?php echo e(__('Paypal Sandbox Client ID')); ?></label>
                                                        <input type="text" name="paypal_sandbox_client_id"
                                                               class="form-control"
                                                               value="<?php echo e(get_static_option('paypal_sandbox_client_id')); ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="paypal_sandbox_client_secret"
                                                               class="label-title mt-3"><?php echo e(__('Paypal Sandbox Client Secret')); ?></label>
                                                        <input type="text" name="paypal_sandbox_client_secret"
                                                               class="form-control"
                                                               value="<?php echo e(get_static_option('paypal_sandbox_client_secret')); ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="paypal_sandbox_app_id"
                                                               class="label-title mt-3"><?php echo e(__('Paypal Sandbox App ID')); ?></label>
                                                        <input type="text" name="paypal_sandbox_app_id"
                                                               class="form-control"
                                                               value="<?php echo e(get_static_option('paypal_sandbox_app_id')); ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="paypal_live_client_id"
                                                               class="label-title mt-3"><?php echo e(__('Paypal Live Client ID')); ?></label>
                                                        <input type="text" name="paypal_live_client_id"
                                                               class="form-control"
                                                               value="<?php echo e(get_static_option('paypal_live_client_id')); ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="paypal_live_client_secret"
                                                               class="label-title mt-3"><?php echo e(__('Paypal Live Client Secret')); ?></label>
                                                        <input type="text" name="paypal_live_client_secret"
                                                               class="form-control"
                                                               value="<?php echo e(get_static_option('paypal_live_client_secret')); ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="paypal_live_app_id"
                                                               class="label-title mt-3"><?php echo e(__('Paypal Live App ID')); ?></label>
                                                        <input type="text" name="paypal_live_app_id"
                                                               class="form-control"
                                                               value="<?php echo e(get_static_option('paypal_live_app_id')); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="paytm_settings">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#paytm_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('Paytm Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="paytm_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">
                                                    <div class="single-input">
                                                        <div class="payment-notice alert alert-warning">
                                                            <p><?php echo e(__('if your currency is not available in paytm, it will convert you currency value to INR value based on your currency exchange rate.')); ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Paytm')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox" id="paytm_gateway"
                                                               name="paytm_gateway"
                                                               <?php if(!empty(get_static_option('paytm_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="paytm_gateway"><?php echo e(__('Enable/Disable Paytm')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable Test Mode For Paytm')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="paytm_test_mode" name="paytm_test_mode"
                                                               <?php if(!empty(get_static_option('paytm_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="paytm_test_mode"><?php echo e(__('Enable Test Mode For Paytm')); ?></label>
                                                    </div>

                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('Paytm Logo'),'name' => 'paytm_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Paytm Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('paytm_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>

                                                    <div class="single-input">
                                                        <label for="paytm_merchant_key"
                                                               class="label-title mt-3"><?php echo e(__('Paytm Merchant Key')); ?></label>
                                                        <input type="text" name="paytm_merchant_key"
                                                               id="paytm_merchant_key"
                                                               value="<?php echo e(get_static_option('paytm_merchant_key')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="paytm_merchant_mid"
                                                               class="label-title mt-3"><?php echo e(__('Paytm Merchant ID')); ?></label>
                                                        <input type="text" name="paytm_merchant_mid"
                                                               id="paytm_merchant_mid"
                                                               value="<?php echo e(get_static_option('paytm_merchant_mid')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="paytm_merchant_website"
                                                               class="label-title mt-3"><?php echo e(__('Paytm Merchant Website')); ?></label>
                                                        <input type="text" name="paytm_merchant_website"
                                                               id="paytm_merchant_website"
                                                               value="<?php echo e(get_static_option('paytm_merchant_website')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="paytm_channel"
                                                               class="label-title mt-3"><?php echo e(__('Paytm channel')); ?></label>
                                                        <input type="text" name="paytm_channel"
                                                               value="<?php echo e(get_static_option('paytm_channel')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="paytm_industry_type"
                                                               class="label-title mt-3"><?php echo e(__('Paytm Industry Type')); ?></label>
                                                        <input type="text" name="paytm_industry_type"
                                                               value="<?php echo e(get_static_option('paytm_industry_type')); ?>"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="stripe_settings">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#stripe_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('Stripe Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="stripe_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">
                                                    <div class="payment-notice alert alert-warning">
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Stripe')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox" id="stripe_gateway"
                                                               name="stripe_gateway"
                                                               <?php if(!empty(get_static_option('stripe_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="stripe_gateway"><?php echo e(__('Enable/Disable Stripe')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable Test Mode For Stripe')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="stripe_test_mode" name="stripe_test_mode"
                                                               <?php if(!empty(get_static_option('stripe_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="stripe_test_mode"><?php echo e(__('Enable Test Mode For Stripe')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('Stripe Logo'),'name' => 'stripe_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Stripe Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('stripe_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="stripe_public_key"
                                                               class="label-title mt-3"><?php echo e(__('Stripe Public Key')); ?></label>
                                                        <input type="text" name="stripe_public_key"
                                                               id="stripe_public_key"
                                                               value="<?php echo e(get_static_option('stripe_public_key')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <label for="stripe_secret_key"
                                                               class="label-title mt-3"><?php echo e(__('Stripe Secret')); ?></label>
                                                        <input type="text" name="stripe_secret_key"
                                                               id="stripe_secret_key"
                                                               value="<?php echo e(get_static_option('stripe_secret_key')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <?php if(get_static_option('stripe_subscription_enabled') == 'on'): ?>
                                                        <div class="single-input mt-3">
                                                            <label for="stripe_webhook_secret"
                                                                   class="label-title mt-3"><?php echo e(__('Stripe Webhook Secret')); ?></label>
                                                            <input type="text" name="stripe_webhook_secret"
                                                                   id="stripe_webhook_secret"
                                                                   value="<?php echo e(get_static_option('stripe_webhook_secret')); ?>"
                                                                   class="form-control">
                                                        </div>
                                                        <div class="payment-notice alert alert-warning mt-3">
                                                            <p class="d-flex align-items-center">
                                                                <?php echo e(__("Main Account Webhook URL")); ?>:
                                                                <span id="webhook-url" class="ms-2"><?php echo e(route('bs.stripe.webhook')); ?></span>
                                                                <button type="button" class="btn btn-sm btn-light ms-2 copy-btn" title="Copy">
                                                                    <i class="fa fa-copy"></i>
                                                                </button>
                                                            </p>
                                                            <p>
                                                                <?php echo e(__("Events to listen:")); ?>

                                                                <strong><?php echo e(__('checkout.session.completed, customer.subscription.created, customer.subscription.deleted, customer.subscription.updated, invoice.created, invoice.paid,
invoice.payment_failed, invoice.payment_succeeded')); ?></strong>
                                                            </p>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="razorpay_settings">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#razorpay_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('Razorpay Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="razorpay_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">
                                                    <div class="payment-notice alert alert-warning">
                                                        <p><?php echo e(__("Available Currency For Razorpay is, ['INR']")); ?></p>
                                                        <p><?php echo e(__('if your currency is not available in Razorpay, it will convert you currency value to INR value based on your currency exchange rate.')); ?></p>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Razorpay')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="razorpay_gateway" name="razorpay_gateway"
                                                               <?php if(!empty(get_static_option('razorpay_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="razorpay_gateway"><?php echo e(__('Enable/Disable Razorpay')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable Test Mode For Razorpay')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="razorpay_test_mode" name="razorpay_test_mode"
                                                               <?php if(!empty(get_static_option('razorpay_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="razorpay_test_mode"><?php echo e(__('Enable Test Mode For Paypal')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('Razorpay Logo'),'name' => 'razorpay_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Razorpay Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('razorpay_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="razorpay_api_key"
                                                               class="label-title mt-3"><?php echo e(__('Razorpay Key')); ?></label>
                                                        <input type="text" name="razorpay_api_key" id="razorpay_api_key"
                                                               value="<?php echo e(get_static_option('razorpay_api_key')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="razorpay_api_secret"
                                                               class="label-title mt-3"><?php echo e(__('Razorpay Secret')); ?></label>
                                                        <input type="text" name="razorpay_api_secret"
                                                               id="razorpay_api_secret"
                                                               value="<?php echo e(get_static_option('razorpay_api_secret')); ?>"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="paystack_settings">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#paystack_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('PayStack Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="paystack_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">
                                                    <div class="payment-notice alert alert-warning">
                                                        <p><?php echo e(__('if your currency is not available in Paystack, it will convert you currency value to NGN value based on your currency exchange rate.')); ?></p>
                                                    </div>
                                                    <p class="margin-bottom-30 margin-top-20 info-paragraph">
                                                        <?php echo e(__('Don\'t forget to put below url to "Settings > API Key & Webhook > Callback URL" in your paystack admin panel')); ?>

                                                        <br>
                                                        <span class="bg-gray mt-3 p-3">https://xilancer.com/frontend/payments/paystack-ipn</span>
                                                    </p>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable PayStack')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="paystack_gateway" name="paystack_gateway"
                                                               <?php if(!empty(get_static_option('paystack_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="paystack_gateway"><?php echo e(__('Enable/Disable PayStack')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable Test Mode For PayStack')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="paystack_test_mode" name="paystack_test_mode"
                                                               <?php if(!empty(get_static_option('paystack_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="paystack_test_mode"><?php echo e(__('Enable Test Mode For PayStack')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('PayStack Logo'),'name' => 'paystack_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('PayStack Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('paystack_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="paystack_public_key"
                                                               class="label-title mt-3"><?php echo e(__('PayStack Public Key')); ?></label>
                                                        <input type="text" name="paystack_public_key"
                                                               id="paystack_public_key"
                                                               value="<?php echo e(get_static_option('paystack_public_key')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="paystack_secret_key"
                                                               class="label-title mt-3"><?php echo e(__('PayStack Secret Key')); ?></label>
                                                        <input type="text" name="paystack_secret_key"
                                                               id="paystack_secret_key"
                                                               value="<?php echo e(get_static_option('paystack_secret_key')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="paystack_merchant_email"
                                                               class="label-title mt-3"><?php echo e(__('PayStack Merchant Email')); ?></label>
                                                        <input type="text" name="paystack_merchant_email"
                                                               id="paystack_merchant_email"
                                                               value="<?php echo e(get_static_option('paystack_merchant_email')); ?>"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="mollie_settings">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#mollie_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('Mollie Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="mollie_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">
                                                    <div class="payment-notice alert alert-warning">
                                                        <p><?php echo e(__('if your currency is not available in mollie, it will convert you currency value to USD value based on your currency exchange rate.')); ?></p>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Mollie')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox" id="mollie_gateway"
                                                               name="mollie_gateway"
                                                               <?php if(!empty(get_static_option('mollie_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="mollie_gateway"><?php echo e(__('Enable/Disable Mollie')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable Test Mode For Mollie')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="mollie_test_mode" name="mollie_test_mode"
                                                               <?php if(!empty(get_static_option('mollie_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="mollie_test_mode"><?php echo e(__('Enable Test Mode For Mollie')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('Mollie Logo'),'name' => 'mollie_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Mollie Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('mollie_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="mollie_public_key"
                                                               class="label-title mt-3"><?php echo e(__('Mollie Public Key')); ?></label>
                                                        <input type="text" name="mollie_public_key"
                                                               id="mollie_public_key"
                                                               value="<?php echo e(get_static_option('mollie_public_key')); ?>"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="flluterwave_settings">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#flutterwave_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('Flutterwave Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="flutterwave_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">
                                                    <div class="payment-notice alert alert-warning">
                                                        <p><?php echo e(__('if your currency is not available in flutterwave, it will convert you currency value to USD value based on your currency exchange rate.')); ?></p>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Flutterwave')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="flutterwave_gateway" name="flutterwave_gateway"
                                                               <?php if(!empty(get_static_option('flutterwave_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="flutterwave_gateway"><?php echo e(__('Enable/Disable Flutterwave')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Test Mode Flutterwave')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="flutterwave_test_mode" name="flutterwave_test_mode"
                                                               <?php if(!empty(get_static_option('flutterwave_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="flutterwave_test_mode"><?php echo e(__('Enable/Disable Test Mode Flutterwave')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('Flutterwave Logo'),'name' => 'flutterwave_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Flutterwave Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('flutterwave_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="flw_public_key"
                                                               class="label-title mt-3"><?php echo e(__('Flutterwave Public Key')); ?></label>
                                                        <input type="text" name="flw_public_key" id="flw_public_key"
                                                               value="<?php echo e(get_static_option('flw_public_key')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="flw_secret_key"
                                                               class="label-title mt-3"><?php echo e(__('Flutterwave Secret Key')); ?></label>
                                                        <input type="text" name="flw_secret_key" id="flw_secret_key"
                                                               value="<?php echo e(get_static_option('flw_secret_key')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="flw_secret_hash"
                                                               class="label-title mt-3"><?php echo e(__('Flutterwave Secret Hash')); ?></label>
                                                        <input type="text" name="flw_secret_hash" id="flw_secret_hash"
                                                               value="<?php echo e(get_static_option('flw_secret_hash')); ?>"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="midtrans_settings">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#midtrans_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('MIdtranse Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="midtrans_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">

                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Midtrans')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="midtrans_gateway" name="midtrans_gateway"
                                                               <?php if(!empty(get_static_option('midtrans_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="midtrans_gateway"><?php echo e(__('Enable/Disable Midtrans')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Test Mode Midtrans')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="midtrans_test_mode" name="midtrans_test_mode"
                                                               <?php if(!empty(get_static_option('midtrans_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="midtrans_test_mode"><?php echo e(__('Enable/Disable Test Mode Midtrans')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('Midtranse Logo'),'name' => 'midtrans_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Midtranse Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('midtrans_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="midtrans_merchant_id"
                                                               class="label-title mt-3"><?php echo e(__('Midtranse Merchant ID (optional)')); ?></label>
                                                        <input type="text" name="midtrans_merchant_id"
                                                               id="midtrans_merchant_id"
                                                               value="<?php echo e(get_static_option('midtrans_merchant_id')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="midtrans_server_key"
                                                               class="label-title mt-3"><?php echo e(__('Midtranse Server Key')); ?></label>
                                                        <input type="text" name="midtrans_server_key"
                                                               id="midtrans_server_key"
                                                               value="<?php echo e(get_static_option('midtrans_server_key')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="midtrans_client_key"
                                                               class="label-title mt-3"><?php echo e(__('Midtranse Client Key')); ?></label>
                                                        <input type="text" name="midtrans_client_key"
                                                               id="midtrans_client_key"
                                                               value="<?php echo e(get_static_option('midtrans_client_key')); ?>"
                                                               class="form-control">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="payfast_settings">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#payfast_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('Payfast Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="payfast_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">

                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Payfast')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="payfast_gateway" name="payfast_gateway"
                                                               <?php if(!empty(get_static_option('payfast_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="payfast_gateway"><?php echo e(__('Enable/Disable Payfast')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/disable Test Mode Payfast')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="payfast_test_mode" name="payfast_test_mode"
                                                               <?php if(!empty(get_static_option('payfast_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="payfast_test_mode"><?php echo e(__('Enable/disable Test Mode Payfast')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('Payfast Logo'),'name' => 'payfast_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Payfast Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('payfast_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="midtrans_merchant_id"
                                                               class="label-title mt-3"><?php echo e(__('Payfast Merchant ID')); ?></label>
                                                        <input type="text" name="payfast_merchant_id"
                                                               id="payfast_merchant_id"
                                                               value="<?php echo e(get_static_option('payfast_merchant_id')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="midtrans_server_key"
                                                               class="label-title mt-3"><?php echo e(__('Payfast Merchant Key')); ?></label>
                                                        <input type="text" name="payfast_merchant_key"
                                                               id="payfast_merchant_key"
                                                               value="<?php echo e(get_static_option('payfast_merchant_key')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="midtrans_client_key"
                                                               class="label-title mt-3"><?php echo e(__('Payfast Passphrase')); ?></label>
                                                        <input type="text" name="payfast_passphrase"
                                                               id="payfast_passphrase"
                                                               value="<?php echo e(get_static_option('payfast_passphrase')); ?>"
                                                               class="form-control">
                                                    </div>

                                                    <div class="single-input">
                                                        <label for="midtrans_environment"
                                                               class="label-title mt-3"><?php echo e(__('Payfast ITN URL')); ?></label>
                                                        <input type="text" name="payfast_itn_url" id="payfast_itn_url"
                                                               value="<?php echo e(get_static_option('payfast_itn_url')); ?>"
                                                               class="form-control">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="cashfree_settings">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#cashfree_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('Cashfree Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="cashfree_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Cashfree')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="cashfree_gateway" name="cashfree_gateway"
                                                               <?php if(!empty(get_static_option('cashfree_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="cashfree_gateway"><?php echo e(__('Enable/Disable Cashfree')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Test Mode Cashfree')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="cashfree_test_mode" name="cashfree_test_mode"
                                                               <?php if(!empty(get_static_option('cashfree_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="cashfree_test_mode"><?php echo e(__('Enable/Disable Test Mode Cashfree')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('Cashfree Logo'),'name' => 'cashfree_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Cashfree Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('cashfree_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="cashfree_app_id"
                                                               class="label-title mt-3"><?php echo e(__('Cashfree App ID')); ?></label>
                                                        <input type="text" name="cashfree_app_id" id="cashfree_app_id"
                                                               value="<?php echo e(get_static_option('cashfree_app_id')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="cashfree_secret_key"
                                                               class="label-title mt-3"><?php echo e(__('Cashfree Secret Key')); ?></label>
                                                        <input type="text" name="cashfree_secret_key"
                                                               id="cashfree_secret_key"
                                                               value="<?php echo e(get_static_option('cashfree_secret_key')); ?>"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="instamojo_settings">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#instamojo_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('Instamojo Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="instamojo_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Instamojo')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="instamojo_gateway" name="instamojo_gateway"
                                                               <?php if(!empty(get_static_option('instamojo_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="instamojo_gateway"><?php echo e(__('Enable/Disable Instamojo')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/disable Test Mode Instamojo')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="instamojo_test_mode" name="instamojo_test_mode"
                                                               <?php if(!empty(get_static_option('instamojo_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="instamojo_test_mode"><?php echo e(__('Enable/disable Test Mode Instamojo')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('Instamojo Logo'),'name' => 'instamojo_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Instamojo Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('instamojo_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="instamojo_client_id"
                                                               class="label-title mt-3"><?php echo e(__('Instamojo Client ID')); ?></label>
                                                        <input type="text" name="instamojo_client_id"
                                                               id="instamojo_client_id"
                                                               value="<?php echo e(get_static_option('instamojo_client_id')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="instamojo_client_secret"
                                                               class="label-title mt-3"><?php echo e(__('Instamojo Client Secret')); ?></label>
                                                        <input type="text" name="instamojo_client_secret"
                                                               id="instamojo_client_secret"
                                                               value="<?php echo e(get_static_option('instamojo_client_secret')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="instamojo_username"
                                                               class="label-title mt-3"><?php echo e(__('Instamojo Username (optional)')); ?></label>
                                                        <input type="text" name="instamojo_username"
                                                               id="instamojo_username"
                                                               value="<?php echo e(get_static_option('instamojo_username')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="instamojo_password"
                                                               class="label-title mt-3"><?php echo e(__('Instamojo Password (optional)')); ?></label>
                                                        <input type="text" name="instamojo_password"
                                                               id="instamojo_password"
                                                               value="<?php echo e(get_static_option('instamojo_password')); ?>"
                                                               class="form-control">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="marcado_pago_settings">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#marcado_pago_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('Mercado Pago Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="marcado_pago_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Mercado Pago')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="marcadopago_gateway" name="marcadopago_gateway"
                                                               <?php if(!empty(get_static_option('marcadopago_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="marcadopago_gateway"><?php echo e(__('Enable/Disable Mercado Pago')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Test Mode Mercado Pago')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="marcadopago_test_mode" name="marcadopago_test_mode"
                                                               <?php if(!empty(get_static_option('marcadopago_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="marcadopago_test_mode"><?php echo e(__('Enable/Disable Test Mode Mercado Pago')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('Mercado Pago Logo'),'name' => 'marcadopago_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Mercado Pago Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('marcadopago_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="marcado_pago_client_id"
                                                               class="label-title mt-3"><?php echo e(__('Mercado Pago Client ID')); ?></label>
                                                        <input type="text" name="marcadopago_client_id"
                                                               id="marcadopago_client_id"
                                                               value="<?php echo e(get_static_option('marcadopago_client_id')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="marcado_pago_client_secret"
                                                               class="label-title mt-3">
                                                            <?php if(!empty(get_static_option('marcadopago_test_mode'))): ?>
                                                                <?php echo e(__('Mercedo Pago Client Secret')); ?>

                                                            <?php else: ?>
                                                                <?php echo e(__('Mercedo Pago Access Token')); ?>

                                                            <?php endif; ?>

                                                        </label>
                                                        <input type="text" name="marcadopago_client_secret"
                                                               id="marcadopago_client_secret"
                                                               value="<?php echo e(get_static_option('marcadopago_client_secret')); ?>"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        

                                        <div class="card">
                                            <div class="card-header" id="squareup_pago_settings">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#squareup_pago_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('Squareup Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="squareup_pago_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Squareup')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="squareup_gateway" name="squareup_gateway"
                                                               <?php if(!empty(get_static_option('squareup_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="squareup_gateway"><?php echo e(__('Enable/Disable Squareup')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Test Mode Squareup')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="squareup_test_mode" name="squareup_test_mode"
                                                               <?php if(!empty(get_static_option('squareup_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="squareup_test_mode"><?php echo e(__('Enable/Disable Test Mode Squareup')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('Squareup Logo'),'name' => 'squareup_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Squareup Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('squareup_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="squareup_access_token"
                                                               class="label-title mt-3"><?php echo e(__('Squareup Access Token')); ?></label>
                                                        <input type="text" name="squareup_access_token"
                                                               value="<?php echo e(get_static_option('squareup_access_token')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="squareup_location_id"
                                                               class="label-title mt-3"><?php echo e(__('Squareup Location ID')); ?></label>
                                                        <input type="text" name="squareup_location_id"
                                                               value="<?php echo e(get_static_option('squareup_location_id')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="squareup_application_id"
                                                               class="label-title mt-3"><?php echo e(__('Squareup Application ID (optional)')); ?></label>
                                                        <input type="text" name="squareup_application_id"
                                                               value="<?php echo e(get_static_option('squareup_application_id')); ?>"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        
                                        <div class="card">
                                            <div class="card-header" id="cinetpay_pago_settings">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#cinetpay_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('Cinetpay Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="cinetpay_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Cinetpay')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="cinetpay_gateway" name="cinetpay_gateway"
                                                               <?php if(!empty(get_static_option('cinetpay_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="cinetpay_gateway"><?php echo e(__('Enable/Disable Cinetpay')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Test Mode Cinetpay')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="cinetpay_test_mode" name="cinetpay_test_mode"
                                                               <?php if(!empty(get_static_option('cinetpay_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="cinetpay_test_mode"><?php echo e(__('Enable/Disable Test Mode Cinetpay')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('Cinetpay Logo'),'name' => 'cinetpay_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Cinetpay Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('cinetpay_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="cinetpay_app_key"
                                                               class="label-title mt-3"><?php echo e(__('Cinetpay App Key')); ?></label>
                                                        <input type="text" name="cinetpay_app_key"
                                                               value="<?php echo e(get_static_option('cinetpay_app_key')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="cinetpay_site_id"
                                                               class="label-title mt-3"><?php echo e(__('Cinetpay Site ID')); ?></label>
                                                        <input type="text" name="cinetpay_site_id"
                                                               value="<?php echo e(get_static_option('cinetpay_site_id')); ?>"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        
                                        <div class="card">
                                            <div class="card-header" id="paytabs_pago_settings">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#paytabs_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('Paytabs Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="paytabs_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">

                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Paytabs')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="paytabs_gateway" name="paytabs_gateway"
                                                               <?php if(!empty(get_static_option('paytabs_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="paytabs_gateway"><?php echo e(__('Enable/Disable Paytabs')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Test Mode Paytabs')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="paytabs_test_mode" name="paytabs_test_mode"
                                                               <?php if(!empty(get_static_option('paytabs_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="paytabs_test_mode"><?php echo e(__('Enable/Disable Test Mode Paytabs')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('Paytabs Logo'),'name' => 'paytabs_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Paytabs Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('paytabs_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>

                                                    <div class="single-input">
                                                        <label for="paytabs_server_key"
                                                               class="label-title mt-3"><?php echo e(__('Paytabs Server Key')); ?></label>
                                                        <input type="text" name="paytabs_server_key"
                                                               value="<?php echo e(get_static_option('paytabs_server_key')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="paytabs_profile_id"
                                                               class="label-title mt-3"><?php echo e(__('Paytabs Profile ID')); ?></label>
                                                        <input type="text" name="paytabs_profile_id"
                                                               value="<?php echo e(get_static_option('paytabs_profile_id')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="paytabs_profile_id"
                                                               class="label-title mt-3"><?php echo e(__('Region')); ?></label>
                                                        <?php
                                                            $paytabs_region = ['GLOBAL','ARE','EGY','SAU','OMN','JOR'];
                                                        ?>
                                                        <select name="paytabs_region" class="form-control">
                                                            <?php $__currentLoopData = $paytabs_region; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option <?php if($reg === get_static_option('paytabs_region')): echo 'checked'; endif; ?> value="<?php echo e($reg); ?>"><?php echo e($reg); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        


                                        
                                        <div class="card">
                                            <div class="card-header" id="billplz_pago_settings">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#billplz_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('BillPlz Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="billplz_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">

                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable BillPlz')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="billplz_gateway" name="billplz_gateway"
                                                               <?php if(!empty(get_static_option('billplz_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="billplz_gateway"><?php echo e(__('Enable/Disable Paytabs')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Test Mode BillPlz')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="billplz_test_mode" name="billplz_test_mode"
                                                               <?php if(!empty(get_static_option('billplz_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="billplz_test_mode"><?php echo e(__('Enable/Disable Test Mode Paytabs')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('BillPlz Logo'),'name' => 'billplz_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('BillPlz Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('billplz_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="billplz_key"
                                                               class="label-title mt-3"><?php echo e(__('BillPlz Key')); ?></label>
                                                        <input type="text" name="billplz_key"
                                                               value="<?php echo e(get_static_option('billplz_key')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="billplz_xsignature"
                                                               class="label-title mt-3"><?php echo e(__('BillPlz xSignature')); ?></label>
                                                        <input type="text" name="billplz_xsignature"
                                                               value="<?php echo e(get_static_option('billplz_xsignature')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="billplz_collection_name"
                                                               class="label-title mt-3"><?php echo e(__('BillPlz Collection Name')); ?></label>
                                                        <input type="text" name="billplz_collection_name"
                                                               value="<?php echo e(get_static_option('billplz_collection_name')); ?>"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        
                                        <div class="card">
                                            <div class="card-header" id="zitopay_pago_settings">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#zitopay_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('Zitopay Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="zitopay_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">

                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable BillPlz')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="zitopay_gateway" name="zitopay_gateway"
                                                               <?php if(!empty(get_static_option('zitopay_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="zitopay_gateway"><?php echo e(__('Enable/Disable Zitopay')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Test Mode Zitopay')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="zitopay_test_mode" name="zitopay_test_mode"
                                                               <?php if(!empty(get_static_option('zitopay_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="zitopay_test_mode"><?php echo e(__('Enable/Disable Test Mode Zitopay')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('BillPlz Logo'),'name' => 'zitopay_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('BillPlz Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('zitopay_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="zitopay_username"
                                                               class="label-title mt-3"><?php echo e(__('Zitopay Username')); ?></label>
                                                        <input type="text" name="zitopay_username"
                                                               value="<?php echo e(get_static_option('zitopay_username')); ?>"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        
                                        <div class="card">
                                            <div class="card-header" id="toyyibpay_pago_content">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#toyyibpay_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('Toyyibpay Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="toyyibpay_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">

                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Toyyibpay')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="toyyibpay_gateway" name="toyyibpay_gateway"
                                                               <?php if(!empty(get_static_option('toyyibpay_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="toyyibpay_gateway"><?php echo e(__('Enable/Disable Toyyibpay')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Test Mode Toyyibpay')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="toyyibpay_test_mode" name="toyyibpay_test_mode"
                                                               <?php if(!empty(get_static_option('toyyibpay_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="toyyibpay_test_mode"><?php echo e(__('Enable/Disable Test Mode Toyyibpay')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('Toyyibpay Logo'),'name' => 'toyyibpay_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Toyyibpay Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('toyyibpay_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="toyyibpay_secrect_key"
                                                               class="label-title mt-3"><?php echo e(__('Toyyibpay Secrect Key')); ?></label>
                                                        <input type="text" name="toyyibpay_secrect_key"
                                                               value="<?php echo e(get_static_option('toyyibpay_secrect_key')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="toyyibpay_secrect_key"
                                                               class="label-title mt-3"><?php echo e(__('Toyyibpay Category Code')); ?></label>
                                                        <input type="text" name="toyyibpay_category_code"
                                                               value="<?php echo e(get_static_option('toyyibpay_category_code')); ?>"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        
                                        <div class="card">
                                            <div class="card-header" id="pagali_pago_content">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#pagali_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('Pagali Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="pagali_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">

                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Pagali')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox" id="pagali_gateway"
                                                               name="pagali_gateway"
                                                               <?php if(!empty(get_static_option('pagali_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="pagali_gateway"><?php echo e(__('Enable/Disable Pagali')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Test Mode Pagali')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="pagali_test_mode" name="pagali_test_mode"
                                                               <?php if(!empty(get_static_option('pagali_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="pagali_test_mode"><?php echo e(__('Enable/Disable Test Mode Pagali')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('Pagali Logo'),'name' => 'pagali_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Pagali Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('pagali_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="pagali_page_id"
                                                               class="label-title mt-3"><?php echo e(__('Pagali Page ID')); ?></label>
                                                        <input type="text" name="pagali_page_id"
                                                               value="<?php echo e(get_static_option('pagali_page_id')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="pagali_entity_id"
                                                               class="label-title mt-3"><?php echo e(__('Pagali Entity ID')); ?></label>
                                                        <input type="text" name="pagali_entity_id"
                                                               value="<?php echo e(get_static_option('pagali_entity_id')); ?>"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        
                                        <div class="card">
                                            <div class="card-header" id="authorize_dot_net_pago_content">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#authorize_dot_net_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('Authorize.Net Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="authorize_dot_net_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">

                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Authorize.Net')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="authorize_dot_net_gateway"
                                                               name="authorize_dot_net_gateway"
                                                               <?php if(!empty(get_static_option('authorize_dot_net_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="authorize_dot_net_gateway"><?php echo e(__('Enable/Disable Authorize.Net')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Test Mode Authorize.Net')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="authorize_dot_net_test_mode"
                                                               name="authorize_dot_net_test_mode"
                                                               <?php if(!empty(get_static_option('authorize_dot_net_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="authorize_dot_net_test_mode"><?php echo e(__('Enable/Disable Test Mode Authorize.Net')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('Authorize.Net Logo'),'name' => 'authorize_dot_net_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Authorize.Net Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('authorize_dot_net_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="pagali_page_id"
                                                               class="label-title mt-3"><?php echo e(__('Authorize.Net Login ID')); ?></label>
                                                        <input type="text" name="authorize_dot_net_login_id"
                                                               value="<?php echo e(get_static_option('authorize_dot_net_login_id')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="pagali_entity_id"
                                                               class="label-title mt-3"><?php echo e(__('Authorize.Net Transaction ID')); ?></label>
                                                        <input type="text" name="authorize_dot_net_transaction_id"
                                                               value="<?php echo e(get_static_option('authorize_dot_net_transaction_id')); ?>"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        
                                        <div class="card">
                                            <div class="card-header" id="authorize_dot_net_pago_content">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#sitesway_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('SitesWay Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="sitesway_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">

                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable SitesWay')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="sitesway_gateway" name="sitesway_gateway"
                                                               <?php if(!empty(get_static_option('sitesway_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="sitesway_gateway"><?php echo e(__('Enable/Disable SitesWay')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Test Mode SitesWay')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="sitesway_test_mode" name="sitesway_test_mode"
                                                               <?php if(!empty(get_static_option('sitesway_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="sitesway_test_mode"><?php echo e(__('Enable/Disable Test Mode SitesWay')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('SitesWay Logo'),'name' => 'sitesway_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('SitesWay Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('sitesway_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="sitesway_brand_id"
                                                               class="label-title mt-3"><?php echo e(__('SitesWay Brand ID')); ?></label>
                                                        <input type="text" name="sitesway_brand_id"
                                                               value="<?php echo e(get_static_option('sitesway_brand_id')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="sitesway_api_key"
                                                               class="label-title mt-3"><?php echo e(__('SitesWay API Key')); ?></label>
                                                        <input type="text" name="sitesway_api_key"
                                                               value="<?php echo e(get_static_option('sitesway_api_key')); ?>"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        
                                        <div class="card">
                                            <div class="card-header" id="iyzipay_pago_content">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#iyzipay_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('Iyzipay Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="iyzipay_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">

                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Iyzipay')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="iyzipay_gateway" name="iyzipay_gateway"
                                                               <?php if(!empty(get_static_option('iyzipay_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="iyzipay_gateway"><?php echo e(__('Enable/Disable Iyzipay')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Test Mode Iyzipay')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="iyzipay_test_mode" name="iyzipay_test_mode"
                                                               <?php if(!empty(get_static_option('iyzipay_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="iyzipay_test_mode"><?php echo e(__('Enable/Disable Test Mode Iyzipay')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('Iyzipay Logo'),'name' => 'iyzipay_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Iyzipay Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('iyzipay_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="iyzipay_secret_key"
                                                               class="label-title mt-3"><?php echo e(__('Iyzipay secret Key')); ?></label>
                                                        <input type="text" name="iyzipay_secret_key"
                                                               value="<?php echo e(get_static_option('iyzipay_secret_key')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="iyzipay_api_key"
                                                               class="label-title mt-3"><?php echo e(__('Iyzipay API Key')); ?></label>
                                                        <input type="text" name="iyzipay_api_key"
                                                               value="<?php echo e(get_static_option('iyzipay_api_key')); ?>"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        
                                        <div class="card">
                                            <div class="card-header" id="kinetic_pago_content">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#kineticpay_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('KineticPay Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="kineticpay_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">

                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable KineticPay')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="kineticpay_gateway" name="kineticpay_gateway"
                                                               <?php if(!empty(get_static_option('kineticpay_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="kineticpay_gateway"><?php echo e(__('Enable/Disable KineticPay')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Test Mode KineticPay')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="kineticpay_test_mode" name="kineticpay_test_mode"
                                                               <?php if(!empty(get_static_option('kineticpay_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="kineticpay_test_mode"><?php echo e(__('Enable/Disable Test Mode KineticPay')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('KineticPay Logo'),'name' => 'kineticpay_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('KineticPay Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('kineticpay_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="iyzipay_secret_key"
                                                               class="label-title mt-3"><?php echo e(__('KineticPay Merchant Key')); ?></label>
                                                        <input type="text" name="kineticpay_merchant_key"
                                                               value="<?php echo e(get_static_option('kineticpay_merchant_key')); ?>"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        
                                        <div class="card">
                                            <div class="card-header" id="awdpay_pago_content">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#awdpay_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('Awdpay Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="awdpay_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">

                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Awdpay')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox" id="awdpay_gateway"
                                                               name="awdpay_gateway"
                                                               <?php if(!empty(get_static_option('awdpay_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="awdpay_gateway"><?php echo e(__('Enable/Disable Awdpay')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Test Mode Awdpay')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="awdpay_test_mode" name="awdpay_test_mode"
                                                               <?php if(!empty(get_static_option('awdpay_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="awdpay_test_mode"><?php echo e(__('Enable/Disable Test Mode Awdpay')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('Awdpay Logo'),'name' => 'awdpay_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Awdpay Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('awdpay_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="awdpay_private_key"
                                                               class="label-title mt-3"><?php echo e(__('Set Private Key')); ?></label>
                                                        <input type="text" name="awdpay_private_key"
                                                               value="<?php echo e(get_static_option('awdpay_private_key')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="awdpay_logo_url"
                                                               class="label-title mt-3"><?php echo e(__('Set Url Logo')); ?></label>
                                                        <input type="text" name="awdpay_logo_url"
                                                               value="<?php echo e(get_static_option('awdpay_logo_url')); ?>"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        
                                        <div class="card">
                                            <div class="card-header" id="sslcommerce_pago_content">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#sslcommerce_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('Sslcommerce Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="sslcommerce_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">

                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Sslcommerce')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox" id="sslcommerce_gateway" name="sslcommerce_gateway"
                                                               <?php if(!empty(get_static_option('sslcommerce_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label" for="sslcommerce_gateway"><?php echo e(__('Enable/Disable Sslcommerce')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Test Mode Sslcommerce')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="sslcommerce_test_mode" name="sslcommerce_test_mode"
                                                               <?php if(!empty(get_static_option('sslcommerce_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="sslcommerce_test_mode"><?php echo e(__('Enable/Disable Test Mode Sslcommerce')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('Sslcommerce Logo'),'name' => 'sslcommerce_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Sslcommerce Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('sslcommerce_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="sslcommerce_store_id"
                                                               class="label-title mt-3"><?php echo e(__('Set Store ID')); ?></label>
                                                        <input type="text" name="sslcommerce_store_id"
                                                               value="<?php echo e(get_static_option('sslcommerce_store_id')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="sslcommerce_store_password"
                                                               class="label-title mt-3"><?php echo e(__('Set Store Password')); ?></label>
                                                        <input type="text" name="sslcommerce_store_password"
                                                               value="<?php echo e(get_static_option('sslcommerce_store_password')); ?>"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <?php if(moduleExists("YooMoneyPaymentGateway")): ?>
                                            
                                            <div class="card">
                                                <div class="card-header" id="yoomoney_pago_content">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#yoomoney_settings_content"
                                                                aria-expanded="false">
                                                            <span class="page-title"> <?php echo e(__('YooMoney Settings')); ?></span>
                                                        </button>
                                                    </h5>
                                                </div>

                                                <div id="yoomoney_settings_content" class="collapse"
                                                     data-parent="#accordion-payment">
                                                    <div class="card-body">

                                                        <div class="switch">
                                                            <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable YooMoney')); ?></strong></label>
                                                            <input class="custom-switch" type="checkbox"
                                                                   id="yoomoney_gateway" name="yoomoney_gateway"
                                                                   <?php if(!empty(get_static_option('yoomoney_gateway'))): ?> checked <?php endif; ?>>
                                                            <label class="switch-label"
                                                                   for="yoomoney_gateway"><?php echo e(__('Enable/Disable YooMoney')); ?></label>
                                                        </div>
                                                        <div class="switch">
                                                            <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Test Mode YooMoney')); ?></strong></label>
                                                            <input class="custom-switch" type="checkbox"
                                                                   id="yoomoney_test_mode" name="yoomoney_test_mode"
                                                                   <?php if(!empty(get_static_option('yoomoney_test_mode'))): ?> checked <?php endif; ?>>
                                                            <label class="switch-label"
                                                                   for="yoomoney_test_mode"><?php echo e(__('Enable/Disable Test Mode YooMoney')); ?></label>
                                                        </div>
                                                        <div class="single-input mt-3">
                                                            <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('YooMoney Logo'),'name' => 'yoomoney_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('YooMoney Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('yoomoney_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                        </div>
                                                        <div class="single-input">
                                                            <label for="yoomoney_shop_id"
                                                                   class="label-title mt-3"><?php echo e(__('Set Shop ID')); ?></label>
                                                            <input type="text" name="yoomoney_shop_id"
                                                                   value="<?php echo e(get_static_option('yoomoney_shop_id')); ?>"
                                                                   class="form-control">
                                                        </div>
                                                        <div class="single-input">
                                                            <label for="yoomoney_secret_key"
                                                                   class="label-title mt-3"><?php echo e(__('Set Secret Key')); ?></label>
                                                            <input type="text" name="yoomoney_secret_key"
                                                                   value="<?php echo e(get_static_option('yoomoney_secret_key')); ?>"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        <?php endif; ?>

                                        <?php if(moduleExists("CoinPaymentGateway")): ?>
                                            
                                            <div class="card">
                                                <div class="card-header" id="coinpayment_pago_content">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#coinpayment_settings_content"
                                                                aria-expanded="false">
                                                            <span class="page-title"> <?php echo e(__('CoinPayments Settings')); ?></span>
                                                        </button>
                                                    </h5>
                                                </div>

                                                <div id="coinpayment_settings_content" class="collapse"
                                                     data-parent="#accordion-payment">
                                                    <div class="card-body">

                                                        <div class="switch">
                                                            <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable CoinPayments')); ?></strong></label>
                                                            <input class="custom-switch" type="checkbox"
                                                                   id="coinpayments_gateway" name="coinpayments_gateway"
                                                                   <?php if(!empty(get_static_option('coinpayments_gateway'))): ?> checked <?php endif; ?>>
                                                            <label class="switch-label"
                                                                   for="coinpayments_gateway"><?php echo e(__('Enable/Disable CoinPayments')); ?></label>
                                                        </div>
                                                        <div class="switch">
                                                            <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Test Mode CoinPayments')); ?></strong></label>
                                                            <input class="custom-switch" type="checkbox"
                                                                   id="coinpayments_test_mode"
                                                                   name="coinpayments_test_mode"
                                                                   <?php if(!empty(get_static_option('coinpayments_test_mode'))): ?> checked <?php endif; ?>>
                                                            <label class="switch-label"
                                                                   for="coinpayments_test_mode"><?php echo e(__('Enable/Disable Test Mode CoinPayments')); ?></label>
                                                        </div>
                                                        <div class="single-input mt-3">
                                                            <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('CoinPayments Logo'),'name' => 'coinpayments_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('CoinPayments Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('coinpayments_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                        </div>
                                                        <div class="single-input">
                                                            <label for="coinpayments_merchant"
                                                                   class="label-title mt-3"><?php echo e(__('Set Merchant')); ?></label>
                                                            <input type="text" name="coinpayments_merchant"
                                                                   value="<?php echo e(get_static_option('coinpayments_merchant')); ?>"
                                                                   class="form-control">
                                                        </div>
                                                        <div class="single-input">
                                                            <label for="coinpayments_ipn_pin"
                                                                   class="label-title mt-3"><?php echo e(__('Set IPN Pin')); ?></label>
                                                            <input type="password" name="coinpayments_ipn_pin"
                                                                   value="<?php echo e(get_static_option('coinpayments_ipn_pin')); ?>"
                                                                   class="form-control">
                                                        </div>

                                                        <?php
                                                            $currency_list = [
                                                                "USD",'LTCT','ZEN','ZEC','XVG','XMR','XEM','USDT.TRC20',
                                                                'USDT.SOL','USDT','USDC.TRC20','USDC.SOL','TUSD.TRC20',
                                                                'TRX','SYS','SOL','RVN','QTUM','PIVX','OMNI','MSOL.SOL',
                                                                'MNDE.SOL','MATIC.POLY','MAID','MAD','JST.TRC20','ISLM.EVM',
                                                                'FTN.BAHAMUT','FIRO','ETH','ETC','DOGE','DGB','DASH','CNHT.TRC20',
                                                                'BXN','BUSD.TRC20','BTT.TRC20','BNB.BSC','BNB','VLX.Native','VLX',
                                                                'LTC','BCH','BTC.LN','BTC'];

                                                            $coinpay_urrency = get_static_option('coinpay_currency') ?? '';
                                                            $decoded_currency = json_decode($coinpay_urrency, true);
                                                        ?>
                                                        <div class="single-input mt-2">
                                                            <label class="label-title"><?php echo e(__('Select Currency')); ?></label>
                                                            <select name="coinpay_currency[]" id="coinpay_currency"
                                                                    class="form-control currency_list_select2" multiple>
                                                                <?php $__currentLoopData = $currency_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($list); ?>" <?php echo e(in_array($list, $decoded_currency ?? [], true) ? 'selected' : ''); ?>><?php echo e($list); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                            <small><?php echo e(__('info: for test payment you must select LTCT')); ?></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        <?php endif; ?>


                                        
                                        <div class="card">
                                            <div class="card-header" id="xendit_pago_content">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#xendit_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('Xendit Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="xendit_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">

                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Xendit')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox" id="xendit_gateway"
                                                               name="xendit_gateway"
                                                               <?php if(!empty(get_static_option('xendit_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="xendit_gateway"><?php echo e(__('Enable/Disable Xendit')); ?></label>
                                                    </div>
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Test Mode Xendit')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="xendit_test_mode" name="xendit_test_mode"
                                                               <?php if(!empty(get_static_option('xendit_test_mode'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="xendit_test_mode"><?php echo e(__('Enable/Disable Test Mode Xendit')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('Xendit Logo'),'name' => 'xendit_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Xendit Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('xendit_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="xendit_secret_key"
                                                               class="label-title mt-3"><?php echo e(__('Set Secret Key')); ?></label>
                                                        <input type="text" name="xendit_secret_key"
                                                               value="<?php echo e(get_static_option('xendit_secret_key')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="xendit_webhook_token"
                                                               class="label-title mt-3"><?php echo e(__('Set Webhook Token')); ?></label>
                                                        <input type="text" name="xendit_webhook_token"
                                                               value="<?php echo e(get_static_option('xendit_webhook_token')); ?>"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        
                                        <div class="card">
                                            <div class="card-header" id="manual_payment_settings">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#manual_payment_settings_content"
                                                            aria-expanded="false">
                                                        <span class="page-title"> <?php echo e(__('Manual Payment Settings')); ?></span>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="manual_payment_settings_content" class="collapse"
                                                 data-parent="#accordion-payment">
                                                <div class="card-body">
                                                    <div class="switch">
                                                        <label class="label-title mt-3"><strong><?php echo e(__('Enable/Disable Manual Payment')); ?></strong></label>
                                                        <input class="custom-switch" type="checkbox"
                                                               id="manual_payment_gateway" name="manual_payment_gateway"
                                                               <?php if(!empty(get_static_option('manual_payment_gateway'))): ?> checked <?php endif; ?>>
                                                        <label class="switch-label"
                                                               for="manual_payment_gateway"><?php echo e(__('Enable/Disable Manual Payment')); ?></label>
                                                    </div>
                                                    <div class="single-input mt-3">
                                                        <?php if (isset($component)) { $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.image','data' => ['title' => __('Manual Payment Logo'),'name' => 'manual_payment_preview_logo','dimentions' => '160x50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Manual Payment Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('manual_payment_preview_logo'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('160x50')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $attributes = $__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__attributesOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683)): ?>
<?php $component = $__componentOriginal4be7a5cfe07410f509969b1a6f3d4683; ?>
<?php unset($__componentOriginal4be7a5cfe07410f509969b1a6f3d4683); ?>
<?php endif; ?>
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="manual_payment_gateway_name"
                                                               class="label-title mt-3"><?php echo e(__('Manual Payment Name')); ?></label>
                                                        <input type="text" name="manual_payment_gateway_name"
                                                               id="manual_payment_gateway_name"
                                                               value="<?php echo e(get_static_option('manual_payment_gateway_name')); ?>"
                                                               class="form-control">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="site_manual_payment_description"
                                                               class="label-title mt-3"><?php echo e(__('Manual Payment Description')); ?></label>
                                                        <div class="summernote-wrapper">
                                                            <textarea class="summernote form-control"
                                                                      name="site_manual_payment_description"
                                                                      id="site_manual_payment_description"><?php echo e(get_static_option('site_manual_payment_description')); ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                    </div>
                                </div>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('payment-gateway-settings')): ?>
                                    <button type="submit" id="update"
                                            class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                                <?php endif; ?>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginal0a0c44ec0e77c6e781a03c2fda86fc75 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0a0c44ec0e77c6e781a03c2fda86fc75 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.markup','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('media.markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0a0c44ec0e77c6e781a03c2fda86fc75)): ?>
<?php $attributes = $__attributesOriginal0a0c44ec0e77c6e781a03c2fda86fc75; ?>
<?php unset($__attributesOriginal0a0c44ec0e77c6e781a03c2fda86fc75); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0a0c44ec0e77c6e781a03c2fda86fc75)): ?>
<?php $component = $__componentOriginal0a0c44ec0e77c6e781a03c2fda86fc75; ?>
<?php unset($__componentOriginal0a0c44ec0e77c6e781a03c2fda86fc75); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php if (isset($component)) { $__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('media.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e)): ?>
<?php $attributes = $__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e; ?>
<?php unset($__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e)): ?>
<?php $component = $__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e; ?>
<?php unset($__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalc522360e2a07084453b413c76e27c7e9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc522360e2a07084453b413c76e27c7e9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.summernote.summernote-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('summernote.summernote-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc522360e2a07084453b413c76e27c7e9)): ?>
<?php $attributes = $__attributesOriginalc522360e2a07084453b413c76e27c7e9; ?>
<?php unset($__attributesOriginalc522360e2a07084453b413c76e27c7e9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc522360e2a07084453b413c76e27c7e9)): ?>
<?php $component = $__componentOriginalc522360e2a07084453b413c76e27c7e9; ?>
<?php unset($__componentOriginalc522360e2a07084453b413c76e27c7e9); ?>
<?php endif; ?>
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
    <?php if (isset($component)) { $__componentOriginala34b824a201f14e7e09beb6785e605e8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala34b824a201f14e7e09beb6785e605e8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select2.select2-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select2.select2-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala34b824a201f14e7e09beb6785e605e8)): ?>
<?php $attributes = $__attributesOriginala34b824a201f14e7e09beb6785e605e8; ?>
<?php unset($__attributesOriginala34b824a201f14e7e09beb6785e605e8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala34b824a201f14e7e09beb6785e605e8)): ?>
<?php $component = $__componentOriginala34b824a201f14e7e09beb6785e605e8; ?>
<?php unset($__componentOriginala34b824a201f14e7e09beb6785e605e8); ?>
<?php endif; ?>

    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                $('#site_manual_payment_description').summernote();
                $('.currency_list_select2').select2();
            });

            $(document).on('click', '.copy-btn', function () {
                var url = $('#webhook-url').text();
                var tempInput = $('<input>');
                $('body').append(tempInput);
                tempInput.val(url).select();
                document.execCommand('copy');
                tempInput.remove();
                toastr_success_js('Copied to clipboard: ' + url)
            });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/prosdeliver/public_html/core/Modules/PaymentGatewaySettings/Resources/views/payment-gateway.blade.php ENDPATH**/ ?>