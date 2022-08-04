@extends('layouts.master')

@section('title') Theme Setting @endsection

@section('content')
    @include('layouts.setting_sidebar')

    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <form method="POST"  action="{{ route('setting.store', $settingId) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Support Email</label>
                        <input type="email" id="support_email" name="support_email" class="form-control{{ $errors->has('support_email') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['support_email'] : old('support_email') }}" placeholder="Support Email">
                        @if ($errors->has('support_email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('support_email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Support Name</label>
                        <input type="text" id="support_name" name="support_name" class="form-control{{ $errors->has('support_name') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['support_name'] : old('support_name') }}" placeholder="Email">
                        @if ($errors->has('support_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('support_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Support Email</label>
                        <select id="support_email" name="support_email" class="form-control{{ $errors->has('support_email') ? ' is-invalid' : '' }}">
                            <option value="">--Select Support Email--</option>
                                @foreach (\CustomHelper::getdepartmentList() as $key => $item)
                                @php $selected = ''; @endphp
                                @if($aRow)
                                    @if($aRow['support_email'] == $key)
                                        @php $selected = 'selected'; @endphp
                                    @endif
                                @else
                                    @if(old('support_email') == $key)
                                        @php $selected = 'selected'; @endphp
                                    @endif
                                @endif
                                <option value="{{ $key }}" {{ $selected }}>{{ $item }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('support_email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('support_email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Auto Close Ticket</label>
                        <input type="number" id="auto_close_ticket" name="auto_close_ticket" class="form-control{{ $errors->has('auto_close_ticket') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['auto_close_ticket'] : old('auto_close_ticket') }}" placeholder="Auto Close Ticket">
                        @if ($errors->has('auto_close_ticket'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('auto_close_ticket') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Ticket Due Days</label>
                        <input type="number" id="ticket_due_days" name="ticket_due_days" class="form-control{{ $errors->has('ticket_due_days') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['ticket_due_days'] : old('ticket_due_days') }}" placeholder="Ticket Due Days">
                        @if ($errors->has('ticket_due_days'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('ticket_due_days') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Feedback Request</label>
                        <input type="text" id="feedback_request" name="feedback_request" class="form-control{{ $errors->has('feedback_request') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['feedback_request'] : old('feedback_request') }}" placeholder="Feedback Request">
                        @if ($errors->has('feedback_request'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('feedback_request') }}</strong>
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
