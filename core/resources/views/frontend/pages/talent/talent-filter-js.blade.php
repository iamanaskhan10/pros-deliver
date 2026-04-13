<script>
    (function($) {
        "use strict";
        $(document).ready(function() {
            $('.country_select2').select2();
            $('#category').select2();
            $('#skill').select2();
            let isResetting = false;

            var notFoundHtml = @json(view('components.frontend.not-found')->render());

            //talent filter
            $(document).on('change', '#gender, #country , #category , #level , #talent_badge, #skill',
                function() {
                    if (isResetting) return;
                    profiles();
                });

            // pagination
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                profiles(page);
            });

            $(document).on('click', '#job_search_by_text', function() {
                if ($('#job_search_string').val() == '') {
                    return false;
                } else {
                    profiles();
                }
            })

            //get pro profile
            $(document).on('change', '#get_pro_profile', function(e) {
                e.preventDefault();
                if (isResetting) return;
                profiles();
            });

            // filter reset
            $(document).on('click', '#talent_filter_reset', function(e) {
                e.preventDefault();
                isResetting = true;
                $('#gender, #country, #job_search_string, #talent_badge, #level, #category, #skill, #min_count, #max_count, #budget_input').val('').trigger(
                    'change');

                $.ajax({
                    url: "{{ route('talents.filter.reset') }}",
                    method: 'GET',
                    success: function(res) {
                        if (res.status == 'nothing') {
                            $('.search_talent_result').html(notFoundHtml);
                        } else {
                            $('.search_talent_result').html(res);
                        }
                        isResetting = false;
                    },
                    error: function() {
                        isResetting = false;
                    }

                });
            });

            //get all profiles
            function profiles(page = 1) {
                let country = $('#country').val();
                let gender = $('#gender').val();
                let talent_badge = $('#talent_badge').val();
                let category = $('#category').val();
                let level = $('#level').val();
                let skill = $('#skill').val();
                let min_count = $('#min_count').val();
                let max_count = $('#max_count').val();
                let job_search_string = $('#job_search_string').val();
                let get_pro_profiles;

                if ($('#get_pro_profile').prop('checked')) {
                    $('#get_pro_profile').val('1')
                    get_pro_profiles = $('#get_pro_profile').val()
                } else {
                    $('#get_pro_profile').val('0')
                    get_pro_profiles = $('#get_pro_profile').val()
                }

                $.ajax({
                    url: "{{ route('talents.pagination') . '?page=' }}" + page,
                    method: 'GET',
                    data: {
                        gender: gender,
                        country: country,
                        talent_badge: talent_badge,
                        level: level,
                        category: category,
                        skill: skill,
                        min_count: min_count,
                        max_count: max_count,
                        get_pro_profiles: get_pro_profiles,
                        job_search_string: job_search_string
                    },
                    success: function(res) {
                        if (res.status == 'nothing') {
                            $('.search_talent_result').html(notFoundHtml);
                        } else {
                            $('.search_talent_result').html(res);
                        }
                    }

                });
            }

            $(document).on('click', '#set_follower_range', function(e) {
                e.preventDefault();

                let min_count_raw = $('#min_count').val().trim();
                let max_count_raw = $('#max_count').val().trim();

                let min_count = parseFloat(min_count_raw);
                let max_count = parseFloat(max_count_raw);

                if (!min_count_raw || !max_count_raw) {
                    toastr_warning_js("{{ __('Please select both price fields') }}");
                    return;
                }

                if (!isNaN(min_count) && !isNaN(max_count) && max_count < min_count) {
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
                    url: "{{ route('talents.filter') }}",
                    method: 'GET',
                    data: {
                        country: country,
                        category: category,
                        type: type,
                        level: level,
                        min_count: min_count,
                        max_count: max_count,
                        duration: duration,
                        job_search_string: job_search_string,
                        sorting: sorting,
                    },
                    success: function(res) {
                        if (res.status == 'nothing') {
                            $('.search_talent_result').html(notFoundHtml);
                        } else {
                            $('.search_talent_result').html(res);
                        }
                    }
                });
            });

        });
    }(jQuery));
</script>
