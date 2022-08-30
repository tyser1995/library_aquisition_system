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
                                <a href="{{route('safari_portal_itineraries.index')}}" class="btn btn-sm btn-primary"
                                    id="add-contact-btn">{{ __('Back to list') }}</a>
                                <div class="input-group-append icon">
                                    <a href="{{route('safari_portal_itineraries.create')}}"
                                        class="btn btn-sm btn-primary mr-2">
                                        <i class="fa fa-arrow-circle-o-left">
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
                        <!-- SmartWizard html -->
                        <div id="smartwizard">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-1">
                                        <!-- <div class="num">1</div> -->
                                        General Info...
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-2">
                                        <!-- <span class="num">2</span> -->
                                        Details...
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-3">
                                        <!-- <span class="num">3</span> -->
                                        Costs...
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#step-4">
                                        <!-- <span class="num">4</span> -->
                                        Itinerary...
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                    General Info...
                                </div>
                                <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                    Details...
                                </div>
                                <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                    Costs...
                                </div>
                                <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                                    Itinerary...
                                </div>
                            </div>

                            <!-- Include optional progressbar HTML -->
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<!-- <script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript"> -->
</script>
<script>
$(function() {
    $('#smartwizard').smartWizard({
        selected: 0, // Initial selected step, 0 = first step
        theme: 'basic', // theme for the wizard, related css need to include for other than basic theme
        justified: true, // Nav menu justification. true/false
        autoAdjustHeight: true, // Automatically adjust content height
        backButtonSupport: true, // Enable the back button support
        enableUrlHash: true, // Enable selection of the step based on url hash
        transition: {
            animation: 'none', // Animation effect on navigation, none|fade|slideHorizontal|slideVertical|slideSwing|css(Animation CSS class also need to specify)
            speed: '400', // Animation speed. Not used if animation is 'css'
            easing: '', // Animation easing. Not supported without a jQuery easing plugin. Not used if animation is 'css'
            prefixCss: '', // Only used if animation is 'css'. Animation CSS prefix
            fwdShowCss: '', // Only used if animation is 'css'. Step show Animation CSS on forward direction
            fwdHideCss: '', // Only used if animation is 'css'. Step hide Animation CSS on forward direction
            bckShowCss: '', // Only used if animation is 'css'. Step show Animation CSS on backward direction
            bckHideCss: '', // Only used if animation is 'css'. Step hide Animation CSS on backward direction
        },
        toolbar: {
            position: 'bottom', // none|top|bottom|both
            showNextButton: true, // show/hide a Next button
            showPreviousButton: true, // show/hide a Previous button
            extraHtml: '' // Extra html to show on toolbar
        },
        anchor: {
            enableNavigation: true, // Enable/Disable anchor navigation 
            enableNavigationAlways: false, // Activates all anchors clickable always
            enableDoneState: true, // Add done state on visited steps
            markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
            unDoneOnBackNavigation: false, // While navigate back, done state will be cleared
            enableDoneStateNavigation: true // Enable/Disable the done state navigation
        },
        keyboard: {
            keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
            keyLeft: [37], // Left key code
            keyRight: [39] // Right key code
        },
        lang: { // Language variables for button
            next: 'Next',
            previous: 'Previous'
        },
        disabledSteps: [], // Array Steps disabled
        errorSteps: [], // Array Steps error
        warningSteps: [], // Array Steps warning
        hiddenSteps: [], // Hidden steps
        getContent: null // Callback function for content loading
    });
});
</script>
@endpush