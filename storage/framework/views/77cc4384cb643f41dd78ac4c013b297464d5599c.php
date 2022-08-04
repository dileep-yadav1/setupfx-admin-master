<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.Lead_view'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <style>
        .ekyc-fright{
            float: right;
        }
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
    <div class="col-md-12 bbd-2">
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
    </div>

    <!-- Tab panes -->
    <div class="tab-content text-muted">
        <div class="tab-pane active" id="overview" role="tabpanel">
            <div class="d-lg-flex mb-2 bbd-2 pt-3">
                <div class="chat-leftsidebar me-lg-12 col-xl-12 mb-3 text-end">
                    <!-- Large modal button -->
                    <button type="button" class="btn btn-primary waves-effect" data-bs-toggle="modal"
                        data-bs-target=".bs-example-modal-lg"><i class="fas fa-cloud-download-alt"></i>&nbsp;&nbsp;Upload
                        Files</button>
                    <!--  Large modal example -->
                    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <form action="<?php echo e(route('uploadLeadFiles')); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel">
                                            Upload File</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <h6 class="col-md-2 mt-2">Title</h6>
                                            <input type="hidden" value="<?php echo e($aRow->id); ?>" name="client_id">
                                            <div class="col-md-10">
                                                <?php echo e(Form::select('doc_type', ['' => 'Please Select'] + $docType, null, ['class' => 'form-control', 'required' => 'required'])); ?>

                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <h6 class="col-md-2 mt-2">Description</h6>
                                            <div class="col-md-10">
                                                <textarea class="form-control" rows="8" name="description"></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <h6 class="col-md-2 mt-2">Front Side</h6>
                                            <div class="col-md-10">
                                                <input type="file" name="front_side" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <h6 class="col-md-2 mt-2">Back Side</h6>
                                            <div class="col-md-10">
                                                <input type="file" name="back_side" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary waves-effect"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save
                                            changes</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </form>
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                </div>
            </div>
            <div class="d-lg-flex mb-2 pt-3">
                <div class="col-md-12">
                    <?php if($eKyc): ?>
                        <?php $__currentLoopData = $eKyc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $kyc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-1"><i
                                                        class="fas fa-file-image fa-3x text-danger pull-left m-xs"></i>
                                                </div>
                                                <div class="col-md-11">
                                                    <h4><?php echo e(CustomHelper::getLeadDocumentType($kyc->doc_type)); ?></h4>
                                                    <p class="text-primary">
                                                        <?php if($kyc->front_side): ?>
                                                            <a href="<?php echo e(CustomHelper::displayImage($kyc->front_side)); ?>"
                                                                target="_blank">Front Side</a>
                                                        <?php endif; ?>
                                                        <b> | </b>
                                                        <?php if($kyc->back_side): ?>
                                                            <a href="<?php echo e(CustomHelper::displayImage($kyc->back_side)); ?>"
                                                                target="_blank">Back Side</a>
                                                        <?php endif; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="text-end">
                                                <label class="mt-3"><?php echo e($kyc->created_at->diffForHumans()); ?></label>
                                            </div>
                                            <div class="ekyc-fright">
                                                <div class="d-flex flex-wrap gap-2">
                                                    <p>
                                                        <?php echo e($kyc->front_side); ?> <b> | </b> <?php echo e($kyc->back_side); ?>

                                                    </p>
                                                    <?php if($kyc->front_side): ?>
                                                        <a href="<?php echo e(CustomHelper::displayImage($kyc->front_side)); ?>"
                                                            class="btn btn-success waves-effect" download="download">Front
                                                            Download</a>
                                                    <?php endif; ?>
                                                    <?php if($kyc->back_side): ?>
                                                        <a href="<?php echo e(CustomHelper::displayImage($kyc->back_side)); ?>"
                                                            class="btn btn-success waves-effect" download="download">Back
                                                            Download</a>
                                                    <?php endif; ?>
                                                    <a href="#" class="btn btn-warning waves-effect">Pending</a>
                                                    <a href="#" class="btn btn-success waves-effect">Approve</a>
                                                    <a href="#" class="btn btn-danger waves-effect">Reject</a>
                                                    <a href="<?php echo e(route('deleteUploadDoc', $kyc->id)); ?>"
                                                        class="btn btn-danger waves-effect">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="row m-t-md">
                            <div class="col-md-12 text-center">
                                <a href="#" class="btn btn-success waves-effect">Approve all Document with Bonus</a>
                                <a href="#" class="btn btn-primary waves-effect">Approve all Document without
                                    Bonus</a>
                                <a href="#" class="btn btn-primary waves-effect">Approve Live Accounts</a>
                                <a href="#" class="btn btn-danger waves-effect">Reject all</a>
                            </div>
                        </div>
                    <?php else: ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('/assets/libs/tinymce/tinymce.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/js/pages/form-editor.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/libs/apexcharts/apexcharts.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/js/pages/file-manager.init.js')); ?>"></script>

    <script>
        tinyMCE.init({
            height: "480"
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/clients/EKYC.blade.php ENDPATH**/ ?>