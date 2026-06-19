@extends('frontend.layout.master')
@section('site_title', __('Campaigns'))
@section('meta_title'){{ __('Campaigns') }}@endsection
@section('style')
    <x-select2.select2-css />
@endsection
@section('content')
    <main>
        <div class="influencer page-wraper pat-80 pab-120">
            <div class="container">
                @include('frontend.pages.jobs.topbar')
                <div class="search_job_result mt-4">
                    @include('frontend.pages.jobs.search-job-result')
                </div>
            </div>
        </div>
    </main>

@endsection

@section('script')
    @include('frontend.pages.jobs.jobs-filter-js')
    <x-select2.select2-js />
@endsection
