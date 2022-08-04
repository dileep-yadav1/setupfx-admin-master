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

        .comment-list {
            position: relative;
        }

        .m-sm {
            margin: 10px;
        }

        .block {
            display: block;
        }

        .comment-list:before {
            position: absolute;
            top: 0;
            bottom: 35px;
            left: 18px;
            width: 1px;
            background: #e0e4e8;
            content: '';
        }

        .scrollable {
            position: relative;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .bottom-border {
            border-bottom: 1px dotted #000000;
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
                                @method('PUT')
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
                                <form action="{{ route('staff.update', $aRow->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" name="name" value="{{ $aRow->name }}">
                                        <input type="hidden" name="email" value="{{ $aRow->email }}">
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
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-secondary waves-effect"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save
                                            changes</button>
                                    </div>
                                </form>
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
                                    <h5 class="modal-title" id="myModalLabel">Suspend User
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

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
                        <span><i
                                class="{{ CustomHelper::getUserViewIcon($key) }}"></i>&nbsp;&nbsp;{{ $value }}</span>
                    </a>
                </li>
            @endforeach
        @endif
    </ul>

    <!-- Tab panes -->
    <div class="tab-content p-3 text-muted">
        <div class="tab-pane active" id="overview" role="tabpanel">
            <div class="d-lg-flex">
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
                        <div class="card-header">
                            <h5>Activity Feed</h5>
                        </div>
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#user" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">User</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#client" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">Client</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#lead" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block">Lead</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#account" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Account</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#document" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Document</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#transaction" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Transaction</span>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="user" role="tabpanel">
                                    @if ($activity)
                                        <div class="comment-list block m-sm">
                                            <div class="scrollable">
                                                <ul class="list-group">
                                                    @foreach ($activity as $key => $value)
                                                        @if ($value->activity_type == CustomHelper::ACTIVITYUSER)
                                                            <li class="list-item mb-3">
                                                                <div class="row">
                                                                    <div class="col-md-1">
                                                                        <img src="{{ CustomHelper::getCompanyLogo(Auth::user()->admin_id) }}"
                                                                            class="img-thumbnail rounded-circle">
                                                                    </div>
                                                                    <div class="col-md-11 mt-2">
                                                                        <div class="row bottom-border">
                                                                            <span
                                                                                class="text-left col-md-6">{{ config('app.name') }}</span>
                                                                            <span
                                                                                class="text-end col-md-6">{{ date('d-m-y H:i:s', strtotime($value->created_at)) }}
                                                                        </div>
                                                                        <div>{{ $value->activity_msg }}</div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane" id="client" role="tabpanel">
                                    @if ($activity)
                                        <div class="comment-list block m-sm">
                                            <div class="scrollable">
                                                <ul class="list-group">
                                                    @foreach ($activity as $key => $value)
                                                        @if ($value->activity_type == CustomHelper::ACTIVITYCLIENT)
                                                            <li class="list-item mb-3">
                                                                <div class="row">
                                                                    <div class="col-md-1">
                                                                        <img src="{{ CustomHelper::getCompanyLogo(Auth::user()->admin_id) }}"
                                                                            class="img-thumbnail rounded-circle">
                                                                    </div>
                                                                    <div class="col-md-11 mt-2">
                                                                        <div class="row bottom-border">
                                                                            <span
                                                                                class="text-left col-md-6">{{ config('app.name') }}</span>
                                                                            <span
                                                                                class="text-end col-md-6">{{ date('d-m-y H:i:s', strtotime($value->created_at)) }}
                                                                        </div>
                                                                        <div>{{ $value->activity_msg }}</div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane" id="lead" role="tabpanel">
                                    @if ($activity)
                                        <div class="comment-list block m-sm">
                                            <div class="scrollable">
                                                <ul class="list-group">
                                                    @foreach ($activity as $key => $value)
                                                        @if ($value->activity_type == CustomHelper::ACTIVITYLEAD)
                                                            <li class="list-item mb-3">
                                                                <div class="row">
                                                                    <div class="col-md-1">
                                                                        <img src="{{ CustomHelper::getCompanyLogo(Auth::user()->admin_id) }}"
                                                                            class="img-thumbnail rounded-circle">
                                                                    </div>
                                                                    <div class="col-md-11 mt-2">
                                                                        <div class="row bottom-border">
                                                                            <span
                                                                                class="text-left col-md-6">{{ config('app.name') }}</span>
                                                                            <span
                                                                                class="text-end col-md-6">{{ date('d-m-y H:i:s', strtotime($value->created_at)) }}
                                                                        </div>
                                                                        <div>{{ $value->activity_msg }}</div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane" id="account" role="tabpanel">
                                    @if ($account)
                                        <div class="comment-list block m-sm">
                                            <div class="scrollable">
                                                <ul class="list-group">
                                                    @foreach ($account as $key => $value)
                                                        <li class="list-item mb-3">
                                                            <div class="row">
                                                                <div class="col-md-1">
                                                                    <img src="{{ CustomHelper::getCompanyLogo(Auth::user()->admin_id) }}"
                                                                        class="img-thumbnail rounded-circle">
                                                                </div>
                                                                <div class="col-md-11 mt-2">
                                                                    <div class="row bottom-border">
                                                                        <span
                                                                            class="text-left col-md-6">{{ config('app.name') }}</span>
                                                                        <span
                                                                            class="text-end col-md-6">{{ date('d-m-y H:i:s', strtotime($value->created_at)) }}
                                                                    </div>
                                                                    <div>{{ $value->activity_msg }}</div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane" id="document" role="tabpanel">
                                </div>
                                <div class="tab-pane" id="transaction" role="tabpanel">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="profile1" role="tabpanel">
            <p class="mb-0">
                Food truck fixie locavore, accusamus mcsweeney's marfa nulla
                single-origin coffee squid. Exercitation +1 labore velit, blog
                sartorial PBR leggings next level wes anderson artisan four loko
                farm-to-table craft beer twee. Qui photo booth letterpress,
                commodo enim craft beer mlkshk aliquip jean shorts ullamco ad
                vinyl cillum PBR. Homo nostrud organic, assumenda labore
                aesthetic magna delectus.
            </p>
        </div>
        <div class="tab-pane" id="messages1" role="tabpanel">
            <p class="mb-0">
                Etsy mixtape wayfarers, ethical wes anderson tofu before they
                sold out mcsweeney's organic lomo retro fanny pack lo-fi
                farm-to-table readymade. Messenger bag gentrify pitchfork
                tattooed craft beer, iphone skateboard locavore carles etsy
                salvia banksy hoodie helvetica. DIY synth PBR banksy irony.
                Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh
                mi whatever gluten-free carles.
            </p>
        </div>
        <div class="tab-pane" id="settings1" role="tabpanel">
            <p class="mb-0">
                Trust fund seitan letterpress, keytar raw denim keffiyeh etsy
                art party before they sold out master cleanse gluten-free squid
                scenester freegan cosby sweater. Fanny pack portland seitan DIY,
                art party locavore wolf cliche high life echo park Austin. Cred
                vinyl keffiyeh DIY salvia PBR, banh mi before they sold out
                farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral,
                mustache readymade keffiyeh craft.
            </p>
        </div>
    </div>
@endsection
@section('script')
@endsection
