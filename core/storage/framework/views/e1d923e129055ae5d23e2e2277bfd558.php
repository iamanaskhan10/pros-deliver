<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['identity', 'type', 'style2' => true]));

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

foreach (array_filter((['identity', 'type', 'style2' => true]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $user = Auth::guard('web')->user();
    $isLoggedIn = Auth::guard('web')->check();
    $bookmark_exists = false;
    if ($isLoggedIn) {
        $bookmark_exists = \App\Models\Bookmark::where('user_id', $user->id)->where('identity', $identity)->exists();
    }
    $classes = 'add-fvt-icon click_to_bookmark';
    $classes .= $style2 ? ' style-2' : '';
    $classes .= $bookmark_exists ? ' fvt' : '';
?>

<button href="#/" class="<?php echo e($classes); ?>" data-identity="<?php echo e($identity); ?>" data-type="<?php echo e($type); ?>"
    <?php if($isLoggedIn): ?> data-route="<?php echo e(route($user->user_type == 1 ? 'client.bookmark' : 'influencer.bookmark')); ?>"
    <?php else: ?>
        data-login="login-please" <?php endif; ?>>
    <i class="fas fa-heart"></i>
</button>
<?php /**PATH /home/prosdeliver/public_html/core/resources/views/components/frontend/bookmark.blade.php ENDPATH**/ ?>