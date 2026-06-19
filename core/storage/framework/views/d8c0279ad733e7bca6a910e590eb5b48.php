<div class="custom_pagination mt-5" data-route="<?php echo e($route ?? ''); ?>">
    <?php if($allData->hasPages()): ?>
        <div class="entries-wraper">
            <span><?php echo e(__('Showing')); ?></span>
            <span class="entries_number">
                <?php echo e($allData->firstItem() ?? 0); ?> <?php echo e(__('to')); ?> <?php echo e($allData->lastItem() ?? 0); ?> <?php echo e(__('of')); ?>

                <?php echo e($allData->total()); ?>

            </span>
            <span><?php echo e(__('Entries')); ?></span>
        </div>
        <?php echo e($allData->links()); ?>

    <?php endif; ?>
</div>
<?php /**PATH /home/prosdeliver/public_html/core/resources/views/components/pagination/laravel-paginate.blade.php ENDPATH**/ ?>