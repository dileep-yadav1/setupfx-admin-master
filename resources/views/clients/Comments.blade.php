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
                <div class="chat-leftsidebar me-lg-12 col-xl-12">
                    <ul class="list-unstyled">
                        @if (count($areply))
                            @foreach ($areply as $aKey => $aValue)
                                @if ($aValue->type == 1)
                                    <li class="d-flex mb-4">
                                        <img src="{{ CustomHelper::displayImage($aValue->avatar) }}" alt="avatar"
                                            class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
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
                                            class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                    <div class="mt-3">
                        <form action="{{ route('comments.saveleadreply') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-1">
                                    <img src="{{ CustomHelper::displayImage(Auth::user()->avatar) }}" alt="avatar"
                                        class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                                </div>
                                <div class="col-md-11 p-3">
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
