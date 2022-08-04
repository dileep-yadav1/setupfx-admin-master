<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.Chat'); ?>
<?php $__env->stopSection(); ?>
<?php
use App\Models\Client;
?>
<?php $__env->startSection('css'); ?>
    <style>
        .left-margin-10 {
            margin-left: 10px !important;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="d-lg-flex">
        <div class="chat-leftsidebar me-lg-3 col-xl-3">
            <div class="card overflow-hidden">
                <div class="bg-primary bg-soft">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-3">
                                <h5 class="text-primary"><?php echo e($aRow->full_name); ?></h5>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="<?php echo e(asset('assets/images/profile-img.png')); ?>" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="avatar-md profile-user-wid mb-4">
                                <img src="<?php echo e(asset('assets/images/users/avatar-1.jpg')); ?>" alt=""
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
                                    <h4><?php echo e($aRow->email); ?></h4>
                                    <h5><span class="text-dark mt-2">Contact: </span></h5>
                                    <h4><?php echo e($aRow->phone); ?></h4>
                                </div>
                                
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
                                            <h5 class="font-size-13 text-truncate">Sales Agent</h5>
                                        </div>
                                    </div>
                                    <div class="ms-2 pt-4">
                                        <?php echo e(CustomHelper::getsalesAgentName($aRow->sales_agent)); ?>

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
                                            <h5 class="font-size-13 text-truncate">Company Name</h5>
                                        </div>
                                    </div>
                                    <div class="ms-2 pt-4">
                                        <?php echo e($aRow->company_name); ?>

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
                                        <?php echo e($aRow->company_email); ?>

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
                                        <?php echo e($aRow->tags); ?>

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
                            <?php $SettingList = \CustomHelper::getContactMarketingList() ?>
                            <?php if($SettingList): ?>
                                <?php $__currentLoopData = $SettingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(url('/contact')); ?>/<?php echo e($aRow->id); ?>/<?php echo e($key); ?>"
                                            class="d-flex nav-link <?php echo e($key == $marketingName ? 'active' : ''); ?>">
                                            <span><i class="fas fa-envelope-open"></i></span>
                                            <span class="left-margin-10"><?php echo e($value); ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <section class="mt-3">
                        <form action="<?php echo e(route('conversationStore')); ?>" method="POST" enctype="multipart/form-data"
                            id="lead-form">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Email Type</label>
                                        <input type="hidden" name="contact_id" value="<?php echo e($aRow->id); ?>">
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
                                        <span class="mb-4"><i class="bx bxs-info-circle"></i>You can use any of these
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
    <!-- end row -->
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
            var id = "<?php echo e($id); ?>";
            var key = "<?php echo e($marketingName); ?>";
            if (type) {
                var url = '<?php echo e(url('/contact/:id/:key/:type')); ?>';
                url = url.replace(':id', id);
                url = url.replace(':key', key);
                url = url.replace(':type', type);
                // var url = }
                // console.log(tt);
                window.location = url;
            } else {
                url = url.replace(':id', id);
                url = url.replace(':key', key);
                window.location = url;
            }

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/contacts/conversations.blade.php ENDPATH**/ ?>