<table>
    <thead>
        <tr>
            <th>{{ __('Type') }}</th>
            <th>{{ __('Price') }}</th>
            <th>{{ __('Connect') }}</th>
            <th>{{ __('Payment Gateway') }}</th>
            <th>{{ __('Payment Status') }}</th>
            <th>{{ __('Status') }}</th>
            @if(get_static_option('stripe_subscription_enabled') == 'on')
                <th>{{ __('Start Date') }}</th>
            @else
                <th>{{ __('Purchase Date') }}</th>
            @endif
            @if(get_static_option('stripe_subscription_enabled') == 'on')
                <th>{{ __('Next Billing Date') }}</th>
            @else
                <th>{{ __('Expire Date') }}</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @forelse ($all_subscriptions as $sub)
            <tr>
                <td>{{ $sub->subscription?->subscription_type?->type }}</td>
                <td>{{ float_amount_with_currency_symbol($sub->price) }}</td>
                <td>{{ $sub->limit }}</td>
                <td>
                    @if ($sub->payment_gateway == 'manual_payment')
                        {{ ucfirst(str_replace('_', ' ', $sub->payment_gateway)) }}
                    @else
                        {{ $sub->payment_gateway == 'authorize_dot_net' ? __('Authorize.Net') : ucfirst($sub->payment_gateway) }}
                    @endif
                </td>
                <td>
                    @if ($sub->payment_status == '' || $sub->payment_status == 'cancel')
                        <span class="inf-status-badge danger"><span class="dot"></span> {{ __('Cancel') }}</span>
                    @else
                        <span class="inf-status-badge success"><span class="dot"></span>
                            {{ ucfirst($sub->payment_status) }}</span>
                    @endif
                </td>
                <td>
                    @if ($sub->status == 0)
                        <span class="inf-status-badge danger">{{ __('Inactive') }}</span>
                    @elseif($sub->status == 2)
                        <span class="inf-status-badge danger">{{ __('Pending Cancellation') }}</span>
                    @else
                        @if (Carbon\Carbon::parse($sub->expire_date) > Carbon\Carbon::now())
                            <span class="inf-status-badge success">{{ __('Active') }}</span>
                        @else
                            <span class="inf-status-badge warning">{{ __('Expired') }}</span>
                        @endif
                    @endif
                </td>
                @if(get_static_option('stripe_subscription_enabled') == 'on')
                    <td>{{ Carbon\Carbon::parse($sub->start_date)->format('Y-m-d') }}</td>
                @else
                    <td>{{ $sub->created_at->format('Y-m-d') ?? '' }}</td>
                @endif
                <td>{{ Carbon\Carbon::parse($sub->expire_date)->format('Y-m-d') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">
                    <x-frontend.not-found-dash />
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
<div class="deposit-history-pagination mt-4">
    <x-pagination.laravel-paginate :allData="$all_subscriptions" />
</div>
