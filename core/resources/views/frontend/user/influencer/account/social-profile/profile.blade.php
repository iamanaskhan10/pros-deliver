<!-- Setup Experience Start -->
<div class="setup-wrapper-contents">
    <div class="setup-wrapper-contents-item">
        <h3 class="setup-wrapper-contents-title">{{ get_static_option('experience_title') ?? __('Tell us about your professional experiences(Experience)') }}</h3>
        <div class="setup-wrapper-experience">
            <div class="setup-wrapper-experience-add">
                <span class="setup-wrapper-experience-add-title">{{ __('Add a social profile') }}</span>
                <a href="javascript:void(0)" class="setup-wrapper-experience-add-icon add-experience">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="setup-wrapper-contents-item" id="display_user_experience_data">
        <h4 class="setup-wrapper-contents-title-two">{{ get_static_option('experience_inner_title') ?? __('Followers') }} </h4>
        @foreach($social_profiles as $profile)
            <div class="setup-wrapper-experience">
                <div class="setup-wrapper-experience-details">
                    <div class="setup-wrapper-experience-details-flex">
                        <div class="setup-wrapper-experience-details-left">
                            <h5 class="setup-wrapper-experience-details-title">
                                <i class="{{$profile->platform_icon ?? ''}}"></i> {{ $profile->followers ?? '' }}
                            </h5>
                        </div>
                        <a href="javascript:void(0)"
                           class="setup-wrapper-experience-details-edit experience-click edit_single_experience"
                           data-id="{{ $profile->id }}"
                           data-profile_link="{{ $profile->profile_link }}"
                           data-followers="{{ $profile->followers }}"
                           data-platform_icon="{{ $profile->platform_icon }}"
                        > <i class="fas fa-edit"></i>
                        </a>
                        <a href="javascript:void(0)"
                           class="setup-wrapper-experience-details-edit delete_single_profile"
                           data-id="{{ $profile->id }}"><i class="fa-solid fa-circle-xmark"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


<!-- Edit Experience Starts  -->
@include('frontend.user.influencer.account.social-profile.edit-profile-modal')
<!-- Edit Experience Ends  -->

<!-- Add Experience Starts  -->
@include('frontend.user.influencer.account.social-profile.add-profile-modal')
<!-- Add Experience Ends  -->

