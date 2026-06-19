@extends('backend.layout.master')
@section('title', __('Influencer Contact Info Settings'))
@section('style')
    <x-media.css/>
@endsection
@section('content')
    <div class="dashboard__body">
        <div class="row">
            <div class="col-lg-8">
                <div class="customMarkup__single">
                    <div class="customMarkup__single__item">
                        <div class="customMarkup__single__item__flex">
                            <h4 class="customMarkup__single__title">
                                {{ __('Influencer Contact Info Access') }}
                            </h4>
                        </div>

                        <x-validation.error />

                        <div class="customMarkup__single__inner mt-4">
                            <x-notice.general-notice
                                    :class="'mt-4'"
                                    :description="__('Clients can only view influencer contact details (social links, email, etc.) after unlocking the profile.')"
                                    :description1="__('You may allow free access or require credits for unlocking — helping prevent off-platform contact bypass.')"
                            />

                            <form action="{{ route('admin.influencer.contact.info.settings') }}" method="POST" class="mt-5 custom-form">
                                @csrf

                                <!-- 2.A: Contact Info Visibility (Free / Paid) -->
                                <div class="single-input my-4">
                                    <label class="label-title">{{ __('Contact Info Visibility') }}</label>
                                    <select name="contact_visibility" class="form-control form-select" id="contact_visibility">
                                        <option value="free" @selected(get_static_option('influencer_contact_visibility') === 'free')>
                                            {{ __('Free — visible to all clients') }}
                                        </option>
                                        <option value="paid" @selected(get_static_option('influencer_contact_visibility') === 'paid')>
                                            {{ __('Paid — requires credits to unlock') }}
                                        </option>
                                    </select>
                                    <small class="text-muted d-block mt-1">
                                        {{ __('Free: contact info shown without restriction. Paid: client must spend credits (one-time per influencer).') }}
                                    </small>
                                </div>

                                <!-- 2.B & 2.C: Paid-Mode Settings (only if Paid is selected) -->
                                <div id="paid_settings" class="mt-4 p-4 bg-light rounded @unless(get_static_option('influencer_contact_visibility') === 'paid') d-none @endunless">
                                    <h6 class="mb-3 fw-bold">{{ __('Credit Configuration (Paid Mode)') }}</h6>

                                    <!-- Credits required per influencer unlock -->
                                    <div class="single-input mb-3">
                                        <label class="label-title">{{ __('Credits Required per Influencer Unlock') }}</label>
                                        <input
                                                type="number"
                                                name="credits_per_unlock"
                                                class="form-control"
                                                value="{{ old('credits_per_unlock', (int) get_static_option('influencer_credits_per_unlock', 1)) }}"
                                                min="1"
                                                required
                                        >
                                        <small class="text-muted">
                                            {{ __('How many credits a client must spend to unlock one influencer (e.g., 1 or 5).') }}
                                        </small>
                                    </div>

                                    <!-- Credit unit price -->
                                    <div class="single-input mb-3">
                                        <label class="label-title">
                                            {{ __('Credit Unit Price') }} ({{ site_currency_symbol(true) }})
                                        </label>

                                        <div class="single-input-icon">
                                            <input
                                                    type="number"
                                                    step="1"
                                                    name="credit_price_usd"
                                                    class="form-control"
                                                    value="{{ old('credit_price_usd', number_format((int) get_static_option('credit_price_usd', 10))) }}"
                                                    min="1"
                                                    required
                                                    style="padding-left: 50px !important;"
                                            >
                                            <span class="input-icon">{{ site_currency_symbol() }}</span>
                                        </div>

                                        <small class="text-muted">
                                            {{ __('Price per credit, e.g., 1 credit =') }} {{ site_currency_symbol() }}10.00
                                        </small>
                                    </div>

                                    <!-- Minimum purchase amount -->
                                    <div class="single-input">
                                        <label class="label-title">{{ __('Minimum Purchase Amount (Credits)') }}</label>
                                        <input
                                                type="number"
                                                name="min_credits_purchase"
                                                class="form-control"
                                                value="{{ old('min_credits_purchase', (int) get_static_option('min_credits_purchase', 10)) }}"
                                                min="1"
                                                required
                                        >
                                        <small class="text-muted">
                                            {{ __('Clients must buy at least this many credits in a single transaction.') }}
                                        </small>
                                    </div>
                                </div>

                                @can('influencer-contact-settings-update')
                                    <x-btn.submit :title="__('Save Settings')" :class="'btn btn-primary mt-4 px-5'" />
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

@section('script')
    <x-sweet-alert.sweet-alert2-js/>
    <x-select2.select2-js/>
    @include('backend.pages.user.influencer-contact-info-settings-js')

@endsection