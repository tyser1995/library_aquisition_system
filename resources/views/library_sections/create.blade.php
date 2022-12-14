@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'library_sections'
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
                                    <a href="{{ route('library_sections') }}" class="btn btn-sm btn-primary" id="create-region-btn">{{ __('Back to list') }}</a>
                                    <div class="icon">
                                        <a href="{{ route('library_sections') }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('notification.index')
                            <form method="post" action="{{ route('library_section.store') }}" autocomplete="off">
                                @csrf
                                <input type="hidden" name="created_by_users_id" value="{{Auth::user()->id}}"
                                    class="form-control form-control-alternative">
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Section name') }}</h5>
                                        <input type="text" name="section_name" id="input-region-name" class="form-control form-control-alternative" placeholder="{{ __('Enter Section Name') }}" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Section Code') }}</h5>
                                        <input type="text" name="section_code" id="input-region-name" class="form-control form-control-alternative" placeholder="{{ __('Enter Section Code') }}" autofocus>
                                    </div>
                                    @can('library_section-store')
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