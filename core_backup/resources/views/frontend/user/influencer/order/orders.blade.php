@extends('frontend.layout.master')
@section('site_title', __('My Orders'))
@section('content')
    <main>
        
        <x-breadcrumb.user-profile-breadcrumb :title="__('My Orders')" :innerTitle="__('My Orders')" />
        <!-- Profile Details area Starts -->
        <div class="profile-area pat-100 pab-100">
            <div class="container">
                <div class="row gy-4 justify-content-center">
                    <div class="@if(get_static_option('job_enable_disable') != 'disable') col-xl-8 col-lg-8 @else col-12 @endif">
                        <div class="shop-contents-wrapper-right">
                            <div class="myOrder-wrapper">
                                <div class="myOrder-wrapper-tabs">
                                    <div class="tabs">
                                        @include('frontend.user.influencer.order.order-count')
                                    </div>
                                    <div class="myOrder-tab-content">
                                        <div class="tab-content-item active">
                                            <div class="search_result">
                                                @include('frontend.user.influencer.order.search-result')
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
                                <a href="{{route('jobs.all')}}" class="btn-profile btn-bg-1"> {{__('See All')}} <i class="fas fa-arrow-right"></i></a>
                            </div>

                            @if($jobs->count()>0)
                            @foreach ($jobs as $job)
                                <div class="single-jobs radius-10 bg-white mt-4">
                                    <div class="title-wraper">
                                        <h4 class="inf-title lg-font fw_semibold">
                                            <a href="{{ route('job.details', ['username' => $job->job_creator?->username, 'slug' => $job->slug]) }}">
                                                {{ $job->title }}
                                            </a>
                                        </h4>
                                        <h3 class="inf-title lg-font fw_bold primary_text">
                                            @if($job->type == 'hourly')
                                                {{ float_amount_with_currency_symbol($job->hourly_rate) }}
                                            @else
                                                {{ float_amount_with_currency_symbol($job->budget) }}
                                            @endif
                                        </h3>
                                    </div>
                                    <div class="single-jobs-dates d-flex">
                                        {{ $job->created_at->toFormattedDateString() ?? '' }} -
                                        <span class="inf-tag blue-tag">{{ ucfirst($job->level) ?? '' }}</span>
                                        <span class="inf-tag green-tag">{{ ucfirst($job->type) }}</span>
                                    </div>
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
@endsection

@section('script')
    <x-sweet-alert.sweet-alert2-js />
    @include('frontend.user.influencer.order.order-js')
@endsection
