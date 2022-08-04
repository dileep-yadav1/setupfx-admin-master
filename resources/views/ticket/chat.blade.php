@extends('layouts.master')

@section('title') @lang('translation.Chat') @endsection
@php
    use App\Models\Client;
@endphp
@section('content')

@component('components.breadcrumb')
@slot('li_1') Dashboard @endslot
@slot('title') Ticket List @endslot
@endcomponent

<div class="d-lg-flex">
    <div class="chat-leftsidebar me-lg-3 col-xl-3">
        <div class="card overflow-hidden">
            <div class="bg-primary bg-soft">
                <div class="row">
                    <div class="col-7">
                        <div class="text-primary p-3">
                            <h5 class="text-primary">{{ $aRow->subject }}</h5>
                        </div>
                    </div>
                    <div class="col-5 align-self-end">
                        <img src="{{ URL::asset('/assets/images/profile-img.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="avatar-md profile-user-wid mb-4">
                            <img src="{{ isset(Auth::user()->avatar) ? asset(Auth::user()->avatar) : asset('/assets/images/users/avatar-1.jpg') }}" alt="" class="img-thumbnail rounded-circle">
                        </div>
                        <h5 class="font-size-15 text-truncate">{{ Str::ucfirst($aRow->c_name) }}</h5>
                        <p class="mb-0 text-muted">{{ date("d-M-Y H:i:s a", strtotime($aRow->created_at)) }}</p>
                    </div>

                    <div class="col-sm-7">
                        <div class="pt-4">
                            <div class="row">
                                <div class="col-6">
                                    <p class="text-muted mb-0">Status</p>
                                    <h5 class="btn text-white waves-effect waves-light bg-{{ ($aRow->status == 0)? 'danger' : 'success' }}">{{ ($aRow->status == 0)? 'Pending' : 'Closed' }}</h5>
                                </div>
                                <div class="col-6">
                                    <p class="text-muted mb-0">Total Replies</p>
                                    <h5 class="font-size-15 text-center text-white bg-primary rounded p-1"><span class="">{{ count($areply) }}</span></h5>
                                </div>
                            </div>
                            {{--  <div class="mt-4">
                                <a href="" class="btn btn-primary waves-effect waves-light btn-sm">View Profile <i class="mdi mdi-arrow-right ms-1"></i></a>
                            </div>  --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card overflow-hidden">
            <div class="card-body">
                <div class="mt-4">
                    <div class="card border shadow-none mb-2">
                        <a href="javascript: void(0);" class="text-body">
                            <div class="p-2">
                                <div class="d-flex">
                                    <div class="avatar-xs align-self-center me-2">
                                        <div class="avatar-title rounded bg-transparent text-success font-size-20">
                                            <i class="mdi mdi-image"></i>
                                        </div>
                                    </div>

                                    <div class="overflow-hidden me-auto pt-4">
                                        <h5 class="font-size-13 text-truncate">Department</h5>
                                    </div>

                                    <div class="ms-2 pt-4">
                                        <p class="text-muted">{{ CustomHelper::getdepartmentName($aRow->department) }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="card border shadow-none mb-2">
                        <a href="javascript: void(0);" class="text-body">
                            <div class="p-2">
                                <div class="d-flex">
                                    <div class="avatar-xs align-self-center me-2">
                                        <div class="avatar-title rounded bg-transparent text-success font-size-20">
                                            <i class="mdi mdi-image"></i>
                                        </div>
                                    </div>

                                    <div class="overflow-hidden me-auto pt-4">
                                        <h5 class="font-size-13 text-truncate">Reporter</h5>
                                    </div>

                                    <div class="ms-2 pt-4">
                                        <p class="text-muted">{{ ($aRow->reporter != '')? Client::$getSalesAgent[$aRow->reporter] : '--' }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="card border shadow-none mb-2">
                        <a href="javascript: void(0);" class="text-body">
                            <div class="p-2">
                                <div class="d-flex">
                                    <div class="avatar-xs align-self-center me-2">
                                        <div class="avatar-title rounded bg-transparent text-success font-size-20">
                                            <i class="mdi mdi-image"></i>
                                        </div>
                                    </div>

                                    <div class="overflow-hidden me-auto pt-4">
                                        <h5 class="font-size-13 text-truncate">Tags</h5>
                                    </div>

                                    <div class="ms-2 pt-4">
                                        <p class="text-muted">{{ $aRow->tags }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    {{--  <div class="card border shadow-none mb-2">
                        <a href="javascript: void(0);" class="text-body">
                            <div class="p-2">
                                <div class="d-flex">
                                    <div class="avatar-xs align-self-center me-2">
                                        <div class="avatar-title rounded bg-transparent text-success font-size-20">
                                            <i class="mdi mdi-image"></i>
                                        </div>
                                    </div>

                                    <div class="overflow-hidden me-auto pt-4">
                                        <h5 class="font-size-13 text-truncate">File</h5>
                                    </div>

                                    <div class="ms-2 pt-4">
                                        <p class="text-muted">{{ $aRow->tags }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>  --}}
                </div>
            </div>
        </div>
    </div>
    <div class="w-100 user-chat">
        <div class="card">
            <div class="p-4 border-bottom ">
                <div class="row">
                    <div class="col-md-4 col-9">
                        <h5 class="font-size-15 mb-1">{{ Str::ucfirst($aRow->u_name) }}</h5>
                        <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i> Active now</p>
                    </div>
                    <div class="col-md-8 col-3">
                        <ul class="list-inline user-chat-nav text-end mb-0">
                            <li class="list-inline-item d-none d-sm-inline-block">
                                <div class="dropdown">
                                    <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-search-alt-2"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-md">
                                        <form class="p-3">
                                            <div class="form-group m-0">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">

                                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li class="list-inline-item  d-none d-sm-inline-block">
                                <div class="dropdown">
                                    <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-cog"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">View Profile</a>
                                        <a class="dropdown-item" href="#">Clear chat</a>
                                        <a class="dropdown-item" href="#">Muted</a>
                                        <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                </div>
                            </li>

                            <li class="list-inline-item">
                                <div class="dropdown">
                                    <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-horizontal-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else</a>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>


            <div>
                <div class="chat-conversation p-3" id="messages">
                    <ul class="list-unstyled mb-0" data-simplebar style="max-height: 486px;">
                        {{--  <li>
                            <div class="chat-day-title">
                                <span class="title">Today</span>
                            </div>
                        </li>  --}}
                        @if(count($areply))
                            @foreach($areply as $aKey => $aValue)
                            @if($aValue->type == 1)
                                <li class="{{ ($aKey == count($areply)-1)? 'chat-window' : '' }}">
                                    <div class="conversation-list">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Copy</a>
                                                <a class="dropdown-item" href="#">Save</a>
                                                <a class="dropdown-item" href="#">Forward</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                        <div class="ctext-wrap">
                                            <div class="conversation-name">{{ $aValue->name }}</div>
                                            <p>{!! $aValue->message !!}</p>
                                            <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> {{ $aValue->created_at }}</p>
                                        </div>
                                    </div>
                                </li>
                            @else
                                <li class="right {{ ($aKey == count($areply)-1)? 'chat-window' : '' }}">
                                    <div class="conversation-list">
                                        <div class="dropdown">

                                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Copy</a>
                                                <a class="dropdown-item" href="#">Save</a>
                                                <a class="dropdown-item" href="#">Forward</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                        <div class="ctext-wrap">
                                            <div class="conversation-name">{{ $aValue->name }}</div>
                                            <p>{!! $aValue->message !!}</p>

                                            <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> {{ $aValue->created_at }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @endforeach
                        @endif
                        <li id="chat-window"></li>
                    </ul>
                </div>
                @if($aRow->status == 0)
                <form action="{{ route('ticket.saveReply') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="p-3 chat-input-section">
                        <div class="row">
                            <div class="col-12">
                                <div class="position-relative">
                                    <input type="hidden" name="ticket_id" value="{{ $aRow->id }}">
                                    <textarea id="elm1" name="message"></textarea>
                                    {{--  <div class="chat-input-links" id="tooltip-container">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item"><a href="javascript: void(0);" title="Emoji"><i class="mdi mdi-emoticon-happy-outline"></i></a></li>
                                            <li class="list-inline-item"><a href="javascript: void(0);" title="Images"><i class="mdi mdi-file-image-outline"></i></a></li>
                                            <li class="list-inline-item"><a href="javascript: void(0);" title="Add Files"><i class="mdi mdi-file-document-outline"></i></a></li>
                                        </ul>
                                    </div>  --}}
                                </div>
                            </div>
                            <div class="col-auto mt-2">
                                <button type="submit" class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>

</div>
<!-- end row -->
@endsection
@section('script')
<script src="{{ URL::asset('/assets/libs/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/form-editor.init.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/file-manager.init.js') }}"></script>

<script>
    tinyMCE.init({
        height : "480"
    });
</script>
@endsection
