

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mb-4">Generate Certificate</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('certificates.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="employee_id" class="form-label">Select Employee</label>
            <select name="employee_id" id="employee_id" class="form-control" required>
                <option value="">-- Select --</option>
                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($employee->id); ?>"><?php echo e($employee->name); ?> (<?php echo e($employee->employee_code); ?>)</option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Certificate Type</label>
            <select name="type" id="type" class="form-control" required>
                <option value="offer">Offer Letter</option>
                <option value="appointment">Appointment Letter</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Generate Certificate</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ajeet Kumar Das\Downloads\Laravel-Project\Laravel-Project\hrsoft\resources\views\certificates\index.blade.php ENDPATH**/ ?>