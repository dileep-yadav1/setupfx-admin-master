<?php $__env->startSection('title'); ?> Theme Setting <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('layouts.setting_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <form method="POST"  action="<?php echo e(route('setting.store', $settingId)); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Support Email</label>
                        <input type="email" id="support_email" name="support_email" class="form-control<?php echo e($errors->has('support_email') ? ' is-invalid' : ''); ?>" value="<?php echo e($aRow ? $aRow['support_email'] : old('support_email')); ?>" placeholder="Support Email">
                        <?php if($errors->has('support_email')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('support_email')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Support Name</label>
                        <input type="text" id="support_name" name="support_name" class="form-control<?php echo e($errors->has('support_name') ? ' is-invalid' : ''); ?>" value="<?php echo e($aRow ? $aRow['support_name'] : old('support_name')); ?>" placeholder="Email">
                        <?php if($errors->has('support_name')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('support_name')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Support Email</label>
                        <select id="support_email" name="support_email" class="form-control<?php echo e($errors->has('support_email') ? ' is-invalid' : ''); ?>">
                            <option value="">--Select Support Email--</option>
                                <?php $__currentLoopData = \CustomHelper::getdepartmentList(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $selected = ''; ?>
                                <?php if($aRow): ?>
                                    <?php if($aRow['support_email'] == $key): ?>
                                        <?php $selected = 'selected'; ?>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if(old('support_email') == $key): ?>
                                        <?php $selected = 'selected'; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <option value="<?php echo e($key); ?>" <?php echo e($selected); ?>><?php echo e($item); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('support_email')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('support_email')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Auto Close Ticket</label>
                        <input type="number" id="auto_close_ticket" name="auto_close_ticket" class="form-control<?php echo e($errors->has('auto_close_ticket') ? ' is-invalid' : ''); ?>" value="<?php echo e($aRow ? $aRow['auto_close_ticket'] : old('auto_close_ticket')); ?>" placeholder="Auto Close Ticket">
                        <?php if($errors->has('auto_close_ticket')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('auto_close_ticket')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Ticket Due Days</label>
                        <input type="number" id="ticket_due_days" name="ticket_due_days" class="form-control<?php echo e($errors->has('ticket_due_days') ? ' is-invalid' : ''); ?>" value="<?php echo e($aRow ? $aRow['ticket_due_days'] : old('ticket_due_days')); ?>" placeholder="Ticket Due Days">
                        <?php if($errors->has('ticket_due_days')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('ticket_due_days')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Feedback Request</label>
                        <input type="text" id="feedback_request" name="feedback_request" class="form-control<?php echo e($errors->has('feedback_request') ? ' is-invalid' : ''); ?>" value="<?php echo e($aRow ? $aRow['feedback_request'] : old('feedback_request')); ?>" placeholder="Feedback Request">
                        <?php if($errors->has('feedback_request')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('feedback_request')); ?></strong>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/setting/ticket.blade.php ENDPATH**/ ?>