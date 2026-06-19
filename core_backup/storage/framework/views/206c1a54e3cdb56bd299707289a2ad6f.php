<!-- footer area start -->
<footer class="influencer influencer-footer custom_footer pat-60">
    <div class="container">
        <div class="footer-newslatter-wraper">
            <div class="footer_newslatter">
                <h4 class="inf-title title3 fw_bold text-white"><?php echo e(__('Get the latest Updates')); ?></h4>
                <form action="<?php echo e(route('newsletter.subscription')); ?>" method="post" id="newsletter_subscribe_from_addon">
                    <?php echo csrf_field(); ?>
                    <div class="d-flex align-items-center flex-wrap gap-3">
                        <input class="newsletter_input" name="email" type="email" placeholder="Enter Your Email"
                            value="<?php echo e(old('email')); ?>" required>
                        <button class="inf-cmn-btn inf-primary-btn subscription_by_email" type="submit"><?php echo e(__('Subscribe')); ?></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer-area-wrapper">
            <div class="row g-4 justify-content-between">
                <?php echo render_frontend_sidebar('footer_one'); ?>

            </div>
        </div>
    </div>
    <div class="influencer-copyright-area copyright-area copyright-border">
        <div class="footer-widget-para pat-40 pab-40 ">
            <?php echo render_footer_copyright_text(); ?>

        </div>
    </div>
</footer>
<!-- footer area end -->
<?php /**PATH /home/prosdeliver/public_html/core/resources/views/frontend/layout/partials/footer-variant/footer-01.blade.php ENDPATH**/ ?>