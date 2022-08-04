<?php $__env->startSection('title'); ?> <?php if($aRow): ?> Edit <?php else: ?> Add <?php endif; ?> Event <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->startComponent('components.breadcrumb'); ?>
    <?php $__env->slot('li_1'); ?> Dashboard <?php $__env->endSlot(); ?>
    <?php $__env->slot('li_2'); ?> Calendar <?php $__env->endSlot(); ?>
    <?php $__env->slot('title'); ?> <?php if($aRow): ?> Edit <?php else: ?> Add <?php endif; ?> Event <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <?php if($aRow): ?>
                <form method="POST"  action="<?php echo e(route('calendar.event.update',$aRow->id)); ?>" enctype="multipart/form-data">
                <?php echo method_field('PUT'); ?>
                <?php else: ?>
                <form method="POST"  action="<?php echo e(route('calendar.event.store')); ?>" enctype="multipart/form-data">
                <?php endif; ?>
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-title-input" class="form-label">Title</label>
                                <input type="text" id="title" name="title" class="form-control<?php echo e($errors->has('title') ? ' is-invalid' : ''); ?>" value="<?php echo e($aRow ? $aRow->title : old('title')); ?>"o  placeholder="Title">
                                <?php if($errors->has('title')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('title')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-venue-input" class="form-label">Venue</label>
                                <input type="text" id="venue" name="venue" class="form-control<?php echo e($errors->has('venue') ? ' is-invalid' : ''); ?>" value="<?php echo e($aRow ? $aRow->venue : old('venue')); ?>"o  placeholder="venue">
                                <?php if($errors->has('venue')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('venue')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="formrow-desc-input" class="form-label">Description</label>
                        <textarea name="desc" id="desc" cols="30" rows="10" class="form-control<?php echo e($errors->has('desc') ? ' is-invalid' : ''); ?>"><?php echo e($aRow ? $aRow->desc : old('desc')); ?></textarea>
                        <?php if($errors->has('desc')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('desc')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-start_date-input" class="form-label">Start Date</label>
                                <input type="date" id="start_date" class="form-control<?php echo e($errors->has('start_date') ? ' is-invalid' : ''); ?>" name="start_date" placeholder="Start Date" value="<?php echo e($aRow ? date("Y-m-d", strtotime($aRow->start_date)) : ''); ?><?php echo e(old('start_date') ? date("Y-m-d", strtotime(old('start_date'))) : ''); ?>">
                                <?php if($errors->has('start_date')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('start_date')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-end_date-input" class="form-label">End Date</label>
                                <input type="date" id="end_date" class="form-control<?php echo e($errors->has('end_date') ? ' is-invalid' : ''); ?>" name="end_date" autocomplete="new-password" placeholder="End Date" value="<?php echo e($aRow ? date("Y-m-d", strtotime($aRow->end_date)) : ''); ?><?php echo e(old('end_date') ? date("Y-m-d", strtotime(old('end_date'))) : ''); ?>">
                                <?php if($errors->has('end_date')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('end_date')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-end_date-input" class="form-label">Calendar</label>
                                <select name="calendar" id="calendar" class="form-control<?php echo e($errors->has('calendar') ? ' is-invalid' : ''); ?>">
                                    <?php $__currentLoopData = \CustomHelper::getCalendarList(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $selected = ''; ?>
                                        <?php if($aRow): ?>
                                            <?php if($aRow['calendar'] == $key): ?>
                                                <?php $selected = 'selected'; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if(old('calendar') == $key): ?>
                                                <?php $selected = 'selected'; ?>
                                            <?php endif; ?>                                
                                        <?php endif; ?>
                                        <option value="<?php echo e($key); ?>" <?php echo e($selected); ?>><?php echo e($item); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('calendar')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('calendar')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-desc-input" class="form-label">Project</label>
                                <input type="text" id="project" name="project" class="form-control<?php echo e($errors->has('project') ? ' is-invalid' : ''); ?>" placeholder="Project" value="<?php echo e($aRow ? $aRow->project : old('project')); ?>">
                                <?php if($errors->has('project')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('project')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-attendees-input" class="form-label">Attendees</label>
                                <input type="text" id="attendees" name="attendees" class="form-control<?php echo e($errors->has('attendees') ? ' is-invalid' : ''); ?>" placeholder="Attendees" value="<?php echo e($aRow ? $aRow->attendees : old('attendees')); ?>">
                                <?php if($errors->has('attendees')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('attendees')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-event_color-input" class="form-label">Event Color</label>
                                <input type="color" id="event_color" name="event_color" class="form-control<?php echo e($errors->has('event_color') ? ' is-invalid' : ''); ?> form-control-color mw-100" placeholder="event_color" value="<?php echo e($aRow ? $aRow->event_color : old('event_color')); ?>">
                                <?php if($errors->has('event_color')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('event_color')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-alert-input" class="form-label">Alert</label>
                                <select id="alert" name="alert" class="form-control<?php echo e($errors->has('alert') ? ' is-invalid' : ''); ?>">
                                    <?php $__currentLoopData = \CustomHelper::getAlertList(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $selected = ''; ?>
                                        <?php if($aRow): ?>
                                            <?php if($aRow['alert'] == $key): ?>
                                                <?php $selected = 'selected'; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if(old('alert') == $key): ?>
                                                <?php $selected = 'selected'; ?>
                                            <?php endif; ?>                                
                                        <?php endif; ?>
                                        <option value="<?php echo e($key); ?>" <?php echo e($selected); ?>><?php echo e($item); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('alert')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('alert')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="formCheck1">
                            <label class="form-check-label" for="formCheck1">Not visible to other users</label>
                        </div>
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



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/tools/calendar/addEvent.blade.php ENDPATH**/ ?>