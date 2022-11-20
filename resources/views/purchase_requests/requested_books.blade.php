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
                        <form method="post"
                            action="{{ route('purchase_requests/requested_books_put',$purchase_request) }}"
                            autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" name="approved" value="approved" />
                            <input type="hidden" name="purchase_request_id" value="{{$purchase_request->id}}" />
                            <input type="hidden" id="password" name="password"
                                value="{{!empty($signature->password) ? $signature->password : ''}}" />
                            <div class="pl-lg-4">
                                <div class="container-request-form">
                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Request Type') }}
                                        </h5>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                    value="0" name="rush_type[]" checked> Rush
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Author') }}
                                        </h5>
                                        <input type="text" name="author_name[]" id="author_name"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('Enter Author Name') }}" required autofocus
                                            value="{{old('author_name',explode(',',$purchase_request->author_name)[0])}}">
                                    </div>

                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Tile') }}
                                        </h5>
                                        <input type="text" name="title[]" id="title[]"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('Enter Book Title') }}" required autofocus
                                            value="{{old('title',explode(',',$purchase_request->title)[0])}}">
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4 col-xs-12">
                                            <h5 class="form-control-label" for="input-region-name">{{ __('Edition') }}
                                            </h5>
                                            <input type="text" name="edition[]" id="edition[]"
                                                class="form-control form-control-alternative"
                                                placeholder="{{ __('Enter Book Edition') }}" required autofocus
                                                value="{{old('edition',explode(',',$purchase_request->edition)[0])}}">
                                        </div>

                                        <div class="form-group col-md-4 col-xs-12">
                                            <h5 class="form-control-label" for="input-region-name">
                                                {{ __('Copies/Volume') }}
                                            </h5>
                                            <input type="text" name="copies_vol[]" id="copies_vol[]"
                                                class="form-control form-control-alternative"
                                                placeholder="{{ __('Enter Book Copies/Volume') }}" required autofocus
                                                value="{{old('copies_vol',explode(',',$purchase_request->copies_vol)[0])}}">
                                        </div>

                                        <div class="form-group col-md-4 col-xs-12">
                                            <h5 class="form-control-label" for="input-region-name">
                                                {{ __('Publication Date') }}
                                            </h5>
                                            <input list="publication-date" name="publication_date[]"
                                                id="publication_date[]" class="form-control form-control-alternative"
                                                placeholder="{{ __('Enter Publication Date') }}" required autofocus
                                                value="{{old('publication_date',explode(',',$purchase_request->publication_date)[0])}}">
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
                                        <input type="text" name="publisher_name[]" id="publisher_name[]"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('Enter Publisher Name') }}" required autofocus
                                            value="{{old('publisher_name',explode(',',$purchase_request->publisher_name)[0])}}">
                                    </div>
                                    <!-- loop data approved by -->
                                    <div class="<?= $purchase_request->status_id == 2 ? 'd-none': '' ?> form-group">
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
                                    @if ($purchase_request->status_id == 2)
                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Price') }}
                                        </h5>
                                        <input type="text" name="amount"
                                            class="form-control form-control-alternative book_price"
                                            placeholder="{{ __('Enter Book Price') }}" required autofocus>
                                    </div>
                                    @endif
                                    <hr />
                                </div>
                                <div class="d-flex justify-content-center d-none">
                                    <button type="button"
                                        class="add_form_field-request-form btn btn-warning mt-4 d-none">
                                        <span style="font-size:16px; font-weight:bold;">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        </span>{{ __('Another Form Request') }}
                                    </button>
                                </div>
                                @can('purchase_request-store')
                                <div class="">
                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">
                                            {{ __('Total Book Price') }}
                                            <input type="text" id="totalBookPrice"
                                                class="form-control form-control-alternative" placeholder="₱ 0.00"
                                                disabled />
                                    </div>
                                    <div class="form-group media-single-upload attached_signature d-none">
                                        <span>Attached Signature</span>
                                        <input type="file" class="file-upload" name="image" id="e_signature"
                                            onchange="readURL(this);" style="cursor:pointer">
                                        <img id="e_signature_img" class="single-upload-img-show"
                                            style="object-fit:contain" name="e_signature_img"
                                            src="{{asset('/gallery/img/no-image1.jpg')}}" alt="Browse image"
                                            width="100%" height="150px" />
                                    </div>
                                    <div style="display:flex;justify-content: space-between; align-items: center;">
                                        <div>
                                            <button type="button"
                                                class="btn btn-success mt-4 btnAttachedESign">{{ __('Enter Password') }}</button>
                                            <button type="submit" class="btn btn-success mt-4 btnApproved"
                                                disabled>{{ __('Approved') }}</button>
                                            <button type="button"
                                                class="btn btn-success mt-4 btnComputePrice">{{ __('Compute Price') }}</button>
                                        </div>
                                        <div>
                                            @if ($purchase_request->status_id == 2)
                                            <span>Budget:₱</span>
                                            <span
                                                id="span_budget">{{number_format($budget->no_of_students * $budget->amount,2)}}</span>
                                            @endif
                                        </div>
                                    </div>

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
<!-- Modal -->
<div class="modal fade" id="modalBudgetNotEnough" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Warning Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-danger">Budget not enough!</h5>
                <br>
                <table id="tblDepartmentBudget" class="table table-responsive-sm table-flush display"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th class="d-none">ID</th>
                            <th>Department Name</th>
                            <th>Budget</th>
                            <th>Semester</th>
                            <th>School Year</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($budget_all as $budgets)
                        <tr>
                            <td class="d-none">{{$budgets->id}}</td>
                            <td>{{$budgets->department_name}}</td>
                            @if ($budgets->no_of_students == 0)
                            <td>{{$budgets->amount}}</td>
                            @else
                            <td>₱{{number_format($budgets->amount * $budgets->no_of_students,2)}}</td>
                            @endif
                            @if ($budgets->semester == 1)
                            <td>{{__('First Semester')}}</td>
                            @elseif ($budgets->semester == 2)
                            <td>{{__('Second Semester')}}</td>
                            @else
                            <td>{{__('Summer')}}</td>
                            @endif
                            <td>{{$budgets->school_year}}</td>
                            <td class="text-center">
                                    <button type="submit" id="btnBorrowedAmount" data-id="{{$budgets->id}}" class="btn btn-info btn-sm"><i
                                            class="fa fa-money"></i></button>
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

function retrieveRequest(wrapper) {
    var rush_type = "{{$purchase_request->rush_type}}";
    var author_name = "{{$purchase_request->author_name}}";
    var title = "{{$purchase_request->title}}";
    var edition = "{{$purchase_request->edition}}";
    var copies_vol = "{{$purchase_request->copies_vol}}";
    var publication_date = "{{$purchase_request->publication_date}}";
    var publisher_name = "{{$purchase_request->publisher_name}}";

    for (var i = 1; i < title.split(',').length; i++) {
        $(wrapper).append(`
        <div>
            <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Request Type') }}</h5>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                    value="0" name="rush_type[]" checked> Rush
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>

                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Author') }}
                                        </h5>
                                        <input type="text" name="author_name[]" id="author_name"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('Enter Author Name') }}" required autofocus value="`+author_name.split(',')[i]+`">
                                    </div>

                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Tile') }}
                                        </h5>
                                        <input type="text" name="title[]" id="title[]"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('Enter Book Title') }}" required autofocus value="`+title.split(',')[i]+`">
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4 col-xs-12">
                                            <h5 class="form-control-label" for="input-region-name">{{ __('Edition') }}
                                            </h5>
                                            <input type="text" name="edition[]" id="edition[]"
                                                class="form-control form-control-alternative"
                                                placeholder="{{ __('Enter Book Edition') }}" required autofocus value="`+edition.split(',')[i]+`">
                                        </div>

                                        <div class="form-group col-md-4 col-xs-12">
                                            <h5 class="form-control-label" for="input-region-name">{{ __('Copies/Volume') }}
                                            </h5>
                                            <input type="text" name="copies_vol[]" id="copies_vol[]"
                                                class="form-control form-control-alternative"
                                                placeholder="{{ __('Enter Book Copies/Volume') }}" required autofocus value="`+copies_vol.split(',')[i]+`">
                                        </div>

                                        <div class="form-group col-md-4 col-xs-12">
                                            <h5 class="form-control-label" for="input-region-name">
                                                {{ __('Publication Date') }}
                                            </h5>
                                            <input list="publication-date" name="publication_date[]" id="publication_date[]"
                                                class="form-control form-control-alternative"
                                                placeholder="{{ __('Enter Publication Date') }}" required autofocus value="`+publication_date.split(',')[i]+`">
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
                                        <input type="text" name="publisher_name[]" id="publisher_name[]"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('Enter Publisher Name') }}" required autofocus value="`+publisher_name.split(',')[i]+`">
                                    </div>
                                    @if ($purchase_request->status_id == 2)
                                        <div class="form-group">
                                            <h5 class="form-control-label" for="input-region-name">{{ __('Price') }}
                                            </h5>
                                            <input type="text" name="amount"
                                                class="form-control form-control-alternative book_price"
                                                placeholder="{{ __('Enter Book Price') }}" required autofocus>
                                        </div>
                                    @endif
                                    <!-- loop data approved by -->
                                    <div class="<?= $purchase_request->status_id == 2 ? 'd-none': '' ?> form-group">
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
                                    
            <div class="delete d-flex justify-content-center "><button type="button" class="d-none add_form_field-request-form btn btn-danger mt-4"><span style="font-size:16px; font-weight:bold;"><i class="fa fa-minus-circle" aria-hidden="true"></i></span> Remove Form Request</button></div><hr/>
            </div>`);
    }

    $('.book_price').keydown(function(e) {
        if (e.shiftKet)
            e.preventDefault();

        if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105) ||
            e.keyCode == 8 || e.keyCode == 9 || e.keyCode == 37 || e.keyCode == 39 || e.keyCode ==
            46 ||
            e.keyCode == 190) {

        } else
            e.preventDefault();

        if ($(this).val().indexOf('.') !== -1 && e.keyCode == 190)
            e.preventDefault();
    }).keyup(function(e) {
        if ($(this).val().charAt(0) == ".") {
            e.preventDefault();
            $(this).val(' ');
        }

        if ($(this).val().split('.').length > 1) {
            if ($(this).val().split('.')[1].length > 2) {
                e.preventDefault();
                $(this).val((Math.round($(this).val() * 100) / 100).toFixed(2));
            }
        }
    });
}

//drag and drop image
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#e_signature_img').attr('src', e.target.result);
            $('.btnApproved').removeAttr('disabled');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$(function() {
    $('.btnAttachedESign').click(function() {
        Swal.fire({
            // title: 'Error!',
            title: 'Enter your password',
            //html:`<input type="password" placeholder="Enter your password" id="password" class="swal2-input">`,
            icon: 'question',
            allowOutsideClick: false,
            confirmButtonText: 'Yes',
            showCancelButton: true,
            input: 'password',
            inputLabel: 'Password',
            inputPlaceholder: 'Enter your password',
            inputAttributes: {
                autocapitalize: 'off',
                autocorrect: 'off'
            },
            inputValidator: (value) => {
                if (!value) {
                    return 'You need to write something!'
                }
            }
        }).then((result) => {
            if (result.value) {
                if (result.value == $('#password').val()) {
                    Swal.fire({
                        title: 'Enter password correct',
                        icon: 'success',
                        allowOutsideClick: false,
                        confirmButtonText: 'Close',
                    }).then(() => {
                        // $('.attached_signature').removeClass('d-none');
                        $('.btnApproved').removeAttr('disabled');
                    });
                } else {
                    Swal.fire({
                        title: 'Enter password incorrect',
                        icon: 'error',
                        allowOutsideClick: false,
                        confirmButtonText: 'Close',
                    }).then(() => {
                        $('.attached_signature').addClass('d-none');
                    });
                }
            }
        });
    });


    $('h3.h3_title')[0].innerHTML = $('li.active')[0].innerHTML;
    $('h3.h3_title').find('a').css({
        'color': 'black',
        'cursor': 'default',
        'text-decoration': 'none',
    });

    checkboxCheckOnlyOneByGroup();

    //maximum of 10
    var max_fields = 10;
    var wrapper = $(".container-request-form");
    var add_button = $(".add_form_field-request-form");

    var x = 1;

    setTimeout(() => {
        retrieveRequest(wrapper);
    }, 250);


    $('.btnComputePrice').click(function(e) {
        var sum = 0;
        $.each($('input[name="amount"]'), function(indexInArray, valueOfElement) {
            sum += Number(valueOfElement.value);
        });

        $('#totalBookPrice').val(sum);
        sum = (Math.round($('#totalBookPrice').val() * 100) / 100).toFixed(2);
        $('#totalBookPrice').val("₱ " + (Math.round($('#totalBookPrice').val() * 100) / 100).toFixed(
        2));

        if (sum > $('#span_budget')[0].innerHTML)
            $('#modalBudgetNotEnough').modal('show');
        //$('#modalBudgetNotEnough').modal('show');
    });

    //
    $('#tblDepartmentBudget').DataTable({
        order: [[1, 'asc']],
    });


    // $('#tblDepartmentBudget').on('click', 'tbody tr', function () {
    //     var row = $('#tblDepartmentBudget').DataTable().row($(this)).data();
    //     console.log(row);   //full row of array data
    //     console.log(row[1]);   //EmployeeId
    // });
    $('#tblDepartmentBudget tbody').on('click', '#btnBorrowedAmount', function () {
        //console.log($('#tblDepartmentBudget').DataTable().row($(this).data()).data()[1]);   //full row of array data
        //console.log(row[1]);   //EmployeeId
    });
});
</script>
@endpush