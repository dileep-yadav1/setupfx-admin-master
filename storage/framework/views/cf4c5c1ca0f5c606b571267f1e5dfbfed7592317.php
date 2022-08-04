<?php $__env->startSection('title'); ?> Notes <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->startComponent('components.breadcrumb'); ?>
    <?php $__env->slot('li_1'); ?> Dashboard <?php $__env->endSlot(); ?>
    <?php $__env->slot('li_2'); ?> Notes <?php $__env->endSlot(); ?>
    <?php $__env->slot('title'); ?> <?php if($aRow): ?> Edit <?php endif; ?> Notes <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="chat-leftsidebar me-lg-3 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_note_create')): ?>
                        <div class="text-end mb-2">
                            <a href="<?php echo e(url('note')); ?>" class="btn btn-md btn-success">Add Note</a>
                        </div>
                        <?php endif; ?>
                        
                        <div class="card shadow-none mb-2">
                            <?php if($aRows): ?>
                                <?php $__currentLoopData = $aRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $active = "" ?>
                                    <?php if($aRow && $value->id == $aRow['id']): ?>
                                    <?php $active = "active" ?>
                                    <?php endif; ?>
                                    <div class="card border mb-2 p-2 setting_menu <?php echo e($active); ?>">
                                        <div class="title d-flex justify-content-between ">
                                            <a href="<?php echo e(route('note.edit', $value->id )); ?>">
                                                <h5 class="text-left fw-bold text-truncate"><?php echo e($value->title); ?></h4>
                                            </a>
                                            <span class="text-end">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_note_destroy')): ?>
                                                    <a title="Delete User" href="javascript:void(0);" onclick="jQuery('#delete-form-<?php echo e($value->id); ?>').submit();">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </a>
                                                    <form id="delete-form-<?php echo e($value->id); ?>" onsubmit="return confirm('Are you sure to delete?');" action="<?php echo e(route('note.destroy',$value->id)); ?>" method="post" style="display: none;">
                                                    <?php echo e(method_field('DELETE')); ?>

                                                    <?php echo e(csrf_field()); ?>

                                                    </form>
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                        <div>
                                            <p class="fw-bold text-truncate"><?php echo e($value->desc); ?></p>
                                            <p class=""><?php echo e(date("M d, h:i A", strtotime($value->updated_at))); ?></p>
                                        </div>
                                        
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>


                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <?php if($aRow): ?>
                        <form method="POST" action="<?php echo e(route('note.update', $aRow->id)); ?>" enctype="multipart/form-data" id="AdminForm" name="AdminForm">
                        <?php echo method_field('PUT'); ?>
                    <?php else: ?>
                        <form method="POST" action="<?php echo e(route('note.store')); ?>" enctype="multipart/form-data" id="AdminForm" name="AdminForm">
                    <?php endif; ?>
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Title</label>
                            <input type="text" id="title" name="title" class="form-control<?php echo e($errors->has('title') ? ' is-invalid' : ''); ?>" value="<?php echo e($aRow ? $aRow['title'] : old('title')); ?>" placeholder="Enter Title Here.">
                            <?php if($errors->has('title')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('title')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Note</label>
                            <textarea id="desc" name="desc" rows="20" class="form-control<?php echo e($errors->has('desc') ? ' is-invalid' : ''); ?>" placeholder="Notes..."><?php echo e($aRow ? $aRow['desc'] : old('desc')); ?></textarea>
                            <?php if($errors->has('desc')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('desc')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                    </form>
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/tools/notes/index.blade.php ENDPATH**/ ?>