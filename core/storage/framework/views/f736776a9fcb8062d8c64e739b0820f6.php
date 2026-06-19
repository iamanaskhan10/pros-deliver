<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => '',
    'class' => '',
    'selectType' => 'default',
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'title' => '',
    'class' => '',
    'selectType' => 'default',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php $all_levels = \App\Models\ExperienceLevel::where('status',1)->get() ?>

<?php if($all_levels->count() >= 1): ?>
    <?php if($selectType === 'alternative'): ?>
        <select name="level" id="level" class="<?php echo e($class ?? 'form-control'); ?> inf-custom-select">
            <option value=""><?php echo e($innerTitle ?? __('Select Experience')); ?></option>
            <?php $__currentLoopData = $all_levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($level->level); ?>"><?php echo e($level->level); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    <?php else: ?>
        <div class="single-flex-input">
            <div class="single-input">
                <label class="label-title"><?php echo e($title ?? ''); ?></label>
                <select name="level" id="level" class="<?php echo e($class ?? 'form-control'); ?> inf-custom-select">
                    <option value=""><?php echo e($innerTitle ?? __('Select Experience')); ?></option>
                    <?php $__currentLoopData = $all_levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($level->level); ?>"><?php echo e($level->level); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
    <?php endif; ?>
<?php else: ?>
    <?php if($selectType === 'alternative'): ?>
        <select name="level" id="level" class="<?php echo e($class ?? 'form-control'); ?> inf-custom-select">
            <option value=""><?php echo e($innerTitle ?? __('Select Experience')); ?></option>
            <option value="junior"><?php echo e(__('Junior')); ?></option>
            <option value="midLevel"><?php echo e(__('MidLevel')); ?></option>
            <option value="senior"><?php echo e(__('Senior')); ?></option>
            <option value="not mandatory"><?php echo e(__('Not Mandatory')); ?></option>
        </select>
    <?php else: ?>
        <div class="single-flex-input">
            <div class="single-input">
                <label class="label-title"><?php echo e($title ?? ''); ?></label>
                <select name="level" id="level" class="<?php echo e($class ?? 'form-control'); ?> inf-custom-select">
                    <option value=""><?php echo e($innerTitle ?? __('Select Experience')); ?></option>
                    <option value="junior"><?php echo e(__('Junior')); ?></option>
                    <option value="midLevel"><?php echo e(__('MidLevel')); ?></option>
                    <option value="senior"><?php echo e(__('Senior')); ?></option>
                    <option value="not mandatory"><?php echo e(__('Not Mandatory')); ?></option>
                </select>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /home/prosdeliver/public_html/core/resources/views/components/form/experience-level-dropdown.blade.php ENDPATH**/ ?>