@extends('frontend.layout.master')
@section('site_title',__('All Campaigns'))
@section('style')
    <x-summernote.summernote-css/>
    <x-select2.select2-css/>
    <style>
        .disabled-link {
            background-color: #ccc !important;
            pointer-events: none;
            cursor: default;
        }
    </style>
@endsection
@section('content')
    <main>
        <x-breadcrumb.user-profile-breadcrumb :title="__('My Campaigns')" :innerTitle="__('My Campaigns')"/>
        <!-- Profile Details area Starts -->
        <div class="profile-area pat-100 pab-100">
            <div class="container">
                <div class="row gy-4 justify-content-center">
                    <div class="@if(get_static_option('project_enable_disable') != 'disable') col-xl-8 col-lg-9 @else col-12 @endif">
                        <div class="sticky_top_lg">
                            @include('frontend.user.client.job.my-job.header')
                            <div class="search_result">
                                @include('frontend.user.client.job.my-job.search-result')
                            </div>
                        </div>
                    </div>
                    @if(get_static_option('project_enable_disable') != 'disable')
                    <div class="col-xl-4 col-lg-7">
                        <div class="profile-details-widget sticky_top_lg">
                            <div class="file-wrapper-item-flex flex-between align-items-center profile-border-bottom">
                                <h4 class="inf-title title6 fw_bold"> {{ __('Project Catalogues') }} </h4>
                                <a href="{{ route('projects.all') }}" class="btn-profile btn-bg-1"> {{ __('Browse All ') }} <i class="fas fa-arrow-right"></i></a>
                            </div>
                            @if($top_projects->count() > 0)
                                @foreach($top_projects as $project)
                                    <x-frontend.project-card :project="$project" />
                                @endforeach
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
    <x-summernote.summernote-js/>
    <x-select2.select2-js/>
    <x-sweet-alert.sweet-alert2-js/>
    <script>
        let mainPageUrl = {href: window.location.href};
    </script>

    @include('frontend.user.client.job.my-job.all-jobs-js')
@endsection
