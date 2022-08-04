@extends('layouts.master')

@section('title')
    @lang('translation.Import_Leads')
@endsection

@section('css')
    <!-- Plugins css -->
    <link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Leads
        @endslot
        @slot('title')
            Import Leads
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Import Leads</h4>
                    {{-- <p class="card-title-desc">DropzoneJS is an open source library
                        that provides drag’n’drop file uploads with image previews.
                    </p> --}}

                    <div>
                        <form action="{{ route('import.leads') }}" id="UploadLead-form" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            {{-- <div class="fallback"> --}}
                                <input name="file" type="file">
                            {{-- </div> --}}
                            {{-- <div class="dz-message needsclick"> --}}
                                {{-- <div class="mb-3"> --}}
                                    {{-- <i class="display-4 text-muted bx bxs-cloud-upload"></i> --}}
                                {{-- </div> --}}

                                {{-- <h4>Drop files here or click to upload.</h4> --}}
                            </div>
                        </form>
                    </div>
                    <div class="text-center mt-4">
                        <a class="btn btn-primary waves-effect waves-light" href="{{ route('import.leads') }}"
                            onclick="event.preventDefault();document.getElementById('UploadLead-form').submit();"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Import Lead
                        </a>
                        {{-- <button type="submit">Import Lead</button> --}}
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
@section('script')
    <!-- Plugins js -->
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
@endsection
