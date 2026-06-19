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
                                            <div class="myOrder-single-content-btn flex-btn mt-3">
                                                @php
                                                    $offer_order = \App\Models\Order::where(
                                                        'identity',
                                                        $offer_details->id,
                                                    )
                                                        ->where('is_project_job', 'offer')
                                                        ->where('payment_status', 'complete')
                                                        ->first();
                                                @endphp
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
                                                        class="myOrder-single-block-subtitle">{{ __('Delivery Time') }}</span>
                                                    <br>
                                                    <h6 class="myOrder_single__block__title mt-2">
                                                        {{ $offer_details->deadline ?? '' }}</h6>
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
                            @if ($mile_stones->count() > 0)
                                <div class="tab-content-item active mt-5">
                                    <div class="myJob-wrapper-single">
                                        <div class="myJob-wrapper-single-header profile-border-bottom">
                                            <h4 class="myJob-wrapper-single-title">{{ __('Milestone') }}</h4>
                                        </div>
                                        <div class="myJob-wrapper-single-milestone milestone-contractor-parent">
                                            @foreach ($mile_stones as $mile_stone)
                                                <div class="myJob-wrapper-single-milestone-item">
                                                    <div class="myJob-wrapper-single-flex flex-between align-items-start">
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
                                <div class="myJob-wrapper-single">
                                    <div class="myJob-wrapper-single-header profile-border-bottom">
                                        <h4 class="myJob-wrapper-single-title">{{ __('Description') }}</h4>
                                    </div>
                                    <p class="myOrder-single-content-para">{!! $offer_details->description !!}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="profile-details-widget sticky_top_lg">
                            <div class="dashboard-card influencer-info-wraper">
                                <div class="project-owner influencer-info">
                                    <div class="left-part">
                                        <div class="inf-img">
                                            <x-order.profile-image :image="$offer_details?->client->image" />
                                            <span class="status-icon online"></span>
                                            <x-status.user-online-offline-check :userID="$offer_details?->client->id" />
                                        </div>
                                    </div>
                                    <div class="right-part">
                                        <div class="right-top d-flex gap-4">
                                            <div class="name lg-font fw_semibold black_text">
                                                {{ $offer_details?->client->first_name }}
                                                {{ $offer_details?->client->last_name }}
                                                @if ($offer_details?->client->user_verified_status == 1)
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
                                                @if ($offer_details?->client?->user_state?->state != null)
                                                    {{ $offer_details?->client?->user_state?->state }},
                                                @endif
                                            </span>
                                        </div>
                                        <div class="right-bottom">
                                            <div class="account-insight member-wraper">
                                                <span class="icon">
                                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M1.16797 6.99967C1.16797 4.79978 1.16797 3.69985 1.85138 3.01642C2.53481 2.33301 3.63475 2.33301 5.83464 2.33301H8.16797C10.3678 2.33301 11.4678 2.33301 12.1512 3.01642C12.8346 3.69985 12.8346 4.79978 12.8346 6.99967C12.8346 9.19954 12.8346 10.2995 12.1512 10.9829C11.4678 11.6663 10.3678 11.6663 8.16797 11.6663H5.83464C3.63475 11.6663 2.53481 11.6663 1.85138 10.9829C1.16797 10.2995 1.16797 9.19954 1.16797 6.99967Z"
                                                            stroke="#FF5B6B" stroke-width="0.875" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M6.41536 5.83366C6.41536 5.18933 5.89305 4.66699 5.2487 4.66699C4.60437 4.66699 4.08203 5.18933 4.08203 5.83366C4.08203 6.47801 4.60437 7.00033 5.2487 7.00033C5.89305 7.00033 6.41536 6.47801 6.41536 5.83366Z"
                                                            stroke="#FF5B6B" stroke-width="0.875" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M7.58464 9.33333C7.58464 8.04469 6.53994 7 5.2513 7C3.96264 7 2.91797 8.04469 2.91797 9.33333"
                                                            stroke="#FF5B6B" stroke-width="0.875" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M8.75 5.25H11.0833" stroke="#FF5B6B" stroke-width="0.875"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M8.75 7H11.0833" stroke="#FF5B6B" stroke-width="0.875"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                                <span>{{ __('Member since') }}</span>
                                                <span>{{ $offer_details?->client->created_at->toFormattedDateString() ?? '' }}</span>
                                            </div>
                                            <div class="account-insight hire-rate">
                                                <span class="icon">
                                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M1.78856 8.86308L2.00162 7.65477C2.25343 6.22659 2.37934 5.51255 2.87794 5.08977C3.37654 4.66699 4.09277 4.66699 5.52522 4.66699H8.48001C9.91245 4.66699 10.6287 4.66699 11.1273 5.08977C11.6259 5.51255 11.7518 6.22659 12.0036 7.65477L12.2167 8.86308C12.5651 10.8393 12.7393 11.8274 12.2028 12.4764C11.6664 13.1253 10.6752 13.1253 8.69305 13.1253H5.31216C3.32997 13.1253 2.33888 13.1253 1.80238 12.4764C1.26588 11.8274 1.44011 10.8393 1.78856 8.86308Z"
                                                            stroke="#FF5B6B" stroke-width="0.875" />
                                                        <path
                                                            d="M4.375 4.66699L4.47289 3.49226C4.58242 2.17794 5.68112 1.16699 7 1.16699C8.31886 1.16699 9.41757 2.17794 9.52712 3.49226L9.625 4.66699"
                                                            stroke="#FF5B6B" stroke-width="0.875" />
                                                        <path
                                                            d="M8.75 6.41699C8.67417 7.2413 7.91332 7.87533 7 7.87533C6.08667 7.87533 5.32584 7.2413 5.25 6.41699"
                                                            stroke="#FF5B6B" stroke-width="0.875"
                                                            stroke-linecap="round" />
                                                    </svg>
                                                </span>
                                                <span>{{ __('Total Campaign') }}</span>
                                                <span>{{ $offer_details?->client?->user_jobs?->count() }}</span>
                                            </div>
                                            @php
                                                $total_job = App\Models\JobPost::where(
                                                    'user_id',
                                                    $offer_details?->client->id,
                                                )->count();
                                                $total_order = App\Models\Order::where(
                                                    'user_id',
                                                    $offer_details?->client->id,
                                                )
                                                    ->where('status', 3)
                                                    ->count();

                                                $hiring_rate = '';
                                                if ($total_job > 0) {
                                                    $hiring_rate = ($total_order * 100) / $total_job;
                                                }
                                            @endphp

                                            @if ($hiring_rate >= 1)
                                                <div class="account-insight total-job">
                                                    <span class="icon">
                                                        <svg width="14" height="14" viewBox="0 0 14 14"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M4.48813 11.4431C4.8329 11.4431 5.00528 11.4431 5.16233 11.5013C5.18414 11.5094 5.20564 11.5183 5.22678 11.528C5.37903 11.5979 5.50093 11.7197 5.74471 11.9635C6.30585 12.5246 6.58638 12.8052 6.93159 12.831C6.97797 12.8345 7.02464 12.8345 7.07101 12.831C7.41623 12.8052 7.69681 12.5246 8.25786 11.9635C8.50169 11.7197 8.62355 11.5979 8.7758 11.528C8.79698 11.5183 8.81844 11.5094 8.84026 11.5013C8.99735 11.4431 9.16973 11.4431 9.51448 11.4431H9.57806C10.4577 11.4431 10.8975 11.4431 11.1707 11.1698C11.444 10.8965 11.444 10.4567 11.444 9.57708V9.5135C11.444 9.16875 11.444 8.99638 11.5023 8.83928C11.5104 8.81747 11.5193 8.796 11.529 8.77483C11.5988 8.62258 11.7207 8.50072 11.9645 8.25688C12.5256 7.69583 12.8062 7.41525 12.832 7.07003C12.8355 7.02366 12.8355 6.97699 12.832 6.93062C12.8062 6.5854 12.5256 6.30488 11.9645 5.74374C11.7207 5.49995 11.5988 5.37806 11.529 5.22581C11.5193 5.20466 11.5104 5.18316 11.5023 5.16135C11.444 5.00431 11.444 4.83192 11.444 4.48716V4.42356C11.444 3.54395 11.444 3.10414 11.1707 2.83089C10.8975 2.55762 10.4577 2.55762 9.57806 2.55762H9.51448C9.16973 2.55762 8.99735 2.55762 8.84026 2.49935C8.81844 2.49126 8.79698 2.48236 8.7758 2.47266C8.62355 2.40281 8.50169 2.28092 8.25786 2.03713C7.69681 1.47602 7.41623 1.19547 7.07101 1.1696C7.02464 1.16612 6.97797 1.16612 6.93159 1.1696C6.58638 1.19547 6.30585 1.47602 5.74471 2.03713C5.50093 2.28092 5.37903 2.40281 5.22678 2.47266C5.20564 2.48236 5.18414 2.49126 5.16233 2.49935C5.00528 2.55762 4.8329 2.55762 4.48813 2.55762H4.42454C3.54493 2.55762 3.10512 2.55762 2.83186 2.83089C2.5586 3.10414 2.5586 3.54395 2.5586 4.42356V4.48716C2.5586 4.83192 2.5586 5.00431 2.50033 5.16135C2.49224 5.18316 2.48333 5.20466 2.47363 5.22581C2.40379 5.37806 2.2819 5.49995 2.03811 5.74374C1.477 6.30488 1.19645 6.5854 1.17058 6.93062C1.1671 6.97699 1.1671 7.02366 1.17058 7.07003C1.19645 7.41525 1.477 7.69583 2.03811 8.25688C2.2819 8.50072 2.40379 8.62258 2.47363 8.77483C2.48333 8.796 2.49224 8.81747 2.50033 8.83928C2.5586 8.99638 2.5586 9.16875 2.5586 9.5135V9.57708C2.5586 10.4567 2.5586 10.8965 2.83186 11.1698C3.10512 11.4431 3.54493 11.4431 4.42454 11.4431H4.48813Z"
                                                                stroke="#FF5B6B" stroke-width="0.875" />
                                                            <path d="M8.75 5.25L5.25 8.75" stroke="#FF5B6B"
                                                                stroke-width="0.875" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path d="M8.75 8.75H8.7437M5.25628 5.25H5.25" stroke="#FF5B6B"
                                                                stroke-width="1.16667" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </span>
                                                    <span>{{ __('Hire rate') }}</span>
                                                    <span>
                                                        @if ($hiring_rate > 100)
                                                            100%
                                                        @else
                                                            {{ round($hiring_rate) ?? 0 }}%
                                                        @endif
                                                    </span>
                                                </div>
                                            @endif
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
    </main>

@endsection

@section('script')
    <x-sweet-alert.sweet-alert2-js />
    @include('chat::influencer.offer.offer-js')
@endsection
