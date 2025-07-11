

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between mb-4">
    <form method="GET" action="<?php echo e(route('employee.index')); ?>" class="d-flex gap-2">
        <input type="text" name="id" class="form-control" placeholder="Filter by ID" value="<?php echo e(request('id')); ?>">
        <input type="text" name="name" class="form-control" placeholder="Filter by Name" value="<?php echo e(request('name')); ?>">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <a href="<?php echo e(route('employee.create')); ?>" class="btn btn-success">+ Add Employee</a>
</div>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Joining Date</th>
            <th>Department</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($employee->id); ?></td>
            <td>
                <a href="<?php echo e(route('employee.show', $employee->id)); ?>" style="text-decoration: none; color: inherit;"
                    onmouseover="this.style.fontWeight='bold'; this.style.textDecoration='underline';"
                    onmouseout="this.style.fontWeight='normal'; this.style.textDecoration='none';">
                    <?php echo e($employee->name); ?>

                </a>
            </td>

            <td><?php echo e($employee->designation); ?></td>
            <td><?php echo e($employee->joining_date); ?></td>
            <td><?php echo e($employee->department); ?></td>


        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="5">No employees found.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php echo e($employees->withQueryString()->links()); ?> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ajeet Kumar Das\Downloads\Laravel-Project\Laravel-Project\hrsoft\resources\views\employee\index.blade.php ENDPATH**/ ?>