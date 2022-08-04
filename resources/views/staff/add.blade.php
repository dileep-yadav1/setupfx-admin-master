@extends('layouts.master')

@section('title')
    @if ($aRow)
        Edit
    @else
        Add
    @endif Staff
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('li_2')
            Staff List
        @endslot
        @slot('title')
            @if ($aRow)
                Edit
            @else
                Add
            @endif Staff
        @endslot
    @endcomponent

    <div class="row">

        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    @if ($aRow)
                        <form method="POST" action="{{ route('staff.update', $aRow->id) }}" enctype="multipart/form-data">
                            @method('PUT')
                        @else
                            <form method="POST" action="{{ route('staff.store') }}" enctype="multipart/form-data">
                    @endif

                    @csrf
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Name</label>
                        <input type="text" id="name" name="name"
                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                            value="{{ $aRow ? $aRow->name : old('name') }}" required placeholder="Name">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Email</label>
                        <input type="email" id="email" name="email"
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            value="{{ $aRow ? $aRow->email : old('email') }}" required placeholder="Email">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
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
                                    name="password_confirmation" autocomplete="new-password" placeholder="Confirm Password">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="formrow-inputCity" class="form-label">Avatar</label>
                                <div class="input-group">
                                    <input type="file" class="form-control " id="avatar" name="avatar" autofocus="">
                                    <label class="input-group-text" for="avatar">Upload</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            @if (isset($aRow->avatar) && $aRow->avatar)
                                <img class="avatar-md"
                                    src="{{ \CustomHelper::displayImage($aRow->avatar, 'uploads/admin_staff') }}" alt="">
                            @endif
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="formrow-inputCity" class="form-label">Permissions</label>
                            </div>
                        </div>
                        @if (count($aPermissions))
                            @foreach ($aPermissions as $aKey => $module)
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="formrow-inputCity"
                                            class="form-label">{{ $module->module }}</label>
                                        <div class="mb-3 d-flex flex-row">
                                            @foreach ($module->permissions as $pKey => $permission)
                                                <div class="mx-2">
                                                    @php
                                                        $check_permission = 0;
                                                        if ($aRow) {
                                                            $check_permission = CustomHelper::checkUserPermission($aRow->id, $permission->id);
                                                        }

                                                    @endphp
                                                    <input type="checkbox" name="permissions[]"
                                                        value="{{ $permission->id }}"
                                                        @if ($check_permission > 0) checked @endif />

                                                    {{ $permission->alias_name }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
