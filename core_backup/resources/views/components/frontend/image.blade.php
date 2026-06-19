<div class="upload-img text-center mt-3">
    <div class="media-upload-btn-wrapper">
        <div class="img-wrap new_image_gallery_add_listing">
            <img src="{{ asset('assets/common/img/listing_single_image.jpg') }}" alt="images" class="w-100">
        </div>
        <input type="hidden" name="gallery_images">
        <button type="button" class="btn btn-info media_upload_form_btn"
                data-btntitle="{{__('Select Image')}}"
                data-modaltitle="{{__('Upload Image')}}"
                data-mulitple="true"
                data-bs-toggle="modal"
                data-bs-target="#media_upload_modal">
            {{__('Click to Upload Gallery Images')}}
        </button>
        <small>{{ __('image format: jpg,jpeg,png,gif,webp')}}</small> <br>
        <small>{{ __('recommended size 810x450') }}</small>
    </div>
</div>