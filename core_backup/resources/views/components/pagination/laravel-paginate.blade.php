<div class="custom_pagination mt-5" data-route="{{ $route ?? '' }}">
    @if ($allData->hasPages())
        <div class="entries-wraper">
            <span>{{ __('Showing') }}</span>
            <span class="entries_number">
                {{ $allData->firstItem() ?? 0 }} {{ __('to') }} {{ $allData->lastItem() ?? 0 }} {{ __('of') }}
                {{ $allData->total() }}
            </span>
            <span>{{ __('Entries') }}</span>
        </div>
        {{ $allData->links() }}
    @endif
</div>
