<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.Mail Variable List'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Dashboard
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Mail Variable List
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="accordion mt-2 mb-2" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Filter
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse <?php echo e((Request::get('variable_key') || Request::get('variable_value')) ? 'show' : ''); ?> " aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                <div class="accordion-body">
                    <div class="text-muted">
                        <form method="GET" action="<?php echo e(route('mail_variables.index')); ?>">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="formrow-firstname-input" class="form-label">Variable Key</label>
                                    <input type="text" id="variable_key" name="variable_key" class="form-control" value="<?php echo e(Request::get('variable_key')); ?>" placeholder="variable key">
                                </div>
            
                                <div class="col-md-3 mb-3">
                                    <label for="formrow-firstname-input" class="form-label">Variable Value</label>
                                    <input type="test" id="variable_value" name="variable_value" class="form-control" value="<?php echo e(Request::get('variable_value')); ?>" placeholder="variable value">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="formrow-firstname-input" class="d-block">&nbsp;</label>
                                    <button type="submit" class="btn btn-success w-md">Submit</button>
                                    <a href="<?php echo e(route('mail_variables.index')); ?>" class="btn btn-danger w-md">Reset</a>
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

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_email_create')): ?>
                        <div class="d-flex flex-wrap gap-2 mb-4 justify-content-md-end">
                            <a class="btn btn-primary waves-effect waves-light" href="<?php echo e(route('mail_variables.create')); ?>"
                                role="button">Add Variable</a>
                        </div>
                    <?php endif; ?>
                    <?php if(count($aRows)): ?>
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 70px;">#</th>
                                        <th scope="col">Variable Key</th>
                                        <th scope="col">Variable Value</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $aRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aKey => $aRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(++$aKey); ?></td>
                                            <td><?php echo e($aRow->variable_key); ?></td>
                                            <td><?php echo e($aRow->variable_value); ?></td>
                                            <td>
                                                <ul class="list-inline font-size-20 contact-links mb-0">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_staff_edit')): ?>
                                                        <li class="list-inline-item ">
                                                            <a href="<?php echo e(route('mail_variables.edit', $aRow->id)); ?>"
                                                                title="Edit User">
                                                                <i class="bx bx bx-edit-alt"></i>
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_staff_destroy')): ?>
                                                        <li class="list-inline-item ">
                                                            <a title="Delete User" href="javascript:void(0);"
                                                                onclick="jQuery('#delete-form-<?php echo e($aRow->id); ?>').submit();">
                                                                <i class="bx bx-trash-alt"></i>
                                                            </a>
                                                            <form id="delete-form-<?php echo e($aRow->id); ?>"
                                                                onsubmit="return confirm('Are you sure to delete?');"
                                                                action="<?php echo e(route('mail_variables.destroy', $aRow->id)); ?>"
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
                    <?php else: ?>
                        No data found
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/livewire/mail-variable/list-mail-variable.blade.php ENDPATH**/ ?>