<?php $__env->startSection('title', __('Payment Info Settings')); ?>

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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="dashboard__body">
        <div class="row">
            <div class="col-lg-12">
                <div class="customMarkup__single">
                    <div class="customMarkup__single__item">
                        <h4 class="customMarkup__single__title"><?php echo e(__('Payment Info Settings')); ?></h4>
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
                            <form action="<?php echo e(route('admin.payment.settings.info')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="single-input">
                                    <label for="site_global_currency" class="label-title mt-3"><?php echo e(__('Site Global Currency')); ?></label>
                                    <select name="site_global_currency" class="form-control" id="site_global_currency">
                                        <?php $__currentLoopData = getAllCurrency(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cur => $symbol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($cur); ?>"
                                                    <?php if(get_static_option('site_global_currency') == $cur): ?> selected <?php endif; ?>
                                            >
                                                <?php echo e($cur.' ( '.$symbol.' )'); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="single-input">
                                    <label for="enable_disable_decimal_point" class="label-title mt-3"><?php echo e(__('Enable/Disable Decimal Point')); ?></label>
                                    <select name="enable_disable_decimal_point" class="form-control" id="enable_disable_decimal_point">
                                        <option value="enable" <?php if(get_static_option('enable_disable_decimal_point') == 'enable'): ?> selected <?php endif; ?>><?php echo e(__('Enable')); ?></option>
                                        <option value="disable" <?php if(get_static_option('enable_disable_decimal_point') == 'disable'): ?> selected <?php endif; ?>><?php echo e(__('Disable')); ?></option>
                                    </select>
                                </div>

                                <div class="single-input">
                                    <label for="site_currency_symbol_position" class="label-title mt-3"><?php echo e(__('Currency Symbol Position')); ?></label>
                                    <?php $all_currency_position = ['left','right']; ?>
                                    <select name="site_currency_symbol_position" class="form-control" id="site_currency_symbol_position">
                                        <?php $__currentLoopData = $all_currency_position; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($cur); ?>"
                                                    <?php if(get_static_option('site_currency_symbol_position') == $cur): ?> selected <?php endif; ?>><?php echo e(ucwords($cur)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="single-input">
                                    <label for="site_currency_thousand_separator" class="label-title mt-3"><?php echo e(__('Currency Thousand Separator')); ?></label>
                                    <input type="text" class="form-control"
                                           name="site_currency_thousand_separator"
                                           value="<?php echo e(get_static_option('site_currency_thousand_separator')); ?>">
                                </div>
                                <div class="single-input">
                                    <label for="site_currency_decimal_separator" class="label-title mt-3"><?php echo e(__('Currency Decimal Separator')); ?></label>
                                    <input type="text" class="form-control"
                                           name="site_currency_decimal_separator"
                                           value="<?php echo e(get_static_option('site_currency_decimal_separator')); ?>">
                                </div>
                                <div class="single-input">
                                    <label for="site_default_payment_gateway" class="label-title mt-3"><?php echo e(__('Default Payment Gateway')); ?></label>
                                    <select name="site_default_payment_gateway" class="form-control" >
                                        <?php
                                            $all_gateways = \App\Helper\PaymentGatewayList::listOfPaymentGateways();
                                        ?>
                                        <?php $__currentLoopData = $all_gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(!empty(get_static_option($gateway.'_gateway'))): ?>
                                                <option value="<?php echo e($gateway); ?>" <?php if(get_static_option('site_default_payment_gateway') == $gateway): ?> selected <?php endif; ?>><?php echo e(ucwords(str_replace('_',' ',$gateway))); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <?php $global_currency = strtolower(get_static_option('site_global_currency')) ?? '';?>

                                <?php if($global_currency != 'USD'): ?>
                                    <div class="single-input">
                                        <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_usd_exchange_rate" class="label-title mt-3"><?php echo e(__($global_currency.' to USD Exchange Rate')); ?></label>
                                        <input type="text" class="form-control"
                                               name="site_<?php echo e(strtolower($global_currency)); ?>_to_usd_exchange_rate"
                                               value="<?php echo e(get_static_option('site_'.$global_currency.'_to_usd_exchange_rate')); ?>">
                                        <span class="info-text"><?php echo e(sprintf(__('enter %s to USD exchange rate. eg: 1 %s = ? USD'),$global_currency,$global_currency)); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if($global_currency != 'IDR'): ?>
                                    <div class="single-input">
                                        <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_idr_exchange_rate" class="label-title mt-3"><?php echo e(__($global_currency.' to IDR Exchange Rate')); ?></label>
                                        <input type="text" class="form-control"
                                               name="site_<?php echo e(strtolower($global_currency)); ?>_to_idr_exchange_rate"
                                               value="<?php echo e(get_static_option('site_'.$global_currency.'_to_idr_exchange_rate')); ?>">
                                        <span class="info-text"><?php echo e(sprintf(__('enter %s to USD exchange rate. eg: 1 %s = ? IDR'),$global_currency,$global_currency)); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if($global_currency != 'BDT'): ?>
                                    <div class="single-input">
                                        <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_bdt_exchange_rate" class="label-title mt-3"><?php echo e(__($global_currency.' to BDT Exchange Rate')); ?></label>
                                        <input type="text" class="form-control"
                                               name="site_<?php echo e(strtolower($global_currency)); ?>_to_bdt_exchange_rate"
                                               value="<?php echo e(get_static_option('site_'.$global_currency.'_to_bdt_exchange_rate')); ?>">
                                        <span class="info-text"><?php echo e(sprintf(__('enter %s to USD exchange rate. eg: 1 %s = ? BDT'),$global_currency,$global_currency)); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if($global_currency != 'INR' && !empty(get_static_option('paytm_gateway') || !empty(get_static_option('razorpay_gateway')))): ?>
                                    <div class="single-input">
                                        <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_inr_exchange_rate" class="label-title mt-3"><?php echo e(__($global_currency.' to INR Exchange Rate')); ?></label>
                                        <input type="text" class="form-control"
                                               name="site_<?php echo e(strtolower($global_currency)); ?>_to_inr_exchange_rate"
                                               value="<?php echo e(get_static_option('site_'.$global_currency.'_to_inr_exchange_rate')); ?>">
                                        <span class="info-text"><?php echo e(__('enter '.$global_currency.' to INR exchange rate. eg: 1'.$global_currency.' = ? INR')); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if($global_currency != 'NGN' && !empty(get_static_option('paystack_gateway') )): ?>
                                    <div class="single-input">
                                        <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_ngn_exchange_rate" class="label-title mt-3"><?php echo e(__($global_currency.' to NGN Exchange Rate')); ?></label>
                                        <input type="text" class="form-control"
                                               name="site_<?php echo e(strtolower($global_currency)); ?>_to_ngn_exchange_rate"
                                               value="<?php echo e(get_static_option('site_'.$global_currency.'_to_ngn_exchange_rate')); ?>">
                                        <span class="info-text"><?php echo e(__('enter '.$global_currency.' to NGN exchange rate. eg: 1'.$global_currency.' = ? NGN')); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if($global_currency != 'ZAR'): ?>
                                    <div class="single-input">
                                        <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_zar_exchange_rate" class="label-title mt-3"><?php echo e(__($global_currency.' to ZAR Exchange Rate')); ?></label>
                                        <input type="text" class="form-control"
                                               name="site_<?php echo e(strtolower($global_currency)); ?>_to_zar_exchange_rate"
                                               value="<?php echo e(get_static_option('site_'.$global_currency.'_to_zar_exchange_rate')); ?>">
                                        <span class="info-text"><?php echo e(sprintf(__('enter %s to USD exchange rate. eg: 1 %s = ? ZAR'),$global_currency,$global_currency)); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if($global_currency != 'BRL'): ?>
                                    <div class="single-input">
                                        <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_brl_exchange_rate" class="label-title mt-3"><?php echo e(__($global_currency.' to BRL Exchange Rate')); ?></label>
                                        <input type="text" class="form-control"
                                               name="site_<?php echo e(strtolower($global_currency)); ?>_to_brl_exchange_rate"
                                               value="<?php echo e(get_static_option('site_'.$global_currency.'_to_brl_exchange_rate')); ?>">
                                        <span class="info-text"><?php echo e(__('enter '.$global_currency.' to BRL exchange rate. eg: 1'.$global_currency.' = ? BRL')); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if($global_currency != 'MYR'): ?>
                                    <div class="single-input">
                                        <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_myr_exchange_rate" class="label-title mt-3"><?php echo e(__($global_currency.' to MYR Exchange Rate')); ?></label>
                                        <input type="text" class="form-control"
                                               name="site_<?php echo e(strtolower($global_currency)); ?>_to_myr_exchange_rate"
                                               value="<?php echo e(get_static_option('site_'.$global_currency.'_to_myr_exchange_rate')); ?>">
                                        <span class="info-text"><?php echo e(__('enter '.$global_currency.' to MYR exchange rate. eg: 1'.$global_currency.' = ? MYR')); ?></span>
                                    </div>
                                <?php endif; ?>

                                <div class="switch my-5">
                                    <label class="label-title mt-3"><strong><?php echo e(__('Stripe Recurring Subscription Enable')); ?></strong></label>
                                    <input class="custom-switch" type="checkbox" id="stripe_subscription_enabled"
                                           name="stripe_subscription_enabled"
                                           <?php if(get_static_option('stripe_subscription_enabled') === 'on'): ?> checked <?php endif; ?>>
                                    <label class="switch-label" for="stripe_subscription_enabled"><?php echo e(__('Enable/Disable')); ?></label>
                                </div>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('payment-info-settings')): ?>
                                <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
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
    <script>
        (function($){
            "use strict";
            $(document).ready(function () {
                <?php if (isset($component)) { $__componentOriginal26b641e1adcfef4e774221a3ed7c52ce = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal26b641e1adcfef4e774221a3ed7c52ce = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn.update','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn.update'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal26b641e1adcfef4e774221a3ed7c52ce)): ?>
<?php $attributes = $__attributesOriginal26b641e1adcfef4e774221a3ed7c52ce; ?>
<?php unset($__attributesOriginal26b641e1adcfef4e774221a3ed7c52ce); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal26b641e1adcfef4e774221a3ed7c52ce)): ?>
<?php $component = $__componentOriginal26b641e1adcfef4e774221a3ed7c52ce; ?>
<?php unset($__componentOriginal26b641e1adcfef4e774221a3ed7c52ce); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal8b8fe710061b833b89e7ddfb903f7517 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8b8fe710061b833b89e7ddfb903f7517 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon-picker.icon-picker','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon-picker.icon-picker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8b8fe710061b833b89e7ddfb903f7517)): ?>
<?php $attributes = $__attributesOriginal8b8fe710061b833b89e7ddfb903f7517; ?>
<?php unset($__attributesOriginal8b8fe710061b833b89e7ddfb903f7517); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8b8fe710061b833b89e7ddfb903f7517)): ?>
<?php $component = $__componentOriginal8b8fe710061b833b89e7ddfb903f7517; ?>
<?php unset($__componentOriginal8b8fe710061b833b89e7ddfb903f7517); ?>
<?php endif; ?>
            });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/prosdeliver/public_html/core/Modules/PaymentGatewaySettings/Resources/views/payment-info.blade.php ENDPATH**/ ?>