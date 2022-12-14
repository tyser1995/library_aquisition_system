@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'department_names'
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
                                    <a href="{{ route('department_names') }}" class="btn btn-sm btn-primary" id="edit-region-btn">{{ __('Back to list') }}</a>
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
                            <form method="post" action="{{ route('department_name.update', $department_name) }}" autocomplete="off">
                                @csrf
                                @method('put')
                                <div class="pl-lg-4">
                                <input type="hidden" name="id" value="{{$department_name->id}}" class="form-control form-control-alternative">
                                <input type="hidden" name="created_by_users_id" value="{{Auth::user()->id}}" class="form-control form-control-alternative">
                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Department Type') }}</h5>
                                        <!-- <input type="text" name="department_type" id="department_type" class="form-control form-control-alternative"> -->
                                        <select id="department_types_id" name="department_types_id" class="form-control nopadding" required>
                                            <option value="0" disabled>Select Department Type</option>
                                            @foreach ($department_type as $department_types)
                                                <option value="{{$department_types->id}}">{{$department_types->department_type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Department Name') }}</h5>
                                        <input type="text" name="department_name" class="form-control form-control-alternative" placeholder="{{ __('Enter Department Name') }}" value="{{ old('department_name', $department_name->department_name) }}" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Department Code') }}</h5>
                                        <input type="text" name="department_code" class="form-control form-control-alternative" placeholder="{{ __('Enter Department Code') }}" value="{{ old('department_code', $department_name->department_code) }}" required autofocus>
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

@push('scripts')
    <script>
        $(document).ready(function () {
            var department_types_id = "{{$department_name_join->department_types_id}}";
            $('#department_types_id')[0].selectedIndex = department_types_id;
        });
    </script>
@endpush
@include('department_types.script')