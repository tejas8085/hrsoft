

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mb-4">My Certificates</h2>

    <?php if($certificates->isEmpty()): ?>
        <p>No certificates found.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Generated On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $certificate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(ucfirst($certificate->type)); ?> Letter</td>
                        <td><?php echo e($certificate->created_at->format('d M Y')); ?></td>
                        <td>
                            <a href="<?php echo e(route('certificates.view', $certificate->id)); ?>" class="btn btn-sm btn-primary" target="_blank">View</a>
                            <a href="<?php echo e(route('certificates.download', $certificate->id)); ?>" class="btn btn-sm btn-secondary">Download PDF</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ajeet Kumar Das\Downloads\Laravel-Project\Laravel-Project\hrsoft\resources\views\certificates\staff.blade.php ENDPATH**/ ?>