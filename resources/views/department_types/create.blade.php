@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'department_types'
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
                                    <a href="{{ route('department_types') }}" class="btn btn-sm btn-primary" id="create-region-btn">{{ __('Back to list') }}</a>
                                    <div class="icon">
                                        <a href="{{ route('department_types') }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('notification.index')
                            <form method="post" action="{{ route('department_type.store') }}" autocomplete="off">
                                @csrf
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Department Type') }}</h5>
                                        <input type="text" name="department_type" id="input-region-name" class="form-control form-control-alternative" placeholder="{{ __('Enter Department Type') }}" required autofocus>
                                    </div>
                                    @can('department_type-store')
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
        });
    </script>
@endpush