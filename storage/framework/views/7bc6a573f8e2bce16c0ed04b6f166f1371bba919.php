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
                                        name="search_user" id="search_user">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-info">Go</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="mt-4">
                        <ul class="list-group" id="user_filter_data">
                            <?php if($aRows): ?>
                                <?php $__currentLoopData = $aRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $aRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <?php
                                                    $key = "Overview";
                                                ?>
                                                <a href="<?php echo e((Auth::user()->role_id == config('constant.ADMIN_ROLE')) ? url('staff/'.$aRow->user_id.'/'.$key) : '#'); ?>">
                                                    <i class="far fa-square"></i>
                                                </a>
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
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function(){
            $("#search_user").on('keyup',function(){
                var user = $(this).val();
                console.log(user);
                $("#user_filter_data").html('');
                $.ajax({
                    url: "<?php echo e(url('messages/search_user')); ?>",
                    type: "GET",
                    data: {
                        user: user,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    dataType: 'json',
                    success: function(result) {

                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/tools/messages/index.blade.php ENDPATH**/ ?>