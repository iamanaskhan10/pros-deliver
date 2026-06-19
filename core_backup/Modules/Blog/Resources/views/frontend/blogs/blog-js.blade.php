<script>
    (function($) {
        "use strict";
        $(document).ready(function() {

            var notFoundHtml = @json(view('components.frontend.not-found')->render());

            $(document).on('click', '.sidebar-category-filter', function(e) {
                e.preventDefault();
                const categoryId = $(this).data('id');
                const url = "{{ route('blog.all') }}"; // All blog page route

                // redirect with category ID as query param
                window.location.href = url + "?category=" + categoryId;
            });

            // Blog search input (on enter key)
            $(document).on('keypress', '#blog_search_input', function(e) {
                if (e.which === 13) {
                    const search = $(this).val();
                    const url = "{{ route('blog.all') }}";

                    if (search.length > 0) {
                        window.location.href = url + "?search=" + encodeURIComponent(search);
                    }
                }
            });

            //star rating filter
            $(document).on('change', '#blog-category', function() {
                let categoryId = $(this).val();

                $.ajax({
                    url: "{{ route('blog.filter') }}",
                    method: 'GET',
                    data: {
                        category: categoryId
                    },
                    success: function(res) {
                        if (res.status == 'nothing') {
                            $('.blog_search_result').html(notFoundHtml);
                        } else {
                            $('.blog_search_result').html(res);
                        }
                    }
                });

            });

            // pagination
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                let category = $('.filter_blog.active').data('blog-category');
                blogs(page, category);
            });

            function blogs(page, category) {
                $.ajax({
                    url: "{{ route('blog.pagination') . '?page=' }}" + page,
                    method: 'GET',
                    data: {
                        category: category
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

        });
    }(jQuery));
</script>
