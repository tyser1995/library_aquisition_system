@extends('layouts.app', [
'class' => '',
'elementActive' => 'signature_attachments'
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
                            @can('signature-create')
                                <div class="col-4 text-right add-region-btn">
                                    <a href="{{ route('signature_attachment.create') }}" class="btn btn-sm btn-primary"
                                        id="add-region-btn">{{ __('Add Signature') }}</a>
                                    <div class="input-group-append icon">
                                        <a href="{{ route('signature_attachment.create') }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-plus-square"></i>
                                        </a>
                                    </div>
                                </div>
                            @endcan                            
                        </div>
                    </div>

                    <div class="card-body">
                        @include('notification.index')
                        <table id="tblSignature" class="table table-responsive-sm table-flush display"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th class="d-none">ID</th>
                                    <th>Name</th>
                                    <th>Password</th>
                                    <th>Created date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($signature as $signatures)
                                    <tr>
                                        <td class="d-none">{{$signatures->id}}</td>
                                        <td>{{$signatures->name}}</td>
                                        <td>
                                            <span id="show_password_{{$signatures->id}}" class="d-none">
                                                {{$signatures->password}}
                                            </span>
                                            <span id="hide_password_{{$signatures->id}}" class="font-weight-bold">
                                                {{__('*****')}}
                                            </span>
                                            <a data-name="{{$signatures->name}}" data-id="{{$signatures->id}}" class="active show_hide_password_{{$signatures->id}}" id="show_hide_password" href="javascript:void(0)" data-toggle="tooltip" title="Show Password">
                                                <i class="icon_{{$signatures->id}} fa fa-eye"></i>
                                            </a>
                                        </td>
                                        <td>{{$signatures->created_at}}</td>
                                        <td class="text-center">
                                            <a href="{{route('signature_attachment.edit', $signatures)}}" class="{{Auth::user()->can('signature-edit') ? 'btn btn-info btn-sm' : 'btn btn-info btn-sm d-none'}}" ><i class="fa fa-pencil"></i></a>
                                            <!-- <button type="button" data-id="{{$signatures->id}}" value="{{$signatures->name}}" class="btnCanDestroy {{Auth::user()->can('signature-delete') ? 'btn btn-danger btn-sm' : 'btn btn-danger btn-sm d-none'}} "><i class="fa fa-remove"></i></button> -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- <div id="app">
                            <department-name-component route="{{ route('department_name.index') }}"></department-name-component>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('signature_attachment.script')
@push('scripts')
<script>
    $(document).ready(function () {
        $('#tblSignature').DataTable({
            order:[[1,'asc']]
        });
        $('#tblSignature tbody').on('click','#show_hide_password',function(){
            if($('.show_hide_password_'+$(this).data('id')).hasClass('active')){
                $('.show_hide_password_'+$(this).data('id')).removeClass('active');
                $('.show_hide_password_'+$(this).data('id')).removeAttr('title');
                $('.show_hide_password_'+$(this).data('id')).attr('title','Hide Password');
                $('.icon_'+$(this).data('id')).removeClass('fa-eye').addClass('fa-eye-slash');
                $('#show_password_'+$(this).data('id')).removeClass('d-none');
                $('#hide_password_'+$(this).data('id')).addClass('d-none');
            }else{
                $('.show_hide_password_'+$(this).data('id')).addClass('active');
                $('.show_hide_password_'+$(this).data('id')).removeAttr('title');
                $('.show_hide_password_'+$(this).data('id')).attr('title','Show Password');
                $('.icon_'+$(this).data('id')).addClass('fa-eye').removeClass('fa-eye-slash');
                $('#hide_password_'+$(this).data('id')).removeClass('d-none');
                $('#show_password_'+$(this).data('id')).addClass('d-none');
            }
        });
    });
</script>
@endpush