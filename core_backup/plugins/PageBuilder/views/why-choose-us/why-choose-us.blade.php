<section class="influencer influencer-why-chose-us pat-120 pab-120" data-padding-top="{{ $padding_top ?? '' }}"
    data-padding-bottom="{{ $padding_bottom ?? '' }}">
    <div class="container">
        <h2 class="text-center inf-title title2 black_text fw_bold mb-40">{{ $title ?? __('Why 1M+ People Choose Us') }}
        </h2>
        <div class="row g-4">
            @foreach ($repeater_data['image_'] as $key => $data)
                <div class="col-md-4 col-sm-6">
                    <div class="why-chose-card">
                        <div class="header-part d-flex gap-3">
                            <div class="img-wraper">
                                {!! render_image_markup_by_attachment_id($data) ?? '' !!}
                            </div>
                            <h4 class="inf-title title6 fw_semibold">
                                {{ $repeater_data['title_'][$key] ?? __('Advanced Analysis') }}
                            </h4>
                        </div>
                        <div class="text">
                            <p class="mt-3">
                                {{ $repeater_data['subtitle_'][$key] }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
