<table>
    <thead>
        <tr>
            <th><?php echo e(__('Amount')); ?></th>
            <th><?php echo e(__('Gateway')); ?></th>
            <th><?php echo e(__('Gateway Info')); ?></th>
            <th><?php echo e(__('Influencer Info')); ?></th>
            <th><?php echo e(__('Image')); ?></th>
            <th><?php echo e(__('Note')); ?></th>
            <th><?php echo e(__('Status')); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $all_request; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php $fields = ''; ?>
            <?php $__currentLoopData = unserialize($request->gateway_fields); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $fields .= ucwords(str_replace('_', ' ', $key)) . ' => ' . $value . '<br/>';
                ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e(float_amount_with_currency_symbol($request->amount)); ?></td>
                <td><?php echo e(ucfirst($request?->gateway_name->name)); ?></td>
                <td><?php echo $fields; ?></td>
                <td>
                    <p><?php echo e(__('Name:')); ?> <?php echo e($request?->user->fullname); ?></p>
                    <p><?php echo e(__('Email:')); ?> <?php echo e($request?->user->email); ?></p>
                    <p><?php echo e(__('Balance:')); ?>

                        <?php echo e(float_amount_with_currency_symbol($request?->user?->user_wallet->balance)); ?></p>
                </td>
                <td>
                    <?php if($request->image): ?>
                        <img style="width:200px;" src="<?php echo e(asset('assets/uploads/withdraw-request/' . $request->image)); ?>">
                    <?php endif; ?>
                </td>
                <td>
                    <p><?php echo e($request->note ?? ''); ?></p>
                </td>
                <td>
                    <?php if (isset($component)) { $__componentOriginal4c0776b5c1a24da181a13d974964d164 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4c0776b5c1a24da181a13d974964d164 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.table.withdraw-request-status','data' => ['status' => $request->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status.table.withdraw-request-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($request->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4c0776b5c1a24da181a13d974964d164)): ?>
<?php $attributes = $__attributesOriginal4c0776b5c1a24da181a13d974964d164; ?>
<?php unset($__attributesOriginal4c0776b5c1a24da181a13d974964d164); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4c0776b5c1a24da181a13d974964d164)): ?>
<?php $component = $__componentOriginal4c0776b5c1a24da181a13d974964d164; ?>
<?php unset($__componentOriginal4c0776b5c1a24da181a13d974964d164); ?>
<?php endif; ?>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="7" class="text-center">
                    <?php if (isset($component)) { $__componentOriginal8ae006de3c3ee1480e4c628ec92ae42e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ae006de3c3ee1480e4c628ec92ae42e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.not-found-dash','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.not-found-dash'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8ae006de3c3ee1480e4c628ec92ae42e)): ?>
<?php $attributes = $__attributesOriginal8ae006de3c3ee1480e4c628ec92ae42e; ?>
<?php unset($__attributesOriginal8ae006de3c3ee1480e4c628ec92ae42e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8ae006de3c3ee1480e4c628ec92ae42e)): ?>
<?php $component = $__componentOriginal8ae006de3c3ee1480e4c628ec92ae42e; ?>
<?php unset($__componentOriginal8ae006de3c3ee1480e4c628ec92ae42e); ?>
<?php endif; ?>
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<div class="deposit-history-pagination mt-4">
    <?php if (isset($component)) { $__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pagination.laravel-paginate','data' => ['allData' => $all_request]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('pagination.laravel-paginate'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['allData' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($all_request)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f)): ?>
<?php $attributes = $__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f; ?>
<?php unset($__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f)): ?>
<?php $component = $__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f; ?>
<?php unset($__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f); ?>
<?php endif; ?>
</div>
<?php /**PATH /home/prosdeliver/public_html/core/Modules/Wallet/Resources/views/influencer/withdraw/search-result.blade.php ENDPATH**/ ?>