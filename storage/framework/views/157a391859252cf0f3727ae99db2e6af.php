

<?php $__env->startSection('content'); ?>
<div class="container my-4">
    <h3 class="mb-4">📄 <?php echo e(ucfirst($certificate->type)); ?> Letter</h3>

    <div class="mb-3">
        <a href="<?php echo e(route('certificates.pdf', $certificate->id)); ?>" class="btn btn-outline-dark" target="_blank">
            🖨️ Download as PDF
        </a>
        <a href="<?php echo e(route('staff.dashboard')); ?>" class="btn btn-outline-secondary ms-2">← Back</a>
    </div>

    <div class="card p-4 shadow-sm">
        <?php echo $certificate->content; ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ajeet Kumar Das\Downloads\Laravel-Project\Laravel-Project\hrsoft\resources\views\certificates\view.blade.php ENDPATH**/ ?>