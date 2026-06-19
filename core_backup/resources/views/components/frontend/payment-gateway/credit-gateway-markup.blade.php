{{-- core/resources/views/components/frontend/payment-gateway/credit-gateway-markup.blade.php --}}
@php
    $creditPrice = (float) get_static_option('credit_price_usd', 10);
    $minCredits = (int) get_static_option('min_credits_purchase', 5);
    $minAmount = $creditPrice * $minCredits;
@endphp

<div class="modal fade" id="creditPurchaseModal" tabindex="-1" aria-labelledby="creditPurchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog ab">
        <form action="{{ route('client.credit.deposit') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="creditPurchaseModalLabel">
                        {{ $title ?? __('Buy Credits') }}
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <x-form.text
                            :type="'number'"
                            :title="__('Number of Credits')"
                            :name="'credits'"
                            :id="'credits'"
                            :placeholder="__('Min: :min credits', ['min' => $minCredits])"
                            :value="$minCredits"
                            :min="$minCredits"
                    />
                    <p class="text-muted small mt-2">
                        {{ __('1 credit = :price. Minimum purchase: :min credits (:amount).', [
                            'price' => amount_with_currency_symbol($creditPrice),
                            'min' => $minCredits,
                            'amount' => amount_with_currency_symbol($minAmount)
                        ]) }}
                    </p>

                    <div class="confirm-payment payment-border mt-4">
                        <div class="single-checkbox">
                            <div class="checkbox-inlines">
                                <label class="checkbox-label load_after_login" for="check2">
                                    {!! \App\Helper\PaymentGatewayList::renderPaymentGatewayForForm(false) !!}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-profile btn-outline-gray btn-hover-danger" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <x-btn.submit :title="__('Buy Credits')" :class="'btn-profile btn-bg-1 buy_credits_btn'" />
                </div>
            </div>
        </form>
    </div>
</div>