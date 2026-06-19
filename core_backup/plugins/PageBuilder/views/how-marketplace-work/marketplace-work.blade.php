<section class="influencer influencer-market-place pat-120 pab-120"
    @if ($section_bg) style="background-color:{{ $section_bg ?? '' }}" @else class="bg-primary-one" @endif
    data-padding-top="{{ $padding_top ?? '' }}" data-padding-bottom="{{ $padding_bottom ?? '' }}">
    <div class="container">
        <h2 class="text-center inf-title title2 black_text fw_bold mb-40">{{ $title ?? __('How Our Market Place Work') }}
        </h2>
        <div class="marketplace_card_grid">
            @foreach ($repeater_data['image_'] as $key => $data)
                <div class="market-place-work-card text-center">
                    <div class="img-part">
                        {!! render_image_markup_by_attachment_id($data) !!}
                    </div>
                    <div class="text mt-4">
                        <h6 class="inf-title title6 fw_semibold">
                            {{ $repeater_data['title_'][$key] ?? __('Create Account') }}
                        </h6>
                        <div class="mt-2">
                            {{ $repeater_data['subtitle_'][$key] ?? __('Join as an Influencer or Brand to start your journey.') }}
                        </div>
                    </div>
                </div>
                <div class="img">
                    {!! render_image_markup_by_attachment_id($repeater_data['arrow_image_'][$key]) !!}
                </div>
            @endforeach
        </div>
    </div>
</section>
