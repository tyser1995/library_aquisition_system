@extends('layouts.app', [
'class' => '',
'elementActive' => 'safari_portal'
])

@section('content')

<div class="content">
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h3 class="mb-0">{{ __('Import Data') }}</h3>
                            </div>
                            <div class="col-6 text-right add-contact-btn">
                                <a href="{{route('safari_portal_itineraries.index')}}" class="btn btn-sm btn-primary"
                                    id="add-contact-btn">{{ __('Back to List') }}</a>
                                <div class="input-group-append icon">
                                    <a href="{{route('safari_portal_itineraries.index')}}"
                                        class="btn btn-sm btn-primary">
                                        <i class="fa fa-arrow-circle-left">
                                        </i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                    </div>
                    <div class="col-12">
                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                    </div>
                    <div class="card-body">
                    <form method="post" action="{{ route('safari_portal_itineraries.store') }}" autocomplete="off">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">{{ __('Safari Portal API Data') }}</h6>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('itinerary_id') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-itinerary_id">{{ __('Itinerary ID') }}</label>
                                <input type="text" name="itinerary_id" id="itinerary_id"
                                    class="form-control form-control-alternative{{ $errors->has('itinerary_id') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Enter Itinerary ID') }}"
                                    required autofocus>

                                @if ($errors->has('itinerary_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('itinerary_id') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="">
                                <button type="button" id="btnFetch" class="btn btn-success mt-4" hidden>{{ __('Fetch Data') }}</button>
                                <button type="submit" id="btnSave" class="btn btn-success mt-4">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection