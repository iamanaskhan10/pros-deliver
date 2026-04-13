<!-- Upload Gallery Start -->
<div class="setup-wrapper-contents">

    <div class="create-project-wrapper-item">
        <div class="create-project-wrapper-upload">
            <div class="upload-img create-project-wrapper-upload-browse center-text radius-10">
                <div class="media-upload-btn-wrapper">
                    <div class="img-wrap"></div>
                    <input type="hidden" id="gallery_images" name="gallery_images">
                    <button type="button" class="btn btn-info media_upload_form_btn"
                            data-btntitle="{{__('Select Image')}}"
                            data-modaltitle="{{__('Upload Image')}}"
                            data-mulitple="true"
                            data-bs-toggle="modal"
                            data-bs-target="#media_upload_modal">
                        {{__('Click to Upload Gallery Images')}}
                    </button>
                    <small>{{ __('image format: jpg,jpeg,png,gif,webp')}}</small> <br>
                    <small>{{ __('recommended size 680x410') }}</small>
                </div>
            </div>
        </div>
    </div>

    @if(get_static_option('project_video_upload') == 'yes')
        <div class="create-project-wrapper-item mt-5">
            <div class="create-project-wrapper-upload">
                <div class="upload-img create-project-wrapper-upload-browse center-text radius-10">
                    <div class="media-upload-btn-wrapper">
                        <div class="img-wrap"></div>
                        <input type="hidden" name="video">
                        <button type="button" class="btn btn-info media_upload_form_btn"
                                data-btntitle="{{__('Select Image')}}"
                                data-modaltitle="{{__('Upload Image')}}"
                                data-bs-toggle="modal"
                                data-bs-target="#media_upload_modal">
                            {{__('Click to Upload Project Video')}}
                        </button>
                        <small>{{ __('video format: mp4')}}</small> <br>
                        <small>{{ __('recommended size 10MB') }}</small>
                    </div>
                </div>
            </div>
        </div>
    @endif


</div>
<!-- Upload Gallery Ends -->