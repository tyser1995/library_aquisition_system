<script>
$(document).ready(function() {


    //maximum of 10
    var max_fields = 10;
    var wrapper = $(".container-request-form");
    var add_button = $(".add_form_field-request-form");

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append(`<div>
            <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Request Type') }}</h5>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                    value="0" name="rush_type[]"> Rush
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                                    value="1" name="rush_type[]"> Not Rush
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
                                            <input type="text" name="edition[]" id="edition[]"
                                                class="form-control form-control-alternative"
                                                placeholder="{{ __('Enter Book Edition') }}" required autofocus>
                                        </div>

                                        <div class="form-group col-md-4 col-xs-12">
                                            <h5 class="form-control-label" for="input-region-name">{{ __('Copies/Volume') }}
                                            </h5>
                                            <input type="text" name="copies_vol[]" id="copies_vol[]"
                                                class="form-control form-control-alternative"
                                                placeholder="{{ __('Enter Book Copies/Volume') }}" required autofocus>
                                        </div>

                                        <div class="form-group col-md-4 col-xs-12">
                                            <h5 class="form-control-label" for="input-region-name">
                                                {{ __('Publication Date') }}
                                            </h5>
                                            <input list="publication-date" name="publication_date[]" id="publication_date[]"
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
                                        <input type="text" name="publisher_name[]" id="publisher_name[]"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('Enter Publisher Name') }}" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Publisher Address') }}
                                        </h5>
                                        <input type="text" name="publisher_address[]" id="publisher_address[]"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('Enter Publisher Address') }}" required autofocus>
                                    </div>

                                    <!-- loop data recommeded by -->
                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Recommended By') }}
                                        </h5>
                                        <div class="form-row">
                                            @foreach ($purchase_request_recommended_users as $purchase_request_recommended_user)
                                                <div class="form-group col-xs-12 col-md-3">
                                                    <div class="recommended_by_checkbox form-check form-check-inline">
                                                        <label class="form-check-label">
                                                        @if ($role_name == $purchase_request_recommended_user->recommended_user)
                                                            <input class="form-check-input" type="checkbox" id="{{$purchase_request_recommended_user->id}}" value="{{$purchase_request_recommended_user->id}}" name="recommended_user_id[]" checked> 
                                                        @else
                                                            <input class="form-check-input" type="checkbox" id="{{$purchase_request_recommended_user->id}}" value="{{$purchase_request_recommended_user->id}}" name="recommended_user_id[]" > 
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
                                    <div class="form-group">
                                        <h5 class="form-control-label" for="input-region-name">{{ __('Approved By') }}</h5>
                                        <div class="form-row">
                                            @foreach ($purchase_request_approver_users as $purchase_request_approver_user)
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
                                                class="charge_to form-control form-control-alternative"
                                                placeholder="{{ __('Enter Charge To') }}" required autofocus value="<?= !empty($department_name) ? $department_name->department_name : '' ?>">
                                            
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
                                                class="form-control form-control-alternative"
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
                                    
            <div class="delete d-flex justify-content-center"><button type="button" class="add_form_field-request-form btn btn-danger mt-4"><span style="font-size:16px; font-weight:bold;"><i class="fa fa-minus-circle" aria-hidden="true"></i></span> Remove Form Request</button></div><hr/>
            </div>`);
            //add input box

            if (x == 10)
                add_button.css('display', 'none');
        } else {
            add_button.css('display', 'none');
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;

        if (x < 10)
            add_button.css('display', 'block');
    });
});
</script>