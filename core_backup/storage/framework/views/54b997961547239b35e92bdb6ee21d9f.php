<section class="influencer influencer-faq-section pat-120 pab-120" data-padding-top="<?php echo e($padding_top ?? ''); ?>"
    data-padding-bottom="<?php echo e($padding_bottom ?? ''); ?>" style="background-color:<?php echo e($section_bg ?? 'bg-primary-one'); ?>"
    id="faq">
    <div class="container">
        <h2 class="text-center inf-title title2 black_text fw_bold mb-40"><?php echo e($title ?? __('Frequently Asked Questions')); ?>

        </h2>
        <div class="inf-faq-wraper">
            <?php $__currentLoopData = $repeater_data['title_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="inf-faq-item <?php echo e($key === 0 ? 'open' : ''); ?>">
                    <div class="inf-faq-title-wraper">
                        <h3 class="inf-title lg-font fw_semibold black_text">
                            <?php echo e($title ?? __('What are the main benefits of influencer marketing for brands?')); ?>

                        </h3>
                        <div class="icon lg-font fw_medium black_text">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="inf-faq-content-wraper">
                        <?php echo e($repeater_data['description_'][$key]); ?>

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH /home/prosdeliver/public_html/core/app/Providers/../../plugins/PageBuilder/views/faq/faq-one.blade.php ENDPATH**/ ?>