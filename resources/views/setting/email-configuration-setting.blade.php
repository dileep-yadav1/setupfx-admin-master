@extends('layouts.master')

@section('title') {{ucfirst($settingName)}} Setting @endsection

@section('content')

    @include('layouts.setting_sidebar')
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <form method="POST"  action="{{ route('emailConfiguration.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">IMAP Driver</label>
                        <input type="text" id="driver" name="driver" class="form-control{{ $errors->has('driver') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['driver'] : old('driver') }}" placeholder="SMTP">
                        @if ($errors->has('driver'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('driver') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">IMAP Host</label>
                        <input type="text" id="host" name="host" class="form-control{{ $errors->has('host') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['host'] : old('host') }}" placeholder="IMAP Host">
                        @if ($errors->has('host'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('host') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Mail Port</label>
                        <input type="number" id="port" name="port" class="form-control{{ $errors->has('port') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['port'] : old('port') }}" placeholder="Mail Port Line">
                        @if ($errors->has('port'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('port') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Mail Encryption</label>
                        <input type="text" id="encryption" name="encryption" class="form-control{{ $errors->has('encryption') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['encryption'] : old('encryption') }}" placeholder="Mail Encryption">
                        @if ($errors->has('encryption'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('encryption') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">IMAP Username</label>
                        <input type="text" id="username" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['username'] : old('imap_username') }}" placeholder="IMAP Username">
                        @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="formrow-email-input" class="form-label">IMAP Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="IMAP Password">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Sender Name</label>
                        <input type="text" id="sender_name" name="sender_name" class="form-control{{ $errors->has('sender_name') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['sender_name'] : old('sender_name') }}" placeholder="Mail From Name">
                        @if ($errors->has('sender_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('sender_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Sender Mail</label>
                        <input type="text" id="sender_email" name="sender_email" class="form-control{{ $errors->has('sender_email') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['sender_email'] : old('Mail Mailer') }}" placeholder="Mail From Email Address">
                        @if ($errors->has('sender_email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('sender_email') }}</strong>
                            </span>
                        @endif
                    </div>
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
