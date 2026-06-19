<div class="popup-overlay"></div>
<div class="popup-fixed experience-popup">
    <div class="popup-contents">
        <span class="popup-contents-close popup-close"> <i class="fas fa-times"></i> </span>
        <h2 class="popup-contents-title"> {{ get_static_option('experience_edit_modal_title') ?? __('Edit Social profile') }} </h2>
        <p class="popup-contents-para"> {{ __('Fill the form below to add your social profile') }} </p>
        <div class="popup-contents-form custom-form">
            <form action="#">
                <input type="hidden" name="edit_id" id="edit_id">
                <input type="hidden" name="edit_platform_icon" id="edit_platform_icon">

                <x-form.text :title="__('Profile Link')" :type="__('text')" :name="'edit_profile_link'" :id="'edit_profile_link'" :placeholder="__('Enter Profile Link')" :value="''"/>
                <x-form.text :title="__('Followers')" :type="__('text')" :name="'edit_followers'" :id="'edit_followers'" :placeholder="__('Enter number of followers')" :value="''"/>

                <div class="single-input mb-3">
                    <label for="edit_platform_icon" class="label-title">{{ __('Choose Icon') }}</label>
                    <button type="button" class="btn btn-primary iconpicker-component">
                        <span class="show_icon"></span>
                    </button>
                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                    </button>
                    <div class="dropdown-menu"></div>
                </div>

            </form>
        </div>
        <div class="popup-contents-btn flex-btn justify-content-end profile-border-top">
            <a href="javascript:void(0)" class="btn-profile btn-outline-gray btn-hover-danger popup-close"> <i class="las la-arrow-left"></i>{{ __('Cancel') }} </a>
            <a href="javascript:void(0)" class="btn-profile btn-bg-1 update_single_experience"> {{ __('Update') }} </a>
        </div>
    </div>
</div>
