<div class="listing-page all-project-page-wraper">
    <div class="title-with-searchbar-part-wraper">
        <h2 class="inf-title title6 fw_bold balck_text"><?php echo e(__('All Campaigns')); ?></h2>
        <div class="searchbar-wraper">
            <input type="text" class="inf-custom-input" id="job_search_string"
                placeholder="<?php echo e(__('Search Campaigns...')); ?>">
            <button type="submit" class="inf-cmn-btn style4 inf-primary-btn" id="job_search_by_text"><i
                    class="fas fa-search"></i></button>
        </div>
    </div>

</div>
<div class="listing-filter-wraper">
    <div class="country-filter-wraper listing-filter listing-filter-with-icon">
        <div class="filter-icon">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8.00065 14.6673C4.31875 14.6673 1.33398 11.6825 1.33398 8.00065C1.33398 6.13896 2.09708 4.4555 3.32756 3.246M8.00065 14.6673C7.35865 14.1916 7.46112 13.6377 7.78318 13.0838C8.27838 12.2323 8.27838 12.2323 8.27838 11.0969C8.27838 9.96158 8.95305 9.42925 11.334 9.90538C12.4038 10.1194 13.1834 8.64125 14.5722 9.12932M8.00065 14.6673C11.2979 14.6673 14.036 12.2737 14.5722 9.12932M3.32756 3.246C3.89376 3.30575 4.21076 3.60908 4.73729 4.16542C5.73692 5.22166 6.73652 5.3098 7.40298 4.95772C8.40258 4.4296 7.56258 3.57418 8.73578 3.1093C9.45505 2.82432 9.59212 2.07798 9.25172 1.45118M3.32756 3.246C4.53062 2.06346 6.18044 1.33398 8.00065 1.33398C8.42825 1.33398 8.84645 1.37424 9.25172 1.45118M14.5722 9.12932C14.6347 8.76245 14.6673 8.38538 14.6673 8.00065C14.6673 4.74636 12.3356 2.03668 9.25172 1.45118"
                    stroke="#767474" stroke-width="1.25" stroke-linejoin="round" />
            </svg>
        </div>
        <?php if (isset($component)) { $__componentOriginal12fe48fc0aa2632da8ebcb778f3ef00f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal12fe48fc0aa2632da8ebcb778f3ef00f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.filter-project-job-country','data' => ['innerTitle' => __('Select Country'),'name' => 'category','id' => 'country']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.filter-project-job-country'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['innerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Select Country')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('category'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('country')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal12fe48fc0aa2632da8ebcb778f3ef00f)): ?>
<?php $attributes = $__attributesOriginal12fe48fc0aa2632da8ebcb778f3ef00f; ?>
<?php unset($__attributesOriginal12fe48fc0aa2632da8ebcb778f3ef00f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal12fe48fc0aa2632da8ebcb778f3ef00f)): ?>
<?php $component = $__componentOriginal12fe48fc0aa2632da8ebcb778f3ef00f; ?>
<?php unset($__componentOriginal12fe48fc0aa2632da8ebcb778f3ef00f); ?>
<?php endif; ?>
    </div>
    <div class="project-lenght-filter-wraper listing-filter listing-filter-with-icon">
        <div class="filter-icon">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="#000000"
                stroke-width="1"
                stroke-linecap="round"
                stroke-linejoin="round"
                >
                <path d="M14 4h6v6h-6z" />
                <path d="M4 14h6v6h-6z" />
                <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                <path d="M7 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
            </svg>
        </div>
        <?php if (isset($component)) { $__componentOriginal84806209167b80946d2b24ff70d8da26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal84806209167b80946d2b24ff70d8da26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.category-dropdown','data' => ['title' => '','name' => 'category','id' => 'category','class' => 'form-control','selectType' => 'alternative']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.category-dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(''),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('category'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('category'),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('form-control'),'selectType' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('alternative')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal84806209167b80946d2b24ff70d8da26)): ?>
<?php $attributes = $__attributesOriginal84806209167b80946d2b24ff70d8da26; ?>
<?php unset($__attributesOriginal84806209167b80946d2b24ff70d8da26); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal84806209167b80946d2b24ff70d8da26)): ?>
<?php $component = $__componentOriginal84806209167b80946d2b24ff70d8da26; ?>
<?php unset($__componentOriginal84806209167b80946d2b24ff70d8da26); ?>
<?php endif; ?>
    </div>

    <div class="budget-filter-wraper listing-filter listing-filter-with-icon">
        <div class="filter-icon">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M11.9715 5.59259C11.9715 4.16074 10.1931 3 7.99935 3C5.80555 3 4.02713 4.16074 4.02713 5.59259C4.02713 7.02447 5.11046 7.8148 7.99935 7.8148C10.8882 7.8148 12.3327 8.55553 12.3327 10.4074C12.3327 12.2593 10.3926 13 7.99935 13C5.60612 13 3.66602 11.8393 3.66602 10.4074"
                    stroke="#767474" stroke-width="1.25" stroke-linecap="round" />
                <path d="M8.33398 1.66602V2.80602M8.33398 14.3327V13.1927" stroke="#767474" stroke-width="1.25"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <input class="inf-custom-select custom-selector" id="budget_input" placeholder="<?php echo e(__('Budget')); ?>" readonly>
        <div class="budget-secletion-wraper custom-selector-option">
            <div class="inputs-wraper">
                <div class="price-wraper">
                    <label for="min-price"><?php echo e(__('Min')); ?></label>
                    <input type="number" name="min_price" id="min_price" class="inf-custom-select min-input">
                </div>
                <div class="heipen mb-2">-</div>
                <div class="price-wraper">
                    <label for="max-price"><?php echo e(__('Max')); ?></label>
                    <input type="number" name="max_price" id="max_price" class="inf-custom-select max-input">
                </div>
            </div>
            <div class="price-range-input-btn">
                <button class="inf-cmn-btn style2 w-100 inf-primary-outline-btn"
                    id="set_price_range"><?php echo e(__('Submit')); ?></button>
            </div>
        </div>
    </div>
    <?php $all_lengths = \App\Models\Length::where('status',1)->get() ?>
    <div class="project-lenght-filter-wraper listing-filter listing-filter-with-icon">
        <div class="filter-icon">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.6673 1.33398V4.00065M5.33398 1.33398V4.00065" stroke="#767474" stroke-width="1.25"
                    stroke-linecap="round" stroke-linejoin="round" />
                <path
                    d="M8.66667 2.66602H7.33333C4.81917 2.66602 3.5621 2.66602 2.78105 3.44706C2 4.22812 2 5.48519 2 7.99935V9.33268C2 11.8468 2 13.1039 2.78105 13.8849C3.5621 14.666 4.81917 14.666 7.33333 14.666H8.66667C11.1808 14.666 12.4379 14.666 13.2189 13.8849C14 13.1039 14 11.8468 14 9.33268V7.99935C14 5.48519 14 4.22812 13.2189 3.44706C12.4379 2.66602 11.1808 2.66602 8.66667 2.66602Z"
                    stroke="#767474" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M2 6.66602H14" stroke="#767474" stroke-width="1.25" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path
                    d="M7.99765 9.33398H8.00365M7.99765 12.0007H8.00365M10.6613 9.33398H10.6673M5.33398 9.33398H5.33996M5.33398 12.0007H5.33996"
                    stroke="#767474" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <select class="form-control inf-custom-select" name="duration" id="duration">
            <option value=""><?php echo e(__('Select Length')); ?></option>
            <?php if($all_lengths->count() >= 1): ?>
                <?php $__currentLoopData = $all_lengths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $length): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($length->length); ?>"><?php echo e($length->length); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <option value="1 Days"><?php echo e(__('1 Days')); ?></option>
                <option value="2 Days"><?php echo e(__('2 Days')); ?></option>
                <option value="3 Days"><?php echo e(__('3 Days')); ?></option>
                <option value="less than a week"><?php echo e(__('Less than a Week')); ?></option>
                <option value="less than a month"><?php echo e(__('Less than a month')); ?></option>
                <option value="less than 2 month"><?php echo e(__('Less than 2 month')); ?></option>
                <option value="less than 3 month"><?php echo e(__('Less than 3 month')); ?></option>
                <option value="More than 3 month"><?php echo e(__('More than 2 month')); ?></option>
            <?php endif; ?>
        </select>
    </div>
    <div class="other-option-filter-wraper listing-filter listing-filter-with-icon">
        <div class="filter-icon">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.6673 1.33398V4.00065M5.33398 1.33398V4.00065" stroke="#767474" stroke-width="1.25"
                      stroke-linecap="round" stroke-linejoin="round" />
                <path
                        d="M8.66667 2.66602H7.33333C4.81917 2.66602 3.5621 2.66602 2.78105 3.44706C2 4.22812 2 5.48519 2 7.99935V9.33268C2 11.8468 2 13.1039 2.78105 13.8849C3.5621 14.666 4.81917 14.666 7.33333 14.666H8.66667C11.1808 14.666 12.4379 14.666 13.2189 13.8849C14 13.1039 14 11.8468 14 9.33268V7.99935C14 5.48519 14 4.22812 13.2189 3.44706C12.4379 2.66602 11.1808 2.66602 8.66667 2.66602Z"
                        stroke="#767474" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M2 6.66602H14" stroke="#767474" stroke-width="1.25" stroke-linecap="round"
                      stroke-linejoin="round" />
                <path
                        d="M7.99765 9.33398H8.00365M7.99765 12.0007H8.00365M10.6613 9.33398H10.6673M5.33398 9.33398H5.33996M5.33398 12.0007H5.33996"
                        stroke="#767474" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <select class="form-control inf-custom-select" name="sorting" id="sorting">
            <option value=""><?php echo e(__('Sorting')); ?></option>
            <option value="old_to_new"><?php echo e(__('Old to New')); ?></option>
            <option value="new_to_old"><?php echo e(__('New to Old')); ?></option>
            <option value="low_to_high_price"><?php echo e(__('Low To High Price')); ?></option>
            <option value="high_to_low_price"><?php echo e(__('High to Low Price')); ?></option>
        </select>
    </div>
    <div class="reset-filter-btn-wraper">
        <button class="inf-cmn-btn style2 w-100 inf-primary-outline-btn"
            id="campaign_filter_reset"><?php echo e(__('Reset')); ?></button>
    </div>
</div>
<?php /**PATH /home/prosdeliver/public_html/core/resources/views/frontend/pages/jobs/topbar.blade.php ENDPATH**/ ?>