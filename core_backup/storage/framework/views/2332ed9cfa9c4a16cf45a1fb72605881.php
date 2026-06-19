<?php if(get_static_option('subscription_enable_disable') != 'disable'): ?>
    <section class="influencer influencer-pricing-plan bg-primary-one pat-120 pab-120" data-padding-top="<?php echo e($padding_top ?? ''); ?>"
        data-padding-bottom="<?php echo e($padding_bottom ?? ''); ?>">
        <div class="container">
            <h2 class="text-center inf-title title2 red_text fw_bold mb-4">
                <?php echo e($title ?? __('Easy and affordable Pricing')); ?></h2>
            <div class="inf_pricing pricing d-flex justify-content-center mb-40">
                <div class="nav nav-tabs pricing_type">
                    <button class="active_btn active" id="monthlyBtn" data-bs-toggle="tab"
                        data-bs-target="#monthly_price_plan"
                        onclick="toggleButtons('monthly')"><?php echo e(__('Monthly')); ?></button>
                    <button class="inActive_btn" id="yearlyBtn" data-bs-toggle="tab" data-bs-target="#yearly_price_plan"
                        onclick="toggleButtons('yearly')"><?php echo e(__('Yearly')); ?></button>
                </div>
            </div>
            <div class="tab-content">
                <div id="monthly_price_plan" class="tab-pane fade show active">
                    <div class="container_pricing">
                        <div class="row g-4">
                            <?php $__currentLoopData = $monthlySubscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-4">
                                    <div
                                        class="inf-price-plan-card <?php echo e($subscription->subscription_highlight_color == 'yes' ? 'active' : ''); ?>">
                                        <div class="pricing_plan_top_wraper">
                                            <div class="pricing_plan_header">
                                                <h6 class="inf-title fw_semibold lg-font">
                                                    <?php echo e($subscription->title ?? ''); ?>

                                                </h6>
                                                <p class="mt-4">
                                                    <span class="inf-title title3 fw_bold price">
                                                        <?php echo e(amount_with_currency_symbol($subscription->price) ?? '$0'); ?>

                                                    </span>
                                                    <span class="md-font fw_semibold">
                                                        /<?php echo e($subscription->subscription_type?->type ?? 'm'); ?>

                                                    </span>
                                                </p>
                                            </div>
                                            <div class="inf-card-body">
                                                <div class="md-font fw_bold black_text mb-3">
                                                    <?php echo e(__("What's Included?")); ?></div>
                                                <ul class="plan-feature-list">
                                                    <?php $__currentLoopData = $subscription->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li
                                                            class="<?php echo e($feature->status !== 'on' ? 'cross' : 'check'); ?>">
                                                            <?php echo e($feature->feature ?? ''); ?>

                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="inf_card_footer">
                                            <a href="<?php echo e(route('subscriptions.all')); ?>"
                                                class="inf-cmn-btn inf-gray-btn w-100">
                                                <?php echo e(__('Get Started')); ?> -
                                                <?php echo e(amount_with_currency_symbol($subscription->price ?? 0)); ?>

                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <div id="yearly_price_plan" class="tab-pane fade">
                    <div class="container_pricing">
                        <div class="row g-4">
                            <?php $__currentLoopData = $yearlySubscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-4">
                                    <div
                                        class="inf-price-plan-card <?php echo e($subscription->subscription_highlight_color == 'yes' ? 'active' : ''); ?>">
                                        <div class="pricing_plan_top_wraper">
                                            <div class="pricing_plan_header">
                                                <h6 class="inf-title fw_semibold lg-font">
                                                    <?php echo e($subscription->title ?? ''); ?>

                                                </h6>
                                                <p class="mt-4">
                                                    <span class="inf-title title3 fw_bold price">
                                                        <?php echo e(amount_with_currency_symbol($subscription->price) ?? '$0'); ?>

                                                    </span>
                                                    <span class="md-font fw_semibold">
                                                        /<?php echo e($subscription->subscription_type?->type ?? 'm'); ?>

                                                    </span>
                                                </p>
                                            </div>
                                            <div class="inf-card-body">
                                                <div class="md-font fw_bold black_text mb-3">
                                                    <?php echo e(__("What's Included?")); ?>

                                                </div>
                                                <ul class="plan-feature-list">
                                                    <?php $__currentLoopData = $subscription->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li
                                                            class="<?php echo e($feature->status !== 'on' ? 'cross' : 'check'); ?>">
                                                            <?php echo e($feature->feature ?? ''); ?>

                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="inf_card_footer">
                                            <a href="<?php echo e(route('subscriptions.all')); ?>"
                                                class="inf-cmn-btn inf-gray-btn w-100">
                                                <?php echo e(__('Get Started')); ?> -
                                                <?php echo e(amount_with_currency_symbol($subscription->price ?? 0)); ?>

                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<!-- Pricing area end -->
<?php /**PATH /home/prosdeliver/public_html/core/app/Providers/../../plugins/PageBuilder/views/price-plan/price-plan-one.blade.php ENDPATH**/ ?>