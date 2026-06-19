@if (!empty($jobs))
    <div class="job__card__container">
        @foreach ($jobs as $job)
            <div class="job__card__bg br_20">
                <div class="p-4">
                    <div class="d-flex gap-3 position-relative">
                        <a href="{{ route('influencer.profile.details', $job->job_creator?->username) }}">

                            <div class="job__card__logo br_12">
                                @if ($job?->job_creator->image)
                                    <img src="{{ asset('assets/uploads/profile/' . $job?->job_creator->image) }}"
                                        alt="{{ $job?->job_creator->first_name }}">
                                @else
                                    <img src="{{ asset('assets/static/img/author/author.jpg') }}"
                                        alt="{{ __('profile img') }}">
                                @endif
                            </div>
                        </a>
                        <a href="{{ route('influencer.profile.details', $job->job_creator?->username) }}">
                            <div>
                                <h3 class="d-block">{{ $job?->job_creator?->fullname ?? '' }} @if ($job?->job_creator?->user_verified_status == 1)
                                        <span class="check-verify-status"><i class="fas fa-circle-check"></i></span>
                                    @endif
                                </h3>
                                <div class="d-flex gap-2 align-items-center">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <p class="m-0">
                                        @if ($job?->job_creator?->user_state?->state != null)
                                            {{ optional($job?->job_creator->user_state)->state }},
                                        @endif
                                        {{ optional($job?->job_creator->user_country)->country }}
                                    </p>
                                </div>
                            </div>
                        </a>
                        @if (!Auth::guard('web')->check() || Auth::guard('web')->user()->user_type == 2)
                            <x-frontend.bookmark :identity="$job->id" :type="'job'" />
                        @endif

                    </div>
                    <hr class="border-bottom-2">
                    <div class="d-flex flex-column justify-content-between">
                        <div class="mb-4">
                            <h4 class="mb-2"><a
                                    href="{{ route('category.jobs', $job?->job_category->slug) }}">{{ $job?->job_category?->category }}</a>
                            </h4>
                            <div class="d-flex gap-3 mb-4">
                                <div class="d-flex gap-2 align-items-center">
                                    <span class="orange__circle"></span>
                                    <p class="m-0">{{ ucfirst($job->level) }}</p>
                                </div>
                                <div class="d-flex gap-2 align-items-center">
                                    <span class="orange__circle"></span>
                                    <p class="m-0">{{ $job->type }}</p>
                                </div>
                            </div>
                            <p class="campaign-title jobFilter-wrapper-item-title">
                                <a
                                    href="{{ route('job.details', ['username' => $job->job_creator?->username, 'slug' => $job->slug]) }}">
                                    {{ $job->title }}
                                </a>
                            </p>

                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="fs-4">
                                {{ float_amount_with_currency_symbol($job->budget) }}
                                <span class="fs-6">/{{ ucfirst(__($job->duration)) ?? '' }}</span>
                            </p>
                            <a
                                href="{{ route('job.details', ['username' => $job->job_creator?->username, 'slug' => $job->slug]) }}"><button
                                    class="btn btn_primary">{{ __('Apply Now') }}</button></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <x-pagination.laravel-paginate :allData="$jobs ?? ''" />
@else
    <div class="congratulation-area section-bg-2 pat-100 pab-100">
        <div class="container">
            <div class="congratulation-wrapper">
                <div class="congratulation-contents center-text">
                    <div class="congratulation-contents-icon bg-danger wow  zoomIn animated" data-wow-delay=".5s"
                        style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">
                        <i class="fas fa-times"></i>
                    </div>
                    <h4 class="congratulation-contents-title"> {{ __('OPPS!') }} </h4>
                    <p class="congratulation-contents-para">{{ __('Nothing') }} <strong>{{ __('Found') }}</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endif
