@if($status === 1)
    <span class="job-progress">{{ __('Active Order') }}</span>
@else
    @if($status === 0)
        <span class="inf-tag">{{ __('Queue Order') }}</span>
    @endif
    @if($status === 2)
        <span class="inf-tag">{{ __('Deliver Order') }}</span>
    @endif
    @if($status=== 3)
        <span class="inf-tag">{{ __('Complete Order') }}</span>
    @endif
    @if($status === 4)
         <span class="inf-tag">{{ __('Cancel Order') }}</span>
    @endif
    @if($status === 5)
         <span class="inf-tag">{{ __('Decline Order') }}</span>
    @endif
    @if($status === 6)
         <span class="inf-tag">{{ __('Suspend Order') }}</span>
    @endif
    @if($status === 7)
        <span class="inf-tag">{{ __('Hold Order') }}</span>
    @endif
@endif
