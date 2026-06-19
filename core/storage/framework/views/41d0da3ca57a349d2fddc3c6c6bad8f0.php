<div class="compare-profile-and-identity">
    <div class="row g-4 gy-5">
        <div class="col-lg-6">
            <div class="user-profile userProfileDetails">
                <div class="userProfileDetails__header">
                    <h5 class="userProfileDetails__title"><?php echo e(__('User Profile Info')); ?></h5>
                    <input type="hidden" id="user_id_for_verified_status" value="<?php echo e($user_details->id); ?>">
                </div>
                <div class="userDetails__wrapper userProfile__details mt-3">
                    <div class="userProfile__details__thumb mb-3">
                        <?php if(!empty($user_details->image)): ?>
                            <img src="<?php echo e(asset('assets/uploads/profile/'.$user_details->image)); ?>" alt="profile-img">
                        <?php else: ?>
                            <img src="<?php echo e(asset('assets/static/img/author/author.jpg')); ?>" alt="freelancer-image">
                        <?php endif; ?>
                    </div>
                    <p class="userDetails__wrapper__item"><strong><?php echo e(__('User Type:')); ?></strong><?php if($user_details->user_type==1): ?> <?php echo e(__('Client')); ?> <?php else: ?> <?php echo e(__('Influencer')); ?><?php endif; ?></p>
                    <p class="userDetails__wrapper__item"><strong><?php echo e(__('Full Name:')); ?></strong><?php echo e($user_details->first_name.' '.$user_details->last_name); ?></p>
                    <p class="userDetails__wrapper__item"><strong><?php echo e(__('Username:')); ?></strong><?php echo e($user_details->username ?? ''); ?></p>
                    <p class="userDetails__wrapper__item"><strong><?php echo e(__('Email:')); ?></strong><?php echo e($user_details->email ?? ''); ?></p>
                    <p class="userDetails__wrapper__item"><strong><?php echo e(__('Country:')); ?></strong><?php echo e(optional($user_details->user_country)->country ?? ''); ?></p>
                    <p class="userDetails__wrapper__item"><strong><?php echo e(__('State:')); ?></strong><?php echo e(optional($user_details->user_state)->state ?? ''); ?></p>
                    <p class="userDetails__wrapper__item"><strong><?php echo e(__('City:')); ?></strong><?php echo e(optional($user_details->user_city)->city ?? ''); ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="user-identity userProfileDetails">
                <div class="userProfileDetails__header">
                    <h5 class="userProfileDetails__title"><?php echo e(__('User Identity Info')); ?></h5>
                </div>
                <div class="userDetails__wrapper userProfile__details mt-3">
                    <div class="userProfile__details__thumb mb-3">
                        <?php if(!empty($user_identity_details)): ?>
                        <img style="width:150px" src="<?php echo e(asset('assets/uploads/verification/'.$user_identity_details->front_image)); ?>" alt="front-img">
                        <img style="width:150px" src="<?php echo e(asset('assets/uploads/verification/'.$user_identity_details->back_image)); ?>" alt="back-img">
                    </div>
                    <p class="userDetails__wrapper__item"><strong><?php echo e(__('National ID:')); ?></strong><?php echo e($user_identity_details->national_id_number ?? ''); ?></p>
                    <p class="userDetails__wrapper__item"><strong><?php echo e(__('Documents Type:')); ?></strong><?php echo e($user_identity_details->verify_by ?? ''); ?></p>
                    <p class="userDetails__wrapper__item"><strong><?php echo e(__('Country:')); ?></strong><?php echo e(optional($user_identity_details->user_country)->country ?? ''); ?></p>
                    <?php if(moduleExists('CoinPaymentGateway')): ?>
                    <?php else: ?>
                    <p class="userDetails__wrapper__item"><strong><?php echo e(__('State:')); ?></strong><?php echo e(optional($user_identity_details->user_state)->state ?? ''); ?></p>
                    <p class="userDetails__wrapper__item"><strong><?php echo e(__('City:')); ?></strong><?php echo e(optional($user_identity_details->user_city)->city ?? ''); ?></p>
                    <p class="userDetails__wrapper__item"><strong><?php echo e(__('Zipcode:')); ?></strong><?php echo e($user_identity_details->zipcode ?? ''); ?></p>
                    <?php endif; ?>
                    <p class="userDetails__wrapper__item"><strong><?php echo e(__('Address:')); ?></strong><?php echo e($user_identity_details->address ?? ''); ?></p>
                    <?php else: ?>
                    <div class="userProfileDetails__noInfo">
                        <h3 class="userProfileDetails__noInfo__title"><?php echo e(__('No Information')); ?></h3>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/prosdeliver/public_html/core/resources/views/backend/pages/user/profile-and-identity-compare.blade.php ENDPATH**/ ?>