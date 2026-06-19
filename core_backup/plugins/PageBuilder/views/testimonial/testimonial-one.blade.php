<!-- Review Section -->
<section class="influencer influencer-review-section pat-120 pab-120" data-padding-top="{{ $padding_top ?? '' }}"
    data-padding-bottom="{{ $padding_bottom ?? '' }}">
    <div class="container slider-wraper-parent">
        <div class="d-flex justify-content-between flex-wrap gap-2 mb-40">
            <h2 class="text-center inf-title title2 black_text fw_bold">{{ $title ?? __('Influencer Review') }}</h2>
            <div class="slider-navigation-btn-wraper"></div>
        </div>
        <!--Slider for Review-->
        <div class="review-slider-wraper-container">
            <div class="review-left-wraper">
                <div class="review-left-inner global-slick-init" 
                    data-slidestoshow="3" 
                    data-swipetoslide="true"
                    data-arrows="true" 
                    data-prevarrow='<div class="up_arrow"><i class="fas fa-angle-left"></i></div>'
                    data-nextarrow='<div class="down_arrow"><i class="fas fa-angle-right"></i></div>'
                    data-appendarrows=".slider-navigation-btn-wraper"
                    data-responsive='[{"breakpoint": 1025,"settings": {"slidesToShow": 2}},{"breakpoint": 768,"settings": {"slidesToShow": 2}},{"breakpoint": 576,"settings": {"slidesToShow": 1}}]'>
                    @foreach ($feedbacks as $feedback)
                        <div class="slider_left_card">
                            <div class="d-flex flex-column gap-2">
                                {!! freelancer_feedback_rating($feedback?->user?->id) !!}
                                <p class="review-des fw_medium threeline-text">
                                    {{ ucfirst($feedback->description) }}
                                </p>
                            </div>
                            <div class="slider_left_card_left_side">
                                <div class="d-flex align-items-center gap-1">
                                    <div class="profile_image">
                                        <img src="{{ asset('assets/uploads/profile/' . $feedback?->user?->image) ?? '' }}"
                                            alt="{{ __('profile img') }}">
                                    </div>
                                    <div class="profile_name">
                                        <p class="font_700 font_size_14 text-black">
                                            {{ $feedback?->user?->fullname }}</p>
                                        <p class="text_gray_300 font_size_12 mt-1">
                                            {{ '@' . $feedback?->user?->username }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="review-right-wraper d-none">
                <div class="review-right-inner">
                    <div class="slider_image_card">
                        {!! render_image_markup_by_attachment_id($testimonial_image) ?? '' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
