@extends('layouts.master')

@section('title')
    @lang('translation.Chat')
@endsection
@php
use App\Models\Client;
@endphp
@section('css')
    <style>
        .left-margin-10 {
            margin-left: 10px !important;
        }
    </style>
@endsection
@section('content')

    @component('components.breadcrumb')
        @slot('li_1')
        @endslot
        @slot('title')
        @endslot
    @endcomponent

    <div class="d-lg-flex">
        <div class="chat-leftsidebar me-lg-3 col-xl-3">
            <div class="card overflow-hidden">
                <div class="bg-primary bg-soft">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-3">
                                <h5 class="text-primary">{{ $aRow->full_name }}</h5>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="{{ asset('assets/images/profile-img.png') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="avatar-md profile-user-wid mb-4">
                                <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt=""
                                    class="img-thumbnail rounded-circle">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="text-muted mb-0">Comments</p>
                                        <h5 class="waves-effect waves-light">0</h5>
                                    </div>
                                    <div class="col-6">
                                        <p class="text-muted mb-0">Activity</p>
                                        <h5 class="waves-effect waves-light">0</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <h5><span class="text-dark mt-2">Email: </span></h5>
                                    <h4>{{ $aRow->email }}</h4>
                                    <h5><span class="text-dark mt-2">Contact: </span></h5>
                                    <h4>{{ $aRow->phone }}</h4>
                                </div>
                                {{-- <div class="mt-4">
                                <a href="" class="btn btn-primary waves-effect waves-light btn-sm">View Profile <i class="mdi mdi-arrow-right ms-1"></i></a>
                            </div> --}}
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

                                        <div class="overflow-hidden me-auto mt-2">
                                            <h5 class="font-size-13 text-truncate">Company Name</h5>
                                        </div>
                                    </div>
                                    <div class="ms-2 pt-4">
                                        {{ $aRow->company_name }}
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

                                        <div class="overflow-hidden me-auto mt-2">
                                            <h5 class="font-size-13 text-truncate">Company Email</h5>
                                        </div>
                                    </div>
                                    <div class="ms-2 pt-4">
                                        {{ $aRow->company_email }}
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

                                        <div class="overflow-hidden me-auto mt-2">
                                            <h5 class="font-size-13 text-truncate">Tags</h5>
                                        </div>
                                    </div>
                                    <div class="ms-2 pt-4">
                                        {{ $aRow->tags }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-100 user-chat">
            <div class="card">
                <div class="card-body">
                    <div>
                        <ul class="nav nav-tabs nav-tabs-custom nav-justified w-25" role="tablist">
                            @php $SettingList = \CustomHelper::getContactMarketingList() @endphp
                            @if ($SettingList)
                                @foreach ($SettingList as $key => $value)
                                    <li class="nav-item">
                                        <a href="{{ url('/contact') }}/{{ $aRow->id }}/{{ $key }}"
                                            class="d-flex nav-link {{ $key == $marketingName ? 'active' : '' }}">
                                            <span><i class="fas fa-envelope-open"></i></span>
                                            <span class="left-margin-10">{{ $value }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
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
    <!-- end row -->
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/js/pages/form-editor.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/file-manager.init.js') }}"></script>
    <!-- form advanced init -->
    <script src="{{ URL::asset('/assets/js/pages/form-advanced.init.js') }}"></script>
    <!-- form wizard init -->
    <script src="{{ URL::asset('/assets/js/pages/form-wizard.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/datepicker/datepicker.min.js') }}"></script>


    <!-- Summernote js -->
    <script src="{{ URL::asset('/assets/libs/tinymce/tinymce.min.js') }}"></script>
    <!-- form repeater js -->
    <script src="{{ URL::asset('/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/task-create.init.js') }}"></script>

    <script>
        tinyMCE.init({
            height: "480"
        });
    </script>
@endsection
