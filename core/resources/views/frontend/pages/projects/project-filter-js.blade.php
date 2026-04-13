<script>
    (function($) {
        "use strict";
        $(document).ready(function() {
            $('.country_select2').select2();
            $('#category').select2();

            let isResetting = false;

            var notFoundHtml = @json(view('components.frontend.not-found')->render());

            //star rating filter
            $(document).on('change', '#chose-rating-filter', function() {
                if (isResetting) return;
                projects();
            });

            $(document).on('click', '#job_search_by_text', function() {
                if ($('#job_search_string').val() == '') {
                    return false;
                } else {
                    projects();
                }
            })

            //project filter
            $(document).on('change', '#gender, #country ,#category, #level , #delivery_day', function() {
                if (isResetting) return;
                projects();
            });

            $(document).on('click', '#set_price_range', function(e) {
                e.preventDefault();

                let min_price = parseFloat($('#min_price').val());
                let max_price = parseFloat($('#max_price').val());

                if (isNaN(min_price) || isNaN(max_price)) {
                    toastr_warning_js("{{ __('Please select both price fields') }}");
                    return false;
                }

                if (max_price < min_price) {
                    toastr_warning_js(
                        "{{ __('Maximum price must be greater than or equal to minimum price') }}"
                        );
                    return false;
                }
                projects();
            });


            // pagination
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                projects(page);
                $('html, body').animate({
                    scrollTop: 0
                }, 500);
            });

            function projects(page = 1) {
                let gender = $('#gender').val();
                let country = $('#country').val();
                let category = $('#category').val();
                let level = $('#level').val();
                let min_price = $('#min_price').val();
                let max_price = $('#max_price').val();
                let delivery_day = $('#delivery_day').val();
                let job_search_string = $('#job_search_string').val();
                let get_pro_projects;
                let rating = $('#chose-rating-filter').val();

                if ($('#get_pro_projects').prop('checked')) {
                    $('#get_pro_projects').val('1')
                    get_pro_projects = $('#get_pro_projects').val()
                } else {
                    $('#get_pro_projects').val('0')
                    get_pro_projects = $('#get_pro_projects').val()
                }

                $.ajax({
                    url: "{{ route('projects.pagination') . '?page=' }}" + page,
                    method: 'GET',
                    data: {
                        gender: gender,
                        country: country,
                        category: category,
                        level: level,
                        min_price: min_price,
                        rating: rating,
                        max_price: max_price,
                        delivery_day: delivery_day,
                        get_pro_projects: get_pro_projects,
                        job_search_string: job_search_string
                    },
                    success: function(res) {
                        if (res.status == 'nothing') {
                            $('.search_result').html(notFoundHtml);
                        } else {
                            $('.search_result').html(res);
                        }
                    }

                });
            }

            // filter reset
            $(document).on('click', '#project_filter_reset', function(e) {
                e.preventDefault();
                isResetting = true;

                $('#country').val('').trigger('change');
                $('#category').val('').trigger('change');
                $('#gender').val('').trigger('change');
                $('#level').val('').trigger('change');
                $('#delivery_day').val('').trigger('change');
                $('#chose-rating-filter').val('').trigger('change');
                $('#budget_input').val('');
                $('#min_price').val('');
                $('#max_price').val('');
                $('#job_search_string').val('');
                $('.active-list .list').removeClass('active');
                projects();
                isResetting = false;
            });

            //get pro projects
            $(document).on('change', '#get_pro_projects', function(e) {
                e.preventDefault();
                if (isResetting) return;
                projects();
            });
        });
    }(jQuery));
</script>
