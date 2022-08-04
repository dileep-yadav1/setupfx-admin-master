@extends('layouts.master')

@section('title')
    @lang('translation.Profile')
@endsection

@section('css')
<style>
     .ekyc-fright{
            float: right;
        }
</style>
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css">
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Contacts
        @endslot
        @slot('title')
            Profile
        @endslot
    @endcomponent

    <div class="row">
        @if (Auth::user()->role_id == config('constant.CLIENT_ROLE'))
            <div class="col-xl-3">
                <div class="card overflow-hidden">
                    <div class="bg-primary bg-soft">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-3">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p>It will seem like simplified</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="{{ URL::asset('/assets/images/profile-img.png') }}" alt=""
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <img src="{{ CustomHelper::displayImage(Auth::user()->avatar) }}" alt=""
                                        class="img-thumbnail rounded-circle">
                                </div>
                                <h5 class="font-size-15 text-truncate">{{ Auth::user()->name }}</h5>
                                <p class="text-muted mb-0 text-truncate">UI/UX Designer</p>
                            </div>

                            <div class="col-sm-8">
                                <div class="pt-4">

                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="font-size-15">125</h5>
                                            <p class="text-muted mb-0">Projects</p>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="font-size-15">$1245</h5>
                                            <p class="text-muted mb-0">Revenue</p>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <a href="" class="btn btn-primary waves-effect waves-light btn-sm">View
                                            Profile
                                            <i class="mdi mdi-arrow-right ms-1"></i></a>
                                        <a href="" class="btn btn-primary waves-effect waves-light btn-sm"
                                            data-bs-toggle="modal" data-bs-target=".update-profile">Quick Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Personal Information</h4>

                        <p class="text-muted mb-4">Hi I'm Cynthia Price,has been the industry's standard dummy text To an
                            English person, it will seem like simplified English, as a skeptical Cambridge.</p>
                        <div class="table-responsive">
                            <table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Full Name :</th>
                                        <td>{{ Auth::user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Birthdate :</th>
                                        <td>{{ date('d-m-Y', strtotime(Auth::user()->dob)) }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">E-mail :</th>
                                        <td>{{ Auth::user()->email }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Location :</th>
                                        <td>California, United States</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-5">Experience</h4>
                        <div class="">
                            <ul class="verti-timeline list-unstyled">
                                <li class="event-list active">
                                    <div class="event-timeline-dot">
                                        <i class="bx bx-right-arrow-circle bx-fade-right"></i>
                                    </div>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <i class="bx bx-server h4 text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div>
                                                <h5 class="font-size-15"><a href="javascript: void(0);"
                                                        class="text-dark">Back
                                                        end Developer</a></h5>
                                                <span class="text-primary">2016 - 19</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="event-list">
                                    <div class="event-timeline-dot">
                                        <i class="bx bx-right-arrow-circle"></i>
                                    </div>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <i class="bx bx-code h4 text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div>
                                                <h5 class="font-size-15"><a href="javascript: void(0);"
                                                        class="text-dark">Front
                                                        end Developer</a></h5>
                                                <span class="text-primary">2013 - 16</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="event-list">
                                    <div class="event-timeline-dot">
                                        <i class="bx bx-right-arrow-circle"></i>
                                    </div>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <i class="bx bx-edit h4 text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div>
                                                <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark">UI
                                                        /UX
                                                        Designer</a></h5>
                                                <span class="text-primary">2011 - 13</span>

                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <!-- end card -->
            </div>
            <div class="col-xl-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Profile</h4>
                                @php
                                    $id = Auth::user()->client_id;
                                @endphp
                                <form action="{{ route('updateLeadProfile', $id) }}" enctype="multipart/form-data"
                                    method="POST" id="ClientForm" name="ClientForm">
                                    @csrf
                                    <div id="basic-example">
                                        <!-- General Details -->
                                        <h3>General Details</h3>
                                        <section>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="basicpill-firstname-input">First Name</label>
                                                        <input type="text" class="form-control" name="first_name"
                                                            value="{{ $aRow ? $aRow->first_name : '' }}"
                                                            id="basicpill-firstname-input"
                                                            placeholder="Enter Your First Name">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="basicpill-lastname-input">Last Name(Surname)</label>
                                                        <input type="text" class="form-control" name="last_name"
                                                            value="{{ $aRow ? $aRow->last_name : '' }}"
                                                            id="basicpill-lastname-input"
                                                            placeholder="Enter Your Last Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="basicpill-phoneno-input">Phone</label>
                                                        <input type="text" class="form-control" name="contact"
                                                            id="basicpill-phoneno-input"
                                                            value="{{ $aRow ? $aRow->contact : '' }}"
                                                            placeholder="Enter Your Phone No.">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="basicpill-email-input">Email</label>
                                                        <input type="email" class="form-control" name="email"
                                                            id="basicpill-email-input"
                                                            value="{{ $aRow ? $aRow->email : '' }}"
                                                            placeholder="Enter Your Email ID">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="basicpill-email-input">Country</label>
                                                        <input type="textl" class="form-control" name="country"
                                                            id="basicpill-email-input"
                                                            value="{{ $aRow ? $aRow->country : '' }}"
                                                            placeholder="Enter Your Email ID">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="formrow-email-input"
                                                            class="form-label">Password</label>
                                                        <input id="password" type="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            name="password" placeholder="Password">
                                                        @if ($errors->has('password'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="formrow-password-input" class="form-label">Confirm
                                                            Password</label>
                                                        <input id="password-confirm" type="password" class="form-control"
                                                            name="password_confirmation" autocomplete="new-password"
                                                            placeholder="Confirm Password">
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="row" --}}
                                        </section>

                                        <!-- Personal Document -->
                                        <h3>Personal Document</h3>
                                        <section>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="basicpill-lastname-input">Company Name</label>
                                                        <input type="text" class="form-control" name="company_name"
                                                            value="{{ $aRow ? $aRow->company_name : '' }}"
                                                            id="basicpill-lastname-input"
                                                            placeholder="Enter Your Company Name">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="basicpill-address-input">Date of Birth</label>
                                                        <input type="date" name="date_of_birth" class="form-control"
                                                            id="basicpill-email-input" placeholder="Enter Your Email ID"
                                                            value="{{ $aRow ? date('Y-m-d', strtotime($aRow->dob)) : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="basicpill-address-input">Nationality</label>
                                                        {{ Form::select('nationality', ['' => 'Please Select'] + $aCountry, $aRow ? $aRow->nationality : null, ['class' => 'form-control', 'required' => 'required']) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="basicpill-address-input">Address 1</label>
                                                        <textarea id="basicpill-address-input" class="form-control" name="address_1" rows="2"
                                                            placeholder="Enter Your Address">{{ $aRow ? $aRow->address_1 : '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="basicpill-address-input">Address 2</label>
                                                        <textarea id="basicpill-address-input" class="form-control" name="address_2" rows="2"
                                                            placeholder="Enter Your Address">{{ $aRow ? $aRow->address_2 : '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="basicpill-address-input">Country</label>
                                                        {{ Form::select('country', ['' => 'Please Select'] + $aCountry, $aRow ? $aRow->country : null, ['id' => 'country-dropdown', 'class' => 'form-control', 'required' => 'required']) }}
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="basicpill-address-input">State</label>
                                                        @if ($aRow)
                                                            {{ Form::select('state', ['' => 'Please Select'] + $aState, $aRow ? $aRow->state : null, ['id' => 'state-dropdown', 'class' => 'form-control', 'required' => 'required']) }}
                                                        @else
                                                            <select class="form-control" name="state"
                                                                id="state-dropdown">
                                                                <option>Please Select... </option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="basicpill-address-input">City</label>
                                                        @if ($aRow)
                                                            {{ Form::select('city', ['' => 'Please Select'] + $aCity, $aRow ? $aRow->city : null, ['id' => 'city-dropdown', 'class' => 'form-control', 'required' => 'required']) }}
                                                        @else
                                                            <select class="form-control" name="city"
                                                                id="city-dropdown">
                                                                <option>Please Select... </option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="basicpill-address-input">Zipcode</label>
                                                        <input type="text" class="form-control"
                                                            id="basicpill-email-input" name="zipcode"
                                                            placeholder="110072"
                                                            value="{{ $aRow ? $aRow->zipcode : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </section>

                                        <!-- Financial Details -->
                                        <h3>Financial Details</h3>
                                        <section>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="basicpill-networth-input">Total Estimated Net Worth (<i
                                                                class="fas fa-rupee-sign"></i>)?</label>
                                                        {{ Form::select('net_worth', ['' => 'Please Select'] + $incomeData, $aRow ? $aRow->net_worth : null, ['class' => 'form-control', 'required' => 'required']) }}
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="basicpill-networth-input">Total Estimated Annual Income
                                                            (<i class="fas fa-rupee-sign"></i>)?</label>
                                                        {{ Form::select('annual_income', ['' => 'Please Select'] + $incomeData, $aRow ? $aRow->annual_income : null, ['class' => 'form-control', 'required' => 'required']) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="basicpill-networth-input">Your Employment
                                                            Status</label>
                                                        {{ Form::select('emp_status', ['' => 'Please Select'] + $empStatus, $aRow ? $aRow->emp_status : null, ['class' => 'form-control', 'required' => 'required']) }}
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="basicpill-networth-input">Source Of
                                                            Income/Wealth</label>
                                                        {{ Form::select('source_income', ['' => 'Please Select'] + $sourceIncome, $aRow ? $aRow->source_income : null, ['class' => 'form-control', 'required' => 'required']) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="basicpill-networth-input">FOREX, CFDS And Other
                                                            Instruments</label>
                                                        {{ Form::select('invest_known', ['' => 'Please Select'] + $expStatus, $aRow ? $aRow->invest_known : null, ['class' => 'form-control', 'required' => 'required']) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="basicpill-networth-input">Trading products are suitable
                                                            as part of my
                                                            investment objectives and I am able to assess the risk involved
                                                            in trading them,
                                                            including the possibility that I may lose all of my
                                                            capital</label>
                                                        {{ Form::select('objective_exp', ['' => 'Please Select'] + $expStatus, $aRow ? $aRow->objective_exp : null, ['class' => 'form-control', 'required' => 'required']) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="basicpill-networth-input">I have previous professional
                                                            qualifications and/or work experience in the financial services
                                                            industry</label>
                                                        {{ Form::select('previous_exp', ['' => 'Please Select'] + $expStatus, $aRow ? $aRow->previous_exp : null, ['class' => 'form-control', 'required' => 'required']) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="basicpill-networth-input">Expected initial amount of
                                                            Investment in Rupees(<i class="fas fa-rupee-sign"></i>)
                                                            ?</label>
                                                        {{ Form::select('initial_amt', ['' => 'Please Select'] + $incomeData, $aRow ? $aRow->initial_amt : null, ['class' => 'form-control', 'required' => 'required']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </form>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <div class="tab-pane active" id="overview" role="tabpanel">
                    <div class="d-lg-flex mb-2 bbd-2 pt-3">
                        <div class="chat-leftsidebar me-lg-12 col-xl-12 mb-3 text-end">
                            <!-- Large modal button -->
                            <button type="button" class="btn btn-primary waves-effect" data-bs-toggle="modal"
                                data-bs-target=".bs-example-modal-lg"><i
                                    class="fas fa-cloud-download-alt"></i>&nbsp;&nbsp;Upload
                                Files</button>
                            <!--  Large modal example -->
                            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <form action="{{ route('uploadLeadFiles') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel">
                                                    Upload File</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <h6 class="col-md-2 mt-2">Title</h6>
                                                    <input type="hidden" value="{{ $aRow->id }}" name="client_id">
                                                    <div class="col-md-10">
                                                        {{ Form::select('doc_type', ['' => 'Please Select'] + $docType, null, ['class' => 'form-control', 'required' => 'required']) }}
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <h6 class="col-md-2 mt-2">Description</h6>
                                                    <div class="col-md-10">
                                                        <textarea class="form-control" rows="8" name="description"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <h6 class="col-md-2 mt-2">Front Side</h6>
                                                    <div class="col-md-10">
                                                        <input type="file" name="front_side" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <h6 class="col-md-2 mt-2">Back Side</h6>
                                                    <div class="col-md-10">
                                                        <input type="file" name="back_side" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary waves-effect"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light">Save
                                                    changes</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </form>
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                        </div>
                    </div>
                    <div class="d-lg-flex mb-2 pt-3">
                        <div class="col-md-12">
                            @if ($eKyc)
                                @foreach ($eKyc as $key => $kyc)
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-1"><i
                                                                class="fas fa-file-image fa-3x text-danger pull-left m-xs"></i>
                                                        </div>
                                                        <div class="col-md-11">
                                                            <h4>{{ CustomHelper::getLeadDocumentType($kyc->doc_type) }}
                                                            </h4>
                                                            <p class="text-primary">
                                                                @if ($kyc->front_side)
                                                                    <a href="{{ CustomHelper::displayImage($kyc->front_side) }}"
                                                                        target="_blank">Front Side</a>
                                                                @endif
                                                                <b> | </b>
                                                                @if ($kyc->back_side)
                                                                    <a href="{{ CustomHelper::displayImage($kyc->back_side) }}"
                                                                        target="_blank">Back Side</a>
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="text-end">
                                                        <label
                                                            class="mt-3">{{ $kyc->created_at->diffForHumans() }}</label>
                                                    </div>
                                                    <div class="ekyc-fright">
                                                        <div class="d-flex flex-wrap gap-2">
                                                            <p>
                                                                {{ $kyc->front_side }} <b> | </b> {{ $kyc->back_side }}
                                                            </p>
                                                            @if ($kyc->front_side)
                                                                <a href="{{ CustomHelper::displayImage($kyc->front_side) }}"
                                                                    class="btn btn-success waves-effect"
                                                                    download="download">Front
                                                                    Download</a>
                                                            @endif
                                                            @if ($kyc->back_side)
                                                                <a href="{{ CustomHelper::displayImage($kyc->back_side) }}"
                                                                    class="btn btn-success waves-effect"
                                                                    download="download">Back
                                                                    Download</a>
                                                            @endif
                                                            <a href="#"
                                                                class="btn btn-warning waves-effect">Pending</a>
                                                            <a href="{{ route('deleteUploadDoc', $kyc->id) }}"
                                                                class="btn btn-danger waves-effect">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-xl-4">
                <div class="card overflow-hidden">
                    <div class="bg-primary bg-soft">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-3">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p>It will seem like simplified</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="{{ URL::asset('/assets/images/profile-img.png') }}" alt=""
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <img src="{{ CustomHelper::displayImage(Auth::user()->avatar) }}" alt=""
                                        class="img-thumbnail rounded-circle">
                                </div>
                                <h5 class="font-size-15 text-truncate">{{ Auth::user()->name }}</h5>
                                <p class="text-muted mb-0 text-truncate">UI/UX Designer</p>
                            </div>

                            <div class="col-sm-8">
                                <div class="pt-4">

                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="font-size-15">125</h5>
                                            <p class="text-muted mb-0">Projects</p>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="font-size-15">$1245</h5>
                                            <p class="text-muted mb-0">Revenue</p>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <a href="" class="btn btn-primary waves-effect waves-light btn-sm">View
                                            Profile
                                            <i class="mdi mdi-arrow-right ms-1"></i></a>
                                        <a href="" class="btn btn-primary waves-effect waves-light btn-sm"
                                            data-bs-toggle="modal" data-bs-target=".update-profile">Edit Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Personal Information</h4>

                        <p class="text-muted mb-4">Hi I'm Cynthia Price,has been the industry's standard dummy text To an
                            English person, it will seem like simplified English, as a skeptical Cambridge.</p>
                        <div class="table-responsive">
                            <table class="table table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Full Name :</th>
                                        <td>{{ Auth::user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Birthdate :</th>
                                        <td>{{ date('d-m-Y', strtotime(Auth::user()->dob)) }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">E-mail :</th>
                                        <td>{{ Auth::user()->email }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Location :</th>
                                        <td>California, United States</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-5">Experience</h4>
                        <div class="">
                            <ul class="verti-timeline list-unstyled">
                                <li class="event-list active">
                                    <div class="event-timeline-dot">
                                        <i class="bx bx-right-arrow-circle bx-fade-right"></i>
                                    </div>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <i class="bx bx-server h4 text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div>
                                                <h5 class="font-size-15"><a href="javascript: void(0);"
                                                        class="text-dark">Back
                                                        end Developer</a></h5>
                                                <span class="text-primary">2016 - 19</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="event-list">
                                    <div class="event-timeline-dot">
                                        <i class="bx bx-right-arrow-circle"></i>
                                    </div>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <i class="bx bx-code h4 text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div>
                                                <h5 class="font-size-15"><a href="javascript: void(0);"
                                                        class="text-dark">Front
                                                        end Developer</a></h5>
                                                <span class="text-primary">2013 - 16</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="event-list">
                                    <div class="event-timeline-dot">
                                        <i class="bx bx-right-arrow-circle"></i>
                                    </div>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <i class="bx bx-edit h4 text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div>
                                                <h5 class="font-size-15"><a href="javascript: void(0);"
                                                        class="text-dark">UI /UX
                                                        Designer</a></h5>
                                                <span class="text-primary">2011 - 13</span>

                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <!-- end card -->
            </div>
            <div class="col-xl-8">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium mb-2">Completed Projects</p>
                                        <h4 class="mb-0">125</h4>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                            <span class="avatar-title">
                                                <i class="bx bx-check-circle font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium mb-2">Pending Projects</p>
                                        <h4 class="mb-0">12</h4>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                            <span class="avatar-title">
                                                <i class="bx bx-hourglass font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium mb-2">Total Revenue</p>
                                        <h4 class="mb-0">$36,524</h4>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="avatar-sm mini-stat-icon rounded-circle bg-primary">
                                            <span class="avatar-title">
                                                <i class="bx bx-package font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Revenue</h4>
                        <div id="revenue-chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">My Projects</h4>
                        <div class="table-responsive">
                            <table class="table table-nowrap table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Projects</th>
                                        <th scope="col">Start Date</th>
                                        <th scope="col">Deadline</th>
                                        <th scope="col">Budget</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Skote admin UI</td>
                                        <td>2 Sep, 2019</td>
                                        <td>20 Oct, 2019</td>
                                        <td>$506</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Skote admin Logo</td>
                                        <td>1 Sep, 2019</td>
                                        <td>2 Sep, 2019</td>
                                        <td>$94</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Redesign - Landing page</td>
                                        <td>21 Sep, 2019</td>
                                        <td>29 Sep, 2019</td>
                                        <td>$156</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>App Landing UI</td>
                                        <td>29 Sep, 2019</td>
                                        <td>04 Oct, 2019</td>
                                        <td>$122</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">5</th>
                                        <td>Blog Template</td>
                                        <td>05 Oct, 2019</td>
                                        <td>16 Oct, 2019</td>
                                        <td>$164</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">6</th>
                                        <td>Redesign - Multipurpose Landing</td>
                                        <td>17 Oct, 2019</td>
                                        <td>05 Nov, 2019</td>
                                        <td>$192</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">7</th>
                                        <td>Logo Branding</td>
                                        <td>04 Nov, 2019</td>
                                        <td>05 Nov, 2019</td>
                                        <td>$94</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <!-- end row -->

    <!--  Update Profile example -->
    <div class="modal fade update-profile" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" id="update-profile">
                        @csrf
                        <input type="hidden" value="{{ Auth::user()->id }}" id="data_id">
                        <div class="mb-3">
                            <label for="useremail" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="useremail" value="{{ Auth::user()->email }}" name="email"
                                placeholder="Enter email" autofocus>
                            <div class="text-danger" id="emailError" data-ajax-feedback="email"></div>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ Auth::user()->name }}" id="username" name="name" autofocus
                                placeholder="Enter username">
                            <div class="text-danger" id="nameError" data-ajax-feedback="name"></div>
                        </div>

                        <div class="mb-3">
                            <label for="userdob">Date of Birth</label>
                            <div class="input-group" id="datepicker1">
                                <input type="text" class="form-control @error('dob') is-invalid @enderror"
                                    placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy"
                                    data-date-container='#datepicker1' data-date-end-date="0d"
                                    value="{{ Auth::user()->dob ? date('d-m-Y', strtotime(Auth::user()->dob)) : '' }}"
                                    data-provide="datepicker" name="dob" autofocus id="dob">
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                            <div class="text-danger" id="dobError" data-ajax-feedback="dob"></div>
                        </div>

                        <div class="mb-3">
                            <label for="avatar">Profile Picture</label>
                            <div class="input-group">
                                <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                                    id="avatar" name="avatar" autofocus>
                                <label class="input-group-text" for="avatar">Upload</label>
                            </div>
                            <div class="text-start mt-2">
                                <img src="{{ CustomHelper::displayImage(Auth::user()->avatar) }}" alt=""
                                    class="rounded-circle avatar-lg">
                            </div>
                            <div class="text-danger" role="alert" id="avatarError" data-ajax-feedback="avatar"></div>
                        </div>

                        <div class="mt-3 d-grid">
                            <button class="btn btn-primary waves-effect waves-light UpdateProfile"
                                data-id="{{ Auth::user()->id }}" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('script')
    <!-- jquery step -->
    <script src="{{ URL::asset('/assets/libs/jquery-steps/jquery-steps.min.js') }}"></script>
    <!-- form wizard init -->
    <script src="{{ URL::asset('/assets/js/pages/form-wizard.init.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#country-dropdown').on('change', function() {
                var country_id = this.value;
                $("#state-dropdown").html('');
                $.ajax({
                    url: "{{ url('get-states-by-country') }}",
                    type: "POST",
                    data: {
                        country_id: country_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#state-dropdown').html('<option value="">Select State</option>');
                        $.each(result.states, function(key, value) {
                            $("#state-dropdown").append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                        $('#city-dropdown').html(
                            '<option value="">Select State First</option>');
                    }
                });
            });
            $('#state-dropdown').on('change', function() {
                var state_id = this.value;
                $("#city-dropdown").html('');
                $.ajax({
                    url: "{{ url('get-cities-by-state') }}",
                    type: "POST",
                    data: {
                        state_id: state_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#city-dropdown').html('<option value="">Select City</option>');
                        $.each(result.cities, function(key, value) {
                            $("#city-dropdown").append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    <!-- profile init -->
    <script src="{{ URL::asset('/assets/js/pages/profile.init.js') }}"></script>

    <script>
        $('#update-profile').on('submit', function(event) {
            event.preventDefault();
            var Id = $('#data_id').val();
            let formData = new FormData(this);
            $('#emailError').text('');
            $('#nameError').text('');
            $('#dobError').text('');
            $('#avatarError').text('');
            $.ajax({
                url: "{{ url('update-profile') }}" + "/" + Id,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#emailError').text('');
                    $('#nameError').text('');
                    $('#dobError').text('');
                    $('#avatarError').text('');
                    if (response.isSuccess == false) {
                        alert(response.Message);
                    } else if (response.isSuccess == true) {
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    }
                },
                error: function(response) {
                    // console.log(response);
                    $('#emailError').text(response.responseJSON.errors.email);
                    $('#nameError').text(response.responseJSON.errors.name);
                    $('#dobError').text(response.responseJSON.errors.dob);
                    $('#avatarError').text(response.responseJSON.errors.avatar);
                }
            });
        });
    </script>
@endsection
