<!-- Brand Logo area start -->
<section class="influencer our-sponsor-section"
    <?php if($section_bg): ?> style="background-color:<?php echo e($section_bg ?? ''); ?>" <?php else: ?> class="bg-black" <?php endif; ?>
    data-padding-top="<?php echo e($padding_top ?? ''); ?>" data-padding-bottom="<?php echo e($padding_bottom ?? ''); ?>">
    <div class="container">
        <div class="our-sponsor-inner">
            <h6 class="inf-title title6 fw_semibold white_text"><?php echo e($title ?? __('Our Sponsors')); ?></h6>
            <div class="sponsor_brand_wraper">
                <div class="sponsor_brand_container">
                    <?php $__currentLoopData = $repeater_data['brand_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $logo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="sopnsor_brand">
                            <?php echo render_image_markup_by_attachment_id($logo); ?>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="sponsor_brand_container">
                    <?php $__currentLoopData = $repeater_data['brand_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $logo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="sopnsor_brand">
                            <?php echo render_image_markup_by_attachment_id($logo); ?>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Brand Logo area end -->
<?php /**PATH /home/prosdeliver/public_html/core/app/Providers/../../plugins/PageBuilder/views/brand/brand-one.blade.php ENDPATH**/ ?>