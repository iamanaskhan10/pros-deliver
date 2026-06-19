<table>
    <thead>
        <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Title') }}</th>
            <th>{{ __('Priority') }}</th>
            <th>{{ __('Status') }}</th>
            <th>{{ __('Action') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->title }}</td>
                <td>{{ $ticket->priority }}</td>
                <td>
                    @if ($ticket->status === 'open')
                        <span class="inf-status-badge success">
                            {{ __('Open') }}
                        </span>
                    @else
                        <span class="inf-status-badge danger">
                            {{ __('Close') }}
                        </span>
                    @endif
                </td>
                <td>
                    <a class="btn-sm btn-profile btn-bg-1"
                        href="{{ route('influencer.ticket.details', $ticket->id) }}">{{ __('View Details') }}</a>
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
<div class="deposit-history-pagination mt-4">
    <x-pagination.laravel-paginate :allData="$tickets" />
</div>
