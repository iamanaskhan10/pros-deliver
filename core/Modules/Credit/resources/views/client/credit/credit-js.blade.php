{{-- core/resources/views/components/frontend/payment-gateway/credit-js.blade.php --}}
<script>
    (function($){
        "use strict";
        $(document).ready(function(){
            // Validate & auto-calculate before submit
            $(document).on('click', '.buy_credits_btn', function(e){
                const creditsInput = $('#credits');
                const credits = parseInt(creditsInput.val());
                const minCredits = {{ (int) get_static_option('min_credits_purchase', 5) }};
                const creditPrice = {{ (float) get_static_option('credit_price_usd', 10) }};

                if (!credits || isNaN(credits) || credits < minCredits) {
                    toastr_warning_js(
                        "{{ __('Minimum purchase is :min credits.', ['min' => ':min']) }}".replace(':min', minCredits)
                    );
                    creditsInput.focus();
                    e.preventDefault();
                    return false;
                }

                // Optional: auto-set hidden 'amount_usd' if backend expects it
                // But per your model, only 'credits' is needed — so no extra field.
            });

            // Optional: real-time cost display (enhancement)
            $('#credits').on('input', function(){
                const credits = parseInt($(this).val()) || 0;
                const creditPrice = {{ (float) get_static_option('credit_price_usd', 10) }};
                const total = credits * creditPrice;
                // You could show: $('.credit-total-preview').text('$' + total.toFixed(2));
            });
        });
    }(jQuery));
</script>