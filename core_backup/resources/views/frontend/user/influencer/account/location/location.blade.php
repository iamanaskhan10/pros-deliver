<!-- Setup Introduction Start -->
<div class="setup-wrapper-contents">
    <form id="fileUploadForm">
        <div class="setup-wrapper-contents-item">
            <h3 class="setup-wrapper-contents-title">{{ get_static_option('location_country_title') ?? __('Choose Your Country')}} </h3>
            <div class="setup-wrapper-contents-form">
                <div class="setup-wrapper-contents-form-item">
                    <x-form.country-dropdown :title="''" :id="'country_id'"/>
                </div>
            </div>
        </div>

        <div class="setup-wrapper-contents-item">
            <h3 class="setup-wrapper-contents-title">{{ get_static_option('location_state_title') ?? __('Choose Your State')}} </h3>
            <div class="setup-wrapper-contents-form">
                <div class="setup-wrapper-contents-form-item">
                    <x-form.state-dropdown :title="''" :id="'state_id'"/>
                </div>
            </div>
        </div>

        <div class="setup-wrapper-contents-item">
            <h3 class="setup-wrapper-contents-title">{{ get_static_option('location_city_title') ?? __('Choose Your City')}} </h3>
            <div class="setup-wrapper-contents-form">
                <div class="setup-wrapper-contents-form-item">
                    <x-form.city-dropdown :title="''" :id="'city_id'"/>
                </div>
            </div>
        </div>

    </form>

</div>
<!-- Setup Introduction Ends -->
