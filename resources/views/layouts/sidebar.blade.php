<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">@lang('translation.Menu')</li>

                <li>
                    <a href="{{ route('root') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">@lang('translation.Dashboards')</span>
                    </a>
                </li>
                @can('admin_staff_list')
                    <li>
                        <a href="{{ route('staff.index') }}" class="waves-effect">
                            <i class="bx bxs-user-detail"></i>
                            <span key="t-dashboards">@lang('translation.Staff')</span>
                        </a>
                    </li>
                @endcan
                @can('client_list')
                    <li>
                        <a href="{{ route('leads.index') }}" class="waves-effect">
                            <i class="bx bxs-user-detail"></i>
                            <span key="t-dashboards">@lang('translation.Leads')</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.index') }}" class="waves-effect">
                            <i class="bx bxs-user-detail"></i>
                            <span key="t-dashboards">@lang('translation.Clients')</span>
                        </a>
                    </li>
                @endcan
                @can('client_ticket_create')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-ticket-alt"></i>
                            <span key="t-dashboards">@lang('translation.Tickets')</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('admin_ticket_create')
                                <li>
                                    <a href="{{ route('ticket.index') }}" class="waves-effect">
                                        <span key="t-dashboards">@lang('translation.Tickets')</span>
                                    </a>
                                </li>
                            @endcan
                            @can('client_ticket_create')
                                <li>
                                    <a href="{{ route('client-ticket.index') }}" class="waves-effect">
                                        <span key="t-dashboards">@lang('translation.Client Ticket')</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('admin_email_create')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-email"></i>
                            <span key="t-dashboards">@lang('translation.Email')</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('admin_email_create')
                                <li>
                                    <a href="{{ route('email.index') }}" class="waves-effect">
                                        <span key="t-dashboards">@lang('translation.Email')</span>
                                    </a>
                                </li>
                            @endcan
                            @can('admin_email_create')
                                <li>
                                    <a href="{{ route('mail_variables.index') }}" class="waves-effect">
                                        <span key="t-dashboards">@lang('translation.Mail Variable')</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('admin_tools')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-wrench"></i>
                            <span key="t-dashboards">@lang('translation.Tools')</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('calendar_list')
                                <li>
                                    <a href="{{ route('calendar.index') }}" class="waves-effect">
                                        {{-- <i class="bx bx-aperture"></i> --}}
                                        <span key="t-dashboards">@lang('translation.Calendars')</span>
                                    </a>
                                </li>
                            @endcan
                            @can('notes_list')
                                <li>
                                    <a href="{{ route('note.index') }}" class="waves-effect">
                                        {{-- <i class="fas fa-bars"></i> --}}
                                        <span key="t-dashboards">@lang('translation.Note')</span>
                                    </a>
                                </li>
                            @endcan
                            @can('todo_list')
                                <li>
                                    <a href="{{ route('todo.index') }}" class="waves-effect">
                                        {{-- <i class="fas fa-book-open"></i> --}}
                                        <span key="t-dashboards">@lang('translation.Todo')</span>
                                    </a>
                                </li>
                            @endcan
                            @can('admin_message_list')
                                <li>
                                    <a href="{{ route('messages.index') }}" class="waves-effect">
                                        <span key="t-dashboards">@lang('translation.Message')</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('admin_marketing')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-bullhorn"></i>
                            <span key="t-dashboards">@lang('translation.Marketing')</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('admin_contact_list')
                                <li>
                                    <a href="{{ route('contact.index') }}" class="waves-effect">
                                        <span key="t-dashboards">@lang('translation.Contact_List')</span>
                                    </a>
                                </li>
                            @endcan
                            @can('admin_email_campaign_list')
                                <li>
                                    <a href="{{ route('email_campaign.index') }}" class="waves-effect">
                                        <span key="t-dashboards">@lang('translation.Email Campaign')</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('admin-setting')
                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="fas fa-cogs"></i><span class="badge rounded-pill bg-info float-end"></span>
                            <span key="t-dashboards">@lang('translation.Settings')</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @php $SettingList = \CustomHelper::getSettingList() @endphp
                            @if ($SettingList)
                                @foreach ($SettingList as $key => $value)
                                    <li>
                                        <a href="{{ url('/setting') }}/{{ $key }}"
                                            key="t-default">@lang('translation.' . $value)</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </li>
                @endcan
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

