<section class="influencer influencer-recent-job-section pat-60 pab-120" data-padding-top="<?php echo e($padding_top ?? ''); ?>"
    data-padding-bottom="<?php echo e($padding_bottom ?? ''); ?>"
    <?php if($section_bg): ?> style="background-color:<?php echo e($section_bg ?? ''); ?>" <?php endif; ?>>
    <div class="container">
        <div class="d-flex justify-content-between flex-wrap gap-2 mb-40">
            <h2 class="inf-title title2 black_text fw_bold"><?php echo e($title ?? __('Recent Campaigns')); ?></h2>
            <div class="btn-wraper">
                <a href="<?php echo e($find_more_button_link ?? route('jobs.all')); ?>" class="inf-cmn-btn inf-primary-outline-btn">
                    <?php echo e($find_more_button_text ?? __('Find More')); ?>

                </a>
            </div>
        </div>
        <div class="recent-job-wraper">
            <div class="row g-4">
                <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="inf-job-card">
                            <div class="top-part">
                                <div class="card-header">
                                    <div class="left-part">
                                        <div class="img-wraper">
                                            <?php if($job?->job_creator->image): ?>
                                                <img src="<?php echo e(asset('assets/uploads/profile/' . $job?->job_creator->image)); ?>"
                                                    alt="<?php echo e($job?->job_creator->first_name); ?>">
                                            <?php else: ?>
                                                <img src="<?php echo e(asset('assets/static/img/author/author.jpg')); ?>"
                                                    alt="<?php echo e(__('profile img')); ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="job-info">
                                            <h4 class="lg-font fw_semibold black_text">
                                                <a class="oneline-text"
                                                    href="<?php echo e(route('job.details', ['username' => $job->job_creator?->username, 'slug' => $job->slug])); ?>">
                                                    <?php echo e(truncateHtml($job?->title, 20)); ?>

                                                </a>
                                            </h4>
                                            <?php if($job?->job_creator?->user_state?->state || $job?->job_creator?->user_country?->country): ?>
                                                <div class="location">
                                                    <i class="si si-location"></i>
                                                    <?php if($job?->job_creator?->user_state?->state != null): ?>
                                                        <?php echo e(optional($job?->job_creator->user_state)->state); ?>,
                                                    <?php endif; ?>
                                                    <?php echo e(optional($job?->job_creator->user_country)->country); ?>

                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="fvt-icon-wraper">
                                        <?php if(!Auth::guard('web')->check() || Auth::guard('web')->user()->user_type == 2): ?>
                                            <?php if (isset($component)) { $__componentOriginale21bda0e4eb7de5736eda0cf4920c139 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale21bda0e4eb7de5736eda0cf4920c139 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.bookmark','data' => ['identity' => $job->id,'type' => 'job','style2' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend.bookmark'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['identity' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($job->id),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('job'),'style2' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale21bda0e4eb7de5736eda0cf4920c139)): ?>
<?php $attributes = $__attributesOriginale21bda0e4eb7de5736eda0cf4920c139; ?>
<?php unset($__attributesOriginale21bda0e4eb7de5736eda0cf4920c139); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale21bda0e4eb7de5736eda0cf4920c139)): ?>
<?php $component = $__componentOriginale21bda0e4eb7de5736eda0cf4920c139; ?>
<?php unset($__componentOriginale21bda0e4eb7de5736eda0cf4920c139); ?>
<?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="job-description mb-4">
                                    <a class="twoline-text"
                                        href="<?php echo e(route('job.details', ['username' => $job->job_creator?->username, 'slug' => $job->slug])); ?>">
                                        <?php echo e(truncateHtml($job?->description, 82)); ?>

                                    </a>
                                </div>
                            </div>
                            <div class="inf-card-footer d-flex justify-content-between gap-3 flex-wrap">
                                <div class="salary">
                                    <span class="black_text fw_bold lg-font">
                                        <?php echo e(float_amount_with_currency_symbol($job->budget)); ?>

                                    </span>
                                </div>
                                <div class="delivery-info">
                                    <div class="d-flex gap-2 align-items-center">
                                        <span class="orange__circle"></span>
                                        <span><?php echo e(ucfirst(__($job->duration)) ?? ''); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /home/prosdeliver/public_html/core/app/Providers/../../plugins/PageBuilder/views/jobs/latest-job.blade.php ENDPATH**/ ?>