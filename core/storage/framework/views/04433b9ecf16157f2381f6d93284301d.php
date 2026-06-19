<?php $__env->startSection('site_title',__('My Proposals')); ?>
<?php $__env->startSection('style'); ?>
    
    <?php if (isset($component)) { $__componentOriginal6ac42bec26ad6db1f7665e1efe405b39 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6ac42bec26ad6db1f7665e1efe405b39 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ai-translate-toggle','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ai-translate-toggle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6ac42bec26ad6db1f7665e1efe405b39)): ?>
<?php $attributes = $__attributesOriginal6ac42bec26ad6db1f7665e1efe405b39; ?>
<?php unset($__attributesOriginal6ac42bec26ad6db1f7665e1efe405b39); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6ac42bec26ad6db1f7665e1efe405b39)): ?>
<?php $component = $__componentOriginal6ac42bec26ad6db1f7665e1efe405b39; ?>
<?php unset($__componentOriginal6ac42bec26ad6db1f7665e1efe405b39); ?>
<?php endif; ?>
    <style>
        .cover-letter-text, .cover-letter-translated-text { white-space: pre-line; }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <main>
        
        <?php if (isset($component)) { $__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb.user-profile-breadcrumb','data' => ['title' => __('Proposals'),'innerTitle' => __('My Proposals')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb.user-profile-breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Proposals')),'innerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('My Proposals'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4)): ?>
<?php $attributes = $__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4; ?>
<?php unset($__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4)): ?>
<?php $component = $__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4; ?>
<?php unset($__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4); ?>
<?php endif; ?>

        <!-- Profile Details area Starts -->
        <div class="profile-area pat-100 pab-100">
            <div class="container">
                <div class="row gy-4 justify-content-center">
                    <div class="<?php if(get_static_option('job_enable_disable') != 'disable'): ?> col-xl-8 col-lg-8 <?php else: ?> col-12 <?php endif; ?>">
                        <div class="shop-contents-wrapper-right">
                            <div class="myOrder-wrapper">
                                <div class="myOrder-wrapper-tabs">
                                    <div class="myOrder-tab-content">
                                        <div class="tab-content-item active">
                                            <div class="search_result">
                                                <?php echo $__env->make('frontend.user.influencer.proposal.search-result', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(get_static_option('job_enable_disable') != 'disable'): ?>
                    <div class="col-xl-4 col-lg-4">
                        <div class="profile-details-widget sticky_top">
                            <div class="file-wrapper-item-flex flex-between align-items-center">
                                <h4 class="inf-title title6 fw_bold"> <?php echo e(__('Available Campaigns')); ?> </h4>
                                <a href="<?php echo e(route('jobs.all')); ?>" class="btn-profile btn-bg-1"> <?php echo e(__('Browse All')); ?> </a>
                            </div>
                            <?php if($jobs->count()>0): ?>
                                <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="single-jobs bg-white mt-4">
                                        <div class="title-wraper">
                                            <h4 class="inf-title lg-font fw_semibold">
                                                <a href="<?php echo e(route('job.details', ['username' => $job->job_creator?->username, 'slug' => $job->slug])); ?>"><?php echo e($job->title); ?></a>
                                            </h4>
                                            <h3 class="inf-title lg-font fw_bold primary_text">
                                                <?php echo e(float_amount_with_currency_symbol($job->budget)); ?>

                                            </h3>
                                        </div>
                                        <p class="single-jobs-dates d-flex gap-1">
                                            <?php echo e($job->created_at->toFormattedDateString() ?? ''); ?> -
                                            <span class="inf-tag blue-tag"><?php echo e(ucfirst($job->level) ?? ''); ?></span>
                                            <span class="inf-tag green-tag"><?php echo e(ucfirst($job->type)); ?></span>
                                        </p>
                                        <div class="single-jobs-tag mt-4">
                                            <?php $__currentLoopData = $job->job_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="<?php echo e(route('skill.jobs', $skill->skill)); ?>" class="inf-tag">
                                                    <?php echo e($skill->skill ?? ''); ?> </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <h6 class="profile-wrapper-item-title"><?php echo e(__('No Campaigns Found')); ?></h6>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- Profile Details area end -->
    </main>

    <?php echo $__env->make('frontend.user.influencer.proposal.cover-letter-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){

                // When a proposal's "Proposal Details" button is clicked:
                // populate the modal with this proposal's cover letter text
                // and reset the translation state so it's fresh for each proposal.
                $(document).on('click', '.cover_letter_details', function(){
                    var coverLetter = $(this).data('cover-letter');

                    // Populate original text
                    $('#cover-letter-original').text(coverLetter);

                    // Clear translated state
                    $('#cover-letter-translated').text('').hide();
                    $('#cover-letter-tx-label').hide();

                    // Reset the translate pill button state
                    var btn = $('#cover-letter-translate-btn');
                    btn.prop('disabled', false)
                       .data('state', 'original')
                       .attr('data-state', 'original')
                       .removeAttr('data-translated');
                    btn.find('.ptx-icon').text('🌐').show();
                    btn.find('.ptx-label').text('<?php echo e(__('Translate to English')); ?>');
                    btn.find('.ptx-spinner').hide();

                    // Show original
                    $('#cover-letter-original').show();
                });

                $(document).on('click', '.pagination a', function(e){
                    e.preventDefault();
                    var page = $(this).attr('href').split('page=')[1];
                    loadProposals(page);
                });

                function loadProposals(page){
                    $.ajax({
                        url: "<?php echo e(route('influencer.proposal.paginate.data') . '?page='); ?>" + page,
                        success: function(res){
                            $('.search_result').html(res);
                        }
                    });
                }
            });
        }(jQuery));
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.layout.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/prosdeliver/public_html/core/resources/views/frontend/user/influencer/proposal/proposals.blade.php ENDPATH**/ ?>