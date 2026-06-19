<html>
<head>
    <title>{{ __('Stripe Subscription') }}</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
<div class="stripe-payment-wrapper">
    <h3>{{ $title ?? 'Subscription Payment' }}</h3>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const stripe = Stripe('{{ $public_key }}');

        // Automatically redirect to Stripe Checkout
        stripe.redirectToCheckout({ sessionId: '{{ $session_id }}' })
            .then(function (result) {
                // If redirect fails, show an error message
                if (result.error) {
                    alert(result.error.message);
                }
            });
    });
</script>
</body>
</html>
