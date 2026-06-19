<?php $__env->startSection('site_title',__('Wallet History')); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .single-profile-settings-flex {
            justify-content: space-between;
        }
        .single-profile-settings-contents .single-profile-settings-contents-upload-btn {
            padding: 0;
        }
        .single-profile-settings .single-profile-settings-thumb {
            max-width: unset;
        }
        .balance-wallet {
            color: var(--paragraph-color);
        }
        .balance-wallet strong {
            color: var(--heading-color);
        }
        .single-profile-settings-thumb {
            width:unset;
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
                        <div class="profile-settings-wrapper">

                            <div class="single-profile-settings border-all" id="display_client_profile_photo">
                                <div class="single-profile-settings-flex">

                                    <div class="single-profile-settings-thumb">
                                        <h4 class="balance-wallet"><?php echo e(__('Balance:')); ?>

                                            <strong><?php echo e(float_amount_with_currency_symbol($total_wallet_balance ?? 00)); ?></strong>
                                        </h4>
                                        <p class="job-progress mt-2"><?php echo e(__('Earning+Deposit')); ?></p>
                                    </div>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <?php if($total_wallet_balance >= get_static_option('minimum_withdraw_amount')): ?>
                                        <div class="single-profile-settings-contents">
                                            <div class="single-profile-settings-contents-upload">
                                                <div class="">
                                                    <?php if(moduleExists('SecurityManage')): ?>
                                                        <?php if(Auth::guard('web')->user()->freeze_withdraw == 'freeze'): ?>
                                                            <button type="button" class="inf-cmn-btn style2 inf-primary-btn" disabled>
                                                                <?php echo e(__('Withdraw Request')); ?>

                                                            </button>
                                                        <?php else: ?>
                                                            <button class="inf-cmn-btn style2 inf-primary-btn" data-bs-toggle="modal" data-bs-target="#withdrawModal"><?php echo e(__('Withdraw Request')); ?></button>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <button class="inf-cmn-btn style2 inf-primary-btn" data-bs-toggle="modal" data-bs-target="#withdrawModal"><?php echo e(__('Withdraw Request')); ?></button>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="single-profile-settings-contents">
                                            <div class="single-profile-settings-contents-upload">
                                                <div class="">
                                                    <button class="inf-cmn-btn style2 inf-primary-outline-btn" data-bs-toggle="modal" data-bs-target="#paymentGatewayModal"><?php echo e(__('Deposit to Wallet')); ?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="single-profile-settings border-all" id="display_client_profile_info">
                                <div class="single-profile-settings-header">
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
                                    <div class="single-profile-settings-header-flex">
                                        <?php if (isset($component)) { $__componentOriginaldd5d165d00da56cf3441fe2a6f4754db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.form-title','data' => ['title' => __('Wallet History'),'class' => 'single-profile-settings-header-title']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.form-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Wallet History')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('single-profile-settings-header-title')]); ?>
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
                                        <?php if (isset($component)) { $__componentOriginal1c644339b8125d460a833ce180d39d8a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1c644339b8125d460a833ce180d39d8a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search.search-in-table','data' => ['id' => 'string_search','placeholder' => __('Enter date to search')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('search.search-in-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('string_search'),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Enter date to search'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1c644339b8125d460a833ce180d39d8a)): ?>
<?php $attributes = $__attributesOriginal1c644339b8125d460a833ce180d39d8a; ?>
<?php unset($__attributesOriginal1c644339b8125d460a833ce180d39d8a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1c644339b8125d460a833ce180d39d8a)): ?>
<?php $component = $__componentOriginal1c644339b8125d460a833ce180d39d8a; ?>
<?php unset($__componentOriginal1c644339b8125d460a833ce180d39d8a); ?>
<?php endif; ?>
                                    </div>
                                </div>
                                <div class="single-profile-settings-inner profile-border-top">
                                    <div class="custom_table style-04 search_result">
                                          <?php echo $__env->make('wallet::influencer.wallet.search-result', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Profile Settings area end -->
        <?php echo $__env->make('wallet::influencer.wallet.withdraw-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php if (isset($component)) { $__componentOriginal00b6a2a0f4a7fa69cf6a91f32a15b538 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal00b6a2a0f4a7fa69cf6a91f32a15b538 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.payment-gateway.gateway-markup','data' => ['title' => __('You can deposit to your wallet from the available payment gateway')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.payment-gateway.gateway-markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('You can deposit to your wallet from the available payment gateway'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal00b6a2a0f4a7fa69cf6a91f32a15b538)): ?>
<?php $attributes = $__attributesOriginal00b6a2a0f4a7fa69cf6a91f32a15b538; ?>
<?php unset($__attributesOriginal00b6a2a0f4a7fa69cf6a91f32a15b538); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal00b6a2a0f4a7fa69cf6a91f32a15b538)): ?>
<?php $component = $__componentOriginal00b6a2a0f4a7fa69cf6a91f32a15b538; ?>
<?php unset($__componentOriginal00b6a2a0f4a7fa69cf6a91f32a15b538); ?>
<?php endif; ?>
    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo $__env->make('wallet::influencer.wallet.wallet-js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php if (isset($component)) { $__componentOriginala8bbaec8b85679b9c75e7fd34ed38e55 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bbaec8b85679b9c75e7fd34ed38e55 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.payment-gateway.gateway-select-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.payment-gateway.gateway-select-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bbaec8b85679b9c75e7fd34ed38e55)): ?>
<?php $attributes = $__attributesOriginala8bbaec8b85679b9c75e7fd34ed38e55; ?>
<?php unset($__attributesOriginala8bbaec8b85679b9c75e7fd34ed38e55); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bbaec8b85679b9c75e7fd34ed38e55)): ?>
<?php $component = $__componentOriginala8bbaec8b85679b9c75e7fd34ed38e55; ?>
<?php unset($__componentOriginala8bbaec8b85679b9c75e7fd34ed38e55); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/prosdeliver/public_html/core/Modules/Wallet/Resources/views/influencer/wallet/wallet-history.blade.php ENDPATH**/ ?>