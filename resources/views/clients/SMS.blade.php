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
                                        <a href="#" class="btn btn-primary"><i
                                                class="fas fa-envelope"></i>&nbsp;Send Verification Mail</a>
                                    @endif
                                </div>
                                <div class="row mt-3">
                                    @if ($aRow->status = 2)
                                        <a href="#" class="btn btn-primary"><i
                                                class="fas fa-envelope"></i>&nbsp;Send Doc Reminder</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chat-leftsidebar me-lg-8 col-xl-8">
                  <div class="card">
                      <div class="card-header">
                          <h6>SMS Messages from {{ Auth::user()->name }} (A text message can hold up to 160 characters.)</h6>
                      </div>
                      <div class="card-body">
                        <section class="mt-3">
                            @if ($aRow)
                                <form action="{{ route('email.update', $aRow->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                @else
                                    <form action="{{ route('email.store') }}" method="POST" enctype="multipart/form-data"
                                        id="lead-form">
                            @endif
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <textarea class="form-control" rows="8" name="message" placeholder="Enter the Message"></textarea>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            </form>
                        </section>
                      </div>
                  </div>
                </div>
            </div>
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
