<?php 
$showFilter = "";
$arrFilter = ['from_name', 'from_email', 'reply_to', 'subject', 'campaign_name', 'status'];
?>
<?php if(count(array_intersect(collect(array_filter(collect(Request::all())->toArray(), 'strlen'))->keys()->toArray(), $arrFilter)) > 0): ?>
    <?php  $showFilter = "show"; ?>
<?php endif; ?>



<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.Email Campaign'); ?>
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
            Email Campaign List
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
                        <form method="GET" action="<?php echo e(route('email_campaign.index')); ?>">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">From Name</label>
                                        <input type="text" name="from_name" id="from_name" class="form-control" value="<?php echo e(Request::get('from_name')); ?>"
                                            placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">From Email</label>
                                        <input type="text" name="from_email" id="from_email" class="form-control" value="<?php echo e(Request::get('from_email')); ?>"
                                            placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Reply To</label>
                                        <input type="text" name="reply_to" id="reply_to" class="form-control" value="<?php echo e(Request::get('reply_to')); ?>"
                                            placeholder="Enter Reply To Email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Subject</label>
                                        <input type="text" name="subject" value="<?php echo e(Request::get('subject')); ?>"
                                            class="form-control" placeholder="Enter Subject">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Campaign Name</label>
                                        <input type="text" name="campaign_name" id="campaign_name" class="form-control" value="<?php echo e(Request::get('campaign_name')); ?>"
                                            placeholder="Enter Campaign Name">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label for="basicpill-firstname-input">Status</label>
                                    <div class="mb-3">
                                        <select name="status" class="form-control">
                                            <option class="text-muted" value="" selected>--Select Status--</option>
                                            <option value="1" <?php echo e((Request::get('status') == "1" ? 'selected' : '')); ?>>Active</option>
                                            <option value="0" <?php echo e((Request::get('status') == "0" ? 'selected' : '')); ?>>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="formrow-firstname-input" class="d-block">&nbsp;</label>
                                <button type="submit" class="btn btn-success w-md">Submit</button>
                                <a href="<?php echo e(route('email_campaign.index')); ?>" class="btn btn-danger w-md">Reset</a>
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

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_email_campaign_create')): ?>
                        <div class="d-flex flex-wrap gap-2 mb-4 justify-content-md-end">
                            <a class="btn btn-primary waves-effect waves-light" href="<?php echo e(route('email_campaign.create')); ?>"
                                role="button">Add New Campaign</a>
                        </div>
                    <?php endif; ?>
                    <?php if(count($aRows)): ?>
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 70px;">#</th>
                                        <th scope="col">Campaign Name</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Sent Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $aRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $aRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(++$key); ?></td>
                                            <td><?php echo e($aRow->campaign_name); ?></td>
                                            <td><?php echo e($aRow->subject); ?></td>
                                            <td><?php echo e(($aRow->sent_date != NULL) ? date('d M,Y',strtotime($aRow->sent_date)) : 'N/A'); ?></td>
                                            <td>
                                                <?php if($aRow->status == 1): ?>
                                                    <a href="<?php echo e(route('email_campaign.change_status', [$aRow->id, 0])); ?>">
                                                        <span class="btn btn-success waves-effect waves-light">Active</span>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?php echo e(route('email_campaign.change_status', [$aRow->id, 1])); ?>">
                                                        <span
                                                            class="btn btn-danger waves-effect waves-light">Inactive</span>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <ul class="list-inline font-size-20 contact-links mb-0">
                                                    <li class="list-inline-item ">
                                                        <a href="<?php echo e(route('email_campaign.edit', $aRow->id)); ?>" title="Edit User">
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
                                                            action="<?php echo e(route('email_campaign.destroy', $aRow->id)); ?>"
                                                            method="post" style="display: none;">
                                                            <?php echo e(method_field('DELETE')); ?>

                                                            <?php echo e(csrf_field()); ?>

                                                        </form>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/marketing/email-index.blade.php ENDPATH**/ ?>