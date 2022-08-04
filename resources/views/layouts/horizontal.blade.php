<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('root') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('/assets/images/logo.svg') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('/assets/images/logo-dark.png') }}" alt="" height="17">
                    </span>
                </a>

                <a href="{{ route('root') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('/assets/images/logo-light.svg') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        @php
                            $logo = CustomHelper::getCompanyLogo(Auth::user()->admin_id);
                        @endphp
                        <img src="{{ $logo }}" alt="" height="19">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light"
                data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="@lang('translation.Search')">
                    <span class="bx bx-search-alt"></span>
                </div>
            </form>
        </div>

        <div class="d-flex">

            {{-- <div class="dropdown d-inline-block d-lg-none ml-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="@lang('translation.Search')"
                                    aria-label="Search input">

                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>s
                            </div>
                        </div>
                    </form>
                </div>
            </div> --}}

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                        src="{{ CustomHelper::displayImage(Auth::user()->avatar) }}" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1"
                        key="t-henry">{{ ucfirst(Auth::user()->name) }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('contactProfile') }}"><i
                            class="bx bx-user font-size-16 align-middle me-1"></i> <span
                            key="t-profile">@lang('translation.Profile')</span></a>
                    <a class="dropdown-item d-block" href="#" data-bs-toggle="modal"
                        data-bs-target=".change-password">
                        <i class="bx bx-wrench font-size-16 align-middle me-1"></i>
                        <span key="t-settings">@lang('translation.Change Password')</span>
                    </a>
                    <a class="dropdown-item text-danger" href="javascript:void();"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span
                            key="t-logout">@lang('translation.Logout')</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{ route('root') }}"
                            id="topnav-dashboard" role="button">
                            <i class="bx bx-home-circle me-2"></i><span key="t-dashboards">@lang('translation.Dashboards')</span>
                        </a>
                    </li>
                    @can('admin_staff_list')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{ route('staff.index') }}"
                                id="topnav-uielement" role="button">
                                <i class="bx bxs-user-detail"></i>
                                <span key="t-dashboards">@lang('translation.Staff')</span>
                            </a>
                        </li>
                    @endcan
                    @can('client_list')
                        <li class="nav-item dropdown">
                            <a href="{{ route('leads.index') }}" class="nav-link dropdown-toggle arrow-none"
                                id="topnav-uielement">
                                <i class="bx bxs-user-detail"></i>
                                <span key="t-dashboards">@lang('translation.Leads')</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="{{ route('client.index') }}" class="nav-link dropdown-toggle arrow-none"
                                id="topnav-uielement">
                                <i class="bx bxs-user-detail"></i>
                                <span key="t-dashboards">@lang('translation.Clients')</span>
                            </a>
                        </li>
                    @endcan
                    @can('client_ticket_create')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layout"
                                role="button">
                                <i class="fas fa-ticket-alt"></i><span key="t-layouts">@lang('translation.Tickets')</span>
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-layout">
                                @can('admin_ticket_create')
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none"
                                            href="{{ route('ticket.index') }}" id="topnav-layout-verti" role="button">
                                            <span key="t-vertical">@lang('translation.Tickets')</span>
                                        </a>
                                    </div>
                                @endcan
                                @can('client_ticket_create')
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none"
                                            href="{{ route('client-ticket.index') }}" id="topnav-layout-verti"
                                            role="button">
                                            <span key="t-vertical">@lang('translation.Client Ticket')</span>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </li>
                    @endcan
                    @can('admin_email_create')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layout"
                                role="button">
                                <i class="mdi mdi-email"></i><span key="t-layouts">@lang('translation.Email')</span>
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-layout">
                                @can('admin_email_create')
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none"
                                            href="{{ route('email.index') }}" id="topnav-layout-verti" role="button">
                                            <span key="t-vertical">@lang('translation.Email')</span>
                                        </a>
                                    </div>
                                @endcan
                                @can('admin_email_create')
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none"
                                            href="{{ route('mail_variables.index') }}" id="topnav-layout-verti"
                                            role="button">
                                            <span key="t-vertical">@lang('translation.Mail Variable')</span>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </li>
                    @endcan
                    @can('admin_tools')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layout"
                                role="button">
                                <i class="fas fa-wrench"></i><span key="t-layouts">@lang('translation.Tools')</span>
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-layout">
                                @can('calendar_list')
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none"
                                            href="{{ route('calendar.index') }}" id="topnav-layout-verti" role="button">
                                            <span key="t-vertical">@lang('translation.Calendars')</span>
                                        </a>
                                    </div>
                                @endcan
                                @can('notes_list')
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none"
                                            href="{{ route('note.index') }}" id="topnav-layout-verti" role="button">
                                            <span key="t-vertical">@lang('translation.Note')</span>
                                        </a>
                                    </div>
                                @endcan
                                @can('todo_list')
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none"
                                            href="{{ route('todo.index') }}" id="topnav-layout-verti" role="button">
                                            <span key="t-vertical">@lang('translation.Todo')</span>
                                        </a>
                                    </div>
                                @endcan
                                @can('admin_message_list')
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none"
                                            href="{{ route('messages.index') }}" id="topnav-layout-verti" role="button">
                                            <span key="t-vertical">@lang('translation.Message')</span>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </li>
                    @endcan
                    @can('admin_marketing')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layout"
                                role="button">
                                <i class="fas fa-bullhorn"></i><span key="t-layouts">@lang('translation.Marketing')</span>
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-layout">
                                @can('admin_contact_list')
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none"
                                            href="{{ route('contact.index') }}" id="topnav-layout-verti" role="button">
                                            <span key="t-vertical">@lang('translation.Contact_List')</span>
                                        </a>
                                    </div>
                                @endcan
                                @can('admin_email_campaign_list')
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none"
                                            href="{{ route('email_campaign.index') }}" id="topnav-layout-verti"
                                            role="button">
                                            <span key="t-vertical">@lang('translation.Email Campaign')</span>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </li>
                    @endcan
                    @can('admin-setting')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layout"
                                role="button">
                                <i class="fas fa-cogs"><span key="t-layouts">@lang('translation.Settings')</span>
                                    <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-layout">
                                @php $SettingList = \CustomHelper::getSettingList() @endphp
                                @if ($SettingList)
                                    @foreach ($SettingList as $key => $value)
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none"
                                                href="{{ url('/setting') }}/{{ $key }}"
                                                id="topnav-layout-verti" role="button">
                                                <span key="t-vertical">@lang('translation.' . $value)</span>
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </li>
                    @endcan

                </ul>
            </div>
        </nav>
    </div>
</div>

<!--  Change-Password example -->
<div class="modal fade change-password" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="change-password">
                    @csrf
                    <input type="hidden" value="{{ Auth::user()->id }}" id="data_id">
                    <div class="mb-3">
                        <label for="current_password">Current Password</label>
                        <input id="current-password" type="password"
                            class="form-control @error('current_password') is-invalid @enderror"
                            name="current_password" autocomplete="current_password"
                            placeholder="Enter Current Password" value="{{ old('current_password') }}">
                        <div class="text-danger" id="current_passwordError" data-ajax-feedback="current_password">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="newpassword">New Password</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password"
                            autocomplete="new_password" placeholder="Enter New Password">
                        <div class="text-danger" id="passwordError" data-ajax-feedback="password"></div>
                    </div>

                    <div class="mb-3">
                        <label for="userpassword">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control"
                            name="password_confirmation" autocomplete="new_password"
                            placeholder="Enter New Confirm password">
                        <div class="text-danger" id="password_confirmError" data-ajax-feedback="password-confirm">
                        </div>
                    </div>

                    <div class="mt-3 d-grid">
                        <button class="btn btn-primary waves-effect waves-light UpdatePassword"
                            data-id="{{ Auth::user()->id }}" type="submit">Update Password</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
