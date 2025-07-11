

<?php $__env->startSection('content'); ?>
<div class="container">
    <h3>Assign New Task</h3>
    <form method="POST" action="<?php echo e(route('pm.tasks.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label>Assign To (Team Member)</label>
            <select name="assigned_to" class="form-control">
                <?php $__currentLoopData = $teamMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($member->employee->id); ?>"><?php echo e($member->employee->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Due Date</label>
            <input type="date" name="due_date" class="form-control">
        </div>
        <button class="btn btn-primary">Assign Task</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ajeet Kumar Das\Downloads\Laravel-Project\Laravel-Project\hrsoft\resources\views\pm\tasks\create.blade.php ENDPATH**/ ?>