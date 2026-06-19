<?php $__env->startSection('site_title', __('Dashboard')); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .total_balance {
            background-color: #e3e1ff !important;
        }

        .single-profile-settings-header {
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;

            .btn-profile {
                padding-left: 10px;
                padding-right: 10px;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <main>
        <!-- Profile Settings area Starts -->
        <div class="responsive-overlay"></div>
        <div class="profile-settings-area pat-100 pab-100">
            <div class="container">
                <div class="row g-4">
                    <?php echo $__env->make('frontend.user.layout.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <div class="col-xl-9 col-lg-8">
                        <div class="profile-settings-wrapper">

                            <div class="single-profile-settings">
                                <div class="single-profile-settings-header d-flex">
                                    <div class="single-profile-settings-header-flex">
                                        <?php if (isset($component)) { $__componentOriginaldd5d165d00da56cf3441fe2a6f4754db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.form-title','data' => ['title' => __('Dashboard Info'),'class' => 'inf-title title6 black_text fw_bold']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.form-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Dashboard Info')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('inf-title title6 black_text fw_bold')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db)): ?>
<?php $attributes = $__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db; ?>
<?php unset($__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldd5d165d00da56cf3441fe2a6f4754db)): ?>
<?php $component = $__componentOriginaldd5d165d00da56cf3441fe2a6f4754db; ?>
<?php unset($__componentOriginaldd5d165d00da56cf3441fe2a6f4754db); ?>
<?php endif; ?>
                                    </div>
                                    <?php if(get_static_option('profile_switch_enable_disable') == 'enable'): ?>
                                        <div class="profile-switch-header">
                                            <select class="switch-profile-select" id="switch_profile">
                                                <option value="freelancer" <?php if(Session::get('user_role') == 'freelancer'): ?> selected <?php endif; ?>><?php echo e(__('As Influencer')); ?></option>
                                                <option value="client" <?php if(Session::get('user_role') == 'client'): ?> selected <?php endif; ?>><?php echo e(__('As Brand')); ?></option>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="single-profile-settings-inner">
                                    <div class="row g-4">

                                        <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                            <div class="myJob-wrapper-single-balance total_balance">
                                                <div class="myJob-wrapper-single-balance-contents text-center">
                                                    <div
                                                        class="myJob-wrapper-single-balance-price d-flex gap-2 justify-content-between">
                                                    </div>
                                                    <p class="myJob-wrapper-single-balance-para"><?php echo e(__('Wallet Balance')); ?>

                                                    </p>
                                                    <h4
                                                        class="inf-title lg-font black_text fw_bold contract_single__balance-price">
                                                        <?php echo e(float_amount_with_currency_symbol($total_wallet_balance) ?? 0.0); ?>

                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(get_static_option('job_enable_disable') != 'disable'): ?>
                                            <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                                <div class="myJob-wrapper-single-balance">
                                                    <div class="myJob-wrapper-single-balance-contents text-center">
                                                        <div
                                                            class="myJob-wrapper-single-balance-price d-flex gap-2 justify-content-between">

                                                        </div>
                                                        <p class="myJob-wrapper-single-balance-para">
                                                            <?php echo e(__('Total Campaigns')); ?></p>
                                                        <h4
                                                            class="inf-title lg-font black_text fw_bold contract_single__balance-price">
                                                            <?php echo e($total_jobs ?? 0); ?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                            <div class="myJob-wrapper-single-balance">
                                                <div class="myJob-wrapper-single-balance-contents text-center">
                                                    <div
                                                        class="myJob-wrapper-single-balance-price d-flex gap-2 justify-content-between">

                                                    </div>
                                                    <p class="myJob-wrapper-single-balance-para"><?php echo e(__('Complete Order')); ?>

                                                    </p>
                                                    <h4
                                                        class="inf-title lg-font black_text fw_bold contract_single__balance-price">
                                                        <?php echo e($complete_order ?? 0); ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                            <div class="myJob-wrapper-single-balance">
                                                <div class="myJob-wrapper-single-balance-contents text-center">
                                                    <div
                                                        class="myJob-wrapper-single-balance-price d-flex gap-2 justify-content-between">

                                                    </div>
                                                    <p class="myJob-wrapper-single-balance-para"><?php echo e(__('Active Order')); ?>

                                                    </p>
                                                    <h4
                                                        class="inf-title lg-font black_text fw_bold contract_single__balance-price">
                                                        <?php echo e($active_order ?? 0); ?></h4>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <hr class="mt-4 mb-4">

                                    <!-- Analytics Row: Spending Trends & Comparisons -->
                                    <div class="row g-4">
                                        <div class="col-xxl-4 col-lg-5">
                                            <div class="row g-4">
                                                <div class="col-12">
                                                    <div class="myJob-wrapper-single-balance bg-white" style="border: 1px solid #e2e8f0;">
                                                        <div class="myJob-wrapper-single-balance-contents text-center">
                                                            <p class="myJob-wrapper-single-balance-para mb-2"><?php echo e(__('Total Spend')); ?></p>
                                                            <h2 class="inf-title lg-font black_text fw_bold mb-0"><?php echo e(preg_replace('/\.00(?!\d)/', '', float_amount_with_currency_symbol($total_spend))); ?></h2>
                                                            <small class="text-muted d-block mt-2"><?php echo e(__('Across all completed campaigns')); ?></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="myJob-wrapper-single-balance" style="border: 1px solid #e2e8f0; background: #fffcf5 !important;">
                                                        <div class="myJob-wrapper-single-balance-contents text-center">
                                                            <p class="myJob-wrapper-single-balance-para mb-2"><?php echo e(__('Total Refunds')); ?></p>
                                                            <h4 class="inf-title black_text fw_bold mb-0 text-danger"><?php echo e(preg_replace('/\.00(?!\d)/', '', float_amount_with_currency_symbol($total_refunds))); ?></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-8 col-lg-7">
                                            <div class="p-4 bg-white radius-10" style="border: 1px solid #e2e8f0; height: 100%;">
                                                <div class="single-profile-settings-header p-0 mb-3">
                                                    <h5 class="inf-title title6 black_text fw_bold"><?php echo e(__('Spending Trend (Last 12 Months)')); ?></h5>
                                                </div>
                                                <div class="single-profile-settings-inner p-0">
                                                    <canvas id="monthlySpendChart" style="max-height: 250px;"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Analytics Row 2: Hiring Funnel & Utilization -->
                                    <div class="row g-4 mt-4">
                                        <div class="col-lg-6">
                                            <div class="p-4 bg-white radius-10" style="border: 1px solid #e2e8f0; height: 100%;">
                                                <div class="single-profile-settings-header p-0 mb-3">
                                                    <h5 class="inf-title title6 black_text fw_bold"><?php echo e(__('Hiring Funnel')); ?></h5>
                                                </div>
                                                <div class="row g-3">
                                                    <div class="col-sm-6">
                                                        <div class="p-3 bg-light radius-10 border">
                                                            <span class="text-muted d-block mb-1"><?php echo e(__('Hire Rate')); ?></span>
                                                            <h5 class="fw_bold"><?php echo e($hire_rate); ?>%</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="p-3 bg-light radius-10 border">
                                                            <span class="text-muted d-block mb-1"><?php echo e(__('Avg Proposals/Job')); ?></span>
                                                            <h5 class="fw_bold"><?php echo e($avg_proposals_per_job); ?></h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="p-3 bg-light radius-10 border">
                                                            <span class="text-muted d-block mb-1"><?php echo e(__('Avg Time to Hire')); ?></span>
                                                            <h5 class="fw_bold"><?php echo e($avg_time_to_hire); ?> <?php echo e(__('Days')); ?></h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="p-3 bg-light radius-10 border">
                                                            <span class="text-muted d-block mb-1"><?php echo e(__('Price Range')); ?></span>
                                                            <small class="fw_bold d-block"><?php echo e(preg_replace('/\.00(?!\d)/', '', float_amount_with_currency_symbol($proposal_range->min_price ?? 0))); ?> - <?php echo e(preg_replace('/\.00(?!\d)/', '', float_amount_with_currency_symbol($proposal_range->max_price ?? 0))); ?></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="p-4 bg-white radius-10" style="border: 1px solid #e2e8f0; height: 100%;">
                                                <div class="single-profile-settings-header p-0 mb-3">
                                                    <h5 class="inf-title title6 black_text fw_bold"><?php echo e(__('Influencer Utilization')); ?></h5>
                                                </div>
                                                <div class="row g-3">
                                                    <div class="col-sm-6">
                                                        <div class="p-3 bg-light radius-10 border">
                                                            <span class="text-muted d-block mb-1"><?php echo e(__('Unique Influencers')); ?></span>
                                                            <h5 class="fw_bold"><?php echo e($unique_influencers_count); ?></h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="p-3 bg-light radius-10 border">
                                                            <span class="text-muted d-block mb-1"><?php echo e(__('Repeat Hire Rate')); ?></span>
                                                            <h5 class="fw_bold"><?php echo e($repeat_hire_rate); ?>%</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="p-3 bg-light radius-10 border">
                                                            <span class="text-muted d-block mb-1"><?php echo e(__('Avg Spend/Influencer')); ?></span>
                                                            <h5 class="fw_bold"><?php echo e(preg_replace('/\.00(?!\d)/', '', float_amount_with_currency_symbol($avg_spend_per_influencer))); ?></h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="p-3 radius-10 border" style="background: #fff5f5 !important; border-color: #feb2b2 !important;">
                                                            <span class="text-danger d-block mb-1"><i class="fas fa-exclamation-circle"></i> <?php echo e(__('Delayed Orders')); ?></span>
                                                            <h5 class="fw_bold text-danger"><?php echo e($delayed_orders); ?></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-4 mt-2">
                                        <div class="col-12">
                                            <div class="single-profile-settings" style="margin-bottom: 0;">
                                                <div class="single-profile-settings-header p-0 mb-3">
                                                    <h5 class="inf-title title6 black_text fw_bold"><?php echo e(__('Top Campaigns by Spend')); ?></h5>
                                                </div>
                                                <div class="single-profile-settings-inner p-0">
                                                    <canvas id="campaignSpendChart" style="max-height: 250px;"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mt-4 mb-4">
                                </div>
                            </div>

                            
                            <div class="single-profile-settings">
                                <div class="single-profile-settings-header">
                                    <div class="single-profile-settings-header-flex pb-2">
                                        <?php if (isset($component)) { $__componentOriginaldd5d165d00da56cf3441fe2a6f4754db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.form-title','data' => ['title' => __('Latest Orders'),'class' => 'inf-title title6 black_text fw_bold']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.form-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Latest Orders')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('inf-title title6 black_text fw_bold')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db)): ?>
<?php $attributes = $__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db; ?>
<?php unset($__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldd5d165d00da56cf3441fe2a6f4754db)): ?>
<?php $component = $__componentOriginaldd5d165d00da56cf3441fe2a6f4754db; ?>
<?php unset($__componentOriginaldd5d165d00da56cf3441fe2a6f4754db); ?>
<?php endif; ?>
                                        <a href="<?php echo e(route('client.order.all')); ?>" class="btn-profile btn-bg-1">
                                            <?php echo e(__('All Orders')); ?> <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                    <?php if (isset($component)) { $__componentOriginalfc4e3c8108f5f9458dc90e11adc2a670 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfc4e3c8108f5f9458dc90e11adc2a670 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.notice.general-notice','data' => ['description' => __(
                                        'Notice: The admin has the ability to update the payment status for transactions that are pending.',
                                    )]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('notice.general-notice'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__(
                                        'Notice: The admin has the ability to update the payment status for transactions that are pending.',
                                    ))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfc4e3c8108f5f9458dc90e11adc2a670)): ?>
<?php $attributes = $__attributesOriginalfc4e3c8108f5f9458dc90e11adc2a670; ?>
<?php unset($__attributesOriginalfc4e3c8108f5f9458dc90e11adc2a670); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfc4e3c8108f5f9458dc90e11adc2a670)): ?>
<?php $component = $__componentOriginalfc4e3c8108f5f9458dc90e11adc2a670; ?>
<?php unset($__componentOriginalfc4e3c8108f5f9458dc90e11adc2a670); ?>
<?php endif; ?>
                                </div>
                                <div class="single-profile-settings-inner profile-border-top">
                                    <div class="custom_table style-04">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th><?php echo e(__('Budget')); ?></th>
                                                    <th><?php echo e(__('Delivery Time')); ?></th>
                                                    <th><?php echo e(__('Payment Status')); ?></th>
                                                    <th><?php echo e(__('Create Date')); ?></th>
                                                    <th class="text-center"><?php echo e(__('Order Details')); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $latest_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td><?php echo e(float_amount_with_currency_symbol($order->price) ?? ''); ?>

                                                        </td>
                                                        <td><?php echo e(__($order->delivery_time) ?? ''); ?></td>
                                                        <td class="text-center">
                                                            <?php if($order->payment_gateway != 'manual_payment' && $order->payment_status == 'pending'): ?>
                                                                <span
                                                                    class="inf-status-badge danger"><?php echo e(__('Payment Failed')); ?></span>
                                                            <?php elseif($order->payment_status == 'pending'): ?>
                                                                <span
                                                                    class="inf-status-badge warning"><?php echo e(ucfirst(__($order->payment_status))); ?></span>
                                                            <?php else: ?>
                                                                <span
                                                                    class="inf-status-badge success"><?php echo e(ucfirst(__($order->payment_status))); ?></span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?php echo e($order->created_at->toFormattedDateString()); ?></td>
                                                        <td class="text-center"><a
                                                                href="<?php echo e(route('client.order.details', $order->id)); ?>"
                                                                class="btn-profile btn-bg-1"><?php echo e(__('Order Details')); ?> <i
                                                                    class="fas fa-arrow-right"></i></a></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center">
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
                                    </div>
                                </div>
                            </div>

                            
                            <?php if(get_static_option('job_enable_disable') != 'disable'): ?>
                                <div class="single-profile-settings">
                                    <div class="single-profile-settings-header">
                                        <div class="single-profile-settings-header-flex">
                                            <?php if (isset($component)) { $__componentOriginaldd5d165d00da56cf3441fe2a6f4754db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.form-title','data' => ['title' => __('Latest Campaigns'),'class' => 'inf-title title6 black_text fw_bold']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.form-title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Latest Campaigns')),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('inf-title title6 black_text fw_bold')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db)): ?>
<?php $attributes = $__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db; ?>
<?php unset($__attributesOriginaldd5d165d00da56cf3441fe2a6f4754db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldd5d165d00da56cf3441fe2a6f4754db)): ?>
<?php $component = $__componentOriginaldd5d165d00da56cf3441fe2a6f4754db; ?>
<?php unset($__componentOriginaldd5d165d00da56cf3441fe2a6f4754db); ?>
<?php endif; ?>
                                            <a href="<?php echo e(route('client.job.all')); ?>" class="btn-profile btn-bg-1">
                                                <?php echo e(__('All Campaigns')); ?> </a>
                                        </div>
                                    </div>
                                    <div class="single-profile-settings-inner profile-border-top">
                                        <div class="custom_table style-04">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th><?php echo e(__('Title')); ?></th>
                                                        <th><?php echo e(__('Action')); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__empty_1 = true; $__currentLoopData = $my_jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <tr>
                                                            <td><?php echo e($job->title); ?></td>
                                                            <td>
                                                                <a href="<?php echo e(route('client.job.edit', $job->id)); ?>"
                                                                    class="btn-profile btn-bg-1 edit_info_show_hide">
                                                                    <?php echo e(__('Edit Campaign')); ?> </a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                        <tr>
                                                            <td colspan="5" class="text-center">
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
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Profile Settings area end -->
    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            // Global Currency Config
            const siteCurrencySymbol = "<?php echo e(site_currency_symbol()); ?>";
            const currencySymbolPosition = "<?php echo e(get_static_option('site_currency_symbol_position')); ?>";

            function formatCurrency(value) {
                let formatted = Math.round(value).toString();
                if (currencySymbolPosition === 'left' || currencySymbolPosition === '') {
                    return siteCurrencySymbol + formatted;
                } else {
                    return formatted + siteCurrencySymbol;
                }
            }

            // 1. Monthly Spending Chart
            new Chart(document.getElementById("monthlySpendChart"), {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($months, 15, 512) ?>,
                    datasets: [{
                        label: "<?php echo e(__('Spending')); ?>",
                        borderColor: "#8280FF",
                        backgroundColor: "rgba(130, 128, 255, 0.1)",
                        data: <?php echo json_encode($monthly_spend_data, 15, 512) ?>,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return "<?php echo e(__('Total Spend')); ?>: " + formatCurrency(context.parsed.y);
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return formatCurrency(value);
                                }
                            }
                        }
                    }
                }
            });

            // 2. Campaign Spending Chart
            new Chart(document.getElementById("campaignSpendChart"), {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($campaign_spend_labels, 15, 512) ?>,
                    datasets: [{
                        label: "<?php echo e(__('Spend')); ?>",
                        backgroundColor: "rgba(74, 217, 145, 0.7)",
                        borderColor: "#4AD991",
                        borderWidth: 1,
                        data: <?php echo json_encode($campaign_spend_data, 15, 512) ?>
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return "<?php echo e(__('Spend')); ?>: " + formatCurrency(context.parsed.x);
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return formatCurrency(value);
                                }
                            }
                        }
                    }
                }
            });
        });

        $(document).on('change', '#switch_profile', function(e){
            e.preventDefault();
            let role = $(this).val();
            $.ajax({
                url: "<?php echo e(route('client.switch.profile')); ?>",
                type: 'post',
                data: {role:role},
                success: function(res){
                    if(res.status == 'success'){
                        toastr_success_js("<?php echo e(__('Profile switched successfully.')); ?>");
                        if(res.user_role == 'client'){
                            window.location.href = "<?php echo e(route('client.dashboard')); ?>";
                        }else{
                            window.location.href = "<?php echo e(route('influencer.dashboard')); ?>";
                        }
                    }
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/prosdeliver/public_html/core/resources/views/frontend/user/client/dashboard/dashboard.blade.php ENDPATH**/ ?>