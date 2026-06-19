@extends('frontend.layout.master')
@section('site_title', __('Dashboard'))
@section('style')
    <style>
        .total_balance {
            background-color: #e3e1ff !important;
        }

        .single-profile-settings-header {
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;

            .btn-profile {
                padding-left: 10px;
                padding-right: 10px;
            }
        }
    </style>
@endsection

@section('content')
    <main>
        <!-- Profile Settings area Starts -->
        <div class="responsive-overlay"></div>
        <div class="profile-settings-area pat-100 pab-100">
            <div class="container">
                <div class="row g-4">
                    @include('frontend.user.layout.partials.sidebar')
                    <div class="col-xl-9 col-lg-8">
                        <div class="profile-settings-wrapper">

                            <div class="single-profile-settings">
                                <div class="single-profile-settings-header d-flex">
                                    <div class="single-profile-settings-header-flex">
                                        <x-form.form-title :title="__('Dashboard Info')" :class="'inf-title title6 black_text fw_bold'" />
                                    </div>
                                    @if(get_static_option('profile_switch_enable_disable') == 'enable')
                                        <div class="profile-switch-header">
                                            <select class="switch-profile-select" id="switch_profile">
                                                <option value="freelancer" @if(Session::get('user_role') == 'freelancer') selected @endif>{{ __('As Influencer') }}</option>
                                                <option value="client" @if(Session::get('user_role') == 'client') selected @endif>{{ __('As Brand') }}</option>
                                            </select>
                                        </div>
                                    @endif
                                </div>
                                <div class="single-profile-settings-inner">
                                    <div class="row g-4">

                                        <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                            <div class="myJob-wrapper-single-balance total_balance">
                                                <div class="myJob-wrapper-single-balance-contents text-center">
                                                    <div
                                                        class="myJob-wrapper-single-balance-price d-flex gap-2 justify-content-between">
                                                    </div>
                                                    <p class="myJob-wrapper-single-balance-para">{{ __('Wallet Balance') }}
                                                    </p>
                                                    <h4
                                                        class="inf-title lg-font black_text fw_bold contract_single__balance-price">
                                                        {{ float_amount_with_currency_symbol($total_wallet_balance) ?? 0.0 }}
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                        @if (get_static_option('job_enable_disable') != 'disable')
                                            <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                                <div class="myJob-wrapper-single-balance">
                                                    <div class="myJob-wrapper-single-balance-contents text-center">
                                                        <div
                                                            class="myJob-wrapper-single-balance-price d-flex gap-2 justify-content-between">

                                                        </div>
                                                        <p class="myJob-wrapper-single-balance-para">
                                                            {{ __('Total Campaigns') }}</p>
                                                        <h4
                                                            class="inf-title lg-font black_text fw_bold contract_single__balance-price">
                                                            {{ $total_jobs ?? 0 }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                            <div class="myJob-wrapper-single-balance">
                                                <div class="myJob-wrapper-single-balance-contents text-center">
                                                    <div
                                                        class="myJob-wrapper-single-balance-price d-flex gap-2 justify-content-between">

                                                    </div>
                                                    <p class="myJob-wrapper-single-balance-para">{{ __('Complete Order') }}
                                                    </p>
                                                    <h4
                                                        class="inf-title lg-font black_text fw_bold contract_single__balance-price">
                                                        {{ $complete_order ?? 0 }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-6 col-sm-6 col-md-4">
                                            <div class="myJob-wrapper-single-balance">
                                                <div class="myJob-wrapper-single-balance-contents text-center">
                                                    <div
                                                        class="myJob-wrapper-single-balance-price d-flex gap-2 justify-content-between">

                                                    </div>
                                                    <p class="myJob-wrapper-single-balance-para">{{ __('Active Order') }}
                                                    </p>
                                                    <h4
                                                        class="inf-title lg-font black_text fw_bold contract_single__balance-price">
                                                        {{ $active_order ?? 0 }}</h4>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <hr class="mt-4 mb-4">

                                    <!-- Analytics Row: Spending Trends & Comparisons -->
                                    <div class="row g-4">
                                        <div class="col-xxl-4 col-lg-5">
                                            <div class="row g-4">
                                                <div class="col-12">
                                                    <div class="myJob-wrapper-single-balance bg-white" style="border: 1px solid #e2e8f0;">
                                                        <div class="myJob-wrapper-single-balance-contents text-center">
                                                            <p class="myJob-wrapper-single-balance-para mb-2">{{ __('Total Spend') }}</p>
                                                            <h2 class="inf-title lg-font black_text fw_bold mb-0">{{ preg_replace('/\.00(?!\d)/', '', float_amount_with_currency_symbol($total_spend)) }}</h2>
                                                            <small class="text-muted d-block mt-2">{{ __('Across all completed campaigns') }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="myJob-wrapper-single-balance" style="border: 1px solid #e2e8f0; background: #fffcf5 !important;">
                                                        <div class="myJob-wrapper-single-balance-contents text-center">
                                                            <p class="myJob-wrapper-single-balance-para mb-2">{{ __('Total Refunds') }}</p>
                                                            <h4 class="inf-title black_text fw_bold mb-0 text-danger">{{ preg_replace('/\.00(?!\d)/', '', float_amount_with_currency_symbol($total_refunds)) }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-8 col-lg-7">
                                            <div class="p-4 bg-white radius-10" style="border: 1px solid #e2e8f0; height: 100%;">
                                                <div class="single-profile-settings-header p-0 mb-3">
                                                    <h5 class="inf-title title6 black_text fw_bold">{{ __('Spending Trend (Last 12 Months)') }}</h5>
                                                </div>
                                                <div class="single-profile-settings-inner p-0">
                                                    <canvas id="monthlySpendChart" style="max-height: 250px;"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Analytics Row 2: Hiring Funnel & Utilization -->
                                    <div class="row g-4 mt-4">
                                        <div class="col-lg-6">
                                            <div class="p-4 bg-white radius-10" style="border: 1px solid #e2e8f0; height: 100%;">
                                                <div class="single-profile-settings-header p-0 mb-3">
                                                    <h5 class="inf-title title6 black_text fw_bold">{{ __('Hiring Funnel') }}</h5>
                                                </div>
                                                <div class="row g-3">
                                                    <div class="col-sm-6">
                                                        <div class="p-3 bg-light radius-10 border">
                                                            <span class="text-muted d-block mb-1">{{ __('Hire Rate') }}</span>
                                                            <h5 class="fw_bold">{{ $hire_rate }}%</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="p-3 bg-light radius-10 border">
                                                            <span class="text-muted d-block mb-1">{{ __('Avg Proposals/Job') }}</span>
                                                            <h5 class="fw_bold">{{ $avg_proposals_per_job }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="p-3 bg-light radius-10 border">
                                                            <span class="text-muted d-block mb-1">{{ __('Avg Time to Hire') }}</span>
                                                            <h5 class="fw_bold">{{ $avg_time_to_hire }} {{ __('Days') }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="p-3 bg-light radius-10 border">
                                                            <span class="text-muted d-block mb-1">{{ __('Price Range') }}</span>
                                                            <small class="fw_bold d-block">{{ preg_replace('/\.00(?!\d)/', '', float_amount_with_currency_symbol($proposal_range->min_price ?? 0)) }} - {{ preg_replace('/\.00(?!\d)/', '', float_amount_with_currency_symbol($proposal_range->max_price ?? 0)) }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="p-4 bg-white radius-10" style="border: 1px solid #e2e8f0; height: 100%;">
                                                <div class="single-profile-settings-header p-0 mb-3">
                                                    <h5 class="inf-title title6 black_text fw_bold">{{ __('Influencer Utilization') }}</h5>
                                                </div>
                                                <div class="row g-3">
                                                    <div class="col-sm-6">
                                                        <div class="p-3 bg-light radius-10 border">
                                                            <span class="text-muted d-block mb-1">{{ __('Unique Influencers') }}</span>
                                                            <h5 class="fw_bold">{{ $unique_influencers_count }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="p-3 bg-light radius-10 border">
                                                            <span class="text-muted d-block mb-1">{{ __('Repeat Hire Rate') }}</span>
                                                            <h5 class="fw_bold">{{ $repeat_hire_rate }}%</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="p-3 bg-light radius-10 border">
                                                            <span class="text-muted d-block mb-1">{{ __('Avg Spend/Influencer') }}</span>
                                                            <h5 class="fw_bold">{{ preg_replace('/\.00(?!\d)/', '', float_amount_with_currency_symbol($avg_spend_per_influencer)) }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="p-3 radius-10 border" style="background: #fff5f5 !important; border-color: #feb2b2 !important;">
                                                            <span class="text-danger d-block mb-1"><i class="fas fa-exclamation-circle"></i> {{ __('Delayed Orders') }}</span>
                                                            <h5 class="fw_bold text-danger">{{ $delayed_orders }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-4 mt-2">
                                        <div class="col-12">
                                            <div class="single-profile-settings" style="margin-bottom: 0;">
                                                <div class="single-profile-settings-header p-0 mb-3">
                                                    <h5 class="inf-title title6 black_text fw_bold">{{ __('Top Campaigns by Spend') }}</h5>
                                                </div>
                                                <div class="single-profile-settings-inner p-0">
                                                    <canvas id="campaignSpendChart" style="max-height: 250px;"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mt-4 mb-4">
                                </div>
                            </div>

                            {{-- my orders --}}
                            <div class="single-profile-settings">
                                <div class="single-profile-settings-header">
                                    <div class="single-profile-settings-header-flex pb-2">
                                        <x-form.form-title :title="__('Latest Orders')" :class="'inf-title title6 black_text fw_bold'" />
                                        <a href="{{ route('client.order.all') }}" class="btn-profile btn-bg-1">
                                            {{ __('All Orders') }} <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                    <x-notice.general-notice :description="__(
                                        'Notice: The admin has the ability to update the payment status for transactions that are pending.',
                                    )" />
                                </div>
                                <div class="single-profile-settings-inner profile-border-top">
                                    <div class="custom_table style-04">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>{{ __('Budget') }}</th>
                                                    <th>{{ __('Delivery Time') }}</th>
                                                    <th>{{ __('Payment Status') }}</th>
                                                    <th>{{ __('Create Date') }}</th>
                                                    <th class="text-center">{{ __('Order Details') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($latest_orders as $order)
                                                    <tr>
                                                        <td>{{ float_amount_with_currency_symbol($order->price) ?? '' }}
                                                        </td>
                                                        <td>{{ __($order->delivery_time) ?? '' }}</td>
                                                        <td class="text-center">
                                                            @if ($order->payment_gateway != 'manual_payment' && $order->payment_status == 'pending')
                                                                <span
                                                                    class="inf-status-badge danger">{{ __('Payment Failed') }}</span>
                                                            @elseif($order->payment_status == 'pending')
                                                                <span
                                                                    class="inf-status-badge warning">{{ ucfirst(__($order->payment_status)) }}</span>
                                                            @else
                                                                <span
                                                                    class="inf-status-badge success">{{ ucfirst(__($order->payment_status)) }}</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                                        <td class="text-center"><a
                                                                href="{{ route('client.order.details', $order->id) }}"
                                                                class="btn-profile btn-bg-1">{{ __('Order Details') }} <i
                                                                    class="fas fa-arrow-right"></i></a></td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center">
                                                            <x-frontend.not-found-dash />
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- my projects --}}
                            @if (get_static_option('job_enable_disable') != 'disable')
                                <div class="single-profile-settings">
                                    <div class="single-profile-settings-header">
                                        <div class="single-profile-settings-header-flex">
                                            <x-form.form-title :title="__('Latest Campaigns')" :class="'inf-title title6 black_text fw_bold'" />
                                            <a href="{{ route('client.job.all') }}" class="btn-profile btn-bg-1">
                                                {{ __('All Campaigns') }} </a>
                                        </div>
                                    </div>
                                    <div class="single-profile-settings-inner profile-border-top">
                                        <div class="custom_table style-04">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('Title') }}</th>
                                                        <th>{{ __('Action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($my_jobs as $job)
                                                        <tr>
                                                            <td>{{ $job->title }}</td>
                                                            <td>
                                                                <a href="{{ route('client.job.edit', $job->id) }}"
                                                                    class="btn-profile btn-bg-1 edit_info_show_hide">
                                                                    {{ __('Edit Campaign') }} </a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="5" class="text-center">
                                                                <x-frontend.not-found-dash />
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Profile Settings area end -->
    </main>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            // Global Currency Config
            const siteCurrencySymbol = "{{ site_currency_symbol() }}";
            const currencySymbolPosition = "{{ get_static_option('site_currency_symbol_position') }}";

            function formatCurrency(value) {
                let formatted = Math.round(value).toString();
                if (currencySymbolPosition === 'left' || currencySymbolPosition === '') {
                    return siteCurrencySymbol + formatted;
                } else {
                    return formatted + siteCurrencySymbol;
                }
            }

            // 1. Monthly Spending Chart
            new Chart(document.getElementById("monthlySpendChart"), {
                type: 'line',
                data: {
                    labels: @json($months),
                    datasets: [{
                        label: "{{ __('Spending') }}",
                        borderColor: "#8280FF",
                        backgroundColor: "rgba(130, 128, 255, 0.1)",
                        data: @json($monthly_spend_data),
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return "{{ __('Total Spend') }}: " + formatCurrency(context.parsed.y);
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return formatCurrency(value);
                                }
                            }
                        }
                    }
                }
            });

            // 2. Campaign Spending Chart
            new Chart(document.getElementById("campaignSpendChart"), {
                type: 'bar',
                data: {
                    labels: @json($campaign_spend_labels),
                    datasets: [{
                        label: "{{ __('Spend') }}",
                        backgroundColor: "rgba(74, 217, 145, 0.7)",
                        borderColor: "#4AD991",
                        borderWidth: 1,
                        data: @json($campaign_spend_data)
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return "{{ __('Spend') }}: " + formatCurrency(context.parsed.x);
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return formatCurrency(value);
                                }
                            }
                        }
                    }
                }
            });
        });

        $(document).on('change', '#switch_profile', function(e){
            e.preventDefault();
            let role = $(this).val();
            $.ajax({
                url: "{{ route('client.switch.profile') }}",
                type: 'post',
                data: {role:role},
                success: function(res){
                    if(res.status == 'success'){
                        toastr_success_js("{{ __('Profile switched successfully.') }}");
                        if(res.user_role == 'client'){
                            window.location.href = "{{ route('client.dashboard') }}";
                        }else{
                            window.location.href = "{{ route('influencer.dashboard') }}";
                        }
                    }
                }
            });
        });
    </script>
@endsection
