<section class="container_subscribe pt-60 -mb-75">
    <div id="newsLetter" class="newsLetter_wraper">
        <h4 class="text-white font_size_48"> {{ $title ?? __('Get the latest Updates') }}</h4>
        <form action="{{ route('newsletter.subscription') }}" method="post" id="newsletter_subscribe_from_addon">
            <div class="error-message"></div>
            <div class="d-flex align-items-center flex-md-row flex-column gap-3">
                @csrf
                <input class="newsletter_input" type="email" name="email"
                    placeholder="{{ $input_title ?? __('Enter Your Email') }}">
                <button class="border-0 subscribe subscription_by_email"
                    type="submit">{{ $button_title ?? __('Subscribe') }}</button>
            </div>
        </form>
    </div>
</section>
