@if($offers->total() < 1)
    <div class="myOrder-single bg-white padding-20 radius-10">
        <div class="myOrder-single-item">
            <x-frontend.not-found-dash />
        </div>
    </div>
@else
    @foreach($offers as $offer)
        <div class="myOrder-single bg-white radius-10">
            <div class="top-part">
                <div class="myOrder-single-item">
                    <div class="myOrder-single-flex">
                        <div class="myOrder-single-content">
                            <div class="d-flex justify-content-between gap-2">
                                <span class="myOrder-single-content-id">#000{{ $offer->id }}</span>
                                <span class="inf-tag">{{ $offer->created_at->diffForHumans() }} </span>
                            </div>
                            <div class="myOrder-single-content-btn flex-btn mt-3">
                                @php
                                    $offer_order = \App\Models\Order::where('identity',$offer->id)->where('is_project_job','offer')->where('payment_status','complete')->first();
                                @endphp
                                @if($offer_order)
                                    <span class="job-progress">{{ __('Accepted') }}</span>
                                @else
                                    <span class="pending-approval">{{ __('Pending') }}</span>
                                @endif
                                <span class="custom-order">{{__("Custom Offer")}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="myOrder-single-item">
                    <div class="myOrder-single-block">
                        <div class="myOrder-single-block-item">
                            <div class="myOrder-single-block-item-content">
                                <span class="myOrder-single-block-subtitle">{{ __('Offer Price') }}</span>
                                <h6 class="myOrder_single__block__title mt-2">{{ float_amount_with_currency_symbol($offer->price) }}
                                </h6>
                            </div>
                        </div>
                        @if($offer->deadline)
                            <div class="myOrder-single-block-item">
                                <div class="myOrder-single-block-item-content">
                                    <span class="myOrder-single-block-subtitle">{{ __('Delivery Time') }}</span> <br>
                                    <h6 class="myOrder_single__block__title mt-2">
                                        {{ $offer->deadline ?? '' }}
                                    </h6>
                                </div>
                            </div>
                            @else
                            <div class="myOrder-single-block-item">
                                <div class="myOrder-single-block-item-content">
                                    <span class="myOrder-single-block-subtitle">{{ __('Delivery Time') }}</span> <br>
                                    <h6 class="myOrder_single__block__title mt-2">
                                        {{ __('By Milestone') }}
                                    </h6>
                                </div>
                            </div>
                        @endif
                        <div class="myOrder-single-block-item">
                            <div class="myOrder-single-block-item-content">
                                <span class="myOrder-single-block-subtitle">{{ __('Create Date') }}</span><br>
                                <h6 class="myOrder_single__block__title mt-2">
                                    {{ $offer->created_at->toFormattedDateString() ?? '' }}
                                </h6>
                            </div>
                        </div>
                        <div class="myOrder-single-block-item">
                            <div class="myOrder-single-block-item-author">
                                <x-order.profile-image :image="$offer?->freelancer->image" />
                            </div>
                            <x-order.name-rating :firstName="$offer?->freelancer->first_name" :lastName="$offer?->freelancer->last_name" :userId="$offer?->freelancer->id" :orderRating="''" :userType="$offer?->freelancer->user_type ?? ''" :isIdentityVerified="$offer?->freelancer?->user_verified_status" />
                        </div>
                    </div>
                    <p class="mt-4">{!! Str::limit($offer->description,250 ?? '') !!}</p>
                </div>
            </div>
            <div class="bottom-part">
                <div class="myOrder-single-item">
                    <div class="myOrder-single-flex flex-between">
                        <div class="btn-wrapper flex-btn">
                            <a href="{{ route('client.offer.details',$offer->id) }}" class="btn-profile btn-bg-1">{{ __('View Offer') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <x-pagination.laravel-paginate :allData="$offers" />
@endif
