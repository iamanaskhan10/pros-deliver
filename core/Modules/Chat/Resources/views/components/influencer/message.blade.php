@php
    $project = isset($message->message['project']) ? json_decode(json_encode($message->message['project'])) : null;
@endphp

{{-- Load the shared translation engine (renders only once per page) --}}
<x-ai-translate-toggle />

@if($message->from_user == 1)
    <div class="chat-wrapper-details-inner-chat">
        <div class="chat-wrapper-details-inner-chat-flex">
            <div class="chat-wrapper-details-inner-chat-thumb">
                @if($data->client?->image)
                    @if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi']))
                        <img src="{{ render_frontend_cloud_image_if_module_exists('profile/'. $data?->client?->image, load_from: $data?->client?->load_from ?? '') }}" alt="{{ $data->client?->fullname }}">
                    @else
                        <img src="{{ asset('assets/uploads/profile/'.$data->client?->image) }}" alt="">
                    @endif
                @else
                    <img src="{{ asset('assets/static/img/author/author.jpg') }}" alt="{{ __('author') }}">
                @endif
            </div>
            <div class="chat-wrapper-details-inner-chat-contents {{ !empty($project->type) ? "bg-danger p-2 text-dark bg-opacity-10" : "" }}">
                <p class="chat-wrapper-details-inner-chat-contents-para {{ !empty($project) ? "d-none" : "" }}">
                    @if(!empty($message->message['message']))
                    <span class="chat-wrapper-details-inner-chat-contents-para-span">{{ $message->message['message'] ?? '' }}</span>
                    @endif
                    @if(!empty($message->file))
                        <br /><br />
                        @php $ext = pathinfo($message->file, PATHINFO_EXTENSION); @endphp
                        @if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi']))
                            @if(in_array($ext, ['pdf','docx','zip','doc','csv','txt','xlx','xlsx','ppt','pptx','rar','7z']))
                                <a class="download-pdf-chat mt-2" href="{{ render_frontend_cloud_image_if_module_exists('media-uploader/live-chat/'. $message->file, load_from: $message->load_from) }}" download>{{ __('Download file') }}</a>
                            @else
                                <img src="{{ render_frontend_cloud_image_if_module_exists('media-uploader/live-chat/'.$message->file, load_from: $message->load_from) }}">
                                <br />
                                <a class="download-pdf-chat mt-2" href="{{ render_frontend_cloud_image_if_module_exists('media-uploader/live-chat/'. $message->file, load_from: $message->load_from) }}" download>{{ __('Download file') }}</a>
                            @endif
                        @else
                            @if(in_array($ext, ['pdf','docx','zip','doc','csv','txt','xlx','xlsx','ppt','pptx','rar','7z']))
                                <a class="download-pdf-chat mt-2" href="{{ asset('assets/uploads/media-uploader/live-chat/'. $message->file) }}" download>{{ __('Download file') }}</a>
                            @else
                                <img src="{{ asset('assets/uploads/media-uploader/live-chat/'. $message->file) }}" alt="{{ $message->file ?? '' }}">
                                <br />
                                <a class="download-pdf-chat mt-2" href="{{ asset('assets/uploads/media-uploader/live-chat/'. $message->file) }}" download>{{ __('Download file') }}</a>
                            @endif
                        @endif
                    @endif
                </p>

                {{-- Translated text area (hidden by default, shown after translation) --}}
                @if(!empty($message->message['message']))
                <div class="chat-tx-translated-area" id="chat-tx-area-{{ $message->id }}" style="display:none;">
                    <div class="chat-tx-translated-label">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                        {{ __('Translated') }}
                    </div>
                    <p class="chat-tx-translated-text"></p>
                </div>
                @endif

                @if(!empty($project))
                    <div class="card mb-3" style="max-width:540px;">
                        <div class="row g-0">
                            <div class="col-md-4 {{ ($project->type ?? '') == 'job' ? 'd-none' : '' }}">
                                @if(($project->type ?? '') != 'job')
                                    @php
                                        $image_ids = explode('|', $project->image);
                                        $img_url   = '';
                                        if (!empty($image_ids[0])) {
                                            $shake_img = get_attachment_image_by_id($image_ids[0], null, true);
                                            if (!empty($shake_img)) { $img_url = $shake_img['img_url']; }
                                        }
                                    @endphp
                                    <img src="{!! $img_url !!}" class="img-fluid rounded-start">
                                @endif
                            </div>
                            <div class="{{ ($project->type ?? '') == 'job' ? 'col-md-12' : 'col-md-8' }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $project->title }}</h5>
                                    @if(($project->type ?? '') == 'job')
                                        <a class="btn btn-primary btn-sm" target="_blank" href="{{ route('job.details', ['username' => $project->username, 'slug' => $project->slug]) }}">{{ __('View details') }}</a>
                                    @else
                                        <a class="btn btn-primary btn-sm" target="_blank" href="{{ route('shake.details', ['username' => $project->username, 'slug' => $project->slug]) }}">{{ __('View details') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        @if(($project->type ?? '') == 'job')
                            <h5>{{ $project->interview_message ?? '' }}</h5>
                        @endif
                    </div>
                @endif

                {{-- Timestamp row with inline translate link --}}
                <div class="chat-msg-footer">
                    <span class="chat-wrapper-details-inner-chat-contents-time">
                        {{ $message->created_at->diffForHumans() }}
                    </span>
                    @if(!empty($message->message['message']))
                    <button
                        type="button"
                        class="chat-tx-inline-btn"
                        data-msg-id="{{ $message->id }}"
                        data-original-text="{{ e($message->message['message'] ?? '') }}"
                        data-target-lang="{{ config('ai.translation.default_target', 'en') }}"
                        data-tx-state="original"
                        title="{{ __('Translate this message') }}"
                    >
                        <span class="chat-tx-inline-spinner"></span>
                        <svg class="chat-tx-inline-icon" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                        <span class="chat-tx-inline-label">{{ __('Translate') }}</span>
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif

@if($message->from_user == 2)
    <div class="chat-wrapper-details-inner-chat chat-reply">
        <div class="chat-wrapper-details-inner-chat-flex">
            <div class="chat-wrapper-details-inner-chat-thumb">
                @if($data->freelancer?->image)
                    <img src="{{ asset('assets/uploads/profile/'.$data->freelancer?->image) }}" alt="">
                @else
                    <img src="{{ asset('assets/static/img/author/author.jpg') }}" alt="{{ __('author') }}">
                @endif
            </div>
            <div class="chat-wrapper-details-inner-chat-contents">
                <p class="chat-wrapper-details-inner-chat-contents-para">
                    @if(!empty($message->message['message']))
                    <span class="chat-wrapper-details-inner-chat-contents-para-span">{{ $message->message['message'] ?? '' }}</span>
                    @endif
                    @if(!empty($message->file))
                        <br /><br />
                        @php $ext = pathinfo($message->file, PATHINFO_EXTENSION); @endphp
                        @if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi']))
                            @if(in_array($ext, ['pdf','docx','zip','doc','csv','txt','xlx','xlsx','ppt','pptx','rar','7z']))
                                <a class="download-pdf-chat mt-2" href="{{ render_frontend_cloud_image_if_module_exists('media-uploader/live-chat/'. $message->file, load_from: $message->load_from) }}" download>{{ __('Download file') }}</a>
                            @else
                                <img src="{{ render_frontend_cloud_image_if_module_exists('media-uploader/live-chat/'.$message->file, load_from: $message->load_from) }}">
                                <br />
                                <a class="download-pdf-chat mt-2" href="{{ render_frontend_cloud_image_if_module_exists('media-uploader/live-chat/'. $message->file, load_from: $message->load_from) }}" download>{{ __('Download file') }}</a>
                            @endif
                        @else
                            @if(in_array($ext, ['pdf','docx','zip','doc','csv','txt','xlx','xlsx','ppt','pptx','rar','7z']))
                                <a class="download-pdf-chat mt-2" href="{{ asset('assets/uploads/media-uploader/live-chat/'. $message->file) }}" download>{{ __('Download file') }}</a>
                            @else
                                <img src="{{ asset('assets/uploads/media-uploader/live-chat/'. $message->file) }}" alt="{{ $message->file ?? '' }}">
                                <br />
                                <a class="download-pdf-chat mt-2" href="{{ asset('assets/uploads/media-uploader/live-chat/'. $message->file) }}" download>{{ __('Download file') }}</a>
                            @endif
                        @endif
                    @endif
                </p>

                @if(!empty($project))
                    <div class="card mb-3" style="max-width:540px; margin-left:auto">
                        <div class="row g-0">
                            <div class="col-md-4 {{ ($project->type ?? '') == 'job' ? 'd-none' : '' }}">
                                @if(($project->type ?? '') != 'job')
                                    @php
                                        $image_ids = explode('|', $project->image);
                                        $img_url   = '';
                                        if (!empty($image_ids[0])) {
                                            $shake_img = get_attachment_image_by_id($image_ids[0], null, true);
                                            if (!empty($shake_img)) { $img_url = $shake_img['img_url']; }
                                        }
                                    @endphp
                                    <img src="{!! $img_url !!}" class="img-fluid rounded-start">
                                @endif
                            </div>
                            <div class="{{ ($project->type ?? '') == 'job' ? 'col-md-12' : 'col-md-8' }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $project->title }}</h5>
                                    <a class="btn btn-primary btn-sm" target="_blank" href="{{ route('shake.details', ['username' => $project->username, 'slug' => $project->slug]) }}">{{ __('View details') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <span class="chat-wrapper-details-inner-chat-contents-time mt-2">
                    {{ $message->created_at->diffForHumans() }}
                </span>
            </div>
        </div>
    </div>
@endif
