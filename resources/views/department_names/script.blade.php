@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/jquery.easy-autocomplete.min.js" integrity="sha512-Z/2pIbAzFuLlc7WIt/xifag7As7GuTqoBbLsVTgut69QynAIOclmweT6o7pkxVoGGfLcmPJKn/lnxyMNKBAKgg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function(){
            $('h3.h3_title')[0].innerHTML = $('li.active')[0].innerHTML;
            $('h3.h3_title').find('a').css({
                'color':'black',
                'cursor':'default',
                'text-decoration': 'none',
            });

            // var data = [
            //     {"name": "Afghanistan", "code": "AF"},
            //     {"name": "Aland Islands", "code": "AX"},
            //     {"name": "Albania", "code": "AL"},
            //     {"name": "Algeria", "code": "DZ"},
            //     {"name": "American Samoa", "code": "AS"},
            // ];
            // var options = {

            //     data: data,

            //     getValue: "name",

            //     list: {
            //     match: {
            //         enabled: true
            //     }
            //     },

            //     theme: "square"
            // };

            // $('#department_type').easyAutocomplete(options);
        });
    </script>
@endpush