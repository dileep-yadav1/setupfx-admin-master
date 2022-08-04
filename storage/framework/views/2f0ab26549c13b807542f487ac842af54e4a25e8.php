<?php $__env->startSection('title'); ?>
    <?php if($aRow): ?>
        Edit
    <?php else: ?>
        Add
    <?php endif; ?> Contact
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Dashboard
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('li_2'); ?>
            Contacts List
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            <?php if($aRow): ?>
                Edit
            <?php else: ?>
                Add
            <?php endif; ?> Contact
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <?php if($aRow): ?>
                        <form method="POST" action="<?php echo e(route('contact.update', $aRow->id)); ?>" enctype="multipart/form-data">
                            <?php echo method_field('PUT'); ?>
                        <?php else: ?>
                            <form method="POST" action="<?php echo e(route('contact.store')); ?>" enctype="multipart/form-data">
                    <?php endif; ?>

                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Full Name</label>
                        <input type="text" id="full_name" name="full_name" class="form-control<?php echo e($errors->has('full_name') ? ' is-invalid' : ''); ?>" value="<?php echo e($aRow ? $aRow->full_name : old('full_name')); ?>" required placeholder="Full Name">
                        <?php if($errors->has('full_name')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('full_name')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">E-Mail</label>
                        <input type="email" id="email" name="email"
                            class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"
                            value="<?php echo e($aRow ? $aRow->email : old('email')); ?>" required placeholder="E-Mail">
                        <?php if($errors->has('email')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('email')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Company Name</label>
                        <input type="text" id="company_name" name="company_name"
                            class="form-control<?php echo e($errors->has('company_name') ? ' is-invalid' : ''); ?>"
                            value="<?php echo e($aRow ? $aRow->company_name : old('company_name')); ?>" required placeholder="Company Name">
                        <?php if($errors->has('company_name')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('company_name')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Company Email</label>
                        <input type="email" id="company_email" name="company_email"
                            class="form-control<?php echo e($errors->has('company_email') ? ' is-invalid' : ''); ?>"
                            value="<?php echo e($aRow ? $aRow->company_email : old('company_email')); ?>" required placeholder="Company Email">
                        <?php if($errors->has('company_email')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('company_email')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Phone</label>
                        <input type="text" id="phone" name="phone"
                            class="form-control<?php echo e($errors->has('phone') ? ' is-invalid' : ''); ?>"
                            value="<?php echo e($aRow ? $aRow->phone : old('phone')); ?>" required placeholder="Phone Number">
                        <?php if($errors->has('phone')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('phone')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Tags</label>
                        <input type="text" id="tags" name="tags"
                            class="form-control<?php echo e($errors->has('tags') ? ' is-invalid' : ''); ?>"
                            value="<?php echo e($aRow ? $aRow->tags : old('tags')); ?>" required placeholder="Tags">
                        <?php if($errors->has('tags')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('tags')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                    </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/contacts/add.blade.php ENDPATH**/ ?>