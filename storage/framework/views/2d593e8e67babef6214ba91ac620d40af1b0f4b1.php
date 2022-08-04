<div class="container-fuild">
	<div class="row">
		<?php if(session()->has('message')): ?>
			<div class="col-md-12 mt-3 px-3"><div class="alert calltimer alert-success"><?php echo e(session()->get('message')); ?></div></div>
		<?php endif; ?>
		<?php if(session()->has('error')): ?>
			<div class="col-md-12 mt-3 px-3"><div class="alert calltimer alert-danger"><?php echo e(session()->get('error')); ?></div></div>
		<?php endif; ?>
		<?php if($errors->any()): ?>
		<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col-md-12 mt-3 px-3"><div class="alert calltimer alert-danger"><?php echo e($error); ?></div></div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>
	</div>
</div>
<?php /**PATH /opt/lampp/htdocs/setupfx-admin-master/resources/views/components/message.blade.php ENDPATH**/ ?>