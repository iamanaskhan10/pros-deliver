<!-- Setup Work Start -->
<div class="setup-wrapper-contents">
    <div class="setup-wrapper-contents-item">
        <h3 class="setup-wrapper-contents-title">{{ get_static_option('work_title') ?? __('What kinds of services will you provide to clients?(Work)') }}</h3>
        <div class="setup-wrapper-work">
            <div class="row g-4">
                <input type="hidden" id="set_category_id" value="{{ !empty($user_work_categories) ? implode(',', $user_work_categories) : '' }}">
                @foreach($categories as $cat)
                <div class="col-md-4 col-sm-6 setup-work-child work_category_id">
                    <input type="hidden" value="{{ $cat->id }}">
                    <div class="setup-wrapper-work-single center-text {{ !empty($user_work_categories) && in_array($cat->id, $user_work_categories) ? 'active' : '' }}">
                        <div class="setup-wrapper-work-single-icon">
                            {!! render_image_markup_by_attachment_id($cat->image) !!}
                        </div>
                        <h4 class="setup-wrapper-work-single-title"> <a href="javascript:void(0)">{{ $cat->category }}</a> </h4>
                    </div>
                </div>
                @endforeach
                <div class="col-md-4 col-sm-6 setup-work-child">
                    <div class="setup-wrapper-work-single center-text work-click">
                        <div class="setup-wrapper-work-single-icon">
                            <h4>+{{ $more_categories->count() ?? '' }}</h4>
                        </div>
                        <h4 class="setup-wrapper-work-single-title"> {{ __('Categories to choose from') }} </h4>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Popup Modal Work area starts -->
<div class="popup-fixed work-popup">
    <div class="popup-contents">
        <span class="popup-contents-close popup-close"> <i class="fas fa-times"></i> </span>
        <h2 class="popup-contents-title">{{ get_static_option('work_modal_title') ?? __('Choose a service') }}</h2>
        <p class="popup-contents-para">{{ __('Choose what kinds of services will you provide to clients?') }}</p>
        <div class="row g-4 mt-2 search_result">
            @include('frontend.user.influencer.account.work.search-categories')
        </div>
        <div class="popup-contents-btn flex-btn justify-content-end profile-border-top">
            <a href="javascript:void(0)" class="btn-profile btn-outline-gray btn-hover-danger popup-close"> <i class="las la-arrow-left"></i>{{ __('Cancel') }}</a>
        </div>
    </div>
</div>
<!-- Popup Modal area ends -->
<!-- Setup Work Ends -->
