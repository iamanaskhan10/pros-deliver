@extends('backend.layout.master')
@section('title', __('Credit Deposit History'))
@section('content')
    <div class="dashboard__body">
        <div class="row">
            <div class="col-lg-12">
                <x-notice.general-notice :description="__('Notice: You can search here by deposit date.')" />
                <div class="customMarkup__single">
                    <div class="customMarkup__single__item">
                        <div class="customMarkup__single__item__flex">
                            <h4 class="customMarkup__single__title">{{ __('Credit Deposit History') }}</h4>
                            <x-search.search-in-table :id="'string_search'" :placeholder="__('Enter date to search')" />
                        </div>
                        <div class="customMarkup__single__inner mt-4">
                            <!-- Table Start -->
                            <div class="custom_table style-04 search_result">
                                @include('credit::backend.credit.search-result')
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
    <x-sweet-alert.sweet-alert2-js />
    @include('credit::backend.credit.credit-js')
@endsection
