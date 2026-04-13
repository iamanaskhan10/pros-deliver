<script>
    (function($) {
        "use strict";

        $(document).ready(function() {
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                let project_id = "{{ $project->id }}";

                $.ajax({
                    url: "{{ route('project.review.load.more') . '?page=' }}" + page,
                    method: 'GET',
                    data: {
                        project_id: project_id
                    },
                    success: function(res) {
                        $('.project-reviews').html(res);
                        $('html, body').animate({
                            scrollTop: $('.project-reviews-scroll').offset().top
                        }, 500);
                    }
                });
            });

            $(document).on('change', '#project-review-sorting', function() {
                let sort = $(this).val();
                let url = $(this).data('url');

                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        review_sort: sort
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        $('#project-review-list').html(
                            '<div class="text-center p-3">Loading...</div>');
                    },
                    success: function(res) {
                        $('#project-review-list').html(res.html);
                    },
                    error: function() {
                        $('#project-review-list').html(
                            '<div class="text-danger p-3">Failed to load reviews.</div>'
                        );
                    }
                });
            });

        });

    }(jQuery));
</script>
