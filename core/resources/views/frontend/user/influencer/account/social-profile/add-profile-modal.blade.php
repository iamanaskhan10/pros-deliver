<div class="popup-fixed add-experience-popup">
    <div class="popup-contents">
        <span class="popup-contents-close popup-close"> <i class="fas fa-times"></i> </span>
        <h2 class="popup-contents-title">{{ get_static_option('experience_modal_title') ?? __('Social Profile') }}</h2>
        <p class="popup-contents-para">{{ __('Fill the form below to add your social profile.') }}</p>
        <div class="popup-contents-form custom-form">
            <form action="#" name="addExperienceForm">
                <div class="single-input mb-3">
                    <label for="platform_icon" class="label-title mb-2 d-block">{{ __('Choose Social Media Icon') }}</label>
                    <div class="social-icon-picker" id="addModalIconPicker">
                        <div class="search-box mb-3">
                            <input type="text" placeholder="{{ __('Search icons...') }}" id="addModalSearchInput" class="form-control">
                        </div>
                        <div class="icon-container">
                            <div class="icon-grid" id="addModalIconGrid">
                                <!-- Icons will be populated here -->
                            </div>
                        </div>
                        <!-- Hidden input to store the selected icon value -->
                        <input type="hidden" name="platform_icon" id="platform_icon" value="">
                    </div>
                </div>
                <x-form.text :title="__('Profile Link')" :type="__('text')" :name="'profile_link'" :id="'profile_link'" :placeholder="__('Enter Profile Link')" :value="''"/>
                <x-form.text :title="__('Followers')" :type="__('text')" :name="'followers'" :id="'followers'" :placeholder="__('Enter number of followers')" :value="''"/>
                <input type="hidden" name="platform_icon" id="platform_icon">



            </form>
        </div>
        <div class="popup-contents-btn flex-btn justify-content-end profile-border-top">
            <a href="javascript:void(0)" class="btn-profile btn-outline-gray btn-hover-danger popup-close"> <i class="las la-arrow-left"></i>{{ __('Cancel') }}</a>
            <a href="javascript:void(0)" class="btn-profile btn-bg-1 add_experience">{{ __('Save') }}</a>
        </div>
    </div>
</div>
