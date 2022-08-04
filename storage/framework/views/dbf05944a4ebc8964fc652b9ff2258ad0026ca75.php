<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.Lead_view'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Dashboard
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Lead View
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="overflow-hidden col-md-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <a href="<?php echo e(route('leads.index')); ?>" class="btn btn-primary waves-effect waves-light"><i
                        class="fas fa-caret-left"></i></a>
                </div>
                <div class="col-md-4 mlm-32">
                    <a href="<?php echo e(route('leads.edit', $id)); ?>" class="btn btn-primary waves-effect waves-light"><i
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
        <?php $SettingList = \CustomHelper::getStaffViewList() ?>
        <?php if($SettingList): ?>
            <?php $__currentLoopData = $SettingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="nav-item">
                    <a href="<?php echo e(url('/lead')); ?>/<?php echo e($aRow->id); ?>/<?php echo e($key); ?>"
                        class="d-flex nav-link <?php echo e($key == $viewName ? 'active' : ''); ?>">
                        <span><i
                                class="<?php echo e(CustomHelper::getStaffViewIcon($key)); ?>"></i>&nbsp;&nbsp;<?php echo e($value); ?></span>
                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content pt-5 text-muted">
        <div class="tab-pane active" id="overview" role="tabpanel">
            <div class="row">
                <div class="col-md-1">
                    <img src="<?php echo e(CustomHelper::getCompanyLogo(Auth::user()->admin_id)); ?>" alt="avatar"
                    class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                </div>
                <div class="col-md-11 mlm-80    ">
                    <div class="card-body">
                        <section class="mt-3">
                            <form action="<?php echo e(route('leadSendMail')); ?>" method="POST" enctype="multipart/form-data"
                                id="lead-form">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="basicpill-firstname-input">Email Type</label>
                                            <input type="hidden" name="lead_id" value="<?php echo e($aRow->id); ?>">
                                            <?php echo e(Form::select('emailtype', ['' => 'Please Select'] + $emailType, $email_type ? $email_type : null, ['id' => 'email_type', 'class' => 'form-control'])); ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="basicpill-firstname-input">Subject</label>
                                            <input type="text" name="subject" value="<?php echo e($aRow ? $aRow->subject : ''); ?>"
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
                                                <?php $__currentLoopData = $mailVariable; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variable): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <span id="copyStatus<?php echo e($variable->id); ?>"></span>
                                                    <input type="hidden" id="variableCopy<?php echo e($variable->id); ?>"
                                                        value="<?php echo e($variable->variable_key); ?>">
                                                    <button type="button"
                                                        onclick="copyVariable('variableCopy<?php echo e($variable->id); ?>')"
                                                        class="btn btn-secondary text-white"><?php echo e($variable->variable_key); ?>


                                                    </button>&nbsp;
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </span>
                                        </div>
                                        <div class="mb-3">
                                            <textarea id="taskdesc-editor" class="mt-3 emailMessage" rows="<?php echo e($aRow ? '20' : ''); ?>" name="message"><?php echo $message; ?></textarea>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('/assets/js/pages/form-editor.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/libs/apexcharts/apexcharts.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/js/pages/file-manager.init.js')); ?>"></script>
    <!-- form advanced init -->
    <script src="<?php echo e(URL::asset('/assets/js/pages/form-advanced.init.js')); ?>"></script>
    <!-- form wizard init -->
    <script src="<?php echo e(URL::asset('/assets/js/pages/form-wizard.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/libs/select2/select2.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/libs/datepicker/datepicker.min.js')); ?>"></script>


    <!-- Summernote js -->
    <script src="<?php echo e(URL::asset('/assets/libs/tinymce/tinymce.min.js')); ?>"></script>
    <!-- form repeater js -->
    <script src="<?php echo e(URL::asset('/assets/libs/jquery-repeater/jquery-repeater.min.js')); ?>"></script>

    <script src="<?php echo e(URL::asset('/assets/js/pages/task-create.init.js')); ?>"></script>

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
            var id = "<?php echo e($id); ?>";
            var key = "<?php echo e($viewName); ?>";
            if (type) {
                var url = '<?php echo e(url('/lead/:id/:key/:type')); ?>';
                url = url.replace(':id', id);
                url = url.replace(':key', key);
                url = url.replace(':type', type);
                // var url = }
                console.log(url);
                window.location = url;
            } else {
                var url = '<?php echo e(url('/lead/:id/:key/')); ?>';
                url = url.replace(':id', id);
                url = url.replace(':key', key);
                window.location = url;
            }

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/clients/Emails.blade.php ENDPATH**/ ?>