<section class="influencer influencer-market-place pat-120 pab-120"
    <?php if($section_bg): ?> style="background-color:<?php echo e($section_bg ?? ''); ?>" <?php else: ?> class="bg-primary-one" <?php endif; ?>
    data-padding-top="<?php echo e($padding_top ?? ''); ?>" data-padding-bottom="<?php echo e($padding_bottom ?? ''); ?>">
    <div class="container">
        <h2 class="text-center inf-title title2 black_text fw_bold mb-40"><?php echo e($title ?? __('How Our Market Place Work')); ?>

        </h2>
        <div class="marketplace_card_grid">
            <?php $__currentLoopData = $repeater_data['image_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="market-place-work-card text-center">
                    <div class="img-part">
                        <?php echo render_image_markup_by_attachment_id($data); ?>

                    </div>
                    <div class="text mt-4">
                        <h6 class="inf-title title6 fw_semibold">
                            <?php echo e($repeater_data['title_'][$key] ?? __('Create Account')); ?>

                        </h6>
                        <div class="mt-2">
                            <?php echo e($repeater_data['subtitle_'][$key] ?? __('Join as an Influencer or Brand to start your journey.')); ?>

                        </div>
                    </div>
                </div>
                <div class="img">
                    <?php echo render_image_markup_by_attachment_id($repeater_data['arrow_image_'][$key]); ?>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH /home/prosdeliver/public_html/core/app/Providers/../../plugins/PageBuilder/views/how-marketplace-work/marketplace-work.blade.php ENDPATH**/ ?>