<x-validation.error />
<table class="DataTable_activation">
    <thead>
    <tr>
        <th>{{__('ID')}}</th>
        <th>{{__('Portfolio Title')}}</th>
        <th>{{__('Status (change by admin)')}}</th>
        <th>{{__('Action')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($all_portfolios as $portfolio)
        <tr>
            <td>{{ $portfolio->id }}</td>
            <td>
                {{ $portfolio->title }} <br>
            </td>
            <td>
                <x-status.table.active-inactive :status="$portfolio->status"/>
            </td>
            <td>
                <x-status.table.select-action :title="__('Select Action')"/>
                <ul class="dropdown-menu status_dropdown__list">
                    @can('campaign-details')
                        <li class="status_dropdown__item">
                            <a href="{{ route('admin.job.details',$portfolio->id) }}" class="btn dropdown-item status_dropdown__list__link">{{ __('Campaign Details') }}</a>
                        </li>
                    @endcan
                    @can('campaign-delete')
                        <li class="status_dropdown__item">
                            <x-popup.delete-popup :title="__('Delete Portfolio')" :url="route('admin.portfolio.delete',$portfolio->id)"/>
                        </li>
                    @endcan
                    @can('campaign-status-change')
                        <li class="status_dropdown__item">
                            @if($portfolio->status === 0)
                                <x-status.table.status-change :title="__('Approve Campaign')" :url="route('admin.portfolio.status.change',$portfolio->id)"/>
                            @else
                                <x-status.table.status-change :title="__('Inactivate Campaign')" :url="route('admin.portfolio.status.change',$portfolio->id)"/>
                            @endif
                        </li>
                    @endcan
                </ul>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<x-pagination.laravel-paginate :allData="$all_portfolios"/>
