@extends('frontend.layout.master')
@section('site_title', __('Order Details'))
@section('style')
    <x-summernote.summernote-css />
    <style>
        .user-details-manage-list {
            display: flex;
            flex-direction: column;
            gap: 10px
        }

        .myOrder-single-content-para,
        .show_order_submit_description {
            white-space: pre-line
        }
    </style>
@endsection
@section('content')
    <main>
        <x-breadcrumb.user-profile-breadcrumb :title="__('Order Details')" :innerTitle="__('Order Details')" />

        <!-- Profile Details area Starts -->
        <div class="profile-area pat-100 pab-100">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="myOrder-single bg-white radius-10">
                            <div class="top-part">
                                <div class="myOrder-single-item">
                                    <x-validation.error />
                                    <div class="myOrder-single-flex">
                                        <div class="myOrder-single-content">
                                            <div class="d-flex gap-2 justify-content-between">
                                                <span class="myOrder-single-content-id">#000{{ $order_details->id }}</span>
                                                <span class="myOrder-single-content-time inf-tag"><i
                                                        class="fa-regular fa-clock"></i>{{ $order_details->created_at->diffForHumans() }}
                                                </span>
                                            </div>

                                            <h4 class="myOrder-single-content-title mt-2">
                                                @if ($order_details->is_project_job == 'project')
                                                    <a href="javascript:void(0)">
                                                        {{ $order_details?->project->title ?? '' }}
                                                    </a>
                                                @elseif($order_details->is_project_job == 'job')
                                                    <a href="javascript:void(0)">{{ $order_details?->job->title ?? '' }}</a>
                                                @else
                                                    {{ __('Custom order') }}
                                                @endif
                                            </h4>
                                            <div class="myOrder-single-content-btn flex-btn mt-3">
                                                <x-order.order-status :status="$order_details->status" />
                                                <x-order.is-custom :isCustom="$order_details->is_project_job" />
                                                <x-order.payment-verify :paymentVerifyCheck="$order_details" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="myOrder-single-item">
                                    <div class="myOrder-single-block">
                                        <div class="myOrder-single-block-item">
                                            <div class="myOrder-single-block-item-content">
                                                @if ($order_details->is_fixed_hourly == 'hourly')
                                                    <span
                                                        class="myOrder-single-block-subtitle">{{ __('Hourly Rate') }}</span>
                                                    <h6 class="myOrder-single-block-title mt-2">
                                                        {{ float_amount_with_currency_symbol($order_details?->job->hourly_rate) }}
                                                    </h6>
                                                @else
                                                    <span
                                                        class="myOrder-single-block-subtitle">{{ __('Order Budget') }}</span>
                                                    <h6 class="myOrder-single-block-title align-items-center mt-2">
                                                        {{ float_amount_with_currency_symbol($order_details->price) }}
                                                        <x-order.is-funded :isFunded="$order_details->payment_status" :paymentGateway="$order_details->payment_gateway" />
                                                    </h6>
                                                @endif
                                            </div>
                                        </div>
                                        @if ($order_details->delivery_time)
                                            <div class="myOrder-single-block-item">
                                                <div class="myOrder-single-block-item-content">
                                                    <span
                                                        class="myOrder-single-block-subtitle">{{ __('Delivery Time') }}</span>
                                                    <x-order.deadline :deadline="$order_details->delivery_time ?? ''" />
                                                </div>
                                            </div>
                                        @endif

                                        @php
                                            $complete_orders = \App\Models\Order::where(
                                                'user_id',
                                                $order_details->user_id,
                                            )
                                                ->where('status', 3)
                                                ->count();
                                            $active_orders = \App\Models\Order::where(
                                                'user_id',
                                                $order_details->user_id,
                                            )
                                                ->where('status', 1)
                                                ->count();
                                        @endphp
                                        <div class="myOrder-single-block-item">
                                            <div class="myOrder-single-block-item-content">
                                                <span
                                                    class="myOrder-single-block-subtitle">{{ __('Complete Orders') }}</span>
                                                <h6 class="myOrder-single-block-title mt-2">{{ $complete_orders }}</h6>
                                            </div>
                                        </div>
                                        <div class="myOrder-single-block-item">
                                            <div class="myOrder-single-block-item-content">
                                                <span
                                                    class="myOrder-single-block-subtitle">{{ __('Active Orders') }}</span>
                                                <h6 class="myOrder-single-block-title mt-2">{{ $active_orders }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom-part">
                                <div class="myOrder-single-item">
                                    <div class="myOrder-single-flex flex-between">
                                        <div class="btn-wrapper flex-btn">
                                            @if ($order_details?->freelancer?->is_suspend != 1)
                                                <form action="{{ route('influencer.message.send') }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="client_id" id="client_id"
                                                        value="{{ $order_details->user_id }}">
                                                    <input type="hidden" name="from_user" id="from_user" value="1">
                                                    <input type="hidden" name="project_id" id="project_id"
                                                        value="{{ $order_details->identity }}">
                                                    <input type="hidden" name="order_id" id="order_id"
                                                        value="{{ $order_details->id }}">
                                                    <button type="submit" class="btn-profile btn-outline-1">
                                                        {{ __('Send Message') }}</button>
                                                </form>
                                                @if ($order_details->status == 3)
                                                    <a href="{{ route('influencer.order.invoice.generate', $order_details->id) }}"
                                                        class="btn-profile btn-outline-1">{{ __('Invoice') }}</a>
                                                    <a href="{{ route('influencer.order.rating', $order_details->id) }}"
                                                        class="btn-profile btn-bg-1">{{ __('Submit Review') }}</a>
                                                @endif
                                            @endif

                                            @if ($order_details->status != 3)
                                                @if ($order_details->is_fixed_hourly == 'hourly' && $order_details->status != 0)
                                                    <a href="{{ route('influencer.order.time.tracker', $order_details->id) }}"
                                                        class="btn-profile btn-bg-1">{{ __('Start Tracking') }}</a>
                                                @endif
                                            @endif

                                            @if ($order_details->is_fixed_hourly == 'hourly' && $order_details->status != 0)
                                                <a href="{{ route('influencer.order.work.history', $order_details->id) }}"
                                                    class="btn-profile btn-bg-1">{{ __('Work History') }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="myOrder-single bg-white border-0 ">
                            <div class="single-profile-settings-inner">
                                <div class="row g-4">
                                    @php
                                        $mile_stones = \App\Models\OrderMilestone::where(
                                            'order_id',
                                            $order_details->id,
                                        )->get();
                                        $payable_amount = \App\Models\OrderMilestone::where(
                                            'order_id',
                                            $order_details->id,
                                        )
                                            ->where('status', '!=', 3)
                                            ->sum('price');
                                    @endphp
                                    <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                        <div class="myJob-wrapper-single-balance total_balance">
                                            <div class="myJob-wrapper-single-balance-contents text-center">
                                                <div class="icon-wraper balance-icon">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M8.51018 5.8408H15.4862L17.6956 1.76193C17.7666 1.6307 17.7941 1.48026 17.774 1.33239C17.7539 1.18451 17.6873 1.04686 17.5838 0.939355C17.4803 0.831852 17.3452 0.760074 17.1982 0.734408C17.0512 0.708741 16.8999 0.730516 16.766 0.796583C15.1849 1.57724 13.8023 1.2441 12.2014 0.858552C10.6182 0.477224 8.8241 0.0450364 6.69405 0.760489C6.59684 0.793149 6.50794 0.846679 6.4336 0.917325C6.35926 0.987972 6.30128 1.07403 6.26371 1.16945C6.22615 1.26488 6.20991 1.36737 6.21614 1.46973C6.22237 1.57209 6.25092 1.67186 6.29979 1.76202L8.51018 5.8408Z"
                                                            fill="#8280FF" />
                                                        <path
                                                            d="M16.2232 7.53203C16.1318 7.43738 16.0398 7.34206 15.9472 7.24609H8.0522C7.95973 7.34194 7.86772 7.43725 7.77616 7.53203C6.35064 9.00691 5.00411 10.4001 4.00178 11.9595C2.84931 13.7527 2.3125 15.5105 2.3125 17.4917C2.3125 19.7905 3.55192 21.5455 5.89666 22.567C7.90211 23.4407 10.3221 23.624 11.9991 23.624C13.6884 23.624 16.1218 23.4406 18.1214 22.5666C20.4541 21.5471 21.6871 19.7923 21.6871 17.4917C21.6871 15.5106 21.1502 13.7527 19.9978 11.9595C18.9955 10.4001 17.6489 9.00691 16.2232 7.53203ZM12.1437 14.0446C12.6473 14.1505 13.168 14.2602 13.6146 14.5546C14.1949 14.9371 14.4892 15.5283 14.4892 16.3119C14.4892 17.3462 13.7338 18.2215 12.7021 18.5003V18.863C12.7021 19.0495 12.628 19.2283 12.4961 19.3602C12.3643 19.492 12.1854 19.5661 11.9989 19.5661C11.8125 19.5661 11.6336 19.492 11.5018 19.3602C11.3699 19.2283 11.2958 19.0495 11.2958 18.863V18.5003C10.2641 18.2215 9.5087 17.3462 9.5087 16.3119C9.5087 16.1254 9.58278 15.9465 9.71464 15.8147C9.84651 15.6828 10.0253 15.6087 10.2118 15.6087C10.3983 15.6087 10.5772 15.6828 10.709 15.8147C10.8409 15.9465 10.915 16.1254 10.915 16.3119C10.915 16.7947 11.4012 17.1873 11.9989 17.1873C12.5966 17.1873 13.0829 16.7945 13.0829 16.3119C13.0829 15.7681 12.9107 15.643 11.8541 15.4207C11.3506 15.3148 10.8299 15.2051 10.3833 14.9108C9.80294 14.5282 9.5087 13.937 9.5087 13.1535C9.5087 12.1185 10.2641 11.2427 11.2958 10.9638V10.6023C11.2958 10.4159 11.3699 10.237 11.5018 10.1052C11.6336 9.9733 11.8125 9.89922 11.9989 9.89922C12.1854 9.89922 12.3643 9.9733 12.4961 10.1052C12.628 10.237 12.7021 10.4159 12.7021 10.6023V10.9637C13.7338 11.2426 14.4892 12.1183 14.4892 13.1533C14.4892 13.3398 14.4151 13.5187 14.2832 13.6505C14.1514 13.7824 13.9725 13.8565 13.786 13.8565C13.5996 13.8565 13.4207 13.7824 13.2889 13.6505C13.157 13.5187 13.0829 13.3398 13.0829 13.1533C13.0829 12.6699 12.5966 12.2768 11.9989 12.2768C11.4012 12.2768 10.915 12.67 10.915 13.1533C10.9151 13.6974 11.0874 13.8223 12.1439 14.0446H12.1437Z"
                                                            fill="#8280FF" />
                                                    </svg>
                                                </div>
                                                <p class="myJob-wrapper-single-balance-para">{{ __('Earned Balance') }}
                                                </p>
                                                @if ($order_details->status === 3)
                                                    <h4 class="contract_single__balance-price">
                                                        {{ float_amount_with_currency_symbol($order_details->payable_amount) }}
                                                    </h4>
                                                @else
                                                    @php $earnings = \App\Models\OrderMilestone::where('order_id',$order_details->id)->where('status',2)->sum('price'); @endphp
                                                    <h4
                                                        class="inf-title lg-font black_text fw_bold contract_single__balance-price">
                                                        {{ float_amount_with_currency_symbol($earnings) }}</h4>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    @if ($order_details->is_fixed_hourly == 'hourly' && $order_details->status != 3)
                                        <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                            <div class="myJob-wrapper-single-balance">
                                                <div class="myJob-wrapper-single-balance-contents text-center">
                                                    <div class="icon-wraper total-project-icon">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M15.75 1.5H14.121C13.812 0.627 12.978 0 12 0C11.022 0 10.188 0.627 9.8775 1.5H8.25C7.836 1.5 7.5 1.836 7.5 2.25V5.25C7.5 5.664 7.836 6 8.25 6H15.75C16.164 6 16.5 5.664 16.5 5.25V2.25C16.5 1.836 16.164 1.5 15.75 1.5Z"
                                                                fill="#FFBB38" />
                                                            <path
                                                                d="M19.5 3H18V5.25C18 6.4905 16.9905 7.5 15.75 7.5H8.25C7.0095 7.5 6 6.4905 6 5.25V3H4.5C3.6735 3 3 3.6735 3 4.5V22.5C3 23.3415 3.6585 24 4.5 24H19.5C20.3415 24 21 23.3415 21 22.5V4.5C21 3.6585 20.3415 3 19.5 3ZM11.781 16.281L8.781 19.281C8.634 19.4265 8.442 19.5 8.25 19.5C8.058 19.5 7.866 19.4265 7.719 19.281L6.219 17.781C5.9265 17.4885 5.9265 17.013 6.219 16.7205C6.5115 16.428 6.987 16.428 7.2795 16.7205L8.25 17.6895L10.719 15.2205C11.0115 14.928 11.487 14.928 11.7795 15.2205C12.072 15.513 12.0735 15.987 11.781 16.281ZM11.781 10.281L8.781 13.281C8.634 13.4265 8.442 13.5 8.25 13.5C8.058 13.5 7.866 13.4265 7.719 13.281L6.219 11.781C5.9265 11.4885 5.9265 11.013 6.219 10.7205C6.5115 10.428 6.987 10.428 7.2795 10.7205L8.25 11.6895L10.719 9.2205C11.0115 8.928 11.487 8.928 11.7795 9.2205C12.072 9.513 12.0735 9.987 11.781 10.281ZM17.25 18H14.25C13.836 18 13.5 17.664 13.5 17.25C13.5 16.836 13.836 16.5 14.25 16.5H17.25C17.664 16.5 18 16.836 18 17.25C18 17.664 17.664 18 17.25 18ZM17.25 12H14.25C13.836 12 13.5 11.664 13.5 11.25C13.5 10.836 13.836 10.5 14.25 10.5H17.25C17.664 10.5 18 10.836 18 11.25C18 11.664 17.664 12 17.25 12Z"
                                                                fill="#FFBB38" />
                                                        </svg>
                                                    </div>
                                                    <p class="myJob-wrapper-single-balance-para">
                                                        {{ __('Hourly Rate') }}</p>
                                                    <h4
                                                        class="inf-title lg-font black_text fw_bold contract_single__balance-price">
                                                        {{ float_amount_with_currency_symbol($order_details?->job->hourly_rate) }}
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                            <div class="myJob-wrapper-single-balance">
                                                <div class="myJob-wrapper-single-balance-contents text-center">
                                                    <div class="icon-wraper total-project-icon">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M15.75 1.5H14.121C13.812 0.627 12.978 0 12 0C11.022 0 10.188 0.627 9.8775 1.5H8.25C7.836 1.5 7.5 1.836 7.5 2.25V5.25C7.5 5.664 7.836 6 8.25 6H15.75C16.164 6 16.5 5.664 16.5 5.25V2.25C16.5 1.836 16.164 1.5 15.75 1.5Z"
                                                                fill="#FFBB38" />
                                                            <path
                                                                d="M19.5 3H18V5.25C18 6.4905 16.9905 7.5 15.75 7.5H8.25C7.0095 7.5 6 6.4905 6 5.25V3H4.5C3.6735 3 3 3.6735 3 4.5V22.5C3 23.3415 3.6585 24 4.5 24H19.5C20.3415 24 21 23.3415 21 22.5V4.5C21 3.6585 20.3415 3 19.5 3ZM11.781 16.281L8.781 19.281C8.634 19.4265 8.442 19.5 8.25 19.5C8.058 19.5 7.866 19.4265 7.719 19.281L6.219 17.781C5.9265 17.4885 5.9265 17.013 6.219 16.7205C6.5115 16.428 6.987 16.428 7.2795 16.7205L8.25 17.6895L10.719 15.2205C11.0115 14.928 11.487 14.928 11.7795 15.2205C12.072 15.513 12.0735 15.987 11.781 16.281ZM11.781 10.281L8.781 13.281C8.634 13.4265 8.442 13.5 8.25 13.5C8.058 13.5 7.866 13.4265 7.719 13.281L6.219 11.781C5.9265 11.4885 5.9265 11.013 6.219 10.7205C6.5115 10.428 6.987 10.428 7.2795 10.7205L8.25 11.6895L10.719 9.2205C11.0115 8.928 11.487 8.928 11.7795 9.2205C12.072 9.513 12.0735 9.987 11.781 10.281ZM17.25 18H14.25C13.836 18 13.5 17.664 13.5 17.25C13.5 16.836 13.836 16.5 14.25 16.5H17.25C17.664 16.5 18 16.836 18 17.25C18 17.664 17.664 18 17.25 18ZM17.25 12H14.25C13.836 12 13.5 11.664 13.5 11.25C13.5 10.836 13.836 10.5 14.25 10.5H17.25C17.664 10.5 18 10.836 18 11.25C18 11.664 17.664 12 17.25 12Z"
                                                                fill="#FFBB38" />
                                                        </svg>
                                                    </div>
                                                    <p class="myJob-wrapper-single-balance-para">
                                                        {{ __('Pending Balance') }}
                                                    </p>
                                                    @if ($mile_stones->count() > 0)
                                                        @if ($order_details->status != 3)
                                                            <h4
                                                                class="inf-title lg-font black_text fw_bold contract_single__balance-price">
                                                                {{ float_amount_with_currency_symbol($payable_amount - $earnings) }}
                                                            </h4>
                                                        @else
                                                            <h4
                                                                class="inf-title lg-font black_text fw_bold contract_single__balance-price">
                                                                {{ site_currency_symbol() }} 0</h4>
                                                        @endif
                                                    @else
                                                        @if ($order_details->status != 3 && $order_details->payment_status != '')
                                                            <h4
                                                                class="inf-title lg-font black_text fw_bold contract_single__balance-price">
                                                                {{ float_amount_with_currency_symbol($order_details->payable_amount) }}
                                                            </h4>
                                                        @else
                                                            <h4
                                                                class="inf-title lg-font black_text fw_bold contract_single__balance-price">
                                                                {{ site_currency_symbol() }} 0</h4>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($order_details->is_fixed_hourly == 'hourly' && $order_details->status != 3)
                                        <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                            <div class="myJob-wrapper-single-balance">
                                                <div class="myJob-wrapper-single-balance-contents text-center">
                                                    <div class="icon-wraper complete-order-icon">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M22.8994 20.2932L21.3697 8.93372C21.2836 8.29298 20.971 7.70948 20.4894 7.28892C20.0081 6.86836 19.3874 6.63497 18.7429 6.63497H17.0596V5.76305C17.0596 2.97328 14.7901 0.703125 11.9997 0.703125C9.20942 0.703125 6.9395 2.97328 6.9395 5.76305V6.63497H5.25641C4.61169 6.63497 3.99144 6.86836 3.50989 7.28892C3.02834 7.70948 2.71569 8.29298 2.62958 8.93372L1.09991 20.2932C0.994859 21.0727 1.2133 21.7993 1.73141 22.3916C2.24952 22.9839 2.93961 23.2966 3.72673 23.2966H20.2725C21.0599 23.2966 21.7496 22.9839 22.2679 22.3916C22.786 21.7993 23.0044 21.0727 22.8994 20.2932ZM8.43945 10.7305C8.43945 11.1444 8.10369 11.4791 7.6895 11.4791C7.27531 11.4791 6.93955 11.1444 6.93955 10.7305V8.13666H8.43945V10.7305ZM8.43945 5.76305C8.43945 3.80114 10.0367 2.20261 11.9997 2.20261C13.9627 2.20261 15.5597 3.80114 15.5597 5.76305V6.63497H8.43945V5.76305ZM17.0596 10.7305C17.0596 11.1444 16.724 11.4791 16.3096 11.4791C15.8957 11.4791 15.5597 11.1444 15.5597 10.7305V8.13666H17.0596V10.7305Z"
                                                                fill="#4AD991" />
                                                        </svg>
                                                    </div>
                                                    <p class="myJob-wrapper-single-balance-para">
                                                        {{ __('Estimated Hours') }}
                                                    </p>
                                                    <h4
                                                        class="inf-title lg-font black_text fw_bold contract_single__balance-price">
                                                        {{ $order_details?->job->estimated_hours }}
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                            <div class="myJob-wrapper-single-balance">
                                                <div class="myJob-wrapper-single-balance-contents text-center">
                                                    <div class="icon-wraper complete-order-icon">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M22.8994 20.2932L21.3697 8.93372C21.2836 8.29298 20.971 7.70948 20.4894 7.28892C20.0081 6.86836 19.3874 6.63497 18.7429 6.63497H17.0596V5.76305C17.0596 2.97328 14.7901 0.703125 11.9997 0.703125C9.20942 0.703125 6.9395 2.97328 6.9395 5.76305V6.63497H5.25641C4.61169 6.63497 3.99144 6.86836 3.50989 7.28892C3.02834 7.70948 2.71569 8.29298 2.62958 8.93372L1.09991 20.2932C0.994859 21.0727 1.2133 21.7993 1.73141 22.3916C2.24952 22.9839 2.93961 23.2966 3.72673 23.2966H20.2725C21.0599 23.2966 21.7496 22.9839 22.2679 22.3916C22.786 21.7993 23.0044 21.0727 22.8994 20.2932ZM8.43945 10.7305C8.43945 11.1444 8.10369 11.4791 7.6895 11.4791C7.27531 11.4791 6.93955 11.1444 6.93955 10.7305V8.13666H8.43945V10.7305ZM8.43945 5.76305C8.43945 3.80114 10.0367 2.20261 11.9997 2.20261C13.9627 2.20261 15.5597 3.80114 15.5597 5.76305V6.63497H8.43945V5.76305ZM17.0596 10.7305C17.0596 11.1444 16.724 11.4791 16.3096 11.4791C15.8957 11.4791 15.5597 11.1444 15.5597 10.7305V8.13666H17.0596V10.7305Z"
                                                                fill="#4AD991" />
                                                        </svg>
                                                    </div>
                                                    <p class="myJob-wrapper-single-balance-para">
                                                        {{ __('Commission Amount') }}
                                                    </p>
                                                    <h4
                                                        class="inf-title lg-font black_text fw_bold contract_single__balance-price">
                                                        {{ float_amount_with_currency_symbol($order_details->commission_amount) }}
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($order_details->is_fixed_hourly == 'hourly' && $order_details->status != 3)
                                        <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                            <div class="myJob-wrapper-single-balance">
                                                <div class="myJob-wrapper-single-balance-contents text-center">
                                                    <div class="icon-wraper active-order-icon">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M16 1.25H4C3.63879 1.24974 3.28107 1.32069 2.94731 1.4588C2.61355 1.5969 2.31028 1.79946 2.05487 2.05487C1.79946 2.31028 1.5969 2.61355 1.4588 2.94731C1.32069 3.28107 1.24974 3.63879 1.25 4V20C1.24974 20.3612 1.32069 20.7189 1.4588 21.0527C1.5969 21.3865 1.79946 21.6897 2.05487 21.9451C2.31028 22.2005 2.61355 22.4031 2.94731 22.5412C3.28107 22.6793 3.63879 22.7503 4 22.75H13.49C12.2323 21.9858 11.2594 20.831 10.7196 19.4619C10.1799 18.0928 10.1031 16.5847 10.501 15.1679C10.8988 13.751 11.7494 12.5034 12.923 11.6153C14.0965 10.7273 15.5284 10.2478 17 10.25C17.5916 10.2484 18.1806 10.3292 18.75 10.49V4C18.7503 3.63879 18.6793 3.28107 18.5412 2.94731C18.4031 2.61355 18.2005 2.31028 17.9451 2.05487C17.6897 1.79946 17.3865 1.5969 17.0527 1.4588C16.7189 1.32069 16.3612 1.24974 16 1.25ZM10 10.75H5C4.80109 10.75 4.61032 10.671 4.46967 10.5303C4.32902 10.3897 4.25 10.1989 4.25 10C4.25 9.80109 4.32902 9.61032 4.46967 9.46967C4.61032 9.32902 4.80109 9.25 5 9.25H10C10.1989 9.25 10.3897 9.32902 10.5303 9.46967C10.671 9.61032 10.75 9.80109 10.75 10C10.75 10.1989 10.671 10.3897 10.5303 10.5303C10.3897 10.671 10.1989 10.75 10 10.75ZM12 6.75H5C4.80109 6.75 4.61032 6.67098 4.46967 6.53033C4.32902 6.38968 4.25 6.19891 4.25 6C4.25 5.80109 4.32902 5.61032 4.46967 5.46967C4.61032 5.32902 4.80109 5.25 5 5.25H12C12.1989 5.25 12.3897 5.32902 12.5303 5.46967C12.671 5.61032 12.75 5.80109 12.75 6C12.75 6.19891 12.671 6.38968 12.5303 6.53033C12.3897 6.67098 12.1989 6.75 12 6.75Z"
                                                                fill="#FF9871" />
                                                            <path
                                                                d="M17 11.25C15.8628 11.25 14.7511 11.5872 13.8055 12.219C12.8599 12.8509 12.1229 13.7489 11.6877 14.7996C11.2525 15.8502 11.1386 17.0064 11.3605 18.1218C11.5824 19.2372 12.13 20.2617 12.9341 21.0659C13.7383 21.87 14.7628 22.4177 15.8782 22.6395C16.9936 22.8614 18.1498 22.7475 19.2004 22.3123C20.2511 21.8771 21.1491 21.1401 21.781 20.1945C22.4128 19.2489 22.75 18.1372 22.75 17C22.7481 15.4756 22.1418 14.0141 21.0638 12.9362C19.9859 11.8582 18.5244 11.2519 17 11.25ZM19.03 16.53L17.03 18.53C16.9605 18.5998 16.8779 18.6552 16.787 18.6929C16.696 18.7307 16.5985 18.7502 16.5 18.7502C16.4015 18.7502 16.304 18.7307 16.213 18.6929C16.1221 18.6552 16.0395 18.5998 15.97 18.53L14.97 17.53C14.8963 17.4613 14.8372 17.3785 14.7962 17.2865C14.7552 17.1945 14.7332 17.0952 14.7314 16.9945C14.7296 16.8938 14.7482 16.7938 14.7859 16.7004C14.8236 16.607 14.8797 16.5222 14.951 16.451C15.0222 16.3797 15.107 16.3236 15.2004 16.2859C15.2938 16.2482 15.3938 16.2296 15.4945 16.2314C15.5952 16.2332 15.6945 16.2552 15.7865 16.2962C15.8785 16.3372 15.9613 16.3963 16.03 16.47L16.5 16.939L17.97 15.47C18.0387 15.3963 18.1215 15.3372 18.2135 15.2962C18.3055 15.2552 18.4048 15.2332 18.5055 15.2314C18.6062 15.2296 18.7062 15.2482 18.7996 15.2859C18.893 15.3236 18.9778 15.3797 19.049 15.451C19.1203 15.5222 19.1764 15.607 19.2141 15.7004C19.2518 15.7938 19.2704 15.8938 19.2686 15.9945C19.2668 16.0952 19.2448 16.1945 19.2038 16.2865C19.1628 16.3785 19.1037 16.4613 19.03 16.53Z"
                                                                fill="#FF9871" />
                                                        </svg>
                                                    </div>
                                                    <p class="myJob-wrapper-single-balance-para">
                                                        {{ __('Approximate  Budget') }}
                                                    </p>
                                                    <h4
                                                        class="inf-title lg-font black_text fw_bold contract_single__balance-price">
                                                        {{ float_amount_with_currency_symbol($order_details->price) }}
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                            <div class="myJob-wrapper-single-balance">
                                                <div class="myJob-wrapper-single-balance-contents text-center">
                                                    <div class="icon-wraper active-order-icon">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M16 1.25H4C3.63879 1.24974 3.28107 1.32069 2.94731 1.4588C2.61355 1.5969 2.31028 1.79946 2.05487 2.05487C1.79946 2.31028 1.5969 2.61355 1.4588 2.94731C1.32069 3.28107 1.24974 3.63879 1.25 4V20C1.24974 20.3612 1.32069 20.7189 1.4588 21.0527C1.5969 21.3865 1.79946 21.6897 2.05487 21.9451C2.31028 22.2005 2.61355 22.4031 2.94731 22.5412C3.28107 22.6793 3.63879 22.7503 4 22.75H13.49C12.2323 21.9858 11.2594 20.831 10.7196 19.4619C10.1799 18.0928 10.1031 16.5847 10.501 15.1679C10.8988 13.751 11.7494 12.5034 12.923 11.6153C14.0965 10.7273 15.5284 10.2478 17 10.25C17.5916 10.2484 18.1806 10.3292 18.75 10.49V4C18.7503 3.63879 18.6793 3.28107 18.5412 2.94731C18.4031 2.61355 18.2005 2.31028 17.9451 2.05487C17.6897 1.79946 17.3865 1.5969 17.0527 1.4588C16.7189 1.32069 16.3612 1.24974 16 1.25ZM10 10.75H5C4.80109 10.75 4.61032 10.671 4.46967 10.5303C4.32902 10.3897 4.25 10.1989 4.25 10C4.25 9.80109 4.32902 9.61032 4.46967 9.46967C4.61032 9.32902 4.80109 9.25 5 9.25H10C10.1989 9.25 10.3897 9.32902 10.5303 9.46967C10.671 9.61032 10.75 9.80109 10.75 10C10.75 10.1989 10.671 10.3897 10.5303 10.5303C10.3897 10.671 10.1989 10.75 10 10.75ZM12 6.75H5C4.80109 6.75 4.61032 6.67098 4.46967 6.53033C4.32902 6.38968 4.25 6.19891 4.25 6C4.25 5.80109 4.32902 5.61032 4.46967 5.46967C4.61032 5.32902 4.80109 5.25 5 5.25H12C12.1989 5.25 12.3897 5.32902 12.5303 5.46967C12.671 5.61032 12.75 5.80109 12.75 6C12.75 6.19891 12.671 6.38968 12.5303 6.53033C12.3897 6.67098 12.1989 6.75 12 6.75Z"
                                                                fill="#FF9871" />
                                                            <path
                                                                d="M17 11.25C15.8628 11.25 14.7511 11.5872 13.8055 12.219C12.8599 12.8509 12.1229 13.7489 11.6877 14.7996C11.2525 15.8502 11.1386 17.0064 11.3605 18.1218C11.5824 19.2372 12.13 20.2617 12.9341 21.0659C13.7383 21.87 14.7628 22.4177 15.8782 22.6395C16.9936 22.8614 18.1498 22.7475 19.2004 22.3123C20.2511 21.8771 21.1491 21.1401 21.781 20.1945C22.4128 19.2489 22.75 18.1372 22.75 17C22.7481 15.4756 22.1418 14.0141 21.0638 12.9362C19.9859 11.8582 18.5244 11.2519 17 11.25ZM19.03 16.53L17.03 18.53C16.9605 18.5998 16.8779 18.6552 16.787 18.6929C16.696 18.7307 16.5985 18.7502 16.5 18.7502C16.4015 18.7502 16.304 18.7307 16.213 18.6929C16.1221 18.6552 16.0395 18.5998 15.97 18.53L14.97 17.53C14.8963 17.4613 14.8372 17.3785 14.7962 17.2865C14.7552 17.1945 14.7332 17.0952 14.7314 16.9945C14.7296 16.8938 14.7482 16.7938 14.7859 16.7004C14.8236 16.607 14.8797 16.5222 14.951 16.451C15.0222 16.3797 15.107 16.3236 15.2004 16.2859C15.2938 16.2482 15.3938 16.2296 15.4945 16.2314C15.5952 16.2332 15.6945 16.2552 15.7865 16.2962C15.8785 16.3372 15.9613 16.3963 16.03 16.47L16.5 16.939L17.97 15.47C18.0387 15.3963 18.1215 15.3372 18.2135 15.2962C18.3055 15.2552 18.4048 15.2332 18.5055 15.2314C18.6062 15.2296 18.7062 15.2482 18.7996 15.2859C18.893 15.3236 18.9778 15.3797 19.049 15.451C19.1203 15.5222 19.1764 15.607 19.2141 15.7004C19.2518 15.7938 19.2704 15.8938 19.2686 15.9945C19.2668 16.0952 19.2448 16.1945 19.2038 16.2865C19.1628 16.3785 19.1037 16.4613 19.03 16.53Z"
                                                                fill="#FF9871" />
                                                        </svg>
                                                    </div>
                                                    <p class="myJob-wrapper-single-balance-para">{{ __('Total Budget') }}
                                                    </p>
                                                    <h4
                                                        class="inf-title lg-font black_text fw_bold contract_single__balance-price">
                                                        {{ float_amount_with_currency_symbol($order_details->price) }}
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="sticky-top">
                            <div class="profile-details-widget">
                                <div class="dashboard-card influencer-info-wraper">
                                    <div class="project-owner influencer-info">
                                        <div class="left-part">
                                            <div class="inf-img">
                                                <x-order.profile-image :image="$order_details?->user->image" :loadFrom="$order_details->user->load_from" />
                                                <span class="status-icon online"></span>
                                                <x-status.user-online-offline-check :userID="$order_details?->user->id" />
                                            </div>
                                        </div>
                                        <div class="right-part">
                                            <div class="right-top d-flex gap-4">
                                                <div class="name lg-font fw_semibold black_text">
                                                    {{ $order_details?->user->first_name }}
                                                    {{ $order_details?->user->last_name }}
                                                    @if ($order_details?->user->user_verified_status == 1)
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
                                                    @if ($order_details?->user?->user_state?->state != null)
                                                        {{ $order_details?->user?->user_state?->state }},
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="right-bottom">
                                                <div class="account-insight member-wraper">
                                                    <span class="icon">
                                                        <svg width="14" height="14" viewBox="0 0 14 14"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M1.16797 6.99967C1.16797 4.79978 1.16797 3.69985 1.85138 3.01642C2.53481 2.33301 3.63475 2.33301 5.83464 2.33301H8.16797C10.3678 2.33301 11.4678 2.33301 12.1512 3.01642C12.8346 3.69985 12.8346 4.79978 12.8346 6.99967C12.8346 9.19954 12.8346 10.2995 12.1512 10.9829C11.4678 11.6663 10.3678 11.6663 8.16797 11.6663H5.83464C3.63475 11.6663 2.53481 11.6663 1.85138 10.9829C1.16797 10.2995 1.16797 9.19954 1.16797 6.99967Z"
                                                                stroke="#FF5B6B" stroke-width="0.875"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M6.41536 5.83366C6.41536 5.18933 5.89305 4.66699 5.2487 4.66699C4.60437 4.66699 4.08203 5.18933 4.08203 5.83366C4.08203 6.47801 4.60437 7.00033 5.2487 7.00033C5.89305 7.00033 6.41536 6.47801 6.41536 5.83366Z"
                                                                stroke="#FF5B6B" stroke-width="0.875"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M7.58464 9.33333C7.58464 8.04469 6.53994 7 5.2513 7C3.96264 7 2.91797 8.04469 2.91797 9.33333"
                                                                stroke="#FF5B6B" stroke-width="0.875"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M8.75 5.25H11.0833" stroke="#FF5B6B"
                                                                stroke-width="0.875" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path d="M8.75 7H11.0833" stroke="#FF5B6B"
                                                                stroke-width="0.875" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </span>
                                                    <span>{{ __('Member since') }}</span>
                                                    <span>{{ $order_details?->user->created_at->toFormattedDateString() ?? '' }}</span>
                                                </div>
                                                <div class="account-insight hire-rate">
                                                    <span class="icon">
                                                        <svg width="14" height="14" viewBox="0 0 14 14"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
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
                                                    <span>{{ $order_details?->user?->user_jobs?->count() }}</span>
                                                </div>
                                                @php
                                                    $total_job = App\Models\JobPost::where(
                                                        'user_id',
                                                        $order_details?->user->id,
                                                    )->count();
                                                    $total_order = App\Models\Order::where(
                                                        'user_id',
                                                        $order_details?->user->id,
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
                                                                <path d="M8.75 8.75H8.7437M5.25628 5.25H5.25"
                                                                    stroke="#FF5B6B" stroke-width="1.16667"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
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
                            <div class="dashboard-card myJob-tabs mt-4">
                                <ul class="tabs">
                                    @if ($mile_stones->count() > 0)
                                        <li data-tab="Milestones" class="active">{{ __('Milestones') }}</li>
                                        <li data-tab="Description"> {{ __('Description & Requirements') }} </li>
                                    @else
                                        <li data-tab="Description" class="active"> {{ __('Description & Requirements') }}
                                        </li>
                                    @endif
                                    <li data-tab="Works"> {{ __('Works Submitted') }} </li>
                                </ul>

                                @if ($mile_stones->count() > 0)
                                    <div class="tab-content-item active mt-4" id="Milestones">
                                        <div class="myJob-wrapper-single">
                                            <div class="myJob-wrapper-single-header profile-border-bottom">
                                                <h4 class="myJob-wrapper-single-title">{{ __('Milestone') }}</h4>
                                            </div>
                                            <div class="myJob-wrapper-single-milestone milestone-contractor-parent">
                                                @foreach ($mile_stones as $mile_stone)
                                                    <div class="myJob-wrapper-single-milestone-item">
                                                        <div
                                                            class="myJob-wrapper-single-flex flex-between align-items-start">
                                                            <x-order.milestone-details :id="$mile_stone->id" :orderID="$order_details->id"
                                                                :clientID="$order_details->user_id" :title="$mile_stone->title" :price="$mile_stone->price"
                                                                :status="$mile_stone->status" :deadline="$mile_stone->deadline" :description="$mile_stone->description" />
                                                            <div class="myJob-wrapper-single-right">
                                                                <div class="myJob-wrapper-single-right-flex">
                                                                    <x-order.is-funded :isFunded="$order_details->payment_status"
                                                                        :paymentGateway="$order_details->payment_gateway" />
                                                                    <span
                                                                        class="myJob-wrapper-single-fixed danger">{{ __('Revision:') }}
                                                                        {{ $mile_stone->revision ?? '' }}</span>
                                                                    <span
                                                                        class="myJob-wrapper-single-fixed danger">{{ __('Revision Left:') }}
                                                                        {{ $mile_stone->revision_left ?? '' }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($mile_stones->count() > 0)
                                    <div class="tab-content-item mt-4" id="Description">
                                @else
                                    <div class="tab-content-item mt-4 active" id="Description">
                                @endif
                                <div class="myOrder-single bg-white padding-20 radius-10">
                                    <div class="myOrder-single-item">
                                        <div class="myOrder-single-content">
                                            <p class="myOrder-single-content-para">
                                                {{ $order_details->description ?? __('No description.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-content-item mt-4" id="Works">
                                <div class="pay-now-single">
                                    <h4 class="pay-now-single-title">{{ __('Work Submitted') }}</h4>
                                    <div class="pay-now-single-contents profile-border-top">
                                        @if ($order_details?->order_submit_history?->count() > 0)
                                            @foreach ($order_details->order_submit_history as $history)
                                                <div class="pay-now-single-contents-work">
                                                    <div class="pay-now-single-contents-work-flex">
                                                        <div class="pay-now-single-contents-work-item">
                                                            <span
                                                                class="pay-now-single-contents-work-date">{{ $history->created_at->toFormattedDateString() }}</span>
                                                        </div>
                                                        <div class="pay-now-single-contents-work-item">
                                                            <div class="single-refundRequest-item">
                                                                <a href="{{ asset('assets/uploads/attachment/order/' . $history->attachment) }}"
                                                                    download class="single-refundRequest-item-uploads">
                                                                    <i class="fa-solid fa-cloud-arrow-down"></i>
                                                                    {{ __('Download Attachment') }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="pay-now-single-contents-work-item">
                                                            <div class="pay-now-single-contents-work-item-status">
                                                                @if ($history->status === 0)
                                                                    <span
                                                                        class="milestone-approved ">{{ __('Pending') }}</span>
                                                                @elseif($history->status === 1)
                                                                    <span
                                                                        class="myJob-wrapper-single-fixed active">{{ __('Approved') }}</span>
                                                                @elseif($history->status === 2)
                                                                    <span
                                                                        class="btn myJob-wrapper-single-fixed danger show_revision_details"
                                                                        data-bs-target="#RevisionDetailsModal"
                                                                        data-bs-toggle="modal"
                                                                        data-revision_id="{{ $history->request_revision?->id }}"
                                                                        data-revision_description="{{ $history->request_revision?->description }}">
                                                                        {{ __('Revision Details') }}
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="pay-now-single-contents-work-item">
                                                            <div class="pay-now-single-contents-work-item-btn">
                                                                <a href="javascript:void(0)"
                                                                    class="pay-now-single-contents-work-viewMore order_submit_description"
                                                                    data-description="{{ $history->description }}"
                                                                    data-order_milestone_id="{{ $history->order_milestone_id }}"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#OrderSubmitDescriptionModal">
                                                                    {{ __('Description') }}
                                                                    <i class="fa-solid fa-angle-right"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="myOrder-single-item mt-4">
                                <div class="myOrder-single-flex flex-between">
                                    @php
                                        $check_order_has_report_by_freelancer = \App\Models\Report::where(
                                            'freelancer_id',
                                            $order_details->freelancer_id,
                                        )
                                            ->where('order_id', $order_details->id)
                                            ->where('reporter', 'freelancer')
                                            ->first();
                                    @endphp
                                    @if (empty($check_order_has_report_by_freelancer))
                                        @if ($order_details->status == 3 || $order_details->status == 4)
                                            @if ($order_details?->freelancer?->is_suspend != 1)
                                                <a href="javascript:void(0)" data-order-id="{{ $order_details->id }}"
                                                    data-client-id="{{ $order_details->user_id }}"
                                                    class="inf-cmn-btn style2 md-radius inf-primary-btn md-radius btn-bg-cancel btn-hover-danger open_order_report_modal"
                                                    data-bs-target="#reportModal"
                                                    data-bs-toggle="modal">{{ __('Report Order') }}
                                                </a>
                                            @endif
                                        @endif
                                    @else
                                        <span class="btn-profile btn-outline-1">
                                            {{ __('Reported') }}</span>
                                    @endif

                                    <div class="btn-wrapper flex-btn">
                                        @if ($order_details->status == 0)
                                            <x-status.table.status-change :title="__('Decline Order')" :class="'inf-cmn-btn inf-primary-outline-btn style2 md-radius btn-bg-cancel decline_and_change_order_status'"
                                                :value="__('decline')" :url="route('influencer.order.decline', $order_details->id)" />
                                            <x-status.table.status-change :title="__('Accept Order')" :class="'inf-cmn-btn inf-green-outline-btn style2 md-radius btn-bg-1 accept_and_change_order_status'"
                                                :url="route('influencer.order.accept', $order_details->id)" />
                                        @else
                                            @if (
                                                $order_details->status != 5 &&
                                                    $order_details->status != 4 &&
                                                    $order_details->status != 3 &&
                                                    $order_details->status != 7)
                                                <x-status.table.status-change :title="__('Cancel Order')" :class="'inf-cmn-btn style2 md-radius inf-primary-outline-btn btn-bg-cancel cancel_and_change_order_status'"
                                                    :value="__('cancel')" :url="route('influencer.order.decline', $order_details->id)" />
                                            @endif
                                            @if ($mile_stones->count() <= 0)
                                                @if (Auth::guard('web')->user()->user_type == 2 && $order_details->status == 1)
                                                    <a href="javascript:void(0)"
                                                        class="inf-cmn-btn style2 md-radius inf-primary-btn order_submit"
                                                        data-bs-toggle="modal" data-bs-target="#orderSubmitModal"
                                                        data-order_id="{{ $order_details->id }}"
                                                        data-order_milestone_id="{{ $id ?? '' }}"
                                                        data-client_id="{{ $order_details->user_id }}">
                                                        {{ __('Submit') }}
                                                    </a>
                                                @endif
                                                @if (Auth::guard('web')->user()->user_type == 1 &&
                                                        $order_details->status == 1 &&
                                                        Session::get('user_role') == 'freelancer')
                                                    <a href="javascript:void(0)" class="btn-profile inf-primary-btn order_submit"
                                                        data-bs-toggle="modal" data-bs-target="#orderSubmitModal"
                                                        data-order_id="{{ $order_details->id }}"
                                                        data-order_milestone_id="{{ $id ?? '' }}"
                                                        data-client_id="{{ $order_details->user_id }}">
                                                        {{ __('Submit') }}
                                                    </a>
                                                @endif
                                            @endif
                                        @endif
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

    @include('frontend.user.influencer.order.order-submit')
    @include('frontend.user.influencer.order.revision-details')
    @include('frontend.user.influencer.order.report-modal')
    @include('frontend.user.influencer.order.order-submit-description')

@endsection

@section('script')
    <x-sweet-alert.sweet-alert2-js />
    <x-summernote.summernote-js />
    @include('frontend.user.influencer.order.order-js')
@endsection
