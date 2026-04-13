<div class="tab-content-item active mt-5" id="proposals">
    <div class="myJob-wrapper">
        @if ($job_details->job_proposals->count() > 0)
            @foreach ($job_details->job_proposals as $proposal)
                <div class="myJob-wrapper-single border-all">
                    {!! freelancer_skill_match_with_job_skill($proposal->freelancer_id, $job_details->id) !!}
                    <div class="myJob-wrapper-single-flex flex-between align-items-center">
                        <div class="myJob-wrapper-single-contents">
                            <div class="influencer-info-wraper">
                                <div class="project-owner influencer-info">
                                    <div class="left-part">
                                        <div class="inf-img">
                                            @if ($proposal->freelancer->image)
                                                <img src="{{ asset('assets/uploads/profile/' . $proposal->freelancer->image) }}"
                                                    alt="{{ __('profile img') }}">
                                            @else
                                                <img src="{{ asset('assets/static/img/author/author.jpg') }}"
                                                    alt="{{ __('profile img') }}">
                                            @endif
                                            <x-status.user-online-offline-check :userID="$proposal->freelancer->id" />
                                        </div>
                                    </div>
                                    <div class="right-part">
                                        <div class="right-top d-flex gap-4">
                                            <div class="name lg-font fw_semibold black_text">
                                                {{ $proposal->freelancer->full_name }}
                                                @if ($proposal->freelancer->user_verified_status == 1)
                                                    <span data-toggle="tooltip" data-placement="top"
                                                        title="{{ __('User Verified') }}">
                                                        <i class="si si-varified green_text"></i>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        @if ($proposal->freelancer->user_country?->country)
                                            <div class="location-wraper ">
                                                <span class="icon primary_text">
                                                    <i class="si si-location"></i>
                                                </span>
                                                <span class="location sm-font">
                                                    @if ($proposal->freelancer?->user_state?->state != null)
                                                        {{ optional($proposal->freelancer->user_state)->state }},
                                                    @endif
                                                    {{ optional($proposal->freelancer->user_country)->country }}
                                                </span>
                                            </div>
                                        @endif
                                        <div class="right-bottom">
                                            <div class="raitng-wraper fw_semibold">
                                                {!! freelancer_rating($proposal->freelancer->id) !!}
                                            </div>
                                            @php
                                                $social_profiles = \App\Models\SocialProfile::where(
                                                    'user_id',
                                                    $proposal->freelancer?->id,
                                                )->get();
                                                $total_followers = $social_profiles->reduce(function (
                                                    $carry,
                                                    $profile,
                                                ) {
                                                    return $carry + parseFollowers($profile->followers);
                                                }, 0);
                                            @endphp
                                            <div class="social-icon-wraper">
                                                @foreach ($social_profiles as $profile)
                                                    <div class="social-icon">
                                                        <a href="{{ $profile->profile_link }}">
                                                            <i class="{{ $profile->platform_icon }}"></i>
                                                        </a>
                                                        <span>{{ $profile->followers }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="myJob-wrapper-single-arrow">
                            <div class="job-proposal-btn">
                                <div class="job-proposal-btn-item">
                                    <x-job.job-proposal-view :isView="$proposal->is_view" />
                                </div>
                                <div class="job-proposal-btn-item">
                                    <x-job.hire-short-list-check :isHired="$proposal->is_hired" :isShortListed="$proposal->is_short_listed" />
                                </div>
                                <div class="job-proposal-btn-item">
                                    <p class="jobFilter-proposal-author-contents-time">
                                        {{ $proposal->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="jobFilter-proposal-offered profile-border-top">
                        <div class="jobFilter-proposal-offered-single">
                            <span class="offered">{{ __('Offered') }}
                                <span
                                    class="offered-price">{{ float_amount_with_currency_symbol($proposal->amount) }}</span>
                            </span>
                        </div>
                        <div class="jobFilter-proposal-offered-single">
                            <span class="offered">{{ __('Est. delivery duration') }} <span
                                    class="offered-days">{{ $proposal->duration }}</span> </span>
                        </div>
                        @if ($job_details->type == 'hourly')
                            <div class="jobFilter-proposal-offered-single">
                                <span class="offered">{{ __(ucfirst($job_details->type)) }}
                                    <span
                                        class="offered-price">{{ float_amount_with_currency_symbol($job_details->hourly_rate) }}</span>
                                </span>
                            </div>
                        @endif
                        @if ($job_details->type == 'hourly')
                            <div class="jobFilter-proposal-offered-single">
                                <span class="offered">{{ __('Estimated hour') }}
                                    <span class="offered-price">{{ $job_details->estimated_hours ?? '' }}</span>
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="flex-between profile-border-top">
                        <div class="btn-wrapper rejected_interview_location_{{ $proposal->id }}">
                            <div class="btn-wrapper flex-btn gap-2">
                                @if ($proposal->is_rejected == 1)
                                    <a href="javascript:void(0)"
                                        class="btn-profile btn-outline-gray">{{ __('Rejected') }}</a>
                                @else
                                    <a href="javascript:void(0)"
                                        class="btn-profile btn-outline-gray btn-hover-danger reject_proposal"
                                        data-proposal-id="{{ $proposal->id }}">{{ __('Reject') }}</a>
                                    <a href="javascript:void(0)"
                                        class="btn-profile btn-bg-1 click-interview take_freelancer_interview"
                                        data-job-id="{{ $job_details->id }}" data-proposal-id="{{ $proposal->id }}"
                                        data-freelancer-id="{{ $proposal->freelancer_id }}"
                                        data-job-title="{{ $job_details->title }}"
                                        data-job-level="{{ $job_details->level }}"
                                        data-job-type="{{ $job_details->type }}"
                                        data-job-create-date="{{ $job_details->created_at }}">
                                        @if ($proposal->is_interview_take == 1)
                                            {{ __('Interviewed') }}
                                        @else
                                            {{ __('Take Interview') }}
                                        @endif
                                    </a>
                                @endif

                                @if ($job_details->type == 'hourly')
                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                        data-bs-target="#RateAndHoursModal"
                                        class="btn-profile btn-bg-1">{{ __('Update Hourly Rate') }}</a>
                                @endif
                            </div>
                        </div>
                        <div class="btn-wrapper flex-btn gap-2 add_remove_interview_location_{{ $proposal->id }}">
                            @if ($proposal->is_rejected == 0)
                                <a href="javascript:void(0)"
                                    class="btn-profile btn-outline-gray loadingRound add_remove_shortlist"
                                    data-proposal-id="{{ $proposal->id }}">
                                    @if ($proposal->is_short_listed == 0)
                                        <span class="add_to_short_listed">{{ __('Add to Shortlist') }}</span>
                                    @else
                                        <span class="remove_from_short_listed">{{ __('Remove from Shortlist') }}</span>
                                    @endif
                                </a>
                            @endif
                            <a href="{{ route('client.job.proposal.details', $proposal->id) }}" target="_blank"
                                class="btn-profile btn-bg-1">{{ __('View Proposal') }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <x-frontend.not-found-dash />
        @endif

    </div>
</div>
