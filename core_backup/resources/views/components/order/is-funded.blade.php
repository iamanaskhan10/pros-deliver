@if($isFunded == 'complete')
    <span class="inf-tag blue-tag active">{{ __('Funded') }}</span>
@else
    @if($paymentGateway != 'manual_payment' && $isFunded == 'pending')
        <span class="inf-tag warning-tag">{{ __('Payment Failed') }}</span>
    @else
        <span class="inf-tag danger-tag">{{ __('Not Funded') }}</span>
    @endif
@endif
