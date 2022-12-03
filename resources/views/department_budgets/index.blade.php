@extends('layouts.app', [
'class' => '',
'elementActive' => 'department_budgets'
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
                            @can('department_budget-create')
                                <div class="col-4 text-right add-region-btn">
                                    <a href="{{ route('department_budget.create') }}" class="btn btn-sm btn-primary"
                                        id="add-region-btn">{{ __('Add Budget') }}</a>
                                    <div class="input-group-append icon">
                                        <a href="{{ route('department_budget.create') }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-plus-square"></i>
                                        </a>
                                    </div>
                                </div>
                            @endcan                            
                        </div>
                    </div>

                    <div class="card-body">
                        @include('notification.index')
                        <table id="tblDepartmentBudget" class="table table-responsive-sm table-flush display"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th class="d-none">ID</th>
                                    <th>Department Name</th>
                                    <th>Budget</th>
                                    <th>Semester</th>
                                    <th>School Year</th>
                                    <th>Created date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($budget as $budgets)
                                <?php 
                                    $budget_deduct = \App\Models\PurchaseRequest::where('department_names_id','=',$budgets->deptid)
                                    ->where('deleted_flag','=',0)->sum('amount');

                                    $budget_borrowed = \App\Models\BudgetBorrow::where('dept_names_id','=',$budgets->deptid)
                                    ->where('deleted_flag','=',0)->sum('amount');
                                ?>
                                   <tr>
                                        <td class="d-none">{{$budgets->id}}</td>
                                        <td>{{$budgets->department_name}}</td>
                                        <td>
                                        @if ($budgets->no_of_students == 0)
                                            ₱{{ $budgets->amount < 0 ? 0 : number_format((($budgets->amount)-$budget_borrowed),2) }}
                                        @else
                                          ₱{{ (($budgets->amount * $budgets->no_of_students)-$budget_deduct) < 0 ? 0.00 : number_format(((($budgets->amount * $budgets->no_of_students)-$budget_deduct)-$budget_borrowed),2) }}
                                        @endif
                                        </td>
                                       <td>
                                        @if ($budgets->semester == 1)
                                           {{__('First Semester')}}
                                        @elseif ($budgets->semester == 2)
                                            {{__('Second Semester')}}
                                        @else
                                            {{__('Summer')}}
                                        @endif
                                       </td>
                                        
                                        <td>{{$budgets->school_year}}</td>
                                        <td>{{$budgets->created_at}}</td>
                                        <td class="text-center">
                                                <a href="{{route('department_budget.edit', $budgets)}}" class="{{Auth::user()->can('department_budget-edit') ? 'btn btn-info btn-sm' : 'btn btn-info btn-sm d-none'}}" ><i class="fa fa-pencil"></i></a>
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
        $('#tblDepartmentBudget').DataTable({
            order: [[1, 'asc']]
        });

        
        $('.btnCanDestroy').click(function() {
            Swal.fire({
                // title: 'Error!',
                text: 'Do you want to remove ' + $(this).val() + ' department?',
                icon: 'question',
                allowOutsideClick:false,
                confirmButtonText: 'Yes',
                showCancelButton: true,
            }).then((result) => {
                if (result.value) {
                    window.location.href = base_url + "/department_names/delete/" + $(this).data('id');
                    Swal.fire({
                        title: $(this).val() +' Deleted Successfully',
                        icon: 'success',
                        allowOutsideClick:false,
                        confirmButtonText: 'Close',
                    }).then(()=>{
                        $('#tblDepartmentName').DataTable().ajax.reload();
                    });
                }
            });
        });
    });
</script>
@endpush