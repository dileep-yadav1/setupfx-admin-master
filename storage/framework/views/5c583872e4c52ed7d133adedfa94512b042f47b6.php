<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.Message_List'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <style>
        .w-1140 {
            width: 1140px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Dashboard
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Message List
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="d-lg-flex">
        <div class="chat-leftsidebar me-lg-3 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4><?php echo app('translator')->get('translation.Message'); ?></h4>
                        </div>
                        <div class="col-md-6" style="text-align: end">
                            <a href="<?php echo e(route('messages.create')); ?>" class="btn btn-primary"><i
                                    class="fas fa-paper-plane"></i> Send</a>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
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
                            <?php if($aRows): ?>
                                <?php $__currentLoopData = $aRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $aRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <?php
                                                    $key = 'Overview';
                                                ?>
                                                <a
                                                    href="<?php echo e(Auth::user()->role_id == config('constant.ADMIN_ROLE') ? url('staff/' . $aRow->user_id . '/' . $key) : '#'); ?>">
                                                    <i class="far fa-square"></i></a>
                                            </div>
                                            <div class="col-md-11">
                                                <a href="<?php echo e(route('messages.show', $aRow->id)); ?>">
                                                    <span><?php echo e($aRow->name); ?></span>
                                                </a><br>
                                                <span class="d-flex"><i class="fas fa-reply"></i>
                                                    &nbsp;&nbsp;<?php echo $aRow->latest_msg; ?></span>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat-leftsidebar me-lg-9 col-xl-9">
            <ul class="list-unstyled">
                <?php if(count($areply)): ?>
                    <?php $__currentLoopData = $areply; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aKey => $aValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($aValue->type == 1): ?>
                            <li class="d-flex mb-4">
                                <img src="<?php echo e(CustomHelper::displayImage($aValue->avatar)); ?>" alt="avatar"
                                    class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                                <div class="card">
                                    <div class="card-body w-1140">
                                        <div>
                                            <?php echo $aValue->message; ?>

                                        </div>
                                        <div class="d-flex justify-content-between p-3 mt-3">
                                            <p class="fw-bold mb-0"><?php echo e($aValue->name); ?></p>
                                            <a href="#" class="text-muted small text-primary mb-0"><i
                                                    class="fas fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php else: ?>
                            <li class="d-flex justify-content-between mb-4">
                                <div class="card w-100">
                                    <div class="card-body">
                                        <div>
                                            <?php echo $aValue->message; ?>

                                        </div>
                                        <div class="d-flex justify-content-between p-3 mt-3">
                                            <p class="fw-bold mb-0"><?php echo e($aValue->name); ?></p>
                                            <a href="#" class="text-muted small text-primary mb-0"><i
                                                    class="fas fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <img src="<?php echo e(CustomHelper::displayImage($aValue->avatar)); ?>" alt="avatar"
                                    class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </ul>
            <div class="mt-3">
                <form action="<?php echo e(route('messages.saveadminreply')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-1">
                            <img src="<?php echo e(CustomHelper::displayImage(Auth::user()->avatar)); ?>" alt="avatar"
                                class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                        </div>
                        <div class="col-md-11 p-3">
                            <textarea id="elm1" name="message"></textarea>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary"><i
                                        class="fas fa-paper-plane"></i>&nbsp;Send</button>
                            </div>
                        </div>
                    </div>
                </form>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/tools/messages/message.blade.php ENDPATH**/ ?>