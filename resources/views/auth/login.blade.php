@extends('layouts.app', [
    'class' => 'main-page',
    'backgroundImagePath' => 'img/bg/fabio-mangione.jpg'
])
<style>
    html {
        overflow:hidden !important;
    }
</style>
@section('content')
    <div class="content" style="margin: 0;
    position: absolute;
    top: 45%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;">
        <div class="container">
            <div class="col-lg-4 col-md-6 ml-auto mr-auto">
                <form class="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="card card-login">
                        <div class="card-header no-padding" style="display:grid;justify-content:center">
                            <div class="card-header" style="text-align: center;">
                                <img src="{{ asset('paper') }}/img/cpu-logo.png" />
                                <h3 class="header text-center">{{ __('Login Account') }}</h3>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="form-group">
                                <label>Email address</label>
                                <input class="form-control input-no-border" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control input-no-border" name="password" placeholder="{{ __('Password') }}" type="password" required>
                            </div>

                            <div class="form-group d-none">
                                <div class="form-check">
                                     <label class="form-check-label">
                                        <input class="form-check-input" name="remember" type="checkbox" value="" {{ old('remember') ? 'checked' : '' }}>
                                        <span class="form-check-sign"></span>
                                        {{ __('Remember me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="text-center">
                                <button type="submit" class="btn btn-info btn-round mb-3">{{ __('Sign in') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
                <a href="{{ route('password.request') }}" class="btn btn-link d-none">
                    {{ __('Forgot password') }}
                </a>
                <a href="{{ route('register') }}" class="btn btn-link float-right d-none">
                    {{ __('Create Account') }}
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            //demo.checkFullPageBackgroundImage()
            $('.footer').addClass('d-none');
        });
    </script>
@endpush