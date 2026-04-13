<x-validation.error />
<table class="DataTable_activation">
    <thead>
    <tr>
        <th>{{__('ID')}}</th>
        <th>{{__('Campaign ID')}}</th>
        <th>{{__('Campaign Title')}}</th>
        <th>{{__('Status (change by admin)')}}</th>
        <th>{{__('Total Reject')}}</th>
        <th>{{__('Total Edit')}}</th>
        <th>{{__('Action')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($all_histories as $history)
        <tr>
            <td>{{ $history->id }}</td>
            <td>{{ $history->job?->id }}</td>
            <td>{{ $history->job?->title }}</td>
            <td><x-status.table.active-inactive :status="$history->job?->status"/></td>
            <td>{{ $history->reject_count }}</td>
            <td>{{ $history->edit_count }}</td>
            <td>
                @can('campaign-details')
                <a target="_blank" href="{{ route('admin.job.details',$history->job_id) }}" class="btn-bg-1 btn-profile">{{ __('Campaign Details') }}</a>
                @endcan
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<x-pagination.laravel-paginate :allData="$all_histories"/>
