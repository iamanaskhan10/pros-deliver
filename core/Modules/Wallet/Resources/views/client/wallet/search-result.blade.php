<table>
    <thead>
        <tr>
            <th>{{ __('Payment Gateway') }}</th>
            <th>{{ __('Payment Status') }}</th>
            <th>{{ __('Deposit Amount') }}</th>
            <th>{{ __('Deposit Date') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($all_histories as $history)
            <tr>
                <td>
                    @if ($history->payment_gateway == 'manual_payment')
                        {{ ucfirst(str_replace('_', ' ', $history->payment_gateway)) }}
                    @else
                        {{ $history->payment_gateway == 'authorize_dot_net' ? __('Authorize.Net') : ucfirst($history->payment_gateway) }}
                    @endif
                </td>
                <td>
                    @if ($history->payment_status == '' || $history->payment_status == 'cancel')
                        <span class="inf-status-badge danger">
                            {{ __('Cancel') }}
                        </span>
                    @elseif($history->payment_status == '' || $history->payment_status == 'pending')
                        <span class="inf-status-badge warning">
                            {{ ucfirst($history->payment_status) }}
                        </span>
                    @else
                        <span class="inf-status-badge success">
                            {{ ucfirst($history->payment_status) }}
                        </span>
                    @endif
                </td>
                <td>{{ float_amount_with_currency_symbol($history->amount) }}</td>
                <td>{{ $history->created_at }}</td>
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
<div class="deposit-history-pagination mt-4">
    <x-pagination.laravel-paginate :allData="$all_histories" />
</div>
