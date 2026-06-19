@extends('backend.layout.master')
@section('title', __('All Portfolios'))
@section('style')
    <x-select2.select2-css/>
    <style>
        .portfolio-list-img {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
@endsection
@section('content')
    <div class="dashboard__body">
        <div class="row">
            <div class="col-lg-12">
                <div class="customMarkup__single">
                    <div class="customMarkup__single__item">
                        <div class="customMarkup__single__item__flex">
                            <h4 class="customMarkup__single__title">{{ __('All Portfolio Items') }}</h4>
                            <div class="search_delete_wrapper">
                                <x-search.search-in-table :id="'string_search'" />
                            </div>
                        </div>
                        <div class="customMarkup__single__inner mt-4">
                            <!-- Table Start -->
                            <div class="custom_table style-04 search_result">
                                @include('backend.pages.portfolio.search-result')
                            </div>
                            <!-- Table End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <x-sweet-alert.sweet-alert2-js/>
    <x-select2.select2-js/>
    @include('backend.pages.portfolio.portfolio-js')
@endsection
