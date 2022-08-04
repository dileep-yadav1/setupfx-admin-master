@extends('layouts.master')
@php
$showFilter = "";
$arrFilter = ["name","email","contact","country_id","state_id","city_id","nationality","company_name","dob","net_worth","annual_income","emp_status","source_income","initial_amt"];
@endphp
@if(count(array_intersect(collect(array_filter(collect(Request::all())->toArray(), 'strlen'))->keys()->toArray(), $arrFilter)) > 0)
    @php  $showFilter = "show"; @endphp
@endif
@section('title')
    @lang('translation.Lead_List')
@endsection
@php
use App\Models\Client;
@endphp
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">Leads</p>
                            <h4 class="mb-0">{{ $total_leads }}</h4>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                <span class="avatar-title">
                                    <i class="bx bx-copy-alt font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">Today</p>
                            <h4 class="mb-0">{{ $today }}</h4>
                        </div>

                        <div class="flex-shrink-0 align-self-center ">
                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                <span class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bx-archive-in font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">This Week</p>
                            <h4 class="mb-0">{{ $week }}</h4>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                <span class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">This Month</p>
                            <h4 class="mb-0">{{ $month }}</h4>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                <span class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Lead List
        @endslot
    @endcomponent
    <div class="accordion mt-2 mb-2" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Filter
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse {{ $showFilter }}" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample" style="">
                <div class="accordion-body">
                    <div class="text-muted">
                        <form method="GET" action="{{ route('leads.index') }}">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">First Name</label>
                                        <input type="text" id="first_name" name="first_name" class="form-control"
                                        value="{{ Request::get('first_name') }}" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Email</label>
                                        <input type="text" id="email" name="email" class="form-control"
                                            value="{{ Request::get('email') }}" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="formrow-email-input" class="form-label">Contact</label>
                                        <input type="text" id="contact" name="contact" class="form-control"
                                        value="{{ Request::get('contact') }}" placeholder="Contact">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Country</label>
                                        {{ Form::select('country_id', ['' => 'Please Select'] + $aCountry, Request::get('country_id'), ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">State</label>
                                        {{ Form::select('state_id', ['' => 'Please Select'] + $aState, Request::get('state_id'), ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">City</label>
                                        {{ Form::select('city_id', ['' => 'Please Select'] + $aCity, Request::get('city_id'), ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Nationality</label>
                                        <input type="text" id="nationality" name="nationality" class="form-control"
                                        value="{{ Request::get('nationality') }}" placeholder="Nationality">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Company Name</label>
                                        <input type="text" id="company_name" name="company_name" class="form-control"
                                        value="{{ Request::get('company_name') }}" placeholder="Company Name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Date of Birth</label>
                                        <input type="date" id="dob" name="dob" class="form-control"
                                        value="{{ (Request::get('dob')) ? date('Y-m-d',strtotime(Request::get('dob'))) : "" }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Net Worth</label>
                                        {{ Form::select('net_worth', ['' => 'Please Select'] + $incomeData, Request::get('net_worth'), ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Annual Income</label>
                                        {{ Form::select('annual_income', ['' => 'Please Select'] + $incomeData, Request::get('annual_income'), ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Employment Status</label>
                                        {{ Form::select('emp_status', ['' => 'Please Select'] + $empStatus, Request::get('emp_status'), ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Source of Income</label>
                                        {{ Form::select('source_income', ['' => 'Please Select'] + $sourceIncome, Request::get('source_income'), ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Initial Investment</label>
                                        {{ Form::select('initial_amt', ['' => 'Please Select'] + $incomeData, Request::get('initial_amt'), ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="formrow-firstname-input" class="d-block">&nbsp;</label>
                                    <button type="submit" class="btn btn-success w-md">Submit</button>
                                    <a href="{{ route('leads.index') }}" class="btn btn-danger w-md">Reset</a>
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

                    @can('client_create')
                        <div class="d-flex flex-wrap gap-2 mb-4 justify-content-md-end">
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('leads.create') }}"
                                role="button">Add New Lead</a>
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('export.leads') }}"
                                role="button">Export</a>
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('import.leads.view') }}"
                                role="button">Import</a>
                        </div>
                    @endcan
                    @if (count($aLeads))
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 70px;">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Country</th>
                                        <th scope="col">Created At</th>
                                        @can('client_status')
                                            <th scope="col">Status</th>
                                        @endcan
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($aLeads as $key => $lead)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $lead->first_name }} {{ $lead->last_name }}</td>
                                            <td>{{ $lead->email }}</td>
                                            <td>{{ $lead->contact ? $lead->contact : '---------' }}</td>
                                            <td>{{ isset($lead->country) ? $lead->country : '-------' }}</td>
                                            <td>{{ date('d-m-Y', strtotime($lead->created_at)) }}</td>
                                            <td>
                                                <span
                                                    class="btn btn-{{ CustomHelper::$getClientBadge[$lead->status] }} waves-effect waves-light">{{ CustomHelper::$getClientStatus[$lead->status] }}</span>
                                            </td>
                                            <td>
                                                <ul class="list-inline font-size-20 contact-links mb-0">
                                                    @can('admin_staff_edit')
                                                        <li class="list-inline-item ">
                                                            @php
                                                                $key = 'Overview';
                                                            @endphp
                                                            <a href="{{ url('lead') }}/{{ $lead->id }}/{{ $key }}"
                                                                title="View Lead">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item ">
                                                            <a href="{{ route('leads.edit', $lead->id) }}" title="Edit User">
                                                                <i class="bx bx bx-edit-alt"></i>
                                                            </a>
                                                        </li>
                                                    @endcan
                                                    @can('admin_staff_destroy')
                                                        <li class="list-inline-item ">
                                                            <a title="Delete User" href="javascript:void(0);"
                                                                onclick="jQuery('#delete-form-{{ $lead->id }}').submit();">
                                                                <i class="bx bx-trash-alt"></i>
                                                            </a>
                                                            <form id="delete-form-{{ $lead->id }}"
                                                                onsubmit="return confirm('Are you sure to delete?');"
                                                                action="{{ route('leads.destroy', $lead->id) }}"
                                                                method="post" style="display: none;">
                                                                {{ method_field('DELETE') }}
                                                                {{ csrf_field() }}
                                                            </form>
                                                        </li>
                                                    @endcan
                                                    @can('client_status')
                                                        <li class="list-inline-item">
                                                            @if ($lead->status == CustomHelper::CLIENT)
                                                                {{ Form::select('status', ['' => 'Please Select'] + $cStatus, $lead ? $lead->status : null, ['id' => 'clientStatus', 'data-target' => $lead->id, 'class' => 'form-control clientStatus', 'disabled' => 'disabled']) }}
                                                            @else
                                                                {{ Form::select('status', ['' => 'Please Select'] + $cStatus, $lead ? $lead->status : null, ['id' => 'clientStatus', 'data-target' => $lead->id, 'class' => 'form-control clientStatus']) }}
                                                            @endif
                                                        </li>
                                                    @endcan
                                                    @if ($lead->status == CustomHelper::KYCAPPROVED)
                                                        <li class="list-inline-item" id="makeClient">
                                                            <!-- Button trigger modal -->
                                                            <button type="button"
                                                                class="btn btn-primary waves-effect waves-light"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#myModal{{ $lead->id }}">Make
                                                                Client</button>

                                                            <!-- Modal -->
                                                            <div id="myModal{{ $lead->id }}" class="modal fade"
                                                                tabindex="-1" aria-labelledby="myModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <form action="{{ route('makeClientUser') }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="myModalLabel">
                                                                                    Make Client</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class="col-lg-6">
                                                                                        <div class="mb-3">
                                                                                            <input type="hidden"
                                                                                                name="dob"
                                                                                                value="{{ $lead->dob }}">
                                                                                            <input type="hidden"
                                                                                                name="lead_id"
                                                                                                value="{{ $lead->id }}">
                                                                                            <label
                                                                                                for="basicpill-firstname-input">First
                                                                                                Name</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                name="first_name"
                                                                                                value="{{ $lead->first_name }}"
                                                                                                id="basicpill-firstname-input"
                                                                                                placeholder="Enter Your First Name">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="mb-3">
                                                                                            <label
                                                                                                for="basicpill-lastname-input">Last
                                                                                                Name(Surname)</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                name="last_name"
                                                                                                value="{{ $lead->last_name }}"
                                                                                                id="basicpill-lastname-input"
                                                                                                placeholder="Enter Your Last Name">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="mb-3">
                                                                                        <label
                                                                                            for="basicpill-firstname-input">Email</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="email"
                                                                                            value="{{ $lead->email }}"
                                                                                            id="basicpill-firstname-input"
                                                                                            placeholder="Enter Your First Name">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-lg-6">
                                                                                        <div class="mb-3">
                                                                                            <label
                                                                                                for="basicpill-firstname-input">Password</label>
                                                                                            <input type="password"
                                                                                                class="form-control"
                                                                                                name="password"
                                                                                                id="basicpill-firstname-input">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="mb-3">
                                                                                            <label
                                                                                                for="basicpill-firstname-input">Confirm
                                                                                                Password</label>
                                                                                            <input type="password"
                                                                                                class="form-control"
                                                                                                name="password_confirmation"
                                                                                                id="basicpill-firstname-input">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary waves-effect"
                                                                                    data-bs-dismiss="modal">Close</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary waves-effect waves-light">Save
                                                                                    changes</button>
                                                                            </div>
                                                                        </div><!-- /.modal-content -->
                                                                    </form>
                                                                </div><!-- /.modal-dialog -->
                                                            </div>
                                                        </li>
                                                    @endif
                                                    @if ($lead->status == CustomHelper::CLIENT)
                                                        <li class="list-inline-item">
                                                            <!-- Button trigger modal -->
                                                            <button type="button"
                                                                class="btn btn-primary waves-effect waves-light"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#myModalClient{{ $lead->id }}">
                                                                Client Details</button>

                                                            <!-- Modal -->
                                                            <div id="myModalClient{{ $lead->id }}" class="modal fade"
                                                                tabindex="-1" aria-labelledby="myModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="myModalLabel">
                                                                                Client Details</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-lg-6">
                                                                                    <div class="mb-3">
                                                                                        <label
                                                                                            for="basicpill-firstname-input">First
                                                                                            Name</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="first_name"
                                                                                            value="{{ $lead->first_name }}"
                                                                                            id="basicpill-firstname-input"
                                                                                            placeholder="Enter Your First Name"
                                                                                            readonly>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    <div class="mb-3">
                                                                                        <label
                                                                                            for="basicpill-lastname-input">Last
                                                                                            Name</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="last_name"
                                                                                            value="{{ $lead->last_name }}"
                                                                                            id="basicpill-lastname-input"
                                                                                            placeholder="Enter Your Last Name"
                                                                                            readonly>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <div class="mb-3">
                                                                                    <label
                                                                                        for="basicpill-firstname-input">Email</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="email"
                                                                                        value="{{ $lead->email }}"
                                                                                        id="basicpill-firstname-input"
                                                                                        placeholder="Enter Your First Name"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        {{-- <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary waves-effect"
                                                                                    data-bs-dismiss="modal">Close</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary waves-effect waves-light">Save
                                                                                    changes</button>
                                                                            </div> --}}
                                                                    </div><!-- /.modal-content -->
                                                                    </form>
                                                                </div><!-- /.modal-dialog -->
                                                            </div>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $aLeads->links('components.pagination') }}
                    @else
                        No data found
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.clientStatus').on('change', function() {
                // console.log
                var status = this.value;
                var id = $(this).data('target');
                console.log(status);
                $.ajax({
                    url: "{{ route('lead.changeStatus') }}",
                    type: "POST",
                    data: {
                        status: status,
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log();
                        if (response['status']) {
                            location.reload();
                        }
                    }
                });
            });
        });
    </script>
@endsection
