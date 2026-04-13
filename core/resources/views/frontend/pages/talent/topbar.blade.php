<div class="listing-page all-project-page-wraper">
    <div class="title-with-searchbar-part-wraper">
        <h2 class="inf-title title6 fw_bold balck_text">{{ __('All Influencers') }}</h2>
        <div class="searchbar-wraper">
            <input type="text" class="inf-custom-input" id="job_search_string" placeholder="{{ __('Search Influencers...') }}">
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
        <x-form.filter-project-job-country :innerTitle="__('Select Country')" :name="'category'" :id="'country'" />
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
        <x-form.category-dropdown :title="''" :name="'category'" :id="'category'" :class="'form-control'" :selectType="'alternative'"/>
    </div>
    <div class="project-lenght-filter-wraper listing-filter listing-filter-with-icon">
        <div class="filter-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3a7 7 0 00-3.46 13.14c.23.12.46.26.67.42.57.45.94 1.17.94 1.94V20a1 1 0 001 1h1.5a1 1 0 001-1v-1.5c0-.77.37-1.49.94-1.94.21-.16.44-.3.67-.42A7 7 0 0012 3z" />
            </svg>
        </div>
        <x-form.skill-dropdown :title="''" :name="'skill'" :id="'skill'" :class="'form-control'"  :selectType="'alternative'" />
    </div>
    <div class="follower-filter-wraper listing-filter listing-filter-with-icon">
        <div class="filter-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#767474" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
        </div>

        <input class="inf-custom-select custom-selector" id="budget_input" placeholder="{{ __('Followers') }}" readonly>

        <div class="budget-secletion-wraper custom-selector-option">
            <div class="inputs-wraper">
                <div class="price-wraper">
                    <label for="min-count">{{ __('Min') }}</label>
                    <input type="number" name="min_count" id="min_count" class="inf-custom-select min-input">
                </div>
                <div class="heipen mb-2">-</div>
                <div class="price-wraper">
                    <label for="max-count">{{ __('Max') }}</label>
                    <input type="number" name="max_count" id="max_count" class="inf-custom-select max-input">
                </div>
            </div>
            <div class="price-range-input-btn">
                <button class="inf-cmn-btn style2 w-100 inf-primary-outline-btn"
                        id="set_follower_range">{{ __('Submit') }}</button>
            </div>
        </div>

    </div>
    <div class="reset-filter-btn-wraper">
        <button class="inf-cmn-btn style2 w-100 inf-primary-outline-btn"
            id="talent_filter_reset">{{ __('Reset') }}</button>
    </div>
</div>
