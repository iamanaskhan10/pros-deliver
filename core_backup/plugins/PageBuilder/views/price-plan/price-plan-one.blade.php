@if (get_static_option('subscription_enable_disable') != 'disable')
    <section class="influencer influencer-pricing-plan bg-primary-one pat-120 pab-120" data-padding-top="{{ $padding_top ?? '' }}"
        data-padding-bottom="{{ $padding_bottom ?? '' }}">
        <div class="container">
            <h2 class="text-center inf-title title2 red_text fw_bold mb-4">
                {{ $title ?? __('Easy and affordable Pricing') }}</h2>
            <div class="inf_pricing pricing d-flex justify-content-center mb-40">
                <div class="nav nav-tabs pricing_type">
                    <button class="active_btn active" id="monthlyBtn" data-bs-toggle="tab"
                        data-bs-target="#monthly_price_plan"
                        onclick="toggleButtons('monthly')">{{ __('Monthly') }}</button>
                    <button class="inActive_btn" id="yearlyBtn" data-bs-toggle="tab" data-bs-target="#yearly_price_plan"
                        onclick="toggleButtons('yearly')">{{ __('Yearly') }}</button>
                </div>
            </div>
            <div class="tab-content">
                <div id="monthly_price_plan" class="tab-pane fade show active">
                    <div class="container_pricing">
                        <div class="row g-4">
                            @foreach ($monthlySubscriptions as $subscription)
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
                                                        <li
                                                            class="{{ $feature->status !== 'on' ? 'cross' : 'check' }}">
                                                            {{ $feature->feature ?? '' }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="inf_card_footer">
                                            <a href="{{ route('subscriptions.all') }}"
                                                class="inf-cmn-btn inf-gray-btn w-100">
                                                {{ __('Get Started') }} -
                                                {{ amount_with_currency_symbol($subscription->price ?? 0) }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div id="yearly_price_plan" class="tab-pane fade">
                    <div class="container_pricing">
                        <div class="row g-4">
                            @foreach ($yearlySubscriptions as $subscription)
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
                                                    {{ __("What's Included?") }}
                                                </div>
                                                <ul class="plan-feature-list">
                                                    @foreach ($subscription->features as $feature)
                                                        <li
                                                            class="{{ $feature->status !== 'on' ? 'cross' : 'check' }}">
                                                            {{ $feature->feature ?? '' }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="inf_card_footer">
                                            <a href="{{ route('subscriptions.all') }}"
                                                class="inf-cmn-btn inf-gray-btn w-100">
                                                {{ __('Get Started') }} -
                                                {{ amount_with_currency_symbol($subscription->price ?? 0) }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
<!-- Pricing area end -->
