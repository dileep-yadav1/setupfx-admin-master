@extends('layouts.master')

@section('title')
    @lang('translation.Message_List')
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
                            <a href="#" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Send</a>
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
                            @if ($messages)
                                @foreach ($messages as $key => $msg)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <a href="#">
                                                    <input type="checkbox" name="users" class="form-check-input">
                                                </a>
                                            </div>
                                            <div class="col-md-11">
                                                <a href="{{ route('messages.reply',$msg->id) }}">
                                                    <span>{{ $msg->name }}</span>
                                                </a><br>
                                                <span class="d-flex"><i class="fas fa-reply"></i> &nbsp;&nbsp;{!! $aRow->latest_msg !!}</span>
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
            <div class="card overflow-hidden">
                <div class="card-header">
                    <h5><i class="fas fa-info-circle"></i> An email will be sent to notify the user.</h5>
                </div>
                <div class="card-body">
                    <section>
                        <form action="{{ route('messages.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="basicpill-users-input">Users</label>
                                {{ Form::select('user_id', ['' => 'Please Select'] + $aUsers, $aRow ? $aRow->user_id : null, ['class' => 'form-control', 'required' => 'required']) }}
                            </div>
                            <div class="form-group mb-3">
                                <label for="basicpill-users-input">Message</label>
                                <textarea id="elm1" name="message"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="basicpill-users-input">Files</label>
                                <input type="file" class="form-control" name="files">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i>  Send</button>
                            </div>
                        </form>
                    </section>
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
