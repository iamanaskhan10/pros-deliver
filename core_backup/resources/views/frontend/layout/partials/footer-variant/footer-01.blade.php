<!-- footer area start -->
<footer class="influencer influencer-footer custom_footer pat-60">
    <div class="container">
        <div class="footer-newslatter-wraper">
            <div class="footer_newslatter">
                <h4 class="inf-title title3 fw_bold text-white">{{ __('Get the latest Updates') }}</h4>
                <form action="{{ route('newsletter.subscription') }}" method="post" id="newsletter_subscribe_from_addon">
                    @csrf
                    <div class="d-flex align-items-center flex-wrap gap-3">
                        <input class="newsletter_input" name="email" type="email" placeholder="Enter Your Email"
                            value="{{ old('email') }}" required>
                        <button class="inf-cmn-btn inf-primary-btn subscription_by_email" type="submit">{{ __('Subscribe') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer-area-wrapper">
            <div class="row g-4 justify-content-between">
                {!! render_frontend_sidebar('footer_one') !!}
            </div>
        </div>
    </div>
    <div class="influencer-copyright-area copyright-area copyright-border">
        <div class="footer-widget-para pat-40 pab-40 ">
            {!! render_footer_copyright_text() !!}
        </div>
    </div>
</footer>
<!-- footer area end -->
