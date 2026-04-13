@extends('backend.layout.master')
@section('title', __('Location Settings'))
@section('content')
    <div class="dashboard__body">
        <div class="row">
            <div class="col-lg-6">
                <div class="customMarkup__single">
                    <div class="customMarkup__single__item">
                        <div class="customMarkup__single__item__flex">
                            <h4 class="customMarkup__single__title">{{ __('Location Settings') }}</h4>
                        </div>
                        <x-validation.error />
                        <div class="customMarkup__single__inner mt-4">
                            <form action="{{route('admin.page.account.location')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <x-form.text :title="__('Menu Title')" :type="__('text')" :name="'location_menu_title'" :value="get_static_option('location_menu_title') ?? '' " :placeholder="__('Enter menu title')"/>
                                <br>
                                <x-form.text :title="__('Menu Subtitle')" :type="__('text')" :name="'location_menu_sub_title'" :value="get_static_option('location_menu_sub_title') ?? '' " :placeholder="__('Enter menu subtitle')"/>
                                <br>
                                <x-form.text :title="__('Country Title')" :type="__('text')" :name="'location_country_title'" :value="get_static_option('location_country_title') ?? '' " :placeholder="__('Enter country title')"/>
                                <br>
                                <x-form.text :title="__('State Title')" :type="__('text')" :name="'location_state_title'" :value="get_static_option('location_state_title') ?? '' " :placeholder="__('Enter state title')"/>
                                <br>
                                <x-form.text :title="__('City Title')" :type="__('text')" :name="'location_city_title'" :value="get_static_option('location_city_title') ?? '' " :placeholder="__('Enter city title')"/>
                                <br>
                                @can('education-page-settings-update')
                                <x-btn.submit :title="__('Update')" :class="'btn btn-primary mt-4 pr-4 pl-4'" />
                                @endcan
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
