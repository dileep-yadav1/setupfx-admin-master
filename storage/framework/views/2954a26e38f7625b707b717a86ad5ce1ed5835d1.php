<?php $__env->startComponent('components.breadcrumb'); ?>
    <?php $__env->slot('li_1'); ?>
        Dashboard
    <?php $__env->endSlot(); ?>
    <?php $__env->slot('title'); ?>
        <span id="bredcrumbName"><?php echo e($settingName); ?></span> Setting
    <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>
<?php $__env->startPush('styles'); ?>
    <style>
        #bredcrumbName{
            text-transform: capitalize;
        }
        .setting_menu.active {
    background: #0000003d;
}
    </style>
<?php $__env->stopPush(); ?>
<div class="row">
    <div class="chat-leftsidebar me-lg-3 col-xl-3">
        <div class="card overflow-hidden">
            <div class="card-body">
                <div class="">
                    <?php $SettingList = \CustomHelper::getSettingList() ?>
                    <?php if($SettingList): ?>
                        <?php $__currentLoopData = $SettingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card border shadow-none mb-2">
                                <a href="<?php echo e(url('/setting')); ?>/<?php echo e($key); ?>" class="text-body">
                                    <div class="overflow-hidden p-2 setting_menu <?php echo e($key == $settingName ? 'active' : ''); ?>">
                                        <span class="font-size-13 fw-bold text-truncate"><?php echo e($value); ?></span>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/layouts/setting_sidebar.blade.php ENDPATH**/ ?>