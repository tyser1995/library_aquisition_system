@extends('layouts.app', [
'class' => '',
'elementActive' => 'safari_portal'
])

@section('content')

<div class="content">
    <div class="container-fluid mt--7">
        <div class="row" style="height:80vh; overflow-y:auto">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h3 class="mb-0">{{ __('Safari Portal') }}</h3>
                            </div>
                            <div class="col-6 text-right add-contact-btn">
                                <a href="{{route('safari_portal_itineraries.index')}}" class="btn btn-sm btn-primary" id="add-contact-btn">{{ __('Back to List') }}</a>
                                <div class="input-group-append icon">
                                    <a href="{{route('safari_portal_itineraries.index')}}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-plus-square">
                                        </i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                    </div>
                    <div class="col-12">
                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="APP_URL" value="{{ env('APP_URL') }}">
                        <div class="row">
                            @foreach ($data as $key_main => $value_main)
                                <span>{{$value_main['prepared_for']}}</span>
                                @foreach ($pages as $key_pages => $value_pages)
                                <div class="col-6">
                                    <img src="{{ $value_pages['primary_image_version_800'] }}"
                                        alt="{{ $value_pages['primary_image_version_800'] }}" width="100%">
                                </div>
                                <div class="col-6">
                                    @foreach ($value_pages['blocks'] as $key_blocks => $value_blocks)
                                            @foreach ($value_blocks['data'] as $key_data => $value_data)
                                                <!-- <span>pages id: {{ $value_pages['id'] . ' ' . $value_pages['title']}}</span><br />
                                                <span>blocks id: {{ $value_blocks['id'] . ' ' . $value_blocks['type'] }}</span><br /> -->
                                                <!-- <span>data: {{ html_entity_decode(json_encode($value_data)) }}</span><br/> -->
                                                <?php 
                                                    $result = is_array($value_data);
                                                    if ($result) { 
                                                            ?>
                                                        <!-- <label>{{html_entity_decode(json_encode($value_blocks))}}</label><br /> -->
                                                <!-- <h3> {{ html_entity_decode(json_encode($value_data)) }} </h3> -->
                                                <?php foreach ($value_blocks as $key_data_blocks => $value_data_blocks) { ?>
                                                    <span data-toggle="popover" title="Test" data-content="{{html_entity_decode(json_encode($value_data_blocks))}}" id="test">{{ html_entity_decode(json_encode($value_data_blocks)) }}</span>
                                                    <!-- <span>{{ html_entity_decode(json_encode($value_data_blocks)) }}</span> -->
                                                    <br />
                                                <?php } ?>

                                                <br />
                                                <?php } else { 
                                                                    //$regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
                                                                    $url = $value_data;
                                                                    if(filter_var($url, FILTER_VALIDATE_URL)) {
                                                                        //echo '<a href="'.$url.'" target="_blank">'.str_replace('watch?v=','embed/',$url).'</a>'; 
                                                                        echo '<iframe width="100%" height="420" src="'.str_replace('watch?v=','embed/',$url).'" frameborder="0" allowfullscreen></iframe>';
                                                                        ?>
                                                <?php } else{ ?>
                                                <h3> {{ json_decode(json_encode($value_data),true) }}</h3><br />
                                                <?php } } ?>
                                    
                                            @endforeach
                                        @endforeach
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
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
    $('.footer').css('padding', '0');
});
</script>
@endpush