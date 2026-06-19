<div class="listing-page all-project-page-wraper">
    <div class="title-with-searchbar-part-wraper">
        <h2 class="inf-title title6 fw_bold balck_text">{{ __('All Projects') }}</h2>
        <div class="searchbar-wraper">
            <input type="text" class="inf-custom-input" id="job_search_string" placeholder="{{ __('Search projects...') }}">
            <button type="submit" id="job_search_by_text" class="inf-cmn-btn style4 inf-primary-btn"><i
                    class="fas fa-search"></i></button>
        </div>
    </div>

</div>
<div class="listing-filter-wraper">
    <div class="gander-filter-wraper listing-filter listing-filter-with-icon no-search">
        <div class="filter-icon">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12.75 6.375C12.75 4.30393 11.071 2.625 9 2.625C6.92893 2.625 5.25 4.30393 5.25 6.375C5.25 8.44605 6.92893 10.125 9 10.125C11.071 10.125 12.75 8.44605 12.75 6.375Z"
                    stroke="#767474" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M14.25 15.375C14.25 12.4755 11.8995 10.125 9 10.125C6.10051 10.125 3.75 12.4755 3.75 15.375"
                    stroke="#767474" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <x-form.filter-project-job-gender :innerTitle="__('Select Gender')" :name="'gender'" :id="'gender'" />
    </div>
    <div class="country-filter-wraper listing-filter listing-filter-with-icon">
        <div class="filter-icon">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8.00065 14.6673C4.31875 14.6673 1.33398 11.6825 1.33398 8.00065C1.33398 6.13896 2.09708 4.4555 3.32756 3.246M8.00065 14.6673C7.35865 14.1916 7.46112 13.6377 7.78318 13.0838C8.27838 12.2323 8.27838 12.2323 8.27838 11.0969C8.27838 9.96158 8.95305 9.42925 11.334 9.90538C12.4038 10.1194 13.1834 8.64125 14.5722 9.12932M8.00065 14.6673C11.2979 14.6673 14.036 12.2737 14.5722 9.12932M3.32756 3.246C3.89376 3.30575 4.21076 3.60908 4.73729 4.16542C5.73692 5.22166 6.73652 5.3098 7.40298 4.95772C8.40258 4.4296 7.56258 3.57418 8.73578 3.1093C9.45505 2.82432 9.59212 2.07798 9.25172 1.45118M3.32756 3.246C4.53062 2.06346 6.18044 1.33398 8.00065 1.33398C8.42825 1.33398 8.84645 1.37424 9.25172 1.45118M14.5722 9.12932C14.6347 8.76245 14.6673 8.38538 14.6673 8.00065C14.6673 4.74636 12.3356 2.03668 9.25172 1.45118"
                    stroke="#767474" stroke-width="1.25" stroke-linejoin="round" />
            </svg>
        </div>
        <x-form.filter-project-job-country :innerTitle="__('Select Country')" :name="'country'" :id="'country'" />
    </div>
    <div class="country-filter-wraper listing-filter listing-filter-with-icon">
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
        <x-form.category-dropdown :title="''" :name="'category'" :id="'category'" :class="'form-control'"
            :selectType="'alternative'" />
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
        <input class="inf-custom-select custom-selector" id="budget_input" placeholder="{{ __('Budget') }}" readonly>
        <div class="budget-secletion-wraper custom-selector-option">
            <div class="inputs-wraper">
                <div class="price-wraper">
                    <label for="min-price">{{ __('Min') }}</label>
                    <input type="number" name="min_price" id="min_price" class="inf-custom-select min-input">
                </div>
                <div class="heipen mb-2">-</div>
                <div class="price-wraper">
                    <label for="max-price">{{ __('Max') }}</label>
                    <input type="number" name="max_price" id="max_price" class="inf-custom-select max-input">
                </div>
            </div>
            <div class="price-range-input-btn">
                <button class="inf-cmn-btn style2 w-100 inf-primary-outline-btn"
                    id="set_price_range">{{ __('Submit') }}</button>
            </div>
        </div>
    </div>
    <div class="project-lenght-filter-wraper listing-filter listing-filter-with-icon">
        @php $all_lengths = \App\Models\Length::where('status',1)->get() @endphp
        <div class="filter-icon">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                xmlns="http://www.w3.org/2000/svg">
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
        <select class="form-control inf-custom-select" name="delivery_day" id="delivery_day">
            <option value="">{{ __('Select Length') }}</option>
            @if ($all_lengths->count() >= 1)
                @foreach ($all_lengths as $length)
                    <option value="{{ $length->length }}">{{ $length->length }}</option>
                @endforeach
            @else
                <option value="1 Days">{{ __('1 Days') }}</option>
                <option value="2 Days">{{ __('2 Days') }}</option>
                <option value="3 Days">{{ __('3 Days') }}</option>
                <option value="less than a week">{{ __('Less than a Week') }}</option>
                <option value="less than a month">{{ __('Less than a month') }}</option>
                <option value="less than 2 month">{{ __('Less than 2 month') }}</option>
                <option value="less than 3 month">{{ __('Less than 3 month') }}</option>
                <option value="More than 3 month">{{ __('More than 2 month') }}</option>
            @endif
        </select>
    </div>
    <div class="choose-rating-filter-wraper listing-filter listing-filter-with-icon">
        <div class="filter-icon">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M9.15238 2.29677L10.3256 4.66257C10.4856 4.9919 10.9122 5.30778 11.2722 5.36827L13.3986 5.72448C14.7585 5.953 15.0784 6.94772 14.0985 7.92898L12.4454 9.59578C12.1654 9.87805 12.0121 10.4224 12.0987 10.8123L12.5721 12.8757C12.9453 14.5089 12.0854 15.1407 10.6522 14.287L8.65912 13.0975C8.29918 12.8824 7.70592 12.8824 7.33925 13.0975L5.34616 14.287C3.91965 15.1407 3.05308 14.5021 3.42638 12.8757L3.89966 10.8123C3.98631 10.4224 3.833 9.87805 3.55302 9.59578L1.89988 7.92898C0.926651 6.94772 1.23995 5.953 2.5998 5.72448L4.72623 5.36827C5.07952 5.30778 5.50614 4.9919 5.66612 4.66257L6.83932 2.29677C7.47925 1.01306 8.51912 1.01306 9.15238 2.29677Z"
                    stroke="#767474" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <select name="chose-rating" id="chose-rating-filter" class="inf-custom-select">
            <option value="">{{ __('Choose Rating') }}</option>
            <option value="1">{{ __('1 Star') }}</option>
            <option value="2">{{ __('2 Stars') }}</option>
            <option value="3">{{ __('3 Stars') }}</option>
            <option value="4">{{ __('4 Stars') }}</option>
            <option value="5">{{ __('5 Stars') }}</option>
        </select>
    </div>
    <div class="reset-filter-btn-wraper">
        <button class="inf-cmn-btn style2 w-100 inf-primary-outline-btn"
            id="project_filter_reset">{{ __('Reset') }}</button>
    </div>
</div>
