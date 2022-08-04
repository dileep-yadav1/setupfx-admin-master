<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.Staff'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <style>
        .mlm-40 {
            margin-left: -38px;
        }

        .mlm-80 {
            margin-left: -80px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Dashboard
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Staff
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="overflow-hidden col-md-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                        data-bs-target="#updateModal"><i class="fas fa-pen"></i>&nbsp;Update</button>

                    <!-- sample modal content -->
                    <div id="updateModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="<?php echo e(route('staff.update', $aRow->id)); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel">User Update</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="formrow-firstname-input" class="form-label">Name</label>
                                            <input type="text" id="name" name="name"
                                                class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>"
                                                value="<?php echo e($aRow ? $aRow->name : old('name')); ?>" required
                                                placeholder="Name">
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
                                                value="<?php echo e($aRow ? $aRow->email : old('email')); ?>" required
                                                placeholder="Email">
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
unset($__errorArgs, $__bag); ?>"
                                                        name="password" placeholder="Password">
                                                    <?php if($errors->has('password')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('password')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="formrow-password-input" class="form-label">Confirm
                                                        Password</label>
                                                    <input id="password-confirm" type="password" class="form-control"
                                                        name="password_confirmation" autocomplete="new-password"
                                                        placeholder="Confirm Password">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="formrow-inputCity" class="form-label">Avatar</label>
                                                    <div class="input-group">
                                                        <input type="file" class="form-control " id="avatar"
                                                            name="avatar" autofocus="">
                                                        <label class="input-group-text" for="avatar">Upload</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <?php if(isset($aRow->avatar) && $aRow->avatar): ?>
                                                    <img class="avatar-md"
                                                        src="<?php echo e(\CustomHelper::displayImage($aRow->avatar, 'uploads/admin_staff')); ?>"
                                                        alt="">
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary waves-effect"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary waves-effect waves-light">Save
                                            changes</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </form>
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div>
                <div class="col-md-6 mlm-40">
                    <button type="button" class="btn btn-primary waves-effect" data-bs-toggle="modal"
                        data-bs-target="#permissionModal"><i class="fas fa-pen"></i>&nbsp;Permission</button>

                    <!--  Large modal example -->
                    <div class="modal fade bs-example-modal-lg" id="permissionModal" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myLargeModalLabel">Permission Modal
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <?php if(count($aPermissions)): ?>
                                        <?php $__currentLoopData = $aPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aKey => $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="formrow-inputCity"
                                                        class="form-label"><?php echo e($module->module); ?></label>
                                                    <div class="mb-3 row">
                                                        <?php $__currentLoopData = $module->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pKey => $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="col-md-4">
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
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div>
                <div class="col-md-2 mlm-80">
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                        data-bs-target="#suspendModal"><i class="fas fa-thumbs-down"></i></button>

                    <!-- sample modal content -->
                    <div id="suspendModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Default Modal Heading
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5>Overflowing text to show scroll behavior</h5>
                                    <p>Cras mattis consectetur purus sit amet fermentum.
                                        Cras justo odio, dapibus ac facilisis in,
                                        egestas eget quam. Morbi leo risus, porta ac
                                        consectetur ac, vestibulum at eros.</p>
                                    <p>Praesent commodo cursus magna, vel scelerisque
                                        nisl consectetur et. Vivamus sagittis lacus vel
                                        augue laoreet rutrum faucibus dolor auctor.</p>
                                    <p>Aenean lacinia bibendum nulla sed consectetur.
                                        Praesent commodo cursus magna, vel scelerisque
                                        nisl consectetur et. Donec sed odio dui. Donec
                                        ullamcorper nulla non metus auctor
                                        fringilla.</p>
                                    <p>Cras mattis consectetur purus sit amet fermentum.
                                        Cras justo odio, dapibus ac facilisis in,
                                        egestas eget quam. Morbi leo risus, porta ac
                                        consectetur ac, vestibulum at eros.</p>
                                    <p>Praesent commodo cursus magna, vel scelerisque
                                        nisl consectetur et. Vivamus sagittis lacus vel
                                        augue laoreet rutrum faucibus dolor auctor.</p>
                                    <p>Aenean lacinia bibendum nulla sed consectetur.
                                        Praesent commodo cursus magna, vel scelerisque
                                        nisl consectetur et. Donec sed odio dui. Donec
                                        ullamcorper nulla non metus auctor
                                        fringilla.</p>
                                    <p>Cras mattis consectetur purus sit amet fermentum.
                                        Cras justo odio, dapibus ac facilisis in,
                                        egestas eget quam. Morbi leo risus, porta ac
                                        consectetur ac, vestibulum at eros.</p>
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
    <ul class="nav nav-tabs nav-tabs-custom nav-justified w-50" role="tablist">
        <?php $SettingList = \CustomHelper::getUserViewList() ?>
        <?php if($SettingList): ?>
            <?php $__currentLoopData = $SettingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="nav-item">
                    <a href="<?php echo e(url('/staff')); ?>/<?php echo e($aRow->id); ?>/<?php echo e($key); ?>"
                        class="d-flex nav-link <?php echo e($key == $viewName ? 'active' : ''); ?>">
                        <span><i class="<?php echo e(CustomHelper::getUserViewIcon($key)); ?>"></i>&nbsp;&nbsp;<?php echo e($value); ?></span>
                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </ul>
    <div class="d-lg-flex mt-4">
        <div class="chat-leftsidebar me-lg-3 col-xl-3">
            <div class="card overflow-hidden">
                <div class="bg-primary bg-soft">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-3">
                                <h5 class="text-primary"><?php echo e($aRow->name); ?></h5>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="<?php echo e(URL::asset('/assets/images/profile-img.png')); ?>" alt=""
                                class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="avatar-md profile-user-wid mb-4">
                                <img src="<?php echo e(CustomHelper::displayImage($aRow->avatar)); ?>" alt=""
                                    class="img-thumbnail rounded-circle">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row">
                            <h4>Name:-&nbsp;&nbsp;<?php echo e($aRow->name); ?></h4>
                        </div>
                        <div class="row">
                            <h4>Email:-&nbsp;&nbsp;<?php echo e($aRow->email); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat-leftsidebar me-lg-9 col-xl-9">
            <div class="card overflow-hidden">
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/staff/Calls.blade.php ENDPATH**/ ?>