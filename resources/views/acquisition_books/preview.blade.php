@extends('layouts.app', [
'class' => '',
'elementActive' => 'acquisition_books'
])

@section('content')
<style>
.card-padding {
    padding: 5% 0;
}

.header_title {
    font-size: 20px;
    text-transform: uppercase;
    font-weight: 700;
    font-family: serif;
    letter-spacing: 0;
    line-height: 1;
}
</style>
<div class="content">
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0 h3_title"></h3>
                            </div>
                            <div class="col-4 text-right add-region-btn">
                                <button id="btnPrint" class="btn btn-info  btn-sm">Print
                                    <span><i class="fa fa-print"></i></span>
                                </button>
                                <a href="{{ route('acquisition_books') }}" class="btn btn-sm btn-primary"
                                    id="add-region-btn">{{ __('Back to list') }}</a>
                                <div class="input-group-append icon">
                                    <a href="{{ route('acquisition_books') }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-plus-square"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="print_request" class="row">
            <div class="col">
                <div class="container-request-form">
                    <div class="card card-padding">
                        <div style="display: flex;justify-content: space-around;align-items: center;">
                            <div>
                                <img src="{{ asset('paper') }}/img/cpu-logo.png" width="100" />
                            </div>
                            <div class="header_title" style="display:grid;text-align:center">
                                <span>
                                    Central Philippine University
                                </span>
                                <span>
                                    University Libraries
                                </span>
                                <span>
                                    Iloilo City, Philippines
                                </span>
                                <br>
                                <span>
                                    Library Purchase Request Form
                                </span>
                            </div>
                            <div>
                                <img src="{{ asset('paper') }}/img/cpu-logo.png" width="100" />
                            </div>
                        </div>
                        <!-- details -->
                        <div class="row" style="margin: 30px 20px">
                            <!-- @foreach ($purchase_request as $purchase_requests)
                            @endforeach -->
                            <div class="col-2">
                                <p>Dealer:</p>
                                <p>Price:</p>
                                <p>SI #:</p>
                                <p>Dated:</p>
                            </div>
                            <div class="col-10">
                                <p id="author_name"><b>Author:</b>
                                    {{old('author_name',explode(',',$purchase_requests->author_name)[0])}}
                                </p>
                                <p id="title"><b>Title:</b> {{old('title',explode(',',$purchase_requests->title)[0])}}
                                </p>
                                <table class="table table-borderless">
                                    <tr>
                                        <td style="padding:0">
                                            <span id="edition"><b>Edition:</b>
                                                {{old('edition',explode(',',$purchase_requests->edition)[0])}}
                                            </span>
                                        </td>
                                        <td style="padding:0">
                                            <span id="copies_vol"><b>Copies/Volume:</b>
                                                {{old('copies_vol',explode(',',$purchase_requests->copies_vol)[0])}}
                                            </span>
                                        </td>
                                        <td style="padding:0">
                                            <span id="publication_date"><b>Publication Date:</b>
                                                {{old('publication_date',explode(',',$purchase_requests->publication_date)[0])}}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                                <p id="publisher_name"><b>Publiser:</b>
                                    {{old('publisher_name',explode(',',$purchase_requests->publisher_name)[0])}}
                                </p>
                                <p id="publisher_address"><b>Publiser Address:</b>
                                    {{old('publisher_address',explode(',',$purchase_requests->publisher_address)[0])}}
                                </p>
                                <p id="charge_to"><b>Charge To:</b>
                                    {{old('charge_to',explode(',',$purchase_requests->charge_to)[0])}}
                                </p>
                                <p class="form-control-label font-weight-bold" for="input-region-name">
                                        {{ __('Recommended By') }}
                                    </p>
                                <table class="table table-borderless">
                                    <tr>
                                        <td style="padding:0">
                                            <span><i class="fa fa-square"></i>  {{__('Faculty')}}</span>
                                        </td>
                                        <td style="padding:0">
                                            <span><i class="fa fa-square"></i>  {{__('Librarian')}}</span>
                                        </td>
                                        <td style="padding:0">
                                            <span><i class="fa fa-square"></i>  {{__('Administrator')}}</span>
                                        </td>
                                        <td style="padding:0">
                                            <span><i class="fa fa-square"></i>  {{__('Staff')}}</span>
                                        </td>
                                    </tr>
                                </table>
                                <p class="form-control-label font-weight-bold" for="input-region-name">
                                        {{ __('Approved By') }}
                                    </p>
                                <table class="table table-borderless">
                                    <tr>
                                        <td style="padding:0">
                                            <span><i class="fa fa-square"></i>  {{__('Dean')}}</span>
                                        </td>
                                        <td style="padding:0">
                                            <span><i class="fa fa-square"></i>  {{__('Director of Libraries')}}</span>
                                        </td>
                                        <td style="padding:0">
                                            <span><i class="fa fa-square"></i>  {{__('Principal')}}</span>
                                        </td>
                                        <td style="padding:0">
                                            <span></span>
                                        </td>
                                    </tr>
                                </table>
                                <table class="table table-borderless">
                                    <tr>
                                        <td style="padding:0">
                                            <p id="subject"><b>Subject:</b>
                                                {{old('subject',explode(',',$purchase_requests->subject)[0])}}
                                            </p>
                                        </td>
                                        <td style="padding:0">
                                            <p id="existing_no_of_titles"><b>Existing No. of Titles:</b>
                                                {{old('existing_no_of_titles',explode(',',$purchase_requests->existing_no_of_titles)[0])}}
                                            </p>
                                        </td>
                                    </tr>
                                </table>

                                <p id="note"><b>Note:</b>
                                    {{old('note',explode(',',$purchase_requests->note)[0])}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="1px dashed white">
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
$(function() {
    $('#btnPrint').click(function(e) {
        e.preventDefault();
        $("#print_request").printThis({
            importCSS: true,            // import parent page css
            importStyle: true,         // import style tags
            printContainer: true, // print outer container/$.selector 
            pageTitle:"Library Purchase Request Form",
            canvas: true,           
        });
    });
    $('h3.h3_title')[0].innerHTML = $('li.active')[0].innerHTML;
    $('h3.h3_title').find('a').css({
        'color': 'black',
        'cursor': 'default',
        'text-decoration': 'none',
    });
    // var max_fields = 10;
    var wrapper = $(".container-request-form");
    // var add_button = $(".add_form_field-request-form");

    var rush_type = "{{$purchase_requests->rush_type}}";
    var author_name = "{{$purchase_requests->author_name ? $purchase_requests->author_name : $purchase_requests->author}}";
    var title = "{{$purchase_requests->title}}";
    var edition = "{{$purchase_requests->edition}}";
    var copies_vol = "{{$purchase_requests->copies_vol}}";
    var publisher_name = "{{$purchase_requests->publisher_name}}";
    var publication_date = "{{$purchase_requests->publication_date}}";
    var publisher_address = "{{$purchase_requests->publisher_address}}";
    var charge_to = "{{$purchase_requests->charge_to}}";
    var subject = "{{$purchase_requests->subject}}";
    var existing_no_of_titles = "{{$purchase_requests->existing_no_of_titles}}";
    var note = "{{$purchase_requests->note}}";
    //console.log(title);
    for (var i = 1; i < publication_date.split(',').length; i++) {
        $(wrapper).append(`<div>
            <div class="card card-padding">
                        <div style="display: flex;justify-content: space-around;align-items: center;">
                            <div>
                                <img src="{{ asset('paper') }}/img/cpu-logo.png" width="100" />
                            </div>
                            <div class="header_title" style="display:grid;text-align:center">
                                <span>
                                    Central Philippine University
                                </span>
                                <span>
                                    University Libraries
                                </span>
                                <span>
                                    Iloilo City, Philippines
                                </span>
                                <br>
                                <span>
                                    Library Purchase Request Form
                                </span>
                            </div>
                            <div>
                                <img src="{{ asset('paper') }}/img/cpu-logo.png" width="100" />
                            </div>
                        </div>
                        <!-- details -->
                        <div class="row" style="margin: 30px 20px">
                        <div class="col-2">
                                <p>Dealer:</p>
                                <p>Price:</p>
                                <p>SI #:</p>
                                <p>Dated:</p>
                            </div>
                            <div class="col-10">
                                <p id="author_name"><b>Author:</b> ` + author_name.split(',')[i] + `
                                </p>
                                <p id="title"><b>Title:</b> ` + title.split(',')[i] + `</p>
                                <table class="table table-borderless">
                                    <tr>
                                        <td style="padding:0">
                                            <span id="edition"><b>Edition:</b> ` + edition.split(',')[i] + `
                                            </span>
                                        </td>
                                        <td style="padding:0">
                                            <span id="copies_vol"><b>Copies/Volume:</b> 
                                            ` + copies_vol.split(',')[i] + `
                                            </span>
                                        </td>
                                        <td style="padding:0">
                                            <span id="publication_date"><b>Publication Date:</b> 
                                            ` + publication_date.split(',')[i] + `
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                                <p id="publisher_name"><b>Publiser:</b> 
                                ` + publisher_name.split(',')[i] + `
                                </p>
                                <p id="publisher_address"><b>Publiser Address:</b> 
                                ` + publisher_address.split(',')[i] + `
                                </p>
                                <p id="charge_to"><b>Charge To:</b> 
                                ` + charge_to.split(',')[i] + `
                                </p>
                                <p class="form-control-label font-weight-bold" for="input-region-name">
                                        {{ __('Recommended By') }}
                                    </p>
                                <table class="table table-borderless">
                                    <tr>
                                        <td style="padding:0">
                                            <span><i class="fa fa-square"></i>  {{__('Faculty')}}</span>
                                        </td>
                                        <td style="padding:0">
                                            <span><i class="fa fa-square"></i>  {{__('Librarian')}}</span>
                                        </td>
                                        <td style="padding:0">
                                            <span><i class="fa fa-square"></i>  {{__('Administrator')}}</span>
                                        </td>
                                        <td style="padding:0">
                                            <span><i class="fa fa-square"></i>  {{__('Staff')}}</span>
                                        </td>
                                    </tr>
                                </table>
                                <p class="form-control-label font-weight-bold" for="input-region-name">
                                        {{ __('Approved By') }}
                                    </p>
                                <table class="table table-borderless">
                                    <tr>
                                        <td style="padding:0">
                                            <span><i class="fa fa-square"></i>  {{__('Dean')}}</span>
                                        </td>
                                        <td style="padding:0">
                                            <span><i class="fa fa-square"></i>  {{__('Director of Libraries')}}</span>
                                        </td>
                                        <td style="padding:0">
                                            <span><i class="fa fa-square"></i>  {{__('Principal')}}</span>
                                        </td>
                                        <td style="padding:0">
                                            <span></span>
                                        </td>
                                    </tr>
                                </table>
                                <table class="table table-borderless">
                                    <tr>
                                        <td style="padding:0">
                                            <p id="subject"><b>Subject:</b> 
                                            ` + subject.split(',')[i] + `
                                            </p>
                                        </td>
                                        <td style="padding:0">
                                            <p id="existing_no_of_titles"><b>Existing No. of Titles:</b> 
                                            ` + existing_no_of_titles.split(',')[i] + `
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                               
                                <p id="note"><b>Note:</b> 
                                ` + note.split(',')[i] + `
                                </p>
                            </div>
                        </div>
                    </div>
        </div>`);
    }
});
</script>
@endpush