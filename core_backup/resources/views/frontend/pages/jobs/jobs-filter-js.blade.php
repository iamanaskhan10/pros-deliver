<script>
    (function($) {
        "use strict";
        $(document).ready(function() {
            $('.country_select2').select2();
            $('#category').select2();
            $('#sorting').select2({
                minimumResultsForSearch: -1
            });
            let isResetting = false;

            var notFoundHtml = @json(view('components.frontend.not-found')->render());

            //star rating filter
            $(document).on('click', '.active-list .list', function() {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');
            });

            $(document).on('click', '#job_search_by_text', function() {
                if ($('#job_search_string').val() == '') {
                    return false;
                } else {
                    let country = $('#country').val();
                    let category = $('#category').val();
                    let type = $('#type').val();
                    let level = $('#level').val();
                    let min_price = $('#min_price').val();
                    let max_price = $('#max_price').val();
                    let duration = $('#duration').val();
                    let sorting = $('#sorting').val();
                    let job_search_string = $('#job_search_string').val();
                    $.ajax({
                        url: "{{ route('jobs.filter') }}",
                        method: 'GET',
                        data: {
                            country: country,
                            category: category,
                            type: type,
                            level: level,
                            min_price: min_price,
                            max_price: max_price,
                            duration: duration,
                            job_search_string: job_search_string,
                            sorting: sorting,
                        },
                        success: function(res) {
                            if (res.status == 'nothing') {
                                $('.search_job_result').html(notFoundHtml);
                            } else {
                                $('.search_job_result').html(res);
                            }
                        }
                    });
                }
            })

            //job filter
            $(document).on('change', '#country , #category, #type , #level , #duration, #sorting', function() {
                if (isResetting) return;

                let country = $('#country').val();
                let category = $('#category').val();
                let type = $('#type').val();
                let level = $('#level').val();
                let min_price = $('#min_price').val();
                let max_price = $('#max_price').val();
                let duration = $('#duration').val();
                let sorting = $('#sorting').val();
                let job_search_string = $('#job_search_string').val();
                $.ajax({
                    url: "{{ route('jobs.filter') }}",
                    method: 'GET',
                    data: {
                        country: country,
                        category: category,
                        type: type,
                        level: level,
                        min_price: min_price,
                        max_price: max_price,
                        duration: duration,
                        job_search_string: job_search_string,
                        sorting: sorting,
                    },
                    success: function(res) {
                        if (res.status == 'nothing') {
                            $('.search_job_result').html(notFoundHtml);
                        } else {
                            $('.search_job_result').html(res);
                        }
                    }
                });
            });

            $(document).on('click', '#set_price_range', function(e) {
                e.preventDefault();

                let min_price_raw = $('#min_price').val().trim();
                let max_price_raw = $('#max_price').val().trim();

                let min_price = parseFloat(min_price_raw);
                let max_price = parseFloat(max_price_raw);

                if (!min_price_raw || !max_price_raw) {
                    toastr_warning_js("{{ __('Please select both price fields') }}");
                    return;
                }

                if (!isNaN(min_price) && !isNaN(max_price) && max_price < min_price) {
                    toastr_warning_js(
                        "{{ __('Maximum price must be greater than or equal to minimum price') }}"
                    );
                    return;
                }

                let country = $('#country').val();
                let category = $('#category').val();
                let type = $('#type').val();
                let level = $('#level').val();
                let duration = $('#duration').val();
                let sorting = $('#sorting').val();
                let job_search_string = $('#job_search_string').val();

                $.ajax({
                    url: "{{ route('jobs.filter') }}",
                    method: 'GET',
                    data: {
                        country: country,
                        category: category,
                        type: type,
                        level: level,
                        min_price: min_price,
                        max_price: max_price,
                        duration: duration,
                        job_search_string: job_search_string,
                        sorting: sorting,
                    },
                    success: function(res) {
                        if (res.status == 'nothing') {
                            $('.search_job_result').html(notFoundHtml);
                        } else {
                            $('.search_job_result').html(res);
                        }
                    }
                });
            });

            // pagination
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                jobs(page);

                $('html, body').animate({
                    scrollTop: 0
                }, 'smooth');
            });

            function jobs(page = 1) {
                let country = $('#country').val();
                let category = $('#category').val();
                let type = $('#type').val();
                let level = $('#level').val();
                let min_price = $('#min_price').val();
                let max_price = $('#max_price').val();
                let duration = $('#duration').val();
                let sorting = $('#sorting').val();
                let job_search_string = $('#job_search_string').val();

                $.ajax({
                    url: "{{ route('jobs.pagination') . '?page=' }}" + page,
                    method: 'GET',
                    data: {
                        country: country,
                        category: category,
                        type: type,
                        level: level,
                        min_price: min_price,
                        max_price: max_price,
                        duration: duration,
                        job_search_string: job_search_string,
                        sorting: sorting,
                    },
                    success: function(res) {
                        if (res.status == 'nothing') {
                            $('.search_job_result').html(notFoundHtml);
                        } else {
                            $('.search_job_result').html(res);
                        }
                    }
                });
            }

            // filter reset
            $(document).on('click', '#campaign_filter_reset', function(e) {
                e.preventDefault();
                isResetting = true;

                // Reset all fields
                $('#country').val('').trigger('change');
                $('#category').val('').trigger('change');
                $('#type').val('').trigger('change');
                $('#budget_input').val('');
                $('#level').val('').trigger('change');
                $('#min_price').val('');
                $('#max_price').val('');
                $('#duration').val('').trigger('change');
                $('#sorting').val('').trigger('change');
                $('#job_search_string').val('');

                $.ajax({
                    url: "{{ route('jobs.filter.reset') }}",
                    method: 'GET',
                    success: function(res) {
                        if (res.status == 'nothing') {
                            $('.search_job_result').html(notFoundHtml);
                        } else {
                            $('.search_job_result').html(res);
                        }
                        isResetting = false;
                    }

                });
            });

        });
    }(jQuery));
</script>
