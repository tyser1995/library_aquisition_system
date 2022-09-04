@extends('layouts.app', [
'class' => '',
'elementActive' => 'department_names'
])

@section('content')
<div class="content">
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0 h3_title"></h3>
                            </div>
                            <div class="col-4 text-right add-region-btn">
                                <a href="{{ route('department_name.create') }}" class="btn btn-sm btn-primary"
                                    id="add-region-btn">{{ __('Add Department Name') }}</a>
                                <div class="input-group-append icon">
                                    <a href="{{ route('department_name.create') }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-plus-square"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('notification.index')
                        <div id="app">
                            <department-name-component route="{{ route('department_name.index') }}"></department-name-component>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('department_types.script')