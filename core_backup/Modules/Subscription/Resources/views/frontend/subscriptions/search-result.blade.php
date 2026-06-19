<div class="container">
    <div class="row g-4">
        @foreach ($subscriptions as $subscription)
            <div class="col-md-4">
                <div
                    class="inf-price-plan-card {{ $subscription->subscription_highlight_color == 'yes' ? 'active' : '' }}">
                    <div class="pricing_plan_top_wraper">
                        <div class="pricing_plan_header">
                            <h6 class="inf-title fw_semibold lg-font">
                                {{ $subscription->title ?? '' }}
                            </h6>
                            <p class="mt-4">
                                <span class="inf-title title3 fw_bold price">
                                    {{ amount_with_currency_symbol($subscription->price) ?? '$0' }}
                                </span>
                                <span class="md-font fw_semibold">
                                    /{{ $subscription->subscription_type?->type ?? 'm' }}
                                </span>
                            </p>
                        </div>
                        <div class="inf-card-body">
                            <div class="md-font fw_bold black_text mb-3">
                                {{ __("What's Included?") }}</div>
                            <ul class="plan-feature-list">
                                @foreach ($subscription->features as $feature)
                                    <li class="{{ $feature->status !== 'on' ? 'cross' : 'check' }}">
                                        {{ $feature->feature ?? '' }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="inf_card_footer">

                        <button class="inf-cmn-btn inf-gray-btn w-100 choose_plan" data-bs-toggle="modal"
                            data-id="{{ $subscription->id }}" data-price="{{ $subscription->price }}"
                            @if (auth::check()) data-bs-target="#paymentGatewayModal" @else data-bs-target="#loginModal" @endif>{{ __('Get Plan') }}/{{ amount_with_currency_symbol($subscription->price ?? '') }}
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
