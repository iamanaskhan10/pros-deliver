<script>
    (function ($) {
        "use strict";
        let validation = {project_title_error: false};
        pre_next();
        $(document).ready(function () {

            setTimeout(function (){
                $("#offer_packages_available_or_not").trigger('change');
            },1000)

            $('.category_select2').select2();
            $('.subcategory_select2').select2();

            var url = `{{url('/')}}/{{ $project_details->slug }}`;
            $('.display_project_slug').text(url);

            // change category and get subcategory
            $('#subcategory_info').hide();
            $(document).on('change','#category', function() {
                let category = $(this).val();
                $('#subcategory_info').show();
                $.ajax({
                    method: 'post',
                    url: "{{ route('au.subcategory.all') }}",
                    data: {
                        category: category
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            let all_options = "<option value=''>{{__('Select Sub Category')}}</option>";
                            let all_subcategories = res.subcategories;
                            $.each(all_subcategories, function(index, value) {
                                all_options += "<option value='" + value.id +
                                    "'>" + value.sub_category + "</option>";
                            });
                            $(".get_subcategory").html(all_options);
                            $("#subcategory_info").html('');
                            if(all_subcategories.length <= 0){
                                $("#subcategory_info").html('<span class="text-danger"> {{ __('No sub categories found for selected category!') }} <span>');
                            }
                        }
                    }
                })
            })

            // shake title length check
            $('#project_title_char_length_check').hide();
            $('#project_title').on('keydown keyup change', function(){
                $('#project_title_char_length_check').show();
                let title_min_length = 20;
                let title_max_length = 100;
                let project_title_length = $('#project_title').val().length;

                if(project_title_length < title_min_length){
                    $('#project_title_char_length_check').html('<p class="text text-danger">{{ __('Length is short, minimum') }} '+ title_min_length +' {{ __('required') }}.</p>');
                }else if(project_title_length > title_max_length){
                    $('#project_title_char_length_check').html('<p class="text text-danger">{{ __('Length is not valid, maximum') }} '+ title_max_length +' {{ __('allowed') }}.</p>');
                }else{
                    $('#project_title_char_length_check').html('<p class="text text-success">{{ __('Length is valid') }}</p>');
                }
            });

            function transliterateCyrillic(text) {
                const cyrillicToLatinMap = {
                    'А': 'A', 'а': 'a', 'Б': 'B', 'б': 'b', 'В': 'V', 'в': 'v',
                    'Г': 'G', 'г': 'g', 'Д': 'D', 'д': 'd', 'Е': 'E', 'е': 'e',
                    'Ё': 'Yo', 'ё': 'yo', 'Ж': 'Zh', 'ж': 'zh', 'З': 'Z', 'з': 'z',
                    'И': 'I', 'и': 'i', 'Й': 'Y', 'й': 'y', 'К': 'K', 'к': 'k',
                    'Л': 'L', 'л': 'l', 'М': 'M', 'м': 'm', 'Н': 'N', 'н': 'n',
                    'О': 'O', 'о': 'o', 'П': 'P', 'п': 'p', 'Р': 'R', 'р': 'r',
                    'С': 'S', 'с': 's', 'Т': 'T', 'т': 't', 'У': 'U', 'у': 'u',
                    'Ф': 'F', 'ф': 'f', 'Х': 'Kh', 'х': 'kh', 'Ц': 'Ts', 'ц': 'ts',
                    'Ч': 'Ch', 'ч': 'ch', 'Ш': 'Sh', 'ш': 'sh', 'Щ': 'Shch', 'щ': 'shch',
                    'Ъ': '', 'ъ': '', 'Ы': 'Y', 'ы': 'y', 'Ь': '', 'ь': '',
                    'Э': 'E', 'э': 'e', 'Ю': 'Yu', 'ю': 'yu', 'Я': 'Ya', 'я': 'ya',
                    // Additional characters for other Cyrillic-based languages
                    'Ә': 'Ae', 'ә': 'ae', 'Ғ': 'Gh', 'ғ': 'gh', 'Қ': 'Q', 'қ': 'q',
                    'Ң': 'Ng', 'ң': 'ng', 'Ө': 'Oe', 'ө': 'oe', 'Ұ': 'U', 'ұ': 'u',
                    'Ү': 'Ue', 'ү': 'ue', 'Һ': 'H', 'һ': 'h', 'І': 'I', 'і': 'i',
                    // Ukrainian specific
                    'Є': 'Ye', 'є': 'ye', 'І': 'I', 'і': 'i', 'Ї': 'Yi', 'ї': 'yi',
                    'Ґ': 'G', 'ґ': 'g',
                    // Belarusian specific
                    'Ў': 'U', 'ў': 'u',
                    // Serbian specific
                    'Ђ': 'Dj', 'ђ': 'dj', 'Ј': 'J', 'ј': 'j', 'Љ': 'Lj', 'љ': 'lj',
                    'Њ': 'Nj', 'њ': 'nj', 'Ћ': 'C', 'ћ': 'c', 'Џ': 'Dz', 'џ': 'dz',
                    // Macedonian specific
                    'Ѓ': 'Gj', 'ѓ': 'gj', 'Ѕ': 'Dz', 'ѕ': 'dz', 'Ќ': 'Kj', 'ќ': 'kj',
                    'Љ': 'Lj', 'љ': 'lj', 'Њ': 'Nj', 'њ': 'nj', 'Џ': 'Dz', 'џ': 'dz'
                };

                const arabicToLatinMap = {
                    'ا': 'a', 'أ': 'a', 'إ': 'i', 'آ': 'aa', 'ب': 'b', 'ت': 't', 'ث': 'th',
                    'ج': 'j', 'ح': 'h', 'خ': 'kh', 'د': 'd', 'ذ': 'dh', 'ر': 'r', 'ز': 'z',
                    'س': 's', 'ش': 'sh', 'ص': 's', 'ض': 'd', 'ط': 't', 'ظ': 'dh', 'ع': 'a',
                    'غ': 'gh', 'ف': 'f', 'ق': 'q', 'ك': 'k', 'ل': 'l', 'م': 'm', 'ن': 'n',
                    'ه': 'h', 'و': 'w', 'ي': 'y', 'ى': 'a', 'ة': 'h', 'ئ': 'e', 'ء': 'a',
                    'ؤ': 'o', 'لا': 'la'
                };

                const langToLatinMap = currentLang() === 'ar' ? arabicToLatinMap : cyrillicToLatinMap;

                return text.split('').map(char => langToLatinMap[char] || char).join('');
            }

            function convertToSlug(text) {
                const transliteratedText = transliterateCyrillic(text);

                return transliteratedText
                    .toLowerCase()
                    .trim()
                    .replace(/\s+/g, '-');           // Replace spaces with -
            }

            function currentLang(){
                return document.documentElement.lang === 'ar' ? 'ar' : 'cy';
            }

            $(document).on('keyup', '#slug', function (e) {
                $('.display_project_slug').text('');
                let slug = convertToSlug($(this).val());
                $('#slug').val(slug);

                let url = `{{url('/')}}/` + slug;
                $('.full-slug-show').text(url);
            });

            //update slug
            $(document).on('click','.edit_project_slug',function(){
                $('.display_label_title').removeClass('d-none');
                $('#slug').removeClass('d-none');
            })

            // check package is available or not
            $(document).on('change','#offer_packages_available_or_not',function (e) {
                if($(this).prop('checked')){
                    $('.disabled_or_not'). prop('disabled', false);
                    $('#offer_packages_available_or_not').val('1')
                }else{
                    $('.disabled_or_not'). prop('disabled', true);
                    $('#offer_packages_available_or_not').val('0')
                }

            });

            // select checkbox or numeric
            $('.package-field-input .disabled_or_not').remove();
            $(document).on('change','.checkbox_or_numeric_select',function(){
                let value = $(this).val().toLowerCase().replace(/[^a-z0-9_]/g, "_");
                let variable_name = $(this).closest(".append-include").find('.checkbox_or_numeric_title').val().replace(/[^a-z0-9_]/g, "_");
                let currentRow = $(this).closest(".append-include").find("td");
                let add_minus_button = `
                    <div class="package-button-wrapper">
                         <div class="package-field-icon add-rows">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        <div class="package-field-icon remove-rows remove-icon">
                            <i class="fa-solid fa-minus"></i>
                        </div>
                    </div>
                `;

                let t_array = [
                    "basic",
                    "standard",
                    "premium"
                ];
                let i = 0;

                currentRow.each(function (){
                    let row_type = t_array[i++];
                    let inputName = variable_name + '['+ row_type +']';

                    let checkbox, number, textField;


                    if($('#offer_packages_available_or_not').val() != 1 && i > 1){
                        checkbox = '<input type="checkbox" name="'+ inputName +'" class="check-input disabled_or_not" checked>';
                        number = '<input type="number" name="'+ inputName +'" class="form-control disabled_or_not" value="5">';
                        textField = '<input type="text" name="'+ inputName +'" class="form-control text-input disabled_or_not" maxlength="60" placeholder="Enter text (max 60 chars)"><div class="char-counter">0/60</div>';
                    }else{
                        checkbox = '<input type="checkbox" name="'+ inputName +'" class="check-input" checked>';
                        number = '<input type="number" name="'+ inputName +'" class="form-control" value="5">';
                        textField = '<input type="text" name="'+ inputName +'" class="form-control text-input" maxlength="60" placeholder="Enter text (max 60 chars)"><div class="char-counter">0/60</div>';
                    }

                    if(row_type == 'premium'){
                        checkbox  = checkbox + add_minus_button;
                        number  = number + add_minus_button;
                        textField = textField + add_minus_button;
                    }

                    if(value == 'checkbox'){
                        $(this).html(checkbox);
                    }else if(value == 'numeric'){
                        $(this).html(number);
                    }else if(value == 'text'){
                        $(this).html(textField);
                    }

                    if($('#offer_packages_available_or_not').val() == 1){
                        $('.disabled_or_not'). prop('disabled', false);
                    }else{
                        $('.disabled_or_not'). prop('disabled', true);
                    }
                })
            });


            // checkbox numeric title get and set
            $(document).on('keyup','.checkbox_or_numeric_title',function(){
                let check_numeric_title = $(this).text();
                $('#check_numeric_title').val(check_numeric_title);
            });

            //remove row
            $(document).on('click', '.remove-icon', function() {
                $(this).closest('.append-remove').remove();
            });

            //add row
            $(document).on('click', '.add-rows', function() {
                let tableData = `
                    <tr class="append-include append-remove">
                       <th>
                            <div class="package-head-left">
                                <div class="package-head-left-flex flex-column">
                                    <input class="form-control checkbox_or_numeric_title" type="text" name="checkbox_or_numeric_title[]" placeholder="{{ __('Enter Title') }}">
                                    <div class="text-danger validation-error"></div>
                                </div>
                                <div class="package-field">
                                    <div class="package-field-select">
                                        <select class="form-control checkbox_or_numeric_select" name="checkbox_or_numeric_select[]">
                                            <option value="checkbox">{{ __('Check Boxes') }}</option>
                                            <option value="numeric">{{ __('Numeric') }}</option>
                                            <option value="text">{{ __('Text Field') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </th>

                        <td>
                                <input type="checkbox" name="title[basic]" class="check-input" checked>
                        </td>

                        <td>
                                <input name="title[standard]" type="checkbox" class="check-input disabled_or_not" checked>
                        </td>

                        <td>
                            <input name="title[premium]" type="checkbox" class="check-input disabled_or_not" checked>

                            <div class="package-button-wrapper">
                                <div class="package-field-icon add-rows">
                                    <i class="fa-solid fa-plus"></i>
                                </div>
                                <div class="package-field-icon remove-rows remove-icon">
                                    <i class="fa-solid fa-minus"></i>
                                </div>
                            </div>
                        </td>
                    </tr>
            `;

                $('.create_project_table tr:last').prev().after(tableData);
                $('.package-field-input .disabled_or_not').remove();

                if($('#offer_packages_available_or_not').prop('checked')){
                    $('.create_project_table .disabled_or_not'). prop('disabled', false);
                }else{
                    $('.create_project_table .disabled_or_not'). prop('disabled', true);
                }
            });

            $(document).on('keyup','.checkbox_or_numeric_title',async function(){
                let variable_name = $(this).val().replaceAll(" ","_").toLowerCase();
                let currentRow = $(this).closest(".append-include").find("td input");
                let arrVal = [];

                $(this).parent().find('.validation-error').text("");

                validation.project_title_error = false;

                await $(`.checkbox_or_numeric_title`).each(function (){
                    if(arrVal.includes($(this).val())) {
                        validation.project_title_error = true;
                        arrVal.push($(this).val());

                        if($(this).val().length > 0){
                            $(this).parent().find('.validation-error').text("{{ __("This title is already in use.") }}");
                        }else{
                            $(this).parent().find('.validation-error').text("{{ __("This field is required.") }}");
                        }
                    }else{
                        if($(this).val().length < 1){
                            validation.project_title_error = true;
                            $(this).parent().find('.validation-error').text("{{ __("This field is required.") }}");
                        }
                        arrVal.push($(this).val());
                    }
                });

                let t_array = [
                    "basic",
                    "standard",
                    "premium"
                ];
                let i = 0;

                currentRow.each(function () {
                    let inputName = variable_name + '[' + t_array[i++] + ']';
                    $(this).attr("name", inputName);
                });
            });

            function titleShouldBeUnique(){
                toastr_warning_js("{{ __("All package title is required and title must be unique.") }}");
            }

            // create shake
            $(document).on('click','#confirm_create_project',async function(e){
               let hasValidationErrors = false;
               let hasTitleValidationErrors = false;
               let basic_title = $('#basic_title').data('title');
               let standard_title = $('#standard_title').data('title');
               let premium_title = $('#premium_title').data('title');
               let checkbox_or_numeric_title = $('.checkbox_or_numeric_title').val();

                $('#set_basic_title').val(basic_title)
                $('#set_standard_title').val(standard_title)
                $('#set_premium_title').val(premium_title)

                let basic_regular_charge = $('#basic_regular_charge').val();
                let standard_regular_charge = $('#standard_regular_charge').val();
                let premium_regular_charge = $('#premium_regular_charge').val();
                let package_available_or_not = $('#offer_packages_available_or_not').val()

                if(basic_regular_charge == '' || basic_regular_charge <= 0) {
                    toastr_warning_js("{{ __('Basic price is required!') }}");
                    hasValidationErrors = true;
                }

                if(package_available_or_not == 1){
                    if(standard_regular_charge == '' || standard_regular_charge <= 0) {
                        toastr_warning_js("{{ __('Standard price is required!') }}");
                        hasValidationErrors = true;
                    }
                    if(premium_regular_charge == '' || premium_regular_charge <= 0) {
                        toastr_warning_js("{{ __('Premium price is required!') }}");
                        hasValidationErrors = true;
                    }
                }

                let arrVal = [];
                $('.checkbox_or_numeric_title').each(function (){
                    if (arrVal.includes($(this).val()) || $(this).val().length < 1) {
                        $(this).parent().find('.validation-error').text("{{ __('This field is required.') }}");
                        hasTitleValidationErrors = true;
                    } else {
                        arrVal.push($(this).val());
                    }
                });

                if(hasTitleValidationErrors){
                    e.preventDefault();
                    titleShouldBeUnique();
                }else if(hasValidationErrors){
                    e.preventDefault();
                }else{
                    $('#project_edit_load_spinner').html('<i class="fas fa-spinner fa-pulse"></i>')
                }

            });

            let siteCurrency = {!! json_encode(site_currency_symbol()) !!};
            console.log('Currency symbol loaded:', siteCurrency);

            // Basic Price Setup
            $(document).on('click', '.basic_price_setup', function () {
                console.log('Basic Price Setup Clicked');
                let basic_regular_charge = $('#basic_regular_charge_modal').val();
                let basic_discount_charge = $('#basic_discount_charge_modal').val();

                console.log('Values:', basic_regular_charge, basic_discount_charge);

                $('#basic_regular_charge').val(basic_regular_charge);
                $('#basic_discount_charge').val(basic_discount_charge);

                if(basic_discount_charge != '' && basic_discount_charge > 0){
                    $('#display_basic_discount_charge, .basic_discount_charge').html(siteCurrency + basic_discount_charge);
                    $('#display_basic_regular_charge, .basic_regular_charge').html('<s>' + siteCurrency + basic_regular_charge + '</s>');
                }else{
                    $('#display_basic_discount_charge, .basic_discount_charge').html('');
                    $('#display_basic_regular_charge, .basic_regular_charge').html(siteCurrency + basic_regular_charge);
                }

                $('.price-popup-basic-charge').removeClass('popup-active');
                $('.popup-overlay').removeClass('popup-active');
            });

            // Standard Price Setup
            $(document).on('click', '.standard_price_setup', function () {
                let standard_regular_charge = $('#standard_regular_charge_modal').val();
                let standard_discount_charge = $('#standard_discount_charge_modal').val();

                $('#standard_regular_charge').val(standard_regular_charge);
                $('#standard_discount_charge').val(standard_discount_charge);

                if(standard_discount_charge != '' && standard_discount_charge > 0){
                    $('#display_standard_discount_charge, .standard_discount_charge').html(siteCurrency + standard_discount_charge);
                    $('#display_standard_regular_charge, .standard_regular_charge').html('<s>' + siteCurrency + standard_regular_charge + '</s>');
                }else{
                    $('#display_standard_discount_charge, .standard_discount_charge').html('');
                    $('#display_standard_regular_charge, .standard_regular_charge').html(siteCurrency + standard_regular_charge);
                }

                $('.price-popup-standard-charge').removeClass('popup-active');
                $('.popup-overlay').removeClass('popup-active');
            });

             // Premium Price Setup
             $(document).on('click', '.premium_price_setup', function () {
                let premium_regular_charge = $('#premium_regular_charge_modal').val();
                let premium_discount_charge = $('#premium_discount_charge_modal').val();

                $('#premium_regular_charge').val(premium_regular_charge);
                $('#premium_discount_charge').val(premium_discount_charge);

                if(premium_discount_charge != '' && premium_discount_charge > 0){
                    $('#display_premium_discount_charge, .premium_discount_charge').html(siteCurrency + premium_discount_charge);
                    $('#display_premium_regular_charge, .premium_regular_charge').html('<s>' + siteCurrency + premium_regular_charge + '</s>');
                }else{
                    $('#display_premium_discount_charge, .premium_discount_charge').html('');
                    $('#display_premium_regular_charge, .premium_regular_charge').html(siteCurrency + premium_regular_charge);
                }

                $('.price-popup-premium-charge').removeClass('popup-active');
                $('.popup-overlay').removeClass('popup-active');
            });

            // Sync on Open
            $(document).on('click', '.click-edit-basic-price', function () {
                let regular_charge = $('#basic_regular_charge').val();
                let discount_charge = $('#basic_discount_charge').val();
                $('#basic_regular_charge_modal').val(regular_charge);
                $('#basic_discount_charge_modal').val(discount_charge);
            });

            $(document).on('click', '.click-edit-standard-price', function () {
                let regular_charge = $('#standard_regular_charge').val();
                let discount_charge = $('#standard_discount_charge').val();
                $('#standard_regular_charge_modal').val(regular_charge);
                $('#standard_discount_charge_modal').val(discount_charge);
            });

            $(document).on('click', '.click-edit-premium-price', function () {
                let regular_charge = $('#premium_regular_charge').val();
                let discount_charge = $('#premium_discount_charge').val();
                $('#premium_regular_charge_modal').val(regular_charge);
                $('#premium_discount_charge_modal').val(discount_charge);
            });

        });

    }(jQuery));

    function pre_next(){
        let Listings = document.querySelectorAll(".single-setup-request-list li");
        let sections = document.querySelectorAll(".setup-wrapper-contents");
        let current = 0;

        const toggleListings = () => {
            Listings.forEach(function(e) {
                e.classList.remove('running');
            });
            Listings[current].classList.add("running");
            Listings[current].classList.remove("completed");
            if (current != 0) {
                Listings[current - 1].classList.add("completed");
            }
        }

        const toggleSections = () => {
            sections.forEach(function(section) {
                section.classList.remove('active');
            });
            sections[current].classList.add("active");
        }

        $(document).on("click", "#next", function (e){
            e.preventDefault();

            if (current <= Listings.length) {
                current++

                // add introduction
                if(current == 1){
                    let title = $('#project_title').val();
                    let description = $('#project_description').val();
                    let category = $('#category').val();
                    let subcategory = $('#subcategory').val();

                    if(title == '' || description == '' || category == '' || subcategory == ''){
                        current = 0;
                        toastr_warning_js("{{ __('Please fill all fields !') }}");
                        return false;
                    }
                    if(title.length < 20){
                        current = 0;
                        toastr_warning_js("{{ __('Title must be at least 20 characters') }}");
                        return false;
                    }
                    if(description.length < 50){
                        current = 0;
                        toastr_warning_js("{{ __('Description must be at least 50 characters') }}");
                        return false;
                    }
                }
                else if(current == 2){
                     $('.setup-footer-right').html('<button type="submit" class="btn-profile btn-bg-1" id="confirm_create_project">{{ __('Update Project') }}<span id="project_edit_load_spinner"></span></button>');
                }else{
                    $('.setup-footer-right').html('<a href="javascript:void(0)" class="setup-footer-next next" id="next"> <i class="fas fa-arrow-right"></i> </a>');
                }
            }

            toggleListings();
            toggleSections();
        })

        $(document).on("click", "#previous", function (){
            if (current > 0) {
                current--
                if(current == 2){
                    $('.setup-footer-right').html('<input type="submit" class="btn-profile btn-bg-1" value="{{ __('Update Project') }}">');
                }else{
                    $('.setup-footer-right').html('<a href="javascript:void(0)" class="setup-footer-next next" id="next"> <i class="fas fa-arrow-right"></i> </a>');
                }
            }
            toggleListings();
            toggleSections();
        });
    }

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
