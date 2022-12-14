@extends('layouts.app-auth', [
'class' => 'main-page'
])
@section('content')
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="../../index2.html" class="h1"><b>CPU</b> Library</a>
        </div>
        <div class="card-body text-center">
            <img src="{{ asset('paper') }}/img/cpu-logo.png" />
            <p class="login-box-msg">Sign in to start your session</p>

            <form class="form" method="POST" action="{{ route('login') }}" autocomplete="off">
                @csrf
                <div class="input-group mb-3">
                <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control" placeholder="{{ __('Email') }}">
                   
                </div>
                <div class="input-group mb-3">
                <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <input type="password" name="password"
                                placeholder="{{ __('Password') }}" type="password" required class="form-control">
                    
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary d-none">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center mt-2 mb-3">
                <a href="#" class="btn btn-block btn-primary d-none">
                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger d-none">
                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
            </div>
            <!-- /.social-auth-links -->

            <p class="mb-1 d-none">
                <a href="forgot-password.html">I forgot my password</a>
            </p>
            <p class="mb-0 d-none">
                <a href="{{route('register')}}" class="text-center">Register a new membership</a>
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->
@endsection