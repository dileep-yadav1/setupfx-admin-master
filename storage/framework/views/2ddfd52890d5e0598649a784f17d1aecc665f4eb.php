<?php
$showFilter = "";
$arrFilter = ['full_name', 'company_name', 'email', 'company_email', 'phone', 'tags'];
?>
<?php if(count(array_intersect(collect(array_filter(collect(Request::all())->toArray(), 'strlen'))->keys()->toArray(), $arrFilter)) > 0): ?>
    <?php  $showFilter = "show"; ?>
<?php endif; ?>



<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.Contact_List'); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?> Dashbaord <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?> Contacts List <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col-lg-12">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_staff_create')): ?>
                <div class="d-flex flex-wrap gap-2 mb-4 justify-content-md-end">
                    <a class="btn btn-primary waves-effect waves-light" href="<?php echo e(route('contact.create')); ?>" role="button">Add new contact</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="accordion mt-2 mb-2" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Filter
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse <?php echo e($showFilter); ?> " aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                <div class="accordion-body">
                    <div class="text-muted">
                        <form method="GET" action="<?php echo e(route('contact.index')); ?>">
                            <div class="row">
                                <div class="col-lg-4 mb-3">
                                    <label for="formrow-firstname-input" class="form-label">Full Name</label>
                                    <input type="text" id="full_name" name="full_name" class="form-control" value="<?php echo e(Request::get('full_name')); ?>" placeholder="Full Name">
                                </div>
                                <?php  $salesAgent = \CustomHelper::getsalesagents(); ?>
                                <div class="col-lg-4 mb-3">
                                    <label for="formrow-firstname-input" class="form-label">E-Mail</label>
                                    <input type="text" id="email" name="email" class="form-control" value="<?php echo e(Request::get('email')); ?>" placeholder="E-Mail">
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="formrow-firstname-input" class="form-label">Phone</label>
                                    <input type="text" id="phone" name="phone" class="form-control" value="<?php echo e(Request::get('phone')); ?>" placeholder="Phone Number">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 mb-3">
                                    <label for="basicpill-firstname-input">Company Name</label>
                                    <input type="text" id="company_name" name="company_name" class="form-control" value="<?php echo e(Request::get('company_name')); ?>" placeholder="Company Name">
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="formrow-firstname-input" class="form-label">Company Email</label>
                                    <input type="text" id="company_email" name="company_email" class="form-control" value="<?php echo e(Request::get('company_email')); ?>" placeholder="Company Email">
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="formrow-firstname-input" class="form-label">Tags</label>
                                    <input type="text" id="tags" name="tags" class="form-control" value="<?php echo e(Request::get('tags')); ?>" placeholder="Tags">
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="formrow-firstname-input" class="d-block">&nbsp;</label>
                                <button type="submit" class="btn btn-success w-md">Submit</button>
                                <a href="<?php echo e(route('contact.index')); ?>" class="btn btn-danger w-md">Reset</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <?php if(count($aUsers)): ?>
            <?php $__currentLoopData = $aUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aKey => $aUser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-4">
                                    <div class="avatar-sm mx-auto mb-3 mt-1">
                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                                            <?php echo e($aUser->full_name[0]); ?>

                                        </span>
                                    </div>
                                </div>

                                <div class="flex-grow-1 overflow-hidden">
                                    <?php
                                        $key = 'conversations';
                                    ?>
                                    <h5 class="text-truncate font-size-15"><a href="<?php echo e(url('contact')); ?>/<?php echo e($aUser->id); ?>/<?php echo e($key); ?>" class="text-dark"><?php echo e($aUser->full_name); ?></a></h5>
                                    <p class="text-muted mb-1"><b>Email&nbsp;&nbsp;&nbsp;&nbsp;:</b> <?php echo e($aUser->email); ?></p>
                                    <p class="text-muted mb-4"><b>Mobile :</b> <?php echo e($aUser->phone); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 border-top">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item me-3">
                                    <span class="badge bg-success">Completed</span>
                                </li>
                                <li class="list-inline-item me-3">
                                    <i class="bx bx-calendar me-1"></i> <?php echo e(date("d M, y", strtotime($aUser->created_at))); ?>

                                </li>
                                <li class="list-inline-item me-3">
                                    <i class="bx bx-comment-dots me-1"></i> 0
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="col-12">
                <div class="text-right my-3">
                    <?php echo e($aUsers->links('components.pagination')); ?>

                </div>
            </div> <!-- end col-->
        <?php else: ?>
            <div class="col-12"> No data found </div>
        <?php endif; ?>
    </div>
    <!--  end row -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/contacts/index.blade.php ENDPATH**/ ?>