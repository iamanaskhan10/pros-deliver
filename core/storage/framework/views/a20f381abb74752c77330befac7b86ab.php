<header class="influencer header bg_white influencer-header ">
    <nav class="navbar navbar-area navbar-expand-lg <?php echo e(request()->routeIs('homepage') ? '' : 'header-shadow'); ?>">
        <div class="container nav-container">
            <div class="logo-wrapper">
                <a href="<?php echo e(route('homepage')); ?>" class="navbar-brand">
                    <?php if(!empty(get_static_option('site_logo'))): ?>
                        <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo')); ?>

                    <?php else: ?>
                        <img src="<?php echo e(asset('assets/static/img/logo/logo.png')); ?>" alt="site-logo">
                    <?php endif; ?>
                </a>
            </div>
            <div class="responsive-mobile-menu d-lg-none">
                <a href="javascript:void(0)" class="click-nav-right-icon">
                    <i class="fas fa-ellipsis-v"></i>
                </a>
                <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavs">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end gap-4" id="navbarNavs">
                <ul class="navbar-nav gap-4">
                    <?php echo render_frontend_menu($primary_menu); ?>

                </ul>
            </div>
            <?php if (isset($component)) { $__componentOriginal52832d31110f84da973eba1608c59933 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal52832d31110f84da973eba1608c59933 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.user-menu','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.user-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal52832d31110f84da973eba1608c59933)): ?>
<?php $attributes = $__attributesOriginal52832d31110f84da973eba1608c59933; ?>
<?php unset($__attributesOriginal52832d31110f84da973eba1608c59933); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal52832d31110f84da973eba1608c59933)): ?>
<?php $component = $__componentOriginal52832d31110f84da973eba1608c59933; ?>
<?php unset($__componentOriginal52832d31110f84da973eba1608c59933); ?>
<?php endif; ?>
        </div>
    </nav>
</header>
<?php /**PATH /home/prosdeliver/public_html/core/resources/views/frontend/layout/partials/navbar-variant/navbar-01.blade.php ENDPATH**/ ?>