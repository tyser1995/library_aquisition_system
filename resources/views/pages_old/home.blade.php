@extends('layouts.app', [
    'class' => 'main-page',
    'elementActive' => ''
])

@section('content')
    <div class="content col-md-12 ml-auto mr-auto ">
        <div class="header py-5 pb-7 pt-lg-9">
            <div class="container col-md-12" >
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-12 pt-5">
                            <h1 class="text-white">{{ __('Welcomes to Paper Dashboard Laravel Live Preview.') }}</h1>

                            <p class="text-white text-lead mt-3 mb-0">
                                {{ __('Log in and see how you can save more than 90 hours of work with CRUDs for managing: #users, #roles, #items, #categories, #tags and more.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            demo.checkFullPageBackgroundImage();
        });
    </script>
@endpush
