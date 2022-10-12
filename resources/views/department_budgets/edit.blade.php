@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'department_budgets'
])

@section('content')
    <div class="content">
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col-xl-12 order-xl-1">
                    <div class="card shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0 h3_title"></h3>
                                </div>
                                <div class="col-4 text-right edit-region-btn">
                                    <a href="{{ route('department_budgets') }}" class="btn btn-sm btn-primary" id="edit-region-btn">{{ __('Back to list') }}</a>
                                    <div class="icon">
                                        <a href="{{ route('department_budgets') }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                        @include('notification.index')
                            <form method="post" action="{{ route('department_budget.update', $budget) }}" autocomplete="off">
                                @csrf
                                @method('put')
                                <div class="pl-lg-4">
                                <input type="hidden" name="created_by_users_id" value="{{Auth::user()->id}}"
                                    class="form-control form-control-alternative">
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('Department Name') }}
                                    </h5>
                                    <?php
                                            $department_name = \App\Models\DepartmentName::where('id','=',$budget->department_name_id)
                                            ->select('department_name')
                                            ->get()
                                            ->first();
                                    ?>
                                     <input type="text" name="department_name_id"
                                        id="department_name_id" class="form-control form-control-alternative d-none"
                                        placeholder="Select Department" value="{{$budget->department_name_id}}">

                                    <input type="text" name="department_name"
                                        id="department_name" class="form-control form-control-alternative"
                                        placeholder="Select Department" disabled value="<?= $department_name->department_name?>">
                                </div>
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('No. of Students') }}
                                    </h5>
                                    <input type="text" name="no_of_students" id="no_of_students"
                                        class="form-control form-control-alternative"
                                        placeholder="{{ __('Enter No. of Students') }}" required autofocus value="{{ old('no_of_students',$budget->no_of_students) }}">
                                </div>
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('Library Fee') }}</h5>
                                    <input type="text" name="amount" id="amount"
                                        class="form-control form-control-alternative"
                                        placeholder="{{ __('Library Fee') }}" required autofocus value="{{ old('amount',$budget->amount) }}">
                                </div>
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('School Semester') }}
                                    </h5>
                                    <select id="semester" name="semester" class="form-control" required>
                                        <option selected="selected" disabled>Select Semester</option>
                                        <option value="1">First Semester</option>
                                        <option value="2">Second Semester</option>
                                        <option value="3">Summer</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('School Year') }}
                                    </h5>
                                    <input list="school-year" name="school_year" id="school_year"
                                        class="form-control form-control-alternative"
                                        placeholder="{{ __('Select School Year') }}" required autofocus>
                                    <datalist id="school-year">
                                        @for ($year = (date('Y')+2); $year > (date('Y') - 3); $year--)
                                            <option value="{{$year.'-'.($year+1)}}">
                                        @endfor
                                    </datalist>
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                            </form>
                            <!-- <div id="app"></div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('department_budgets.script')
@push('scripts')
    <script>
        $(function(){
            $('h3.h3_title')[0].innerHTML = $('li.active')[0].innerHTML;
            $('h3.h3_title').find('a').css({
                'color': 'black',
                'cursor': 'default',
                'text-decoration': 'none',
            });

            $('#semester')[0].selectedIndex  = "{{$budget->semester}}";
            $('#school_year').val("{{$budget->school_year}}");
        });
    </script>
@endpush