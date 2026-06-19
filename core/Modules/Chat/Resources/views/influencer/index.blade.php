@extends('frontend.layout.master')
@section('site_title', __('Live Chat'))

@section('style')
    <x-summernote.summernote-css />
    <style>
        .disabled-link {
            background-color: #ccc !important;
            pointer-events: none;
            cursor: default;
        }

        .show_uploaded_file_area {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
        }

        .remove-uploaded-file {
            background-color: #FF0000;
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 14px;
            cursor: pointer;
            line-height: 18px;
            text-align: center;
        }
        .dropMedia__file{
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <main class="">
                <x-breadcrumb.user-profile-breadcrumb :title="__('Chats')" :innerTitle="__('Chats')"/>
        <!-- Profile Details area Starts -->
        <div class="responsive-overlay"></div>
        <div class="profile-area pat-80 pab-80 section-bg-2">
            <div class="container">
                <div class="row g-4">
                    @if ($freelancer_chat_list->count() > 0)
                        <div class="col-lg-12">
                            <div class="chat-wrapper">
                                <div class="chat-wrapper-flex">
                                    <div class="chat-sidebar chatText d-lg-none chat-sidebar-btn-wraper">
                                        {{ __('View Chat List') }}
                                    </div>
                                    <div class="chat-wrapper-contact">
                                        <div class="chat-wrapper-contact-close">
                                            <div class="close-chat d-lg-none"> <i class="fas fa-times"></i> </div>
                                            <ul class="chat-wrapper-contact-list">
                                                @foreach ($freelancer_chat_list as $freelancer_chat)
                                                    <x-chat::influencer.client-list :freelancerChat="$freelancer_chat" />
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="chat-wrapper-details">

                                        <div class="chat-wrapper-details-header d-none flex-between" id="chat_header">

                                        </div>

                                        <div class="chat-wrapper-details-inner client-chat-body" id="chat_body">

                                        </div>

                                        <div class="chat-wrapper-details-footer profile-border-top d-none"
                                            id="freelancer-message-footer">
                                            <div class="chat-wrapper-details-footer-form custom-form">
                                                <form action="#">
                                                    <div class="single-input">
                                                        <textarea name="message" id="message" class="form--control form-message" placeholder="{{ __('Write your message') }}"></textarea>
                                                    </div>
                                                </form>
                                                <div
                                                    class="chat-wrapper-details-footer-btn flex-btn justify-content-end mt-3">
                                                    <div class="position-relative">
                                                        <input class="photo-uploaded-file inputTag d-none" id="message-file"
                                                            type="file">

                                                        <label for="message-file" class="dropMedia__file">
                                                            <i class="fa-solid fa-paperclip"></i> {{ __('Attach Files') }}
                                                        </label>

                                                        <span class="show_uploaded_file_area d-none">
                                                            <span class="show_uploaded_file"></span>
                                                            <button type="button" class="remove-uploaded-file"
                                                                title="{{ __('Remove File') }}">&times;</button>
                                                        </span>
                                                    </div>
                                                    @if (moduleExists('SecurityManage'))
                                                        @if (Auth::guard('web')->user()->freeze_chat == 'freeze')
                                                            <a href="javascript:void(0)"
                                                                class="btn-profile btn-bg-1 @if (Auth::guard('web')->user()->freeze_chat == 'freeze') disabled-link @endif">{{ __('Send Message') }}</a>
                                                        @else
                                                            <a href="javascript:void(0)" class="btn-profile btn-bg-1"
                                                                id="freelancer-send-message-to-client">{{ __('Send Message') }}</a>
                                                        @endif
                                                    @else
                                                        <a href="javascript:void(0)" class="btn-profile btn-bg-1"
                                                            id="freelancer-send-message-to-client">{{ __('Send Message') }}</a>
                                                    @endif
                                                </div>
                                                <div class="chat-wrapper-details-footer-btn-right" style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                                                    <button id="ai-smart-reply-btn"
                                                            style="background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border:none;border-radius:6px;padding:5px 12px;font-size:12px;font-weight:600;cursor:pointer;display:flex;align-items:center;gap:4px;">
                                                        <span id="ai-smart-reply-spinner" style="width:11px;height:11px;border:2px solid rgba(255,255,255,.4);border-top-color:#fff;border-radius:50%;animation:ai-spin .6s linear infinite;display:none;"></span>
                                                        <span id="ai-smart-reply-btn-text">&#128172; {{ __('Smart Reply') }}</span>
                                                    </button>
                                                    @if (get_static_option('file_extensions'))
                                                        <small>{{ __('Supported files:') }}
                                                            {{ implode(', ', json_decode(get_static_option('file_extensions'), true)) }}</small>
                                                    @else
                                                        <small>{{ __('Supported files: jpeg,jpg,png,pdf,gif,docx,zip') }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-12">
                            <div class="chat-wrapper">
                                <x-frontend.not-found />
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Profile Details area end -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('influencer.offer.send') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="client_id" id="client_id">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>{{ __('Send Offer') }}</h3>
                        </div>
                        <div class="modal-body">
                            <x-notice.general-notice :description="__(
                                'Notice: Please discuss project requirements and budget with the client before sending an offer to prevent misunderstandings.',
                            )" :description1="__('Notice: If pay by milestone you can skip description section')" />
                            <div class="offer_total_price mt-5 setup-bank-form-item setup-bank-form-item-icon">
                                <labe><strong>{{ __('Offer Price') }}</strong></labe>
                                <input type="number" class="form-control" name="offer_price" id="offer_price"
                                    placeholder="{{ __('Enter Price') }}">
                                <span class="input-icon">{{ get_static_option('site_global_currency') ?? '' }}</span>
                            </div>
                            <br>

                            <div class="description_wrapper">
                                <div class="row g-4">
                                    <div class="col-sm-6">
                                        <div class="single-input">
                                            <label class="label-title">{{ __('Revision') }}</label>
                                            <input type="number" min="1" max="200" class="form-control"
                                                name="offer_revision" id="offer_revision"
                                                placeholder="{{ __('Enter Revision') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="single-input">
                                            <x-duration.delivery-time :class="'single-input set_dead_line'" :title="__('Delivery Time')" :name="'offer_deadline'"
                                                :id="'offer_deadline'" />
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="single-input">
                                            <label class="label-title">{{ __('Description') }}</label>
                                            <textarea name="offer_description" id="offer_description" rows="5" class="form-control summernote"
                                                placeholder="{{ __('Enter a description') }}"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-profile btn-outline-gray btn-hover-danger"
                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit"
                                class="btn-profile btn-bg-1 send_offer_realtime_validation">{{ __('Send Offer') }}</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <audio id="chat-alert-sound" style="display: none">
            <source src="{{ asset('assets/uploads/chat_image/sound/facebook_chat.mp3') }}" />
        </audio>
    </main>
@endsection

@section('script')
    <script src="{{ asset('assets/common/js/helpers.js') }}"></script>
    <script>
        let client_list = {
            {{ $arr }}
        };
    </script>
    {{-- Removed duplicate --}}

    <script>
        //:get_client_id
        $(document).on('click', '.get_client_id', function() {
            $('#client_id').val($(this).data('client-id'));
        });

        //pay by milestone
        $(document).on('click', '#pay_by_milestone_btn', function() {
            $('.milestone_wrapper').removeClass('d-none');
            $('.description_wrapper').addClass('d-none');

            $('#pay_by_milestone').val('pay-by-milestone');
            $('#pay_at_once').val('');

            $("#pay_by_milestone_btn").addClass("active");
            $("#pay_at_once_btn").removeClass("active");
        });

        //pay at once
        $(document).on('click', '#pay_at_once_btn', function() {
            $('.description_wrapper').removeClass('d-none');
            $('.milestone_wrapper').addClass('d-none');

            $('#pay_at_once').val('pay-at-once');
            $('#pay_by_milestone').val('');

            $("#pay_at_once_btn").addClass("active");
            $("#pay_by_milestone_btn").removeClass("active");

        });

        //send_offer_realtime_validation
        $(document).on('click', '.send_offer_realtime_validation', function() {

            let pay_by_milestone = $('#pay_by_milestone').val();
            let pay_at_once = $('#pay_at_once').val();
            let offer_price = $('#offer_price').val();
            let offer_revision = $('#offer_revision').val();
            let offer_deadline = $('#offer_deadline').val();

            if (offer_price == '') {
                toastr_warning_js("{{ __('Please fill price field') }}")
                return false;
            }

            if (pay_at_once == 'pay-at-once') {
                if (offer_revision == '' || offer_deadline == '') {
                    toastr_warning_js("{{ __('Please fill all fields') }}")
                    return false;
                }
            }

            if (pay_by_milestone == 'pay-by-milestone') {

                let milestone_title = [],
                    milestone_description = [],
                    milestone_price = [],
                    milestone_revision = [],
                    milestone_deadline = [],
                    total_milestone_price = 0;

                $('.milestone_title').each(function() {
                    let value = $(this).val();
                    if (value) {
                        milestone_title.push(value);
                    }
                });

                $('.milestone_description').each(function() {
                    let value = $(this).val();
                    if (value) {
                        milestone_description.push(value);
                    }
                });


                $('.milestone_price').each(function() {
                    let value = $(this).val();
                    if (value) {
                        milestone_price.push(value);
                        total_milestone_price = parseInt(total_milestone_price) + parseInt(value);
                    }
                });

                $('.milestone_revision').each(function() {
                    let value = $(this).val();
                    if (value) {
                        milestone_revision.push(value);
                    }
                });

                $('.milestone_deadline').each(function() {
                    let value = $(this).val();
                    if (value) {
                        milestone_deadline.push(value);
                    }
                });

                if (offer_price != total_milestone_price) {
                    toastr_warning_js("{{ __('Total milestone price must be equal to offer price') }}")
                    return false;
                }

                if (offer_price == '' || milestone_title.length === 0 || milestone_description.length === 0 ||
                    milestone_price.length === 0 || milestone_revision.length === 0 || milestone_deadline.length ===
                    0) {
                    toastr_warning_js("{{ __('Please fill all fields') }}")
                    return false;
                }
            }
        })
    </script>

    <script>
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                toastr.warning("{{ $error }}");
            @endforeach
        @endif
    </script>
    <x-summernote.summernote-js />
    <x-chat::influencer.freelancer-chat-js />
    @include('chat::influencer.ai-smart-reply-js')
@endsection
