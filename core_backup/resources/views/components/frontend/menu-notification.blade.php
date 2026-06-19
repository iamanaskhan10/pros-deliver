@if (Auth::guard('web')->user()->user_type == 1)
    @php
        $client_notifications = \App\Models\ClientNotification::where('client_id', Auth::guard('web')->user()->id)->latest()->take(100)->get();
        $client_new_notifications = \App\Models\ClientNotification::where('is_read', 'unread')->where('client_id', Auth::guard('web')->user()->id)->latest()->count();
    @endphp
    <div class="navbar-right-item">
        <div class="navbar-right-notification">
            <a href="javascript:void(0)" class="navbar-right-notification-icon">
                <i class="fa-regular fa-bell"></i>
                @if ($client_new_notifications > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $client_new_notifications ?? 0 }}</span>
                @endif
            </a>
            <div class="navbar-right-notification-wrapper">
                <div class="navbar-right-notification-wrapper-list">
                    @if ($client_notifications->count() > 0)
                        @foreach ($client_notifications as $notification)
                            <span href="javascript:void(0)"
                                  class="navbar-right-notification-wrapper-list-item click-notification">
                                <div class="navbar-right-notification-wrapper-list-item-left">
                                    <div class="navbar-right-notification-wrapper-list-item-icon decline">
                                        @if($notification->is_read == 'read')
                                            <i class="fa-regular fa-bell opacity-25 pe-none"></i>
                                        @else
                                            <i class="fa-regular fa-bell"></i>
                                        @endif
                                    </div>
                                </div>
                                <div class="navbar-right-notification-wrapper-list-item-content">
                                    @if ($notification->type == 'Offer')
                                        <a
                                                href="{{ route('client.offer.details', $notification->identity) }}?mark_as_read=true">
                                            <span
                                                    class="navbar-right-notification-wrapper-list-item-content-title">{{ __($notification->message) }}</span>
                                        </a>
                                        <span
                                                class="navbar-right-notification-wrapper-list-item-content-time">{{ $notification->created_at->toFormattedDateString() }}</span>
                                    @endif
                                    @if ($notification->type == 'Proposal')
                                        <a
                                                href="{{ route('client.job.proposal.details', $notification->identity) }}?mark_as_read=true">
                                            <span
                                                    class="navbar-right-notification-wrapper-list-item-content-title">{{ __($notification->message) }}</span>
                                        </a>
                                        <span
                                                class="navbar-right-notification-wrapper-list-item-content-time">{{ $notification->created_at->toFormattedDateString() }}</span>
                                    @endif
                                    @if ($notification->type == 'Order')
                                        <a
                                                href="{{ route('client.order.details', $notification->identity) }}?mark_as_read=true">
                                            <span
                                                    class="navbar-right-notification-wrapper-list-item-content-title">{{ __($notification->message) }}</span>
                                        </a>
                                        <span
                                                class="navbar-right-notification-wrapper-list-item-content-time">{{ $notification->created_at->toFormattedDateString() }}</span>
                                    @endif
                                    @if ($notification->type == 'Job')
                                        <a
                                                href="{{ route('client.job.details', $notification->identity) }}?mark_as_read=true">
                                            <span
                                                    class="navbar-right-notification-wrapper-list-item-content-title">{{ __($notification->message) }}</span>
                                        </a>
                                        <span
                                                class="navbar-right-notification-wrapper-list-item-content-time">{{ $notification->created_at->toFormattedDateString() }}</span>
                                    @endif
                                    @if ($notification->type == 'Ticket Update' || $notification->type == 'Ticket')
                                        <a href="{{ route('client.ticket.details',$notification->identity) }}?mark_as_read=true">
                                        <span class="navbar-right-notification-wrapper-list-item-content-title">{{ __($notification->message) }}</span>
                                    </a>
                                        <span class="navbar-right-notification-wrapper-list-item-content-time">{{ $notification->created_at->toFormattedDateString() }}</span>
                                    @endif
                                    @if ($notification->type == 'Subscription')
                                        <a href="{{ route('client.subscriptions.all') }}?mark_as_read=true">
                                        <span class="navbar-right-notification-wrapper-list-item-content-title">{{ __($notification->message) }}</span>
                                        </a>
                                        <span class="navbar-right-notification-wrapper-list-item-content-time">{{ $notification->created_at->toFormattedDateString() }}</span>
                                    @endif
                                    @if ($notification->type == 'Deposit')
                                        <a href="{{ route('client.wallet.history') }}?mark_as_read=true">
                                        <span class="navbar-right-notification-wrapper-list-item-content-title">{{ __($notification->message) }}</span>
                                        </a>
                                        <span class="navbar-right-notification-wrapper-list-item-content-time">{{ $notification->created_at->toFormattedDateString() }}</span>
                                    @endif
                                </div>
                            </span>
                        @endforeach
                    @else
                        <a href="javascript:void(0)"
                           class="navbar-right-notification-wrapper-list-item click-notification">
                            <div class="navbar-right-notification-wrapper-list-item-left">
                                <div class="navbar-right-notification-wrapper-list-item-icon decline">
                                    <i class="fa-regular fa-bell"></i>
                                </div>
                            </div>
                            <div class="navbar-right-notification-wrapper-list-item-content">
                                <span class="navbar-right-notification-wrapper-list-item-content-title">
                                    <strong>{{ __('No Notification') }}</strong>
                                </span>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@else
    @php
        $freelancer_notifications = \App\Models\FreelancerNotification::where('freelancer_id', Auth::guard('web')->user()->id)->latest()->take(100)->get();
         $freelancer_new_notifications = \App\Models\FreelancerNotification::where('is_read', 'unread')->where('freelancer_id', Auth::guard('web')->user()->id)->latest()->count();
    @endphp
    <div class="navbar-right-item">
        <div class="navbar-right-notification">
            <a href="javascript:void(0)" class="navbar-right-notification-icon">
                <i class="fa-regular fa-bell"></i>
                @if ($freelancer_new_notifications > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $freelancer_new_notifications ?? 0 }}</span>
                @endif
            </a>
            <div class="navbar-right-notification-wrapper">
                <div class="navbar-right-notification-wrapper-list">
                    @if ($freelancer_notifications->count() > 0)
                        @foreach ($freelancer_notifications as $notification)
                            <span href="javascript:void(0)"
                                  class="navbar-right-notification-wrapper-list-item click-notification">
                                <div
                                        class="navbar-right-notification-wrapper-list-item-left show_and_read_freelancer_notification">
                                    <div class="navbar-right-notification-wrapper-list-item-icon decline">
                                        @if($notification->is_read == 'read')
                                            <i class="fa-regular fa-bell opacity-25 pe-none"></i>
                                        @else
                                            <i class="fa-regular fa-bell"></i>
                                        @endif
                                    </div>
                                </div>
                                <div class="navbar-right-notification-wrapper-list-item-content">

                                    @if ($notification->type == 'Offer')
                                        <a
                                                href="{{ route('influencer.offer.details', $notification->identity) }}">
                                            <span
                                                    class="navbar-right-notification-wrapper-list-item-content-title">{{ __($notification->message) }}</span>
                                        </a>
                                        <span
                                                class="navbar-right-notification-wrapper-list-item-content-time">{{ $notification->created_at->toFormattedDateString() }}</span>
                                    @endif

                                    @if ($notification->type == 'Order')
                                        <a
                                                href="{{ route('influencer.order.details', $notification->identity) }}?mark_as_read=true">
                                            <span
                                                    class="navbar-right-notification-wrapper-list-item-content-title">{{ __($notification->message) }}</span>
                                        </a>
                                        <span
                                                class="navbar-right-notification-wrapper-list-item-content-time">{{ $notification->created_at->toFormattedDateString() }}</span>
                                    @endif

                                    @if ($notification->type == 'Withdraw')
                                        <a href="{{ route('influencer.wallet.withdraw.history') }}">
                                            <span
                                                    class="navbar-right-notification-wrapper-list-item-content-title">{{ __($notification->message) }}</span>
                                        </a>
                                        <span
                                                class="navbar-right-notification-wrapper-list-item-content-time">{{ $notification->created_at->toFormattedDateString() }}</span>
                                    @endif

                                    @if ($notification->type == 'Reject Project')
                                        <a href="{{ route('influencer.profile.details',Auth::guard('web')->user()->username) }}?mark_as_read=true">
                                            <span class="navbar-right-notification-wrapper-list-item-content-title">{{ __($notification->message) }}</span>
                                        </a>
                                        <span class="navbar-right-notification-wrapper-list-item-content-time">{{ $notification->created_at->toFormattedDateString() }}</span>
                                    @endif
                                    @if ($notification->type == 'Activate Project' || $notification->type == 'Inactivate Project' || $notification->type == 'Project' || $notification->type == 'Profile')
                                        <a href="{{ route('influencer.profile.details',Auth::guard('web')->user()->username) }}?mark_as_read=true">
                                            <span class="navbar-right-notification-wrapper-list-item-content-title">{{ __($notification->message) }}</span>
                                        </a>
                                        <span class="navbar-right-notification-wrapper-list-item-content-time">{{ $notification->created_at->toFormattedDateString() }}</span>
                                    @endif
                                    @if ($notification->type == 'Email Verify')
                                        <a href="javascript:void(0)">
                                        <span class="navbar-right-notification-wrapper-list-item-content-title">{{ __($notification->message) }}</span>
                                    </a>
                                        <span class="navbar-right-notification-wrapper-list-item-content-time">{{ $notification->created_at->toFormattedDateString() }}</span>
                                    @endif
                                    @if ($notification->type == 'Account')
                                        <a href="javascript:void(0)">
                                                <span class="navbar-right-notification-wrapper-list-item-content-title">{{ __($notification->message) }}</span>
                                            </a>
                                        <span class="navbar-right-notification-wrapper-list-item-content-time">{{ $notification->created_at->toFormattedDateString() }}</span>
                                    @endif
                                    @if ($notification->type == 'Identity Verify')
                                        <a href="javascript:void(0)">
                                                <span class="navbar-right-notification-wrapper-list-item-content-title">{{ __($notification->message) }}</span>
                                            </a>
                                        <span class="navbar-right-notification-wrapper-list-item-content-time">{{ $notification->created_at->toFormattedDateString() }}</span>
                                    @endif
                                    @if ($notification->type == 'New Job')
                                        @php $job_details = \App\Models\JobPost::select('id','user_id','slug')->where('id', $notification->identity)->first() @endphp
                                        <a href="{{ route('job.details', ['username' => $job_details->job_creator?->username, 'slug' => $job_details->slug]) }}">
                                            <span class="navbar-right-notification-wrapper-list-item-content-title">{{ __($notification->message) }}</span>
                                        </a>
                                        <span class="navbar-right-notification-wrapper-list-item-content-time">{{ $notification->created_at->toFormattedDateString() }}</span>
                                    @endif
                                    @if ($notification->type == 'Ticket Update' || $notification->type == 'Ticket')
                                        <a href="{{ route('influencer.ticket.details',$notification->identity) }}">
                                            <span class="navbar-right-notification-wrapper-list-item-content-title">{{ __($notification->message) }}</span>
                                        </a>
                                        <span class="navbar-right-notification-wrapper-list-item-content-time">{{ $notification->created_at->toFormattedDateString() }}</span>
                                    @endif
                                    @if ($notification->type == 'Subscription')
                                        <a href="{{ route('influencer.subscriptions.all') }}?mark_as_read=true">
                                                    <span class="navbar-right-notification-wrapper-list-item-content-title">{{ __($notification->message) }}</span>
                                                </a>
                                        <span class="navbar-right-notification-wrapper-list-item-content-time">{{ $notification->created_at->toFormattedDateString() }}</span>
                                    @endif
                                    @if ($notification->type == 'Deposit')
                                        <a href="{{ route('influencer.wallet.history') }}?mark_as_read=true">
                                                <span class="navbar-right-notification-wrapper-list-item-content-title">{{ __($notification->message) }}</span>
                                                </a>
                                        <span class="navbar-right-notification-wrapper-list-item-content-time">{{ $notification->created_at->toFormattedDateString() }}</span>
                                    @endif
                                </div>
                            </span>
                        @endforeach
                    @else
                        <a href="javascript:void(0)"
                           class="navbar-right-notification-wrapper-list-item click-notification">
                            <div class="navbar-right-notification-wrapper-list-item-left">
                                <div class="navbar-right-notification-wrapper-list-item-icon decline">
                                    <i class="fa-regular fa-bell"></i>
                                </div>
                            </div>
                            <div class="navbar-right-notification-wrapper-list-item-content">
                                <span class="navbar-right-notification-wrapper-list-item-content-title">
                                    <strong>{{ __('No Notification') }}</strong>
                                </span>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif