<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.Chat'); ?>
<?php $__env->stopSection(); ?>
<?php
use App\Models\Client;
?>
<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Dashboard
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Ticket Chat
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="d-lg-flex">
        <div class="chat-leftsidebar me-lg-3 col-xl-3">
            <div class="card overflow-hidden">
                <div class="bg-primary bg-soft">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-3">
                                <h5 class="text-primary"><?php echo e($aRow->subject); ?></h5>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="<?php echo e(URL::asset('/assets/images/profile-img.png')); ?>" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="avatar-md profile-user-wid mb-4">
                                <?php
                                    $logo = CustomHelper::getCompanyLogo(Auth::user()->admin_id);
                                ?>
                                <img src="<?php echo e($logo); ?>" alt="" class="img-thumbnail rounded-circle">
                            </div>
                            <h5 class="font-size-15 text-truncate"><?php echo e(Str::ucfirst($aRow->c_name)); ?></h5>
                            <p class="mb-0 text-muted"><?php echo e(date('d-M-Y H:i:s a', strtotime($aRow->created_at))); ?></p>
                        </div>

                        <div class="col-sm-7">
                            <div class="pt-4">
                                <div class="row">
                                    <div class="col-6">
                                        <p class="text-muted mb-0">Status</p>
                                        <h5
                                            class="btn text-white waves-effect waves-light bg-<?php echo e($aRow->status == 0 ? 'danger' : 'success'); ?>">
                                            <?php echo e($aRow->status == 0 ? 'Pending' : 'Closed'); ?></h5>
                                    </div>
                                    <div class="col-6">
                                        <p class="text-muted mb-0">Total Replies</p>
                                        <h5 class="font-size-15 text-center text-white bg-primary rounded p-1"><span
                                                class=""><?php echo e(count($areply)); ?></span></h5>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="mt-4">
                        <div class="card border shadow-none mb-2">
                            <a href="javascript: void(0);" class="text-body">
                                <div class="p-2">
                                    <div class="d-flex">
                                        <div class="avatar-xs align-self-center me-2">
                                            <div class="avatar-title rounded bg-transparent text-success font-size-20">
                                                <i class="mdi mdi-image"></i>
                                            </div>
                                        </div>

                                        <div class="overflow-hidden me-auto pt-4">
                                            <h5 class="font-size-13 text-truncate">Department</h5>
                                        </div>

                                        <div class="ms-2 pt-4">
                                            <p class="text-muted"><?php echo e(CustomHelper::getDepartmentName($aRow->department)); ?>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="card border shadow-none mb-2">
                            <a href="javascript: void(0);" class="text-body">
                                <div class="p-2">
                                    <div class="d-flex">
                                        <div class="avatar-xs align-self-center me-2">
                                            <div class="avatar-title rounded bg-transparent text-success font-size-20">
                                                <i class="mdi mdi-image"></i>
                                            </div>
                                        </div>

                                        <div class="overflow-hidden me-auto pt-4">
                                            <h5 class="font-size-13 text-truncate">Reporter</h5>
                                        </div>

                                        <div class="ms-2 pt-4">
                                            <p class="text-muted">
                                                <?php echo e($aRow->reporter != '' ? Client::$getSalesAgent[$aRow->reporter] : '--'); ?>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="card border shadow-none mb-2">
                            <a href="javascript: void(0);" class="text-body">
                                <div class="p-2">
                                    <div class="d-flex">
                                        <div class="avatar-xs align-self-center me-2">
                                            <div class="avatar-title rounded bg-transparent text-success font-size-20">
                                                <i class="mdi mdi-image"></i>
                                            </div>
                                        </div>

                                        <div class="overflow-hidden me-auto pt-4">
                                            <h5 class="font-size-13 text-truncate">Tags</h5>
                                        </div>

                                        <div class="ms-2 pt-4">
                                            <p class="text-muted"><?php echo e($aRow->tags); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="w-100 user-chat">
            <div class="card">
                <div class="p-4 border-bottom ">
                    <div class="row">
                        <div class="col-md-4 col-9">
                            <h5 class="font-size-15 mb-1"><?php echo e(Str::ucfirst($aRow->u_name)); ?></h5>
                            <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i> Active
                                now</p>
                        </div>
                        <div class="col-md-8 col-3">
                            <ul class="list-inline user-chat-nav text-end mb-0">
                                <li class="list-inline-item d-none d-sm-inline-block">
                                    <div class="dropdown">
                                        <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-search-alt-2"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-md">
                                            <form class="p-3">
                                                <div class="form-group m-0">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" placeholder="Search ..."
                                                            aria-label="Recipient's username">

                                                        <button class="btn btn-primary" type="submit"><i
                                                                class="mdi mdi-magnify"></i></button>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-inline-item  d-none d-sm-inline-block">
                                    <div class="dropdown">
                                        <button class="btn nav-btn dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-cog"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">View Profile</a>
                                            <a class="dropdown-item" href="#">Clear chat</a>
                                            <a class="dropdown-item" href="#">Muted</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-inline-item">
                                    <div class="dropdown">
                                        <button class="btn nav-btn dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-horizontal-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else</a>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>


                <div>
                    <div class="chat-conversation p-3" id="messages">
                        <ul class="list-unstyled mb-0" data-simplebar style="max-height: 486px;">
                            
                            <?php if(count($areply)): ?>
                                <?php $__currentLoopData = $areply; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aKey => $aValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($aValue->type == 0): ?>
                                        <li class="<?php echo e($aKey == count($areply) - 1 ? 'chat-window' : ''); ?>">
                                            <div class="conversation-list">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle" href="#" role="button"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Copy</a>
                                                        <a class="dropdown-item" href="#">Save</a>
                                                        <a class="dropdown-item" href="#">Forward</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                                <div class="ctext-wrap">
                                                    <div class="conversation-name"><?php echo e($aValue->name); ?></div>
                                                    <p><?php echo $aValue->message; ?></p>
                                                    <p class="chat-time mb-0"><i
                                                            class="bx bx-time-five align-middle me-1"></i>
                                                        <?php echo e($aValue->created_at); ?></p>
                                                </div>
                                            </div>
                                        </li>
                                    <?php else: ?>
                                        <li class="right <?php echo e($aKey == count($areply) - 1 ? 'chat-window' : ''); ?>">
                                            <div class="conversation-list">
                                                <div class="dropdown">

                                                    <a class="dropdown-toggle" href="#" role="button"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Copy</a>
                                                        <a class="dropdown-item" href="#">Save</a>
                                                        <a class="dropdown-item" href="#">Forward</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                                <div class="ctext-wrap">
                                                    <div class="conversation-name"><?php echo e($aValue->name); ?></div>
                                                    <p><?php echo $aValue->message; ?></p>

                                                    <p class="chat-time mb-0"><i
                                                            class="bx bx-time-five align-middle me-1"></i>
                                                        <?php echo e($aValue->created_at); ?></p>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <li id="chat-window"></li>
                        </ul>
                    </div>
                    <?php if($aRow->status == 0): ?>
                        <form action="<?php echo e(route('admin_client-ticket.saveReply')); ?>" enctype="multipart/form-data"
                            method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="p-3 chat-input-section">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="position-relative">
                                            <input type="hidden" name="ticket_id" value="<?php echo e($aRow->id); ?>">
                                            <textarea id="elm1" name="message"></textarea>
                                            
                                        </div>
                                    </div>
                                    <div class="col-auto mt-2">
                                        <button type="submit"
                                            class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light"><span
                                                class="d-none d-sm-inline-block me-2">Send</span> <i
                                                class="mdi mdi-send"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('/assets/libs/tinymce/tinymce.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/js/pages/form-editor.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/libs/apexcharts/apexcharts.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/js/pages/file-manager.init.js')); ?>"></script>

    <script>
        tinyMCE.init({
            height: "480"
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/clientTicket/admin-chat.blade.php ENDPATH**/ ?>