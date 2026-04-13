@extends('frontend.layout.master')
@section('site_title')
    {{ __('Offer Details') }}
@endsection
@section('style')
    <x-summernote.summernote-css />
    <style>
        .user-details-manage-list {
            display: flex;
            flex-direction: column;
            gap: 10px
        }

        .myOrder-single-content-para,
        .myJob-wrapper-single-para {
            white-space: pre-line
        }

        .show_order_submit_description {
            white-space: pre-line
        }
    </style>
@endsection
@section('content')
    <main>

        <x-breadcrumb.user-profile-breadcrumb :title="__('Offer Details')" :innerTitle="__('Offer Details')" />

        <!-- Profile Details area Starts -->
        <div class="profile-area pat-100 pab-100 section-bg-2">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="myOrder-single bg-white radius-10">
                            <div class="top-part">
                                <div class="myOrder-single-item">
                                    <div class="myOrder-single-flex">
                                        <div class="myOrder-single-content">
                                            <div class="d-flex gap-2 justify-content-between">
                                                <span class="myOrder-single-content-id">#000{{ $offer_details->id }}</span>
                                                <span class="myOrder-single-content-time inf-tag"><i
                                                        class="fa-regular fa-clock"></i>
                                                    {{ $offer_details->created_at->diffForHumans() }} </span>
                                            </div>

                                            @php
                                                $offer_order = \App\Models\Order::where('identity', $offer_details->id)
                                                    ->where('is_project_job', 'offer')
                                                    ->where('payment_status', 'complete')
                                                    ->first();
                                            @endphp
                                            <div class="myOrder-single-content-btn flex-btn mt-3">
                                                @if ($offer_order)
                                                    <span class="job-progress">{{ __('Accepted') }}</span>
                                                @else
                                                    <span class="pending-approval">{{ __('Pending') }}</span>
                                                @endif
                                                <span class="custom-order">{{ __('Custom Offer') }}</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="myOrder-single-item">
                                    <div class="myOrder-single-block">
                                        <div class="myOrder-single-block-item">
                                            <div class="myOrder-single-block-item-content">
                                                <span class="myOrder-single-block-subtitle">{{ __('Offer Price') }}</span>
                                                <h6 class="myOrder_single__block__title mt-2">
                                                    {{ float_amount_with_currency_symbol($offer_details->price) }}
                                                </h6>
                                            </div>
                                        </div>
                                        @if ($offer_details->deadline)
                                            <div class="myOrder-single-block-item">
                                                <div class="myOrder-single-block-item-content">
                                                    <span
                                                        class="myOrder-single-block-subtitle">{{ __('Delivery Time') }}</span><br>
                                                    <h6 class="myOrder_single__block__title mt-2">
                                                        {{ $offer_details->deadline ?? '' }}
                                                    </h6>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="myOrder-single-block-item">
                                            <div class="myOrder-single-block-item-content">
                                                <span
                                                    class="myOrder-single-block-subtitle">{{ __('Create Date') }}</span><br>
                                                <h6 class="myOrder_single__block__title mt-2">
                                                    {{ $offer_details->created_at->toFormattedDateString() ?? '' }}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom-part">
                                <div class="myOrder-single-item">
                                    <div class="myOrder-single-flex flex-between">
                                        @php
                                            $mile_stones = \Modules\Chat\Entities\OfferMilestone::where(
                                                'offer_id',
                                                $offer_details->id,
                                            )->get();
                                        @endphp
                                        <div class="btn-wrapper flex-btn">
                                            @if ($mile_stones->isEmpty())
                                                <span class="myJob-wrapper-single-fixed danger">{{ __('Revision:') }}
                                                    {{ $offer_details->revision }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="myOrder-single bg-white padding-20 radius-10 mt-5">
                            <div class="myJob-tabs">
                                @if ($mile_stones->count() > 0)
                                    <div class="tab-content-item active">
                                        <div class="myJob-wrapper-single">
                                            <div class="myJob-wrapper-single-header profile-border-bottom">
                                                <h4 class="myJob-wrapper-single-title">{{ __('Milestone') }}</h4>
                                            </div>
                                            <div class="myJob-wrapper-single-milestone milestone-contractor-parent">
                                                @foreach ($mile_stones as $mile_stone)
                                                    <div class="myJob-wrapper-single-milestone-item">
                                                        <div
                                                            class="myJob-wrapper-single-flex flex-between align-items-start">
                                                            <x-offer.milestone-details :id="$mile_stone->id" :title="$mile_stone->title"
                                                                :price="$mile_stone->price" :deadline="$mile_stone->deadline" :description="$mile_stone->description" />
                                                            <div class="myJob-wrapper-single-right">
                                                                <div class="myJob-wrapper-single-right-flex">
                                                                    <span
                                                                        class="myJob-wrapper-single-fixed danger">{{ __('Revision:') }}
                                                                        {{ $mile_stone->revision ?? '' }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="myJob-wrapper-single padding-0">
                                        <div class="myJob-wrapper-single-header profile-border-bottom">
                                            <h4 class="myJob-wrapper-single-title">{{ __('Description') }}</h4>
                                        </div>
                                        <p class="myOrder-single-content-para">{!! $offer_details->description !!}</p>
                                    </div>
                                @endif
                            </div>

                            <div class="myOrder-single-item mt-4">
                                <div class="myOrder-single-flex flex-between">
                                    @if ($offer_order)
                                        <a href="javascript:void(0)" class="btn-profile btn-bg-1">{{ __('Accepted') }}</a>
                                    @else
                                        <a href="javascript:void(0)" class="btn-profile btn-bg-1 accept_custom_offer"
                                            data-offer-id-for-order="{{ $offer_details->id }}" data-bs-toggle="modal"
                                            data-bs-target="#paymentGatewayModal">{{ __('Accept Offer') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="profile-details-widget sticky_top_lg">
                            <div class="jobFilter-wrapper-item">
                                <div class="myJob-wrapper-single-contents">
                                    <div class="influencer-info-wraper">
                                        <div class="project-owner influencer-info">
                                            <div class="left-part">
                                                <div class="inf-img">
                                                    @if ($offer_details->freelancer?->image)
                                                        <img src="{{ asset('assets/uploads/profile/' . $offer_details->freelancer?->image) }}"
                                                            alt="{{ __('profile img') }}">
                                                    @else
                                                        <img src="{{ asset('assets/static/img/author/author.jpg') }}"
                                                            alt="{{ __('profile img') }}">
                                                    @endif
                                                    <x-status.user-online-offline-check :userID="$offer_details->freelancer?->id" />
                                                </div>
                                            </div>
                                            <div class="right-part">
                                                <div class="right-top d-flex gap-4">
                                                    <div class="name lg-font fw_semibold black_text">
                                                        {{ $offer_details->freelancer?->full_name }}
                                                        @if ($offer_details?->freelancer->user_verified_status == 1)
                                                            <span data-toggle="tooltip" data-placement="top"
                                                                title="{{ __('User Verified') }}">
                                                                <i class="si si-varified green_text"></i>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="location-wraper ">
                                                    <span class="icon primary_text">
                                                        <i class="si si-location"></i>
                                                    </span>
                                                    <span class="location sm-font">
                                                        @if ($offer_details->freelancer?->user_state?->state != null)
                                                            {{ optional($offer_details->freelancer?->user_state)->state }},
                                                        @endif
                                                        {{ optional($offer_details->freelancer?->user_country)->country }}
                                                    </span>
                                                </div>
                                                <div class="right-bottom">
                                                    <div class="raitng-wraper fw_semibold">
                                                        {!! freelancer_rating($offer_details->freelancer?->id) !!}
                                                    </div>
                                                    @php
                                                        $social_profiles = \App\Models\SocialProfile::where(
                                                            'user_id',
                                                            $offer_details->freelancer?->id,
                                                        )->get();
                                                        $total_followers = $social_profiles->reduce(function (
                                                            $carry,
                                                            $profile,
                                                        ) {
                                                            return $carry + parseFollowers($profile->followers);
                                                        }, 0);
                                                    @endphp
                                                    <div class="social-icon-wraper">
                                                        @foreach ($social_profiles as $profile)
                                                            <div class="social-icon">
                                                                <a href="{{ $profile->profile_link }}">
                                                                    <i class="{{ $profile->platform_icon }}"></i>
                                                                </a>
                                                                <span>{{ $profile->followers }}</span>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Profile Details area end -->
        @include('frontend.user.client.job.modal.payment-gateway-modal')
    </main>

@endsection

@section('script')
    <x-frontend.payment-gateway.gateway-select-js />
    <x-sweet-alert.sweet-alert2-js />
    <x-summernote.summernote-js />
    @include('chat::client.offer.offer-js')
@endsection
