<?php $__env->startSection('title'); ?>
    <?php if($aRow): ?>
        Edit
    <?php else: ?>
        Add
    <?php endif; ?> Mail Variable
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Dashboard
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('li_2'); ?>
            Mail Variable List
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            <?php if($aRow): ?>
                Edit
            <?php else: ?>
                Add
            <?php endif; ?> Mail Variable
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">

        <div class="col-xl-7">
            <div class="card">
                <div class="card-body">
                    <?php if($aRow): ?>
                        <form method="POST" action="<?php echo e(route('mail_variables.update', $aRow->id)); ?>"
                            enctype="multipart/form-data">
                            <?php echo method_field('PUT'); ?>
                        <?php else: ?>
                            <form method="POST" action="<?php echo e(route('mail_variables.store')); ?>" enctype="multipart/form-data">
                    <?php endif; ?>

                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Variable Key</label>
                        <input type="text" id="variable_key" name="variable_key"
                            class="form-control<?php echo e($errors->has('variable_key') ? ' is-invalid' : ''); ?>"
                            value="<?php echo e($aRow ? $aRow->variable_key : old('variable_key')); ?>" required
                            placeholder="variable key">
                        <?php if($errors->has('variable_key')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('variable_key')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Variable Value</label>
                        <input type="test" id="variable_value" name="variable_value"
                            class="form-control<?php echo e($errors->has('variable_value') ? ' is-invalid' : ''); ?>"
                            value="<?php echo e($aRow ? $aRow->variable_value : old('variable_value')); ?>"
                            placeholder="variable value">
                        <?php if($errors->has('variable_value')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('variable_value')); ?></strong>
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
        <div class="col-xl-5">
            <div class="card">
                <div class="card-body">
                    <div class="text-muted">
                        Tip: Template variable keys must be unique and enclosed with two square brackets, <br />
                        <ul>
                            <li>for static variables use uppercase letters like [WEBSITE_URL]</li>
                            <li>for input variables use [INPUT:field_name] like [INPUT:name]</li>
                            <li>for dynamic data use [DYNAMIC:$data]</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/livewire/mail-variable/create-mail-variable.blade.php ENDPATH**/ ?>