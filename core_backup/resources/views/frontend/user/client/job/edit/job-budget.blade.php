<!-- Budget, Skills Start -->
<div class="setup-wrapper-contents">
    <div class="setup-wrapper-contents-item">
        <div class="setup-bank-form">
            <div class="setup-bank-form-item">
                <label class="label-title">{{ __('Campaign type') }}</label>
                <select class="form-control" name="type" id="type">
                    <option value="Onsite" {{ $job_details->type == 'Onsite' ? 'selected' : ''}}>{{ __('Onsite') }}</option>
                    <option value="Online" {{ $job_details->type == 'Online' ? 'selected' : ''}}>{{ __('Online') }}</option>
                </select>
            </div>
            <div class="setup-bank-form-item setup-bank-form-item-icon manage-fixed-jobs">
                <label class="label-title">{{ __('Enter Budget') }}</label>
                <input type="number" class="form--control" name="budget" id="budget" value="{{ $job_details->budget }}" placeholder="{{ __('Enter Your Budget') }}">
                <span class="input-icon">{{ get_static_option('site_global_currency') ?? '' }}</span>
            </div>
            <div class="single-input mt-3">
                <label class="label-title">{{ __('Select Skill') }}</label>
                <select name="skill[]" id="skill" class="inf-custom-select skill_select2" multiple>
                    @foreach($allSkills = \App\Models\Skill::all_skills() as $data)
                        <option
                            @foreach($job_details->job_skills as $skill)
                                {{ $skill->id === $data->id ? 'selected' : '' }}
                            @endforeach
                            value="{{ $data->id }}">{{ $data->skill }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="setup-bank-form-item">
                @php
                    $extension = pathinfo($job_details->attachment,PATHINFO_EXTENSION);
                    $extensions = array('png','jpg','jpeg','bmp','gif','tiff','svg');
                @endphp

                @if(in_array($extension, $extensions))
                    <div class="remove-attachment-wrap mb-4 img_max_width">
                        @if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi']))
                            <img class="remove_attachment w-100" src="{{ render_frontend_cloud_image_if_module_exists('jobs/'.$job_details->attachment, load_from: $job_details->load_from) }}" alt="{{ $job_details->attachment ?? '' }}">
                        @else
                            <img class="remove_attachment w-100" src="{{ asset('assets/uploads/jobs/'.$job_details->attachment) }}" alt="{{ $job_details->attachment ?? '' }}">
                        @endif
                    </div>
                @else
                    <div class="remove-attachment-wrap mb-4">
                        @if (!empty($job_details->attachment))
                            <span class="remove_attachment">
                                <a href="{{ asset('assets/uploads/jobs/' . $job_details->attachment) }}" download>
                                    {{ $job_details->attachment }}
                                </a>
                            </span>
                        @endif
                    </div>
                @endif
                <label class="photo-uploaded center-text w-100">
                    <div class="photo-uploaded-flex d-flex uploadImage">
                        <div class="photo-uploaded-icon"><i class="fa-solid fa-paperclip"></i></div>
                        <span class="photo-uploaded-para">{{ __('Add attachments') }}</span>
                    </div>
                    <input class="photo-uploaded-file inputTag" type="file" name="attachment" id="attachment">
                </label>
                @if(get_static_option('file_extensions'))
                    <p class="mt-2">
                        {{ __('Supported files:') }} {{ implode(', ', json_decode(get_static_option('file_extensions'), true)) }}
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Budget, Skills Ends -->
