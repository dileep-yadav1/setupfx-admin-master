<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.Import_Leads'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <!-- Plugins css -->
    <link href="<?php echo e(URL::asset('/assets/libs/dropzone/dropzone.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Leads
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Import Leads
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Import Leads</h4>
                    

                    <div>
                        <form action="<?php echo e(route('import.leads')); ?>" id="UploadLead-form" method="POST"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            
                                <input name="file" type="file">
                            
                            
                                
                                    
                                

                                
                            </div>
                        </form>
                    </div>
                    <div class="text-center mt-4">
                        <a class="btn btn-primary waves-effect waves-light" href="<?php echo e(route('import.leads')); ?>"
                            onclick="event.preventDefault();document.getElementById('UploadLead-form').submit();"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Import Lead
                        </a>
                        
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <!-- Plugins js -->
    <script src="<?php echo e(URL::asset('/assets/libs/dropzone/dropzone.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/clients/import.blade.php ENDPATH**/ ?>