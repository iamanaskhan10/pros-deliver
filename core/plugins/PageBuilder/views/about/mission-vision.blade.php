<section class="our-mission-vision influencer pat-120 pab-60" data-padding-top="{{ $padding_top ?? '' }}"
    data-padding-bottom="{{ $padding_bottom ?? '' }}" style="background-color:{{ $section_bg ?? '' }}">
    <div class="container">
        <h4 class="inf-title title4 deep_black_text fw_bold">
            {!! $title ?? __('Our Mission & Vision') !!}
        </h4>
        <div class="our-mission-vision-wraper">
            <div class="row">
                @foreach ($repeater_data['image_'] ?? [] as $key => $data)
                    <div class="col-md-6">
                        <div class="mission-vision-wraper mission-wraper">
                            <div class="mission-vision-image">
                                {!! render_image_markup_by_attachment_id($data) ?? '' !!}
                            </div>
                            <div class="mission-vision-content">
                                <h5 class="inf-title title7 deep_black_text fw_semibold">
                                    {{ $repeater_data['title_'][$key] ?? '' }}
                                </h5>
                                <p class="des">
                                    {!! $repeater_data['description_'][$key] ?? '' !!}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
