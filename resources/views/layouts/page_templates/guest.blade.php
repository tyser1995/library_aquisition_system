@include('layouts.navbars.navs.guest')

<div class="wrapper wrapper-full-page" style="background:#071599">
    <!-- <div class="full-page section-image" filter-color="black" data-image="{{ asset('paper') . '/' . ($backgroundImagePath ?? "img/bg/fabio-mangione.jpg") }}">
        @yield('content')
        @include('layouts.footer')
    </div> -->
    <div class="full-page" >
        @yield('content')
        @include('layouts.footer')
    </div>
</div>
