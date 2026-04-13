<x-validation.error />
<table class="DataTable_activation">
    <thead>
        <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Title') }}</th>
            <th>{{ __('Status (change by admin)') }}</th>
            <th>{{ __('Report Create Date') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($reports as $report)
            <tr>
                <td>{{ $report->id }}</td>
                <td>{{ $report->title }}</td>
                <td>
                    @if ($report->status == 0)
                        <span class="inf-status-badge warning"> {{ __('In Review') }}</span>
                    @elseif($report->status == 1)
                        <span class="inf-status-badge success"> {{ __('Closed') }}</span>
                    @else
                        <span class="inf-status-badge danger"> {{ __('Rejected') }}</span>
                    @endif
                </td>
                <td>{{ $report->created_at->toFormattedDateString() }}</td>
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
<x-pagination.laravel-paginate :allData="$reports" />
