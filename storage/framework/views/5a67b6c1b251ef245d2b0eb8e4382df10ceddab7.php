<?php $__env->startSection('title'); ?> <?php echo e(ucfirst($settingName)); ?> Setting <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('layouts.setting_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <form method="POST"  action="<?php echo e(route('emailConfiguration.store')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">IMAP Driver</label>
                        <input type="text" id="driver" name="driver" class="form-control<?php echo e($errors->has('driver') ? ' is-invalid' : ''); ?>" value="<?php echo e($aRow ? $aRow['driver'] : old('driver')); ?>" placeholder="SMTP">
                        <?php if($errors->has('driver')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('driver')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">IMAP Host</label>
                        <input type="text" id="host" name="host" class="form-control<?php echo e($errors->has('host') ? ' is-invalid' : ''); ?>" value="<?php echo e($aRow ? $aRow['host'] : old('host')); ?>" placeholder="IMAP Host">
                        <?php if($errors->has('host')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('host')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Mail Port</label>
                        <input type="number" id="port" name="port" class="form-control<?php echo e($errors->has('port') ? ' is-invalid' : ''); ?>" value="<?php echo e($aRow ? $aRow['port'] : old('port')); ?>" placeholder="Mail Port Line">
                        <?php if($errors->has('port')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('port')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Mail Encryption</label>
                        <input type="text" id="encryption" name="encryption" class="form-control<?php echo e($errors->has('encryption') ? ' is-invalid' : ''); ?>" value="<?php echo e($aRow ? $aRow['encryption'] : old('encryption')); ?>" placeholder="Mail Encryption">
                        <?php if($errors->has('encryption')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('encryption')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>


                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">IMAP Username</label>
                        <input type="text" id="username" name="username" class="form-control<?php echo e($errors->has('username') ? ' is-invalid' : ''); ?>" value="<?php echo e($aRow ? $aRow['username'] : old('imap_username')); ?>" placeholder="IMAP Username">
                        <?php if($errors->has('username')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('username')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-email-input" class="form-label">IMAP Password</label>
                        <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" placeholder="IMAP Password">
                        <?php if($errors->has('password')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('password')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Sender Name</label>
                        <input type="text" id="sender_name" name="sender_name" class="form-control<?php echo e($errors->has('sender_name') ? ' is-invalid' : ''); ?>" value="<?php echo e($aRow ? $aRow['sender_name'] : old('sender_name')); ?>" placeholder="Mail From Name">
                        <?php if($errors->has('sender_name')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('sender_name')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Sender Mail</label>
                        <input type="text" id="sender_email" name="sender_email" class="form-control<?php echo e($errors->has('sender_email') ? ' is-invalid' : ''); ?>" value="<?php echo e($aRow ? $aRow['sender_email'] : old('Mail Mailer')); ?>" placeholder="Mail From Email Address">
                        <?php if($errors->has('sender_email')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('sender_email')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/forex-admin/resources/views/setting/email-configuration-setting.blade.php ENDPATH**/ ?>