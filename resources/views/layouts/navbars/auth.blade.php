<div class="sidebar" data-color="dark" data-active-color="primary">
    <div class="logo" style="display:grid; justify-content:center;background:#071599;">
        <a href="{{url('/')}}" class="simple-text">
            <div class="logo-image-small">
                <img src="{{ asset('paper') }}/img/cpu-logo.png">
            </div>
        </a>
        <a href="{{url('/')}}" class="simple-text logo-normal text-center">
            {{ __('Library Aquisition ') }}
        </a>
    </div>
    <div class="sidebar-wrapper" style="background:#071599; width:auto">
        <ul class="nav">
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }} ">
                <a href="{{ route('page.index', 'dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
           
            @if (Auth::user()->can('user-list') || Auth::user()->can('role-list') ||
            Auth::user()->can('employee-list'))
           
            <li class="{{ $elementActive == '1' || $elementActive == '1' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="false" href="#usersmgt">
                    <i class="fa fa-users"></i>
                    <p>{{ __('User Management') }} <b class="caret"></b></p>
                </a>
                <div class="{{ $elementActive == 'user' || $elementActive == 'roles' || $elementActive == 'employees'? 'collapse show' : 'collapse' }}"
                    id="usersmgt">
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
                        @can('employee-list')
                        <li class="{{ $elementActive == 'employees' ? 'active' : '' }}">
                            <a href="{{ route('employees') }}">
                                <span class="sidebar-mini-icon">&nbsp;</span>
                                <span class="sidebar-normal">{{ __(' Employees ') }}</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </li>
            @endif
            @if (Auth::user()->can('department_budget-list'))
            <li class="{{ $elementActive == '1' || $elementActive == '1' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="false" href="#budgetmgmt">
                    <i class="fa fa-book"></i>
                    <p>{{ __('Budget Management')}} <b class="caret"></b></p>
                </a>
                <div class="{{ $elementActive == 'department_budgets' ? 'collapse show ' : 'collapse'}}"
                    id="budgetmgmt">
                    <ul class="nav">
                        @can('department_budget-list')
                        <li class="{{ $elementActive == 'department_budgets' ? 'active' : '' }}">
                            <a href="{{ route('department_budgets') }}">
                                <span class="sidebar-mini-icon">&nbsp;</span>
                                <span class="sidebar-normal">{{ __('Department Budgets ') }}</span>
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
            @if (Auth::user()->can('purchase_request-list') || Auth::user()->can('purchase_request_approved-list'))
            <li class="{{ $elementActive == '1' || $elementActive == '1' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="false" href="#reqbooks">
                    <i class="fa fa-book"></i>
                    <p>{{ __('Request Management')}} <b class="caret"></b></p>
                </a>
                <div class="{{ $elementActive == 'purchase_requests' || $elementActive == 'request_books' || $elementActive == 'purchase_approved' ? 'collapse show ' : 'collapse' }}"
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
                        <li class="d-none {{ $elementActive == 'sign_requests' ? 'active' : '' }}">
                            <a href="{{ route('purchase_requests') }}">
                                <span class="sidebar-mini-icon">&nbsp;</span>
                                <span class="sidebar-normal">{{ __('Sign Request ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'request_books' ? 'active' : '' }} d-none">
                            <a href="{{ route('department_types') }}">
                                <span class="sidebar-mini-icon">&nbsp;</span>
                                <span class="sidebar-normal">{{ __('Request Books ') }}</span>
                            </a>
                        </li>
                        @can('purchase_request_approved-list')
                        <li class="{{ $elementActive == 'purchase_approved' ? 'active' : '' }}">
                            <a href="{{ route('purchase_approves') }}">
                                <span class="sidebar-mini-icon">&nbsp;</span>
                                <span class="sidebar-normal">{{ __('Approved Request ') }}</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </li>
            @endif
            @if (Auth::user()->can('acquisition_books-list'))
            <li class="{{ $elementActive == 'acquisition_books' ? 'active' : '' }} ">
                <a href="{{ route('acquisition_books') }}">
                    <i class="fa fa-book-open-reader"></i>
                    <p>{{ __('Accession Management') }}</p>
                </a>
            </li>
            @endif

            @if (Auth::user()->can('department_type-list') || Auth::user()->can('department_type-list') ||
            Auth::user()->can('signature-list') || Auth::user()->can('library_section-list'))
            <li class="{{ $elementActive == '1' || $elementActive == '1' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="false" href="#datamgt">
                    <i class="fa fa-cog"></i>
                    <p>{{ __('Data Management') }} <b class="caret"></b></p>
                </a>
                <div class="{{ $elementActive == 'department_types' || $elementActive == 'department_names' ||  $elementActive == 'signature_attachments' || $elementActive == 'library_sections' ? 'collapse show ' : 'collapse' }}"
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
                        @can('library_section-list')
                        <li class="{{ $elementActive == 'library_sections' ? 'active' : '' }}">
                            <a href="{{ route('library_sections') }}">
                                <span class="sidebar-mini-icon">&nbsp;</span>
                                <span class="sidebar-normal">{{ __('Library Sections ') }}</span>
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
            @if (Auth::user()->can('report_management-list'))
            <li class="{{ $elementActive == '1' || $elementActive == '1' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="false" href="#reportMgmt">
                    <i class="fa fa-newspaper"></i>
                    <p>{{ __('Report Management')}} <b class="caret"></b></p>
                </a>
                <div class="{{ $elementActive == 'reports_department' || $elementActive == 'reports_holdings' ? 'collapse show ' : 'collapse' }}"
                    id="reportMgmt">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'reports_department' ? 'active' : '' }}">
                            <a href="{{ route('reports/department') }}">
                                <span class="sidebar-mini-icon">&nbsp;</span>
                                <span class="sidebar-normal">{{ __('By Department ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'reports_holdings' ? 'active' : '' }}">
                            <a href="{{ route('reports/holding') }}">
                                <span class="sidebar-mini-icon">&nbsp;</span>
                                <span class="sidebar-normal">{{ __('Holdings ') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif

        </ul>
    </div>
</div>