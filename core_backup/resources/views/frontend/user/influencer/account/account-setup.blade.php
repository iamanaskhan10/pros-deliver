@extends('frontend.layout.master')
@section('site_title',__('Account Setup'))
@section('style')
    <x-select2.select2-css/>
{{--    <link rel="stylesheet" href="{{ asset('assets/backend/css/fontawesome-iconpicker.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/social-icon-picker.css') }}">
@endsection
@section('content')
            <x-breadcrumb.user-profile-breadcrumb :title="__('Account Setup')" :innerTitle="__('Account Setup')"/>
    <!-- Account Setup area Starts -->
    <div class="account-area pat-100 pab-100">
        <div class="container">
            <div class="setup-header setup-top-border">
                <div class="setup-header-flex">
                    <div class="setup-header-left">
                        <h4 class="setup-header-title">{{ get_static_option('account_page_title') ?? __('Setup Your Account') }}</h4>
                    </div>
                    <div class="setup-header-right">
                        <a href="{{ route('homepage') }}" class="setup-header-skip">{{ get_static_option('account_page_skip_title') ?? __('Skip') }}</a>
                    </div>
                </div>
            </div>
            <div class="setup-wrapper setup-top-border setup-bottom-border">
                <div class="setup-wrapper-flex">
                    <div>
                        @include('frontend.user.influencer.account.sidebar')
                    </div>
                    <div>
                        @include('frontend.user.influencer.account.introduction')
                        @include('frontend.user.influencer.account.social-profile.profile')
                        @include('frontend.user.influencer.account.work.work')
                        @include('frontend.user.influencer.account.skill.skill')
                        @include('frontend.user.influencer.account.language.language')
                        @include('frontend.user.influencer.account.location.location')
                        @include('frontend.user.influencer.account.hourly.hourly-rate')
                        @include('frontend.user.influencer.account.pre-next')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Account Setup area end -->
@endsection

{{--register script--}}
@section('script')
    <x-select2.select2-js/>
{{--    <script src="{{ asset('assets/backend/js/fontawesome-iconpicker.min.js') }}"></script>--}}
    <script src="{{ asset('assets/frontend/js/social-icon-picker.js') }}"></script>
    <x-icon-picker.icon-picker />
    @include('frontend.user.influencer.account.account-setup-js')
@endsection
