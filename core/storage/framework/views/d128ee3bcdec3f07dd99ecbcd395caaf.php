<div class="navbar-right-item position-relative">
    <span class="navbar-right-chat search-header-open">
        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-zoom"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
    </span>
    <div class="header-global-search"> 
        <div class="header-global-search-header">
            <h5 class="header-global-search-title"><?php echo e(__('Search')); ?></h5>
            <div class="header-global-search-close search-close"><i class="fa-solid fa-times"></i>
            </div>
        </div>
        <div class="header-global-search-input d-flex align-items-center">
            <div class="header-global-search-input-inner">
                <div class="header-global-search-input-inner-icon" id="header_search_load_spinner">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <input type="text" id="search_your_desired_job" class="form-control"
                       placeholder="<?php echo e(__('Search')); ?>" autocomplete="off">
            </div>
            <div class="header-global-search-select">
                <select id="Select_project_or_job_for_search">
                    <?php if(get_static_option('project_enable_disable') != 'disable'): ?>
                        <option value="project"><?php echo e(__('Project')); ?></option>
                    <?php endif; ?>
                    <?php if(get_static_option('job_enable_disable') != 'disable'): ?>
                        <option value="job"><?php echo e(__('Campaign')); ?></option>
                    <?php endif; ?>
                    <option value="talent"><?php echo e(__('Influencer')); ?></option>
                </select>
            </div>
        </div>
        <div class="display_search_result"></div>
    </div>
    <div class="search-overlay"></div>
</div><?php /**PATH /home/prosdeliver/public_html/core/resources/views/components/frontend/menu-searchbar.blade.php ENDPATH**/ ?>