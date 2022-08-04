@extends('layouts.master')

@section('title')
    @if ($aRow)
        Edit
    @else
        Add
    @endif Client
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('li_2')
            Client List
        @endslot
        @slot('title')
            @if ($aRow)
                Edit
            @else
                Add
            @endif Client
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if ($aRow)
                        <form method="POST" action="{{ route('client.update', $aRow->id) }}" enctype="multipart/form-data"
                            id="ClientForm" name="ClientForm">
                            @method('PUT')
                        @else
                            <form method="POST" action="{{ route('client.store') }}" enctype="multipart/form-data"
                                id="ClientForm" name="ClientForm">
                    @endif
                    @csrf
                    <div id="vertical-example" class="vertical-wizard">
                        <!-- General Details -->
                        <h3>General Details</h3>
                        <section>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">First Name</label>
                                        <input type="text" class="form-control" name="first_name"
                                            value="{{ $aRow ? $aRow->first_name : '' }}" id="basicpill-firstname-input"
                                            placeholder="Enter Your First Name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-lastname-input">Last Name(Surname)</label>
                                        <input type="text" class="form-control" name="last_name"
                                            value="{{ $aRow ? $aRow->last_name : '' }}" id="basicpill-lastname-input"
                                            placeholder="Enter Your Last Name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-phoneno-input">Phone</label>
                                        <input type="text" class="form-control" name="contact"
                                            id="basicpill-phoneno-input" value="{{ $aRow ? $aRow->contact : '' }}"
                                            placeholder="Enter Your Phone No.">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-email-input">Email</label>
                                        <input type="email" class="form-control" name="email" id="basicpill-email-input"
                                            value="{{ $aRow ? $aRow->email : '' }}" placeholder="Enter Your Email ID">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-email-input">Country</label>
                                        <input type="textl" class="form-control" name="country" id="basicpill-email-input"
                                            value="{{ $aRow ? $aRow->country : '' }}" placeholder="Enter Your Email ID">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-email-input" class="form-label">Password</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            placeholder="Password">
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-password-input" class="form-label">Confirm Password</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" autocomplete="new-password"
                                            placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row" --}}
                        </section>
                        <!-- Director Details -->
                        <h3>Personal Details</h3>
                        <section>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-lastname-input">Company Name</label>
                                        <input type="text" class="form-control" name="company_name"
                                            value="{{ $aRow ? $aRow->company_name : '' }}" id="basicpill-lastname-input"
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
                                            <select class="form-control" name="state" id="state-dropdown">
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
                                            <select class="form-control" name="city" id="city-dropdown">
                                                <option>Please Select... </option>
                                            </select>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="basicpill-address-input">Zipcode</label>
                                        <input type="text" class="form-control" id="basicpill-email-input"
                                            name="zipcode" placeholder="110072"
                                            value="{{ $aRow ? $aRow->zipcode : '' }}">
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Company Document -->
                        <h3>Financial Details</h3>
                        <section>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-networth-input">Total Estimated Net Worth (<i class="fas fa-rupee-sign"></i>)?</label>
                                        {{ Form::select('net_worth', ['' => 'Please Select'] + $incomeData, $aRow ? $aRow->net_worth : null, ['class' => 'form-control', 'required' => 'required']) }}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-networth-input">Total Estimated Annual Income (<i class="fas fa-rupee-sign"></i>)?</label>
                                        {{ Form::select('annual_income', ['' => 'Please Select'] + $incomeData, $aRow ? $aRow->annual_income : null, ['class' => 'form-control', 'required' => 'required']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-networth-input">Your Employment Status</label>
                                        {{ Form::select('emp_status', ['' => 'Please Select'] + $empStatus, $aRow ? $aRow->emp_status : null, ['class' => 'form-control', 'required' => 'required']) }}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-networth-input">Source Of Income/Wealth</label>
                                        {{ Form::select('source_income', ['' => 'Please Select'] + $sourceIncome, $aRow ? $aRow->source_income : null, ['class' => 'form-control', 'required' => 'required']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="basicpill-networth-input">FOREX, CFDS And Other Instruments</label>
                                        {{ Form::select('invest_known', ['' => 'Please Select'] + $expStatus, $aRow ? $aRow->invest_known : null, ['class' => 'form-control', 'required' => 'required']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="basicpill-networth-input">Trading products are suitable as part of my
                                            investment objectives and I am able to assess the risk involved in trading them,
                                            including the possibility that I may lose all of my capital</label>
                                        {{ Form::select('objective_exp', ['' => 'Please Select'] + $expStatus, $aRow ? $aRow->objective_exp : null, ['class' => 'form-control', 'required' => 'required']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="basicpill-networth-input">I have previous professional qualifications and/or work experience in the financial services industry</label>
                                        {{ Form::select('previous_exp', ['' => 'Please Select'] + $expStatus, $aRow ? $aRow->previous_exp : null, ['class' => 'form-control', 'required' => 'required']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="basicpill-networth-input">Expected initial amount of Investment in Rupees(<i class="fas fa-rupee-sign"></i>) ?</label>
                                        {{ Form::select('initial_amt', ['' => 'Please Select'] + $incomeData, $aRow ? $aRow->initial_amt : null, ['class' => 'form-control', 'required' => 'required']) }}
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
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
@endsection
