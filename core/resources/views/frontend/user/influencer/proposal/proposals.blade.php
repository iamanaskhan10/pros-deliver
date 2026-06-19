@extends('frontend.layout.master')
@section('site_title',__('My Proposals'))
@section('style')
    {{-- Load the shared AI Translation engine --}}
    <x-ai-translate-toggle />
    <style>
        .cover-letter-text, .cover-letter-translated-text { white-space: pre-line; }
    </style>
@endsection
@section('content')
    <main>
        
        <x-breadcrumb.user-profile-breadcrumb :title="__('Proposals')" :innerTitle="__('My Proposals')"/>

        <!-- Profile Details area Starts -->
        <div class="profile-area pat-100 pab-100">
            <div class="container">
                <div class="row gy-4 justify-content-center">
                    <div class="@if(get_static_option('job_enable_disable') != 'disable') col-xl-8 col-lg-8 @else col-12 @endif">
                        <div class="shop-contents-wrapper-right">
                            <div class="myOrder-wrapper">
                                <div class="myOrder-wrapper-tabs">
                                    <div class="myOrder-tab-content">
                                        <div class="tab-content-item active">
                                            <div class="search_result">
                                                @include('frontend.user.influencer.proposal.search-result')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(get_static_option('job_enable_disable') != 'disable')
                    <div class="col-xl-4 col-lg-4">
                        <div class="profile-details-widget sticky_top">
                            <div class="file-wrapper-item-flex flex-between align-items-center">
                                <h4 class="inf-title title6 fw_bold"> {{__('Available Campaigns')}} </h4>
                                <a href="{{route('jobs.all')}}" class="btn-profile btn-bg-1"> {{__('Browse All')}} </a>
                            </div>
                            @if($jobs->count()>0)
                                @foreach ($jobs as $job)
                                    <div class="single-jobs bg-white mt-4">
                                        <div class="title-wraper">
                                            <h4 class="inf-title lg-font fw_semibold">
                                                <a href="{{ route('job.details', ['username' => $job->job_creator?->username, 'slug' => $job->slug]) }}">{{ $job->title }}</a>
                                            </h4>
                                            <h3 class="inf-title lg-font fw_bold primary_text">
                                                {{ float_amount_with_currency_symbol($job->budget) }}
                                            </h3>
                                        </div>
                                        <p class="single-jobs-dates d-flex gap-1">
                                            {{ $job->created_at->toFormattedDateString() ?? '' }} -
                                            <span class="inf-tag blue-tag">{{ ucfirst($job->level) ?? '' }}</span>
                                            <span class="inf-tag green-tag">{{ ucfirst($job->type) }}</span>
                                        </p>
                                        <div class="single-jobs-tag mt-4">
                                            @foreach ($job->job_skills as $skill)
                                                <a href="{{ route('skill.jobs', $skill->skill) }}" class="inf-tag">
                                                    {{ $skill->skill ?? '' }} </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h6 class="profile-wrapper-item-title">{{__('No Campaigns Found')}}</h6>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Profile Details area end -->
    </main>

    @include('frontend.user.influencer.proposal.cover-letter-modal')

@endsection

@section('script')
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){

                // When a proposal's "Proposal Details" button is clicked:
                // populate the modal with this proposal's cover letter text
                // and reset the translation state so it's fresh for each proposal.
                $(document).on('click', '.cover_letter_details', function(){
                    var coverLetter = $(this).data('cover-letter');

                    // Populate original text
                    $('#cover-letter-original').text(coverLetter);

                    // Clear translated state
                    $('#cover-letter-translated').text('').hide();
                    $('#cover-letter-tx-label').hide();

                    // Reset the translate pill button state
                    var btn = $('#cover-letter-translate-btn');
                    btn.prop('disabled', false)
                       .data('state', 'original')
                       .attr('data-state', 'original')
                       .removeAttr('data-translated');
                    btn.find('.ptx-icon').text('🌐').show();
                    btn.find('.ptx-label').text('{{ __('Translate to English') }}');
                    btn.find('.ptx-spinner').hide();

                    // Show original
                    $('#cover-letter-original').show();
                });

                $(document).on('click', '.pagination a', function(e){
                    e.preventDefault();
                    var page = $(this).attr('href').split('page=')[1];
                    loadProposals(page);
                });

                function loadProposals(page){
                    $.ajax({
                        url: "{{ route('influencer.proposal.paginate.data') . '?page=' }}" + page,
                        success: function(res){
                            $('.search_result').html(res);
                        }
                    });
                }
            });
        }(jQuery));
    </script>
@endsection

