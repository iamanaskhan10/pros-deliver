<script>
    (function($){
        "use strict";
        $(document).ready(function(){

            $(document).on('keyup','#string_search',function (e) {
                let string_search = $(this).val();
                $.ajax({
                    url:"{{ route('admin.portfolio.search') }}",
                    method:'GET',
                    data:{string_search:string_search},
                    success:function (res) {
                        if(res.status == 'nothing'){
                            $('.search_result').html('<h3 class="text-center text-danger mb-5">{{ __('Nothing Found') }}</h3>');
                        }else{
                            $('.search_result').html(res);
                        }
                    }
                });
            })

            $(document).on('click', '.pagination a', function(e){
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                let string_search = $('#string_search').val();
                portfolio_paginate(page, string_search);
            });

            function portfolio_paginate(page, string_search){
                $.ajax({
                    url:"{{ route('admin.portfolio.paginate.data').'?page=' }}" + page,
                    method:'GET',
                    data:{string_search:string_search},
                    success:function (res) {
                        $('.search_result').html(res);
                    }
                });
            }

        });
    })(jQuery);
</script>
