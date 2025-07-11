

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Leave Requests</h2>
    <table class="table table-bordered">
        <thead><tr><th>Employee</th><th>From</th><th>To</th><th>Reason</th><th>Status</th><th>Action</th></tr></thead>
        <tbody>
            <?php $__currentLoopData = $leaveRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($leave->employee->name); ?></td>
                    <td><?php echo e($leave->from_date); ?></td>
                    <td><?php echo e($leave->to_date); ?></td>
                    <td><?php echo e($leave->reason); ?></td>
                    <td><?php echo e($leave->status); ?></td>
                    <td>
                        <?php if($leave->status === 'Pending'): ?>
                            <form method="POST" action="<?php echo e(route('hr.leave.update', $leave->id)); ?>">
                                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                <button name="status" value="Approved" class="btn btn-success btn-sm">Approve</button>
                                <button name="status" value="Rejected" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        <?php else: ?>
                            <em><?php echo e($leave->status); ?></em>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <h2 class="mt-5">Resignation Requests</h2>
    <table class="table table-bordered">
        <thead><tr><th>Employee</th><th>Date</th><th>Reason</th><th>Status</th><th>Action</th></tr></thead>
        <tbody>
            <?php $__currentLoopData = $resignations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($resign->employee->name); ?></td>
                    <td><?php echo e($resign->resignation_date); ?></td>
                    <td><?php echo e($resign->reason); ?></td>
                    <td><?php echo e($resign->status); ?></td>
                    <td>
                        <?php if($resign->status === 'Pending'): ?>
                            <form method="POST" action="<?php echo e(route('hr.resignation.update', $resign->id)); ?>">
                                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                <button name="status" value="Approved" class="btn btn-success btn-sm">Approve</button>
                                <button name="status" value="Rejected" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        <?php else: ?>
                            <em><?php echo e($resign->status); ?></em>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ajeet Kumar Das\Downloads\Laravel-Project\Laravel-Project\hrsoft\resources\views\hr\leave_resignations.blade.php ENDPATH**/ ?>