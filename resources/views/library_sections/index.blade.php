@extends('layouts.app', [
'class' => '',
'elementActive' => 'library_sections'
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
                            @can('library_section-create')
                                <div class="col-4 text-right add-region-btn">
                                    <a href="{{ route('library_section.create') }}" class="btn btn-sm btn-primary"
                                        id="add-region-btn">{{ __('Add Library Section') }}</a>
                                    <div class="input-group-append icon">
                                        <a href="{{ route('library_section.create') }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-plus-square"></i>
                                        </a>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </div>

                    <div class="card-body">
                        @include('notification.index')
                        <table id="tblDataTable" class="table table-responsive-sm table-flush display"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th class="d-none">ID</th>
                                    <th>Library Section</th>
                                    <th>Section Code</th>
                                    <th>Created date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($library_section as $library_sections)
                                    <tr>
                                        <td class="d-none">{{$library_sections->id}}</td>
                                        <td>{{$library_sections->section_name}}</td>
                                        <td>{{$library_sections->section_code}}</td>
                                        <td>{{$library_sections->created_at}}</td>
                                        <td class="text-center">
                                        <a href="{{route('library_section.edit', $library_sections)}}" class="{{Auth::user()->can('library_section-edit') ? 'btn btn-info btn-sm' : 'btn btn-info btn-sm d-none'}}" ><i class="fa fa-pencil"></i></a>
                                        <button type="button" data-id="{{$library_sections->id}}" value="{{$library_sections->section_name}}" class="btnCanDestroy {{Auth::user()->can('library_section-delete') ? 'btn btn-danger btn-sm' : 'btn btn-danger btn-sm d-none'}} "><i class="fa fa-remove"></i></button>
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

@include('department_types.script')
@push('scripts')
<script>
    $(document).ready(function () {
        $('#tblDataTable').DataTable({
            order:[[1,'asc']]
        });
        $('.btnCanDestroy').click(function() {
            Swal.fire({
                // title: 'Error!',
                text: 'Do you want to remove ' + $(this).val() + ' section?',
                icon: 'question',
                allowOutsideClick:false,
                confirmButtonText: 'Yes',
                showCancelButton: true,
            }).then((result) => {
                if (result.value) {
                    window.location.href = base_url + "/library_sections/delete/" + $(this).data('id');
                    Swal.fire({
                        title: $(this).val() + ' Deleted Successfully',
                        icon: 'success',
                        allowOutsideClick:false,
                        confirmButtonText: 'Close',
                    }).then(()=>{
                        $('#tblDataTable').DataTable().ajax.reload();
                    });
                }
            });
        });
    });
</script>
@endpush