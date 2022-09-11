@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'department_names'
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
                                    <a href="{{ route('department_names') }}" class="btn btn-sm btn-primary" id="create-region-btn">{{ __('Back to list') }}</a>
                                    <div class="icon">
                                        <a href="{{ route('department_names') }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('notification.index')
                            <form method="post" action="{{ route('department_name.store') }}" autocomplete="off">
                                @csrf
                                <div class="pl-lg-4">
                                    <input type="hidden" name="created_by_users_id" value="{{Auth::user()->id}}" class="form-control form-control-alternative">
                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Department Type') }}</h5>
                                        <!-- <input type="text" name="department_type" id="department_type" class="form-control form-control-alternative"> -->
                                        <select id="department_types_id" name="department_types_id" class="form-control" required>
                                            <option selected="selected" disabled>Select Department Type</option>
                                            @foreach ($department_type as $department_types)
                                                <option value="{{$department_types->id}}">{{$department_types->department_type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Department Name') }}</h5>
                                        <input type="text" name="department_name" class="form-control form-control-alternative" placeholder="{{ __('Enter Department Name') }}" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Department Code') }}</h5>
                                        <input type="text" name="department_code" class="form-control form-control-alternative" placeholder="{{ __('Enter Department Code') }}" required autofocus>
                                    </div>

                                    @can('deparment_name-store')
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

@push('scripts')
    <script>
        $(function(){
            $('h3.h3_title')[0].innerHTML = $('li.active')[0].innerHTML;
            $('h3.h3_title').find('a').css({
                'color':'black',
                'cursor':'default',
                'text-decoration': 'none',
            });
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