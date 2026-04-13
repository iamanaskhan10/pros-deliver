<div class="recent-job-wraper">
    <div class="row g-4">
        @foreach ($jobs as $job)
            <div class="col-lg-4 col-md-6">
                <div class="inf-job-card">
                    <div class="top-part">
                        <div class="card-header">
                            <div class="left-part">
                                <div class="img-wraper">
                                    @if ($job?->job_creator->image)
                                        <img src="{{ asset('assets/uploads/profile/' . $job?->job_creator->image) }}"
                                            alt="{{ $job?->job_creator->first_name }}">
                                    @else
                                        <img src="{{ asset('assets/static/img/author/author.jpg') }}"
                                            alt="{{ __('profile img') }}">
                                    @endif

                                </div>
                                <div class="job-info">
                                    <h4 class="lg-font fw_semibold black_text">
                                        <a class="oneline-text"
                                            href="{{ route('job.details', ['username' => $job->job_creator?->username, 'slug' => $job->slug]) }}">
                                            {{ truncateHtml($job?->title, 20) }}
                                        </a>
                                    </h4>
                                    @if ($job?->job_creator?->user_state?->state || $job?->job_creator?->user_country?->country)
                                        <div class="location">
                                            <i class="si si-location"></i>
                                            @if ($job?->job_creator?->user_state?->state != null)
                                                {{ optional($job?->job_creator->user_state)->state }},
                                            @endif
                                            {{ optional($job?->job_creator->user_country)->country }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="fvt-icon-wraper">
                                @if (!Auth::guard('web')->check() || Auth::guard('web')->user()->user_type == 2)
                                    <x-frontend.bookmark :identity="$job->id" :type="'job'" :style2="false" />
                                @endif
                            </div>
                        </div>
                        <div class="job-description mb-4">
                            <a class="twoline-text"
                                href="{{ route('job.details', ['username' => $job->job_creator?->username, 'slug' => $job->slug]) }}">
                                {{ truncateHtml($job?->description, 82) }}
                            </a>
                        </div>
                    </div>
                    <div class="inf-card-footer d-flex justify-content-between gap-3 flex-wrap">
                        <div class="salary">
                            <span class="black_text fw_bold lg-font">
                                {{ float_amount_with_currency_symbol($job->budget) }}
                            </span>
                        </div>
                        <div class="delivery-info">
                            <div class="d-flex gap-2 align-items-center">
                                <span class="orange__circle"></span>
                                <span>{{ ucfirst(__($job->duration)) ?? '' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<x-pagination.laravel-paginate :allData="$jobs" />
