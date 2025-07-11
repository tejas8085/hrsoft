

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Employee Details</h5>
            <a href="<?php echo e(route('employee.index')); ?>" class="btn btn-sm btn-light">← Back to List</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td><?php echo e($employee->id); ?></td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td><?php echo e($employee->name); ?></td>
                </tr>
                <tr>
                    <th>Mobile No</th>
                    <td><?php echo e($employee->mobile); ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo e($employee->email); ?></td>
                </tr>
                <tr>
                    <th>Date Of Birth</th>
                    <td><?php echo e($employee->dob); ?></td>
                </tr>
                <tr>
                    <th>Designation</th>
                    <td><?php echo e($employee->designation); ?></td>
                </tr>
                <tr>
                    <th>Joining Date</th>
                    <td><?php echo e($employee->joining_date); ?></td>
                </tr>
                <tr>
                    <th>Department</th>
                    <td><?php echo e($employee->department); ?></td>
                </tr>
                <tr>
                    <th>UAN No</th>
                    <td><?php echo e($employee->uan); ?></td>
                </tr>
                <tr>
                    <th>PAN No</th>
                    <td><?php echo e($employee->pan); ?></td>
                </tr>
                <tr>
                    <th>PF No</th>
                    <td><?php echo e($employee->pf); ?></td>
                </tr>
                <tr>
                    <th>ESIC No</th>
                    <td><?php echo e($employee->esic); ?></td>
                </tr>
                <tr>
                    <th> Permanant Address</th>
                    <td><?php echo e($employee->paddress); ?></td>
                </tr>
                <tr>
                    <th>Current Address</th>
                    <td><?php echo e($employee->caddress); ?></td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td><?php echo e($employee->created_at->format('d M Y, h:i A')); ?></td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td><?php echo e($employee->updated_at->format('d M Y, h:i A')); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ajeet Kumar Das\Downloads\Laravel-Project\Laravel-Project\hrsoft\resources\views\employee\show.blade.php ENDPATH**/ ?>