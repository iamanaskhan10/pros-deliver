<div class="influencer-fetured-wraper mt-4">
    <div class="row g-4">
        @foreach ($talents as $talent)
            <div class="col-xl-3 col-md-6">
                <div class="influencer_card">
                    <div class="top-part">
                        <div class="img-part">
                            <a href="{{ route('influencer.profile.details', $talent->username) }}">
                                @php
                                    $filePath = 'assets/uploads/profile/' . $talent->image;
                                    $extension = pathinfo($talent->image, PATHINFO_EXTENSION);
                                    $isVideo = in_array(strtolower($extension), ['mp4', 'webm', 'avi', 'mov']);
                                @endphp

                                @if (!empty($talent->image))
                                    @if($isVideo)
                                        <video
                                                src="{{ asset($filePath) }}"
                                                muted
                                                loop
                                                preload="metadata"
                                                class="profile-video"
                                                onmouseover="this.play()"
                                                onmouseout="this.pause(); this.currentTime=0;">
                                        </video>
                                    @else
                                        <img
                                                src="{{ asset($filePath) }}"
                                                alt="{{ $talent->first_name }}"
                                        >
                                    @endif
                                @else
                                    <img
                                            src="{{ asset('assets/static/img/author/author.jpg') }}"
                                            alt="{{ __('profile img') }}"
                                    >
                                @endif
                            </a>
                            @if(moduleExists('PromoteInfluencer') && $talent->is_pro_freelancer)
                                <span class="sponsored-badge">
                                   {{ get_static_option('promoted_badge_text') ?: __('Sponsored') }}
                                </span>
                            @endif
                        </div>
                        <div class="name-part">
                            <div class="name text-with-icon md-font">
                                <span class="black_text fw_semibold">
                                    <a href="{{ route('influencer.profile.details', $talent->username) }}">
                                        {{ $talent->first_name . ' ' . $talent->last_name }}
                                    </a>
                                </span>
                                @if ($talent->user_verified_status == 1)
                                    <span data-toggle="tooltip" data-placement="top" title="{{ __('User Verified') }}">
                                        <i class="si si-varified green_text"></i>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="flencer-designation">
                            <span class="">{{ $talent->github_id ?? __('Content Creator') }}</span>
                            {!! freelancer_rating_for_profile_details_page($talent->id) !!}
                        </div>
                    </div>
                    <div class="bottom-part">
                        @php
                            $social_profiles = \App\Models\SocialProfile::where('user_id', $talent->id)->get();
                            $total_followers = $social_profiles->reduce(function ($carry, $profile) {
                                return $carry + parseFollowers($profile->followers);
                            }, 0);
                        @endphp
                        <div class="followers">
                            <span>{{ __('Followers') }}:</span>
                            <span class="black_text fw_semibold">{{ formatFollowers($total_followers) }}</span>
                        </div>
                        <div class="social-icon-wraper">
                            @if(moduleExists('Credit'))
                                @if(is_influencer_unlocked($talent->id))
                                    @foreach ($social_profiles as $profile)
                                        <a href="{{ $profile->profile_link }}" target="_blank">
                                            <i class=" {{ $profile->platform_icon }}"></i>
                                        </a>
                                    @endforeach
                                @else
                                    @foreach ($social_profiles->take(3) as $profile)
                                        <a href="{{ route('influencer.profile.details', $talent->username) }}">
                                            <i class=" {{ $profile->platform_icon }}"></i>
                                        </a>
                                    @endforeach
                                    @if($social_profiles->count() > 3)
                                        <a href="{{ route('influencer.profile.details', $talent->username) }}" class="text-muted sm-font">+{{ $social_profiles->count() - 3 }}</a>
                                    @endif
                                @endif
                            @else
                                @foreach ($social_profiles as $profile)
                                    <a href="{{ $profile->profile_link }}" target="_blank">
                                        <i class=" {{ $profile->platform_icon }}"></i>
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <x-pagination.laravel-paginate :allData="$talents" />
</div>
