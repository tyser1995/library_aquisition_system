@extends('layouts.app', [
'class' => '',
'elementActive' => 'purchase_requests'
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
                                <a href="{{ route('purchase_requests') }}" class="btn btn-sm btn-primary"
                                    id="create-region-btn">{{ __('Back to list') }}</a>
                                <div class="icon">
                                    <a href="{{ route('purchase_requests') }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('notification.index')
                        <form method="post" action="{{ route('purchase_request.store') }}" autocomplete="off">
                            @csrf
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('Request Type') }}</h5>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                value="option1"> Rush
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                                value="option2"> Not Rush
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('Author') }}
                                    </h5>
                                    <input type="text" name="department_type" id="input-region-name"
                                        class="form-control form-control-alternative"
                                        placeholder="{{ __('Enter Author Name') }}" required autofocus>
                                </div>

                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('Tile') }}
                                    </h5>
                                    <input type="text" name="department_type" id="input-region-name"
                                        class="form-control form-control-alternative"
                                        placeholder="{{ __('Enter Book Title') }}" required autofocus>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4 col-xs-12">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Edition') }}
                                        </h5>
                                        <input type="text" name="department_type" id="input-region-name"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('Enter Book Edition') }}" required autofocus>
                                    </div>

                                    <div class="form-group col-md-4 col-xs-12">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Copies/Volume') }}
                                        </h5>
                                        <input type="text" name="department_type" id="input-region-name"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('Enter Book Copies/Volume') }}" required autofocus>
                                    </div>

                                    <div class="form-group col-md-4 col-xs-12">
                                        <h5 class="form-control-label" for="input-region-name">
                                            {{ __('Publication Date') }}
                                        </h5>
                                        <input list="publication-date" name="publication_date" id="publication_date"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('Enter Publication Date') }}" required autofocus>
                                        <datalist id="publication-date">
                                            @for ($year = date('Y'); $year > (date('Y') - 99); $year--)
                                            <option value="{{$year}}">
                                                @endfor
                                        </datalist>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('Publisher') }}
                                    </h5>
                                    <input type="text" name="department_type" id="input-region-name"
                                        class="form-control form-control-alternative"
                                        placeholder="{{ __('Enter Publisher Name') }}" required autofocus>
                                </div>

                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('Publisher Address') }}
                                    </h5>
                                    <input type="text" name="department_type" id="input-region-name"
                                        class="form-control form-control-alternative"
                                        placeholder="{{ __('Enter Publisher Address') }}" required autofocus>
                                </div>

                                <!-- loop data recommeded by -->
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('Recommended By') }}
                                    </h5>
                                    <div class="form-row">
                                        <div class="form-group col-xs-12 col-md-3">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                        value="option1"> Rush
                                                    <span class="form-check-sign"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- loop data approved by -->
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('Approved By') }}</h5>
                                    <div class="form-row">
                                        <div class="form-group col-xs-12 col-md-3">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                        value="option1"> Rush
                                                    <span class="form-check-sign"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4 col-xs-12">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Charge To') }}
                                        </h5>
                                        <input type="text" name="department_type" id="input-region-name"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('Enter Charge To') }}" required autofocus>
                                    </div>

                                    <div class="form-group col-md-4 col-xs-12">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Subject') }}
                                        </h5>
                                        <input type="text" name="department_type" id="input-region-name"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('Enter Subject') }}">
                                    </div>

                                    <div class="form-group col-md-4 col-xs-12">
                                        <h5 class="form-control-label" for="input-region-name">
                                            {{ __('Existing No of Titles') }}
                                        </h5>
                                        <input type="text" name="department_type" id="input-region-name"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('Existing No of Titles') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('Note') }}
                                    </h5>
                                    <input type="text" name="department_type" id="input-region-name"
                                        class="form-control form-control-alternative"
                                        placeholder="{{ __('Enter Note') }}" required autofocus>
                                </div>

                                <div class="">
                                    <button type="button" class="btn btn-warning mt-4">
                                        <i class="fa fa-plus"></i> {{ __('Another Form Request') }}</button>
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
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
});
</script>
@endpush