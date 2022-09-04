<!--
=========================================================
 Paper Dashboard - v2.0.0
=========================================================

 Product Page: https://www.creative-tim.com/product/paper-dashboard
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 UPDIVISION (https://updivision.com)
 Licensed under MIT (https://github.com/creativetimofficial/paper-dashboard/blob/master/LICENSE)

 Coded by Creative Tim

=========================================================

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('paper') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('paper') }}/img/cpu-logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- Extra details for Live View on GitHub Pages -->

    <title>
        {{ __('Library Aquisition') }}
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/11abfa0711.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1f5ccdbc5a.js" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">

    <!-- CSS Files -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('paper') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('paper') }}/css/jquery-ui.min.css" rel="stylesheet" />
    <link href="{{ asset('paper') }}/css/hotels/add-room_type.css" rel="stylesheet" />
    <link href="{{ asset('paper') }}/css/paper-dashboard.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@700&display=swap" rel="stylesheet">
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('paper') }}/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet" />
    <!-- Tags -->
    <!-- <link href="{{ asset('paper') }}/css/tagsinput.css" rel="stylesheet" /> -->
    <!-- Style -->


    <!-- {{-- <link href="{{ asset('paper') }}/css/style.css" rel="stylesheet" /> --}} -->
    <!-- Other CSS for All Platform View -->
    <link href="{{ asset('css') }}/user/user.css" rel="stylesheet" />
    <link href="{{ asset('css') }}/role/role.css" rel="stylesheet" />
    <link href="{{ asset('css') }}/content/content.css" rel="stylesheet" />
    <link href="{{ asset('css') }}/document/document.css" rel="stylesheet" />
    <link href="{{ asset('css') }}/media/media.css" rel="stylesheet" />
    <link href="{{ asset('css') }}/contact/contact.css" rel="stylesheet" />
    <link href="{{ asset('css') }}/region/region.css" rel="stylesheet" />
    <link href="{{ asset('css') }}/country/country.css" rel="stylesheet" />
    <link href="{{ asset('css') }}/nationality/nationality.css" rel="stylesheet" />
    <link href="{{ asset('css') }}/content_type/content_type.css" rel="stylesheet" />
    <link href="{{ asset('css') }}/hotel/hotel.css" rel="stylesheet" />
    <!-- dycalendar css -->
    <link href="{{ asset('dycalendar') }}/dycalendar.css" rel="stylesheet" />
    <link href="{{ asset('dycalendar') }}/calendar.css" rel="stylesheet" />
    <!-- Fonts Google Icon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- bulk image -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.7/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" /> -->

    <!-- EasyAutocomplete -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/easy-autocomplete.min.css" integrity="sha512-TsNN9S3X3jnaUdLd+JpyR5yVSBvW9M6ruKKqJl5XiBpuzzyIMcBavigTAHaH50MJudhv5XIkXMOwBL7TbhXThQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/easy-autocomplete.themes.min.css" integrity="sha512-5EKwOr+n8VmXDYfE/EObmrG9jmYBj/c1ZRCDaWvHMkv6qIsE60srmshD8tHpr9C7Qo4nXyA0ki22SqtLyc4PRw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css"> -->
    
</head>

<body class="{{ $class }}">

    @auth()
    @include('layouts.page_templates.auth')
    @endauth

    @guest
    @include('layouts.page_templates.guest')
    @endguest

    <script>
        var base_url = "{{ url('/') }}";
    </script>
    <!--   Core JS Files   -->
    <script src="{{ asset('js/manifest.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- <script src="{{ asset('paper') }}/js/core/jquery.min.js"></script> -->
    <script src="{{ asset('paper') }}/js/core/jquery-ui.min.js"></script>
    <!-- <script src="{{ asset('paper') }}/js/core/popper.min.js"></script> -->
    <!-- <script src="{{ asset('paper') }}/js/core/bootstrap.min.js"></script> -->
    <script src="{{ asset('paper') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Google Maps Plugin    -->
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
    <!-- Chart JS -->
    <script src="{{ asset('paper') }}/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('paper') }}/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('paper') }}/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>

    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.js"></script> -->

    <!-- EasyAutocomplete -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/jquery.easy-autocomplete.min.js" integrity="sha512-Z/2pIbAzFuLlc7WIt/xifag7As7GuTqoBbLsVTgut69QynAIOclmweT6o7pkxVoGGfLcmPJKn/lnxyMNKBAKgg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Sharrre libray -->
    <script src="{{ asset('paper') }}/demo/jquery.sharrre.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- dycalendar js -->
    <!-- <script src="{{ asset('dycalendar') }}/dycalendar.js"></script> -->

    <!-- <script src="node_modules/blueimp-file-upload/js/jquery.fileupload.js"></script> -->
    <!-- print documents -->
    <script src="{{ asset('js/printThis.js') }}"></script>

    <!-- CKEditor 4 -->
    <!-- <script src="https://cdn.ckeditor.com/4.19.1/basic/ckeditor.js"></script> -->

    <!-- daterangepicker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <!-- Tags input -->
    <script src="{{ asset('js') }}/custom.js"></script>
    <script>
        var PRELOADING = "<div class='text-center'><i class='fa fa-spin fa-spinner' style='font-size: 30px'></i></div>";
    $(function() {
        // $('[data-toggle="tooltip"]').tooltip();
        //autoclose alert
        $('div.alert').delay(3000).slideUp(300);
    })
    </script>
    @stack('scripts')

    @include('layouts.navbars.fixed-plugin-js')
</body>

</html>
