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
                                <div class="container-request-form">
                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Request Type') }}
                                        </h5>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                    value="1" name="rush_type[]"> Rush
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                                    value="0" name="rush_type[]" checked> Not Rush
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Author') }}
                                        </h5>
                                        <input type="text" name="author_name[]" id="author_name"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('Enter Author Name') }}" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Tile') }}
                                        </h5>
                                        <input type="text" name="title[]" id="title[]"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('Enter Book Title') }}" required autofocus>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4 col-xs-12">
                                            <h5 class="form-control-label" for="input-region-name">{{ __('Edition') }}
                                            </h5>
                                            <input type="text" name="edition[]" id="edition"
                                                class="form-control form-control-alternative is_num_edition"
                                                placeholder="{{ __('Enter Book Edition') }}" required autofocus>
                                        </div>

                                        <div class="form-group col-md-4 col-xs-12">
                                            <h5 class="form-control-label" for="input-region-name">
                                                {{ __('Copies/Volume') }}
                                            </h5>
                                            <input type="text" name="copies_vol[]" id="copies_vol"
                                                class="form-control form-control-alternative is_num_copies_vol"
                                                placeholder="{{ __('Enter Book Copies/Volume') }}" required autofocus>
                                        </div>

                                        <div class="form-group col-md-4 col-xs-12">
                                            <h5 class="form-control-label" for="input-region-name">
                                                {{ __('Publication Date') }}
                                            </h5>
                                            <input list="publication-date" name="publication_date[]"
                                                id="publication_date" minlength="4" maxlength="4" class="form-control form-control-alternative is_num_publication_date"
                                                placeholder="{{ __('Enter Publication Date') }}" required autofocus>
                                            <datalist id="publication-date">
                                                @for ($year = date('Y'); $year > (date('Y') - 99); $year--)
                                                <option value="{{$year}}">
                                                    @endfor
                                            </datalist>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Dealer/Supplier') }}
                                        </h5>
                                        <input type="text" name="publisher_name[]" id="publisher_name[]"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('Enter Publisher Name') }}" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">
                                            {{ __('Publisher Address') }}
                                        </h5>
                                        <input type="text" name="publisher_address[]" id="publisher_address[]"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('Enter Publisher Address') }}" required autofocus>
                                    </div>

                                    <!-- loop data recommeded by -->
                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">
                                            {{ __('Recommended By') }}
                                        </h5>
                                        <div class="form-row">
                                            @foreach ($purchase_request_recommended_users as
                                            $purchase_request_recommended_user)
                                            <div class="form-group col-xs-12 col-md-3">
                                                <div class="recommended_by_checkbox form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        @if ($role_name ==
                                                        $purchase_request_recommended_user->recommended_user)
                                                        <input class="form-check-input" type="checkbox"
                                                            id="{{$purchase_request_recommended_user->id}}"
                                                            value="{{$purchase_request_recommended_user->id}}"
                                                            name="recommended_user_id[]" checked>
                                                        @else
                                                        <input class="form-check-input" type="checkbox"
                                                            id="{{$purchase_request_recommended_user->id}}"
                                                            value="{{$purchase_request_recommended_user->id}}"
                                                            name="recommended_user_id[]">
                                                        @endif

                                                        {{$purchase_request_recommended_user->recommended_user}}
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- loop data approved by -->
                                    <div class="<?= $role_name == "Dean" || $role_name == "Director of Libraries" || $role_name == "Principal" ? '' : ' d-none' ?> form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Approved By') }}
                                        </h5>
                                        <div class="form-row">
                                            @foreach ($purchase_request_approver_users as
                                            $purchase_request_approver_user)
                                            <div class="approved_by_checkbox form-group col-xs-12 col-md-3">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        @if ($role_name ==
                                                            $purchase_request_approver_user->approver_user)
                                                            <input class="form-check-input" type="checkbox"
                                                                id="{{$purchase_request_approver_user->id}}"
                                                                value="{{$purchase_request_approver_user->id}}"
                                                                name="approver_user_id[]" checked>
                                                            @else
                                                            <input class="form-check-input" type="checkbox"
                                                                id="{{$purchase_request_approver_user->id}}"
                                                                value="{{$purchase_request_approver_user->id}}"
                                                                name="approver_user_id[]">
                                                            @endif
                                                        {{$purchase_request_approver_user->approver_user}}
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4 col-xs-12">
                                            <h5 class="form-control-label" for="input-region-name">{{ __('Charge To') }}
                                            </h5>
                                            <input list="charge_to" type="text" name="charge_to[]" id="charge_to[]"
                                                class="form-control form-control-alternative"
                                                placeholder="{{ __('Enter Charge To') }}" required autofocus
                                                value="<?= !empty($department_name) ? $department_name->department_name : '' ?>">
                                                
                                            @if (empty($department_name))
                                                <datalist id="charge_to">
                                                    @foreach($department_name_list as $department_name_lists)
                                                        <option value="{{$department_name_lists->department_name}}">{{$department_name_lists->department_name}}</option>
                                                    @endforeach
                                                </datalist>
                                            @endif
                                        </div>

                                        <div class="form-group col-md-4 col-xs-12">
                                            <h5 class="form-control-label" for="input-region-name">{{ __('Subject') }}
                                            </h5>
                                            <input type="text" name="subject[]" id="subject"
                                                class="form-control form-control-alternative"
                                                placeholder="{{ __('Enter Subject') }}">
                                        </div>

                                        <div class="form-group col-md-4 col-xs-12">
                                            <h5 class="form-control-label" for="input-region-name">
                                                {{ __('Existing No of Titles') }}
                                            </h5>
                                            <input type="text" name="existing_no_of_titles[]" id="existing_no_of_titles"
                                                class="form-control form-control-alternative is_num_existing_no_of_titles"
                                                placeholder="{{ __('Existing No of Titles') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Note') }}
                                        </h5>
                                        <input type="text" name="note[]" id="note[]"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('Enter Note') }}" required autofocus>
                                    </div>
                                    <hr />
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="add_form_field-request-form btn btn-warning mt-4">
                                        <span style="font-size:16px; font-weight:bold;">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        </span>{{ __('Another Form Request') }}
                                    </button>
                                </div>
                                @can('purchase_request-store')
                                <div class="">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                                @endcan
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
@include('purchase_requests.script')
<script>
function checkboxCheckOnlyOneByGroup() {
    $("input:checkbox").on('click', function() {
        // in the handler, 'this' refers to the box clicked on
        var $box = $(this);
        if ($box.is(":checked")) {
            // the name of the box is retrieved using the .attr() method
            // as it is assumed and expected to be immutable
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            // the checked state of the group/box on the other hand will change
            // and the current value is retrieved using .prop() method
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });

    // $('div.approved_by_checkbox input[type="checkbox"]').on('change', function() {
    //     $('input[type="checkbox"]').not(this).prop('checked', false);
    // });
}
$(function() {
    $('h3.h3_title')[0].innerHTML = $('li.active')[0].innerHTML;
    $('h3.h3_title').find('a').css({
        'color': 'black',
        'cursor': 'default',
        'text-decoration': 'none',
    });

    checkboxCheckOnlyOneByGroup();
 

//     var publisher = "<?php
//         foreach($publisher as $publishers){
//             echo $publishers->publisher_name;
//         }
//     ?>";

// console.log(publisher);
//     for (var i = 1; i < publisher.split(',').length; i++) {
//         console.log(i);
//     }
    // var data = [{
    //         "name": "Afghanistan",
    //         "code": "AF"
    //     },
    //     {
    //         "name": "Aland Islands",
    //         "code": "AX"
    //     },
    //     {
    //         "name": "Albania",
    //         "code": "AL"
    //     },
    //     {
    //         "name": "Algeria",
    //         "code": "DZ"
    //     },
    //     {
    //         "name": "American Samoa",
    //         "code": "AS"
    //     },
    // ];
    // var options = {

    //     url: base_url+'/purchase_requests/department_data',

    //     getValue: "department_name",

    //     list: {
    //         match: {
    //             enabled: true
    //         }
    //     },

    //     theme: "square"
    // };

    // $('#charge_to').autocomplete(options);

});
</script>
@endpush