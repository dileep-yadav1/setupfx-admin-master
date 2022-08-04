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
            <div class="d-lg-flex">
                <div class="chat-leftsidebar me-lg-4 col-xl-4">
                    
                    <div class="card">
                        <div class="card-header">
                            <h5>Overview</h5>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <label>Created At:- <b><?php echo e(date('d-m-Y', strtotime($aRow->created_at))); ?></b></label><br>
                                <label>Stage:- <span
                                        class="text-danger"><?php echo e(CustomHelper::$getClientStatus[$aRow->status]); ?></span></label><br>
                                <label>Lead Age:- <b><?php echo e($aRow->created_at->diffForHumans()); ?></b></label><br>
                                <a href="<?php echo e(route('leads.edit', $aRow->id)); ?>" class="btn btn-primary"><i
                                        class="fas fa-pen"></i>&nbsp;Update</a>
                            </div>
                            <div class="container mt-4">
                                <h3>Lead Profile</h3>
                                <hr>
                                <div class="row mt-3">
                                    <label>NAME</label>
                                    <span><?php echo e($aRow->first_name); ?>&nbsp;<?php echo e($aRow->last_name); ?></span>
                                </div>
                                <div class="row mt-3">
                                    <label>E-MAIL</label>
                                    <span><?php echo e($aRow->email); ?> &nbsp;<span
                                            class="text-danger text-bold"><?php echo e(!$user->email_verified_at ? 'UnVerified' : 'UnVerified'); ?></span></span>
                                </div>
                                <div class="row mt-3">
                                    <label>MOBILE</label>
                                    <span><?php echo e($aRow->contact ? $aRow->contact : '---------------'); ?></span>
                                </div>
                                <div class="row mt-3">
                                    <label>COUNTRY</label>
                                    <span><?php echo e($aRow->country ? $aRow->country : '----------------'); ?></span>
                                </div>
                                <div class="row mt-3">
                                    <label>REGISTRATION IP ADDRESS</label>
                                    <span>192.168.0.0.1</span>
                                </div>
                                <hr>
                                <div class="row mt-3">
                                    <?php if(!$user->email_verified_at): ?>
                                        <a href="#" class="btn btn-primary"><i
                                                class="fas fa-envelope"></i>&nbsp;Send Verification Mail</a>
                                    <?php endif; ?>
                                </div>
                                <div class="row mt-3">
                                    <?php if($aRow->status = 2): ?>
                                        <a href="#" class="btn btn-primary"><i
                                                class="fas fa-envelope"></i>&nbsp;Send Doc Reminder</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chat-leftsidebar me-lg-8 col-xl-8">
                  <div class="card">
                      <div class="card-header">
                          <h6>SMS Messages from <?php echo e(Auth::user()->name); ?> (A text message can hold up to 160 characters.)</h6>
                      </div>
                      <div class="card-body">
                        <section class="mt-3">
                            <?php if($aRow): ?>
                                <form action="<?php echo e(route('email.update', $aRow->id)); ?>" method="POST"
                                    enctype="multipart/form-data">
                                    <?php echo method_field('PUT'); ?>
                                <?php else: ?>
                                    <form action="<?php echo e(route('email.store')); ?>" method="POST" enctype="multipart/form-data"
                                        id="lead-form">
                            <?php endif; ?>
                            <?php echo csrf_field(); ?>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/clients/SMS.blade.php ENDPATH**/ ?>