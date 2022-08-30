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
                                <!-- <h3 class="mb-0">{{ __('Safari Portal') }}</h3> -->
                            </div>
                            <div class="col-6 text-right add-contact-btn">
                                <a href="{{route('safari_portal_itineraries.create')}}" class="btn btn-sm btn-primary" id="add-contact-btn">{{ __('Import Data') }}</a>
                                <a href="{{route('safari_portal_itineraries/new_itinerary')}}" class="btn btn-sm btn-primary" id="add-contact-btn">{{ __('Create New Itineray') }}</a>
                                <div class="input-group-append icon">
                                    <a href="{{route('safari_portal_itineraries.create')}}" class="btn btn-sm btn-primary mr-2">
                                        <i class="fa fa-download">
                                        </i>
                                    </a>
                                    <a href="{{route('safari_portal_itineraries/new_itinerary')}}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-plus-square">
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
                        <input type="hidden" id="APP_URL" value="{{ env('APP_URL') }}">
                        <!-- <span>plain-text-editor</span>
                        <div id="plain-text-editor"></div>
                        <span>entity-editor</span>
                        <div id="entity-editor"></div>
                        <span>link-editor</span>
                        <div id="link-editor"></div> -->
                        <!-- <div id="unicorn-editor"></div> -->
                        <!-- <div id="example"></div> -->
                        <!-- <div id="rich-text-editor"></div> -->
                        <div id="app">
                            <safari-portal-itinerary-component route="{{route('safari_portal_itineraries.index')}}"></safari-portal-itinerary-component>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection