<script>
    (function($){
        "use strict";
        $(document).ready(function(){
            var notFoundHtml = @json(view('components.frontend.not-found-dash')->render());
            // pagination
            $(document).on('click', '.pagination a', function(e){
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                let string_search = $(this).val();
                subscriptions(page,string_search);
            });
            function subscriptions(page,string_search){
                $.ajax({
                    url:"{{ route('influencer.subscriptions.paginate.data').'?page='}}" + page,
                    data:{string_search:string_search},
                    success:function(res){
                        $('.search_result').html(res);
                    }
                });
            }

            // search category
            $(document).on('keyup','#string_search',function(){
                let string_search = $(this).val();
                $.ajax({
                    url:"{{ route('influencer.subscriptions.search') }}",
                    method:'GET',
                    data:{string_search:string_search},
                    success:function(res){
                        if(res.status=='nothing'){
                           $('.search_result').html(notFoundHtml);
                        }else{
                            $('.search_result').html(res);
                        }
                    }
                });
            })
        });
    }(jQuery));
</script>
