<!-- Banner area Starts -->
<section class="influencer influencer_banner bg-primary-one pt-60 pb-60"
    @if ($banner_bg_1) @php $img = get_attachment_image_by_id($banner_bg_1); @endphp
    style="background-image: url('{{ $img['img_url'] ?? '' }}');" @endif>
    <div class="container">
        <div class="banner-wraper">
            <div class="banner-text-wraper">
                <h1 class="inf-title title1 fw_bolder">
                    {{ $title ?? __('Elevate your brand with expert influencer marketing.') }}
                </h1>
                <p class="banner-des">
                    {{ $subtitle ?? __("Unlock the power of authentic connections and targeted reach through strategic collaborations with top tier influencers Whether you're looking to build brand awareness drive engagement or boost conversions our.") }}
                </p>
                <div class="banner-btn-wraper d-flex gap-3 flex-wrap">
                    <a class="inf-cmn-btn inf-primary-btn"
                        href="{{ $find_project_button_link ?? route('projects.all') }}">{{ $find_project_button_text ?? __('Hire Influencer') }}
                    </a>
                    @if (!Auth::guard('web')->check())
                        <a class="inf-cmn-btn inf-black-btn-outline"
                            href="{{ $find_work_button_link ?? route('user.register') }}">{{ $find_work_button_text ?? __('Join Now') }}</a>
                    @else
                        @if (Auth::guard('web')->user()->user_type == 1)
                            <a class="inf-cmn-btn inf-black-btn-outline"
                                href="{{ $find_work_button_link ?? route('client.dashboard') }}">{{ $find_work_button_text ?? __('Join Now') }}</a>
                        @else
                            <a class="inf-cmn-btn inf-black-btn-outline"
                                href="{{ $find_work_button_link ?? route('influencer.dashboard') }}">{{ $find_work_button_text ?? __('Join Now') }}</a>
                        @endif
                    @endif
                </div>
            </div>
            <div class="image-part wow fadeInRight">
                <div class="img-wraper">
                    @if ($banner_image)
                        {!! render_image_markup_by_attachment_id($banner_image) !!}
                    @else
                        <img src="{{ asset('asset/static/img/image.png') }}" alt="influencer-banner">
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner area end -->
