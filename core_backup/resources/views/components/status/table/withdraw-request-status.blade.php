<style>
    .alert-success {
        border-color: #f2f2f2;
        border-left: 5px solid #319a31;
        background-color: #f2f2f2;
        color: #333;
        border-radius: 0;
        padding: 5px;
    }

    .alert-danger {
        border-color: #f2f2f2;
        border-left: 5px solid #c69500;
        background-color: #f2f2f2;
        color: #333;
        border-radius: 0;
        padding: 5px;
    }

    .alert-cancel {
        border-color: #f2f2f2;
        border-left: 5px solid #f44336;
        background-color: #f2f2f2;
        color: #333;
        border-radius: 0;
        padding: 5px;
    }
</style>

@if ($status === 1)
    <span class="inf-status-badge warning">
        {{ __('Pending') }}
    </span>
@elseif($status === 2)
    <span class="inf-status-badge success">
        {{ __('Complete') }}
    </span>
@elseif($status === 3)
    <span class="inf-status-badge danger">
        {{ __('Cancel') }}
    </span>
@elseif($status === 4)
    <span class="inf-status-badge info">
        {{ __('Processing') }}
    </span>
@endif
