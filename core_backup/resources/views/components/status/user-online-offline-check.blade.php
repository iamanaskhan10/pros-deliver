@if(Cache::has('user_is_online_'.$userID))
    <span class="status-icon online"></span>
@else
    <span class="status-icon offline"></span>
@endif