<?php 
$showFilter = "";
$arrFilter = ['emailtype', 'subject', 'tags'];
?>
<?php if(count(array_intersect(collect(array_filter(collect(Request::all())->toArray(), 'strlen'))->keys()->toArray(), $arrFilter)) > 0): ?>
    <?php  $showFilter = "show"; ?>
<?php endif; ?>



<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.Email'); ?>
<?php $__env->stopSection(); ?>
<?php
use App\Models\TabParameter;
?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Dashboard
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Email List
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="accordion mt-2 mb-2" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Filter
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse <?php echo e($showFilter); ?>" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                <div class="accordion-body">
                    <div class="text-muted">
                        <form method="GET" action="<?php echo e(route('email.index')); ?>">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="formrow-firstname-input" class="form-label">Email Type</label>
                                    <div class="mb-3">
                                        <?php echo e(Form::select('emailtype', ['' => 'Please Select'] + $emailType, Request::get('emailtype'), ['class' => 'form-control'])); ?>

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label for="formrow-firstname-input" class="form-label">Subject</label>
                                    <div class="mb-3">
                                        <input type="text" id="subject" name="subject" class="form-control" value="<?php echo e(Request::get('subject')); ?>" placeholder="Subject">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label for="formrow-firstname-input" class="form-label">Tags</label>
                                    <div class="mb-3">
                                        <input type="text" id="tags" name="tags" class="form-control" value="<?php echo e(Request::get('tags')); ?>" placeholder="Tags">
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="formrow-firstname-input" class="d-block">&nbsp;</label>
                                    <button type="submit" class="btn btn-success w-md">Submit</button>
                                    <a href="<?php echo e(route('email.index')); ?>" class="btn btn-danger w-md">Reset</a>
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
                            <a class="btn btn-primary waves-effect waves-light" href="<?php echo e(route('email.create')); ?>"
                                role="button">Add New Email</a>
                        </div>
                    <?php endif; ?>
                    <?php if(count($aRows)): ?>
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 70px;">#</th>
                                        <th scope="col">Email Type</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Tags</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $aRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $aRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(++$key); ?></td>
                                            <td><?php echo e($aRow->emailtype); ?></td>
                                            <td><?php echo e($aRow->subject); ?></td>
                                            <td><?php echo e($aRow->tags); ?></td>
                                            <td>
                                                <?php if($aRow->status == 1): ?>
                                                    <a href="<?php echo e(route('email.change_status', [$aRow->id, 0])); ?>">
                                                        <span class="btn btn-success waves-effect waves-light">Active</span>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?php echo e(route('email.change_status', [$aRow->id, 1])); ?>">
                                                        <span
                                                            class="btn btn-danger waves-effect waves-light">Inactive</span>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <ul class="list-inline font-size-20 contact-links mb-0">
                                                    <li class="list-inline-item ">
                                                        <a href="<?php echo e(route('email.edit', $aRow->id)); ?>" title="Edit User">
                                                            <i class="bx bx bx-edit-alt"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item ">
                                                        <a title="Delete User" href="javascript:void(0);"
                                                            onclick="jQuery('#delete-form-<?php echo e($aRow->id); ?>').submit();">
                                                            <i class="bx bx-trash-alt"></i>
                                                        </a>
                                                        <form id="delete-form-<?php echo e($aRow->id); ?>"
                                                            onsubmit="return confirm('Are you sure to delete?');"
                                                            action="<?php echo e(route('email.destroy', $aRow->id)); ?>"
                                                            method="post" style="display: none;">
                                                            <?php echo e(method_field('DELETE')); ?>

                                                            <?php echo e(csrf_field()); ?>

                                                        </form>
                                                    </li>
                                                    <li class="list-inline-item" id="makeClient">
                                                        <!-- Button trigger modal -->
                                                        <button type="button"
                                                            class="btn btn-primary waves-effect waves-light"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#myModal<?php echo e($aRow->id); ?>">Test Mail</button>

                                                        <!-- Modal -->
                                                        <div id="myModal<?php echo e($aRow->id); ?>" class="modal fade"
                                                            tabindex="-1" aria-labelledby="myModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <form action="<?php echo e(route('sendTestMail')); ?>" method="POST"
                                                                    enctype="multipart/form-data">
                                                                    <?php echo csrf_field(); ?>
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="myModalLabel">
                                                                                Send Test Message</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="col-lg-12">
                                                                                <label for="receivermail">Email</label>
                                                                                <input type="hidden" name="id" value="<?php echo e($aRow->id); ?>">
                                                                                <input type="email" name="receivermail"
                                                                                    id="receivermail" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary waves-effect"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary waves-effect waves-light">Save
                                                                                changes</button>
                                                                        </div>
                                                                    </div><!-- /.modal-content -->
                                                                </form>
                                                            </div><!-- /.modal-dialog -->
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php echo e($aRows->links('components.pagination')); ?>

                    <?php else: ?>
                        No data found
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/forex-admin/resources/views/email-template/index.blade.php ENDPATH**/ ?>