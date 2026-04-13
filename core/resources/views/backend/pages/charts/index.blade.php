@extends('backend.layout.master')
@section('title', __('Charts & Analytics'))
@section('content')
    <div class="dashboard__body">
        
        <!-- Filter Section -->
        <div class="dashboard__charts padding-20 radius-10 bg-white mb-4">
            <form action="{{ route('admin.charts.index') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="filter_type" class="form-label">{{ __('Date Range') }}</label>
                    <select name="filter_type" id="filter_type" class="form-control">
                        <option value="last_30_days" {{ (request('filter_type') == 'last_30_days' || !request('filter_type')) ? 'selected' : '' }}>{{ __('Last 30 Days') }}</option>
                        <option value="this_week" {{ request('filter_type') == 'this_week' ? 'selected' : '' }}>{{ __('This Week') }}</option>
                        <option value="this_year" {{ request('filter_type') == 'this_year' ? 'selected' : '' }}>{{ __('This Year') }}</option>
                        <option value="custom" {{ request('filter_type') == 'custom' ? 'selected' : '' }}>{{ __('Custom Range') }}</option>
                    </select>
                </div>
                
                <div class="col-md-3 custom-date-range" style="display: none;">
                    <label for="start_date" class="form-label">{{ __('Start Date') }}</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date', $startDate->format('Y-m-d')) }}">
                </div>
                
                <div class="col-md-3 custom-date-range" style="display: none;">
                    <label for="end_date" class="form-label">{{ __('End Date') }}</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date', $endDate->format('Y-m-d')) }}">
                </div>
                
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">{{ __('Filter') }}</button>
                    <button type="submit" name="export_csv" value="1" class="btn btn-success">{{ __('Export CSV') }}</button>
                </div>
            </form>
        </div>
 
         <!-- NEW: Top Level Business Metrics -->
         <div class="row g-4 mb-4">
             <div class="col-xxl-3 col-sm-6">
                 <div class="dashboard__charts padding-20 radius-10 bg-white shadow-sm border-0">
                     <div class="d-flex align-items-center gap-3">
                         <div class="icon-box bg-light-primary radius-5 p-3">
                             <i class="fas fa-chart-line text-primary"></i>
                         </div>
                         <div>
                             <p class="text-muted mb-0">{{ __('Platform GMV') }}</p>
                             <h4 class="fw_bold mb-0">{{ preg_replace('/\.00(?!\d)/', '', float_amount_with_currency_symbol($total_gmv)) }}</h4>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-xxl-3 col-sm-6">
                 <div class="dashboard__charts padding-20 radius-10 bg-white shadow-sm border-0">
                     <div class="d-flex align-items-center gap-3">
                         <div class="icon-box bg-light-success radius-5 p-3">
                             <i class="fas fa-wallet text-success"></i>
                         </div>
                         <div>
                             <p class="text-muted mb-0">{{ __('Comm. Earned') }}</p>
                             <h4 class="fw_bold mb-0">{{ preg_replace('/\.00(?!\d)/', '', float_amount_with_currency_symbol($total_commission)) }}</h4>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-xxl-3 col-sm-6">
                 <div class="dashboard__charts padding-20 radius-10 bg-white shadow-sm border-0">
                     <div class="d-flex align-items-center gap-3">
                         <div class="icon-box bg-light-info radius-5 p-3">
                             <i class="fas fa-check-circle text-info"></i>
                         </div>
                         <div>
                             <p class="text-muted mb-0">{{ __('Success Rate') }}</p>
                             <h4 class="fw_bold mb-0">{{ $success_rate }}%</h4>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-xxl-3 col-sm-6">
                 <div class="dashboard__charts padding-20 radius-10 bg-white shadow-sm border-0">
                     <div class="d-flex align-items-center gap-3">
                         <div class="icon-box bg-light-warning radius-5 p-3">
                             <i class="fas fa-user-tag text-warning"></i>
                         </div>
                         <div>
                             <p class="text-muted mb-0">{{ __('Avg CLV') }}</p>
                             <h4 class="fw_bold mb-0">{{ preg_replace('/\.00(?!\d)/', '', float_amount_with_currency_symbol($avg_clv)) }}</h4>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

        <div class="row g-4">
            
            <!-- Revenue Chart -->
            <div class="col-lg-12">
                <div class="dashboard__charts padding-20 radius-10 bg-white">
                    <div class="dashboard__charts__header flex-between align-items-center">
                        <h4 class="dashboard__charts__title">{{ $revenueChartLabel }} <small class="text-muted">({{ $filterLabel }})</small></h4>
                    </div>
                    <div class="dashboard__charts__inner profile-border-top">
                        <canvas id="revenueChart" style="max-height: 400px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Order Status & Gateway -->
            <div class="col-lg-6">
                <div class="dashboard__charts padding-20 radius-10 bg-white">
                    <div class="dashboard__charts__header flex-between align-items-center">
                        <h4 class="dashboard__charts__title">{{ __('Order Status Distribution') }} <small class="text-muted">({{ $filterLabel }})</small></h4>
                    </div>
                    <div class="dashboard__charts__inner profile-border-top">
                        <canvas id="orderStatusChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="dashboard__charts padding-20 radius-10 bg-white">
                    <div class="dashboard__charts__header flex-between align-items-center">
                        <h4 class="dashboard__charts__title">{{ __('Payment Gateway Usage') }} <small class="text-muted">({{ $filterLabel }})</small></h4>
                    </div>
                    <div class="dashboard__charts__inner profile-border-top">
                        <canvas id="gatewayChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- User Growth -->
            <div class="col-lg-8">
                <div class="dashboard__charts padding-20 radius-10 bg-white">
                    <div class="dashboard__charts__header flex-between align-items-center">
                        <h4 class="dashboard__charts__title">{{ __('User Growth') }} <small class="text-muted">({{ $filterLabel }})</small></h4>
                    </div>
                    <div class="dashboard__charts__inner profile-border-top">
                        <canvas id="userGrowthChart" style="max-height: 350px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Sub vs One-time -->
            <div class="col-lg-4">
                 <div class="dashboard__charts padding-20 radius-10 bg-white">
                    <div class="dashboard__charts__header flex-between align-items-center">
                        <h4 class="dashboard__charts__title">{{ __('Subscription vs Orders') }}</h4>
                    </div>
                    <div class="dashboard__charts__inner profile-border-top">
                        <canvas id="subVsOrderChart" style="max-height: 350px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- NEW: Fraud & Operational Indicators -->
            <div class="col-lg-12">
                <div class="dashboard__charts padding-20 radius-10 bg-white shadow-sm">
                    <div class="dashboard__charts__header flex-between align-items-center mb-3">
                        <h4 class="dashboard__charts__title">{{ __('Business Performance & Fraud Indicators') }}</h4>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-3">
                            <div class="p-4 radius-10 border @if($fast_completions > 0) bg-light-danger @else bg-light @endif">
                                <span class="text-muted d-block mb-1">{{ __('Fast Completions') }}</span>
                                <h3 class="fw_bold @if($fast_completions > 0) text-danger @endif">{{ $fast_completions }}</h3>
                                <small class="text-muted">{{ __('< 1 hour completion time') }}</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-4 radius-10 border bg-light">
                                <span class="text-muted d-block mb-1">{{ __('Cancellation Rate') }}</span>
                                <h3 class="fw_bold">{{ $cancellation_rate }}%</h3>
                                <small class="text-muted">{{ __('Percentage of all orders') }}</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-4 radius-10 border bg-light">
                                <span class="text-muted d-block mb-1">{{ __('Approved Withdrawals') }}</span>
                                <h3 class="fw_bold">{{ $withdrawal_count }}</h3>
                                <small class="text-muted">{{ __('Total processed requests') }}</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-4 radius-10 border bg-light">
                                <span class="text-muted d-block mb-1">{{ __('Total Payouts') }}</span>
                                <h3 class="fw_bold">{{ preg_replace('/\.00(?!\d)/', '', float_amount_with_currency_symbol($total_withdrawals)) }}</h3>
                                <small class="text-muted">{{ __('Total amount withdrawn') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {

                // Filter logic
                const filterType = $('#filter_type');
                const customDateRange = $('.custom-date-range');
                
                function toggleCustomDate() {
                    if (filterType.val() === 'custom') {
                        customDateRange.show();
                    } else {
                        customDateRange.hide();
                    }
                }
                
                filterType.on('change', toggleCustomDate);
                toggleCustomDate(); // Init

                
                // 1. Revenue Chart (Bar)
                new Chart(document.getElementById("revenueChart"), {
                    type: 'bar',
                    data: {
                        labels: @json($months),
                        datasets: [{
                            label: "{{ __('Revenue') }}",
                            backgroundColor: "#6176F6",
                            data: @json($revenueData),
                            barThickness: 20,
                            borderRadius: 4
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: { beginAtZero: true, grid: { borderDash: [2, 2] } },
                            x: { grid: { display: false } }
                        }
                    }
                });

                // 2. Order Status Chart (Pie)
                new Chart(document.getElementById("orderStatusChart"), {
                    type: 'doughnut',
                    data: {
                        labels: @json($chartOrderLabels),
                        datasets: [{
                            data: @json($chartOrderData),
                            backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0", "#9966FF", "#FF9F40", "#C9CBCF", "#FF5B6B"],
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false }
                });

                // 3. Gateway Usage (Pie)
                new Chart(document.getElementById("gatewayChart"), {
                    type: 'pie',
                    data: {
                        labels: @json($gatewayLabels),
                        datasets: [{
                            data: @json($gatewayData),
                            backgroundColor: ["#4BC0C0", "#FF6384", "#36A2EB", "#FF9F40", "#9966FF"],
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false }
                });

                // 4. User Growth (Line)
                new Chart(document.getElementById("userGrowthChart"), {
                    type: 'line',
                    data: {
                        labels: @json($userGrowthLabels),
                        datasets: [{
                            label: "{{ __('New Users') }}",
                            borderColor: "#36A2EB",
                            backgroundColor: "rgba(54, 162, 235, 0.2)",
                            data: @json($userGrowthData),
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: { beginAtZero: true, ticks: { precision: 0 } },
                            x: { grid: { display: false } }
                        }
                    }
                });

                // 5. Subscription vs Orders
                new Chart(document.getElementById("subVsOrderChart"), {
                    type: 'doughnut',
                    data: {
                        labels: ["{{ __('Subscriptions') }}", "{{ __('One-time Orders') }}"],
                        datasets: [{
                            data: [{{ $totalSubscriptions }}, {{ $totalOrders }}],
                            backgroundColor: ["#FFCE56", "#6176F6"],
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false }
                });

            });
        }(jQuery));
    </script>
@endsection
