<?php echo $__env->yieldContent('css'); ?>

<!-- Bootstrap Css -->
<link href="<?php echo e(URL::asset('assets/css/bootstrap.min.css')); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="<?php echo e(URL::asset('assets/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="<?php echo e(URL::asset('assets/css/app.min.css')); ?>" id="app-style" rel="stylesheet" type="text/css" />
<style>
    .msg-show{
        position: absolute;
        z-index: 999;
        opacity: 1;
        top: 78px;
        height: 45px;
        right: 185px;
    }
    </style>
<?php echo $__env->yieldPushContent('styles'); ?>
<?php /**PATH /opt/lampp/htdocs/forex-admin/resources/views/layouts/head-css.blade.php ENDPATH**/ ?>