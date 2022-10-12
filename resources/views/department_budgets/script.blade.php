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

        $('#no_of_students').keydown(function(e) {
            if (e.shiftKet)
                e.preventDefault();

            if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105) ||
                e.keyCode == 8 || e.keyCode == 9 || e.keyCode == 37 || e.keyCode == 39 || e.keyCode ==
                46) {

            } else
                e.preventDefault();

            // if ($(this).val().indexOf('.') !== -1 && e.keyCode == 190)
            //     e.preventDefault();
        });
        $('#amount').keydown(function(e) {
            if (e.shiftKet)
                e.preventDefault();

            if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105) ||
                e.keyCode == 8 || e.keyCode == 9 || e.keyCode == 37 || e.keyCode == 39 || e.keyCode ==
                46 ||
                e.keyCode == 190) {

            } else
                e.preventDefault();

            if ($(this).val().indexOf('.') !== -1 && e.keyCode == 190)
                e.preventDefault();
        }).keyup(function(e) {
            if ($(this).val().charAt(0) == ".") {
                e.preventDefault();
                $(this).val(' ');
            }

            if ($(this).val().split('.').length > 1) {
                if ($(this).val().split('.')[1].length > 2) {
                    e.preventDefault();
                    $(this).val((Math.round($(this).val() * 100) / 100).toFixed(2));
                }
            }
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