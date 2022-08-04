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
                        <label for="formrow-firstname-input" class="form-label">Site Name</label>
                        <input type="text" id="sitename" name="sitename" class="form-control{{ $errors->has('sitename') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['sitename'] : old('sitename') }}" placeholder="Site Name">
                        @if ($errors->has('sitename'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('sitename') }}</strong>
                            </span>
                        @endif
                    </div>
                    @if ($aRow)
                    <div class="mb-3">
                        <img src="{{ CustomHelper::displayImage($aRow['logo']) }}" class="img-fluid w-25">
                    </div>
                    @endif
                    <div class="mb-3">
                        <label for="formrow-inputCity" class="form-label">Logo or Icon</label>
                        <div class="input-group">
                            <input type="file" class="form-control{{ $errors->has('logo') ? ' is-invalid' : '' }} " id="logo" name="logo" autofocus="" {{ $aRow ? '' : 'required' }}>
                            <label class="input-group-text" for="logo">Upload</label>
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('logo') }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Login Title</label>
                        <input type="text" id="login_title" name="login_title" class="form-control{{ $errors->has('login_title') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['login_title'] : old('login_title') }}" placeholder="Email">
                        @if ($errors->has('login_title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('login_title') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">App Name</label>
                        <input type="text" id="appname" name="appname" class="form-control{{ $errors->has('appname') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['appname'] : old('appname') }}" placeholder="App Name">
                        @if ($errors->has('appname'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('appname') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">App Tagline</label>
                        <input type="text" id="apptagline" name="apptagline" class="form-control{{ $errors->has('apptagline') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['apptagline'] : old('apptagline') }}" placeholder="App Tag Line">
                        @if ($errors->has('apptagline'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('apptagline') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Site Author</label>
                        <input type="text" id="site_author" name="site_author" class="form-control{{ $errors->has('site_author') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['site_author'] : old('site_author') }}" placeholder="Site Author">
                        @if ($errors->has('site_author'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('site_author') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Site Keywords</label>
                        <input type="text" id="sitekeywords" name="sitekeywords" class="form-control{{ $errors->has('sitekeywords') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['sitekeywords'] : old('sitekeywords') }}" placeholder="Site Author">
                        @if ($errors->has('sitekeywords'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('sitekeywords') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Site Description</label>
                        <input type="text" id="sitedescription" name="sitedescription" class="form-control{{ $errors->has('sitedescription') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow['sitedescription'] : old('sitedescription') }}" placeholder="Site Author">
                        @if ($errors->has('sitedescription'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('sitedescription') }}</strong>
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
