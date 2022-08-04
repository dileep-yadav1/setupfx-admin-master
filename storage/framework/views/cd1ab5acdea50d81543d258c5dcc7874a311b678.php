<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="<?php echo e(route('root')); ?>" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?php echo e(URL::asset('/assets/images/logo.svg')); ?>" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo e(URL::asset('/assets/images/logo-dark.png')); ?>" alt="" height="17">
                    </span>
                </a>

                <a href="<?php echo e(route('root')); ?>" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?php echo e(URL::asset('/assets/images/logo-light.svg')); ?>" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <?php
                            $logo = CustomHelper::getCompanyLogo(Auth::user()->admin_id);
                        ?>
                        <img src="<?php echo e($logo); ?>" alt="" height="19">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light"
                data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get('translation.Search'); ?>">
                    <span class="bx bx-search-alt"></span>
                </div>
            </form>
        </div>

        <div class="d-flex">

            

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                        src="<?php echo e(CustomHelper::displayImage(Auth::user()->avatar)); ?>" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1"
                        key="t-henry"><?php echo e(ucfirst(Auth::user()->name)); ?></span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="<?php echo e(route('contactProfile')); ?>"><i
                            class="bx bx-user font-size-16 align-middle me-1"></i> <span
                            key="t-profile"><?php echo app('translator')->get('translation.Profile'); ?></span></a>
                    <a class="dropdown-item d-block" href="#" data-bs-toggle="modal"
                        data-bs-target=".change-password">
                        <i class="bx bx-wrench font-size-16 align-middle me-1"></i>
                        <span key="t-settings"><?php echo app('translator')->get('translation.Change Password'); ?></span>
                    </a>
                    <a class="dropdown-item text-danger" href="javascript:void();"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span
                            key="t-logout"><?php echo app('translator')->get('translation.Logout'); ?></span></a>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="<?php echo e(route('root')); ?>"
                            id="topnav-dashboard" role="button">
                            <i class="bx bx-home-circle me-2"></i><span key="t-dashboards"><?php echo app('translator')->get('translation.Dashboards'); ?></span>
                        </a>
                    </li>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_staff_list')): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="<?php echo e(route('staff.index')); ?>"
                                id="topnav-uielement" role="button">
                                <i class="bx bxs-user-detail"></i>
                                <span key="t-dashboards"><?php echo app('translator')->get('translation.Staff'); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('client_list')): ?>
                        <li class="nav-item dropdown">
                            <a href="<?php echo e(route('leads.index')); ?>" class="nav-link dropdown-toggle arrow-none"
                                id="topnav-uielement">
                                <i class="bx bxs-user-detail"></i>
                                <span key="t-dashboards"><?php echo app('translator')->get('translation.Leads'); ?></span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="<?php echo e(route('client.index')); ?>" class="nav-link dropdown-toggle arrow-none"
                                id="topnav-uielement">
                                <i class="bx bxs-user-detail"></i>
                                <span key="t-dashboards"><?php echo app('translator')->get('translation.Clients'); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('client_ticket_create')): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layout"
                                role="button">
                                <i class="fas fa-ticket-alt"></i><span key="t-layouts"><?php echo app('translator')->get('translation.Tickets'); ?></span>
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-layout">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_ticket_create')): ?>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none"
                                            href="<?php echo e(route('ticket.index')); ?>" id="topnav-layout-verti" role="button">
                                            <span key="t-vertical"><?php echo app('translator')->get('translation.Tickets'); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('client_ticket_create')): ?>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none"
                                            href="<?php echo e(route('client-ticket.index')); ?>" id="topnav-layout-verti"
                                            role="button">
                                            <span key="t-vertical"><?php echo app('translator')->get('translation.Client Ticket'); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_email_create')): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layout"
                                role="button">
                                <i class="mdi mdi-email"></i><span key="t-layouts"><?php echo app('translator')->get('translation.Email'); ?></span>
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-layout">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_email_create')): ?>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none"
                                            href="<?php echo e(route('email.index')); ?>" id="topnav-layout-verti" role="button">
                                            <span key="t-vertical"><?php echo app('translator')->get('translation.Email'); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_email_create')): ?>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none"
                                            href="<?php echo e(route('mail_variables.index')); ?>" id="topnav-layout-verti"
                                            role="button">
                                            <span key="t-vertical"><?php echo app('translator')->get('translation.Mail Variable'); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_tools')): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layout"
                                role="button">
                                <i class="fas fa-wrench"></i><span key="t-layouts"><?php echo app('translator')->get('translation.Tools'); ?></span>
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-layout">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('calendar_list')): ?>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none"
                                            href="<?php echo e(route('calendar.index')); ?>" id="topnav-layout-verti" role="button">
                                            <span key="t-vertical"><?php echo app('translator')->get('translation.Calendars'); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('notes_list')): ?>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none"
                                            href="<?php echo e(route('note.index')); ?>" id="topnav-layout-verti" role="button">
                                            <span key="t-vertical"><?php echo app('translator')->get('translation.Note'); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('todo_list')): ?>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none"
                                            href="<?php echo e(route('todo.index')); ?>" id="topnav-layout-verti" role="button">
                                            <span key="t-vertical"><?php echo app('translator')->get('translation.Todo'); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_message_list')): ?>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none"
                                            href="<?php echo e(route('messages.index')); ?>" id="topnav-layout-verti" role="button">
                                            <span key="t-vertical"><?php echo app('translator')->get('translation.Message'); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_marketing')): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layout"
                                role="button">
                                <i class="fas fa-bullhorn"></i><span key="t-layouts"><?php echo app('translator')->get('translation.Marketing'); ?></span>
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-layout">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_contact_list')): ?>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none"
                                            href="<?php echo e(route('contact.index')); ?>" id="topnav-layout-verti" role="button">
                                            <span key="t-vertical"><?php echo app('translator')->get('translation.Contact_List'); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_email_campaign_list')): ?>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none"
                                            href="<?php echo e(route('email_campaign.index')); ?>" id="topnav-layout-verti"
                                            role="button">
                                            <span key="t-vertical"><?php echo app('translator')->get('translation.Email Campaign'); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin-setting')): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layout"
                                role="button">
                                <i class="fas fa-cogs"><span key="t-layouts"><?php echo app('translator')->get('translation.Settings'); ?></span>
                                    <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-layout">
                                <?php $SettingList = \CustomHelper::getSettingList() ?>
                                <?php if($SettingList): ?>
                                    <?php $__currentLoopData = $SettingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none"
                                                href="<?php echo e(url('/setting')); ?>/<?php echo e($key); ?>"
                                                id="topnav-layout-verti" role="button">
                                                <span key="t-vertical"><?php echo app('translator')->get('translation.' . $value); ?></span>
                                            </a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>
        </nav>
    </div>
</div>

<!--  Change-Password example -->
<div class="modal fade change-password" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="change-password">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" value="<?php echo e(Auth::user()->id); ?>" id="data_id">
                    <div class="mb-3">
                        <label for="current_password">Current Password</label>
                        <input id="current-password" type="password"
                            class="form-control <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="current_password" autocomplete="current_password"
                            placeholder="Enter Current Password" value="<?php echo e(old('current_password')); ?>">
                        <div class="text-danger" id="current_passwordError" data-ajax-feedback="current_password">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="newpassword">New Password</label>
                        <input id="password" type="password"
                            class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password"
                            autocomplete="new_password" placeholder="Enter New Password">
                        <div class="text-danger" id="passwordError" data-ajax-feedback="password"></div>
                    </div>

                    <div class="mb-3">
                        <label for="userpassword">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control"
                            name="password_confirmation" autocomplete="new_password"
                            placeholder="Enter New Confirm password">
                        <div class="text-danger" id="password_confirmError" data-ajax-feedback="password-confirm">
                        </div>
                    </div>

                    <div class="mt-3 d-grid">
                        <button class="btn btn-primary waves-effect waves-light UpdatePassword"
                            data-id="<?php echo e(Auth::user()->id); ?>" type="submit">Update Password</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/layouts/horizontal.blade.php ENDPATH**/ ?>