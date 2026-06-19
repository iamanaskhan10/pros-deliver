<?php $__env->startSection('title', __('History Details')); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .custom_table.style-04 table tbody tr td, .custom_table.style-04 table tbody tr th {
            border: 1px solid var(--border-color);
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="dashboard__body">
        <div class="row">
            <div class="col-lg-6">
                <div class="customMarkup__single">
                    <div class="customMarkup__single__item">
                        <div class="customMarkup__single__item__flex">
                            <h4 class="customMarkup__single__title"><?php echo e(__('History Details')); ?></h4>
                        </div>
                        <div class="customMarkup__single__inner mt-4">
                            <!-- Table Start -->
                            <div class="custom_table style-04">
                                <table class="DataTable_activation">
                                    <tbody>
                                        <tr>
                                            <th><?php echo e(__('ID')); ?></th>
                                            <td><?php echo e($history_details->id); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo e(__('Name')); ?></th>
                                            <td><?php echo e($history_details->user?->first_name .' '.$history_details->user?->last_name); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo e(__('Email')); ?></th>
                                            <td><?php echo e($history_details->user?->email); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo e(__('Phone')); ?></th>
                                            <td><?php echo e($history_details->user?->phone); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo e(__('Verified Status')); ?></th>
                                            <td> <?php if (isset($component)) { $__componentOriginal0538401771b4fcefa92998c78e769e30 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0538401771b4fcefa92998c78e769e30 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.table.verified-status','data' => ['status' => $history_details->user?->user_verified_status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status.table.verified-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($history_details->user?->user_verified_status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0538401771b4fcefa92998c78e769e30)): ?>
<?php $attributes = $__attributesOriginal0538401771b4fcefa92998c78e769e30; ?>
<?php unset($__attributesOriginal0538401771b4fcefa92998c78e769e30); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0538401771b4fcefa92998c78e769e30)): ?>
<?php $component = $__componentOriginal0538401771b4fcefa92998c78e769e30; ?>
<?php unset($__componentOriginal0538401771b4fcefa92998c78e769e30); ?>
<?php endif; ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo e(__('Payment Gateway')); ?></th>
                                            <td>
                                                <?php if($history_details->payment_gateway == 'manual_payment'): ?>
                                                    <?php echo e(ucfirst(str_replace('_',' ',$history_details->payment_gateway))); ?>

                                                <?php else: ?>
                                                    <?php echo e($history_details->payment_gateway == 'authorize_dot_net' ? __('Authorize.Net') : ucfirst($history_details->payment_gateway)); ?>

                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><?php echo e(__('Payment Status')); ?></th>
                                            <td>
                                                <?php if($history_details->payment_status == '' || $history_details->payment_status == 'cancel'): ?>
                                                    <span class="btn btn-danger btn-sm"><?php echo e(__('Cancel')); ?></span>
                                                <?php else: ?>
                                                    <span class="btn btn-success btn-sm"><?php echo e(ucfirst($history_details->payment_status)); ?></span>
                                                    <?php if($history_details->payment_status == 'pending'): ?>
                                                        <?php if (isset($component)) { $__componentOriginaled49183813b6264fe02b2283042511dd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled49183813b6264fe02b2283042511dd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.table.status-change','data' => ['title' => __('Change Status'),'class' => 'btn btn-danger wallet_history_status_change','url' => route('admin.wallet.history.status',$history_details->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status.table.status-change'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Change Status')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('btn btn-danger wallet_history_status_change'),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.wallet.history.status',$history_details->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled49183813b6264fe02b2283042511dd)): ?>
<?php $attributes = $__attributesOriginaled49183813b6264fe02b2283042511dd; ?>
<?php unset($__attributesOriginaled49183813b6264fe02b2283042511dd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled49183813b6264fe02b2283042511dd)): ?>
<?php $component = $__componentOriginaled49183813b6264fe02b2283042511dd; ?>
<?php unset($__componentOriginaled49183813b6264fe02b2283042511dd); ?>
<?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><?php echo e(__('Deposit Amount')); ?></th>
                                            <td><?php echo e(float_amount_with_currency_symbol($history_details->amount)); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo e(__('Manual Payment Image')); ?></th>
                                            <td>
                                                <span class="img_100">
                                                    <?php if(empty($history_details->manual_payment_image)): ?>
                                                        <img src="<?php echo e(asset('assets/static/img/no_image.png')); ?>" alt="">
                                                    <?php else: ?>
                                                        <img src="<?php echo e(asset('assets/uploads/manual-payment/'.$history_details->manual_payment_image)); ?>" alt="">
                                                    <?php endif; ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><?php echo e(__('Deposit Date')); ?></th>
                                            <td><?php echo e($history_details->created_at); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Table End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php if (isset($component)) { $__componentOriginal54c16274d3d0b2e3d7bba6b79dadebcb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal54c16274d3d0b2e3d7bba6b79dadebcb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sweet-alert.sweet-alert2-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sweet-alert.sweet-alert2-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal54c16274d3d0b2e3d7bba6b79dadebcb)): ?>
<?php $attributes = $__attributesOriginal54c16274d3d0b2e3d7bba6b79dadebcb; ?>
<?php unset($__attributesOriginal54c16274d3d0b2e3d7bba6b79dadebcb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal54c16274d3d0b2e3d7bba6b79dadebcb)): ?>
<?php $component = $__componentOriginal54c16274d3d0b2e3d7bba6b79dadebcb; ?>
<?php unset($__componentOriginal54c16274d3d0b2e3d7bba6b79dadebcb); ?>
<?php endif; ?>
    <?php echo $__env->make('wallet::admin.wallet.wallet-js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/prosdeliver/public_html/core/Modules/Wallet/Resources/views/admin/wallet/history-details.blade.php ENDPATH**/ ?>