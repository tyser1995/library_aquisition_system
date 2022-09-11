@extends('layouts.app', [
'class' => '',
'elementActive' => 'department_types'
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
                            @can('deparment_type-create')
                                <div class="col-4 text-right add-region-btn">
                                    <a href="{{ route('department_type.create') }}" class="btn btn-sm btn-primary"
                                        id="add-region-btn">{{ __('Add Department Type') }}</a>
                                    <div class="input-group-append icon">
                                        <a href="{{ route('department_type.create') }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-plus-square"></i>
                                        </a>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </div>

                    <div class="card-body">
                        @include('notification.index')
                        <table id="tblDepartmentType" class="table table-responsive-sm table-striped table-bordered"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Department Type</th>
                                    <th>Created date</th>
                                    @if (Auth::user()->can('department_type-list'))
                                        @if (Auth::user()->can('department_type-edit') && Auth::user()->can('department_type-delete'))
                                            <th class="text-center">Action</th>
                                        @elseif(Auth::user()->can('department_type-edit'))
                                            <th class="text-center">Action</th>
                                        @elseif(Auth::user()->can('department_type-delete'))
                                            <th class="text-center">Action</th>
                                        @else
                                            
                                        @endif
                                    @endif
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('department_types.script')
@push('scripts')
@if (Auth::user()->can('department_type-list'))
    @if (Auth::user()->can('department_type-edit') && Auth::user()->can('department_type-delete'))
        @include('department_types.table_view')
    @elseif(Auth::user()->can('department_type-edit'))
        @include('department_types.table_edit')
    @elseif(Auth::user()->can('department_type-delete'))
        @include('department_types.table_delete') 
    @else
        @include('department_types.table_list')   
    @endif
@endif
@endpush