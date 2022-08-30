@extends('layouts.app', [
'class' => '',
'elementActive' => 'roles'
])

@section('content')
<style>
.role-name {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 0px;
}

.role-module-name a {
    color: #ffffff;
}

.module-name {
    font-size: 13px;
}
</style>
<div class="content">
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8 add-role-font">
                                <h3 class="mb-0">{{ __('Roles') }}</h3>
                            </div>
                            <div class="col-4 text-right add-role">
                                <a href="{{ route('role.create') }}" class="btn btn-sm btn-primary" id="add-role">{{
                                    __('Add Role') }}</a>
                                <div class="icon">
                                    <a href="{{ route('role.create') }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-plus-square"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

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
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" style="width: 70%;">{{ __('Name') }}</th>
                                        <th scope="col" style="width:20%;">{{ __('Creation Date') }}</th>
                                        <th scope="col" style="width:10%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($roles->count())
                                    @foreach ($roles as $role)
                                    <tr>
                                        <td>
                                            <div>
                                                <p class="role-name">
                                                    <?= $role->name; ?>
                                                </p>
                                                <p class="role-modules">
                                                    Modules :
                                                    <?php if( isset($group_permissions[$role->id]) ){ ?>
                                                    <?php foreach($group_permissions[$role->id] as $module){ ?>
                                                    <spam class="badge badge-info module-name">
                                                        <?= $module; ?>
                                                    </spam>
                                                    <?php } ?>
                                                    <?php }else{ ?>
                                                    -
                                                    <?php } ?>
                                                </p>
                                            </div>
                                        </td>
                                        <td>{{ $role->created_at->format('M d, Y h:i a') }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="nc-align-left-2 nc-icon"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{ route('role.edit', $role) }}">{{
                                                        __('Edit') }}</a>
                                                    <form action="{{ route('role.destroy', $role) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this role?") }}')
                                                        ? this.parentElement.submit() : ''">
                                                            {{ __('Delete') }}
                                                        </button>
                                                    </form>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr style=" text-align: center;font-size: large;vertical-align: middle;">
                                        <td colspan="6">{{ __('No Records found.') }}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class=" card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $roles->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection