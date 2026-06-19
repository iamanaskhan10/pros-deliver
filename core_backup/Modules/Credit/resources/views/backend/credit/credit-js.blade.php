<script>
    (function($){
        "use strict";
        $(document).ready(function(){
            // Pagination
            $(document).on('click', '.pagination a', function(e){
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                let string_search = $('#string_search').val();
                $.ajax({
                    url: "{{ route('admin.credit.paginate.data') }}?page="+page,
                    data: {string_search: string_search},
                    success: function(res){
                        $('.search_result').html(res);
                    }
                });
            });

            // Search
            $(document).on('keyup', '#string_search', function(){
                let string_search = $(this).val();
                $.ajax({
                    url: "{{ route('admin.credit.search') }}",
                    method: 'GET',
                    data: {string_search: string_search},
                    success: function(res){
                        if(res.status == 'nothing'){
                            $('.search_result').html('<h3 class="text-center text-danger">'+"{{ __('Nothing Found') }}"+'</h3>');
                        }else{
                            $('.search_result').html(res);
                        }
                    }
                });
            });

            // Change Status
            $(document).on('click', '.credit_history_status_change', function(e){
                e.preventDefault();
                Swal.fire({
                    title: '{{__("Are you sure?")}}' ,
                    text: '{{__("To change this status!")}}' ,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{__("Yes, Change it!")}}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).next().find('.swal_form_submit_btn').trigger('click');
                    }
                });
            });
        });
    })(jQuery);
</script>
