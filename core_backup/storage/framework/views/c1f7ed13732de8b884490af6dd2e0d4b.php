<section class="influencer influencer-featured-section pat-120 pab-60">
    <div class="container">
        <div class="d-flex justify-content-between flex-wrap gap-2 mb-40">
            <h2 class="inf-title title2 black_text fw_bold"><?php echo e($title ?? __('Featured Influencer')); ?></h2>
            <div class="btn-wraper">
                <a href="<?php echo e($find_more_button_link ?? route('talents.all')); ?>"
                    class="inf-cmn-btn inf-primary-outline-btn">
                    <?php echo e($find_more_button_text ?? __('Find More')); ?>

                </a>
            </div>
        </div>
        <div class="influencer-fetured-wraper">
            <div class="row g-4">
                <?php $__currentLoopData = $talents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $talent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl-3 col-md-6">
                        <div class="influencer_card">
                            <div class="top-part">
                                <div class="img-part">
                                    <a href="<?php echo e(route('influencer.profile.details', $talent->username)); ?>">
                                        <?php
                                            $filePath = 'assets/uploads/profile/' . $talent->image;
                                            $extension = pathinfo($talent->image ?? '', PATHINFO_EXTENSION);
                                            $isVideo = in_array(strtolower($extension), ['mp4', 'webm', 'avi', 'mov']);
                                        ?>

                                        <?php if($talent->image): ?>
                                            <?php if($isVideo): ?>
                                                
                                                <video
                                                        src="<?php echo e(asset($filePath)); ?>"
                                                        muted
                                                        loop
                                                        preload="metadata"
                                                        class="profile-video"
                                                        onmouseover="this.play()"
                                                        onmouseout="this.pause(); this.currentTime=0;">
                                                </video>
                                            <?php else: ?>
                                                
                                                <img src="<?php echo e(asset($filePath)); ?>" alt="<?php echo e($talent->first_name); ?>">
                                            <?php endif; ?>
                                        <?php else: ?>
                                            
                                            <img src="<?php echo e(asset('assets/static/img/author/author.jpg')); ?>" alt="<?php echo e(__('profile img')); ?>">
                                        <?php endif; ?>
                                    </a>
                                    <?php if(moduleExists('PromoteInfluencer') && $talent->is_pro_freelancer && !empty(get_static_option('promoted_badge_text'))): ?>
                                        <span class="sponsored-badge">
                                            <?php echo e(get_static_option('promoted_badge_text') ??  __('Sponsored')); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="name-part">
                                    <div class="name text-with-icon md-font">
                                        <span class="black_text fw_semibold">
                                            <a href="<?php echo e(route('influencer.profile.details', $talent->username)); ?>">
                                                <?php echo e($talent->first_name . ' ' . $talent->last_name); ?>

                                            </a>
                                        </span>
                                        <?php if($talent->user_verified_status == 1): ?>
                                            <span data-toggle="tooltip" data-placement="top"
                                                title="<?php echo e(__('User Verified')); ?>">
                                                <i class="si si-varified green_text"></i>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flencer-designation">
                                        <span class=""><?php echo e($talent->github_id ?? __('Content Creator')); ?></span>
                                        <?php echo freelancer_rating_for_profile_details_page($talent->id); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="bottom-part">
                                <?php
                                    $social_profiles = \App\Models\SocialProfile::where(
                                        'user_id',
                                        $talent->id,
                                    )->get();
                                    $total_followers = $social_profiles->reduce(function ($carry, $profile) {
                                        return $carry + parseFollowers($profile->followers);
                                    }, 0);
                                ?>
                                <div class="followers">
                                    <span><?php echo e(__('Followers')); ?>:</span>
                                    <span class="black_text fw_semibold"><?php echo e(formatFollowers($total_followers)); ?></span>
                                </div>
                                <div class="social-icon-wraper">
                                    <?php $__currentLoopData = $social_profiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e($profile->profile_link); ?>">
                                            <i class=" <?php echo e($profile->platform_icon); ?>"></i>
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /home/prosdeliver/public_html/core/app/Providers/../../plugins/PageBuilder/views/featured-influencer/featured-influencer.blade.php ENDPATH**/ ?>