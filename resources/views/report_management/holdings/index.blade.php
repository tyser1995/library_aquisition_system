@extends('layouts.app', [
'class' => '',
'elementActive' => 'reports_holdings'
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
                                    <th>Created date</th>
                                    <!-- <th>Status</th>                                     -->
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
                                        <!-- <td>@if ($purchase_requests->status_id == 11)
                                            <span class="badge badge-info">
                                                <i class="fa fa-check-circle"></i> {{__('Acquired')}}
                                            </span>
                                            <span class="badge badge-info">
                                                <i class="fa fa-user-circle" data-toggle="tooltip" title="Approved by Custodian"></i>
                                            </span>
                                        @endif
                                         </td> -->
                                        <td class="text-center">
                                            <a href="{{route('acquisition_books/preview/{id}', ['id' => $purchase_requests->id])}}" class="{{Auth::user()->can('purchase_request-edit') ? 'btn btn-info btn-sm' : 'btn btn-info btn-sm d-none'}}" ><i class="fa fa-print"></i></a>
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
    $('h3.h3_title a').find('i').addClass('d-none');
    
    
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
                    window.location.href = base_url + "/acquisition_books/delete/" + $(this).data('id');
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