<?php 
$showFilter = "";
$arrFilter = ['department', 'subject', 'reporter', 'priority', 'tags'];
?>
<?php if(count(array_intersect(collect(array_filter(collect(Request::all())->toArray(), 'strlen'))->keys()->toArray(), $arrFilter)) > 0): ?>
    <?php  $showFilter = "show"; ?>
<?php endif; ?>



<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.Client Ticket List'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Dashboard
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Client Ticket List
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
                        <form method="GET" action="<?php echo e(route('client-ticket.index')); ?>">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Department</label>
                                        <?php echo e(Form::select('department', ['' => 'Please Select'] + $aDepartment, Request::get('department'), ['class' => 'form-control'])); ?>

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Subject</label>
                                        <input type="text" id="subject" name="subject"
                                        class="form-control" value="<?php echo e(Request::get('subject')); ?>" placeholder="Subject">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="formrow-email-input" class="form-label">Reporter</label>
                                        <?php echo e(Form::select('reporter', ['' => 'Please Select'] + $getSalesAgent, Request::get('reporter'), ['class' => 'form-control'])); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="formrow-password-input" class="form-label">Priority</label>
                                        <?php echo e(Form::select('priority', ['' => 'Please Select'] + $aPriority, Request::get('priority'), ['class' => 'form-control'])); ?>

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-address-input">Tags</label><br>
                                        <div class="col-md-12">
                                            <input type="text" value="<?php echo e(Request::get('tags')); ?>" data-role="tagsinput" name="tags" class="form-control" placeholder="Add tags" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label for="verticalnav-email-input">Status</label>
                                    <div class="mb-3">
                                        <select name="status" class="form-control">
                                            <option class="text-muted" value="" selected>--Select status--</option>
                                            <option value="0" <?php echo e((Request::get('status') == "0" ? 'selected' : '')); ?>>Pending</option>
                                            <option value="1" <?php echo e((Request::get('status') == "1" ? 'selected' : '')); ?>>Closed</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="formrow-firstname-input" class="d-block">&nbsp;</label>
                                    <button type="submit" class="btn btn-success w-md">Submit</button>
                                    <a href="<?php echo e(route('client-ticket.index')); ?>" class="btn btn-danger w-md">Reset</a>
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
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('client_ticket_create')): ?>
                        <div class="d-flex flex-wrap gap-2 mb-4 justify-content-md-end">
                            <a class="btn btn-primary waves-effect waves-light" href="<?php echo e(route('client-ticket.create')); ?>"
                                role="button">Add New Ticket</a>
                        </div>
                    <?php endif; ?>
                    <?php if(count($aTickets)): ?>
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 70px;">#</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">priority</th>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('client_ticket_status')): ?>
                                            <th scope="col">Status</th>
                                        <?php endif; ?>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $aTickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aKey => $aTicket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle">
                                                        T
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 mb-1"><a href="#"
                                                        class="text-dark"><?php echo e(CustomHelper::getdepartmentName($aTicket->department)); ?></a>
                                                </h5>
                                            </td>
                                            <td><?php echo e($aTicket->subject); ?></td>
                                            <td>
                                                <span
                                                    class="btn text-white waves-effect waves-light bg-<?php echo e(\CustomHelper::$getPriorityBadge[$aTicket->priority]); ?>">
                                                    <?php echo e(\CustomHelper::$getPriorityType[$aTicket->priority]); ?>

                                                </span>
                                            </td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('client_ticket_status')): ?>
                                                <td>
                                                    <?php if($aTicket->status == 0): ?>
                                                        <a href="<?php echo e(route('client-ticket.change_status', [$aTicket->id, 1])); ?>">
                                                            <span class="btn btn-danger waves-effect waves-light">Pending</span>
                                                        </a>
                                                    <?php else: ?>
                                                        
                                                        <span class="btn btn-success waves-effect waves-light">Closed</span>
                                                        
                                                    <?php endif; ?>
                                                </td>
                                            <?php endif; ?>

                                            <td>
                                                <ul class="list-inline font-size-20 contact-links mb-0">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('client_ticket_reply')): ?>
                                                        <?php if(Auth::user()->role_id == config('constant.ADMIN_ROLE')): ?>
                                                            <li class="list-inline-item">
                                                                <a href="<?php echo e(route('admin_client-ticket.reply', $aTicket->id)); ?>" title="Reply">
                                                                    <i class="bx bx bx-message-alt"></i>
                                                                </a>
                                                            </li>
                                                        <?php else: ?>
                                                        <li class="list-inline-item">
                                                            <a href="<?php echo e(route('client-ticket.reply', $aTicket->id)); ?>" title="Reply">
                                                                <i class="bx bx bx-message-alt"></i>
                                                            </a>
                                                        </li>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </ul>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php echo e($aTickets->links('components.pagination')); ?>

                    <?php else: ?>
                        No data found
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/clientTicket/index.blade.php ENDPATH**/ ?>