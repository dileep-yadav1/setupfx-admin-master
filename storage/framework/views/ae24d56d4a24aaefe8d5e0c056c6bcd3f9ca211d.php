<?php $__env->startSection('title'); ?> Theme Setting <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('layouts.setting_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <form method="POST"  action="<?php echo e(route('setting.store', $settingId)); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Site Name</label>
                        <input type="text" id="sitename" name="sitename" class="form-control<?php echo e($errors->has('sitename') ? ' is-invalid' : ''); ?>" value="<?php echo e($aRow ? $aRow['sitename'] : old('sitename')); ?>" placeholder="Site Name">
                        <?php if($errors->has('sitename')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('sitename')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                    <?php if($aRow): ?>
                    <div class="mb-3">
                        <img src="<?php echo e(CustomHelper::displayImage($aRow['logo'])); ?>" class="img-fluid w-25">
                    </div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="formrow-inputCity" class="form-label">Logo or Icon</label>
                        <div class="input-group">
                            <input type="file" class="form-control<?php echo e($errors->has('logo') ? ' is-invalid' : ''); ?> " id="logo" name="logo" autofocus="" <?php echo e($aRow ? '' : 'required'); ?>>
                            <label class="input-group-text" for="logo">Upload</label>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('logo')); ?></strong>
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Login Title</label>
                        <input type="text" id="login_title" name="login_title" class="form-control<?php echo e($errors->has('login_title') ? ' is-invalid' : ''); ?>" value="<?php echo e($aRow ? $aRow['login_title'] : old('login_title')); ?>" placeholder="Email">
                        <?php if($errors->has('login_title')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('login_title')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">App Name</label>
                        <input type="text" id="appname" name="appname" class="form-control<?php echo e($errors->has('appname') ? ' is-invalid' : ''); ?>" value="<?php echo e($aRow ? $aRow['appname'] : old('appname')); ?>" placeholder="App Name">
                        <?php if($errors->has('appname')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('appname')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">App Tagline</label>
                        <input type="text" id="apptagline" name="apptagline" class="form-control<?php echo e($errors->has('apptagline') ? ' is-invalid' : ''); ?>" value="<?php echo e($aRow ? $aRow['apptagline'] : old('apptagline')); ?>" placeholder="App Tag Line">
                        <?php if($errors->has('apptagline')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('apptagline')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Site Author</label>
                        <input type="text" id="site_author" name="site_author" class="form-control<?php echo e($errors->has('site_author') ? ' is-invalid' : ''); ?>" value="<?php echo e($aRow ? $aRow['site_author'] : old('site_author')); ?>" placeholder="Site Author">
                        <?php if($errors->has('site_author')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('site_author')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Site Keywords</label>
                        <input type="text" id="sitekeywords" name="sitekeywords" class="form-control<?php echo e($errors->has('sitekeywords') ? ' is-invalid' : ''); ?>" value="<?php echo e($aRow ? $aRow['sitekeywords'] : old('sitekeywords')); ?>" placeholder="Site Author">
                        <?php if($errors->has('sitekeywords')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('sitekeywords')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Site Description</label>
                        <input type="text" id="sitedescription" name="sitedescription" class="form-control<?php echo e($errors->has('sitedescription') ? ' is-invalid' : ''); ?>" value="<?php echo e($aRow ? $aRow['sitedescription'] : old('sitedescription')); ?>" placeholder="Site Author">
                        <?php if($errors->has('sitedescription')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('sitedescription')); ?></strong>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/setting/theme.blade.php ENDPATH**/ ?>