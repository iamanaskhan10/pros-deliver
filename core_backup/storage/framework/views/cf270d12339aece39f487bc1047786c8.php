<section class="influencer influencer-customer-satification bg-primary-one pat-120 pab-120"
    <?php if($section_bg): ?> style="background-color:<?php echo e($section_bg ?? ''); ?>" <?php else: ?> class="bg-primary-one" <?php endif; ?>
    data-padding-top="<?php echo e($padding_top ?? ''); ?>" data-padding-bottom="<?php echo e($padding_bottom ?? ''); ?>">
    <div class="container">
        <h2 class="text-center inf-title title2 black_text fw_bold mb-40">
            <?php echo e($title ?? __('Customer Satisfaction Stats')); ?>

        </h2>
        <div class="customer-satification-stats-wraper">
            <div class="row g-4">
                <?php $__currentLoopData = $repeater_data['image_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3 col-6">
                        <div class="customer-satification-stats-card"
                            style="background-color:<?php echo e($repeater_data['bg_color_'][$key] ?? ''); ?>">
                            <div class="img">
                                <?php echo render_image_markup_by_attachment_id($data) ?? ''; ?>

                            </div>
                            <?php
                                $hasBg = !empty($repeater_data['bg_color_'][$key]);
                                $textClass = $hasBg ? ' white_text' : '';
                            ?>
                            <div class="text <?php echo e($textClass); ?>">
                                <h3 class="inf-title title3 fw_semibold <?php echo e($hasBg ? 'white_text' : 'black_text'); ?>">
                                    <?php echo e($repeater_data['number_'][$key] ?? '3.5K+'); ?>

                                </h3>
                                <div class="">
                                    <?php echo e($repeater_data['title_'][$key] ?? __('Brands')); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /home/prosdeliver/public_html/core/app/Providers/../../plugins/PageBuilder/views/customer-satisfaction/customer-satisfaction.blade.php ENDPATH**/ ?>