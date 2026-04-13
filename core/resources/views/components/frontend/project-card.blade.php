<div class="inf-project-card mt-3">
    <div class="top-part">
        <div class="img-wraper">
            <a href="{{ route('shake.details', ['username' => $project->project_creator?->username, 'slug' => $project->slug]) }}"
                class="d-block">
                @php
                    $image_ids = explode('|', $project->image);
                    $first_image_id = $image_ids[0];
                @endphp
                {!! render_image_markup_by_attachment_id($first_image_id) !!}
            </a>
            <div class="fvt-icon-wraper">
                @if (!Auth::guard('web')->check() || Auth::guard('web')->user()->user_type == 1)
                    <x-frontend.bookmark :identity="$project->id" :type="'project'" />
                @endif
            </div>
        </div>
        <div class="text-part mt-4">
            <div class="text-top">
                <div class="infulencer">
                    <div class="inf-img">
                        @if ($project?->project_creator->image)
                            <img src="{{ asset('assets/uploads/profile/' . $project?->project_creator->image) }}"
                                alt="{{ $project?->project_creator->first_name }}">
                        @else
                            <img src="{{ asset('assets/static/img/author/author.jpg') }}" alt="{{ __('profile img') }}">
                        @endif
                        <x-status.user-online-offline-check :userID="$project->project_creator?->id" />
                    </div>
                    <div class="inf-name">
                        <a href="{{ route('influencer.profile.details', $project->project_creator?->username) }}">
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
            @if ($project->average_rating)
                <span class="star">
                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
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
