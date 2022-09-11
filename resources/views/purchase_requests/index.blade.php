@extends('layouts.app', [
'class' => '',
'elementActive' => 'purchase_requests'
])

@section('content')
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
                            @can('purchase_request-create')
                            <div class="col-4 text-right add-region-btn">
                                <a href="{{ route('purchase_request.create') }}" class="btn btn-sm btn-primary"
                                    id="add-region-btn">{{ __('Add Purchase Request') }}</a>
                                <div class="input-group-append icon">
                                    <a href="{{ route('purchase_request.create') }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-plus-square"></i>
                                    </a>
                                </div>
                            </div>
                            @endcan
                        </div>
                    </div>

                    <div class="card-body">
                        @include('notification.index')
                        <table id="tblPurchaseRequest" class="table table-responsive-sm table-striped table-bordered"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Requested by</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Edition</th>
                                    <th>Created date</th>
                                    @if (Auth::user()->can('purchase_request-list'))
                                        @if (Auth::user()->can('purchase_request-edit') && Auth::user()->can('purchase_request-delete'))
                                            <th class="text-center">Action</th>
                                        @elseif(Auth::user()->can('purchase_request-edit'))
                                            <th class="text-center">Action</th>
                                        @elseif(Auth::user()->can('purchase_request-delete'))
                                            <th class="text-center">Action</th>
                                        @else
                                            
                                        @endif
                                    @endif
                                </tr>
                            </thead>
                        </table>
                        <!-- <div id="app">
                            <purchase-request-component route="{{ route('purchase_request.index') }}"></purchase-request-component>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@if (Auth::user()->can('purchase_request-list'))
    @if (Auth::user()->can('purchase_request-edit') && Auth::user()->can('purchase_request-delete'))
        @include('purchase_requests.table_view')
    @elseif(Auth::user()->can('purchase_request-edit'))
        @include('purchase_requests.table_edit')
    @elseif(Auth::user()->can('purchase_request-delete'))
        @include('purchase_requests.table_delete') 
    @else
        @include('purchase_requests.table_list')   
    @endif
@endif

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