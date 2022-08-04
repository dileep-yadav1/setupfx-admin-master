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

        .comment-list {
            position: relative;
        }

        .m-sm {
            margin: 10px;
        }

        .block {
            display: block;
        }

        .comment-list:before {
            position: absolute;
            top: 0;
            bottom: 35px;
            left: 18px;
            width: 1px;
            background: #e0e4e8;
            content: '';
        }

        .scrollable {
            position: relative;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .bottom-border {
            border-bottom: 1px dotted #000000;
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
                                <?php echo method_field('PUT'); ?>
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
                                <form action="<?php echo e(route('staff.update', $aRow->id)); ?>" method="POST"
                                    enctype="multipart/form-data">
                                    <?php echo method_field('PUT'); ?>
                                    <?php echo csrf_field(); ?>
                                    <div class="modal-body">
                                        <input type="hidden" name="name" value="<?php echo e($aRow->name); ?>">
                                        <input type="hidden" name="email" value="<?php echo e($aRow->email); ?>">
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
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-secondary waves-effect"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save
                                            changes</button>
                                    </div>
                                </form>
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
                                    <h5 class="modal-title" id="myModalLabel">Suspend User
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

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
                        <span><i
                                class="<?php echo e(CustomHelper::getUserViewIcon($key)); ?>"></i>&nbsp;&nbsp;<?php echo e($value); ?></span>
                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content p-3 text-muted">
        <div class="tab-pane active" id="overview" role="tabpanel">
            <div class="d-lg-flex">
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
                        <div class="card-header">
                            <h5>Activity Feed</h5>
                        </div>
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#user" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">User</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#client" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">Client</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#lead" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block">Lead</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#account" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Account</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#document" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Document</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#transaction" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Transaction</span>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="user" role="tabpanel">
                                    <?php if($activity): ?>
                                        <div class="comment-list block m-sm">
                                            <div class="scrollable">
                                                <ul class="list-group">
                                                    <?php $__currentLoopData = $activity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($value->activity_type == CustomHelper::ACTIVITYUSER): ?>
                                                            <li class="list-item mb-3">
                                                                <div class="row">
                                                                    <div class="col-md-1">
                                                                        <img src="<?php echo e(CustomHelper::getCompanyLogo(Auth::user()->admin_id)); ?>"
                                                                            class="img-thumbnail rounded-circle">
                                                                    </div>
                                                                    <div class="col-md-11 mt-2">
                                                                        <div class="row bottom-border">
                                                                            <span
                                                                                class="text-left col-md-6"><?php echo e(config('app.name')); ?></span>
                                                                            <span
                                                                                class="text-end col-md-6"><?php echo e(date('d-m-y H:i:s', strtotime($value->created_at))); ?>

                                                                        </div>
                                                                        <div><?php echo e($value->activity_msg); ?></div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="tab-pane" id="client" role="tabpanel">
                                    <?php if($activity): ?>
                                        <div class="comment-list block m-sm">
                                            <div class="scrollable">
                                                <ul class="list-group">
                                                    <?php $__currentLoopData = $activity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($value->activity_type == CustomHelper::ACTIVITYCLIENT): ?>
                                                            <li class="list-item mb-3">
                                                                <div class="row">
                                                                    <div class="col-md-1">
                                                                        <img src="<?php echo e(CustomHelper::getCompanyLogo(Auth::user()->admin_id)); ?>"
                                                                            class="img-thumbnail rounded-circle">
                                                                    </div>
                                                                    <div class="col-md-11 mt-2">
                                                                        <div class="row bottom-border">
                                                                            <span
                                                                                class="text-left col-md-6"><?php echo e(config('app.name')); ?></span>
                                                                            <span
                                                                                class="text-end col-md-6"><?php echo e(date('d-m-y H:i:s', strtotime($value->created_at))); ?>

                                                                        </div>
                                                                        <div><?php echo e($value->activity_msg); ?></div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="tab-pane" id="lead" role="tabpanel">
                                    <?php if($activity): ?>
                                        <div class="comment-list block m-sm">
                                            <div class="scrollable">
                                                <ul class="list-group">
                                                    <?php $__currentLoopData = $activity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($value->activity_type == CustomHelper::ACTIVITYLEAD): ?>
                                                            <li class="list-item mb-3">
                                                                <div class="row">
                                                                    <div class="col-md-1">
                                                                        <img src="<?php echo e(CustomHelper::getCompanyLogo(Auth::user()->admin_id)); ?>"
                                                                            class="img-thumbnail rounded-circle">
                                                                    </div>
                                                                    <div class="col-md-11 mt-2">
                                                                        <div class="row bottom-border">
                                                                            <span
                                                                                class="text-left col-md-6"><?php echo e(config('app.name')); ?></span>
                                                                            <span
                                                                                class="text-end col-md-6"><?php echo e(date('d-m-y H:i:s', strtotime($value->created_at))); ?>

                                                                        </div>
                                                                        <div><?php echo e($value->activity_msg); ?></div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="tab-pane" id="account" role="tabpanel">
                                    <?php if($account): ?>
                                        <div class="comment-list block m-sm">
                                            <div class="scrollable">
                                                <ul class="list-group">
                                                    <?php $__currentLoopData = $account; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="list-item mb-3">
                                                            <div class="row">
                                                                <div class="col-md-1">
                                                                    <img src="<?php echo e(CustomHelper::getCompanyLogo(Auth::user()->admin_id)); ?>"
                                                                        class="img-thumbnail rounded-circle">
                                                                </div>
                                                                <div class="col-md-11 mt-2">
                                                                    <div class="row bottom-border">
                                                                        <span
                                                                            class="text-left col-md-6"><?php echo e(config('app.name')); ?></span>
                                                                        <span
                                                                            class="text-end col-md-6"><?php echo e(date('d-m-y H:i:s', strtotime($value->created_at))); ?>

                                                                    </div>
                                                                    <div><?php echo e($value->activity_msg); ?></div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="tab-pane" id="document" role="tabpanel">
                                </div>
                                <div class="tab-pane" id="transaction" role="tabpanel">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="profile1" role="tabpanel">
            <p class="mb-0">
                Food truck fixie locavore, accusamus mcsweeney's marfa nulla
                single-origin coffee squid. Exercitation +1 labore velit, blog
                sartorial PBR leggings next level wes anderson artisan four loko
                farm-to-table craft beer twee. Qui photo booth letterpress,
                commodo enim craft beer mlkshk aliquip jean shorts ullamco ad
                vinyl cillum PBR. Homo nostrud organic, assumenda labore
                aesthetic magna delectus.
            </p>
        </div>
        <div class="tab-pane" id="messages1" role="tabpanel">
            <p class="mb-0">
                Etsy mixtape wayfarers, ethical wes anderson tofu before they
                sold out mcsweeney's organic lomo retro fanny pack lo-fi
                farm-to-table readymade. Messenger bag gentrify pitchfork
                tattooed craft beer, iphone skateboard locavore carles etsy
                salvia banksy hoodie helvetica. DIY synth PBR banksy irony.
                Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh
                mi whatever gluten-free carles.
            </p>
        </div>
        <div class="tab-pane" id="settings1" role="tabpanel">
            <p class="mb-0">
                Trust fund seitan letterpress, keytar raw denim keffiyeh etsy
                art party before they sold out master cleanse gluten-free squid
                scenester freegan cosby sweater. Fanny pack portland seitan DIY,
                art party locavore wolf cliche high life echo park Austin. Cred
                vinyl keffiyeh DIY salvia PBR, banh mi before they sold out
                farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral,
                mustache readymade keffiyeh craft.
            </p>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/staff/Overview.blade.php ENDPATH**/ ?>