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
                        <form method="post" action="{{ route('employee.store') }}" autocomplete="off">
                            @csrf
                            <div class="pl-lg-4">
                                <input type="hidden" name="created_by_users_id" value="{{Auth::user()->id}}"
                                    class="form-control form-control-alternative">
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('Department Type') }}
                                    </h5>
                                    <!-- <input type="text" id="department_type" class="form-control form-control-alternative" placeholder="Select Department Type">
                                    <input type="hidden" name="department_names_id" id="department_names_id" class="form-control form-control-alternative" placeholder="Select Department Type"> -->
                                    <!-- <select id="department_names_id" name="department_names_id" class="form-control"
                                        required onmousedown="if(this.options.length>5){this.size=5;}" onchange="this.blur()"  onblur="this.size=0;">
                                        <option selected="selected" disabled>Select Department Type</option>
                                        @foreach ($department_names as $department_name)
                                        <option value="{{$department_name->id}}">{{$department_name->department_name}}
                                        </option>
                                        @endforeach
                                    </select> -->
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
                                    <!-- <input type="text" name="department_type" id="department_type"
                                        class="form-control form-control-alternative" /> -->
                                        @if (empty($user_faculty_and_admin))
                                            <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">
                                                {{__('Add User Faculty and Dean')}}
                                            </a>
                                        @else
                                            <select id="users_id" name="users_id" class="form-control" required>
                                                <option selected="selected" disabled>Select User Account</option>
                                                @foreach ($users as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('ID Number') }}</h5>
                                    <input type="text" name="emp_idnum" id="emp_idnum" class="form-control form-control-alternative"
                                        placeholder="{{ __('Enter Employee ID Number') }}" required autofocus maxlength="10">
                                </div>
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('Last Name') }}</h5>
                                    <input type="text" name="emp_lastname" class="form-control form-control-alternative"
                                        placeholder="{{ __('Enter Employee Last Name') }}" required autofocus>
                                </div>
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('First Name') }}</h5>
                                    <input type="text" name="emp_firstname"
                                        class="form-control form-control-alternative"
                                        placeholder="{{ __('Enter Employee First Name') }}" required autofocus>
                                </div>
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('Middle Name') }}</h5>
                                    <input type="text" name="emp_middlename"
                                        class="form-control form-control-alternative"
                                        placeholder="{{ __('Enter Employee Last Middle') }}" required autofocus>
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
                                @can('employee-store')
                                <div class="">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                                @endcan
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

@include('employees.script')
@push('scripts')
<script>
$(document).ready(function() {
    $('h3.h3_title')[0].innerHTML = $('li.active')[0].innerHTML;
    $('h3.h3_title').find('a').css({
        'color': 'black',
        'cursor': 'default',
        'text-decoration': 'none',
    });
    // var options = {

    //     url: base_url + '/department_names/data',

    //     getValue: "department_name",
    //     template: {
    //         type: "description",
    //             fields: {
    //                 description: "department_code"
    //             }
    //     },
    //     list: {
    //         onSelectItemEvent: function() {
    //             var selectedItemValue = $('#department_type').getSelectedItemData().id;
    //             $('#department_names_id').val(selectedItemValue);
    //         },
    //         maxNumberOfElements: 10,
    //         match: {
    //             enabled: true
    //         }
    //     },

    //     theme: "plate-dark"
    // };

    // $('#department_type').easyAutocomplete(options);

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