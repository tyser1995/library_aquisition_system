@push('scripts')
    <script>
        $(function(){
            // Swal.fire({
            //     title: 'Error!',
            //     text: 'Do you want to continue',
            //     icon: 'error',
            //     confirmButtonText: 'Cool'
            // })

            $('h3.h3_title')[0].innerHTML = $('li.active')[0].innerHTML;
            $('h3.h3_title').find('a').css({
                'color':'black',
                'cursor':'default',
                'text-decoration': 'none',
            });
        });
    </script>
@endpush