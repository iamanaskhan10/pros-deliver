@extends('frontend.layout.master')
@section('site_title', __('Profile Details'))
@section('style')
    <style>
        .icon-rocket {
            color: #ff5b6b;
            font-size: 16px;
        }

        .icon-bullhorn {
            color: #ff5b6b;
            font-size: 16px;
            animation: bullhornShake 0.5s infinite;
            display: inline-block;
        }

        @keyframes bullhornShake {
            0% {
                transform: rotate(-20deg) translateX(0);
            }

            20% {
                transform: rotate(-15deg) translateX(-1px);
            }

            40% {
                transform: rotate(-25deg) translateX(1px);
            }

            60% {
                transform: rotate(-15deg) translateX(-1px);
            }

            80% {
                transform: rotate(-25deg) translateX(1px);
            }

            100% {
                transform: rotate(-20deg) translateX(0);
            }
        }
    </style>
    <x-select2.select2-css />
@endsection
@section('content')
    <main>
        <!-- Profile area Starts -->
        <div class="influencer page-wraper pat-80 pab-120">
            <div class="container">
                <div class="influencer-content-wrapper">
                    <div class="title-part-wraper">
                        <h2 class="inf-title title4 black_text fw_bold">{{ __('Influencer Details') }}</h2>
                        @if (Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 1)
                            <div class="btn-wraper">
                                <form action="{{ route('client.message.send') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="freelancer_id" id="freelancer_id" value="{{ $user->id }}">
                                    <input type="hidden" name="from_user" id="from_user" value="1">
                                    <input type="hidden" name="interview_message" id="interview_message" value="{{ __('Hello') }}">
                                    <button type="submit" class="inf-cmn-btn style2 inf-primary-btn w-100">
                                        {{ __('Contact me') }}</button>
                                </form>
                            </div>
                        @endif
                    </div>

                    @php
                        // Variable definition for Earnings Logic
                        $profileUser = \App\Models\User::where('username', $username)->first();

                        // 1. Determine if earnings are globally allowed by Admin
                        // If admin enables it, we default to showing (true), unless explicitly hidden by user
                        if (get_static_option('user_earning_toggle') == 'enable') {
                            $showEarning = $profileUser->user_earning->show_earning ?? 1;
                        } else {
                            $showEarning = 0;
                        }

                        // 2. Check if this is the user's own profile
                        // (Retained for future use as requested, but not blocking display currently)
                        $isOwnProfile =
                            Auth::guard('web')->check() &&
                            Auth::guard('web')->user()->user_type == 2 &&
                            Auth::guard('web')->user()->username == $username;

                        // 3. Fetch the earning amount
                        $amount = $profileUser->user_earning->total_earning ?? 0;
                    @endphp

                    <div class="influencer-details-part-wraper">
                        <div class="top-part d-block">
                            @if(moduleExists('PromoteInfluencer'))
                                @php
                                    $current_date = \Carbon\Carbon::now()->toDateTimeString();
                                    $is_promoted = \Modules\PromoteInfluencer\Entities\PromotionProjectList::where(
                                        'identity',
                                        $user->id,
                                    )
                                        ->where('type', 'profile')
                                        ->where('expire_date', '>', $current_date)
                                        ->where('payment_status', 'complete')
                                        ->first();
                                @endphp
                            @endif

                            <div class="d-flex justify-content-between gap-4 flex-wrap">
                                <div class="influencer-info-wraper">
                                    <div class="project-owner influencer-info">
                                        <div class="left-part">
                                            <div class="inf-img">
                                                @php
                                                    $filePath = $user->image ? 'assets/uploads/profile/' . $user->image : null;
                                                    $extension = pathinfo($user->image ?? '', PATHINFO_EXTENSION);
                                                    $isVideo = in_array(strtolower($extension), ['mp4', 'webm', 'avi', 'mov']);
                                                @endphp

                                                @if ($user->image)
                                                    @if ($isVideo)
                                                        <video src="{{ asset($filePath) }}" muted loop preload="metadata"
                                                               class="profile-video" onmouseover="this.play()"
                                                               onmouseout="this.pause(); this.currentTime=0;">
                                                        </video>
                                                    @else
                                                        <img src="{{ asset($filePath) }}" alt="{{ __('profile img') }}">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('assets/static/img/author/author.jpg') }}" alt="{{ __('profile img') }}">
                                                @endif

                                                <x-status.user-online-offline-check :userID="$user->id" />
                                            </div>
                                        </div>

                                        <div class="right-part">
                                            <div class="right-top d-flex gap-4">
                                                <div class="name lg-font fw_semibold black_text">
                                                    {{ $user->full_name }}
                                                    @if ($user->user_verified_status == 1)
                                                        <span data-toggle="tooltip" data-placement="top" title="{{ __('User Verified') }}">
                                                            <i class="si si-varified green_text"></i>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            @if ($user->user_state?->state || $user->user_country?->country)
                                                <div class="location-wraper ">
                                                    <span class="icon primary_text"><i class="si si-location"></i></span>
                                                    <span class="location sm-font">
                                                        @if ($user?->user_state?->state != null)
                                                            {{ optional($user->user_state)->state }},
                                                        @endif
                                                        {{ optional($user->user_country)->country }}
                                                    </span>
                                                </div>
                                            @endif
                                            <div class="right-bottom">
                                                <div class="raitng-wraper fw_semibold">
                                                    {!! freelancer_rating($user->id) !!}
                                                </div>
                                                <div class="social-icon-wraper flex-column">
                                                    @if(moduleExists('Credit'))
                                                        @if(is_influencer_unlocked($user->id))
                                                            <div class="d-flex social-icon-inner-wraper">
                                                                @foreach ($social_profiles as $profile)
                                                                    <div class="social-icon">
                                                                        <a href="{{ $profile->profile_link }}">
                                                                            <i class="{{ $profile->platform_icon }}"></i>
                                                                        </a>
                                                                        <span>{{ $profile->followers }}</span>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @else
                                                            <div class="unlock-social-wraper">
                                                                @if(Auth::guard('web')->check())
                                                                    @if(Auth::guard('web')->user()->user_type == 1)
                                                                        <a href="javascript:void(0)"
                                                                           class="btn btn-warning btn-sm py-1 px-3 unlock_social_btn"
                                                                           data-bs-toggle="modal"
                                                                           data-bs-target="#unlockSocialModal"
                                                                           data-influencer_id="{{ $user->id }}"
                                                                           data-credits_required="{{ get_static_option('influencer_credits_per_unlock', 1) }}"
                                                                           data-balance="{{ Auth::guard('web')->user()?->getCreditBalanceAttribute() ?? 0 }}">
                                                                            <i class="fas fa-lock me-1"></i> {{ __('Unlock Social Links') }}
                                                                        </a>
                                                                    @else
                                                                        <span class="text-muted sm-font"><i class="fas fa-lock me-1"></i> {{ __('Contact info hidden') }}</span>
                                                                    @endif
                                                                @else
                                                                    <a href="{{ route('user.login') }}" class="btn btn-warning btn-sm py-1 px-3">
                                                                        <i class="fas fa-lock me-1"></i> {{ __('Login to View') }}
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div class="d-flex social-icon-inner-wraper">
                                                            @foreach ($social_profiles as $profile)
                                                                <div class="social-icon">
                                                                    <a href="{{ $profile->profile_link }}">
                                                                        <i class="{{ $profile->platform_icon }}"></i>
                                                                    </a>
                                                                    <span>{{ $profile->followers }}</span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="profile-status-section text-end">
                                    @if (Auth::guard('web')->check() &&
                                            Auth::guard('web')->user()->user_type == 2 &&
                                            Auth::guard('web')->user()->username === $username)
                                        @if (empty($is_promoted))
                                            <div class="promote_profile mb-3 text-md-end text-start">
                                                <a href="javascript:void(0)"
                                                   class="btn-profile btn-bg-1 open_project_promote_modal"
                                                   data-bs-target="#openProjectPromoteModal" data-bs-toggle="modal"
                                                   data-project-id="0">
                                                    {{ __('Promote Profile') }}
                                                </a>
                                            </div>
                                        @endif
                                        <div class="profile-status-top-part">
                                            <a href="{{ route('influencer.account.setup') }}"
                                               class="edit-intro inf-tag blue-tag">
                                                <span><i class="si si-edit"></i></span>
                                                <span>{{ __('Edit Intro') }}</span>
                                            </a>

                                            <div class="available-status display_work_availability">
                                                <label for="available-status">{{ __('Available for work') }}</label>
                                                <input id="check_work_availability" type="checkbox"
                                                       class="inf-custom-switch" data-user_id="{{ $user->id }}"
                                                       data-check_work_availability="{{ $user->check_work_availability }}"
                                                       @if ($user->check_work_availability == 1) checked @endif>
                                            </div>

                                            <!-- START: Earnings Visibility Toggle -->
                                            @if (get_static_option('user_earning_toggle') == 'enable')
                                                <div class="available-status display_work_availability">
                                                    <label for="earningToggleProfile">{{ __('Show Earnings') }}</label>
                                                    <input id="earningToggleProfile" type="checkbox"
                                                           class="inf-custom-switch"
                                                            {{ $showEarning ? 'checked' : '' }}>
                                                </div>
                                            @endif
                                            <!-- END: Earnings Visibility Toggle -->

                                        </div>
                                    @endif

                                    <div class="profile-status-bottom-part mt-4">
                                        @if (!empty($user->user_state->timezone))
                                            <div class="available-time inf-tag">
                                                <span class="icon"><i class="si si-clock"></i></span>
                                                <span>
                                                    @php
                                                        if (!empty($user->user_state->timezone)) {
                                                            date_default_timezone_set(optional($user->user_state)->timezone ?? '');
                                                            echo date('h:i:a');
                                                        }
                                                    @endphp
                                                </span>
                                                <span>({{ __('Local Time') }})</span>
                                            </div>
                                        @endif
                                        <div class="response-time inf-tag">
                                            {{ __('Avarage response time:') }}
                                            {{ $responseTimes['formatted_time'] }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if (Auth::guard('web')->check() &&
                                    Auth::guard('web')->user()->user_type == 2 &&
                                    Auth::guard('web')->user()->username === $username)
                                @if (!empty($is_promoted))
                                    <div class="mt-3">
                                        <div class="alert alert-primary">
                                            {{ get_static_option('promoted_user_profile_text') ?? __('Your current promotion is active and will expire on') }}
                                            <strong>
                                                {{ \Carbon\Carbon::parse(Auth::guard('web')->user()->pro_expire_date)->format('F j, Y') }}
                                            </strong>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>

                        <div class="about-part">
                            <div class="about-title-wraper">
                                <h5 class="ing-title md-font fw_bold">{{ __('About') }}</h5>
                                @if ($user->hourly_rate >= 1)
                                    <div class="rate"><span class="money">
                                            {{ amount_with_currency_symbol($user->hourly_rate ?? '') }}
                                        </span>/{{ __('hour') }}</div>
                                @endif
                            </div>
                            <div class="about-des">
                                {{ $user?->user_introduction->description ?? '' }}
                            </div>

                            <div class="influencer-details-tag-list">
                                <div class="category-tag-list">
                                    <h5 class="inf-title tag-title">{{ __('Categories') }}</h5>
                                    <div class="tags-wraper">
                                        @foreach ($user_category as $user_cat)
                                            <span class="inf-tag">
                                                {{ $user_cat?->category?->category }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="category-tag-list">
                                    <h5 class="inf-title tag-title">{{ __('Selling Skills') }}</h5>
                                    @php
                                        $array_skill = explode(',', $skills);
                                        $array_length = count($array_skill);
                                    @endphp
                                    <div class="tags-wraper">
                                        @for ($i = 0; $i <= $array_length - 1; $i++)
                                            <span class="inf-tag">{{ $array_skill[$i] }}</span>
                                        @endfor
                                    </div>
                                </div>

                                <div class="category-tag-list">
                                    <h5 class="inf-title tag-title">{{ __('Languages') }}</h5>
                                    @php
                                        $array_languages = explode(', ', $languages);
                                        $array_length = count($array_languages);
                                    @endphp
                                    <div class="tags-wraper">
                                        @for ($i = 0; $i <= $array_length - 1; $i++)
                                            <span class="inf-tag">{{ $array_languages[$i] }}</span>
                                        @endfor
                                    </div>
                                </div>

                                <!-- START: Earnings Display -->
                                <div class="category-tag-list earning-display-section" style="display: {{ $showEarning == 1 ? 'block' : 'none' }};">
                                    <h5 class="inf-title tag-title">{{ __('Total Earnings') }}</h5>
                                    <div class="tags-wraper">
                                        <span class="inf-tag">
                                            {{ amount_with_currency_symbol($amount) }}
                                        </span>
                                    </div>
                                </div>
                                <!-- END: Earnings Display -->

                            </div>
                        </div>
                    </div>
                </div>
                <div class="campaing-catalouges mt-80">
                    <div class="catalouges-title-waper d-flex justify-content-between gap-3 flex-wrap mb-40">
                        <h3 class="inf-title title4 fw_bold black-text">{{ __('Project Catalouge') }}</h3>
                        @if (Auth::guard('web')->check() &&
                                Auth::guard('web')->user()->user_type == 2 &&
                                Auth::guard('web')->user()->username === $username)
                            <div class="add-btn-wraper">
                                <a href="{{ route('influencer.project.create') }}"
                                    class="small-add-btn blue-small-add-btn "><i
                                        class="fas fa-plus"></i>{{ __('Add') }}</a>
                            </div>
                        @endif
                    </div>
                    <div class="catalouge-list-wraper">
                        <div class="row g-4">
                            @foreach ($projects as $project)
                                @if (Auth::guard('web')->check() &&
                                        Auth::guard('web')->user()->user_type == 2 &&
                                        Auth::guard('web')->user()->username == $username)
                                    <div class="col-lg-4 col-md-6">
                                        <div class="inf-project-card">
                                            <div class="top-part">
                                                @php
                                                    $image_ids = explode('|', $project->image);
                                                    $first_image_id = $image_ids[0];
                                                @endphp
                                                <div class="img-wraper">
                                                    @if (!empty($first_image_id))
                                                        <a href="{{ route('shake.details', ['username' => $project->project_creator?->username, 'slug' => $project->slug]) }}"
                                                            class="d-block">
                                                            {!! render_image_markup_by_attachment_id($first_image_id) !!}
                                                        </a>
                                                    @endif

                                                    @if (Auth::guard('web')->check() &&
                                                            Auth::guard('web')->user()->user_type == 2 &&
                                                            Auth::guard('web')->user()->username === $username)
                                                        <div class="action-icon-wraper">
                                                            @if (moduleExists('PromoteInfluencer'))
                                                                <div>
                                                                    @php
                                                                        $current_date = \Carbon\Carbon::now()->toDateTimeString();
                                                                        $is_promoted = \Modules\PromoteInfluencer\Entities\PromotionProjectList::where(
                                                                            'identity',
                                                                            $project->id,
                                                                        )
                                                                            ->where('type', 'project')
                                                                            ->where('expire_date', '>', $current_date)
                                                                            ->where('payment_status', 'complete')
                                                                            ->first();
                                                                    @endphp

                                                                    @if (!empty($is_promoted))
                                                                        <a href="javascript:void(0)"
                                                                            class="icon-btn-rounded"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="top"
                                                                            title="{{ __('Promoted until') }} {{ \Carbon\Carbon::parse($is_promoted->expire_date)->format('d M, Y') }}">
                                                                            <i class="fa-solid fa-rocket icon-rocket"></i>
                                                                        </a>
                                                                    @else
                                                                        <a href="javascript:void(0)"
                                                                            data-bs-target="#openProjectPromoteModal"
                                                                            data-bs-toggle="modal"
                                                                            data-project-id="{{ $project->id }}"
                                                                            class="icon-btn-rounded open_project_promote_modal"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="top"
                                                                            title="{{ __('Promote this project') }}">
                                                                            <i
                                                                                class="fa-solid fa-bullhorn icon-bullhorn"></i>
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            @endif

                                                            <a href="{{ route('influencer.project.edit', $project->id) }}"
                                                                class="icon-btn-rounded edit-icon">
                                                                <i class="si si-edit"></i>
                                                            </a>
                                                            @if ($project?->orders_count == 0)
                                                                <x-status.table.delete :class="'icon-btn-rounded primary_text delete-icon swal_delete_button'"
                                                                    :url="route(
                                                                        'influencer.project.delete',
                                                                        $project->id,
                                                                    )" />
                                                            @endif
                                                        </div>
                                                    @else
                                                        <div class="fvt-icon-wraper">
                                                            @if (!Auth::guard('web')->check() || Auth::guard('web')->user()->user_type == 1)
                                                                <x-frontend.bookmark :identity="$project->id" :type="'project'" />
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="text-part mt-4">
                                                    <div class="text-top">
                                                        <div class="infulencer">
                                                            <div class="inf-img">
                                                                @if ($project?->project_creator->image)
                                                                    <img src="{{ asset('assets/uploads/profile/' . $project?->project_creator->image) }}"
                                                                        alt="{{ $project?->project_creator->first_name }}">
                                                                @else
                                                                    <img src="{{ asset('assets/static/img/author/author.jpg') }}"
                                                                        alt="{{ __('profile img') }}">
                                                                @endif
                                                                <x-status.user-online-offline-check :userID="$project->project_creator?->id" />
                                                            </div>
                                                            <div class="inf-name">
                                                                <a
                                                                    href="{{ route('shake.details', ['username' => $project->project_creator?->username, 'slug' => $project->slug]) }}">
                                                                    {{ $project->project_creator?->full_name }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h6 class="inf-title md-font fw_semibold">
                                                        <a
                                                            href="{{ route('shake.details', ['username' => $project->project_creator?->username, 'slug' => $project->slug]) }}">
                                                            {{ $project->title }}
                                                        </a>
                                                    </h6>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="bottom-part">
                                                    <div class="price fw_semibold">
                                                        <span class="">
                                                            {{ __('Started from') }}:
                                                        </span>
                                                        <span class="primary_text fw_bolder">
                                                            @if ($project->basic_discount_charge)
                                                                {{ amount_with_currency_symbol($project->basic_discount_charge) }}
                                                                <s style="color: #564848;">{{ amount_with_currency_symbol($project->basic_regular_charge) }}</s>
                                                            @else
                                                                {{ amount_with_currency_symbol($project->basic_regular_charge) }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="ratings">
                                                        {!! single_project_rating($project->id) !!}
                                                        @if ($project->average_rating)
                                                            <span class="star">
                                                                <svg width="20" height="21" viewBox="0 0 20 21"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M9.04894 4.0208C9.3483 3.09949 10.6517 3.09949 10.9511 4.0208L11.7961 6.62161C11.93 7.03364 12.3139 7.3126 12.7472 7.3126H15.4818C16.4505 7.3126 16.8533 8.55221 16.0696 9.12161L13.8572 10.729C13.5067 10.9836 13.3601 11.435 13.494 11.847L14.339 14.4479C14.6384 15.3692 13.5839 16.1353 12.8002 15.5659L10.5878 13.9585C10.2373 13.7039 9.7627 13.7039 9.41222 13.9585L7.19983 15.5659C6.41612 16.1353 5.36164 15.3692 5.66099 14.4479L6.50604 11.847C6.63992 11.435 6.49326 10.9836 6.14277 10.729L3.93039 9.12162C3.14668 8.55221 3.54945 7.3126 4.51818 7.3126H7.25283C7.68606 7.3126 8.07001 7.03364 8.20389 6.62161L9.04894 4.0208Z"
                                                                        fill="#F0AD4E" />
                                                                </svg>
                                                            </span>

                                                            <span class="rate fw_semibold black_text">
                                                                {{ number_format($project->average_rating, 1) }}
                                                            </span>
                                                            <span>({{ $project->ratings_count }}+)</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @if ($project->project_on_off == 1 && $project->status == 1 && $project->project_approve_request == 1)
                                        <div class="col-lg-4 col-md-6">
                                            <div class="inf-project-card">
                                                <div class="top-part">
                                                    @php
                                                        $image_ids = explode('|', $project->image);
                                                        $first_image_id = $image_ids[0];
                                                    @endphp
                                                    <div class="img-wraper">
                                                        @if (!empty($first_image_id))
                                                            <a href="{{ route('shake.details', ['username' => $project->project_creator?->username, 'slug' => $project->slug]) }}"
                                                                class="d-block">
                                                                {!! render_image_markup_by_attachment_id($first_image_id) !!}
                                                            </a>
                                                        @endif

                                                        @if (Auth::guard('web')->check() &&
                                                                Auth::guard('web')->user()->user_type == 2 &&
                                                                Auth::guard('web')->user()->username === $username)
                                                            <div class="action-icon-wraper">
                                                                <a href="{{ route('influencer.project.edit', $project->id) }}"
                                                                    class="icon-btn-rounded edit-icon">
                                                                    <i class="si si-edit"></i>
                                                                </a>
                                                                @if ($project?->orders_count == 0)
                                                                    <x-status.table.delete :class="'icon-btn-rounded primary_text delete-icon swal_delete_button'"
                                                                        :url="route(
                                                                            'influencer.project.delete',
                                                                            $project->id,
                                                                        )" />
                                                                @endif
                                                            </div>
                                                        @else
                                                            <div class="fvt-icon-wraper">
                                                                @if (!Auth::guard('web')->check() || Auth::guard('web')->user()->user_type == 1)
                                                                    <x-frontend.bookmark :identity="$project->id"
                                                                        :type="'project'" />
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="text-part mt-4">
                                                        <div class="text-top">
                                                            <div class="infulencer">
                                                                <div class="inf-img">
                                                                    @if ($project?->project_creator->image)
                                                                        <img src="{{ asset('assets/uploads/profile/' . $project?->project_creator->image) }}"
                                                                            alt="{{ $project?->project_creator->first_name }}">
                                                                    @else
                                                                        <img src="{{ asset('assets/static/img/author/author.jpg') }}"
                                                                            alt="{{ __('profile img') }}">
                                                                    @endif
                                                                    <x-status.user-online-offline-check
                                                                        :userID="$project->project_creator?->id" />
                                                                </div>
                                                                <div class="inf-name">
                                                                    <a
                                                                        href="{{ route('shake.details', ['username' => $project->project_creator?->username, 'slug' => $project->slug]) }}">
                                                                        {{ $project->project_creator?->full_name }}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h6 class="inf-title md-font fw_semibold">
                                                            <a
                                                                href="{{ route('shake.details', ['username' => $project->project_creator?->username, 'slug' => $project->slug]) }}">
                                                                {{ $project->title }}
                                                            </a>
                                                        </h6>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="bottom-part">
                                                        <div class="price fw_semibold">
                                                            <span class="">
                                                                {{ __('Started from') }}:
                                                            </span>
                                                            <span class="primary_text fw_bolder">
                                                                {{ amount_with_currency_symbol($project->basic_regular_charge) ?? '' }}
                                                            </span>
                                                        </div>
                                                        <div class="ratings">
                                                            {!! single_project_rating($project->id) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <x-pagination.laravel-paginate :allData="$projects" />

                {{-- Portfolio Section --}}
                <div class="campaing-catalouges mt-80">
                    <div class="catalouges-title-waper d-flex justify-content-between gap-3 flex-wrap mb-40">
                        <h3 class="inf-title title4 fw_bold black-text">{{ __('Portfolio') }}</h3>
                        @if (Auth::guard('web')->check() &&
                                Auth::guard('web')->user()->user_type == 2 &&
                                Auth::guard('web')->user()->username === $username)
                            <div class="add-btn-wraper">
                                <a href="javascript:void(0)"
                                   class="small-add-btn blue-small-add-btn" 
                                   data-bs-toggle="modal" 
                                   data-bs-target="#portfolioAddModal">
                                    <i class="fas fa-plus"></i>{{ __('Add') }}
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="catalouge-list-wraper">
                        <div class="row g-4" id="portfolio_list_container">
                            @forelse ($portfolios as $portfolio)
                                <div class="col-lg-4 col-md-6 portfolio-item-card" data-id="{{ $portfolio->id }}">
                                    <div class="inf-project-card">
                                        <div class="top-part">
                                            <div class="img-wraper">
                                                @if ($portfolio->image)
                                                    <img src="{{ asset('assets/uploads/portfolio/' . $portfolio->image) }}" alt="{{ $portfolio->title }}">
                                                @else
                                                    <img src="{{ asset('assets/static/img/author/author.jpg') }}" alt="{{ __('portfolio img') }}">
                                                @endif

                                                @if($portfolio->status == 0)
                                                    <div class="portfolio-status-badge">
                                                        <span class="badge bg-warning text-dark">{{ __('Pending') }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="text-part mt-4 d-flex justify-content-between align-items-center gap-2">
                                                <h6 class="inf-title md-font fw_semibold mb-0">
                                                    {{ $portfolio->title }}
                                                </h6>
                                                <a href="javascript:void(0)" 
                                                   class="btn btn-outline-primary btn-sm view_portfolio_details"
                                                   data-id="{{ $portfolio->id }}"
                                                   data-title="{{ $portfolio->title }}"
                                                   data-description="{{ $portfolio->description }}"
                                                   data-image="{{ asset('assets/uploads/portfolio/' . $portfolio->image) }}">
                                                    {{ __('Details') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center text-muted">
                                    <p>{{ __('No portfolio items found.') }}</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="review-section-wraper mt-80">
                    <div class="project-review-wraper">
                        <h4 class="inf-title title7 fw_semibold deep_black_text">{{ __('Reviews') }}</h4>
                        <div class="full-rating-wraper box-card">
                            {!! freelancer_details_rating($user->id) !!}
                        </div>
                    </div>
                    <div class="client-review-wraper">
                        <div class="top-part">
                            <div class="deep_black_text fw_medium">{{ __('Client Reviews') }}</div>
                            <div class="review-shorting">
                                <label for="review-shorting">{{ __('Sort By') }}:</label>
                                <select name="review-shorting" id="review-shorting" class="review-shoring"
                                    data-url="{{ route('influencer.profile.reviews', $username) }}">
                                    <option value="1">{{ __('Most Recent') }}</option>
                                    <option value="2">{{ __('Past Week') }}</option>
                                    <option value="3">{{ __('Oldest First') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="client-review-inner" id="review-list">
                            @foreach ($freelancer_reviews as $review)
                                @include('frontend.profile-details2.partials.review-card', [
                                    'review' => $review,
                                ])
                            @endforeach
                        </div>
                        @if ($freelancer_reviews->hasMorePages())
                            <div class="text-center mt-3">
                                <button id="load-more-reviews" data-next-page="2" data-sort="1"
                                    class="btn btn-primary">
                                    {{ __('Load More') }}
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile area end -->
    </main>

    @include('frontend.profile-details.project-reject-reason')
    @if (moduleExists('PromoteInfluencer'))
        @include('frontend.profile-details.promotion.project-promote-modal')
    @endif

    @if(moduleExists('Credit'))
    <!-- Unlock Social Modal -->
    <div class="modal fade" id="unlockSocialModal" tabindex="-1" aria-labelledby="unlockSocialModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="unlockSocialModalLabel">{{ __('Unlock Social Profiles') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p class="mb-1 text-muted">{{ __('Each unlock reveals all social media profiles of this influencer.') }}</p>
                        <hr>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>{{ __('Available Credits:') }}</span>
                        <strong id="client_available_credits">0</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2 text-danger">
                        <span>{{ __('Credits Required:') }}</span>
                        <strong id="unlock_cost_credits">0</strong>
                    </div>
                    <div id="credit_shortage_msg" class="alert alert-danger p-2 mt-3 d-none">
                        {{ __('You do not have enough credits.') }} 
                        <a href="{{ route('client.credit.history') }}" class="btn btn-sm btn-primary ms-2">{{ __('Buy Credits') }}</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="influencer_id_to_unlock">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-primary" id="confirm_unlock_btn">{{ __('Unlock Now') }}</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Portfolio Details Modal -->
    <div class="modal fade" id="portfolioDetailsModal" tabindex="-1" aria-labelledby="portfolioDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="portfolioDetailsModalLabel">{{ __('Portfolio Details') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="portfolio-details-img mb-4 text-center">
                        <img id="details_portfolio_image" src="" alt="Portfolio Image" style="max-width: 100%; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    </div>
                    <div class="portfolio-details-content">
                        <h4 id="details_portfolio_title" class="mb-3"></h4>
                        <p id="details_portfolio_description" class="text-muted" style="white-space: pre-wrap;"></p>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div class="owner-actions">
                        @if (Auth::guard('web')->check() &&
                                Auth::guard('web')->user()->user_type == 2 &&
                                Auth::guard('web')->user()->username === $username)
                            <button type="button" class="btn btn-outline-danger delete_portfolio_btn_trigger">
                                <i class="si si-trash me-1"></i> {{ __('Delete') }}
                            </button>
                            <button type="button" class="btn btn-outline-primary edit_portfolio_btn_trigger">
                                <i class="si si-edit me-1"></i> {{ __('Edit') }}
                            </button>
                        @endif
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Add/Edit Modal -->
    <div class="modal fade" id="portfolioAddModal" tabindex="-1" aria-labelledby="portfolioAddModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="portfolioAddModalLabel">{{ __('Add New Portfolio') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="portfolio_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="edit_portfolio_id" id="edit_portfolio_id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="portfolio_title" class="form-label">{{ __('Portfolio Title') }}</label>
                            <input type="text" name="portfolio_title" id="portfolio_title" class="form-control" placeholder="{{ __('Enter portfolio title') }}">
                            <small class="text-muted">{{ __('Title must be 10-60 characters.') }}</small>
                        </div>
                        <div class="mb-3">
                            <label for="portfolio_description" class="form-label">{{ __('Portfolio Description') }}</label>
                            <textarea name="portfolio_description" id="portfolio_description" class="form-control" rows="4" placeholder="{{ __('Enter portfolio description') }}"></textarea>
                            <small class="text-muted">{{ __('Description must be 50-150 characters.') }}</small>
                        </div>
                        <div class="mb-3">
                            <label for="portfolio_image" class="form-label">{{ __('Portfolio Image') }}</label>
                            <input type="file" name="image" id="portfolio_image" class="form-control">
                            <div id="portfolio_image_preview" class="mt-2" style="display: none;">
                                <img src="" alt="Preview" style="max-width: 200px; border-radius: 5px;">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary" id="portfolio_submit_btn">{{ __('Save Portfolio') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <x-sweet-alert.sweet-alert2-js />
    <x-select2.select2-js />
    <x-frontend.payment-gateway.gateway-select-js />
    @if(moduleExists('Credit'))
    <script>
        $(document).ready(function() {
            "use strict";

            $(document).on('click', '.unlock_social_btn', function() {
                let influencer_id = $(this).data('influencer_id');
                let credits_required = $(this).data('credits_required');
                let balance = $(this).data('balance');

                $('#influencer_id_to_unlock').val(influencer_id);
                $('#unlock_cost_credits').text(credits_required);
                $('#client_available_credits').text(balance);

                if (balance < credits_required) {
                    $('#credit_shortage_msg').removeClass('d-none');
                    $('#confirm_unlock_btn').prop('disabled', true);
                } else {
                    $('#credit_shortage_msg').addClass('d-none');
                    $('#confirm_unlock_btn').prop('disabled', false);
                }
            });

            $(document).on('click', '#confirm_unlock_btn', function() {
                let influencer_id = $('#influencer_id_to_unlock').val();
                let btn = $(this);

                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> {{ __("Unlocking...") }}');

                $.ajax({
                    url: "{{ route('client.credit.unlock.influencer') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        influencer_id: influencer_id
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            toastr_success_js(res.message);
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    },
                    error: function(err) {
                        let msg = err.responseJSON.message || "{{ __('Something went wrong') }}";
                        toastr_error_js(msg);
                        btn.prop('disabled', false).text('{{ __("Unlock Now") }}');
                    }
                });
            });
        });
    </script>
    @endif
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                const $toggle = $('#earningToggleProfile');
                const $label = $('.toggle-label'); // Note: Check if this selector exists in your HTML if you use labels
                // promotion plugin js start
                $(document).on('change', '#get_package_budget', function() {
                    let package_budget = $(this).find(':selected').attr('data-budget')
                    $('#set_package_budget').val(package_budget);
                });

                //promote project
                $(document).on('click',
                    '#get_package_budget, .wallet_selected_payment_gateway , .payment_getway_image ul li',
                    function() {
                        let site_default_currency_symbol = '{{ site_currency_symbol() }}';
                        let gateway = $('#order_from_user_wallet').val();
                        let package_budget = $('#set_package_budget').val();

                        <?php
                        $transaction_type = get_static_option('promote_transaction_fee_type') ?? '';
                        $transaction_charge = get_static_option('promote_transaction_fee_charge') ?? 0;
                        ?>

                        if (gateway == 'wallet' || gateway == 'manual_payment') {
                            $('.show_hide_transaction_section').addClass('d-none');
                            let wallet_balance =
                                {{ Auth::check() ? Auth::user()->user_wallet?->balance ?? 0 : 0 }};
                            if (package_budget > wallet_balance) {
                                $('.display_wallet_shortage_balance').html(
                                    '<span class="text-danger">{{ __('Wallet Balance Shortage:') }}' +
                                    site_default_currency_symbol + (package_budget - wallet_balance) +
                                    '<a class="btn btn-primary btn-sm ml-2" href="{{ route('influencer.wallet.history') }}" target="_blank">{{ __('Deposit Wallet') }}</a></span>'
                                );
                            }
                        } else {
                            if ("{{ $transaction_charge > 0 }}") {
                                let transaction_amount = 0;
                                $('.show_hide_transaction_section').removeClass('d-none');
                                let transaction_type = "{{ $transaction_type }}";
                                let transaction_charge = parseFloat("{{ $transaction_charge }}");
                                transaction_amount = transaction_type == 'fixed' ? transaction_charge : (
                                    package_budget * transaction_charge / 100);
                                $('.currency_symbol').text(site_default_currency_symbol);
                                $('.transaction_fee_amount').text(transaction_amount.toFixed(2));
                                $('#transaction_fee').val(transaction_amount)
                            }
                        }
                    });

                $(document).on('click', '.open_project_promote_modal', function() {
                    $('#set_project_id_for_promote').val($(this).data('project-id'))

                    if ($('#set_project_id_for_promote').val() == 0) {
                        $('.heading_title_for_promotion_modal').text("{{ __('Promote Profile') }}")
                        $('.warning_for_promotion_modal').text(
                            "{{ __('Notice: Days refers to the number of days a freelancer profile will be displayed in the talent page promotional area after he buy a package.') }}"
                        )
                    } else {
                        $('.heading_title_for_promotion_modal').text("{{ __('Promote Project') }}")
                        $('.warning_for_promotion_modal').text(
                            "{{ __('Notice: Days refers to the number of days a freelancer project will be displayed in the project promotional area after he buy a package.') }}"
                        )

                    }
                })

                $(document).on('click', '.confirm_promote_project', function() {
                    let package_budget = $('#set_package_budget').val();
                    let payment_gateway = $('#order_from_user_wallet').val();
                    let manual_payment_image = $('input[name="manual_payment_image"]').val();

                    if (package_budget == '') {
                        toastr_warning_js("{{ __('Please choose package plan') }}")
                        return false;
                    }
                    if (payment_gateway == 'manual_payment') {
                        if (manual_payment_image == '') {
                            toastr_warning_js("{{ __('Please choose image for manual payment.') }}")
                            return false;
                        }
                    }

                    //load spinner
                    $('#promote_project_load_spinner').html('<i class="fas fa-spinner fa-pulse"></i>')
                    setTimeout(function() {
                        $('#promote_project_load_spinner').html('');
                    }, 10000);
                });

                if ($toggle.length) {
                    // Initialize visibility on load
                    const $earningSections = $('.earning-display-section');
                    const initializeDisplay = () => {
                        $earningSections.css('display', $toggle.is(':checked') ? 'block' : 'none');
                    };
                    initializeDisplay(); // Run once on load

                    $toggle.on('change', function() {
                        const isChecked = $(this).is(':checked');
                        const wasChecked = !isChecked; // For revert

                        // Disable toggle during AJAX
                        $toggle.prop('disabled', true);

                        $.ajax({
                            url: "{{ route('freelancer.toggle.earning') }}",
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                show_earning: isChecked ? 1 : 0
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    toastr_success_js(response.message || 'Earning visibility updated successfully');
                                    initializeDisplay(); // Update sections
                                } else {
                                    console.error('Unexpected response:', response);
                                    $toggle.prop('checked', wasChecked);
                                    $earningSections.css('display', wasChecked ? 'block' : 'none');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('AJAX Error:', {
                                    status: xhr.status,
                                    statusText: xhr.statusText,
                                    responseText: xhr.responseText,
                                    error: error
                                });

                                // Revert toggle
                                $toggle.prop('checked', wasChecked);

                                // Ensure sections are reverted
                                $earningSections.css('display', wasChecked ? 'block' : 'none');

                                // Show error message
                                let errorMsg = 'Something went wrong';
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMsg = xhr.responseJSON.message;
                                } else if (xhr.status === 401) {
                                    errorMsg = 'Please login to update this setting';
                                } else if (xhr.status === 422) {
                                    errorMsg = 'Validation error';
                                }
                                toastr_warning_js(errorMsg);
                            },
                            complete: function() {
                                // Re-enable toggle
                                $toggle.prop('disabled', false);
                            }
                        });
                    });
                }
            });
        }(jQuery));
    </script>
    <script>
        const videos = document.querySelectorAll('.background-video');
        videos.forEach(video => {
            video.addEventListener('mouseenter', () => {
                video.play();
            });

            video.addEventListener('mouseleave', () => {
                video.pause();
                video.currentTime = 0;
            });
        });
        //view project reject details
        $(document).on('click', '.view_project_reject_reason_details', function() {
            let description = $(this).data('project-reject-description')
            $('.project_reject_reason_description').text(description);
        })

        $(document).on('click', '.swal_delete_button', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '{{ __('Are you sure to delete?') }}',
                text: '{{ __('You would not be able to revert this item!') }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('Yes, Delete it!') }}"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.swal_form_submit_btn').trigger('click');
                }
            });
        });

        $(document).on('click', '#check_work_availability', function(e) {
            e.preventDefault();
            let user_id = $(this).data('user_id');
            let check_work_availability = $(this).data('check_work_availability');
            Swal.fire({
                title: "{{ __('Are you sure?') }}",
                text: "{{ __('To change work availability status !') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('Yes, change it!') }}"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('influencer.work.availability.status') }}",
                        method: 'post',
                        data: {
                            user_id: user_id,
                            check_work_availability: check_work_availability
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                $('.display_work_availability').load(location.href +
                                    ' .display_work_availability');
                                toastr_success_js(
                                    "{{ __('Work Availability Status Successfully Changed') }}"
                                )
                            }
                        }
                    })
                }
            })
        })

        $(document).on('change', '#review-shorting', function() {
            let sort = $(this).val();
            let url = $(this).data('url');

            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    review_sort: sort
                },
                beforeSend: function() {
                    $('#review-list').html(
                        '<div class="text-center py-4">{{ __('Loading...') }}</div>');
                },
                success: function(data) {
                    $('#review-list').html(data);
                },
                error: function() {
                    $('#review-list').html(
                        '<div class="text-danger">{{ __('Failed to load reviews') }}</div>');
                }
            });
        });

        $(document).on('click', '#load-more-reviews', function(e) {
            e.preventDefault();
            let button = $(this);

            button.blur();

            let nextPage = button.data('next-page');
            let sort = button.data('sort');
            let url = $('#review-shorting').data('url');

            $.get(url, {
                review_sort: sort,
                page: nextPage
            }, function(response) {
                $('#review-list').append(response);

                let nextFlag = $('.load-more-flag').last();
                if (nextFlag.length) {
                    button.data('next-page', nextFlag.data('next-page'));
                    nextFlag.remove();
                } else {
                    button.remove();
                }
            });
        });

        // Portfolio Management
        $(document).ready(function() {
            "use strict";

            let currentPortfolioData = {};

            // View Portfolio Details
            $(document).on('click', '.view_portfolio_details', function() {
                const data = $(this).data();
                currentPortfolioData = data;

                $('#details_portfolio_title').text(data.title);
                $('#details_portfolio_description').text(data.description);
                $('#details_portfolio_image').attr('src', data.image);

                $('#portfolioDetailsModal').modal('show');
            });

            // Trigger Edit from Details Modal
            $(document).on('click', '.edit_portfolio_btn_trigger', function() {
                const data = currentPortfolioData;
                
                $('#portfolioDetailsModal').modal('hide');
                
                // Wait for the details modal to hide before showing the edit modal to prevent backdrop issues
                setTimeout(() => {
                    $('#portfolioAddModalLabel').text("{{ __('Edit Portfolio') }}");
                    $('#edit_portfolio_id').val(data.id);
                    $('#portfolio_title').val(data.title);
                    $('#portfolio_description').val(data.description);
                    
                    if (data.image) {
                        $('#portfolio_image_preview img').attr('src', data.image);
                        $('#portfolio_image_preview').show();
                    } else {
                        $('#portfolio_image_preview').hide();
                    }

                    // Set names for Edit mode
                    $('#portfolio_title').attr('name', 'edit_portfolio_title');
                    $('#portfolio_description').attr('name', 'edit_portfolio_description');
                    $('#portfolio_image').attr('name', 'edit_image');
                    $('#portfolio_submit_btn').text("{{ __('Update Portfolio') }}");

                    $('#portfolioAddModal').modal('show');
                }, 300);
            });

            // Trigger Delete from Details Modal
            $(document).on('click', '.delete_portfolio_btn_trigger', function() {
                const id = currentPortfolioData.id;
                $('#portfolioDetailsModal').modal('hide');
                
                setTimeout(() => {
                    deletePortfolio(id);
                }, 300);
            });

            // Add Portfolio - Open Modal
            $(document).on('click', '[data-bs-target="#portfolioAddModal"]', function() {
                $('#portfolioAddModalLabel').text("{{ __('Add New Portfolio') }}");
                $('#portfolio_form')[0].reset();
                $('#edit_portfolio_id').val('');
                $('#portfolio_image_preview').hide();
                
                // Set names for Add mode
                $('#portfolio_title').attr('name', 'portfolio_title');
                $('#portfolio_description').attr('name', 'portfolio_description');
                $('#portfolio_image').attr('name', 'image');
                $('#portfolio_submit_btn').text("{{ __('Save Portfolio') }}");
            });

            // Image Preview
            $('#portfolio_image').on('change', function() {
                if (this.files && this.files[0]) {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('#portfolio_image_preview img').attr('src', e.target.result);
                        $('#portfolio_image_preview').show();
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Form Submit (Add/Edit)
            $('#portfolio_form').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let isEdit = $('#edit_portfolio_id').val() !== '';
                let url = isEdit ? "{{ route('influencer.portfolio.edit') }}" : "{{ route('influencer.portfolio.add') }}";

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#portfolio_submit_btn').prop('disabled', true).text("{{ __('Saving...') }}");
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            toastr_success_js(isEdit ? "{{ __('Portfolio updated successfully!') }}" : "{{ __('Portfolio added successfully!') }}");
                            $('#portfolioAddModal').modal('hide');
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        $('#portfolio_submit_btn').prop('disabled', false).text(isEdit ? "{{ __('Update Portfolio') }}" : "{{ __('Save Portfolio') }}");
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                toastr_warning_js(value[0]);
                            });
                        } else {
                            toastr_error_js("{{ __('Something went wrong!') }}");
                        }
                    }
                });
            });

            // Delete Portfolio Function
            function deletePortfolio(id) {
                Swal.fire({
                    title: "{{ __('Are you sure?') }}",
                    text: "{{ __('This portfolio item will be permanently deleted!') }}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "{{ __('Yes, delete it!') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('influencer.portfolio.delete') }}",
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: id
                            },
                            success: function(res) {
                                if (res.status === 'success') {
                                    toastr_success_js("{{ __('Portfolio deleted successfully!') }}");
                                    $(`.portfolio-item-card[data-id="${id}"]`).fadeOut(function() {
                                        $(this).remove();
                                        if ($('#portfolio_list_container').children().length === 0) {
                                            $('#portfolio_list_container').html('<div class="col-12 text-center text-muted"><p>{{ __("No portfolio items found.") }}</p></div>');
                                        }
                                    });
                                }
                            },
                            error: function() {
                                toastr_error_js("{{ __('Failed to delete portfolio item!') }}");
                            }
                        });
                    }
                });
            }
        });
    </script>
@endsection
