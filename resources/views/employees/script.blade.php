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

            $('#emp_idnum').on('input',function(e){
                if ($(this).val().charAt(0) == "E" || $(this).val().charAt(0) == "e" || $(this).val().charAt(0) == "-") {
                    e.preventDefault();
                    $(this).val('');
                }

                if($(this).val().length == 2)
                    $(this).val($(this).val()+"-E")
                if($(this).val().length == 3)
                    $(this).val($(this).val()+"E")
                if($(this).val().length > 3)
                    if($(this).val().charAt(5) == "E" || $(this).val().charAt(5) == "e" || $(this).val().charAt(5) == "-")
                        e.preventDefault();
                if($(this).val().length == 7)
                    $(this).val($(this).val()+"-")
            })
            .keydown(function(e) {
            if (e.shiftKet)
                e.preventDefault();

            if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105) ||
                e.keyCode == 8 || e.keyCode == 9 || e.keyCode == 37 || e.keyCode == 39 || e.keyCode ==
                46 ||
                e.keyCode == 69 || e.keyCode == 189) {

            } else
                e.preventDefault();

            // if ($(this).val().indexOf('e') !== -1 && e.keyCode == 189)
            //     e.preventDefault();
        }).keyup(function(e) {
            // if ($(this).val().charAt(1) == "E") {
            //     e.preventDefault();
            //     $(this).val('');
            // }
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