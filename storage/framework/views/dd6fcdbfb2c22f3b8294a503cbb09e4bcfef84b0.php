<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.Message_List'); ?>
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
                            <a href="#" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Send</a>
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
                            <?php if($messages): ?>
                                <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <a href="#">
                                                    <input type="checkbox" name="users" class="form-check-input">
                                                </a>
                                            </div>
                                            <div class="col-md-11">
                                                <a href="<?php echo e(route('messages.reply',$msg->id)); ?>">
                                                    <span><?php echo e($msg->name); ?></span>
                                                </a><br>
                                                <span class="d-flex"><i class="fas fa-reply"></i> &nbsp;&nbsp;<?php echo $aRow->latest_msg; ?></span>
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
            <div class="card overflow-hidden">
                <div class="card-header">
                    <h5><i class="fas fa-info-circle"></i> An email will be sent to notify the user.</h5>
                </div>
                <div class="card-body">
                    <section>
                        <form action="<?php echo e(route('messages.store')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group mb-3">
                                <label for="basicpill-users-input">Users</label>
                                <?php echo e(Form::select('user_id', ['' => 'Please Select'] + $aUsers, $aRow ? $aRow->user_id : null, ['class' => 'form-control', 'required' => 'required'])); ?>

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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/tools/messages/add.blade.php ENDPATH**/ ?>