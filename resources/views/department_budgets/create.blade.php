@extends('layouts.app', [
'class' => '',
'elementActive' => 'department_budgets'
])

@section('content')
<div class="content">
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card  shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0 h3_title"></h3>
                            </div>
                            <div class="col-4 text-right create-region-btn">
                                <a href="{{ route('department_budgets') }}" class="btn btn-sm btn-primary"
                                    id="create-region-btn">{{ __('Back to list') }}</a>
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
                        <form method="post" action="{{ route('department_budget.store') }}" autocomplete="off">
                            @csrf
                            <div class="pl-lg-4">
                                <input type="hidden" name="created_by_users_id" value="{{Auth::user()->id}}"
                                    class="form-control form-control-alternative">
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('Department Name') }}
                                    </h5>
                                    <input list="department_names" type="text" name="department_name_id"
                                        id="department_name_id" class="form-control form-control-alternative"
                                        placeholder="Select Department">
                                    <!-- <select id="department_name_id" name="department_name_id" class="form-control" required>
                                            <option selected="selected" disabled>Select Department</option>
                                            @foreach ($department_name as $department_names)
                                                <option value="{{$department_names->id}}">{{$department_names->department_name}}</option>
                                            @endforeach
                                        </select> -->
                                    <datalist id="department_names">
                                        @foreach ($department_name as $department_names)
                                        <option value="{{$department_names->department_name}}">
                                            {{$department_names->department_name}}</option>
                                        @endforeach
                                    </datalist>
                                </div>
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('No. of Students') }}
                                    </h5>
                                    <input type="text" name="no_of_students" id="no_of_students"
                                        class="form-control form-control-alternative"
                                        placeholder="{{ __('Enter No. of Students') }}" required autofocus>
                                </div>
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('Library Fee') }}</h5>
                                    <input type="text" name="amount" id="amount"
                                        class="form-control form-control-alternative"
                                        placeholder="{{ __('Library Fee') }}" required autofocus>
                                </div>
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('School Semester') }}
                                    </h5>
                                    <select name="semester" class="form-control" required>
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
                        <div id="app"></div>
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
$(function() {
    $('h3.h3_title')[0].innerHTML = $('li.active')[0].innerHTML;
    $('h3.h3_title').find('a').css({
        'color': 'black',
        'cursor': 'default',
        'text-decoration': 'none',
    });

    // $("input[name=department_name_id]").focusout(function(){
    //     alert($(this).val());
    // });
    // var options = {

    //     url: base_url+'/department_names/data',

    //     getValue: "department_type",

    //     list: {
    //         match: {
    //             enabled: true
    //         }
    //     },

    //     theme: "square"
    // };
    // console.log(options);

    // $('#department_type').easyAutocomplete(options);
    // $('#department_types_id').select2({
    //     ajax: {
    //         url: base_url+'/department_names/data',
    //         data: function (params) {
    //         var query = {
    //             search: params.term,
    //             page: params.page || 1
    //         }

    //             return query;
    //         }
    //     }
    // });
    // $('#select_department_type').select2({
    //     placeHolder:'Select',
    // });
});
</script>
@endpush