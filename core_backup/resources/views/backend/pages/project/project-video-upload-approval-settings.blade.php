@extends('backend.layout.master')
@section('title', __('Project Video Upload Settings'))
@section('style')
    <x-media.css/>
@endsection
@section('content')
    <div class="dashboard__body">
        <div class="row">
            <div class="col-lg-6">
                <div class="customMarkup__single">
                    <div class="customMarkup__single__item">
                        <div class="customMarkup__single__item__flex">
                            <h4 class="customMarkup__single__title">{{ __('Project Video Upload Settings') }}</h4>
                        </div>
                        <x-validation.error />
                        <div class="customMarkup__single__inner mt-4">

                            <form action="{{route('admin.project.video.upload.settings')}}" method="POST">
                                @csrf
                                <div class="single-input my-5">
                                    <label class="label-title">{{ __('Project Video Upload') }}</label>
                                    <select name="project_video_upload" class="form-control">
                                        <option value="" selected>{{ __('Select One') }}</option>
                                        <option value="yes" @if(get_static_option('project_video_upload') == 'yes') selected @endif>{{ __('Yes') }}</option>
                                        <option value="no" @if(get_static_option('project_video_upload') == 'no') selected @endif>{{ __('No') }}</option>
                                    </select>
                                </div>
                                @can('job-auto-approval')
                                    <x-btn.submit :title="__('Update')" :class="'btn btn-primary mt-4 pr-4 pl-4'" />
                                @endcan
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup/>
@endsection
