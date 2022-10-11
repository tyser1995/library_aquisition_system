<div class="sidebar" data-color="dark" data-active-color="primary">
    <div class="logo" style="display:grid; justify-content:center;">
        <a href="{{url('/')}}" class="simple-text">
            <div class="logo-image-small">
                <img src="{{ asset('paper') }}/img/cpu-logo.png">
            </div>
        </a>
        <a href="{{url('/')}}" class="simple-text logo-normal text-center">
            {{ __('Library Aquisition ') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }} ">
                <a href="{{ route('page.index', 'dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            @if(Auth::user()->role == 1 || Auth::user()->role == 2)
            <li class="{{ $elementActive == '1' || $elementActive == '1' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="false" href="#usersmgt">
                    <i class="fa fa-users"></i>
                    <p>{{ __('User Management') }} <b class="caret"></b></p>
                </a>
                <div class="{{ $elementActive == 'user' || $elementActive == 'roles' || $elementActive == 'employees'? 'collapse show' : 'collapse' }}" id="usersmgt">
                    <ul class="nav">
                        @can('user-list')
                        <li class="{{ $elementActive == 'user' ? 'active' : '' }} ">
                            <a href="{{ route('users') }}">
                                <span class="sidebar-mini-icon">&nbsp;</span>
                                <span class="sidebar-normal">{{ __(' Users ') }}</span>
                            </a>
                        </li>
                        @endcan
                        @can('role-list')
                        <li class="{{ $elementActive == 'roles' ? 'active' : '' }}">
                            <a href="{{ route('roles') }}">
                                <span class="sidebar-mini-icon">&nbsp;</span>
                                <span class="sidebar-normal">{{ __(' Roles and Permissions ') }}</span>
                            </a>
                        </li>
                        @endcan
                        <li class="{{ $elementActive == 'employees' ? 'active' : '' }}">
                            <a href="{{ route('employees') }}">
                                <span class="sidebar-mini-icon">&nbsp;</span>
                                <span class="sidebar-normal">{{ __(' Employees ') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            @endif

            @if (Auth::user()->can('purchase_request-list'))
            <li class="{{ $elementActive == '1' || $elementActive == '1' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="false" href="#reqbooks">
                    <i class="fa fa-book"></i>
                    <p>{{ __('Request Management')}} <b class="caret"></b></p>
                </a>
                <div class="{{ $elementActive == 'purchase_requests' || $elementActive == 'request_books' || $elementActive == 'verify_books' ? 'collapse show ' : 'collapse' }}"
                    id="reqbooks">
                    <ul class="nav">
                        @can('purchase_request-list')
                            <li class="{{ $elementActive == 'purchase_requests' ? 'active' : '' }}">
                                <a href="{{ route('purchase_requests') }}">
                                    <span class="sidebar-mini-icon">&nbsp;</span>
                                    <span class="sidebar-normal">{{ __('Purchase Request ') }}</span>
                                </a>
                            </li>
                        @endcan
                        <li class="{{ $elementActive == 'request_books' ? 'active' : '' }} d-none">
                            <a href="{{ route('department_types') }}">
                                <span class="sidebar-mini-icon">&nbsp;</span>
                                <span class="sidebar-normal">{{ __('Request Books ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'verify_books' ? 'active' : '' }} d-none">
                            <a href="{{ route('department_names') }}">
                                <span class="sidebar-mini-icon">&nbsp;</span>
                                <span class="sidebar-normal">{{ __('Verify Books ') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif

            @if (Auth::user()->can('department_type-list') || Auth::user()->can('department_type-list') || Auth::user()->can('signature-list') || Auth::user()->can('department_budget-list'))
                <li class="{{ $elementActive == '1' || $elementActive == '1' ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="false" href="#datamgt">
                        <i class="fa fa-cog"></i>
                        <p>{{ __('Data Management') }} <b class="caret"></b></p>
                    </a>
                    <div class="{{ $elementActive == 'department_types' || $elementActive == 'department_names' ? 'collapse show ' : 'collapse' }}"
                        id="datamgt">
                        <ul class="nav">
                            @can('department_type-list')
                                <li class="{{ $elementActive == 'department_types' ? 'active' : '' }}">
                                    <a href="{{ route('department_types') }}">
                                        <span class="sidebar-mini-icon">&nbsp;</span>
                                        <span class="sidebar-normal">{{ __('Department Types ') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('department_name-list')
                                <li class="{{ $elementActive == 'department_names' ? 'active' : '' }}">
                                    <a href="{{ route('department_names') }}">
                                        <span class="sidebar-mini-icon">&nbsp;</span>
                                        <span class="sidebar-normal">{{ __('Department Names ') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('department_budget-list')
                                <li class="{{ $elementActive == 'department_budgets' ? 'active' : '' }}">
                                    <a href="{{ route('department_budgets') }}">
                                        <span class="sidebar-mini-icon">&nbsp;</span>
                                        <span class="sidebar-normal">{{ __('Department Budgets ') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('signature-list')
                                <li class="{{ $elementActive == 'signature_attachments' ? 'active' : '' }}">
                                    <a href="{{ route('signature_attachments') }}">
                                        <span class="sidebar-mini-icon">&nbsp;</span>
                                        <span class="sidebar-normal">{{ __('Signature Attachment') }}</span>
                                    </a>
                                </li>
                            @endcan
                        
                        </ul>
                    </div>
                </li>
            @endif

        </ul>
    </div>
</div>
