<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.todo_List'); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?> Dashboard <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?> Todo List <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_todo_create')): ?>
                <div class="d-flex flex-wrap gap-2 mb-4 justify-content-md-end">
                    <a class="btn btn-primary waves-effect waves-light" href="<?php echo e(route('todo.create')); ?>" role="button">Add Event</a>
                </div>
                <?php endif; ?>
                    <div class="col-lg-8">
                        <div class="row mx-md-n2">
                            <div class="col px-md-2">
                                <div class="tododiv p-2 border">
                                    <h5>Today - <?php echo e(date("M d, Y")); ?></h5>
                                    <hr>
                                    <?php if($today_list): ?>
                                        <?php $__currentLoopData = $today_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="p-2 text-white mb-1 border rounded" style="background-color: <?php echo e($item->event_color); ?>">
                                                <div class="title d-flex justify-content-between ">
                                                    <h5 class="text-left fw-bold text-truncate text-white"><?php echo e($item->title); ?> ( <?php echo e($item->venue); ?> )</h4>
                                                    <span class="text-end">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_todo_edit')): ?>
                                                            <a class="text-white" title="Delete Event" href="<?php echo e(route('todo.edit', $item->id )); ?>">
                                                                <i class="bx bx-pencil" aria-hidden="true"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_todo_destroy')): ?>
                                                            <a class="text-white" title="Delete Event" href="javascript:void(0);" onclick="jQuery('#delete-form-<?php echo e($item->id); ?>').submit();">
                                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                            </a>
                                                            <form id="delete-form-<?php echo e($item->id); ?>" onsubmit="return confirm('Are you sure to delete?');" action="<?php echo e(route('todo.destroy',$item->id)); ?>" method="post" style="display: none;">
                                                            <?php echo e(method_field('DELETE')); ?>

                                                            <?php echo e(csrf_field()); ?>

                                                            </form>
                                                        <?php endif; ?>
                                                    </span>
                                                </div>
                                                <p><i class="bx bx-time-five" aria-hidden="true"></i><?php echo e(date("M d, Y", strtotime($item->start_date))); ?> - <?php echo e(date("M d, Y", strtotime($item->end_date))); ?></p>
                                                <p><i class="bx bx-timer" aria-hidden="true"></i> <?php echo e(CustomHelper::getEventReminderTime($item->alert)); ?></p>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col px-md-2">
                                <div class="tododiv p-2 border">
                                    <h5>Tomorrow - <?php echo e(date("M d, Y", strtotime("+1 day"))); ?></h5>
                                    <hr>
                                    <?php if($tomorrow_list): ?>
                                        <?php $__currentLoopData = $tomorrow_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="p-2 text-white mb-1 border rounded" style="background-color: <?php echo e($item->event_color); ?>">
                                                <div class="title d-flex justify-content-between ">
                                                    <h5 class="text-left fw-bold text-truncate text-white"><?php echo e($item->title); ?> ( <?php echo e($item->venue); ?> )</h4>
                                                    <span class="text-end">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_todo_edit')): ?>
                                                            <a class="text-white" title="Delete Event" href="<?php echo e(route('todo.edit', $item->id )); ?>">
                                                                <i class="bx bx-pencil" aria-hidden="true"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_todo_destroy')): ?>
                                                            <a class="text-white" title="Delete Event" href="javascript:void(0);" onclick="jQuery('#delete-form-<?php echo e($item->id); ?>').submit();">
                                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                            </a>
                                                            <form id="delete-form-<?php echo e($item->id); ?>" onsubmit="return confirm('Are you sure to delete?');" action="<?php echo e(route('todo.destroy',$item->id)); ?>" method="post" style="display: none;">
                                                            <?php echo e(method_field('DELETE')); ?>

                                                            <?php echo e(csrf_field()); ?>

                                                            </form>
                                                        <?php endif; ?>
                                                    </span>
                                                </div>
                                                <p><i class="bx bx-time-five" aria-hidden="true"></i><?php echo e(date("M d, Y", strtotime($item->start_date))); ?> - <?php echo e(date("M d, Y", strtotime($item->end_date))); ?></p>
                                                <p><i class="bx bx-timer" aria-hidden="true"></i> <?php echo e(CustomHelper::getEventReminderTime($item->alert)); ?></p>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col px-md-2">
                                <div class="tododiv p-2 border">
                                    <h5>This week</h5>
                                    <hr>
                                    <?php if($week_list): ?>
                                        <?php $__currentLoopData = $week_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="p-2 text-white mb-1 border rounded" style="background-color: <?php echo e($item->event_color); ?>">
                                                <div class="title d-flex justify-content-between ">
                                                    <h5 class="text-left fw-bold text-truncate text-white"><?php echo e($item->title); ?> ( <?php echo e($item->venue); ?> )</h4>
                                                    <span class="text-end">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_todo_edit')): ?>
                                                            <a class="text-white" title="Delete Event" href="<?php echo e(route('todo.edit', $item->id )); ?>">
                                                                <i class="bx bx-pencil" aria-hidden="true"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_todo_destroy')): ?>
                                                            <a class="text-white" title="Delete Event" href="javascript:void(0);" onclick="jQuery('#delete-form-<?php echo e($item->id); ?>').submit();">
                                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                            </a>
                                                            <form id="delete-form-<?php echo e($item->id); ?>" onsubmit="return confirm('Are you sure to delete?');" action="<?php echo e(route('todo.destroy',$item->id)); ?>" method="post" style="display: none;">
                                                            <?php echo e(method_field('DELETE')); ?>

                                                            <?php echo e(csrf_field()); ?>

                                                            </form>
                                                        <?php endif; ?>
                                                    </span>
                                                </div>
                                                <p><i class="bx bx-time-five" aria-hidden="true"></i><?php echo e(date("M d, Y", strtotime($item->start_date))); ?> - <?php echo e(date("M d, Y", strtotime($item->end_date))); ?></p>
                                                <p><i class="bx bx-timer" aria-hidden="true"></i> <?php echo e(CustomHelper::getEventReminderTime($item->alert)); ?></p>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/tools/todo/index.blade.php ENDPATH**/ ?>