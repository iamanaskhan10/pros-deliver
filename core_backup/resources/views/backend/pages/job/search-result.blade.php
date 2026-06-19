<x-validation.error />
<table class="DataTable_activation">
    <thead>
    <tr>
        <th>{{__('ID')}}</th>
        <th>{{__('Campaign Title')}}</th>
        <th>{{__('Status (change by admin)')}}</th>
        <th>{{__('Action')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($all_jobs as $job)
        <tr>
            <td>{{ $job->id }}</td>
            <td>
                {{ $job->title }} <br>
            </td>
            <td>
                <x-status.table.active-inactive :status="$job->status"/>
            </td>
            <td>
                <x-status.table.select-action :title="__('Select Action')"/>
                <ul class="dropdown-menu status_dropdown__list">
                    @can('campaign-details')
                    <li class="status_dropdown__item">
                        <a href="{{ route('admin.job.details',$job->id) }}" class="btn dropdown-item status_dropdown__list__link">{{ __('Campaign Details') }}</a>
                    </li>
                    @endcan
                    @can('campaign-delete')
                    <li class="status_dropdown__item">
                        <x-popup.delete-popup :title="__('Delete Campaign')" :url="route('admin.job.delete',$job->id)"/>
                    </li>
                    @endcan
                    @can('campaign-status-change')
                    <li class="status_dropdown__item">
                        @if($job->status === 0)
                            <x-status.table.status-change :title="__('Approve Campaign')" :url="route('admin.job.status.change',$job->id)"/>
                        @else
                            <x-status.table.status-change :title="__('Inactivate Campaign')" :url="route('admin.job.status.change',$job->id)"/>
                        @endif
                    </li>
                    @endcan
                </ul>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<x-pagination.laravel-paginate :allData="$all_jobs"/>
