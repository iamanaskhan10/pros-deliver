<script>
    (function ($) {
        "use strict";

        function updatePaidSettingsVisibility() {
            const $visibilitySelect = $('#contact_visibility');
            const $paidSettings = $('#paid_settings');

            if (!$visibilitySelect.length || !$paidSettings.length) return;

            const isPaid = $visibilitySelect.val() === 'paid';
            $paidSettings.toggleClass('d-none', !isPaid);
        }

        $(document).ready(function () {
            // Initialize on load (critical fix!)
            updatePaidSettingsVisibility();

            // Update on change
            $('#contact_visibility').on('change', updatePaidSettingsVisibility);
        });
    }(jQuery));

    // toastr success
    function toastr_success_js(msg) {
        Command: toastr["success"](msg, "Success !")
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    }

    // toastr warning
    function toastr_warning_js(msg) {
        Command: toastr["warning"](msg, "Warning !")
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    }
</script><?php /**PATH /home/prosdeliver/public_html/core/resources/views/backend/pages/user/influencer-contact-info-settings-js.blade.php ENDPATH**/ ?>