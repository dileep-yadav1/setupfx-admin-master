@extends('layouts.master')

@section('title')
    @lang('translation.Message_List')
@endsection
@section('css')
    <style>
        .w-1140 {
            width: 1140px;
        }
    </style>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Message List
        @endslot
    @endcomponent

    <div class="d-lg-flex">
        <div class="chat-leftsidebar me-lg-3 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>@lang('translation.Message')</h4>
                        </div>
                        <div class="col-md-6" style="text-align: end">
                            <a href="{{ route('messages.create') }}" class="btn btn-primary"><i
                                    class="fas fa-paper-plane"></i> Send</a>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="Start Typing..."
                                        name="search_user">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-info">Go</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="mt-4">
                        <ul class="list-group">
                            @if ($aRows)
                                @foreach ($aRows as $key => $aRow)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <a href="#">
                                                    <input type="checkbox" name="users" class="form-check-input">
                                                </a>
                                            </div>
                                            <div class="col-md-11">
                                                <a href="{{ route('messages.show', $aRow->id) }}">
                                                    <span>{{ $aRow->name }}</span>
                                                </a><br>
                                                <span class="d-flex"><i class="fas fa-reply"></i>
                                                    &nbsp;&nbsp;{!! $aRow->latest_msg !!}</span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat-leftsidebar me-lg-9 col-xl-9">
            <ul class="list-unstyled">
                @if (count($areply))
                    @foreach ($areply as $aKey => $aValue)
                        @if ($aValue->type == 0)
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
                <form action="{{ route('messages.savereply') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-1">
                            <img src="{{ CustomHelper::displayImage($aValue->avatar) }}" alt="avatar"
                                class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                        </div>
                        <div class="col-md-11 p-3">
                            <input type="hidden" name="message_id" value="{{ $message->id }}">
                            <textarea id="elm1" name="message"></textarea>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i>&nbsp;Send</button>
                            </div>
                        </div>
                    </div>
                </form>
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
