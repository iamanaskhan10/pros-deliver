<script>
    (function($){
        "use strict";
        $(document).ready(function(){
            $('.country_select2').select2({
                dropdownParent: $('.popup-fixed')
            });
            $('.state_select2').select2({
                dropdownParent: $('.popup-fixed')
            });
            $('.city_select2').select2({
                dropdownParent: $('.popup-fixed')
            });

            const phoneOtpVerify = "{{ get_static_option('phone_otp_verify') }}"; // 'on' or 'off'
            const phoneContainer = document.getElementById('phone_number_container');
            const inputEdit = document.querySelector("#phone_number");

            if (phoneOtpVerify !== 'on') {
                phoneContainer.style.display = 'none'; // hide if not 'on'
            }

// initialize intlTelInput on edit field
            const itiEdit = window.intlTelInput(inputEdit, {
                initialCountry: "us",
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.2/build/js/utils.js"
            });

// ✅ set current phone value (if exists in DB) as intlTelInput value
            @if(Auth::guard('web')->user()->phone)
            itiEdit.setNumber("{{ Auth::guard('web')->user()->phone }}");
            @endif


            // profile photo change
            document.querySelector('#profile_photo').addEventListener('change', function() {
                $("#profilePhotoModal").modal('show');
                if (this.files && this.files[0]) {
                    let img = document.querySelector('.profile_photo_preview');
                    img.onload = () => {
                        URL.revokeObjectURL(img.src);  // no longer needed, free memory
                    }

                    img.src = URL.createObjectURL(this.files[0]); // set src to blob url
                    document.querySelector(".profile_photo_upload").files = this.files;
                    document.querySelector(".profile_photo_upload").value = this.value;
                }
            });

            //change profile photo
            $(document).on('submit','#profile_photo_change',function(e){
                e.preventDefault();
                $.ajax({
                    url:"{{ route('influencer.profile.photo.edit') }}",
                    method:'post',
                    data: new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false,
                    success:function(){
                        $('#profilePhotoModal').modal('hide');
                        $('#display_freelancer_profile_photo').load(window.location.href + " #display_freelancer_profile_photo > div");
                        toastr_success_js("{{ __('Profile Photo Successfully Changed') }}");
                    },
                    error: function (err) {
                        let error = err.responseJSON;
                        $('.error_msg_container').html('');
                        $.each(error.errors, function (index, value) {
                            $('.error_msg_container').append('<p class="text-danger">'+value+'<p>');
                        });
                    }
                })
            });

            // change country and get state
            $('#country_id').on('change', function() {
                let country = $(this).val();
                $.ajax({
                    method: 'post',
                    url: "{{ route('au.state.all') }}",
                    data: {
                        country: country
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            let all_options = "<option value=''>{{__('Select State')}}</option>";
                            let all_state = res.states;
                            $.each(all_state, function(index, value) {
                                all_options += "<option value='" + value.id +
                                    "'>" + value.state + "</option>";
                            });
                            $(".get_country_state").html(all_options);
                            $(".state_info").html('');
                            if(all_state.length <= 0){
                                $(".state_info").html('<span class="text-danger"> {{ __('No state found for selected country!') }} <span>');
                            }
                        }
                    }
                })
            })

            // change state and get city
            $('#state_id').on('change', function() {
                let state = $(this).val();
                $.ajax({
                    method: 'post',
                    url: "{{ route('au.city.all') }}",
                    data: {
                        state: state
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            let all_options = "<option value=''>{{__('Select City')}}</option>";
                            let all_city = res.cities;
                            $.each(all_city, function(index, value) {
                                all_options += "<option value='" + value.id +
                                    "'>" + value.city + "</option>";
                            });
                            $(".get_state_city").html(all_options);

                            $(".city_info").html('');
                            if(all_city.length <= 0){
                                $(".city_info").html('<span class="text-danger"> {{ __('No city found for selected state!') }} <span>');
                            }
                        }
                    }
                })
            })

            //update profile
            $(document).on('submit','#edit_profile_form',function(e){
                e.preventDefault();
                let first_name = $('#first_name').val();
                let last_name = $('#last_name').val();
                let email = $('#email').val();
                let country = $('#country_id').val();
                let state = $('#state_id').val();
                let city = $('#city_id').val();
                let github_id = $('#github_id').val();
                let phone_number = '';
                if (phoneOtpVerify === 'on') {
                    if (itiEdit.isValidNumber()) {
                        phone_number = itiEdit.getNumber();
                    } else {
                        $('#phone_number').css('border', '1px solid red');
                        $('#edit_profile_load_spinner').html('');
                        return; // stop submit if number invalid
                    }
                }

                if(first_name == '' || last_name == '' || email == '' || country == '' || github_id == ''){
                    toastr_warning_js('Except state and city all fields required !');
                    return false;
                }

                let currentPhone = itiEdit.getNumber();

                // Check if phone needs verification
                if (phoneOtpVerify === 'on' && currentPhone !== originalPhone) {
                    toastr_warning_js("{{ __('Please verify your new phone number first') }}");
                    return false;
                }

                $.ajax({
                    url: "{{ route('influencer.profile.edit') }}",
                    type: 'post',
                    data: {
                        first_name: first_name,
                        last_name:last_name,
                        email:email,
                        country:country,
                        state:state,
                        city:city,
                        github_id:github_id,
                        phone_number:currentPhone,
                    },
                    success: function(res){
                        if(res.status == 'ok'){
                            $('.popup-fixed, .popup-overlay').removeClass('popup-active');
                            $('#display_freelancer_profile_info').load(location.href + " #display_freelancer_profile_info");
                            toastr_success_js("{{ __('Profile Info Successfully Updated') }}");
                        } else if (res.status == 'needs_otp') {
                            toastr_warning_js(res.msg || 'OTP Verification Required from Backend');
                        } else {
                            toastr_warning_js(res.message || res.msg || 'Update failed');
                        }
                    },
                    error: function (err) {
                        let error = err.responseJSON;
                        $('.error_msg_container').html('');
                        if (error && error.errors) {
                            $.each(error.errors, function (index, value) {
                                $('.error_msg_container').append('<p class="text-danger">'+value+'<p>');
                            });
                        } else if (error && error.msg) {
                            $('.error_msg_container').append('<p class="text-danger">'+error.msg+'<p>');
                            toastr_warning_js(error.msg);
                        }
                    }
                });
            })


            //open feedback modal
            $(document).on('click','.open_freelancer_feedback_modal',function(){
                $('#reviewForm input[name="title"]').val($(this).data('feedback-title'));
                $('#reviewForm textarea[name="description"]').val($(this).data('feedback-description'));
                $('#reviewForm input[name="rating"]').val($(this).data('feedback-rating'));
            });

            //submit review
            $(document).on('click', '.submit_your_review', function(e){
                e.preventDefault();
                let title = $('#reviewForm input[name="title"]').val();
                let description = $('#reviewForm textarea[name="description"]').val();
                let rating = $('#reviewForm input[name="rating"]').val();
                let erContainer = $(".error-message");
                erContainer.html('');
                $.ajax({
                    url:"{{ route('influencer.submit.feedback')}}",
                    data:{title:title,description:description,rating:rating},
                    method:'POST',
                    error:function(res){
                        let errors = res.responseJSON;
                        erContainer.html('<div class="alert alert-danger"></div>');
                        $.each(errors.errors, function(index,value){
                            erContainer.find('.alert.alert-danger').append('<p>'+value+'</p>');
                        });
                    },
                    success: function(res){
                        if(res.status=='success'){
                            toastr_success_js("{{ __('Thanks to Feedback Us.') }}")
                            $('#reviewForm')[0].reset();
                            $("#feedbackModal").modal('hide');
                            location.reload();
                        }
                        if(res.status == 'failed'){
                            erContainer.html('<div class="alert alert-danger">'+res.msg+'</div>');
                        }
                    }

                });
            });

            // Store original phone to detect changes
            let originalPhone = "{{ Auth::guard('web')->user()->phone ?? '' }}";
            let isPhoneVerified = true;

            // Handle phone input input 
            if (inputEdit) {
                inputEdit.addEventListener('countrychange', handlePhoneChange);
                inputEdit.addEventListener('keyup', handlePhoneChange);
            }

            function handlePhoneChange() {
                if (phoneOtpVerify !== 'on') return;

                let currentPhone = itiEdit.getNumber();
                let wrapper = $('#phone_verification_wrapper');

                wrapper.empty(); // sensitive

                if (currentPhone !== originalPhone && currentPhone.length > 5) {
                    if (itiEdit.isValidNumber()) {
                        // Phone changed + valid -> Show Send OTP button
                        let btn = $('#phone_verification_templates #btn_send_otp').clone();
                        btn.attr('data-phone', currentPhone);
                        wrapper.append(btn);
                    }
                } else if (currentPhone === originalPhone) {
                     // Back to original -> Show verified badge
                     // Or just clear
                }
            }

            // Click Send OTP
            $(document).on('click', '#btn_send_otp', function() {
                let btn = $(this);
                let phone = itiEdit.getNumber(); // use iti for full format
                
                btn.prop('disabled', true).text('{{ __("Sending...") }}');

                $.ajax({
                    url: "{{ route('influencer.profile.phone.send.otp') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        phone_number: phone
                    },
                    success: function(res) {
                        toastr_success_js(res.message);
                        
                        // Show OTP Input Group
                        let wrapper = $('#phone_verification_wrapper');
                        wrapper.empty();
                        
                        let otpGroup = $('#phone_verification_templates #otp_input_group').clone();
                        wrapper.append(otpGroup);
                        
                        // Start Timer
                        startNewOtpTimer(60);
                    },
                    error: function(err) {
                        btn.prop('disabled', false).text('{{ __("Send OTP") }}');
                        let msg = err.responseJSON ? err.responseJSON.message : 'Error sending OTP';
                        toastr_warning_js(msg);
                    }
                });
            });

             // Click Verify OTP
            $(document).on('click', '#btn_verify_otp', function() {
                let btn = $(this);
                let otpInput = $('#phone_verification_wrapper #phone_otp_input');
                let otp = otpInput.val();
                let phone = itiEdit.getNumber();

                if(otp.length < 4) {
                    toastr_warning_js("{{ __('Please enter valid OTP') }}");
                    return;
                }

                btn.prop('disabled', true).text('{{ __("Verifying...") }}');

                $.ajax({
                    url: "{{ route('influencer.profile.phone.verify.otp') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        phone_number: phone,
                        otp_code: otp
                    },
                    success: function(res) {
                        toastr_success_js(res.message);
                        
                        // Update Original Phone to new one
                        originalPhone = phone;
                        
                        // Show Verified Badge
                        let wrapper = $('#phone_verification_wrapper');
                        wrapper.empty();
                        let badge = $('#phone_verification_templates #phone_verified_badge').clone();
                        wrapper.append(badge);
                    },
                    error: function(err) {
                        btn.prop('disabled', false).text('{{ __("Verify") }}');
                         let msg = err.responseJSON ? err.responseJSON.message : 'Error verifying OTP';
                        toastr_warning_js(msg);
                    }
                });
            });

            // Resend (New)
            $(document).on('click', '#btn_resend_otp_new', function() {
                 $('#btn_send_otp').click(); // Trigger send again
                 // But wait, btn_send_otp is not in DOM now. 
                 // Logic duplication needed or re-render.
                 
                let link = $(this);
                let phone = itiEdit.getNumber();
                link.hide();
                $('#otp_timer').text('{{ __("Sending...") }}');

                $.ajax({
                    url: "{{ route('influencer.profile.phone.send.otp') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        phone_number: phone
                    },
                    success: function(res) {
                        toastr_success_js(res.message);
                        startNewOtpTimer(60);
                    },
                    error: function(err) {
                         let msg = err.responseJSON ? err.responseJSON.message : 'Error sending OTP';
                        toastr_warning_js(msg);
                        link.show();
                    }
                });
            });

            function startNewOtpTimer(seconds) {
                let timerSpan = $('#phone_verification_wrapper #otp_timer');
                let resendLink = $('#phone_verification_wrapper #btn_resend_otp_new');
                
                resendLink.hide();
                timerSpan.show();

                let interval = setInterval(function() {
                    seconds--;
                    timerSpan.text("{{ __('Resend in') }} " + seconds + "s");

                    if (seconds <= 0) {
                        clearInterval(interval);
                        timerSpan.hide();
                        resendLink.show();
                    }
                }, 1000);
            }

        });
    }(jQuery));

    // toastr warning
    function toastr_warning_js(msg){
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
    //toastr success
    function toastr_success_js(msg){
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
    //toastr delete
    function toastr_delete_js(msg){
        Command: toastr["error"](msg, "Delete !")
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

</script>
