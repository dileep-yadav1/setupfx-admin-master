@extends('layouts.master')

@section('title')
    @lang('translation.Lead_view')
@endsection
@section('css')
    <style>
        .mlm-32{
            margin-left: -32px;
        }
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
            Lead View
        @endslot
    @endcomponent
    <div class="overflow-hidden col-md-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <a href="{{ route('leads.index') }}" class="btn btn-primary waves-effect waves-light"><i
                        class="fas fa-caret-left"></i></a>
                </div>
                <div class="col-md-4 mlm-32">
                    <a href="{{ route('leads.edit', $id) }}" class="btn btn-primary waves-effect waves-light"><i
                            class="fas fa-pen"></i>&nbsp;Update</a>
                </div>
                <div class="col-md-2 mlm-40">
                    <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal"
                        data-bs-target="#suspendModal"><i class="fas fa-trash"></i></button>

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
    <ul class="nav nav-tabs nav-tabs-custom nav-justified w-75" role="tablist">
        @php $SettingList = \CustomHelper::getStaffViewList() @endphp
        @if ($SettingList)
            @foreach ($SettingList as $key => $value)
                <li class="nav-item">
                    <a href="{{ url('/lead') }}/{{ $aRow->id }}/{{ $key }}"
                        class="d-flex nav-link {{ $key == $viewName ? 'active' : '' }}">
                        <span><i
                                class="{{ CustomHelper::getStaffViewIcon($key) }}"></i>&nbsp;&nbsp;{{ $value }}</span>
                    </a>
                </li>
            @endforeach
        @endif
    </ul>

    <!-- Tab panes -->
    <div class="tab-content pt-5 text-muted">
        <div class="tab-pane active" id="overview" role="tabpanel">
            <div class="d-lg-flex">
                <div class="chat-leftsidebar me-lg-4 col-xl-4">
                    {{-- Lead Details --}}
                    <div class="card">
                        <div class="card-header">
                            <h5>Overview</h5>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <label>Created At:- <b>{{ date('d-m-Y', strtotime($aRow->created_at)) }}</b></label><br>
                                <label>Stage:- <span
                                        class="text-danger">{{ CustomHelper::$getClientStatus[$aRow->status] }}</span></label><br>
                                <label>Lead Age:- <b>{{ $aRow->created_at->diffForHumans() }}</b></label><br>
                                <a href="{{ route('leads.edit', $aRow->id) }}" class="btn btn-primary"><i
                                        class="fas fa-pen"></i>&nbsp;Update</a>
                            </div>
                            <div class="container mt-4">
                                <h3>Lead Profile</h3>
                                <hr>
                                <div class="row mt-3">
                                    <label>NAME</label>
                                    <span>{{ $aRow->first_name }}&nbsp;{{ $aRow->last_name }}</span>
                                </div>
                                <div class="row mt-3">
                                    <label>E-MAIL</label>
                                    <span>{{ $aRow->email }} &nbsp;<span
                                            class="text-danger text-bold">{{ !$user->email_verified_at ? 'UnVerified' : 'UnVerified' }}</span></span>
                                </div>
                                <div class="row mt-3">
                                    <label>MOBILE</label>
                                    <span>{{ $aRow->contact ? $aRow->contact : '---------------' }}</span>
                                </div>
                                <div class="row mt-3">
                                    <label>COUNTRY</label>
                                    <span>{{ $aRow->country ? $aRow->country : '----------------' }}</span>
                                </div>
                                <div class="row mt-3">
                                    <label>REGISTRATION IP ADDRESS</label>
                                    <span>192.168.0.0.1</span>
                                </div>
                                <hr>
                                <div class="row mt-3">
                                    @if (!$user->email_verified_at)
                                        <a href="{{ route('sendVerificationMail', $aRow->id) }}"
                                            class="btn btn-primary"><i class="fas fa-envelope"></i>&nbsp;Send Verification
                                            Mail</a>
                                    @endif
                                </div>
                                <div class="row mt-3">
                                    @if ($aRow->status = 2)
                                        <a href="{{ route('sendDocumentMail',$aRow->id) }}" class="btn btn-primary"><i class="fas fa-envelope"></i>&nbsp;Send
                                            Doc Reminder</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Extar --}}
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5>Extra</h5>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                    {{-- Activity Feed --}}
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5>Activity Feed</h5>
                        </div>
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#lead" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">Lead</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#document" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Document</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#account" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Account</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#user" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">User</span>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="lead" role="tabpanel">
                                    @if ($activity)
                                        <div class="comment-list block m-sm">
                                            <div class="scrollable">
                                                <ul class="list-group">
                                                    @foreach ($activity as $key => $value)
                                                        @if ($value->activity_type == CustomHelper::ACTIVITYLEAD)
                                                            <li class="list-item mb-3">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <img src="{{ CustomHelper::getCompanyLogo(Auth::user()->admin_id) }}"
                                                                            class="img-thumbnail rounded-circle">
                                                                    </div>
                                                                    <div class="col-md-10 mt-2">
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
                                <div class="tab-pane" id="document" role="tabpanel">
                                    @if ($activity)
                                        <div class="comment-list block m-sm">
                                            <div class="scrollable">
                                                <ul class="list-group">
                                                    @foreach ($activity as $key => $value)
                                                        @if ($value->activity_type == CustomHelper::ACTIVITYDOCUMENT)
                                                            <li class="list-item mb-3">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <img src="{{ CustomHelper::getCompanyLogo(Auth::user()->admin_id) }}"
                                                                            class="img-thumbnail rounded-circle">
                                                                    </div>
                                                                    <div class="col-md-10 mt-2">
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
                                </div>
                                <div class="tab-pane" id="user" role="tabpanel">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chat-leftsidebar me-lg-8 col-xl-8">
                    <ul class="list-unstyled">
                        @if (count($areply))
                            @foreach ($areply as $aKey => $aValue)
                                @if ($aValue->type == 1)
                                    <li class="d-flex mb-4">
                                        <img src="{{ CustomHelper::displayImage($aValue->avatar) }}" alt="avatar"
                                            class="rounded-circle d-flex align-self-start me-3 shadow-1-strong"
                                            width="60">
                                        <div class="card">
                                            <div class="card-body w-1140">
                                                <div>
                                                    {!! $aValue->message !!}
                                                </div>
                                                <div class="d-flex justify-content-between p-3 mt-3">
                                                    <p class="fw-bold mb-0">{{ $aValue->name }}</p>
                                                    <a href="#" class="text-muted small text-primary mb-0"><i
                                                            class="fas fa-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @else
                                    <li class="d-flex justify-content-between mb-4">
                                        <div class="card w-100">
                                            <div class="card-body">
                                                <div>
                                                    {!! $aValue->message !!}
                                                </div>
                                                <div class="d-flex justify-content-between p-3 mt-3">
                                                    <p class="fw-bold mb-0">{{ $aValue->name }}</p>
                                                    <a href="#" class="text-muted small text-primary mb-0"><i
                                                            class="fas fa-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="{{ CustomHelper::displayImage($aValue->avatar) }}" alt="avatar"
                                            class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong"
                                            width="60">
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                    <div class="mt-3">
                        <form action="{{ route('comments.saveleadreply') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-1">
                                    <img src="{{ CustomHelper::displayImage(Auth::user()->avatar) }}" alt="avatar"
                                        class="rounded-circle d-flex align-self-start me-3 shadow-1-strong"
                                        width="60">
                                </div>
                                <div class="col-md-11 p-3">
                                    <input type="hidden" name="client_id" value="{{ $aRow->id }}">
                                    <textarea id="elm1" name="message"></textarea>
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="fas fa-paper-plane"></i>&nbsp;Send</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
    <script src="{{ URL::asset('/assets/libs/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-editor.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/file-manager.init.js') }}"></script>

    <script>
        tinyMCE.init({
            height: "480"
        });
    </script>
@endsection
