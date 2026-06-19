<!-- Brand Logo area start -->
<section class="influencer our-sponsor-section"
    @if ($section_bg) style="background-color:{{ $section_bg ?? '' }}" @else class="bg-black" @endif
    data-padding-top="{{ $padding_top ?? '' }}" data-padding-bottom="{{ $padding_bottom ?? '' }}">
    <div class="container">
        <div class="our-sponsor-inner">
            <h6 class="inf-title title6 fw_semibold white_text">{{ $title ?? __('Our Sponsors') }}</h6>
            <div class="sponsor_brand_wraper">
                <div class="sponsor_brand_container">
                    @foreach ($repeater_data['brand_'] as $key => $logo)
                        <div class="sopnsor_brand">
                            {!! render_image_markup_by_attachment_id($logo) !!}
                        </div>
                    @endforeach
                </div>
                <div class="sponsor_brand_container">
                    @foreach ($repeater_data['brand_'] as $key => $logo)
                        <div class="sopnsor_brand">
                            {!! render_image_markup_by_attachment_id($logo) !!}
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Brand Logo area end -->
