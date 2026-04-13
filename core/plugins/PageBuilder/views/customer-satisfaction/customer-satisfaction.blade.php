<section class="influencer influencer-customer-satification bg-primary-one pat-120 pab-120"
    @if ($section_bg) style="background-color:{{ $section_bg ?? '' }}" @else class="bg-primary-one" @endif
    data-padding-top="{{ $padding_top ?? '' }}" data-padding-bottom="{{ $padding_bottom ?? '' }}">
    <div class="container">
        <h2 class="text-center inf-title title2 black_text fw_bold mb-40">
            {{ $title ?? __('Customer Satisfaction Stats') }}
        </h2>
        <div class="customer-satification-stats-wraper">
            <div class="row g-4">
                @foreach ($repeater_data['image_'] as $key => $data)
                    <div class="col-md-3 col-6">
                        <div class="customer-satification-stats-card"
                            style="background-color:{{ $repeater_data['bg_color_'][$key] ?? '' }}">
                            <div class="img">
                                {!! render_image_markup_by_attachment_id($data) ?? '' !!}
                            </div>
                            @php
                                $hasBg = !empty($repeater_data['bg_color_'][$key]);
                                $textClass = $hasBg ? ' white_text' : '';
                            @endphp
                            <div class="text {{ $textClass }}">
                                <h3 class="inf-title title3 fw_semibold {{ $hasBg ? 'white_text' : 'black_text' }}">
                                    {{ $repeater_data['number_'][$key] ?? '3.5K+' }}
                                </h3>
                                <div class="">
                                    {{ $repeater_data['title_'][$key] ?? __('Brands') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
