@extends('layouts.master')

@section('title')
    @lang('translation.Staff')
@endsection
@section('css')
    <style>
        .mlm-40 {
            margin-left: -38px;
        }

        .mlm-80 {
            margin-left: -80px;
        }
    </style>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Staff
        @endslot
    @endcomponent
    <div class="overflow-hidden col-md-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                        data-bs-target="#updateModal"><i class="fas fa-pen"></i>&nbsp;Update</button>

                    <!-- sample modal content -->
                    <div id="updateModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('staff.update', $aRow->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel">User Update</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">Name</label>
                                            <input type="text" id="name" name="name"
                                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                value="{{ $aRow ? $aRow->name : old('name') }}" required
                                                placeholder="Name">
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
                                                value="{{ $aRow ? $aRow->email : old('email') }}" required
                                                placeholder="Email">
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

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="formrow-inputCity" class="form-label">Avatar</label>
                                                    <div class="input-group">
                                                        <input type="file" class="form-control " id="avatar"
                                                            name="avatar" autofocus="">
                                                        <label class="input-group-text" for="avatar">Upload</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                @if (isset($aRow->avatar) && $aRow->avatar)
                                                    <img class="avatar-md"
                                                        src="{{ \CustomHelper::displayImage($aRow->avatar, 'uploads/admin_staff') }}"
                                                        alt="">
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary waves-effect"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary waves-effect waves-light">Save
                                            changes</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </form>
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div>
                <div class="col-md-6 mlm-40">
                    <button type="button" class="btn btn-primary waves-effect" data-bs-toggle="modal"
                        data-bs-target="#permissionModal"><i class="fas fa-pen"></i>&nbsp;Permission</button>

                    <!--  Large modal example -->
                    <div class="modal fade bs-example-modal-lg" id="permissionModal" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myLargeModalLabel">Permission Modal
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @if (count($aPermissions))
                                        @foreach ($aPermissions as $aKey => $module)
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="formrow-inputCity"
                                                        class="form-label">{{ $module->module }}</label>
                                                    <div class="mb-3 row">
                                                        @foreach ($module->permissions as $pKey => $permission)
                                                            <div class="col-md-4">
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
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div>
                <div class="col-md-2 mlm-80">
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                        data-bs-target="#suspendModal"><i class="fas fa-thumbs-down"></i></button>

                    <!-- sample modal content -->
                    <div id="suspendModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Default Modal Heading
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5>Overflowing text to show scroll behavior</h5>
                                    <p>Cras mattis consectetur purus sit amet fermentum.
                                        Cras justo odio, dapibus ac facilisis in,
                                        egestas eget quam. Morbi leo risus, porta ac
                                        consectetur ac, vestibulum at eros.</p>
                                    <p>Praesent commodo cursus magna, vel scelerisque
                                        nisl consectetur et. Vivamus sagittis lacus vel
                                        augue laoreet rutrum faucibus dolor auctor.</p>
                                    <p>Aenean lacinia bibendum nulla sed consectetur.
                                        Praesent commodo cursus magna, vel scelerisque
                                        nisl consectetur et. Donec sed odio dui. Donec
                                        ullamcorper nulla non metus auctor
                                        fringilla.</p>
                                    <p>Cras mattis consectetur purus sit amet fermentum.
                                        Cras justo odio, dapibus ac facilisis in,
                                        egestas eget quam. Morbi leo risus, porta ac
                                        consectetur ac, vestibulum at eros.</p>
                                    <p>Praesent commodo cursus magna, vel scelerisque
                                        nisl consectetur et. Vivamus sagittis lacus vel
                                        augue laoreet rutrum faucibus dolor auctor.</p>
                                    <p>Aenean lacinia bibendum nulla sed consectetur.
                                        Praesent commodo cursus magna, vel scelerisque
                                        nisl consectetur et. Donec sed odio dui. Donec
                                        ullamcorper nulla non metus auctor
                                        fringilla.</p>
                                    <p>Cras mattis consectetur purus sit amet fermentum.
                                        Cras justo odio, dapibus ac facilisis in,
                                        egestas eget quam. Morbi leo risus, porta ac
                                        consectetur ac, vestibulum at eros.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary waves-effect"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary waves-effect waves-light">Save
                                        changes</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div>
            </div>
        </div>
    </div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-tabs-custom nav-justified w-50" role="tablist">
        @php $SettingList = \CustomHelper::getUserViewList() @endphp
        @if ($SettingList)
            @foreach ($SettingList as $key => $value)
                <li class="nav-item">
                    <a href="{{ url('/staff') }}/{{ $aRow->id }}/{{ $key }}"
                        class="d-flex nav-link {{ $key == $viewName ? 'active' : '' }}">
                        <span><i class="{{ CustomHelper::getUserViewIcon($key) }}"></i>&nbsp;&nbsp;{{ $value }}</span>
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
    <div class="d-lg-flex mt-4">
        <div class="chat-leftsidebar me-lg-3 col-xl-3">
            <div class="card overflow-hidden">
                <div class="bg-primary bg-soft">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-3">
                                <h5 class="text-primary">{{ $aRow->name }}</h5>
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
                        <div class="col-sm-5">
                            <div class="avatar-md profile-user-wid mb-4">
                                <img src="{{ CustomHelper::displayImage($aRow->avatar) }}" alt=""
                                    class="img-thumbnail rounded-circle">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row">
                            <h4>Name:-&nbsp;&nbsp;{{ $aRow->name }}</h4>
                        </div>
                        <div class="row">
                            <h4>Email:-&nbsp;&nbsp;{{ $aRow->email }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat-leftsidebar me-lg-9 col-xl-9">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <table class="table align-middle table-nowrap table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" style="width: 70px;">#</th>
                                <th scope="col">Message</th>
                                <th scope="col">Sent By</th>
                                <th scope="col">Sent Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($message)
                                @foreach ($message as $key => $msg)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{!! $msg->message !!}</td>
                                        <td>{{ $msg->reply_by }}</td>
                                        <td>{{ date('d M,Y',strtotime($msg->created_at)) }}</td>
                                    </tr>
                                @endforeach
                            @else
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
