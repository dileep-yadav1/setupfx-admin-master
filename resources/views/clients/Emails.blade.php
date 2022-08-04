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
            <div class="row">
                <div class="col-md-1">
                    <img src="{{ CustomHelper::getCompanyLogo(Auth::user()->admin_id) }}" alt="avatar"
                    class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                </div>
                <div class="col-md-11 mlm-80    ">
                    <div class="card-body">
                        <section class="mt-3">
                            <form action="{{ route('leadSendMail') }}" method="POST" enctype="multipart/form-data"
                                id="lead-form">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="basicpill-firstname-input">Email Type</label>
                                            <input type="hidden" name="lead_id" value="{{ $aRow->id }}">
                                            {{ Form::select('emailtype', ['' => 'Please Select'] + $emailType, $email_type ? $email_type : null, ['id' => 'email_type', 'class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="basicpill-firstname-input">Subject</label>
                                            <input type="text" name="subject" value="{{ $aRow ? $aRow->subject : '' }}"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div>
                                            <label for="formrow-email-input" class="form-label">Message</label>
                                        </div>
                                        <div class="mb-3">
                                            <span class="mb-4"><i class="bx bxs-info-circle"></i>You can use any of
                                                these
                                                predefined variables in your template
                                                @foreach ($mailVariable as $variable)
                                                    <span id="copyStatus{{ $variable->id }}"></span>
                                                    <input type="hidden" id="variableCopy{{ $variable->id }}"
                                                        value="{{ $variable->variable_key }}">
                                                    <button type="button"
                                                        onclick="copyVariable('variableCopy{{ $variable->id }}')"
                                                        class="btn btn-secondary text-white">{{ $variable->variable_key }}

                                                    </button>&nbsp;
                                                @endforeach
                                            </span>
                                        </div>
                                        <div class="mb-3">
                                            <textarea id="taskdesc-editor" class="mt-3 emailMessage" rows="{{ $aRow ? '20' : '' }}" name="message">{!! $message !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="basicpill-address-input">Attach File</label><br>
                                            <div class="col-md-12">
                                                <input type="file" name="mail_file" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3" id="sendDate" style="display: none">
                                    <div class="col-md-6">
                                        <input type="date" name="sent_date" id="sent_date" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <button type="button" class="btn btn-warning" id="sendLater"><i
                                                class="far fa-clock"></i> Send Later</button>
                                    </div>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <script>
        function copyVariable(elementId) {
            console.log(elementId);
            var copyText = document.getElementById(elementId);
            copyText.type = 'text';
            copyText.select();
            document.execCommand("copy");
            copyText.type = 'hidden';

        }
        $('#sendLater').on('click', function() {
            var sendDate = document.getElementById('sendDate');
            console.log(sendDate);
            sendDate.style = "display:flex";
            $('#sendDate').attr('required', 'required');
        });
        $('#email_type').on('change', function() {
            var type = $(this).val();
            console.log(type);
            var id = "{{ $id }}";
            var key = "{{ $viewName }}";
            if (type) {
                var url = '{{ url('/lead/:id/:key/:type') }}';
                url = url.replace(':id', id);
                url = url.replace(':key', key);
                url = url.replace(':type', type);
                // var url = }
                console.log(url);
                window.location = url;
            } else {
                var url = '{{ url('/lead/:id/:key/') }}';
                url = url.replace(':id', id);
                url = url.replace(':key', key);
                window.location = url;
            }

        });
    </script>
@endsection
