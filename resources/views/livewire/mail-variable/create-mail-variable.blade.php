@extends('layouts.master')

@section('title')
    @if ($aRow)
        Edit
    @else
        Add
    @endif Mail Variable
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('li_2')
            Mail Variable List
        @endslot
        @slot('title')
            @if ($aRow)
                Edit
            @else
                Add
            @endif Mail Variable
        @endslot
    @endcomponent

    <div class="row">

        <div class="col-xl-7">
            <div class="card">
                <div class="card-body">
                    @if ($aRow)
                        <form method="POST" action="{{ route('mail_variables.update', $aRow->id) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                        @else
                            <form method="POST" action="{{ route('mail_variables.store') }}" enctype="multipart/form-data">
                    @endif

                    @csrf
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Variable Key</label>
                        <input type="text" id="variable_key" name="variable_key"
                            class="form-control{{ $errors->has('variable_key') ? ' is-invalid' : '' }}"
                            value="{{ $aRow ? $aRow->variable_key : old('variable_key') }}" required
                            placeholder="variable key">
                        @if ($errors->has('variable_key'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('variable_key') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Variable Value</label>
                        <input type="test" id="variable_value" name="variable_value"
                            class="form-control{{ $errors->has('variable_value') ? ' is-invalid' : '' }}"
                            value="{{ $aRow ? $aRow->variable_value : old('variable_value') }}"
                            placeholder="variable value">
                        @if ($errors->has('variable_value'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('variable_value') }}</strong>
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
        <div class="col-xl-5">
            <div class="card">
                <div class="card-body">
                    <div class="text-muted">
                        Tip: Template variable keys must be unique and enclosed with two square brackets, <br />
                        <ul>
                            <li>for static variables use uppercase letters like [WEBSITE_URL]</li>
                            <li>for input variables use [INPUT:field_name] like [INPUT:name]</li>
                            <li>for dynamic data use [DYNAMIC:$data]</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
