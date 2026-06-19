@extends('frontend.layout.master')
@section('site_title',__('Create Job'))
@section('style')
    <x-summernote.summernote-css/>
    <x-select2.select2-css/>
    <style>
        /* AI Modal Styles */
        .ai-modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }
        .ai-modal-overlay.active { display: flex; }
        .ai-modal-box {
            background: #fff;
            border-radius: 12px;
            padding: 32px;
            max-width: 520px;
            width: 92%;
            box-shadow: 0 8px 40px rgba(0,0,0,0.18);
            position: relative;
        }
        .ai-modal-box h4 { margin-bottom: 8px; font-weight: 700; }
        .ai-modal-box p  { color: #666; font-size: 13px; margin-bottom: 16px; }
        .ai-modal-close {
            position: absolute;
            top: 14px; right: 18px;
            font-size: 20px;
            cursor: pointer;
            background: none;
            border: none;
            color: #888;
        }
        .ai-modal-close:hover { color: #222; }
        #ai_description_input {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 12px;
            font-size: 14px;
            resize: vertical;
            min-height: 100px;
        }
        #ai_description_input:focus { outline: none; border-color: #764ba2; }
        .ai-char-count { font-size: 11px; color: #999; text-align: right; margin-top: 4px; }
        .btn-ai-generate {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity .2s;
            margin-bottom: 20px;
        }
        .btn-ai-generate:disabled { opacity: .6; cursor: not-allowed; }
        .ai-spinner {
            width: 14px; height: 14px;
            border: 2px solid rgba(255,255,255,0.4);
            border-top-color: #fff;
            border-radius: 50%;
            animation: ai-spin .7s linear infinite;
            display: none;
        }
        .btn-ai-generate.loading .ai-spinner   { display: inline-block; }
        .btn-ai-generate.loading .ai-btn-icon  { display: none; }
        .btn-ai-generate.loading .ai-btn-text  { display: none; }
        @keyframes ai-spin { to { transform: rotate(360deg); } }
        .btn-ai-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 24px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 12px;
            width: 100%;
            font-size: 14px;
            transition: opacity .2s;
        }
        .btn-ai-submit:disabled { opacity: .6; cursor: not-allowed; }
        .ai-unmatched-notice {
            background: #fff8e1;
            border: 1px solid #ffd54f;
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 12px;
            color: #795548;
            margin-top: 8px;
            display: none;
        }
    </style>
@endsection
@section('content')
    <main>
        <x-breadcrumb.user-profile-breadcrumb :title="__('Post a Campaign')" :innerTitle="__('Post a Campaign')"/>
        <!-- Account Setup area Starts -->
        <div class="account-area section-bg-2 pat-100 pab-100">
            <div class="container">
                <div class="account-setup-wrapper">
                    @include('frontend.user.client.job.create.job-header')
                    <div class="single-setup-account-inner custom-form profile-border-top">

                        {{-- AI Generate Button --}}
                        <div class="mb-4">
                            <button type="button" id="btn_open_ai_modal" class="btn-ai-generate">
                                <svg class="ai-btn-icon" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                <span class="ai-btn-text">{{ __('Generate with AI') }}</span>
                                <span class="ai-spinner"></span>
                            </button>
                        </div>

                        <x-validation.error/>
                        <form action="{{ route('client.job.create') }}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @include('frontend.user.client.job.create.job-details')
                            @include('frontend.user.client.job.create.job-budget')
                            @include('frontend.user.client.job.create.job-footer')
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Account Setup area end -->

        {{-- AI Input Modal --}}
        <div class="ai-modal-overlay" id="ai_modal_overlay">
            <div class="ai-modal-box">
                <button class="ai-modal-close" id="btn_close_ai_modal" type="button">&times;</button>
                <h4>{{ __('Generate Campaign with AI') }}</h4>
                <p>{{ __('Briefly describe what you need. AI will fill in the title, description, budget, category, and skills for you.') }}</p>
                <textarea
                    id="ai_description_input"
                    maxlength="500"
                    placeholder="{{ __('e.g. I need a social media influencer to promote my fitness brand on Instagram for 2 weeks') }}"
                ></textarea>
                <div class="ai-char-count"><span id="ai_char_count">0</span>/500</div>
                <div class="ai-unmatched-notice" id="ai_unmatched_notice"></div>
                <button type="button" id="btn_submit_ai" class="btn-ai-submit">
                    <span id="ai_submit_text">{{ __('Generate Job Post') }}</span>
                    <span id="ai_submit_spinner" style="display:none;width:14px;height:14px;border:2px solid rgba(255,255,255,0.4);border-top-color:#fff;border-radius:50%;animation:ai-spin .7s linear infinite;display:none;vertical-align:middle;"></span>
                </button>
            </div>
        </div>

    </main>
@endsection

@section('script')
    @include('frontend.user.client.job.create.create-job-js')
    @include('frontend.user.client.job.create.ai-job-generate-js')
    <x-summernote.summernote-js-function />
    <script>
        initializeSummernote($('.description'), {
            onKeyup: function(e) {
                setTimeout(function(){
                    let description_min_length = 10;
                    let job_description_length = $('#description').val().length;
                    if(job_description_length < description_min_length){
                        $('#job_description_char_length_check').html('<p class="text text-danger">{{ __('Length is short, minimum ') }}'+ description_min_length +' {{ __('required') }}.</p>');
                    }else{
                        $('#job_description_char_length_check').html('<p class="text text-success">{{ __('Length is valid') }}</p>');
                    }
                },200);
            }
        })
    </script>
    <x-select2.select2-js/>
@endsection
