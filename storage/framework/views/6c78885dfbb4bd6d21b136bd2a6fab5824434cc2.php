<?php $__env->startSection('title'); ?>
    <?php if($aRow): ?>
        Edit
    <?php else: ?>
        Add
    <?php endif; ?> Staff
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Dashboard
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('li_2'); ?>
            Staff List
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            <?php if($aRow): ?>
                Edit
            <?php else: ?>
                Add
            <?php endif; ?> Staff
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">

        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <?php if($aRow): ?>
                        <form method="POST" action="<?php echo e(route('staff.update', $aRow->id)); ?>" enctype="multipart/form-data">
                            <?php echo method_field('PUT'); ?>
                        <?php else: ?>
                            <form method="POST" action="<?php echo e(route('staff.store')); ?>" enctype="multipart/form-data">
                    <?php endif; ?>

                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Name</label>
                        <input type="text" id="name" name="name"
                            class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>"
                            value="<?php echo e($aRow ? $aRow->name : old('name')); ?>" required placeholder="Name">
                        <?php if($errors->has('name')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('name')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Email</label>
                        <input type="email" id="email" name="email"
                            class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"
                            value="<?php echo e($aRow ? $aRow->email : old('email')); ?>" required placeholder="Email">
                        <?php if($errors->has('email')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('email')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Password</label>
                                <input id="password" type="password"
                                    class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password"
                                    placeholder="Password">
                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-password-input" class="form-label">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" autocomplete="new-password" placeholder="Confirm Password">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="formrow-inputCity" class="form-label">Avatar</label>
                                <div class="input-group">
                                    <input type="file" class="form-control " id="avatar" name="avatar" autofocus="">
                                    <label class="input-group-text" for="avatar">Upload</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <?php if(isset($aRow->avatar) && $aRow->avatar): ?>
                                <img class="avatar-md"
                                    src="<?php echo e(\CustomHelper::displayImage($aRow->avatar, 'uploads/admin_staff')); ?>" alt="">
                            <?php endif; ?>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="formrow-inputCity" class="form-label">Permissions</label>
                            </div>
                        </div>
                        <?php if(count($aPermissions)): ?>
                            <?php $__currentLoopData = $aPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aKey => $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="formrow-inputCity"
                                            class="form-label"><?php echo e($module->module); ?></label>
                                        <div class="mb-3 d-flex flex-row">
                                            <?php $__currentLoopData = $module->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pKey => $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="mx-2">
                                                    <?php
                                                        $check_permission = 0;
                                                        if ($aRow) {
                                                            $check_permission = CustomHelper::checkUserPermission($aRow->id, $permission->id);
                                                        }

                                                    ?>
                                                    <input type="checkbox" name="permissions[]"
                                                        value="<?php echo e($permission->id); ?>"
                                                        <?php if($check_permission > 0): ?> checked <?php endif; ?> />

                                                    <?php echo e($permission->alias_name); ?>

                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/staff/add.blade.php ENDPATH**/ ?>