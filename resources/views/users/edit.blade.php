@extends('layouts.app', [
'class' => '',
'elementActive' => 'user',
])
<style>
    .material-symbols-outlined {
        font-variation-settings:
            'FILL'0,
            'wght'400,
            'GRAD'0,
            'opsz'48
    }
</style>

@section('content')
<div class="content">
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8 edit-user-font">
                                <h3 class="mb-0">{{ __('User Management') }}</h3>
                            </div>
                            <div class="col-4 text-right edit-user-btn">
                                <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary" id="edit-user-btn">{{
                                    __('Back to list') }}</a>
                                <div class="icon">
                                    <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                        </div>
                        <div class="col-12">
                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                        </div>
                        <form method="post" action="{{ route('user.update', $user) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name"
                                        class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('First Name') }}" value="{{ old('name', $user->name) }}"
                                        required autofocus>

                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" readonly="readonly" name="email" id="input-email"
                                        class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Email') }}" value="{{ old('email', $user->email) }}"
                                        required>

                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('Password') }}</label>
                                    <input type="password" name="password" id="input-password"
                                        class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Password') }}" value="">
                                    <div class="d-flex justify-content-end">
                                        <div class="mx-3 view_password"
                                            style="transform: translateY(-33px); width:23px;">
                                            <i id="visibilityBtnPassword">
                                                <span id="iconPassword" class="material-symbols-outlined">
                                                    visibility
                                                </span>
                                            </i>
                                        </div>
                                    </div>

                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm
                                        Password') }}</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation"
                                        class="form-control form-control-alternative"
                                        placeholder="{{ __('Confirm Password') }}" value="">
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="mx-3 view_password" style="transform: translateY(-41px); width:23px;">
                                        <i id="visibilityBtnConfirmPassword">
                                            <span id="iconConfirmPassword" class="material-symbols-outlined" id="icon">
                                                visibility
                                            </span>
                                        </i>
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">{{ __('Status') }}</label>
                                    <select name="status" class="form-control">
                                        <option <?php echo $user->status == 'Active' ? 'selected="selected"' : ''; ?>
                                            value="Bctive">Active</option>
                                        <option <?php echo $user->status == 'Blocked' ? 'selected="selected"' : ''; ?>
                                            value="Blocked">Blocked</option>
                                    </select>

                                    @if ($errors->has('status'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('role') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">{{ __('Role') }}</label>
                                    <select name="role" class="form-control">
                                        @foreach ($roles as $key => $role)
                                        <option value="{{ $key }}" <?=$user->role == $key ? 'selected="selected"' : '';
                                            ?>>{{ $role }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('role'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                    @endif
                                </div>


                                <div class="">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(function(){
        $('.view_password > i').mouseover(function(){
            $(this).addClass('text-primary')
        })
        $('.view_password > i').mouseout(function(){
            $(this).removeClass('text-primary')
        })
        $('#input-password-confirmation , #input-password').css('font-family', 'Verdana')
        $('#input-password-confirmation , #input-password').css('letter-spacing', '0.1ch')
    })


    const visibilityBtnPassword = document.getElementById("visibilityBtnPassword");
    visibilityBtnPassword.addEventListener('click', toggleVisibilityPassword) ;
    function toggleVisibilityPassword() {
        const passwordInput = document.getElementById('input-password');
        const iconPassword = document.getElementById('iconPassword');
        
        if(passwordInput.type === "password"){
            passwordInput.type = "text"
            iconPassword.innerHTML = 'visibility_off'
        }else{
            passwordInput.type = "password"
            iconPassword.innerHTML = 'visibility'
        }
    }

    const visibilityBtnConfirmPassword = document.getElementById("visibilityBtnConfirmPassword");
    visibilityBtnConfirmPassword.addEventListener('click', toggleVisibilityConfirmPassword) ;
    function toggleVisibilityConfirmPassword() {
        const passwordInput = document.getElementById('input-password-confirmation');
        const iconConfirmPassword = document.getElementById('iconConfirmPassword');
        if(passwordInput.type === "password"){
            passwordInput.type = "text"
            iconConfirmPassword.innerHTML = 'visibility_off'
        }else{
            passwordInput.type = "password"
            iconConfirmPassword.innerHTML = 'visibility'
        }
    }
</script>
@endpush