@extends('layouts.app', [
'class' => '',
'elementActive' => 'dashboard'
])

@section('content')
<div class="content">
    <!-- User Management -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h4>{{__('User Management')}}</h4>
            <div class="card card-stats"></div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-single-02 text-success"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">User</p>
                                <p class="card-title">
                                    <?php 
                                            $count = \App\Models\User::all();
                                            echo count($count);
                                        ?>
                                <p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <?php 
                                $count = \App\Models\User::get()->last();
                            ?>
                        @if (!empty($count))
                        <i class="fa fa-refresh"></i> Update Since {{$count->created_at->diffForHumans()}}
                        @else
                        {{__('No Records found')}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-badge text-success"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Employee</p>
                                <p class="card-title">
                                    <?php 
                                            $count = \App\Models\Employee::all();
                                            echo count($count);
                                        ?>
                                <p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <?php 
                                $count = \App\Models\Employee::get()->last();
                            ?>
                        @if (!empty($count))
                        <i class="fa fa-refresh"></i> Update Since {{$count->created_at->diffForHumans()}}
                        @else
                        {{__('No Records found')}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 d-none">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-favourite-28 text-primary"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Followers</p>
                                <p class="card-title">+45K
                                <p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-refresh"></i> Update now
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Request Management -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h4>{{__('Request Management')}}</h4>
            <div class="card card-stats"></div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-single-copy-04 text-warning"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">New Request</p>
                                <p class="card-title">
                                    @if (Auth::user()->role ==  9)
                                        <?php 
                                            $dean = \App\Models\User::join('roles','roles.id','=','users.role')
                                            ->select('roles.name')
                                            ->where('users.id','=',Auth::user()->id)
                                            ->get()
                                            ->first();

                                            $department_id = \App\Models\Employee::where('users_id','=',Auth::user()->id)
                                            ->get()
                                            ->first();

                                            if(!empty($department_id)){
                                                if(strtoupper($dean->name) =="DEAN"){
                                                    $count = DB::table('purchase_requests')
                                                    ->join('users','users.id','=','purchase_requests.created_by_users_id')
                                                    ->join('employees','employees.users_id','=','users.id')
                                                    ->where('employees.department_names_id','=',$department_id->department_names_id)
                                                    ->where('purchase_requests.deleted_flag','=',0)
                                                    ->where('purchase_requests.status_id','=',0)
                                                    ->select('purchase_requests.*','users.name')
                                                    ->get();
    
                                                    echo count($count);
                                                }else{
                                                    $count = \App\Models\PurchaseRequest::where('created_by_users_id','=',Auth::user()->id)->get();
                                                    echo count($count);
                                                }
                                            }
                                            
                                        ?>
                                    @else
                                        <?php 
                                            // $count = \App\Models\PurchaseRequest::all();
                                            // echo count($count);
                                        ?>

                                        <!-- Acquisition -->
                                        @if (Auth::user()->role == 3)
                                            <?php 
                                                $count = DB::table('purchase_requests')
                                                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                                                ->select('purchase_requests.*','users.name')
                                                ->where('purchase_requests.deleted_flag','=',0)
                                                ->where('purchase_requests.status_id','=',2)
                                                ->get();

                                                echo count($count);
                                            ?>
                                        @endif
                                        <!-- PRESIDENT 4 -->
                                        @if (Auth::user()->role == 4)
                                            <?php 
                                                $count = DB::table('purchase_requests')
                                                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                                                ->select('purchase_requests.*','users.name')
                                                ->where('purchase_requests.deleted_flag','=',0)
                                                ->where('purchase_requests.status_id','=',5)
                                                ->where('purchase_requests.amount','>',50000)
                                                ->get();

                                                echo count($count);
                                            ?>
                                        @endif
                                        <!-- VPAA 5 -->
                                        @if (Auth::user()->role == 5)
                                            <?php 
                                                $count = DB::table('purchase_requests')
                                                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                                                ->select('purchase_requests.*','users.name')
                                                ->where('purchase_requests.deleted_flag','=',0)
                                                ->where('purchase_requests.status_id','=',1)
                                                ->get();

                                                echo count($count);
                                            ?>
                                        @endif
                                        <!-- VPFA 6 -->
                                        @if (Auth::user()->role == 6)
                                            <?php 
                                                $count = DB::table('purchase_requests')
                                                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                                                ->select('purchase_requests.*','users.name')
                                                ->where('purchase_requests.deleted_flag','=',0)
                                                ->where('purchase_requests.status_id','=',4)
                                                ->get();

                                                echo count($count);
                                            ?>
                                        @endif
                                         <!-- DOL 7 -->
                                         @if (Auth::user()->role == 7)
                                            <?php 
                                                $count = DB::table('purchase_requests')
                                                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                                                ->select('purchase_requests.*','users.name')
                                                ->where('purchase_requests.deleted_flag','=',0)
                                                ->where('purchase_requests.status_id','=',7)
                                                ->get();

                                                echo count($count);
                                            ?>
                                        @endif
                                    @endif
                                   
                                <p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        @if (Auth::user()->role >= 4)
                            <?php 
                                     $dean = \App\Models\User::join('roles','roles.id','=','users.role')
                                     ->select('roles.name')
                                     ->where('users.id','=',Auth::user()->id)
                                     ->get()
                                     ->first();

                                     $department_id = \App\Models\Employee::where('users_id','=',Auth::user()->id)
                                     ->get()
                                     ->first();

                                     if(strtoupper($dean->name) =="DEAN"){
                                        if(!empty($department_id)){
                                            $count = \App\Models\PurchaseRequest::
                                            join('users','users.id','=','purchase_requests.created_by_users_id')
                                            ->join('employees','employees.users_id','=','users.id')
                                            ->where('employees.department_names_id','=',$department_id->department_names_id)
                                            ->where('purchase_requests.deleted_flag','=',0)
                                            ->select('purchase_requests.*')
                                            ->get()
                                            ->last();

                                            //echo count($count);
                                        }
                                     }else{
                                        $count = \App\Models\PurchaseRequest::where('created_by_users_id','=',Auth::user()->id)->get()->last();
                                        //echo count($count);
                                     }

                                    //$count = \App\Models\PurchaseRequest::where('created_by_users_id','=',Auth::user()->id)->get()->last();
                                ?>
                            @if (!empty($count))
                                <i class="fa fa-calendar-o"></i> Update Since {{$count->created_at->diffForHumans()}}
                            @else
                                {{__('No Records found')}}
                            @endif
                        @else
                            <?php 
                                    $count = \App\Models\PurchaseRequest::get()->last();
                                ?>
                            @if (!empty($count))
                                <i class="fa fa-calendar-o"></i> Update Since {{$count->created_at->diffForHumans()}}
                            @else
                            {{__('No Records found')}}
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-single-copy-04 text-success"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Approved Request</p>
                                <p class="card-title">
                                    @if (Auth::user()->role == 9)
                                        <?php 
                                            $dean = \App\Models\User::join('roles','roles.id','=','users.role')
                                            ->select('roles.name')
                                            ->where('users.id','=',Auth::user()->id)
                                            ->get()
                                            ->first();

                                            $department_id = \App\Models\Employee::where('users_id','=',Auth::user()->id)
                                            ->get()
                                            ->first();

                                            if(!empty($department_id)){
                                                if(strtoupper($dean->name) =="DEAN"){
                                                    $count = DB::table('purchase_requests')
                                                    ->join('users','users.id','=','purchase_requests.created_by_users_id')
                                                    ->join('employees','employees.users_id','=','users.id')
                                                    ->where('employees.department_names_id','=',$department_id->department_names_id)
                                                    ->where('purchase_requests.deleted_flag','=',0)
                                                    ->select('purchase_requests.*','users.name')
                                                    ->get();
    
                                                    echo count($count);
                                                }else{
                                                    $count = \App\Models\PurchaseRequest::where('created_by_users_id','=',Auth::user()->id)->get();
                                                    echo count($count);
                                                }
                                            }
                                            
                                        ?>
                                    @else
                                        <?php 
                                            // $count = \App\Models\PurchaseRequest::all();
                                            // echo count($count);
                                        ?>
                                        <!-- Super Admin and Admin -->
                                        @if (Auth::user()->role < 3)
                                            <?php 
                                                $count = DB::table('purchase_requests')
                                                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                                                ->select('purchase_requests.*','users.name')
                                                ->where('purchase_requests.deleted_flag','=',0)
                                                ->where('purchase_requests.status_id','>',0)
                                                ->get();

                                                echo count($count);
                                            ?>
                                        @endif
                                        <!-- Acquisition -->
                                        @if (Auth::user()->role == 3)
                                            <?php 
                                                $count = DB::table('purchase_requests')
                                                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                                                ->select('purchase_requests.*','users.name')
                                                ->where('purchase_requests.deleted_flag','=',0)
                                                ->where('purchase_requests.status_id','>',2)
                                                ->get();

                                                echo count($count);
                                            ?>
                                        @endif
                                        <!-- PRESIDENT 4 -->
                                        @if (Auth::user()->role == 4)
                                            <?php 
                                                $count = DB::table('purchase_requests')
                                                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                                                ->select('purchase_requests.*','users.name')
                                                ->where('purchase_requests.deleted_flag','=',0)
                                                ->where('purchase_requests.status_id','>',5)
                                                ->where('purchase_requests.amount','>',50000)
                                                ->get();

                                                echo count($count);
                                            ?>
                                        @endif
                                        <!-- VPAA 5 -->
                                        @if (Auth::user()->role == 5)
                                            <?php 
                                                $count = DB::table('purchase_requests')
                                                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                                                ->select('purchase_requests.*','users.name')
                                                ->where('purchase_requests.deleted_flag','=',0)
                                                ->where('purchase_requests.status_id','>',1)
                                                ->get();

                                                echo count($count);
                                            ?>
                                        @endif
                                        <!-- VPFA 6 -->
                                        @if (Auth::user()->role == 6)
                                            <?php 
                                                $count = DB::table('purchase_requests')
                                                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                                                ->select('purchase_requests.*','users.name')
                                                ->where('purchase_requests.deleted_flag','=',0)
                                                ->where('purchase_requests.status_id','>',4)
                                                ->get();

                                                echo count($count);
                                            ?>
                                        @endif
                                         <!-- DOL 7 -->
                                         @if (Auth::user()->role == 7)
                                            <?php 
                                                $count = DB::table('purchase_requests')
                                                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                                                ->select('purchase_requests.*','users.name')
                                                ->where('purchase_requests.deleted_flag','=',0)
                                                ->where('purchase_requests.status_id','>',7)
                                                ->get();

                                                echo count($count);
                                            ?>
                                        @endif
                                    @endif
                                   
                                <p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        @if (Auth::user()->role >= 4)
                            <?php 
                                     $dean = \App\Models\User::join('roles','roles.id','=','users.role')
                                     ->select('roles.name')
                                     ->where('users.id','=',Auth::user()->id)
                                     ->get()
                                     ->first();

                                     $department_id = \App\Models\Employee::where('users_id','=',Auth::user()->id)
                                     ->get()
                                     ->first();

                                     if(strtoupper($dean->name) =="DEAN"){
                                        if(!empty($department_id)){
                                            $count = \App\Models\PurchaseRequest::
                                            join('users','users.id','=','purchase_requests.created_by_users_id')
                                            ->join('employees','employees.users_id','=','users.id')
                                            ->where('employees.department_names_id','=',$department_id->department_names_id)
                                            ->where('purchase_requests.deleted_flag','=',0)
                                            ->select('purchase_requests.*')
                                            ->get()
                                            ->last();

                                            //echo count($count);
                                        }
                                     }else{
                                        $count = \App\Models\PurchaseRequest::where('created_by_users_id','=',Auth::user()->id)->get()->last();
                                        //echo count($count);
                                     }

                                    //$count = \App\Models\PurchaseRequest::where('created_by_users_id','=',Auth::user()->id)->get()->last();
                                ?>
                            @if (!empty($count))
                                <i class="fa fa-calendar-o"></i> Update Since {{$count->created_at->diffForHumans()}}
                            @else
                                {{__('No Records found')}}
                            @endif
                        @else
                            <?php 
                                    $count = \App\Models\PurchaseRequest::get()->last();
                                ?>
                            @if (!empty($count))
                                <i class="fa fa-calendar-o"></i> Update Since {{$count->created_at->diffForHumans()}}
                            @else
                            {{__('No Records found')}}
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 {{ Auth::user()->role == 4 || Auth::user()->role >= 8 && Auth::user()->role <= 10 ? 'd-none' : ' '}}">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="fa fa-signature text-success"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Signed Request</p>
                                <p class="card-title">
                                    <!-- Super Admin and Admin -->
                                        @if (Auth::user()->role < 3)
                                            <?php 
                                                $count = DB::table('purchase_requests')
                                                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                                                ->select('purchase_requests.*','users.name')
                                                ->where('purchase_requests.deleted_flag','=',0)
                                                ->where('purchase_requests.status_id','>',0)
                                                ->get();

                                                echo count($count);
                                            ?>
                                        @endif
                                        <!-- Acquisition -->
                                        @if (Auth::user()->role == 3)
                                            <?php 
                                                $count = DB::table('purchase_requests')
                                                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                                                ->select('purchase_requests.*','users.name')
                                                ->where('purchase_requests.deleted_flag','=',0)
                                                ->where('purchase_requests.status_id','>',6)
                                                ->get();

                                                echo count($count);
                                            ?>
                                        @endif
                                        <!-- VPAA 5 -->
                                        @if (Auth::user()->role == 5)
                                            <?php 
                                                $count = DB::table('purchase_requests')
                                                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                                                ->select('purchase_requests.*','users.name')
                                                ->where('purchase_requests.deleted_flag','=',0)
                                                ->where('purchase_requests.status_id','>',8)
                                                ->get();

                                                echo count($count);
                                            ?>
                                        @endif
                                        <!-- VPFA 6 -->
                                        @if (Auth::user()->role == 6)
                                            <?php 
                                                $count = DB::table('purchase_requests')
                                                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                                                ->select('purchase_requests.*','users.name')
                                                ->where('purchase_requests.deleted_flag','=',0)
                                                ->where('purchase_requests.status_id','>',9)
                                                ->get();

                                                echo count($count);
                                            ?>
                                        @endif
                                         <!-- DOL 7 -->
                                         @if (Auth::user()->role == 7)
                                            <?php 
                                                $count = DB::table('purchase_requests')
                                                ->join('users','users.id','=','purchase_requests.created_by_users_id')
                                                ->select('purchase_requests.*','users.name')
                                                ->where('purchase_requests.deleted_flag','=',0)
                                                ->where('purchase_requests.status_id','>',7)
                                                ->get();

                                                echo count($count);
                                            ?>
                                        @endif
                                   
                                <p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        @if (Auth::user()->role >= 4)
                            <?php 
                                     $dean = \App\Models\User::join('roles','roles.id','=','users.role')
                                     ->select('roles.name')
                                     ->where('users.id','=',Auth::user()->id)
                                     ->get()
                                     ->first();

                                     $department_id = \App\Models\Employee::where('users_id','=',Auth::user()->id)
                                     ->get()
                                     ->first();

                                     if(strtoupper($dean->name) =="DEAN"){
                                        if(!empty($department_id)){
                                            $count = \App\Models\PurchaseRequest::
                                            join('users','users.id','=','purchase_requests.created_by_users_id')
                                            ->join('employees','employees.users_id','=','users.id')
                                            ->where('employees.department_names_id','=',$department_id->department_names_id)
                                            ->where('purchase_requests.deleted_flag','=',0)
                                            ->select('purchase_requests.*')
                                            ->get()
                                            ->last();

                                            //echo count($count);
                                        }
                                     }else{
                                        $count = \App\Models\PurchaseRequest::where('created_by_users_id','=',Auth::user()->id)->get()->last();
                                        //echo count($count);
                                     }

                                    //$count = \App\Models\PurchaseRequest::where('created_by_users_id','=',Auth::user()->id)->get()->last();
                                ?>
                            @if (!empty($count))
                                <i class="fa fa-calendar-o"></i> Update Since {{$count->created_at->diffForHumans()}}
                            @else
                                {{__('No Records found')}}
                            @endif
                        @else
                            <?php 
                                    $count = \App\Models\PurchaseRequest::get()->last();
                                ?>
                            @if (!empty($count))
                                <i class="fa fa-calendar-o"></i> Update Since {{$count->created_at->diffForHumans()}}
                            @else
                            {{__('No Records found')}}
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 d-none">
            <div class="card ">
                <div class="card-header ">
                    <h5 class="card-title">Users Behavior</h5>
                    <p class="card-category">24 Hours performance</p>
                </div>
                <div class="card-body ">
                    <canvas id=chartHours width="400" height="100"></canvas>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-history"></i> Updated 3 minutes ago
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-none">
        <div class="col-md-4">
            <div class="card ">
                <div class="card-header ">
                    <h5 class="card-title">Email Statistics</h5>
                    <p class="card-category">Last Campaign Performance</p>
                </div>
                <div class="card-body ">
                    <canvas id="chartEmail"></canvas>
                </div>
                <div class="card-footer ">
                    <div class="legend">
                        <i class="fa fa-circle text-primary"></i> Opened
                        <i class="fa fa-circle text-warning"></i> Read
                        <i class="fa fa-circle text-danger"></i> Deleted
                        <i class="fa fa-circle text-gray"></i> Unopened
                    </div>
                    <hr>
                    <div class="stats">
                        <i class="fa fa-calendar"></i> Number of emails sent
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-title">NASDAQ: AAPL</h5>
                    <p class="card-category">Line Chart with Points</p>
                </div>
                <div class="card-body">
                    <canvas id="speedChart" width="400" height="100"></canvas>
                </div>
                <div class="card-footer">
                    <div class="chart-legend">
                        <i class="fa fa-circle text-info"></i> Tesla Model S
                        <i class="fa fa-circle text-warning"></i> BMW 5 Series
                    </div>
                    <hr />
                    <div class="card-stats">
                        <i class="fa fa-check"></i> Data information certified
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
    demo.initChartsPages();
});
</script>
@endpush