<script>
    (function ($) {
        "use strict";
        pre_next();
        $(document).ready(function () {
            $('.country_select2').select2();
            $('.state_select2').select2();
            $('.city_select2').select2();

            //gender select
            $('input[name="male_female"]').change(function() {
                let gender = $(this).val();
                $('#gender').val(gender);
            });

            // change country and get state
            $(document).on('change', '#country_id , #edit_country_id', function() {
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
            $(document).on('change', '#state_id',function(){
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
            });

            // Icon picker
            $(document).on('click', '.iconpicker-item', function() {
                let platform_icon_class = $(this).find('i').attr('class');
                if (platform_icon_class) {
                    $('#platform_icon').val(platform_icon_class);
                    $('#edit_platform_icon').val(platform_icon_class);
                }
            });

            // add social profile
            $(document).on('click','.add_experience',function(){
                let profile_link = $('#profile_link').val();
                let followers = $('#followers').val();
                let platform_icon = $('#platform_icon').val();
                if(profile_link == '' || followers == '' || platform_icon == ''){
                    toastr_warning_js("{{ __('Please fill all fields !') }}");
                    return false;
                }else{
                    $.ajax({
                        url: "{{ route('influencer.account.social.profile.add') }}",
                        type: 'post',
                        data: {
                            profile_link: profile_link,
                            followers:followers,
                            platform_icon:platform_icon,
                        },
                        success: function(res){
                            if(res.status == 'ok'){
                                $('.popup-fixed, .popup-overlay').removeClass('popup-active');
                                $('#display_user_experience_data').load(location.href + " #display_user_experience_data");
                                $(addExperienceForm)[0].reset();
                                toastr_success_js("{{ __('Social Profile Successfully Added') }}");
                            }
                        }
                    });
                }
            });

            // edit experience
            $(document).on('click','.edit_single_experience',function(){
                let id = $(this).data('id');
                let profile_link = $(this).data('profile_link');
                let followers = $(this).data('followers');
                let platform_icon = $(this).data('platform_icon');

                $('#edit_id').val(id);
                $('#edit_profile_link').val(profile_link);
                $('#edit_followers').val(followers);
                $('#edit_platform_icon').val(platform_icon);
                $('.iconpicker-component i').attr('class', platform_icon);
            });

            // update experience
            $(document).on('click','.update_single_experience',function(){
                let id = $('#edit_id').val();
                let profile_link = $('#edit_profile_link').val();
                let followers = $('#edit_followers').val();
                let platform_icon = $('#edit_platform_icon').val();
                if(profile_link == '' || followers == '' || platform_icon == ''){
                    toastr_warning_js("{{__('Please fill all fields !')}}");
                    return false;
                }else{
                    $.ajax({
                        url: "{{ route('influencer.account.social.profile.update') }}",
                        type: 'post',
                        data: {
                            id: id,
                            profile_link: profile_link,
                            followers:followers,
                            platform_icon:platform_icon,
                        },
                        success: function(res){
                            if(res.status == 'ok'){
                                $('.popup-fixed, .popup-overlay').removeClass('popup-active');
                                $('#display_user_experience_data').load(location.href + " #display_user_experience_data");
                                $(addExperienceForm)[0].reset();
                                toastr_success_js("{{ __('Social Profile Successfully Updated') }}");
                            }
                        }
                    });
                }
            });

            // update experience
            $(document).on('click','.delete_single_profile',function(){
                let id = $(this).data('id');
                    $.ajax({
                        url: "{{ route('influencer.account.social.profile.delete') }}",
                        type: 'post',
                        data: {id: id},
                        success: function(res){
                            if(res.status == 'ok'){
                                $('#display_user_experience_data').load(location.href + " #display_user_experience_data");
                                toastr_warning_js("{{ __('Social Profile Successfully Deleted') }}");
                            }
                        }
                    });
            });

            // set category
            let selectedCategories = [];

            // Populate the initial selected categories from the hidden input's value
            let initialValues = $('#set_category_id').val().split(',');
            // This filters out any empty strings, just in case
            selectedCategories = initialValues.filter(value => value.trim() !== '');

            // Optionally, add 'active' class to initially selected categories for visual feedback
            $('.work_category_id').each(function() {
                let categoryId = $(this).find('input').val();
                if (selectedCategories.includes(categoryId)) {
                    $(this).find('.setup-wrapper-work-single').addClass('active');
                }
            });

            $(document).on('click', '.work_category_id', function() {
                let category = $(this).find('input').val();
                let categoryDiv = $(this).find('.setup-wrapper-work-single');

                if (selectedCategories.includes(category)) {
                    selectedCategories = selectedCategories.filter(id => id !== category);
                    categoryDiv.removeClass('active'); // Visual feedback for de-selection
                } else {
                    selectedCategories.push(category);
                    categoryDiv.addClass('active'); // Visual feedback for selection
                }
                // Update the hidden input field with the selected categories as a comma-separated string
                $('#set_category_id').val(selectedCategories.join(','));
            });

            //choose skill
            const myTagInput = new TagsInputs({
                selector: 'skill_input',
                duplicate: false,
                max: 30,
            });

            @php
                $skills =  \App\Models\UserSkill::select('skill')->where('user_id',Auth::guard('web')->user()->id)->first()->skill ?? '';
                $array_skill = explode(",",$skills);
                $array_length =  count($array_skill);
            @endphp

            @for($i = 0; $i<=($array_length-1); $i ++ )
                myTagInput.addData(["{{$array_skill[$i]}}"]);
            @endfor

            $(document).on('click','.choose_skill',function (){
                let skill = $(this).text();
                myTagInput.addData([skill]);
            });

            //choose language
            const myLangInput = new TagsInputs({
                selector: 'lang_input',
                duplicate: false,
                max: 30,
            });

            @php
                $languages =  \App\Models\UserLang::select('lang')->where('user_id',Auth::guard('web')->user()->id)->first()->lang ?? '';
                $array_lang = explode(",",$languages);
                $array_length =  count($array_lang);
            @endphp

            @for($i = 0; $i<=($array_length-1); $i ++ )
            myLangInput.addData(["{{$array_lang[$i]}}"]);
            @endfor

            $(document).on('click','.choose_lang',function (){
                let lang = $(this).text();
                myLangInput.addData([lang]);
            });

            //profile photo upload
            document.querySelector('#upload_profile_photo').addEventListener('change', function() {
                $("#profilePhotoModal").modal('show');
                if (this.files && this.files[0]) {
                    let img = document.querySelector('.profile_photo_preview');
                    img.onload = () => {
                        URL.revokeObjectURL(img.src);  // no longer needed, free memory
                    }
                    img.src = URL.createObjectURL(this.files[0]); // set src to blob url
                    document.querySelector(".profile_photo_upload").files = this.files;
                    // document.querySelector(".profile_photo_upload").value = this.value;
                    $("#crop").trigger("click");
                }
            });

            //profile photo save
            $(document).on('submit','#profilePhotoUploadForm', function(e) {
                e.preventDefault();

                $.ajax({
                    url:"{{ route('influencer.account.profile.photo.upload') }}",
                    method:'post',
                    data:new FormData(e.target),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: () => { },
                    success: (res) => {
                        if(res.status=='uploaded'){
                            $('#profilePhotoModal').modal('hide');
                            $('.profile_photo_area').load(location.href + ' .profile_photo_area');
                        }else{
                            $('.error_msg').html('');
                        }
                    },errors: (err) => {
                    }
                });
            });


        });
    }(jQuery));

    function pre_next()
    {
        let Listings = document.querySelectorAll(".single-setup-request-list li");
        let sections = document.querySelectorAll(".setup-wrapper-contents");
        let nextButton = document.querySelector("#next");
        let prevButton = document.querySelector("#previous");
        let current = 0;

        const toggleListings = () => {
            Listings.forEach(function(e) {
                e.classList.remove('running');
            });
            Listings[current]?.classList?.add("running");
            Listings[current]?.classList?.remove("completed");
            if (current != 0) {
                Listings[current - 1]?.classList?.add("completed");
            }
        }

        const toggleSections = () => {
            sections.forEach(function(section) {
                section?.classList?.remove('active');
            });
            sections[current]?.classList?.add("active");
        }

        if (nextButton != null) {
            nextButton.addEventListener("click", function(e) {
                e.preventDefault();
                if (current <= Listings.length - 1) {
                    current++

                    //add introduction
                    if(current == 1){
                        let gender = $('#gender').val();
                        let description = $('#description').val();
                        if(gender == '' || description == ''){
                            current = 0;
                            toastr_warning_js("{{ __('Please provide an intro about yourself within 250 character !') }}");
                            return false;
                        }else if(description.length >250){
                            current = 0;
                            toastr_warning_js("{{ __('Description must not greater than 250 character !') }}");
                            return false;
                        }else{

                            // Add word restriction check for introduction
                            @if(moduleExists('SecurityManage'))
                                let module_exits = "<?php echo moduleExists('SecurityManage') ?? '' ?>"
                                if (module_exits) {
                                    let words = JSON.parse('<?php echo json_encode(\Modules\SecurityManage\Entities\Word::select('word')->where("status", "active")->pluck("word")->toArray()); ?>');
                                    
                                    let combinedText = (description).toLowerCase();

                                    function checkAnyWordExists(words, text) {
                                        return words.some(word => text.includes(word.toLowerCase()));
                                    }
                                    let anyWordExists = checkAnyWordExists(words, combinedText);

                                    function getAllMatchedWords(words, text) {
                                        return words.filter(word => text.includes(word.toLowerCase()));
                                    }

                                    // Get all matching words
                                    let matchedWords = getAllMatchedWords(words, combinedText);

                                    if (anyWordExists) {
                                        current = 0;
                                        toastr_warning_js('You cannot use restricted words: ' + matchedWords.join(', '));
                                        return false;
                                    }
                                }
                            @endif

                            $.ajax({
                                url: "{{ route('influencer.account.introduction.add') }}",
                                type: 'post',
                                data: {gender:gender,description:description},
                                success: function(res){
                                    if(res.status == 'ok'){
                                        toastr_success_js("{{ __('Introduction Successfully Updated') }}");
                                    }else if(res.status == 'error'){
                                        current = 0;
                                        toastr_warning_js(res.message);
                                        return false;
                                    }
                                },
                                error: function(xhr, status, error) {
                                    toastr_warning_js("{{ __('An error occurred. Please try again.') }}");
                                    return false;
                                }
                            });
                        }
                    }
                    // add social profile
                    else if(current == 2){
                        //add social profile
                    }
                    // add work
                    else if(current == 3){
                        let category = $('#set_category_id').val();
                        if(category == ''){
                            current = 2;
                            toastr_warning_js("{{ __('Please choose a category !') }}");
                            return false;
                        }else{
                            $.ajax({
                                url: "{{ route('influencer.account.work.add') }}",
                                type: 'post',
                                data: {category: category},
                                success: function(res){
                                    if(res.status == 'ok'){
                                        toastr_success_js("{{ __('Work Successfully Updated') }}");
                                    }
                                }
                            });
                        }
                    }
                    // add skill
                    else if(current == 4){
                        let skill = $('#skill_input').val();
                        if(skill == ''){
                            current = 3;
                            toastr_warning_js("{{ __('You must add one or more skills !') }}");
                            return false;
                        }else{
                            $.ajax({
                                url: "{{ route('influencer.account.skill.add') }}",
                                type: 'post',
                                data: {skill: skill},
                                success: function(res){
                                    if(res.status == 'ok'){
                                        toastr_success_js("{{ __('Skill Successfully Updated') }}");
                                    }
                                }
                            });
                        }
                    }
                    // add language
                    else if(current == 5){
                        let lang = $('#lang_input').val();
                        if(lang == ''){
                            current = 4;
                            toastr_warning_js("{{ __('You must add one or more language !') }}");
                            return false;
                        }else{
                            $.ajax({
                                url: "{{ route('influencer.account.lang.add') }}",
                                type: 'post',
                                data: {lang: lang},
                                success: function(res){
                                    if(res.status == 'ok'){
                                        toastr_success_js("{{ __('language Successfully Updated') }}");
                                    }
                                }
                            });
                        }
                    }
                    //add location
                    else if(current == 6){
                        let country_id = $('#country_id').val();
                        let state_id = $('#state_id').val();
                        let city_id = $('#city_id').val();

                        if(country_id == '' || state_id == '' || city_id == ''){
                            current = 5;
                            toastr_warning_js("{{ __('Please fill all fields !') }}");
                            return false;
                        }else{
                            $.ajax({
                                url: "{{ route('influencer.account.location.add') }}",
                                type: 'post',
                                data: {country_id: country_id,state_id:state_id,city_id:city_id},
                                success: function(res){
                                    if(res.status == 'ok'){
                                        toastr_success_js("{{ __('Location Successfully Updated') }}");
                                        getRunningAccountSetup();
                                    }
                                }
                            });
                        }
                    }
                    //add hourly rate
                    else if(current == 7){
                        let hourly_rate = $('#hourly_rate').val() ?? 1;
                        if(hourly_rate == ''){
                            current = 6;
                            toastr_warning_js("{{ __('You must add hourly rate!') }}");
                            return false;
                        }else{
                            $.ajax({
                                url: "{{ route('influencer.account.hourly.rate.add') }}",
                                type: 'post',
                                data: {hourly_rate: hourly_rate},
                                success: function(res){
                                    if(res.status == 'ok'){
                                        toastr_success_js("{{ __('Profile Photo Successfully Updated') }}");
                                        let redirectPath = "{{route('influencer.account.congrats')}}";
                                        @if(!empty(request()->get('return')))
                                            redirectPath = "{{url('/'.request()->get('return'))}}";
                                        @endif
                                            window.location = redirectPath;
                                    }
                                }
                            });
                        }
                    }

                }
                if(current != 7){
                    toggleListings();
                    toggleSections();
                }
            })
        }

        if (prevButton != null) {
            prevButton.addEventListener("click", function(e) {
                if (current > 0) {
                    current--
                }
                toggleListings();
                toggleSections();
            });
        }
    }

    //toastr warning
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
    // toastr success
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
</script>
