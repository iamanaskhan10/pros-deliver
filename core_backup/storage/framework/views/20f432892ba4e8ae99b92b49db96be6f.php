<section class="influencer influencer-why-chose-us pat-120 pab-120" data-padding-top="<?php echo e($padding_top ?? ''); ?>"
    data-padding-bottom="<?php echo e($padding_bottom ?? ''); ?>">
    <div class="container">
        <h2 class="text-center inf-title title2 black_text fw_bold mb-40"><?php echo e($title ?? __('Why 1M+ People Choose Us')); ?>

        </h2>
        <div class="row g-4">
            <?php $__currentLoopData = $repeater_data['image_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 col-sm-6">
                    <div class="why-chose-card">
                        <div class="header-part d-flex gap-3">
                            <div class="img-wraper">
                                <?php echo render_image_markup_by_attachment_id($data) ?? ''; ?>

                            </div>
                            <h4 class="inf-title title6 fw_semibold">
                                <?php echo e($repeater_data['title_'][$key] ?? __('Advanced Analysis')); ?>

                            </h4>
                        </div>
                        <div class="text">
                            <p class="mt-3">
                                <?php echo e($repeater_data['subtitle_'][$key]); ?>

                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH /home/prosdeliver/public_html/core/app/Providers/../../plugins/PageBuilder/views/why-choose-us/why-choose-us.blade.php ENDPATH**/ ?>