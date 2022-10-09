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
                                <a href="{{ route('signature_attachment.index') }}" class="btn btn-sm btn-primary"
                                    id="add-region-btn">{{ __('Back to List') }}</a>
                                <div class="input-group-append icon">
                                    <a href="{{ route('signature_attachment.index') }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-plus-square"></i>
                                    </a>
                                </div>
                            </div>
                            @endcan
                        </div>
                    </div>

                    <div class="card-body">
                        @include('notification.index')
                        <form method="post" autocomplete="off" action="{{route('signature_attachment.store')}}">
                            @csrf
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('User Account') }}</h5>
                                    <select id="users_id" name="users_id" class="form-control" required>
                                        <option selected="selected" disabled>Select User Account</option>
                                        @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <input type="hidden" name="created_by_users_id" value="{{Auth::user()->id}}"
                                    class="form-control form-control-alternative">
                                <div class="form-group">
                                    <h5 class="form-control-label" for="input-region-name">{{ __('Password') }}</h5>
                                    <input type="text" name="password" class="form-control form-control-alternative"
                                        placeholder="{{ __('Enter Password') }}" value="" required autofocus minlength="6">
                                </div>
                            </div>
                            <div class="pl-lg-4">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                            </div>
                        </form>
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
$(document).ready(function() {

});
</script>
@endpush