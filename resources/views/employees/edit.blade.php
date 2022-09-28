@extends('layouts.app', [
'class' => '',
'elementActive' => 'employees'
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
                                <a href="{{ route('employees') }}" class="btn btn-sm btn-primary"
                                    id="create-region-btn">{{ __('Back to list') }}</a>
                                <div class="icon">
                                    <a href="{{ route('employees') }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('notification.index')
                        <form method="post" action="{{ route('employee.update',$employees) }}" autocomplete="off">
                            @csrf
                            @method('put')
                            <div class="pl-lg-4">
                                <input type="hidden" name="created_by_users_id" value="{{Auth::user()->id}}"
                                    class="form-control form-control-alternative">
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('Department Type') }}
                                    </h5>
                                    <!-- <input type="text" name="department_type" id="department_type" class="form-control form-control-alternative"> -->
                                    <select id="department_names_id" name="department_names_id" class="form-control"
                                        required>
                                        <option selected="selected" disabled>Select Department Type</option>
                                        @foreach ($department_names as $department_name)
                                        <option value="{{$department_name->id}}">{{$department_name->department_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('User Account') }}</h5>
                                    <!-- <input type="text" name="department_type" id="department_type" class="form-control form-control-alternative"> -->
                                    <select id="users_id" name="users_id" class="form-control" required>
                                        <option selected="selected" disabled>Select User Account</option>
                                        @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('ID Number') }}</h5>
                                    <input type="text" name="emp_idnum" class="form-control form-control-alternative"
                                        placeholder="{{ __('Enter Employee ID Number') }}" required autofocus
                                        value="{{old('emp_idnum',$employees->emp_idnum)}}">
                                </div>
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('Last Name') }}</h5>
                                    <input type="text" name="emp_lastname" class="form-control form-control-alternative"
                                        placeholder="{{ __('Enter Employee Last Name') }}" required autofocus
                                        value="{{old('emp_lastname',$employees->emp_lastname)}}">
                                </div>
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('First Name') }}</h5>
                                    <input type="text" name="emp_firstname"
                                        class="form-control form-control-alternative"
                                        placeholder="{{ __('Enter Employee First Name') }}" required autofocus
                                        value="{{old('emp_firstname',$employees->emp_firstname)}}">
                                </div>
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('Middle Name') }}</h5>
                                    <input type="text" name="emp_middlename"
                                        class="form-control form-control-alternative"
                                        placeholder="{{ __('Enter Employee Last Middle') }}" required autofocus
                                        value="{{old('emp_middlename',$employees->emp_middlename)}}">
                                </div>
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('Sex') }}</h5>
                                    <!-- <input type="text" name="department_type" id="department_type" class="form-control form-control-alternative"> -->
                                    <select id="emp_sex" name="emp_sex" class="form-control" required>
                                        <option selected="selected" disabled>Select Sex</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
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

@push('scripts')
<script>
$(function() {
    $('h3.h3_title')[0].innerHTML = $('li.active')[0].innerHTML;
    $('h3.h3_title').find('a').css({
        'color': 'black',
        'cursor': 'default',
        'text-decoration': 'none',
    });

    var department_names_id = "{{$employees->department_names_id}}";
    $('#department_names_id')[0].selectedIndex = department_names_id;

    var users_id = "{{$employees->users_id}}";
    $('#users_id').val(users_id);

    var emp_sex = "{{$employees->emp_sex}}";
    $('#emp_sex').val(emp_sex);
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