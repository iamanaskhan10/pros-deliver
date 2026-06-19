<!-- Budget, Skills Start -->
<div class="setup-wrapper-contents">
    <div class="setup-wrapper-contents-item">
        <div class="setup-bank-form">
            <div class="setup-bank-form-item">
                <label class="label-title"><?php echo e(__('Campaign type')); ?></label>
                <select class="form-control" name="type" id="type">
                    <option value="Onsite" selected><?php echo e(__('Onsite')); ?></option>
                    <option value="Online" selected><?php echo e(__('Online')); ?></option>
                </select>
            </div>
            <div class="setup-bank-form-item setup-bank-form-item-icon manage-fixed-jobs">
                <label class="label-title"><?php echo e(__('Enter Budget')); ?></label>
                <input type="number" class="form--control" name="budget" id="budget" value="0" placeholder="<?php echo e(__('Enter Your Budget')); ?>">
                <span class="input-icon"><?php echo e(get_static_option('site_global_currency') ?? ''); ?></span>
            </div>
            <?php if (isset($component)) { $__componentOriginala124c3bc37ece30a28542c79ab0e16f1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala124c3bc37ece30a28542c79ab0e16f1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.skill-dropdown','data' => ['title' => __('Select Skill'),'name' => 'skill[]','id' => 'skill','class' => 'form-control skill_select2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.skill-dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Select Skill')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('skill[]'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('skill'),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('form-control skill_select2')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala124c3bc37ece30a28542c79ab0e16f1)): ?>
<?php $attributes = $__attributesOriginala124c3bc37ece30a28542c79ab0e16f1; ?>
<?php unset($__attributesOriginala124c3bc37ece30a28542c79ab0e16f1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala124c3bc37ece30a28542c79ab0e16f1)): ?>
<?php $component = $__componentOriginala124c3bc37ece30a28542c79ab0e16f1; ?>
<?php unset($__componentOriginala124c3bc37ece30a28542c79ab0e16f1); ?>
<?php endif; ?>
            <div class="setup-bank-form-item">
                <label class="photo-uploaded center-text w-100">
                    <div class="photo-uploaded-flex d-flex uploadImage">
                        <div class="photo-uploaded-icon"><i class="fa-solid fa-paperclip"></i></div>
                        <span class="photo-uploaded-para"><?php echo e(__('Add attachments')); ?></span>
                    </div>
                    <input class="photo-uploaded-file inputTag" type="file" name="attachment" id="attachment">
                </label>
                <?php if(get_static_option('file_extensions')): ?>
                    <p class="mt-2">
                        <?php echo e(__('Supported files:')); ?> <?php echo e(implode(', ', json_decode(get_static_option('file_extensions'), true))); ?>

                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- Budget, Skills Ends -->
<?php /**PATH /home/prosdeliver/public_html/core/resources/views/frontend/user/client/job/create/job-budget.blade.php ENDPATH**/ ?>