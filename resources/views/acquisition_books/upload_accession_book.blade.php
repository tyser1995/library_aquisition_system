@extends('layouts.app', [
'class' => '',
'elementActive' => 'acquisition_books'
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
                            @can('acquisition_books-create')
                            <div class="col-4 text-right add-region-btn">
                                <a href="{{ route('acquisition_book.index') }}" class="btn btn-sm btn-primary"
                                    id="add-region-btn">{{ __('Back to list') }}</a>
                                <div class="input-group-append icon">
                                    <a href="{{ route('acquisition_book.index') }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-plus-square"></i>
                                    </a>
                                </div>
                            </div>
                            @endcan
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="post" action="{{ route('acquisition_books/store_accession_books') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" class="form-control form-control-alternative"  accept=".xlsx, .csv, .xls" required>
                            <div class="">
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
});
</script>
@endpush