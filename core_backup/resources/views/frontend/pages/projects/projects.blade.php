@extends('frontend.layout.master')
@section('site_title', __('Projects'))
@section('meta_title'){{ __('Projects') }}@endsection
@section('style')
    <x-select2.select2-css />
@endsection
@section('content')
    <main>
        <div class="influencer page-wraper pat-80 pab-120">
            <div class="container">
                @include('frontend.pages.projects.topbar')
                <div class="search_result mt-4">
                    @include('frontend.pages.projects.search-result')
                </div>
            </div>
        </div>
    </main>

@endsection

@section('script')
    @include('frontend.pages.projects.project-filter-js')
    <x-select2.select2-js />
@endsection
