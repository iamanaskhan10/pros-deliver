<form id="profile_photo_change" method="post" enctype="multipart/form-data">
    @csrf
    <!-- Modal -->
    <div class="modal fade" id="profilePhotoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Profile Photo/Video Preview') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="error_msg_container"></div>
                    <div class="modal-body file-wrapper text-center">
                        <!-- Preview container -->
                        <div class="preview-container">
                            <!-- Placeholder for preview; will be populated by JavaScript -->
                        </div>
                        <input type="file" name="image" class="d-none profile_photo_upload" accept="image/*,video/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.querySelector('.profile_photo_upload');
        const previewContainer = document.querySelector('.preview-container');
        const profilePhotoInput = document.querySelector('#profile_photo'); // The original file input
        const profilePhotoModal = new bootstrap.Modal(document.getElementById('profilePhotoModal'));

        // Trigger modal and file input when the profile photo button is clicked
        profilePhotoInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                // Copy file to the hidden input in the modal
                fileInput.files = event.target.files;
                updatePreview(file);
                profilePhotoModal.show();
            }
        });

        // Update preview based on file type
        function updatePreview(file) {
            // Clear previous preview
            previewContainer.innerHTML = '';

            const fileExtension = file.name.split('.').pop().toLowerCase();
            const isVideo = ['mp4', 'webm', 'avi', 'mov'].includes(fileExtension);

            if (isVideo) {
                // Create video element for preview
                const video = document.createElement('video');
                video.src = URL.createObjectURL(file);
                video.controls = true;
                video.className = 'profile_photo_preview';
                video.style.maxWidth = '100%';
                video.style.maxHeight = '300px';
                previewContainer.appendChild(video);
            } else {
                // Create image element for preview
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.alt = 'Profile Preview';
                img.className = 'profile_photo_preview';
                img.style.maxWidth = '100%';
                img.style.maxHeight = '300px';
                previewContainer.appendChild(img);
            }
        }

        // Handle file change in the modal (if user reselects a file)
        fileInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                updatePreview(file);
            }
        });
    });
</script>

{{--<form id="profile_photo_change" method="post" enctype="multipart/form-data">--}}
{{--    @csrf--}}
{{--    <!-- Modal -->--}}
{{--    <div class="modal fade" id="profilePhotoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Profile Media Preview') }}</h5>--}}
{{--                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <div class="error_msg_container"></div>--}}
{{--                    <div class="modal-body file-wrapper text-center">--}}
{{--                        <!-- JS will inject preview here -->--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</form>--}}

{{--<script>--}}
{{--    document.getElementById('profile_photo').addEventListener('change', function (event) {--}}
{{--        const file = event.target.files[0];--}}
{{--        if (!file) return;--}}

{{--        const wrapper = document.querySelector('.modal-body.file-wrapper');--}}
{{--        wrapper.innerHTML = ''; // clear any old preview--}}

{{--        const url = URL.createObjectURL(file);--}}

{{--        if (file.type.startsWith('image/')) {--}}
{{--            const img = document.createElement('img');--}}
{{--            img.src = url;--}}
{{--            img.alt = "Preview";--}}
{{--            img.className = "profile_media_preview img-fluid";--}}
{{--            wrapper.appendChild(img);--}}
{{--        } else if (file.type.startsWith('video/')) {--}}
{{--            const video = document.createElement('video');--}}
{{--            video.src = url;--}}
{{--            video.controls = true;--}}
{{--            video.className = "profile_media_preview w-100";--}}
{{--            wrapper.appendChild(video);--}}
{{--        }--}}
{{--    });--}}
{{--</script>--}}

