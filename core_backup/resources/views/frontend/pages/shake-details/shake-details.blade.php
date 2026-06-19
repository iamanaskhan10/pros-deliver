@extends('frontend.layout.master')
@section('page-meta-data')
    {!!  render_page_meta_data_for_service($project) !!}
@endsection
@section('style')
    <style>
        .disabled-link {
            background-color: #ccc !important;
            pointer-events: none;
            cursor: default;
            border-color: #ccc!important;
        }
    </style>
    <x-select2.select2-css />
@endsection
@section('content')
    <main>
        <!-- Shake details -->
        <div class="influencer page-wraper pat-80 pab-120">
            <div class="container">
                <div class="project-owner influencer-freelancer">
                    <div class="left-part">
                        <div class="inf-img">
                            <a href="{{ route('influencer.profile.details', $user->username) }}">
                                @if (!empty($user->image))
                                    @php
                                        $filePath = 'assets/uploads/profile/' . $user->image;
                                        $extension = pathinfo($user->image, PATHINFO_EXTENSION);
                                        $isVideo = in_array(strtolower($extension), ['mp4', 'webm', 'avi', 'mov']);
                                    @endphp

                                    @if ($isVideo)
                                        <video
                                                src="{{ asset($filePath) }}"
                                                muted
                                                loop
                                                preload="metadata"
                                                class="profile-video"
                                                onmouseover="this.play()"
                                                onmouseout="this.pause(); this.currentTime=0;">
                                        </video>
                                    @else
                                        <img src="{{ asset($filePath) }}" alt="{{ $user->first_name }}">
                                    @endif
                                @else
                                    <img src="{{ asset('assets/static/img/author/author.jpg') }}" alt="{{ __('profile img') }}">
                                @endif
                            </a>
                            <x-status.user-online-offline-check :userID="$user->id" />
                        </div>
                    </div>
                    <div class="right-part">
                        <div class="right-top d-flex gap-4">
                            <div class="name lg-font fw_semibold black_text">
                                <a href="{{ route('influencer.profile.details', $user->username) }}">
                                    {{ $user->full_name }}
                                </a>
                            </div>
                        </div>
                        <div class="right-bottom">
                            <div class="raitng-wraper fw_semibold">
                                {!! freelancer_rating($user->id) !!}
                            </div>
                            @php
                                $social_profiles = \App\Models\SocialProfile::where('user_id', $user->id)->get();
                            @endphp
                            @if ($social_profiles->isNotEmpty())
                                <div class="social-icon-wraper">
                                    @foreach ($social_profiles as $profile)
                                        <div class="social-icon">
                                            <a href="#/">
                                                <i class="{{ $profile->platform_icon }}"></i>
                                            </a>
                                            <span>{{ $profile->followers }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-xl-8">
                        <div class="project-details-wraper">
                            @php
                                $image_ids = explode('|', $project->image); // only images here
                                $image_count = count($image_ids);
                                $slides_768 = $image_count > 4 ? 4 : $image_count;
                                $slides_425 = $image_count > 3 ? 3 : $image_count;

                                $responsive_settings = json_encode([
                                    ['breakpoint' => 768, 'settings' => ['slidesToShow' => $slides_768]],
                                    ['breakpoint' => 425, 'settings' => ['slidesToShow' => $slides_425]],
                                ]);

                                $video = !empty($project->video) ? get_attachment_image_by_id($project->video, null, true)['img_url'] : null;
                            @endphp

                            <div class="projecte-details-slider-wraper">
                                <div class="slider-navigation-arrow"></div>

                                {{-- Main Slider --}}
                                <div class="main-image-wraper inf-global-slick global-slick-init"
                                     data-asNavFor=".small-images-wraper" data-arrows="true" data-infinite="true"
                                     data-appendarrows=".slider-navigation-arrow"
                                     data-nextarrow="<span class='next-arrow'><i class='fa fa-angle-right'></i></span>"
                                     data-prevarrow="<span class='prev-arrow'><i class='fa fa-angle-left'></i></span>">

                                    {{-- Images --}}
                                    @foreach ($image_ids as $image_id)
                                        @php $img_url = get_attachment_image_by_id($image_id, null, true)['img_url'] ?? ''; @endphp
                                        <div class="main-images">
                                            <img src="{{ $img_url }}" alt="project-details">
                                            @if(moduleExists('PromoteInfluencer') && $project->is_pro_project && !empty(get_static_option('promoted_badge_text')))
                                                <span class="sponsored-badge">
                                                    {{ get_static_option('promoted_badge_text') ?? __('Sponsored') }}
                                                </span>
                                            @endif
                                            <div class="fvt-icon-wraper">
                                                @if (!Auth::guard('web')->check() || Auth::guard('web')->user()->user_type == 1)
                                                    <x-frontend.bookmark :identity="$project->id" :type="'project'" />
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach

                                    {{-- Video as last slide --}}
                                    @if ($video)
                                        <div class="main-images">
                                            <video src="{{ $video }}" muted loop preload="metadata"></video>
                                            @if(moduleExists('PromoteInfluencer') && $project->is_pro_project && !empty(get_static_option('promoted_badge_text')))
                                                <span class="sponsored-badge">
                                                    {{ get_static_option('promoted_badge_text') ?? __('Sponsored') }}
                                                </span>
                                            @endif
                                            <div class="fvt-icon-wraper">
                                                @if (!Auth::guard('web')->check() || Auth::guard('web')->user()->user_type == 1)
                                                    <x-frontend.bookmark :identity="$project->id" :type="'project'" />
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                {{-- Thumbnail Slider --}}
                                <div class="small-slider-image-wraper">
                                    <div class="small-images-wraper global-slick-init"
                                         data-slidestoshow="{{ $slides_768 }}" data-asNavFor=".main-image-wraper"
                                         data-focusonselect="true" data-infinite="true"
                                         data-responsive='{{ $responsive_settings }}'>

                                        {{-- Thumbnails for images --}}
                                        @foreach ($image_ids as $image_id)
                                            @php $img_url = get_attachment_image_by_id($image_id, null, true)['img_url'] ?? ''; @endphp
                                            <div class="small-image">
                                                <img src="{{ $img_url }}" alt="image">
                                            </div>
                                        @endforeach

                                        {{-- Thumbnail for video --}}
                                        @if ($video)
                                            <div class="small-image">
                                                <video src="{{ $video }}" muted loop preload="metadata"
                                                       onmouseover="this.play()"
                                                       onmouseout="this.pause(); this.currentTime=0;"
                                                       ></video>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <h2 class="inf-title title6 fw_semibold project-title">
                                {{ $project->title }}
                            </h2>
                            <p class="projec-details-pera fw_medium">
                                {!! $project->description !!}
                            </p>
                            <div id="compare-package-wraper" class="compare-package-wraper mb-40 mt-4">
                                <h4 class="inf-title title7 fw_semibold deep_black_text">{{ __('Compare Packages') }}</h4>
                                <div class="compare-package-inner">
                                    <div class="table-responsive">
                                        <table class="compare-package-table w-100">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">{{ __('Packages') }}</th>
                                                    <th class="text-center">{{ __('Basic') }}</th>
                                                    @if (!empty($project->standard_title))
                                                        <th class="text-center">{{ __('Standard') }}</th>
                                                    @endif
                                                    @if (!empty($project->premium_title))
                                                        <th class="text-center">{{ __('Premium') }}</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($project->project_attributes as $attr)
                                                    <tr>
                                                        <td class="text-center">
                                                            {{ $attr->check_numeric_title }}
                                                        </td>
                                                        @foreach (['basic', 'standard', 'premium'] as $type)
                                                            @php
                                                                $value = $attr->{"{$type}_check_numeric"};
                                                            @endphp
                                                            <td class="text-center">
                                                                {!! in_array($value, ['on', true], true)
                                                                    ? '<span class="icon check"><i class="fas fa-check"></i></span>'
                                                                    : (in_array($value, ['off', false], true)
                                                                        ? '<span class="icon check"><i class="fas fa-times"></i></span>'
                                                                        : '<span>' . $value . '</span>') !!}
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td class="text-center">{{ __('Revisions') }}</td>
                                                    @foreach (['basic', 'standard', 'premium'] as $type)
                                                        <td class="text-center">
                                                            <span
                                                                class="deep_black_text">{{ $project->{"{$type}_revision"} }}</span>
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    <td class="text-center">{{ __('Delivery Time') }}</td>
                                                    @foreach (['basic', 'standard', 'premium'] as $type)
                                                        <td class="text-center">
                                                            <span class="clock-icon">
                                                                <i class="fa-regular fa-clock"></i>
                                                                {{ $project->{"{$type}_delivery"} }}
                                                            </span>
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                <tr class="total">
                                                    <td class="text-center"><span
                                                            class="deep_black_text md-font fw_semibold">{{ __('Total') }}</span>
                                                    </td>
                                                    @foreach (['basic', 'standard', 'premium'] as $type)
                                                        <td class="text-center">
                                                            <div
                                                                class="deep_black_text md-font fw_bold mb-3 regular_charge">
                                                                @if($project->{"{$type}_discount_charge"})
                                                                    {{ float_amount_with_currency_symbol($project->{"{$type}_discount_charge"}) }}
                                                                    <s style="color: #564848;">{{ float_amount_with_currency_symbol($project->{"{$type}_regular_charge"}) }}</s>
                                                                @else
                                                                    {{ float_amount_with_currency_symbol($project->{"{$type}_regular_charge"}) }}
                                                                @endif
                                                            </div>
                                                            @if (Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 1)
                                                                @if(moduleExists('SecurityManage'))
                                                                    <div class="order-btn-wraper">
                                                                        <a href="#/" data-project_id="{{ $project->id }}"
                                                                            data-bs-toggle="modal"
                                                                            data-price="
                                                                            {{ float_amount_with_currency_symbol($project->{"{$type}_regular_charge"}) }}"
                                                                            data-bs-target="#paymentGatewayModal"
                                                                            class="inf-cmn-btn style3 inf-black-btn-outline choose_basic_standard_premium_shake basic_standard_premium @if(Auth::guard('web')->user()->freeze_order_create == 'freeze') disabled-link @endif">
                                                                            {{ __('Select') }}
                                                                        </a>
                                                                    </div>
                                                                @else
                                                                    <div class="order-btn-wraper">
                                                                        <a href="#/" data-project_id="{{ $project->id }}"
                                                                            data-bs-toggle="modal"
                                                                            data-price="
                                                                            {{ float_amount_with_currency_symbol($project->{"{$type}_regular_charge"}) }}"
                                                                            data-bs-target="#paymentGatewayModal"
                                                                            class="inf-cmn-btn style3 inf-black-btn-outline choose_basic_standard_premium_shake basic_standard_premium">{{ __('Select') }}</a>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="project-review-wraper">
                                <h4 class="inf-title title7 fw_semibold deep_black_text">{{ __('Reviews') }}</h4>
                                <div class="full-rating-wraper box-card">
                                    {!! project_details_rating($project->id) !!}
                                </div>
                            </div>
                            <div class="client-review-wraper">
                                <div class="top-part">
                                    <div class="inf-title title7 fw_semibold deep_black_text">
                                        {{ __('Client Feedback') }}
                                    </div>
                                    <div class="review-shorting">
                                        <label for="review-shorting">{{ __('Sort By') }}:</label>
                                        <select name="review-shorting" id="project-review-sorting" class="review-shoring"
                                            data-url="{{ route('shake.reviews', ['id' => $project->id]) }}">
                                            <option value="1">{{ __('Most Recent') }}</option>
                                            <option value="2">{{ __('Past Week') }}</option>
                                            <option value="3">{{ __('Oldest First') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="client-review-inner" id="project-review-list">
                                    @forelse ($ratings as $rating)
                                        @include('frontend.pages.shake-details.partials.review-card', [
                                            'rating' => $rating,
                                        ])
                                    @empty
                                        <p>{{ __('No reviews yet.') }}</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="packagees-wraper-card d-xl-block sticky-top">
                            <div class="nav custom-nav">
                                <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#basic-package"
                                    href="#/">{{ __('Basic') }}</a>
                                @if (!empty($project->standard_title))
                                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#standerd-package"
                                        href="#/">{{ __('Standerd') }}</a>
                                @endif
                                @if (!empty($project->premium_title))
                                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#premium-package"
                                        href="#/">{{ __('Premium') }}</a>
                                @endif
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="basic-package">
                                    <div class="package-entites">
                                        <div class="revision sm-font fw_medium">
                                            <sapn class="icon">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13.6667 3.66797H6.33333C3.85781 3.66797 2 5.45799 2 8.0013"
                                                        stroke="#767474" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M2.33203 12.3333H9.66536C12.1409 12.3333 13.9987 10.5433 13.9987 8"
                                                        stroke="#767474" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M12.332 2C12.332 2 13.9987 3.22748 13.9987 3.66668C13.9987 4.10588 12.332 5.33333 12.332 5.33333"
                                                        stroke="#767474" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M3.66665 10.668C3.66665 10.668 2.00001 11.8954 2 12.3346C1.99999 12.7738 3.66667 14.0013 3.66667 14.0013"
                                                        stroke="#767474" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </sapn>
                                            <span>{{ __('Revisions') }}</span>
                                            <span class="revesion-count deep_black_text">
                                                {{ $project->basic_revision }}
                                            </span>
                                        </div>
                                        <div class="delivery sm-font fw_medium">
                                            <sapn class="icon">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M7.9987 14.6654C11.6806 14.6654 14.6654 11.6806 14.6654 7.9987C14.6654 4.3168 11.6806 1.33203 7.9987 1.33203C4.3168 1.33203 1.33203 4.3168 1.33203 7.9987C1.33203 11.6806 4.3168 14.6654 7.9987 14.6654Z"
                                                        stroke="#767474" stroke-width="1.5" />
                                                    <path d="M8 5.33203V7.9987L9.33333 9.33203" stroke="#767474"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </sapn>
                                            <span>{{ __('Dalivery Time') }}</span>
                                            <span class="revesion-count deep_black_text">
                                                {{ $project->basic_delivery }}
                                            </span>
                                        </div>
                                    </div>
                                    <ul class="service-list">
                                        @foreach ($project->project_attributes as $attr)
                                            <li>
                                                <span>{{ $attr->check_numeric_title }}</span>
                                                @php $value = $attr->basic_check_numeric; @endphp
                                                {!! in_array($value, ['on', true], true)
                                                    ? '<span class="available-icon check"><i class="fas fa-check"></i></span>'
                                                    : (in_array($value, ['off', false], true)
                                                        ? '<span class="available-icon check"><i class="fas fa-times"></i></span>'
                                                        : '<span>' . $value . '</span>') !!}
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="package-price">
                                        <span>{{ __('Price') }}</span>
                                        <span class="price regular_charge">
{{--                                            {{ float_amount_with_currency_symbol($project->basic_regular_charge) }}--}}
                                            @if ($project->basic_discount_charge)
                                                {{ amount_with_currency_symbol($project->basic_discount_charge) }}
                                                <s style="color: #564848;">{{ amount_with_currency_symbol($project->basic_regular_charge) }}</s>
                                            @else
                                                {{ amount_with_currency_symbol($project->basic_regular_charge) }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="standerd-package">
                                    <div class="package-entites">
                                        <div class="revision sm-font fw_medium">
                                            <sapn class="icon">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13.6667 3.66797H6.33333C3.85781 3.66797 2 5.45799 2 8.0013"
                                                        stroke="#767474" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M2.33203 12.3333H9.66536C12.1409 12.3333 13.9987 10.5433 13.9987 8"
                                                        stroke="#767474" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M12.332 2C12.332 2 13.9987 3.22748 13.9987 3.66668C13.9987 4.10588 12.332 5.33333 12.332 5.33333"
                                                        stroke="#767474" sstandard-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M3.66665 10.668C3.66665 10.668 2.00001 11.8954 2 12.3346C1.99999 12.7738 3.66667 14.0013 3.66667 14.0013"
                                                        stroke="#767474" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </sapn>
                                            <span>{{ __('Revisions') }}</span>
                                            <span class="revesion-count deep_black_text">
                                                {{ $project->standard_revision }}
                                            </span>
                                        </div>
                                        <div class="delivery sm-font fw_medium">
                                            <sapn class="icon">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M7.9987 14.6654C11.6806 14.6654 14.6654 11.6806 14.6654 7.9987C14.6654 4.3168 11.6806 1.33203 7.9987 1.33203C4.3168 1.33203 1.33203 4.3168 1.33203 7.9987C1.33203 11.6806 4.3168 14.6654 7.9987 14.6654Z"
                                                        stroke="#767474" stroke-width="1.5" />
                                                    <path d="M8 5.33203V7.9987L9.33333 9.33203" stroke="#767474"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </sapn>
                                            <span>{{ __('Dalivery Time') }}</span>
                                            <span class="revesion-count deep_black_text">
                                                {{ $project->standard_delivery }}
                                            </span>
                                        </div>
                                    </div>
                                    <ul class="service-list">
                                        @foreach ($project->project_attributes as $attr)
                                            <li>
                                                <span>{{ $attr->check_numeric_title }}</span>
                                                @php $value = $attr->standard_check_numeric; @endphp
                                                {!! in_array($value, ['on', true], true)
                                                    ? '<span class="available-icon check"><i class="fas fa-check"></i></span>'
                                                    : (in_array($value, ['off', false], true)
                                                        ? '<span class="available-icon check"><i class="fas fa-times"></i></span>'
                                                        : '<span>' . $value . '</span>') !!}
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="package-price">
                                        <span>{{ __('Price') }}</span>
                                        <span class="price regular_charge">
                                            @if ($project->standard_discount_charge)
                                                {{ amount_with_currency_symbol($project->standard_discount_charge) }}
                                                <s style="color: #564848;">{{ amount_with_currency_symbol($project->standard_regular_charge) }}</s>
                                            @else
                                                {{ amount_with_currency_symbol($project->standard_regular_charge) }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="premium-package">
                                    <div class="package-entites">
                                        <div class="revision sm-font fw_medium">
                                            <sapn class="icon">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13.6667 3.66797H6.33333C3.85781 3.66797 2 5.45799 2 8.0013"
                                                        stroke="#767474" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M2.33203 12.3333H9.66536C12.1409 12.3333 13.9987 10.5433 13.9987 8"
                                                        stroke="#767474" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M12.332 2C12.332 2 13.9987 3.22748 13.9987 3.66668C13.9987 4.10588 12.332 5.33333 12.332 5.33333"
                                                        stroke="#767474" sstandard-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M3.66665 10.668C3.66665 10.668 2.00001 11.8954 2 12.3346C1.99999 12.7738 3.66667 14.0013 3.66667 14.0013"
                                                        stroke="#767474" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </sapn>
                                            <span>{{ __('Revisions') }}</span>
                                            <span class="revesion-count deep_black_text">
                                                {{ $project->premium_revision }}
                                            </span>
                                        </div>
                                        <div class="delivery sm-font fw_medium">
                                            <sapn class="icon">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M7.9987 14.6654C11.6806 14.6654 14.6654 11.6806 14.6654 7.9987C14.6654 4.3168 11.6806 1.33203 7.9987 1.33203C4.3168 1.33203 1.33203 4.3168 1.33203 7.9987C1.33203 11.6806 4.3168 14.6654 7.9987 14.6654Z"
                                                        stroke="#767474" stroke-width="1.5" />
                                                    <path d="M8 5.33203V7.9987L9.33333 9.33203" stroke="#767474"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </sapn>
                                            <span>{{ __('Dalivery Time') }}</span>
                                            <span class="revesion-count deep_black_text">
                                                {{ $project->premium_delivery }}
                                            </span>
                                        </div>
                                    </div>
                                    <ul class="service-list">
                                        @foreach ($project->project_attributes as $attr)
                                            <li>
                                                <span>{{ $attr->check_numeric_title }}</span>
                                                @php $value = $attr->premium_check_numeric; @endphp
                                                {!! in_array($value, ['on', true], true)
                                                    ? '<span class="available-icon check"><i class="fas fa-check"></i></span>'
                                                    : (in_array($value, ['off', false], true)
                                                        ? '<span class="available-icon check"><i class="fas fa-times"></i></span>'
                                                        : '<span>' . $value . '</span>') !!}
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="package-price">
                                        <span>{{ __('Price') }}</span>
                                        <span class="price regular_charge">
                                            @if ($project->premium_discount_charge)
                                                {{ amount_with_currency_symbol($project->premium_discount_charge) }}
                                                <s style="color: #564848;">{{ amount_with_currency_symbol($project->premium_regular_charge) }}</s>
                                            @else
                                                {{ amount_with_currency_symbol($project->premium_regular_charge) }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="package-btn-wraper">
                                    @if (Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 1)
                                        @if(moduleExists('SecurityManage'))
                                            <button
                                                class="inf-cmn-btn style2 inf-primary-btn basic_standard_premium choose_basic_standard_premium_shake
                                                @if(Auth::guard('web')->user()->freeze_order_create == 'freeze') disabled-link @endif"
                                                data-price="{{ float_amount_with_currency_symbol($project->basic_regular_charge) }}"
                                                data-project_id="{{ $project->id }}" data-bs-toggle="modal"
                                                data-bs-target="#paymentGatewayModal">{{ __('Continue to Order') }}
                                            </button>
                                        @else
                                            <button
                                                class="inf-cmn-btn style2 inf-primary-btn basic_standard_premium choose_basic_standard_premium_shake"
                                                data-price="{{ float_amount_with_currency_symbol($project->basic_regular_charge) }}"
                                                data-project_id="{{ $project->id }}" data-bs-toggle="modal"
                                                data-bs-target="#paymentGatewayModal">{{ __('Continue to Order') }}
                                            </button>
                                        @endif
                                        <form action="{{ route('client.message.send') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="freelancer_id" id="freelancer_id"
                                                value="{{ $project->user_id }}">
                                            <input type="hidden" name="from_user" id="from_user" value="1">
                                            <input type="hidden" name="project_id" id="project_id"
                                                value="{{ $project->id }}">
                                            <button type="submit" class="inf-cmn-btn style2 inf-black-btn-outline w-100">
                                                {{ __('Chat with Me') }}</button>
                                        </form>
                                    @elseif (!Auth::guard('web')->check())
                                        <button class="inf-cmn-btn style2 inf-primary-btn" data-bs-toggle="modal"
                                            data-bs-target="#loginModal">{{ __('Login to Order') }}
                                        </button>
                                        <button class="inf-cmn-btn style2 inf-black-btn-outline" data-bs-toggle="modal"
                                            data-bs-target="#ChatLoginModal">{{ __('Chat with Me') }}
                                        </button>
                                    @endif
                                    @if (!empty($project->standard_title) && !empty($project->premium_title))
                                        <div class="btn-wrapper text-left mt-4">
                                            <a href="#compare-package-wraper" class="compareBtn scroll-to-section">
                                                {{ __('Compare Package') }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Shake Details area end -->
    </main>
    @include('frontend.pages.order.login-markup')
    @include('frontend.pages.order.login-modal')
    @include('frontend.pages.order.gateway-markup')
@endsection

@section('script')
    <x-frontend.payment-gateway.gateway-select-js />
    @include('frontend.pages.project-details.load-more-js')
    @include('frontend.pages.order.order-js')
    <script>
        $(document).ready(function(){
            $('.main-image-wraper').on('afterChange', function(event, slick, currentSlide){
                // pause all videos first
                $(this).find('video').each(function(){
                    this.pause();
                    this.currentTime = 0;
                });

                // play the video in the current slide
                let current = $(this).find('.slick-slide[data-slick-index="' + currentSlide + '"] video').get(0);
                if(current) {
                    current.play();
                }
            });
        });
    </script>

@endsection
