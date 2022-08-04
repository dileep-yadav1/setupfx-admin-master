<?php $__env->startSection('title'); ?>
    <?php if($aRow): ?>
        Edit
    <?php else: ?>
        Add
    <?php endif; ?> Lead
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Dashboard
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('li_2'); ?>
            Lead List
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            <?php if($aRow): ?>
                Edit
            <?php else: ?>
                Add
            <?php endif; ?> Lead
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <?php if($aRow): ?>
                        <form method="POST" action="<?php echo e(route('leads.update', $aRow->id)); ?>" enctype="multipart/form-data"
                            id="ClientForm" name="ClientForm">
                            <?php echo method_field('PUT'); ?>
                        <?php else: ?>
                            <form method="POST" action="<?php echo e(route('leads.store')); ?>" enctype="multipart/form-data"
                                id="ClientForm" name="ClientForm">
                    <?php endif; ?>
                    <?php echo csrf_field(); ?>
                    <div id="vertical-example" class="vertical-wizard">
                        <!-- General Details -->
                        <h3>General Details</h3>
                        <section>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">First Name</label>
                                        <input type="text" class="form-control" name="first_name"
                                            value="<?php echo e($aRow ? $aRow->first_name : ''); ?>" id="basicpill-firstname-input"
                                            placeholder="Enter Your First Name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-lastname-input">Last Name(Surname)</label>
                                        <input type="text" class="form-control" name="last_name"
                                            value="<?php echo e($aRow ? $aRow->last_name : ''); ?>" id="basicpill-lastname-input"
                                            placeholder="Enter Your Last Name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-phoneno-input">Phone</label>
                                        <input type="text" class="form-control" name="contact"
                                            id="basicpill-phoneno-input" value="<?php echo e($aRow ? $aRow->contact : ''); ?>"
                                            placeholder="Enter Your Phone No.">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-email-input">Email</label>
                                        <input type="email" class="form-control" name="email" id="basicpill-email-input"
                                            value="<?php echo e($aRow ? $aRow->email : ''); ?>" placeholder="Enter Your Email ID">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-email-input">Country</label>
                                        <input type="textl" class="form-control" name="country" id="basicpill-email-input"
                                            value="<?php echo e($aRow ? $aRow->country : ''); ?>" placeholder="Enter Your Email ID">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-email-input" class="form-label">Password</label>
                                        <input id="password" type="password"
                                            class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password"
                                            placeholder="Password">
                                        <?php if($errors->has('password')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('password')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-password-input" class="form-label">Confirm Password</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" autocomplete="new-password"
                                            placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                            
                        </section>
                        <!-- Director Details -->
                        <h3>Personal Details</h3>
                        <section>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-lastname-input">Company Name</label>
                                        <input type="text" class="form-control" name="company_name"
                                            value="<?php echo e($aRow ? $aRow->company_name : ''); ?>" id="basicpill-lastname-input"
                                            placeholder="Enter Your Company Name">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-address-input">Date of Birth</label>
                                        <input type="date" name="date_of_birth" class="form-control"
                                            id="basicpill-email-input" placeholder="Enter Your Email ID"
                                            value="<?php echo e($aRow ? date('Y-m-d', strtotime($aRow->dob)) : ''); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="basicpill-address-input">Nationality</label>
                                        <?php echo e(Form::select('nationality', ['' => 'Please Select'] + $aCountry, $aRow ? $aRow->nationality : null, ['class' => 'form-control', 'required' => 'required'])); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-address-input">Address 1</label>
                                        <textarea id="basicpill-address-input" class="form-control" name="address_1" rows="2"
                                            placeholder="Enter Your Address"><?php echo e($aRow ? $aRow->address_1 : ''); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-address-input">Address 2</label>
                                        <textarea id="basicpill-address-input" class="form-control" name="address_2" rows="2"
                                            placeholder="Enter Your Address"><?php echo e($aRow ? $aRow->address_2 : ''); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="basicpill-address-input">Country</label>
                                        <?php echo e(Form::select('country_id', ['' => 'Please Select'] + $aCountry, $aRow ? $aRow->country : null, ['id' => 'country-dropdown', 'class' => 'form-control', 'required' => 'required'])); ?>

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="basicpill-address-input">State</label>
                                        <?php if($aRow): ?>
                                            <?php echo e(Form::select('state', ['' => 'Please Select'] + $aState, $aRow ? $aRow->state : null, ['id' => 'state-dropdown', 'class' => 'form-control', 'required' => 'required'])); ?>

                                        <?php else: ?>
                                            <select class="form-control" name="state" id="state-dropdown">
                                                <option>Please Select... </option>
                                            </select>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="basicpill-address-input">City</label>
                                        <?php if($aRow): ?>
                                            <?php echo e(Form::select('city', ['' => 'Please Select'] + $aCity, $aRow ? $aRow->city : null, ['id' => 'city-dropdown', 'class' => 'form-control', 'required' => 'required'])); ?>

                                        <?php else: ?>
                                            <select class="form-control" name="city" id="city-dropdown">
                                                <option>Please Select... </option>
                                            </select>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="basicpill-address-input">Zipcode</label>
                                        <input type="text" class="form-control" id="basicpill-email-input"
                                            name="zipcode" placeholder="110072"
                                            value="<?php echo e($aRow ? $aRow->zipcode : ''); ?>">
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Company Document -->
                        <h3>Financial Details</h3>
                        <section>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-networth-input">Total Estimated Net Worth (<i class="fas fa-rupee-sign"></i>)?</label>
                                        <?php echo e(Form::select('net_worth', ['' => 'Please Select'] + $incomeData, $aRow ? $aRow->net_worth : null, ['class' => 'form-control', 'required' => 'required'])); ?>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-networth-input">Total Estimated Annual Income (<i class="fas fa-rupee-sign"></i>)?</label>
                                        <?php echo e(Form::select('annual_income', ['' => 'Please Select'] + $incomeData, $aRow ? $aRow->annual_income : null, ['class' => 'form-control', 'required' => 'required'])); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-networth-input">Your Employment Status</label>
                                        <?php echo e(Form::select('emp_status', ['' => 'Please Select'] + $empStatus, $aRow ? $aRow->emp_status : null, ['class' => 'form-control', 'required' => 'required'])); ?>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-networth-input">Source Of Income/Wealth</label>
                                        <?php echo e(Form::select('source_income', ['' => 'Please Select'] + $sourceIncome, $aRow ? $aRow->source_income : null, ['class' => 'form-control', 'required' => 'required'])); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="basicpill-networth-input">FOREX, CFDS And Other Instruments</label>
                                        <?php echo e(Form::select('invest_known', ['' => 'Please Select'] + $expStatus, $aRow ? $aRow->invest_known : null, ['class' => 'form-control', 'required' => 'required'])); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="basicpill-networth-input">Trading products are suitable as part of my
                                            investment objectives and I am able to assess the risk involved in trading them,
                                            including the possibility that I may lose all of my capital</label>
                                        <?php echo e(Form::select('objective_exp', ['' => 'Please Select'] + $expStatus, $aRow ? $aRow->objective_exp : null, ['class' => 'form-control', 'required' => 'required'])); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="basicpill-networth-input">I have previous professional qualifications and/or work experience in the financial services industry</label>
                                        <?php echo e(Form::select('previous_exp', ['' => 'Please Select'] + $expStatus, $aRow ? $aRow->previous_exp : null, ['class' => 'form-control', 'required' => 'required'])); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="basicpill-networth-input">Expected initial amount of Investment in Rupees(<i class="fas fa-rupee-sign"></i>) ?</label>
                                        <?php echo e(Form::select('initial_amt', ['' => 'Please Select'] + $incomeData, $aRow ? $aRow->initial_amt : null, ['class' => 'form-control', 'required' => 'required'])); ?>

                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <!-- jquery step -->
    <script src="<?php echo e(URL::asset('/assets/libs/jquery-steps/jquery-steps.min.js')); ?>"></script>
    <!-- form wizard init -->
    <script src="<?php echo e(URL::asset('/assets/js/pages/form-wizard.init.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            $('#country-dropdown').on('change', function() {
                var country_id = this.value;
                $("#state-dropdown").html('');
                $.ajax({
                    url: "<?php echo e(url('get-states-by-country')); ?>",
                    type: "POST",
                    data: {
                        country_id: country_id,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#state-dropdown').html('<option value="">Select State</option>');
                        $.each(result.states, function(key, value) {
                            $("#state-dropdown").append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                        $('#city-dropdown').html(
                            '<option value="">Select State First</option>');
                    }
                });
            });
            $('#state-dropdown').on('change', function() {
                var state_id = this.value;
                $("#city-dropdown").html('');
                $.ajax({
                    url: "<?php echo e(url('get-cities-by-state')); ?>",
                    type: "POST",
                    data: {
                        state_id: state_id,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#city-dropdown').html('<option value="">Select City</option>');
                        $.each(result.cities, function(key, value) {
                            $("#city-dropdown").append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/clients/add.blade.php ENDPATH**/ ?>