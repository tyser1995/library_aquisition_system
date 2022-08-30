@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'roles',
])

@section('content')
<style>
.permission-list{
    list-style: none;
    padding: 0px;
}
.permission-list li{
    margin: 10px;
    display: inline-block;
    font-size: 19px;
    background-color: #645F59;
    padding: 10px;
}
.permission-list li label, .permission-list li p{
    color:  #ffffff;
}
.chk-permission{
    margin-right: 5px;
}
.permission-list p{
    font-size: 14px;
    font-weight: bold;
}
.box-shadow
{
    -webkit-box-shadow: 0 10px 6px -6px #777;
     -moz-box-shadow: 0 10px 6px -6px #777;
          box-shadow: 0 10px 6px -6px #777;
}
</style>
    <div class="content">
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col-xl-12 order-xl-1">
                    <div class="card  shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('Role') }}</h3>
                                </div>
                                <div class="col-4 text-right edit-role-btn">
                                    <a href="{{ route('roles') }}" class="btn btn-sm btn-primary" id="edit-role-btn">{{ __('Back to list') }}</a>
                                    <div class="icon">
                                        <a href="{{ route('roles') }}" class="btn btn-sm btn-primary">
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
                            <form method="post" action="{{ route('role.update', $role->id) }}" autocomplete="off">
                                @csrf
                                @method('put')
                                
                                <h6 class="heading-small text-muted mb-4">{{ __('Role information') }}</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-role-name">{{ __('Name') }}</label>
                                        <input type="text" name="name" id="input-role-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter Role Name') }}" value="{{ old('name', $role->name) }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <strong>Permission:</strong>
                                        <br/>
                                        <ul class="permission-list">
                                        <?php foreach($groupPermission as $module => $value){ ?>
                                            <li class="box-shadow">
                                                <p><?= ucwords($module); ?></p>                                                
                                                <div class="row">
                                                <?php foreach($value as $m){ ?>
                                                    <div class="col-md-4">
                                                        <label><input <?= in_array($m['id'], $rolePermissions) ? 'checked="checked"' : ''; ?> type="checkbox" class="chk-permission" name="permission[]" value="<?= $m['id']; ?>" /><?= ucwords($m['name']); ?></label>
                                                    </div>
                                                <?php } ?>
                                                </div>
                                            </li>
                                        <?php } ?>
                                        </ul>
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