<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu"><?php echo app('translator')->get('translation.Menu'); ?></li>

                <li>
                    <a href="<?php echo e(route('root')); ?>" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards"><?php echo app('translator')->get('translation.Dashboards'); ?></span>
                    </a>
                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_staff_list')): ?>
                    <li>
                        <a href="<?php echo e(route('staff.index')); ?>" class="waves-effect">
                            <i class="bx bxs-user-detail"></i>
                            <span key="t-dashboards"><?php echo app('translator')->get('translation.Staff'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('client_list')): ?>
                    <li>
                        <a href="<?php echo e(route('leads.index')); ?>" class="waves-effect">
                            <i class="bx bxs-user-detail"></i>
                            <span key="t-dashboards"><?php echo app('translator')->get('translation.Leads'); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('client.index')); ?>" class="waves-effect">
                            <i class="bx bxs-user-detail"></i>
                            <span key="t-dashboards"><?php echo app('translator')->get('translation.Clients'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('client_ticket_create')): ?>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-ticket-alt"></i>
                            <span key="t-dashboards"><?php echo app('translator')->get('translation.Tickets'); ?></span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_ticket_create')): ?>
                                <li>
                                    <a href="<?php echo e(route('ticket.index')); ?>" class="waves-effect">
                                        <span key="t-dashboards"><?php echo app('translator')->get('translation.Tickets'); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('client_ticket_create')): ?>
                                <li>
                                    <a href="<?php echo e(route('client-ticket.index')); ?>" class="waves-effect">
                                        <span key="t-dashboards"><?php echo app('translator')->get('translation.Client Ticket'); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_email_create')): ?>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-email"></i>
                            <span key="t-dashboards"><?php echo app('translator')->get('translation.Email'); ?></span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_email_create')): ?>
                                <li>
                                    <a href="<?php echo e(route('email.index')); ?>" class="waves-effect">
                                        <span key="t-dashboards"><?php echo app('translator')->get('translation.Email'); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_email_create')): ?>
                                <li>
                                    <a href="<?php echo e(route('mail_variables.index')); ?>" class="waves-effect">
                                        <span key="t-dashboards"><?php echo app('translator')->get('translation.Mail Variable'); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_tools')): ?>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-wrench"></i>
                            <span key="t-dashboards"><?php echo app('translator')->get('translation.Tools'); ?></span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('calendar_list')): ?>
                                <li>
                                    <a href="<?php echo e(route('calendar.index')); ?>" class="waves-effect">
                                        
                                        <span key="t-dashboards"><?php echo app('translator')->get('translation.Calendars'); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('notes_list')): ?>
                                <li>
                                    <a href="<?php echo e(route('note.index')); ?>" class="waves-effect">
                                        
                                        <span key="t-dashboards"><?php echo app('translator')->get('translation.Note'); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('todo_list')): ?>
                                <li>
                                    <a href="<?php echo e(route('todo.index')); ?>" class="waves-effect">
                                        
                                        <span key="t-dashboards"><?php echo app('translator')->get('translation.Todo'); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_message_list')): ?>
                                <li>
                                    <a href="<?php echo e(route('messages.index')); ?>" class="waves-effect">
                                        <span key="t-dashboards"><?php echo app('translator')->get('translation.Message'); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_marketing')): ?>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-bullhorn"></i>
                            <span key="t-dashboards"><?php echo app('translator')->get('translation.Marketing'); ?></span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_contact_list')): ?>
                                <li>
                                    <a href="<?php echo e(route('contact.index')); ?>" class="waves-effect">
                                        <span key="t-dashboards"><?php echo app('translator')->get('translation.Contact_List'); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_email_campaign_list')): ?>
                                <li>
                                    <a href="<?php echo e(route('email_campaign.index')); ?>" class="waves-effect">
                                        <span key="t-dashboards"><?php echo app('translator')->get('translation.Email Campaign'); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin-setting')): ?>
                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="fas fa-cogs"></i><span class="badge rounded-pill bg-info float-end"></span>
                            <span key="t-dashboards"><?php echo app('translator')->get('translation.Settings'); ?></span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <?php $SettingList = \CustomHelper::getSettingList() ?>
                            <?php if($SettingList): ?>
                                <?php $__currentLoopData = $SettingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(url('/setting')); ?>/<?php echo e($key); ?>"
                                            key="t-default"><?php echo app('translator')->get('translation.' . $value); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

<?php /**PATH /opt/lampp/htdocs/forex-admin/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>