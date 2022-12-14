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
                        <table id="tblPurchaseRequest"class="table table-responsive-sm table-flush display"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th class="d-none">ID</th>
                                    <th>Requested by</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Edition</th>
                                    <th>Date Requested</th>
                                    <th>Status</th>                                    
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchase_request as $purchase_requests)
                                    <tr>
                                        <td class="d-none">{{$purchase_requests->id}}</td>
                                        <td>{{$purchase_requests->name}}</td>
                                        <td>{{ $purchase_requests->title }}
                                        </td>
                                        <td>{{$purchase_requests->author_name}}</td>
                                        <td>{{$purchase_requests->edition}}</td>                                       
                                        <td>{{$purchase_requests->created_at}}</td>
                                        <td>@if ($purchase_requests->status_id == 0)
                                            <span class="badge badge-warning">
                                                    <i class="fa fa-signature"></i> {{__('Waiting for Approval')}}
                                                </span>
                                        @elseif ($purchase_requests->status_id == 1)
                                            <span class="badge badge-info">
                                                <i class="fa fa-check-circle"></i> {{__('Approved')}}
                                            </span>
                                            <span class="badge badge-info">
                                                <i class="fa fa-user-circle" data-toggle="tooltip" title="Dean"></i>
                                            </span>
                                        @elseif ($purchase_requests->status_id == 2)
                                            <span class="badge badge-info">
                                                <i class="fa fa-check-circle"></i> {{__('Approved')}}
                                            </span>
                                            <span class="badge badge-info">
                                                <i class="fa fa-user-circle" data-toggle="tooltip" title="Dean"></i>
                                            </span>
                                            <span class="badge badge-info">
                                                <i class="fa fa-user-circle" data-toggle="tooltip" title="VPAA"></i>
                                            </span>
                                        @elseif ($purchase_requests->status_id == 3)
                                            <span class="badge badge-info">
                                                <i class="fa fa-check-circle"></i> {{__('Approved')}}
                                            </span>
                                            <span class="badge badge-info">
                                                <i class="fa fa-user-circle" data-toggle="tooltip" title="Dean"></i>
                                            </span>
                                            <span class="badge badge-info">
                                                <i class="fa fa-user-circle" data-toggle="tooltip" title="VPAA"></i>
                                            </span>
                                            <span class="badge badge-info">
                                                <i class="fa fa-user-circle" data-toggle="tooltip" title="Library Aquisition"></i>
                                            </span>
                                        @elseif ($purchase_requests->status_id == 4)
                                            <span class="badge badge-info">
                                                <i class="fa fa-check-circle"></i> {{__('Approved')}}
                                            </span>
                                            <span class="badge badge-info">
                                                <i class="fa fa-user-circle" data-toggle="tooltip" title="Dean"></i>
                                            </span>
                                            <span class="badge badge-info">
                                                <i class="fa fa-user-circle" data-toggle="tooltip" title="VPAA"></i>
                                            </span>
                                            <span class="badge badge-info">
                                                <i class="fa fa-user-circle" data-toggle="tooltip" title="Library Aquisition"></i>
                                            </span>
                                        @elseif ($purchase_requests->status_id == 5)
                                            <span class="badge badge-info">
                                                <i class="fa fa-check-circle"></i> {{__('Approved')}}
                                            </span>
                                            <span class="badge badge-info">
                                                <i class="fa fa-user-circle" data-toggle="tooltip" title="Dean"></i>
                                            </span>
                                            <span class="badge badge-info">
                                                <i class="fa fa-user-circle" data-toggle="tooltip" title="VPAA"></i>
                                            </span>
                                            <span class="badge badge-info">
                                                <i class="fa fa-user-circle" data-toggle="tooltip" title="Library Aquisition"></i>
                                            </span>
                                            <span class="badge badge-info">
                                                <i class="fa fa-user-circle" data-toggle="tooltip" title="VPFA"></i>
                                            </span>
                                        @elseif ($purchase_requests->status_id == 6)
                                            <span class="badge badge-info">
                                                <i class="fa fa-check-circle"></i> {{__('Signatories')}}
                                            </span>
                                           
                                        @elseif ($purchase_requests->status_id == 7)
                                            <span class="badge badge-info">
                                                <i class="fa fa-check-circle"></i> {{__('Signatories')}}
                                            </span>
                                            <span class="badge badge-info">
                                                <i class="fa fa-user-circle" data-toggle="tooltip" title="Library Aquisition"></i>
                                            </span>
                                        @elseif ($purchase_requests->status_id == 8)
                                            <span class="badge badge-info">
                                                <i class="fa fa-check-circle"></i> {{__('Signatories')}}
                                            </span>
                                            <span class="badge badge-info">
                                                <i class="fa fa-user-circle" data-toggle="tooltip" title="Library Aquisition"></i>
                                            </span>
                                            <span class="badge badge-info">
                                                <i class="fa fa-user-circle" data-toggle="tooltip" title="Director of Libraries"></i>
                                            </span>
                                        @elseif ($purchase_requests->status_id == 9)
                                            <span class="badge badge-info">
                                                <i class="fa fa-check-circle"></i> {{__('Signatories')}}
                                            </span>
                                            <span class="badge badge-info">
                                                <i class="fa fa-user-circle" data-toggle="tooltip" title="Library Aquisition"></i>
                                            </span>
                                            <span class="badge badge-info">
                                                <i class="fa fa-user-circle" data-toggle="tooltip" title="Director of Libraries"></i>
                                            </span>
                                            <span class="badge badge-info ">
                                                <i class="fa fa-user-circle" data-toggle="tooltip" title="VPAA"></i>
                                            </span>
                                        @endif
                                         </td>
                                        <td class="text-center">
                                            @if ($purchase_requests->status_id == 0)
                                                @can('signature-create')
                                                    <a href="{{route('purchase_requests/requested_books/{id}', ['id' => $purchase_requests->id])}}" class="{{Auth::user()->can('purchase_request-edit') ? 'btn btn-info btn-sm' : 'btn btn-info btn-sm d-none'}}" ><i class="fa fa-check-circle"></i></a>
                                                @endcan                                               
                                                <a href="{{route('purchase_request.edit', $purchase_requests->id)}}" class="{{Auth::user()->can('purchase_request-edit') ? 'btn btn-info btn-sm' : 'btn btn-info btn-sm d-none'}}" ><i class="fa fa-pencil"></i></a>
                                                <button type="button" data-id="{{$purchase_requests->id}}" value="{{$purchase_requests->title}}" class="btnCanDestroy {{Auth::user()->can('purchase_request-delete') ? 'btn btn-danger btn-sm' : 'btn btn-danger btn-sm d-none'}} "><i class="fa fa-remove"></i></button>
                                            @elseif ($purchase_requests->status_id >= 1)
                                                <!-- to approved by vpaa -->
                                                <a href="{{route('purchase_requests/requested_books/{id}', ['id' => $purchase_requests->id])}}" class="{{Auth::user()->can('purchase_request-edit') ? 'btn btn-info btn-sm' : 'btn btn-info btn-sm d-none'}}" ><i class="fa fa-check-circle"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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

    $('#tblPurchaseRequest').DataTable({
        order:[[2,'asc']]
    });

    $('.btnCanDestroy').click(function() {
            Swal.fire({
                // title: 'Error!',
                text: 'Do you want to remove ' + $(this).val() + ' book title?',
                icon: 'question',
                allowOutsideClick:false,
                confirmButtonText: 'Yes',
                showCancelButton: true,
            }).then((result) => {
                if (result.value) {
                    window.location.href = base_url + "/purchase_requests/delete/" + $(this).data('id');
                    Swal.fire({
                        title: $(this).val() + ' Deleted Successfully',
                        icon: 'success',
                        allowOutsideClick:false,
                        confirmButtonText: 'Close',
                    }).then(()=>{
                        $('#tblPurchaseRequest').DataTable().ajax.reload();
                    });
                }
            });
        });
});
</script>
@endpush