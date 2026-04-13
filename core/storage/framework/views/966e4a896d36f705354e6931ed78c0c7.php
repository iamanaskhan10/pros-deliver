<script>
    // Initialize icon picker
    $('.icp-dd').iconpicker();

    // Handle icon selection event
    $('.icp-dd').on('iconpickerSelected', function(e) {
        var selectedIcon = e.iconpickerValue;

        // Only update the specific input field for platform icon
        $(this).closest('.single-input').find('input[name="edit_platform_icon"]').val(selectedIcon);

        // Hide the icon picker dropdown menu if needed
        $('body .dropdown-menu.iconpicker-container').removeClass('show');
    });
</script><?php /**PATH /home/prosdeliver/public_html/core/resources/views/components/icon-picker/icon-picker.blade.php ENDPATH**/ ?>