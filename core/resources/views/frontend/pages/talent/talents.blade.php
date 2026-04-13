@extends('frontend.layout.master')
@section('site_title', __('Influencers'))
@section('meta_title'){{ __('Influencers') }}@endsection
@section('style')
    <x-select2.select2-css />
@endsection
@section('content')
    <main>
        <div class="influencer page-wraper pat-80 pab-120">
            <div class="container">
                @include('frontend.pages.talent.topbar')

                <div class="shop-contents-wrapper-right search_talent_result mt-4">
                    @include('frontend.pages.talent.search-talent-result')
                </div>
            </div>
        </div>
    </main>

    @if(moduleExists('Credit'))
    <!-- Unlock Social Modal -->
    <div class="modal fade" id="unlockSocialModal" tabindex="-1" aria-labelledby="unlockSocialModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="unlockSocialModalLabel">{{ __('Unlock Social Profiles') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p class="mb-1 text-muted">{{ __('Each unlock reveals all social media profiles of this influencer.') }}</p>
                        <hr>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>{{ __('Available Credits:') }}</span>
                        <strong id="client_available_credits">0</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2 text-danger">
                        <span>{{ __('Credits Required:') }}</span>
                        <strong id="unlock_cost_credits">0</strong>
                    </div>
                    <div id="credit_shortage_msg" class="alert alert-danger p-2 mt-3 d-none">
                        {{ __('You do not have enough credits.') }} 
                        <a href="{{ route('client.credit.history') }}" class="btn btn-sm btn-primary ms-2">{{ __('Buy Credits') }}</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="influencer_id_to_unlock">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-primary" id="confirm_unlock_btn">{{ __('Unlock Now') }}</button>
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection

@section('script')
    @include('frontend.pages.talent.talent-filter-js')
    <x-select2.select2-js />
    @if(moduleExists('Credit'))
    <script>
        $(document).ready(function() {
            "use strict";

            $(document).on('click', '.unlock_social_btn', function() {
                let influencer_id = $(this).data('influencer_id');
                let credits_required = $(this).data('credits_required');
                let balance = $(this).data('balance');

                $('#influencer_id_to_unlock').val(influencer_id);
                $('#unlock_cost_credits').text(credits_required);
                $('#client_available_credits').text(balance);

                if (balance < credits_required) {
                    $('#credit_shortage_msg').removeClass('d-none');
                    $('#confirm_unlock_btn').prop('disabled', true);
                } else {
                    $('#credit_shortage_msg').addClass('d-none');
                    $('#confirm_unlock_btn').prop('disabled', false);
                }
            });

            $(document).on('click', '#confirm_unlock_btn', function() {
                let influencer_id = $('#influencer_id_to_unlock').val();
                let btn = $(this);

                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> {{ __("Unlocking...") }}');

                $.ajax({
                    url: "{{ route('client.credit.unlock.influencer') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        influencer_id: influencer_id
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            toastr_success_js(res.message);
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    },
                    error: function(err) {
                        let msg = err.responseJSON.message || "{{ __('Something went wrong') }}";
                        toastr_error_js(msg);
                        btn.prop('disabled', false).text('{{ __("Unlock Now") }}');
                    }
                });
            });
        });
    </script>
    @endif
@endsection
