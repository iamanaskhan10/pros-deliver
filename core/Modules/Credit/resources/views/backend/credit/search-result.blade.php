<x-validation.error/>
<table class="DataTable_activation">
    <thead>
    <tr>
        <th>{{__('ID')}}</th>
        <th>{{__('User Details')}}</th>
        <th>{{ __('Payment Gateway') }}</th>
        <th>{{__('Payment Status')}}</th>
        <th>{{ __('Credits') }}</th>
        <th>{{__('Manual Payment Image')}}</th>
        <th>{{ __('Deposit Date') }}</th>
        <th>{{ __('Action') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($all_histories as $history)
        <tr>
            <td>{{ $history->id }}</td>
            <td>
                <p><strong>{{ __('Name:') }}</strong>{{ $history->user?->first_name .' '.$history->user?->last_name }}</p>
                <p><strong>{{ __('Email:') }}</strong>{{ $history->user?->email }}</p>
                <p><strong>{{ __('Phone:') }}</strong>{{ $history->user?->phone }}</p>
                <p>
                    <strong>{{ __('Verified Status:') }}</strong>
                    <x-status.table.verified-status :status="$history->user?->user_verified_status"/>
                </p>
            </td>
            <td>
                @if($history->payment_gateway == 'manual_payment')
                    {{ ucfirst(str_replace('_',' ',$history->payment_gateway)) }}
                @else
                    {{ $history->payment_gateway == 'authorize_dot_net' ? __('Authorize.Net') : ucfirst($history->payment_gateway) }}
                @endif
            </td>
            <td>
                @if($history->payment_status == '' || $history->payment_status == 'cancel')
                    <span class="btn btn-danger btn-sm">{{ __('Cancel') }}</span>
                @else
                     <span class="btn btn-success btn-sm">{{ ucfirst(__($history->payment_status)) }}</span>
                    @if($history->payment_status == 'pending')
                        <x-status.table.status-change :title="__('Change Status')" :class="'btn btn-danger credit_history_status_change'" :url="route('admin.credit.history.status',$history->id)"/>
                    @endif
                @endif
            </td>
            <td>{{ $history->credits }}</td>
            <td>
                <span class="img_100">
                    @if(empty($history->manual_payment_image))
                        <img src="{{ asset('assets/static/img/no_image.png') }}" alt="">
                    @else
                        @php
                            $ext = pathinfo($history->manual_payment_image, PATHINFO_EXTENSION);
                        @endphp
                        @if($ext == 'pdf')
                            <a href="{{ asset('assets/uploads/manual-payment/'.$history->manual_payment_image) }}" target="_blank">
                                <i class="fas fa-file-pdf fa-3x text-danger"></i>
                            </a>
                        @else
                            <img src="{{ asset('assets/uploads/manual-payment/'.$history->manual_payment_image) }}" alt="">
                        @endif
                    @endif
                </span>
            </td>
            <td>{{ $history->created_at }}</td>
            <td>
                @can('credit-history-details')
                <a class="btn btn-sm btn-primary" href="{{ route('admin.credit.history.details',$history->id) }}">{{ __('View Details') }}</a>
                @endcan
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<x-pagination.laravel-paginate :allData="$all_histories"/>
