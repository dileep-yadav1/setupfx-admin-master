@extends('layouts.master-without-nav')

@section('title')
    @lang('translation.Register')
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('body')

    <body>
    @endsection

    @section('content')

        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-primary bg-soft">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Register As Client</h5>
                                            {{-- <p>Get your free Skote account now.</p> --}}
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{ URL::asset('/assets/images/profile-img.png') }}" alt=""
                                            class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div>
                                    <a href="index">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{ CustomHelper::getCompanyLogo($id) }}" alt=""
                                                    class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2">
                                    <form method="POST" class="form-horizontal" action="{{ route('storeClientRegister',$id) }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="hidden" name="admin_id" value="{{ $id }}">
                                                    <label for="username" class="form-label">First Name</label>
                                                <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                                value="{{ old('first_name') }}" id="username" name="first_name" autofocus required
                                                    placeholder="Enter First Name">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="username" class="form-label">Last Name</label>
                                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                                value="{{ old('last_name') }}" id="username" name="last_name" autofocus required
                                                    placeholder="Enter Last Name">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="useremail"
                                            value="{{ old('email') }}" name="email" placeholder="Enter email" autofocus required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="userpassword" class="form-label">Password</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="userpassword" name="password"
                                                placeholder="Enter password" autofocus required>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="confirmpassword" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmpassword" name="password_confirmation"
                                            name="password_confirmation" placeholder="Enter Confirm password" autofocus required>
                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="userdob">Date of Birth</label>
                                            <div class="input-group" id="datepicker1">
                                                <input type="text" class="form-control @error('dob') is-invalid @enderror" placeholder="dd-mm-yyyy"
                                                    data-date-format="dd-mm-yyyy" data-date-container='#datepicker1' data-date-end-date="0d" value="{{ old('dob') }}"
                                                    data-provide="datepicker" name="dob" autofocus>
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                @error('dob')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="avatar">Profile Picture</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="inputGroupFile02" name="avatar" autofocus>
                                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                            </div>
                                            @error('avatar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mt-4 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light"
                                                type="submit">Register</button>
                                        </div>

                                        <div class="mt-4 text-center">
                                            <p class="mb-0">By registering you agree to the {{ CustomHelper::getThemeSetting($id) }} <a href="#"
                                                    class="text-primary">Terms of Use</a></p>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="mt-5 text-center">

                            <div>
                                <p>Already have an account ? <a href="{{ url('login') }}" class="fw-medium text-primary">
                                        Login</a> </p>
                                <p>© <script>
                                        document.write(new Date().getFullYear())

                                    </script> Skote. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    @endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endsection
