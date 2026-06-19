<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => '',
    'name' => '',
    'id' => '',
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
    'name' => '',
    'id' => '',
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

<?php
    $allSkills = \App\Models\Skill::all_skills();
?>

<?php if($selectType === 'alternative'): ?>
    <select name="<?php echo e($name ?? ''); ?>" id="<?php echo e($id ?? ''); ?>" class="inf-custom-select  <?php echo e($class ?? ''); ?>">
        <option value=""><?php echo e(__('Select Skill')); ?></option>
        <?php $__currentLoopData = $allSkills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($data->id); ?>"><?php echo e($data->skill); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
<?php else: ?>
    <div class="single-input mt-3">
        <label class="label-title"><?php echo e($title); ?></label>
        <select name="<?php echo e($name ?? ''); ?>" id="<?php echo e($id ?? ''); ?>" class="inf-custom-select <?php echo e($class ?? ''); ?>">
            <option value=""><?php echo e(__('Select Skill')); ?></option>
            <?php $__currentLoopData = $allSkills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($data->id); ?>"><?php echo e($data->skill); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
<?php endif; ?>
<?php /**PATH /home/prosdeliver/public_html/core/resources/views/components/form/skill-dropdown.blade.php ENDPATH**/ ?>