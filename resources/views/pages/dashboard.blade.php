@extends('layouts.app', [
'class' => '',
'elementActive' => 'dashboard'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">

            <!-- <div class="card ">
                <div class="card-header ">
                    <h5 class="card-title">Welcome to Library Aquisition</h5>
                </div>
            </div> -->

            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats ">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning pull-left">
                                        <i class="fa-solid fa-people-line text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Users</p>
                                        <p class="card-title">2</p>
                                        <p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <a href="{{route('users')}}" class="stretched-link"></a>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats text-right">
                            <small> Updated since 2</Updated></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning pull-left">
                                        <i class="fa-solid fa-file-lines text-success"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Documents</p>
                                        <p class="card-title">2</p>

                                    </div>
                                </div>
                            </div>
                            <a href="#!" class="stretched-link"></a>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats text-right">
                            <small>Updated since 5</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning pull-left">
                                        <i class="fa-solid fa-panorama text-danger"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Media</p>
                                        <p class="card-title">10</p>
                                        <p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <a href="#!" class="stretched-link"></a>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats text-right">
                            <small>Updated since 15</small>
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
        $(document).ready(function() {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            //demo.initChartsPages();
        });
    </script>
    @endpush
