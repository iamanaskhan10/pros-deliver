<!-- About area starts -->
<section class="influencer about-us pat-80 pab-120" data-padding-top="{{ $padding_top ?? '' }}"
    data-padding-bottom="{{ $padding_bottom ?? '' }}" style="background-color:{{ $section_bg ?? '' }}">
    <div class="about-us-wraper text-center mb-80">
        <div class="container">
            <h3 class="inf-title title4 deep_black_text fw_bold text-center">
                {{ $title ?? __('About Us') }}
            </h3>
            <div class="about-us-des">
                {!! $description ?? '' !!}
            </div>
            <div class="about-us-main-image">
                {!! render_image_markup_by_attachment_id($image) ?? '' !!}
            </div>
        </div>
    </div>
    <div class="success-stories-wraper">
        <div class="container">
            <h4 class="inf-title title4 deep_black_text fw_bold">
                {{ $success_title ?? __('Success Stories') }}
            </h4>
            <div class="story-wraper">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <div class="img-wraper">
                            {!! render_image_markup_by_attachment_id($success_image) ?? '' !!}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="story-content">
                            <h6 class="inf-title lg-font deep_black_text fw_bold">
                                {{ $success_sub_title ?? __('Growth Fueled by Influence') }}
                            </h6>
                            <div class="inf-para">
                                {!! $success_description ?? '' !!}
                            </div>
                            <ul class="success-list">
                                @foreach ($repeater_data['success_points_'] ?? [] as $key => $title)
                                    <li>{{ $title }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About area end -->
