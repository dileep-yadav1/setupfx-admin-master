@extends('layouts.master')

@section('title')
    @if ($aRow)
        Edit
    @else
        Add
    @endif Contact
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('li_2')
            Contacts List
        @endslot
        @slot('title')
            @if ($aRow)
                Edit
            @else
                Add
            @endif Contact
        @endslot
    @endcomponent

    <div class="row">

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    @if ($aRow)
                        <form method="POST" action="{{ route('contact.update', $aRow->id) }}" enctype="multipart/form-data">
                            @method('PUT')
                        @else
                            <form method="POST" action="{{ route('contact.store') }}" enctype="multipart/form-data">
                    @endif

                    @csrf
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Full Name</label>
                        <input type="text" id="full_name" name="full_name" class="form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow->full_name : old('full_name') }}" required placeholder="Full Name">
                        @if ($errors->has('full_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('full_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    {{-- @php  $salesAgent = \CustomHelper::getsalesagents(); @endphp
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input">Sales Agent</label>
                                {{ Form::select('sales_agent', ['' => 'Please Select'] + $salesAgent, $aRow ? $aRow->sales_agent : null, ['class' => 'form-control', 'required' => 'required']) }}
                                @if ($errors->has('sales_agent'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sales_agent') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div> --}}
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">E-Mail</label>
                        <input type="email" id="email" name="email"
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            value="{{ $aRow ? $aRow->email : old('email') }}" required placeholder="E-Mail">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Company Name</label>
                        <input type="text" id="company_name" name="company_name"
                            class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}"
                            value="{{ $aRow ? $aRow->company_name : old('company_name') }}" required placeholder="Company Name">
                        @if ($errors->has('company_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('company_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Company Email</label>
                        <input type="email" id="company_email" name="company_email"
                            class="form-control{{ $errors->has('company_email') ? ' is-invalid' : '' }}"
                            value="{{ $aRow ? $aRow->company_email : old('company_email') }}" required placeholder="Company Email">
                        @if ($errors->has('company_email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('company_email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Phone</label>
                        <input type="text" id="phone" name="phone"
                            class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                            value="{{ $aRow ? $aRow->phone : old('phone') }}" required placeholder="Phone Number">
                        @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Tags</label>
                        <input type="text" id="tags" name="tags"
                            class="form-control{{ $errors->has('tags') ? ' is-invalid' : '' }}"
                            value="{{ $aRow ? $aRow->tags : old('tags') }}" required placeholder="Tags">
                        @if ($errors->has('tags'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('tags') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                    </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>

    </div>

@endsection
