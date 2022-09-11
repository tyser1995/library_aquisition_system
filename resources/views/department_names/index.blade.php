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
                            @can('deparment_name-create')
                                <div class="col-4 text-right add-region-btn">
                                    <a href="{{ route('department_name.create') }}" class="btn btn-sm btn-primary"
                                        id="add-region-btn">{{ __('Add Department Name') }}</a>
                                    <div class="input-group-append icon">
                                        <a href="{{ route('department_name.create') }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-plus-square"></i>
                                        </a>
                                    </div>
                                </div>
                            @endcan                            
                        </div>
                    </div>

                    <div class="card-body">
                        @include('notification.index')
                        <table id="tblDepartmentName" class="table table-responsive-sm table-striped table-bordered"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Department Type</th>
                                    <th>Department Code</th>
                                    <th>Department</th>
                                    <th>Created date</th>
                                    @if (Auth::user()->can('deparment_name-list'))
                                        @if (Auth::user()->can('deparment_name-edit') && Auth::user()->can('deparment_name-delete'))
                                            <th class="text-center">Action</th>
                                        @elseif(Auth::user()->can('deparment_name-edit'))
                                            <th class="text-center">Action</th>
                                        @elseif(Auth::user()->can('deparment_name-delete'))
                                            <th class="text-center">Action</th>
                                        @else
                                            
                                        @endif
                                    @endif
                                </tr>
                            </thead>
                        </table>
                        <!-- <div id="app">
                            <department-name-component route="{{ route('department_name.index') }}"></department-name-component>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('department_types.script')
@push('scripts')
@if (Auth::user()->can('deparment_name-list'))
    @if (Auth::user()->can('deparment_name-edit') && Auth::user()->can('deparment_name-delete'))
        @include('department_names.table_view')
    @elseif(Auth::user()->can('deparment_name-edit'))
        @include('department_names.table_edit')
    @elseif(Auth::user()->can('deparment_name-delete'))
        @include('department_names.table_delete') 
    @else
        @include('department_names.table_list')   
    @endif
@endif
@endpush