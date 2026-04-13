<section class="influencer influencer-faq-section pat-120 pab-120" data-padding-top="{{ $padding_top ?? '' }}"
    data-padding-bottom="{{ $padding_bottom ?? '' }}" style="background-color:{{ $section_bg ?? 'bg-primary-one' }}"
    id="faq">
    <div class="container">
        <h2 class="text-center inf-title title2 black_text fw_bold mb-40">{{ $title ?? __('Frequently Asked Questions') }}
        </h2>
        <div class="inf-faq-wraper">
            @foreach ($repeater_data['title_'] as $key => $title)
                <div class="inf-faq-item {{ $key === 0 ? 'open' : '' }}">
                    <div class="inf-faq-title-wraper">
                        <h3 class="inf-title lg-font fw_semibold black_text">
                            {{ $title ?? __('What are the main benefits of influencer marketing for brands?') }}
                        </h3>
                        <div class="icon lg-font fw_medium black_text">
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="inf-faq-content-wraper">
                        {{ $repeater_data['description_'][$key] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
