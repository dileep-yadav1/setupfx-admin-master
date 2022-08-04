@php 
$showFilter = "";
$arrFilter = ['department', 'subject', 'reporter', 'priority', 'tags'];
@endphp
@if(count(array_intersect(collect(array_filter(collect(Request::all())->toArray(), 'strlen'))->keys()->toArray(), $arrFilter)) > 0)
    @php  $showFilter = "show"; @endphp
@endif

@extends('layouts.master')

@section('title')
    @lang('translation.Ticket_List')
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Ticket List
        @endslot
    @endcomponent

    <div class="accordion mt-2 mb-2" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Filter
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse {{$showFilter}}" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                <div class="accordion-body">
                    <div class="text-muted">
                        <form method="GET" action="{{ route('ticket.index') }}">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Department</label>
                                        {{ Form::select('department', ['' => 'Please Select'] + $aDepartment, Request::get('department'), ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Subject</label>
                                        <input type="text" id="subject" name="subject"
                                        class="form-control" value="{{ Request::get('subject') }}" placeholder="Subject">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="formrow-email-input" class="form-label">Reporter</label>
                                        {{ Form::select('reporter', ['' => 'Please Select'] + $getSalesAgent, Request::get('reporter'), ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="formrow-password-input" class="form-label">Priority</label>
                                        {{ Form::select('priority', ['' => 'Please Select'] + $aPriority, Request::get('priority'), ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-address-input">Tags</label><br>
                                        <div class="col-md-12">
                                            <input type="text" value="{{ Request::get('tags') }}" data-role="tagsinput" name="tags" class="form-control" placeholder="Add tags" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label for="verticalnav-email-input">Status</label>
                                    <div class="mb-3">
                                        <select name="status" class="form-control">
                                            <option class="text-muted" value="" selected>--Select status--</option>
                                            <option value="0" {{ (Request::get('status') == "0" ? 'selected' : '') }}>Pending</option>
                                            <option value="1" {{ (Request::get('status') == "1" ? 'selected' : '') }}>Closed</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="formrow-firstname-input" class="d-block">&nbsp;</label>
                                    <button type="submit" class="btn btn-success w-md">Submit</button>
                                    <a href="{{ route('ticket.index') }}" class="btn btn-danger w-md">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @can('admin_ticket_create')
                        <div class="d-flex flex-wrap gap-2 mb-4 justify-content-md-end">
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('ticket.create') }}"
                                role="button">Add New Ticket</a>
                        </div>
                    @endcan
                    @if (count($aTickets))
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 70px;">#</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">priority</th>
                                        @can('admin_ticket_status')
                                            <th scope="col">Status</th>
                                        @endcan
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($aTickets as $aKey => $aTicket)
                                        <tr>
                                            <td>
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle">
                                                        T
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 mb-1"><a href="#"
                                                        class="text-dark">{{ CustomHelper::getdepartmentName($aTicket->department) }}</a>
                                                </h5>
                                            </td>
                                            <td>{{ $aTicket->subject }}</td>
                                            <td>
                                                <span
                                                    class="btn text-white waves-effect waves-light bg-{{ \CustomHelper::$getPriorityBadge[$aTicket->priority] }}">
                                                    {{ \CustomHelper::$getPriorityType[$aTicket->priority] }}
                                                </span>
                                            </td>
                                            @can('admin_ticket_status')
                                                <td>
                                                    @if ($aTicket->status == 0)
                                                        {{-- <a href="{{ route('ticket.change_status', [$aTicket->id, 1]) }}"> --}}
                                                            <span class="btn btn-danger waves-effect waves-light">Pending</span>
                                                        {{-- </a> --}}
                                                    @else
                                                        {{-- <a href="{{ route('ticket.change_status',[$aTicket->id,0]) }}"> --}}
                                                        <span class="btn btn-success waves-effect waves-light">Closed</span>
                                                        {{-- </a> --}}
                                                    @endif
                                                </td>
                                            @endcan

                                            <td>
                                                <ul class="list-inline font-size-20 contact-links mb-0">
                                                    @can('admin_ticket_reply')
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('client-ticket.reply', $aTicket->id) }}" title="Reply">
                                                                <i class="bx bx bx-message-alt"></i>
                                                            </a>
                                                        </li>
                                                    @endcan
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $aTickets->links('components.pagination') }}
                    @else
                        No data found
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
