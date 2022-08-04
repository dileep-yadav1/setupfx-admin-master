<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.Staff_List'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Dashboard
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Staff List
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="accordion mt-2 mb-2" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Filter
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse <?php echo e((Request::get('name') || Request::get('email')) ? 'show' : ''); ?> " aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                <div class="accordion-body">
                    <div class="text-muted">
                        <form method="GET" action="<?php echo e(route('staff.index')); ?>">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="formrow-name-input" class="form-label">Name</label>
                                    <input type="text" id="name" name="name" class="form-control" value="<?php echo e(Request::get('name')); ?>" placeholder="Name">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="formrow-email-input" class="form-label">Email</label>
                                    <input type="text" id="email" name="email" class="form-control" value="<?php echo e(Request::get('email')); ?>" placeholder="Email">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="formrow-firstname-input" class="d-block">&nbsp;</label>
                                    <button type="submit" class="btn btn-success w-md">Submit</button>
                                    <a href="<?php echo e(route('staff.index')); ?>" class="btn btn-danger w-md">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_staff_create')): ?>
                        <div class="d-flex flex-wrap gap-2 mb-4 justify-content-md-end">
                            <a class="btn btn-primary waves-effect waves-light" href="<?php echo e(route('staff.create')); ?>"
                                role="button">Add new staff</a>
                        </div>
                    <?php endif; ?>
                    <?php if(count($aUsers)): ?>
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 70px;">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_staff_status')): ?>
                                            <th scope="col">Status</th>
                                        <?php endif; ?>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $aUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aKey => $aUser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <?php if($aUser->avatar): ?>
                                                    <img class="rounded-circle avatar-xs"
                                                        src="<?php echo e(CustomHelper::displayImage($aUser->avatar)); ?>"
                                                        alt="">
                                                <?php else: ?>
                                                    <div class="avatar-xs">
                                                        <span class="avatar-title rounded-circle">
                                                            D
                                                        </span>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 mb-1"><a href="#"
                                                        class="text-dark"><?php echo e($aUser->name); ?></a></h5>

                                            </td>
                                            <td><?php echo e($aUser->email); ?></td>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_staff_status')): ?>
                                                <td>
                                                    <?php if($aUser->status == 1): ?>
                                                        <a href="<?php echo e(route('staff.change_status', [$aUser->id, 0])); ?>">
                                                            <span class="btn btn-success waves-effect waves-light">Active</span>
                                                        </a>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(route('staff.change_status', [$aUser->id, 1])); ?>">
                                                            <span
                                                                class="btn btn-danger waves-effect waves-light">Inactive</span>
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                            <?php endif; ?>

                                            <td>
                                                <ul class="list-inline font-size-20 contact-links mb-0">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_staff_list')): ?>
                                                        <li class="list-inline-item ">
                                                            <?php
                                                                $key = "Overview";
                                                            ?>
                                                            <a href="<?php echo e(url('staff/'.$aUser->id.'/'.$key)); ?>" title="View User">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_staff_edit')): ?>
                                                        <li class="list-inline-item ">
                                                            <a href="<?php echo e(route('staff.edit', $aUser->id)); ?>" title="Edit User">
                                                                <i class="bx bx bx-edit-alt"></i>
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_staff_destroy')): ?>
                                                        <li class="list-inline-item ">
                                                            <a title="Delete User" href="javascript:void(0);"
                                                                onclick="jQuery('#delete-form-<?php echo e($aUser->id); ?>').submit();">
                                                                <i class="bx bx-trash-alt"></i>
                                                            </a>
                                                            <form id="delete-form-<?php echo e($aUser->id); ?>"
                                                                onsubmit="return confirm('Are you sure to delete?');"
                                                                action="<?php echo e(route('staff.destroy', $aUser->id)); ?>"
                                                                method="post" style="display: none;">
                                                                <?php echo e(method_field('DELETE')); ?>

                                                                <?php echo e(csrf_field()); ?>

                                                            </form>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php echo e($aUsers->links('components.pagination')); ?>

                    <?php else: ?>
                        No data found
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/staff/index.blade.php ENDPATH**/ ?>