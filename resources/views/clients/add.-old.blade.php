@extends('layouts.master')

@section('title')
    @if ($aRow)
        Edit
    @else
        Add
    @endif Lead
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('li_2')
            Lead List
        @endslot
        @slot('title')
            @if ($aRow)
                Edit
            @else
                Add
            @endif Lead
        @endslot
    @endcomponent

    <!-- start page title -->
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div id="basic-example">
                        <!-- Seller Details -->
                        <h3>General</h3>
                        <section>
                            @if ($aRow)
                                <form action="{{ route('leads.update', $aRow->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                @else
                                    <form action="{{ route('leads.store') }}" method="POST" enctype="multipart/form-data"
                                        id="lead-form">
                            @endif
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">First Name</label>
                                        <input type="text" class="form-control" name="first_name"
                                            value="{{ $aRow ? $aRow->first_name : '' }}" id="basicpill-firstname-input"
                                            placeholder="Enter Your First Name">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-lastname-input">Last Name(Surname)</label>
                                        <input type="text" class="form-control" name="last_name"
                                            value="{{ $aRow ? $aRow->last_name : '' }}" id="basicpill-lastname-input"
                                            placeholder="Enter Your Last Name">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-lastname-input">Company Name</label>
                                        <input type="text" class="form-control" name="company_name"
                                            value="{{ $aRow ? $aRow->company_name : '' }}" id="basicpill-lastname-input"
                                            placeholder="Enter Your Company Name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-phoneno-input">Phone</label>
                                        <input type="text" class="form-control" name="contact"
                                            id="basicpill-phoneno-input" value="{{ $aRow ? $aRow->contact : '' }}"
                                            placeholder="Enter Your Phone No.">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-email-input">Email</label>
                                        <input type="email" class="form-control" name="email" id="basicpill-email-input"
                                            value="{{ $aRow ? $aRow->email : '' }}" placeholder="Enter Your Email ID">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-address-input">Source</label>
                                        {{ Form::select('source', ['' => 'Please Select'] + $aSource, $aRow ? $aRow->source : null, ['class' => 'form-control', 'required' => 'required']) }}
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-address-input">Sales Agent</label>
                                        {{ Form::select('sales_agent', ['' => 'Please Select'] + $salesAgent, $aRow ? $aRow->sales_agent : null, ['class' => 'form-control', 'required' => 'required']) }}
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-address-input">Stage</label>
                                        {{ Form::select('stage_status', ['' => 'Please Select'] + $aStage, $aRow ? $aRow->stage_status : null, ['class' => 'form-control', 'required' => 'required']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-address-input">Lead Score (In % Ex.50)</label>
                                        <input type="text" class="form-control" name="lead_score" min="10"
                                            id="basicpill-email-input" placeholder="10"
                                            value="{{ $aRow ? $aRow->lead_score : '' }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-address-input">Lead Value</label>
                                        <input type="text" class="form-control" name="lead_value"
                                            id="basicpill-email-input" placeholder="0.00"
                                            value="{{ $aRow ? $aRow->lead_value : '' }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-address-input">Timezones</label>
                                        {{ Form::select('timezone', ['' => 'Please Select'] + $aTimezone, $aRow ? $aRow->timezone : null, ['class' => 'form-control', 'required' => 'required']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-address-input">Tags</label>
                                        <input type="text" value="" data-role="tagsinput" name="tags"
                                            class="form-control" value="{{ $aRow ? $aRow->tags : '' }}"
                                            placeholder="Add tags" />
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

                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            </form>
                        </section>

                        <!-- Company Document -->
                        {{-- <h3>Company Document</h3>
                    <section>
                        <form>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-pancard-input">PAN Card</label>
 <input type="text" class="form-control" id="basicpill-pancard-input" placeholder="Enter Your PAN No." >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-vatno-input">VAT/TIN No.</label>
 <input type="text" class="form-control" id="basicpill-vatno-input" placeholder="Enter Your VAT/TIN No." >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-cstno-input">CST No.</label>
 <input type="text" class="form-control" id="basicpill-cstno-input" placeholder="Enter Your CST No." >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-servicetax-input">Service Tax No.</label>
 <input type="text" class="form-control" id="basicpill-servicetax-input" placeholder="Enter Your Service Tax No." >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-companyuin-input">Company UIN</label>
                                        <input type="text" class="form-control" id="basicpill-companyuin-input" placeholder="Enter Your Company UIN">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-declaration-input">Declaration</label>
                                        <input type="text" class="form-control" id="basicpill-Declaration-input" placeholder="Declaration Details">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>
                    <!-- Bank Details -->
                    <h3>Bank Details</h3>
                    <section>
                        <div>
                            <form>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-namecard-input">Name on Card</label>
                                            <input type="text" class="form-control" id="basicpill-namecard-input" placeholder="Enter Your Name on Card">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label>Credit Card Type</label>
                                            <select class="form-select">
                                                <option selected>Select Card Type</option>
                                                <option value="AE">American Express</option>
                                                <option value="VI">Visa</option>
                                                <option value="MC">MasterCard</option>
                                                <option value="DI">Discover</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-cardno-input">Credit Card Number</label>
                                            <input type="text" class="form-control" id="basicpill-cardno-input" placeholder="Credit Card Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-card-verification-input">Card Verification Number</label>
                                            <input type="text" class="form-control" id="basicpill-card-verification-input" placeholder="Credit Verification Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-expiration-input">Expiration Date</label>
                                            <input type="text" class="form-control" id="basicpill-expiration-input" placeholder="Card Expiration Date">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                    <!-- Confirm Details -->
                    <h3>Confirm Detail</h3>
                    <section>
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="text-center">
                                    <div class="mb-4">
                                        <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                    </div>
                                    <div>
                                        <h5>Confirm Detail</h5>
                                        <p class="text-muted">If several languages coalesce, the grammar of the resulting</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section> --}}
                    </div>

                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection
@section('script')
    <!-- form advanced init -->
    <script src="{{ URL::asset('/assets/js/pages/form-advanced.init.js') }}"></script>
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
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/datepicker/datepicker.min.js') }}"></script>

    <!-- form advanced init -->
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
@endsection
