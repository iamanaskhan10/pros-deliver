<!-- Banner area Starts -->
<section class="influencer influencer_banner bg-primary-one pt-60 pb-60"
    <?php if($banner_bg_1): ?> <?php $img = get_attachment_image_by_id($banner_bg_1); ?>
    style="background-image: url('<?php echo e($img['img_url'] ?? ''); ?>');" <?php endif; ?>>
    <div class="container">
        <div class="banner-wraper">
            <div class="banner-text-wraper">
                <h1 class="inf-title title1 fw_bolder">
                    <?php echo e($title ?? __('Elevate your brand with expert influencer marketing.')); ?>

                </h1>
                <p class="banner-des">
                    <?php echo e($subtitle ?? __("Unlock the power of authentic connections and targeted reach through strategic collaborations with top tier influencers Whether you're looking to build brand awareness drive engagement or boost conversions our.")); ?>

                </p>
                <div class="banner-btn-wraper d-flex gap-3 flex-wrap">
                    <a class="inf-cmn-btn inf-primary-btn"
                        href="<?php echo e($find_project_button_link ?? route('projects.all')); ?>"><?php echo e($find_project_button_text ?? __('Hire Influencer')); ?>

                    </a>
                    <?php if(!Auth::guard('web')->check()): ?>
                        <a class="inf-cmn-btn inf-black-btn-outline"
                            href="<?php echo e($find_work_button_link ?? route('user.register')); ?>"><?php echo e($find_work_button_text ?? __('Join Now')); ?></a>
                    <?php else: ?>
                        <?php if(Auth::guard('web')->user()->user_type == 1): ?>
                            <a class="inf-cmn-btn inf-black-btn-outline"
                                href="<?php echo e($find_work_button_link ?? route('client.dashboard')); ?>"><?php echo e($find_work_button_text ?? __('Join Now')); ?></a>
                        <?php else: ?>
                            <a class="inf-cmn-btn inf-black-btn-outline"
                                href="<?php echo e($find_work_button_link ?? route('influencer.dashboard')); ?>"><?php echo e($find_work_button_text ?? __('Join Now')); ?></a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="image-part wow fadeInRight">
                <div class="img-wraper">
                    <?php if($banner_image): ?>
                        <?php echo render_image_markup_by_attachment_id($banner_image); ?>

                    <?php else: ?>
                        <img src="<?php echo e(asset('asset/static/img/image.png')); ?>" alt="influencer-banner">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner area end -->
<?php /**PATH /home/prosdeliver/public_html/core/app/Providers/../../plugins/PageBuilder/views/header/header-one.blade.php ENDPATH**/ ?>