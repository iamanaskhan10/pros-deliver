@if($orders->total() < 1)
    <div class="myOrder-single bg-white padding-20 radius-10">
        <div class="myOrder-single-item">
            <x-frontend.not-found-dash />
        </div>
    </div>
@else
    @foreach($orders as $order)
        @php $rating =  \App\Models\Rating::select('id','order_id','rating')->where('order_id',$order->id)->where('sender_type',1)->first(); @endphp

        <div class="myOrder-single bg-white radius-10">
            <div class="top-part">
                <div class="myOrder-single-item">
                    <div class="myOrder-single-flex">
                        <div class="myOrder-single-content">
                            <div class="d-flex gap-2 justify-content-between">
                                <span class="myOrder-single-content-id">#000{{ $order->id }}</span>
                                <span class="myOrder-single-content-time inf-tag"> <i class="fa-regular fa-clock"></i> {{ $order->created_at->diffForHumans() }} </span>
                            </div>
                            <h4 class="myOrder-single-content-title mt-2">
                                @if($order->is_project_job == 'project')
                                    <a href="{{ route('influencer.order.details',$order->id) }}"> {{ $order?->project->title ?? '' }} </a>
                                @elseif($order->is_project_job == 'job')
                                    <a href="{{ route('influencer.order.details',$order->id) }}">{{ $order?->job->title ?? '' }}</a>
                                @else
                                    {{ __('Custom order')}}
                                @endif
                            </h4>
                            <div class="myOrder-single-content-btn flex-btn mt-3">
                                <x-order.order-status :status="$order->status" />
                                <x-order.is-custom :isCustom="$order->is_project_job" />
                                <x-order.payment-verify :paymentVerifyCheck="$order" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="myOrder-single-item">
                    <div class="myOrder-single-block">
                        <div class="myOrder-single-block-item">
                            <div class="myOrder-single-block-item-content">
                                @if($order->is_fixed_hourly == 'hourly')
                                    <span class="myOrder-single-block-subtitle">{{ __('Hourly rate') }}</span>
                                    <h6 class="myOrder-single-block-title mt-2">{{ float_amount_with_currency_symbol($order?->job->hourly_rate) }}</h6>
                                @else
                                    <span class="myOrder-single-block-subtitle">{{ __('Order budget') }}</span>
                                    <h6 class="myOrder-single-block-title mt-2">{{ float_amount_with_currency_symbol($order->price) }}
                                        <x-order.is-funded :isFunded="$order->payment_status" :paymentGateway="$order->payment_gateway" />
                                    </h6>
                                @endif
                            </div>
                        </div>
                        @if($order->delivery_time)
                        <div class="myOrder-single-block-item">
                            <div class="myOrder-single-block-item-content">
                                <span class="myOrder-single-block-subtitle">{{ __('Delivery Time') }}</span> <br>
                                <x-order.deadline :deadline="$order->delivery_time ?? '' " />
                            </div>
                        </div>
                        @endif
                        <div class="myOrder-single-block-item">
                            <div class="myOrder-single-block-item-author">
                                <x-order.profile-image :image="$order?->user->image" :loadFrom="$order?->user->load_from" />
                                @if(Cache::has('user_is_online_' . $order?->user->id))
                                    <span class="status-icon online"></span>
                                @else
                                    <span class="status-icon offline"></span>
                                @endif
                            </div>
                            <x-order.name-rating :firstName="$order?->user->first_name" :lastName="$order?->user->last_name" :userId="$order?->user->id" :orderRating="$rating->rating ?? '' " :userType="$order?->user?->user_type" :isIdentityVerified="$order?->user?->user_verified_status" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-part">
                <div class="myOrder-single-item">
                    <div class="myOrder-single-flex justify-content-start">
                        @if($order->status == 0)
                            <div class="btn-wrapper">
                                <x-status.table.status-change :title="__('Decline Order')" :class="'inf-cmn-btn style2 md-radius btn-profile btn-outline-cancel decline_and_change_order_status'" :value="__('decline')" :url="route('influencer.order.decline',$order->id)"/>
                            </div>
                        @endif

                        <div class="btn-wrapper flex-btn">
                            @if($order->status == 0)
                                <x-status.table.status-change :title="__('Accept Order')" :class="'inf-cmn-btn style2 md-radius btn-profile btn-outline-gray accept_and_change_order_status'" :url="route('influencer.order.accept',$order->id)"/>
                            @else
                                @if($order->status != 5 && $order->status != 4 && $order->status != 3 && $order->status != 7)
                                    <x-status.table.status-change :title="__('Cancel Order')" :class="'inf-cmn-btn style2 md-radius btn-profile btn-outline-cancel cancel_and_change_order_status'" :value="__('cancel')" :url="route('influencer.order.decline',$order->id)"/>
                                @endif
                            @endif
                            @if($order->status == 3)
                                @if($order?->freelancer?->is_suspend !=1)
                                    <a href="{{ route('influencer.order.invoice.generate',$order->id) }}" class="inf-cmn-btn style2 md-radius btn-profile btn-outline-gray">{{ __('Invoice') }}</a>
                                    <a href="{{ route('influencer.order.rating',$order->id) }}" class="inf-cmn-btn style2 md-radius btn-profile btn-outline-gray">{{ __('Submit Review') }}</a>
                                @endif
                            @endif
                                <a href="{{ route('influencer.order.details',$order->id) }}" class="inf-cmn-btn style2 md-radius btn-profile btn-bg-1">{{ __('View Order') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <x-pagination.laravel-paginate :allData="$orders" />
@endif
