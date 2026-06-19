<?php $__env->startSection('title', __('Basic Settings')); ?>

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
                        <h4 class="customMarkup__single__title"><?php echo e(__('Basic Settings')); ?></h4>
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
                            <form action="<?php echo e(route('admin.general.settings.basic.save')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="single-input mb-3">
                                    <label for="site_title" class="label-title mb-1"><?php echo e(__('Site Title')); ?></label>
                                    <input type="text" id="site_title" name="site_title"  class="form-control" value="<?php echo e(get_static_option('site_title')); ?>" id="site_title">
                                </div>

                                <div class="single-input mb-3">
                                    <label for="site_tag_line" class="label-title mb-1"><?php echo e(__('Site Tag Line')); ?></label>
                                    <input type="text" id="site_tag_line" name="site_tag_line"  class="form-control" value="<?php echo e(get_static_option('site_tag_line')); ?>" id="site_tag_line">
                                </div>

                                <div class="single-input mb-3">
                                    <label for="site_footer_copyright" class="label-title mb-1"><?php echo e(__('Footer Copyright')); ?></label>
                                    <input type="text" id="site_footer_copyright" name="site_footer_copyright"  class="form-control" value="<?php echo e(get_static_option('site_footer_copyright')); ?>" id="site_footer_copyright">
                                    <small class="form-text text-muted"><?php echo e(__('{copy} will replace by ©; and {year} will be replaced by current year.')); ?></small>
                                </div>

                                <div class="switch mb-3">
                                    <label class="label-title mb-1"><strong><?php echo e(__('Maintenance Mode')); ?></strong></label>
                                    <input class="custom-switch" type="checkbox" id="site_maintenance_mode" name="site_maintenance_mode" <?php if(get_static_option('site_maintenance_mode') !== ''): ?> checked <?php endif; ?> id="site_maintenance_mode">
                                    <label class="switch-label" for="site_maintenance_mode"><?php echo e(__('Maintenance Mode')); ?></label>
                                </div>
                                <div class="switch mb-3">
                                    <label class="label-title mb-1"><strong><?php echo e(__('Enable/Disable Google Captcha for Register')); ?></strong></label>
                                    <input class="custom-switch" type="checkbox" id="site_google_captcha_enable" name="site_google_captcha_enable" <?php if(!empty(get_static_option('site_google_captcha_enable'))): ?> checked <?php endif; ?>>
                                    <label class="switch-label" for="site_google_captcha_enable"><?php echo e(__('Enable/Disable Google Captcha for Register')); ?></label>
                                </div>
                                <div class="switch mb-3">
                                    <label class="label-title mb-1"><strong><?php echo e(__('Enable Force SSL Redirection')); ?></strong></label>
                                    <input class="custom-switch" type="checkbox" id="site_force_ssl_redirection" name="site_force_ssl_redirection" <?php if(!empty(get_static_option('site_force_ssl_redirection'))): ?> checked <?php endif; ?>>
                                    <label class="switch-label" for="site_force_ssl_redirection"><?php echo e(__('Enable Force SSL Redirection')); ?></label>
                                </div>
                                <div class="switch mb-3">
                                    <label class="label-title mb-1"><strong><?php echo e(__('Admin Preloader Animation')); ?></strong></label>
                                    <input class="custom-switch" type="checkbox" id="admin_loader_animation" name="admin_loader_animation" <?php if(!empty(get_static_option('admin_loader_animation'))): ?> checked <?php endif; ?> id="admin_loader_animation">
                                    <label class="switch-label" for="admin_loader_animation"><?php echo e(__('Admin Preloader Animation')); ?></label>
                                </div>
                                <div class="switch mb-3">
                                    <label class="label-title mb-1"><strong><?php echo e(__('Site Preloader Animation')); ?></strong></label>
                                    <input class="custom-switch" type="checkbox" id="site_loader_animation" name="site_loader_animation" <?php if(!empty(get_static_option('site_loader_animation'))): ?> checked <?php endif; ?> id="site_loader_animation">
                                    <label class="switch-label" for="site_loader_animation"><?php echo e(__('Site Preloader Animation')); ?></label>
                                </div>
                                <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
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

<?php echo $__env->make('backend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/prosdeliver/public_html/core/Modules/GeneralSettings/Resources/views/basic-settings.blade.php ENDPATH**/ ?>