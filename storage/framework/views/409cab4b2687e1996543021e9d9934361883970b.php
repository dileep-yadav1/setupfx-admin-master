<?php
$showFilter = "";
$arrFilter = ["name","email","contact","country_id","state_id","city_id","nationality","company_name","dob","net_worth","annual_income","emp_status","source_income","initial_amt"];
?>
<?php if(count(array_intersect(collect(array_filter(collect(Request::all())->toArray(), 'strlen'))->keys()->toArray(), $arrFilter)) > 0): ?>
    <?php  $showFilter = "show"; ?>
<?php endif; ?>
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.Client_List'); ?>
<?php $__env->stopSection(); ?>
<?php
use App\Models\Client;
?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">Clients</p>
                            <h4 class="mb-0"><?php echo e($total_leads); ?></h4>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                <span class="avatar-title">
                                    <i class="bx bx-copy-alt font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">Today</p>
                            <h4 class="mb-0"><?php echo e($today); ?></h4>
                        </div>

                        <div class="flex-shrink-0 align-self-center ">
                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                <span class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bx-archive-in font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">This Week</p>
                            <h4 class="mb-0"><?php echo e($week); ?></h4>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                <span class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">This Month</p>
                            <h4 class="mb-0"><?php echo e($month); ?></h4>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                <span class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Dashboard
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Client List
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="accordion mt-2 mb-2" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Filter
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse <?php echo e($showFilter); ?>" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample" style="">
                <div class="accordion-body">
                    <div class="text-muted">
                        <form method="GET" action="<?php echo e(route('client.index')); ?>">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">First Name</label>
                                        <input type="text" id="first_name" name="first_name" class="form-control"
                                        value="<?php echo e(Request::get('first_name')); ?>" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Email</label>
                                        <input type="text" id="email" name="email" class="form-control"
                                            value="<?php echo e(Request::get('email')); ?>" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="formrow-email-input" class="form-label">Contact</label>
                                        <input type="text" id="contact" name="contact" class="form-control"
                                        value="<?php echo e(Request::get('contact')); ?>" placeholder="Contact">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Country</label>
                                        <?php echo e(Form::select('country_id', ['' => 'Please Select'] + $aCountry, Request::get('country_id'), ['class' => 'form-control'])); ?>

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">State</label>
                                        <?php echo e(Form::select('state_id', ['' => 'Please Select'] + $aState, Request::get('state_id'), ['class' => 'form-control'])); ?>

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">City</label>
                                        <?php echo e(Form::select('city_id', ['' => 'Please Select'] + $aCity, Request::get('city_id'), ['class' => 'form-control'])); ?>

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Nationality</label>
                                        <input type="text" id="nationality" name="nationality" class="form-control"
                                        value="<?php echo e(Request::get('nationality')); ?>" placeholder="Nationality">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Company Name</label>
                                        <input type="text" id="company_name" name="company_name" class="form-control"
                                        value="<?php echo e(Request::get('company_name')); ?>" placeholder="Company Name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Date of Birth</label>
                                        <input type="date" id="dob" name="dob" class="form-control"
                                        value="<?php echo e((Request::get('dob')) ? date('Y-m-d',strtotime(Request::get('dob'))) : ""); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Net Worth</label>
                                        <?php echo e(Form::select('net_worth', ['' => 'Please Select'] + $incomeData, Request::get('net_worth'), ['class' => 'form-control'])); ?>

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Annual Income</label>
                                        <?php echo e(Form::select('annual_income', ['' => 'Please Select'] + $incomeData, Request::get('annual_income'), ['class' => 'form-control'])); ?>

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Employment Status</label>
                                        <?php echo e(Form::select('emp_status', ['' => 'Please Select'] + $empStatus, Request::get('emp_status'), ['class' => 'form-control'])); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Source of Income</label>
                                        <?php echo e(Form::select('source_income', ['' => 'Please Select'] + $sourceIncome, Request::get('source_income'), ['class' => 'form-control'])); ?>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label">Initial Investment</label>
                                        <?php echo e(Form::select('initial_amt', ['' => 'Please Select'] + $incomeData, Request::get('initial_amt'), ['class' => 'form-control'])); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="formrow-firstname-input" class="d-block">&nbsp;</label>
                                    <button type="submit" class="btn btn-success w-md">Submit</button>
                                    <a href="<?php echo e(route('client.index')); ?>" class="btn btn-danger w-md">Reset</a>
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

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('client_create')): ?>
                        
                    <?php endif; ?>
                    <?php if(count($aLeads)): ?>
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 70px;">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Country</th>
                                        <th scope="col">Created At</th>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('client_status')): ?>
                                            <th scope="col">Status</th>
                                        <?php endif; ?>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $aLeads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(++$key); ?></td>
                                            <td><?php echo e($lead->first_name); ?> <?php echo e($lead->last_name); ?></td>
                                            <td><?php echo e($lead->email); ?></td>
                                            <td><?php echo e($lead->contact ? $lead->contact : '---------'); ?></td>
                                            <td><?php echo e(isset($lead->country) ? $lead->country : '-------'); ?></td>
                                            <td><?php echo e(date('d-m-Y', strtotime($lead->created_at))); ?></td>
                                            <td>
                                                <span
                                                    class="btn btn-<?php echo e(CustomHelper::$getClientBadge[$lead->status]); ?> waves-effect waves-light"><?php echo e(CustomHelper::$getClientStatus[$lead->status]); ?></span>
                                            </td>
                                            <td>
                                                <ul class="list-inline font-size-20 contact-links mb-0">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('client_edit')): ?>
                                                        <li class="list-inline-item ">
                                                            <a href="<?php echo e(route('client.edit', $lead->id)); ?>" title="Edit User">
                                                                <i class="bx bx bx-edit-alt"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <button type="button"
                                                                class="btn btn-primary waves-effect waves-light"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#myModalClient<?php echo e($lead->id); ?>">
                                                                Client Details</button>

                                                            <!-- Modal -->
                                                            <div id="myModalClient<?php echo e($lead->id); ?>" class="modal fade "
                                                                tabindex="-1" aria-labelledby="myModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="myModalLabel">
                                                                                Client Permission</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-lg-6">
                                                                                    <div class="mb-3">
                                                                                        <label
                                                                                            for="basicpill-firstname-input">First
                                                                                            Name</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="first_name"
                                                                                            value="<?php echo e($lead->first_name); ?>"
                                                                                            id="basicpill-firstname-input"
                                                                                            placeholder="Enter Your First Name"
                                                                                            readonly>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    <div class="mb-3">
                                                                                        <label
                                                                                            for="basicpill-lastname-input">Last
                                                                                            Name</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="last_name"
                                                                                            value="<?php echo e($lead->last_name); ?>"
                                                                                            id="basicpill-lastname-input"
                                                                                            placeholder="Enter Your Last Name"
                                                                                            readonly>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <div class="mb-3">
                                                                                    <label
                                                                                        for="basicpill-firstname-input">Email</label>
                                                                                    <input type="text" class="form-control"
                                                                                        name="email"
                                                                                        value="<?php echo e($lead->email); ?>"
                                                                                        id="basicpill-firstname-input"
                                                                                        placeholder="Enter Your First Name"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div><!-- /.modal-content -->
                                                                    </form>
                                                                </div><!-- /.modal-dialog -->
                                                            </div>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        
                    <?php else: ?>
                        No data found
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function() {
            $('.clientStatus').on('change', function() {
                // console.log
                var status = this.value;
                var id = $(this).data('target');
                console.log(status);
                $.ajax({
                    url: "<?php echo e(route('lead.changeStatus')); ?>",
                    type: "POST",
                    data: {
                        status: status,
                        id: id,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log();
                        if (response['status']) {
                            location.reload();
                        }
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/clients/client-index.blade.php ENDPATH**/ ?>