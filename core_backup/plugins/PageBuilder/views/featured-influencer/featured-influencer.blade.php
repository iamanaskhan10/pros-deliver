<section class="influencer influencer-featured-section pat-120 pab-60">
    <div class="container">
        <div class="d-flex justify-content-between flex-wrap gap-2 mb-40">
            <h2 class="inf-title title2 black_text fw_bold">{{ $title ?? __('Featured Influencer') }}</h2>
            <div class="btn-wraper">
                <a href="{{ $find_more_button_link ?? route('talents.all') }}"
                    class="inf-cmn-btn inf-primary-outline-btn">
                    {{ $find_more_button_text ?? __('Find More') }}
                </a>
            </div>
        </div>
        <div class="influencer-fetured-wraper">
            <div class="row g-4">
                @foreach ($talents as $talent)
                    <div class="col-xl-3 col-md-6">
                        <div class="influencer_card">
                            <div class="top-part">
                                <div class="img-part">
                                    <a href="{{ route('influencer.profile.details', $talent->username) }}">
                                        @php
                                            $filePath = 'assets/uploads/profile/' . $talent->image;
                                            $extension = pathinfo($talent->image ?? '', PATHINFO_EXTENSION);
                                            $isVideo = in_array(strtolower($extension), ['mp4', 'webm', 'avi', 'mov']);
                                        @endphp

                                        @if ($talent->image)
                                            @if ($isVideo)
                                                {{-- Video avatar --}}
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
                                                {{-- Image avatar --}}
                                                <img src="{{ asset($filePath) }}" alt="{{ $talent->first_name }}">
                                            @endif
                                        @else
                                            {{-- Default placeholder --}}
                                            <img src="{{ asset('assets/static/img/author/author.jpg') }}" alt="{{ __('profile img') }}">
                                        @endif
                                    </a>
                                    @if(moduleExists('PromoteInfluencer') && $talent->is_pro_freelancer && !empty(get_static_option('promoted_badge_text')))
                                        <span class="sponsored-badge">
                                            {{ get_static_option('promoted_badge_text') ??  __('Sponsored') }}
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
                                            <span data-toggle="tooltip" data-placement="top"
                                                title="{{ __('User Verified') }}">
                                                <i class="si si-varified green_text"></i>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="flencer-designation">
                                        <span class="">{{ $talent->github_id ?? __('Content Creator') }}</span>
                                        {!! freelancer_rating_for_profile_details_page($talent->id) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="bottom-part">
                                @php
                                    $social_profiles = \App\Models\SocialProfile::where(
                                        'user_id',
                                        $talent->id,
                                    )->get();
                                    $total_followers = $social_profiles->reduce(function ($carry, $profile) {
                                        return $carry + parseFollowers($profile->followers);
                                    }, 0);
                                @endphp
                                <div class="followers">
                                    <span>{{ __('Followers') }}:</span>
                                    <span class="black_text fw_semibold">{{ formatFollowers($total_followers) }}</span>
                                </div>
                                <div class="social-icon-wraper">
                                    @foreach ($social_profiles as $profile)
                                        <a href="{{ $profile->profile_link }}">
                                            <i class=" {{ $profile->platform_icon }}"></i>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
