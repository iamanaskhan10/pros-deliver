@extends('frontend.layout.master')
@section('page-meta-data')
    {!!  render_page_meta_data_for_job($job_details) !!}
@endsection
@section('style')
    <x-summernote.summernote-css />
    <style>
        /* File Upload Preview Styles */
        .image-preview-container {
            margin-top: 1rem;
            border: 1px dashed #ddd;
            padding: 0.625rem;
            border-radius: 0.3125rem;
            background-color: #f9f9f9;
            position: relative;
        }

        .image-preview {
            max-width: 100%;
            max-height: 9.375rem;
            display: block;
        }

        .preview-remove-btn {
            position: absolute;
            top: -6px;
            right: -6px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background-color: #FF0000;
            color: white;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            font-size: 10px;
            cursor: pointer;
        }

        .preview-remove-btn:hover {
            background-color: #FF0000;
        }

        .pdf-preview {
            display: flex;
            align-items: center;
            gap: 0.625rem;
        }

        .pdf-icon {
            color: #FF0000;
            font-size: 2rem;
        }

        .pdf-info {
            flex-grow: 1;
        }

        .pdf-filename {
            display: block;
            margin-bottom: 0.125rem;
        }

        .pdf-type {
            font-size: 0.75rem;
            color: #6c757d;
        }
    </style>
@endsection
@section('content')
    <main>
        <div class="influencer page-wraper pat-80 pab-120">
            <div class="container">
                <div class="project-owner client">
                    <div class="left-part">
                        <div class="inf-img">
                            <a href="#">
                                @if ($job_details->job_creator?->image)
                                    <img src="{{ asset('assets/uploads/profile/' . $job_details->job_creator?->image) }}"
                                        alt="{{ $job_details->job_creator?->fullname }}">
                                @else
                                    <img src="{{ asset('assets/static/img/author/author.jpg') }}" alt="{{ __('AuthorImg') }}">
                                @endif
                            </a>
                            <x-status.user-online-offline-check :userID="$job_details->job_creator->id" />
                        </div>
                    </div>
                    <div class="right-part">
                        <div class="right-top d-flex gap-4">
                            <div class="name lg-font fw_semibold black_text">
                                {{ $job_details?->job_creator?->fullname }}
                                @if ($job_details?->job_creator?->user_verified_status == 1)
                                    <span data-toggle="tooltip" data-placement="top" title="{{ __('User Verified') }}">
                                        <i class="si si-varified green_text"></i>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="right-bottom sm-font">
                            @if ($job_details?->job_creator?->user_state?->state || $job_details?->job_creator?->user_country?->country)
                                <div class="location-wraper">
                                    <span class="primary_text">
                                        <i class="si si-location"></i>
                                    </span>
                                    <span>
                                        {{ $job_details?->job_creator?->user_state?->state ? $job_details->job_creator->user_state->state . ',' : '' }}
                                        {{ $job_details?->job_creator?->user_country?->country }}
                                    </span>
                                </div>
                            @endif
                            <div class="profile-statistics">
                                <div class="total-job d-flex gap-2">
                                    <span class="primary_text icon">
                                        <i class="si si-sm si-cart"></i>
                                    </span>
                                    <span>{{ __('Total Campaign') }} : {{ $user->user_jobs?->count() }}</span>
                                </div>
                                <div class="last-seen d-flex gap-2">
                                    <span class="primary_text icon">
                                        <i class="si si-sm si-eye"></i>
                                    </span>
                                    <span>
                                        {{ __('Last Seen ') }}:
                                        {{ \Carbon\Carbon::parse($job_details->last_seen)?->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="job-details-wraper">
                            <div class="top-part">
                                <div class="top-left">
                                    <h2 class="inf-title lg-font fw_semibold project-title">
                                        {{ $job_details->title }}
                                    </h2>
                                    <div class="project-info">
                                        <span class="date sm-font fw_medium">
                                            {{ $job_details->created_at->toFormattedDateString() ?? '' }} -
                                        </span>
{{--                                        <span class="inf-badge blue_badge">--}}
{{--                                            {{ ucfirst(__($job_details->min_followers)) ?? '' }}--}}
{{--                                        </span>--}}
                                        <span class="inf-badge green_badge">
                                            {{ ucfirst($job_details->type) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="top-right">
                                    <div class="fvt-icon-wraper">
                                        @if (!Auth::guard('web')->check() || Auth::guard('web')->user()->user_type == 2)
                                            <x-frontend.bookmark :identity="$job_details->id" :type="'job'" :style2="false" />
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="job-description">
                                {{-- Load the shared translation engine --}}
                                <x-ai-translate-toggle />

                                <div class="job-translate-wrap">
                                    <div class="job-translate-body">
                                        {!! $job_details->description !!}
                                    </div>
                                    <div class="job-translate-btn-row">
                                        <button
                                            type="button"
                                            class="job-translate-toggle-btn"
                                            data-target-lang="{{ config('ai.translation.default_target', 'en') }}"
                                            data-state="original"
                                        >
                                            <span class="jt-spinner"></span>
                                            <span class="jt-icon">🌐</span>
                                            <span class="jt-label">{{ __('Translate') }}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="tag-wraper">
                                @foreach ($job_details->job_skills as $skill)
                                    <a href="javascript:void(0)" class="inf-tag">
                                        {{ $skill->skill ?? '' }}
                                    </a>
                                @endforeach
                            </div>
                            <div class="bottom-part">
                                <div class="rate">
                                    <span class="money">
                                        {{ float_amount_with_currency_symbol($job_details->budget) }}
                                    </span>
                                    @if ($job_details->type == 'hourly')
                                        <span>/{{ ucfirst($job_details->type) }}</span>
                                    @endif
                                </div>
                                <div>
                                    <div class="project-attributes-wraper">
                                        @if ($job_details->min_followers !== null && $job_details->min_followers > 0)
                                            <div class="followers-attr porject-attribute">
                                                <span class="primary_text">
                                                    {{-- Inline SVG matching si-icon size/style --}}
                                                    <svg width="14" height="14" viewBox="0 0 640 640" fill="currentColor" style="display: inline-block; vertical-align: -0.125em;">
                                                        <path d="M320 80C377.4 80 424 126.6 424 184C424 241.4 377.4 288 320 288C262.6 288 216 241.4 216 184C216 126.6 262.6 80 320 80zM96 152C135.8 152 168 184.2 168 224C168 263.8 135.8 296 96 296C56.2 296 24 263.8 24 224C24 184.2 56.2 152 96 152zM0 480C0 409.3 57.3 352 128 352C140.8 352 153.2 353.9 164.9 357.4C132 394.2 112 442.8 112 496L112 512C112 523.4 114.4 534.2 118.7 544L32 544C14.3 544 0 529.7 0 512L0 480zM521.3 544C525.6 534.2 528 523.4 528 512L528 496C528 442.8 508 394.2 475.1 357.4C486.8 353.9 499.2 352 512 352C582.7 352 640 409.3 640 480L640 512C640 529.7 625.7 544 608 544L521.3 544zM472 224C472 184.2 504.2 152 544 152C583.8 152 616 184.2 616 224C616 263.8 583.8 296 544 296C504.2 296 472 263.8 472 224zM160 496C160 407.6 231.6 336 320 336C408.4 336 480 407.6 480 496L480 512C480 529.7 465.7 544 448 544L192 544C174.3 544 160 529.7 160 512L160 496z"/>
                                                    </svg>
                                                </span>
                                                <span class="sm-font fw_medium deep_black_text">
                                                    {{ number_format($job_details->min_followers) }}
                                                </span>
                                            </div>
                                        @endif
                                        @if ($job_details->job_creator?->user_country?->country)
                                            <div class="location-attr porject-attribute">
                                                <span class="primary_text">
                                                    <i class="si si-location"></i>
                                                </span>
                                                <span class="sm-font fw_medium deep_black_text">
                                                    {{ $job_details->job_creator?->user_country?->country }}
                                                </span>
                                            </div>
                                        @endif
                                        <div class="proposal-attr porject-attribute">
                                            <span class="primary_text">
                                                <i class="si si-note"></i>
                                            </span>
                                            <span class="sm-font fw_medium deep_black_text">
                                                {{ __('Proposals') }}:
                                                {{ $job_details->job_proposals?->count() }}
                                            </span>
                                        </div>
                                        @if (moduleExists('HourlyJob'))
                                            <div class="varified-attr porject-attribute">
                                                @if ($job_details->job_creator?->user_wallet?->balance >= $job_details->hourly_rate * $job_details->estimated_hours)
                                                    <span class="primary_text">
                                                        <i class="si si-varified-outline"></i>
                                                    </span>
                                                    <span
                                                        class="sm-font fw_medium deep_black_text">{{ __('Verified') }}</span>
                                                @else
                                                    <span class="primary_text">
                                                        <i class="si si-varified-outline"></i>
                                                    </span>
                                                    <span
                                                        class="sm-font fw_medium deep_black_text">{{ __('Not Verified') }}</span>
                                                @endif
                                            </div>
                                        @endif
                                        <div class="proposal-attr porject-attribute">
                                            <span class="primary_text">
                                                <i class="si si-calender"></i>
                                            </span>
                                            <span class="sm-font fw_medium deep_black_text">
                                                {{ ucfirst(__($job_details->duration)) ?? '' }}
                                            </span>
                                        </div>
                                        @if ($job_details->type == 'hourly')
                                            <div class="proposal-attr porject-attribute">
                                                <span class="primary_text">
                                                    <i class="si si-clock"></i>
                                                </span>
                                                <span class="sm-font fw_medium deep_black_text">
                                                    {{ __('Estimated Hours') }}:
                                                    {{ $job_details->estimated_hours ?? '' }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        @if (Auth::guard('web')->check() &&
                                Auth::guard('web')->user()->user_type == 2 &&
                                Session::get('user_role') != 'client' &&
                                Auth::guard('web')->user()->id != $job_details->user_id)
                            @php
                                $proposal_count = \App\Models\JobProposal::where('job_id', $job_details->id)
                                    ->where('freelancer_id', Auth::guard('web')->user()->id)
                                    ->count();
                            @endphp
                            @if ($proposal_count < 1)
                                <div class="submit-proposal-wraper mb-4">
                                    <h2 class="inf-title title7 fw_semibold deep_black_text">
                                        {{ __('Submit Proposal') }}
                                    </h2>
                                    <x-validation.error />
                                    <form action="{{ route('job.proposal.send') }}" method="post"
                                        enctype="multipart/form-data" id="job_proposal_form" class="submit-proposal-form">
                                        @csrf
                                        <input type="hidden" name="job_id" value="{{ $job_details->id }}">
                                        <input type="hidden" name="client_id" value="{{ $job_details->user_id }}">
                                        <div class="group-input-wraper">
                                            @if (moduleExists('HourlyJob'))
                                                @if ($job_details->type == 'hourly')
                                                    <div class="single-input">
                                                        <label class="label-title"> {{ __('Hourly rate') }}
                                                        </label>
                                                        <div class="single-input-icon">
                                                            <input type="number" name="amount" id="amount"
                                                                class="form--control"
                                                                value="{{ $job_details->hourly_rate ?? '' }}">
                                                            <span
                                                                class="input-icon">{{ get_static_option('site_global_currency') ?? '' }}</span>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="single-input">
                                                        <label class="label-title"> {{ __('Proposal Amount') }}
                                                        </label>
                                                        <div class="single-input-icon">
                                                            <input type="number" name="amount" id="amount"
                                                                class="form--control" value="{{ $job_details->budget }}">
                                                            <span
                                                                class="input-icon">{{ get_static_option('site_global_currency') }}</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="input-wraper">
                                                    <label for="amount" class="inf-custom-label">
                                                        {{ __('Proposal Amount') }}
                                                    </label>
                                                    <div class="input-group inf-input-group">
                                                        <span class="input-group-text">
                                                            {{ get_static_option('site_global_currency') }}
                                                        </span>
                                                        <input type="number" name="amount" class="inf-custom-input"
                                                            id="amount" placeholder="0.00"
                                                            value="{{ $job_details->budget }}">
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="input-wraper">
                                                <x-duration.delivery-time :class="'single-input'" :title="__('Delivery Time')"
                                                    :name="'duration'" :id="'duration'" />
                                            </div>
                                        </div>
                                        <div class="input-wraper mt-3">
                                            <label for="revision" class="inf-custom-label">{{ __('Revision') }}</label>
                                            <input type="number" min="0" class="inf-custom-input w-100"
                                                name="revision" id="revision"
                                                placeholder="{{ __('Proposal Revision Must be Number') }}"
                                                onkeypress="inpNum(event)">
                                        </div>
                                        <div class="input-wraper mt-3">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <label for="cover_letter" class="inf-custom-label mb-0">
                                                    {{ __('Your Cover Letter') }}
                                                </label>
                                                <button type="button"
                                                    id="ai_generate_proposal_btn"
                                                    data-job-id="{{ $job_details->id }}"
                                                    class="inf-cmn-btn sm-radius style2 inf-primary-btn d-flex align-items-center gap-2"
                                                    style="font-size: 0.8rem; padding: 0.35rem 0.85rem;">
                                                    <span id="ai_proposal_btn_text">{{ __('✨ Generate with AI') }}</span>
                                                    <span id="ai_proposal_spinner" class="d-none">
                                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="animation: spin 1s linear infinite;">
                                                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" stroke-dasharray="31.4" stroke-dashoffset="10" />
                                                        </svg>
                                                    </span>
                                                </button>
                                            </div>
                                            <textarea name="cover_letter" id="cover_letter" rows="3" class="inf-custom-input d-block w-100"
                                                placeholder="{{ __('Write your cover letter minimum 10 characters....') }}"></textarea>
                                        </div>
                                        <div class="image-upload-area-card mt-4">
                                            <label for="attachment" class="image-upload-btn">
                                                <span class="upload-icon">
                                                    <svg width="17" height="16" viewBox="0 0 17 16"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M5.125 6.66797C4.66438 6.67137 4.38721 6.6855 4.16643 6.74397C3.16162 7.01004 2.47369 7.91057 2.50077 8.92444C2.50862 9.2181 2.62041 9.58104 2.844 10.307C3.38209 12.054 4.28642 13.5706 6.3123 13.9344C6.68469 14.0013 7.10374 14.0013 7.94183 14.0013H9.05817C9.89623 14.0013 10.3153 14.0013 10.6877 13.9344C12.7136 13.5706 13.6179 12.054 14.156 10.307C14.3796 9.58104 14.4914 9.2181 14.4992 8.92444C14.5263 7.91057 13.8384 7.01004 12.8336 6.74397C12.6128 6.6855 12.3356 6.67137 11.875 6.66797"
                                                            stroke="#141B34" stroke-width="1.2" stroke-linecap="round" />
                                                        <path
                                                            d="M8.50264 2V9.33333M8.50264 2C8.81484 2 9.05217 2.29207 9.5269 2.8762L10.1693 3.66667M8.50264 2C8.19037 2 7.95304 2.29207 7.4783 2.8762L6.83594 3.66667"
                                                            stroke="#141B34" stroke-width="1.2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                                <span class="text">
                                                    {{ __('Upload Image') }}
                                                </span>
                                            </label>
                                            <input type="file" name="attachment" id="attachment" class="d-none"
                                                accept="image/*,application/pdf">
                                            <div class="additional-info-text">
                                                <span class="drag-drop w-100">
                                                    {{ __('Choose images or drag & drop it here') }}
                                                </span>
                                                <span class="w-100">{{ __('JPG,PNG and PDF. Max 5 MB.') }}</span>
                                            </div>
                                            <div id="file-info" class="file-info d-none">
                                                <span id="file-name" class="file-name"></span>
                                                <button type="button" id="remove-file"
                                                    class="remove-file-btn">&times;</button>
                                            </div>
                                        </div>
                                        <div class="send-proposal-btn-wraper text-end mt-4">
                                            <button type="submit"
                                                class="inf-cmn-btn md-radius style2 inf-primary-btn send_job_proposal">
                                                {{ __('Send Proposal') }}
                                                <span id="send_proposal_load_spinner"></span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        @endif
                        <div class="related-job-wraper">
                            <div class="recent-blog-title mb-3">
                                <h4 class="inf-title title6 fw_bold black_text">{{ __('Related Campaigns') }}</h4>
                            </div>
                            @if ($related_jobs->isEmpty())
                                <div class="mt-5">
                                    <x-frontend.not-found-dash />
                                </div>
                            @else
                                @foreach ($related_jobs as $job)
                                    <div class="inf-job-card mb-3">
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
                                                        <x-frontend.bookmark :identity="$job->id" :type="'job'"
                                                            :style2="false" />
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
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        function inpNum(e) {
            e = e || window.event;
            let charCode = (typeof e.which == "undefined") ? e.keyCode : e.which;
            let charStr = String.fromCharCode(charCode);

            if (!charStr.match(/^[0-9]+$/)) {
                toastr_warning_js("{{ __('Only positive numbers are allowed.') }}");
                e.preventDefault();
            }
        }

        $(document).ready(function() {
            $('#attachment').on('change', function(e) {
                const file = e.target.files[0];
                const container = $(this).closest('.image-upload-area-card');

                container.find('.image-preview-container').remove();

                if (file) {
                    if (!validateFile(file)) {
                        $(this).val('');
                        return;
                    }

                    const previewContainer = $('<div class="image-preview-container"></div>');

                    if (file.type.includes('image')) {
                        createImagePreview(file, previewContainer);
                    } else {
                        createPDFPreview(file, previewContainer);
                    }
                    container.append(previewContainer);
                }
            });

            $(document).on('click', '.preview-remove-btn', function() {
                const container = $(this).closest('.image-preview-container');
                const fileInput = container.closest('.image-upload-area-card').find('#attachment');
                container.remove();
                fileInput.val('');
            });

            // File validation function
            function validateFile(file) {
                const validTypes = ['image/jpeg', 'image/png', 'application/pdf'];

                if (!validTypes.includes(file.type)) {
                    toastr_warning_js("{{ __('Please upload only JPG, PNG, or PDF files.') }}");
                    return false;
                }

                if (file.size > 5 * 1024 * 1024) {
                    toastr_warning_js("{{ __('File size exceeds 5MB limit.') }}");
                    return false;
                }

                return true;
            }

            // Create image preview
            function createImagePreview(file, container) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    container.html(`
                <img src="${event.target.result}" class="image-preview">
                <button type="button" class="preview-remove-btn">
                    <i class="fas fa-times"></i>
                </button>
            `);
                }
                reader.readAsDataURL(file);
            }

            // Create PDF preview
            function createPDFPreview(file, container) {
                container.html(`
            <div class="pdf-preview">
                <i class="fas fa-file-pdf pdf-icon"></i>
                <div class="pdf-info">
                    <span class="pdf-filename">${file.name}</span>
                    <span class="pdf-type">PDF Document</span>
                </div>
                <button type="button" class="preview-remove-btn">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `);
            }
        });
    </script>
    @include('frontend.pages.job-details.job-details-js')
    @include('frontend.pages.job-details.ai-proposal-js')
    <style>
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
    </style>
@endsection
