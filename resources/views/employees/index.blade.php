@extends('layouts.app', [
'class' => '',
'elementActive' => 'employees'
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
                                    <a href="{{ route('employee.create') }}" class="btn btn-sm btn-primary"
                                        id="add-region-btn">{{ __('Add Employee') }}</a>
                                    <div class="input-group-append icon">
                                        <a href="{{ route('employee.create') }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-plus-square"></i>
                                        </a>
                                    </div>
                                </div>
                            @endcan                            
                        </div>
                    </div>

                    <div class="card-body">
                        @include('notification.index')
                        <table id="tblEmployeeData" class="table table-responsive-sm table-flush display"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th class="d-none">ID</th>
                                    <th>ID Number</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Department</th>
                                    <th>Created date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($employees as $employee)
                                   <tr>
                                        <td class="d-none">{{$employee->id}}</td>
                                        <td>{{$employee->emp_idnum}}</td>
                                        <td>{{$employee->emp_lastname .', '. $employee->emp_firstname}}</td>
                                        <td>{{$employee->rolename}}</td>
                                        <td>{{$employee->department_name}}</td>
                                        <td>{{$employee->created_at}}</td>
                                        <td class="text-center">
                                            <a href="{{route('employee.edit', $employee->id)}}" class="{{Auth::user()->can('employee-edit') ? 'btn btn-info btn-sm' : 'btn btn-info btn-sm d-none'}}" ><i class="fa fa-pencil"></i></a>
                                            <button type="button" data-id="{{$employee->id}}" value="{{$employee->emp_lastname .', '. $employee->emp_firstname}}" class="btnCanDestroy {{Auth::user()->can('employee-delete') ? 'btn btn-danger btn-sm' : 'btn btn-danger btn-sm d-none'}} "><i class="fa fa-remove"></i></button>
                                        </td>
                                   </tr>
                               @endforeach
                            </tbody>
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

@include('department_names.script')
@push('scripts')
<script>
    $(document).ready(function () {
        $('#tblEmployeeData').DataTable({
            deferRender: true,
            processing: true,
            order: [[2, 'asc']],
        });
        $('.btnCanDestroy').click(function() {
            Swal.fire({
                // title: 'Error!',
                text: 'Do you want to remove ' + $(this).val() + ' employee?',
                icon: 'question',
                allowOutsideClick:false,
                confirmButtonText: 'Yes',
                showCancelButton: true,
            }).then((result) => {
                if (result.value) {
                    window.location.href = base_url + "/employees/delete/" + $(this).data('id');
                    Swal.fire({
                        title: $(this).val() +' Deleted Successfully',
                        icon: 'success',
                        allowOutsideClick:false,
                        confirmButtonText: 'Close',
                    }).then(()=>{
                        $('#tblEmployeeData').DataTable().ajax.reload();
                    });
                }
            });
        });
    });
</script>
@endpush