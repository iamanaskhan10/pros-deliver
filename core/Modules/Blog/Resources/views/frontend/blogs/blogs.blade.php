@extends('frontend.layout.master')
@section('site_title', __('Blogs'))
@section('style')
    <x-select2.select2-css />
@endsection
@section('content')
    <main>
        <div class="influencer page-wraper pat-80 pab-120">
            <div class="container">
                @include('blog::frontend.blogs.topbar')
                <div class="blog_search_result">
                    @include('blog::frontend.blogs.search-result')
                </div>
            </div>
        </div>
    </main>

@endsection

@section('script')
    @include('blog::frontend.blogs.blog-js')
    <x-select2.select2-js />
@endsection
