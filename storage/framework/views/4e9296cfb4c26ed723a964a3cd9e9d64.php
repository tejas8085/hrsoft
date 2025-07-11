

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h2 class="mb-4 text-center fw-bold text-primary">Welcome, <?php echo e($employee->name); ?>!</h2>

    
    <div class="card border-info shadow-sm mb-5">
        <div class="card-header bg-info text-white fw-semibold">🔔 Notifications</div>
        <div class="card-body">
            <?php if($notifications && count($notifications)): ?>
                <ul class="mb-0">
                    <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($note); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php else: ?>
                <p>No notifications.</p>
            <?php endif; ?>
        </div>
    </div>

        
    <div class="card border-secondary shadow-sm mb-5">
        <div class="card-header bg-secondary text-white fw-semibold">📝 Task Overview</div>
        <div class="card-body row g-4">
            <div class="col-md-4">
                <h5 class="text-primary">📌 Current Tasks</h5>
                <ul>
                    <li>Submit daily report</li>
                    <li>Attend team meeting</li>
                    <li>Review payroll entries</li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5 class="text-success">✅ Completed Tasks</h5>
                <ul>
                    <li>Updated profile information</li>
                    <li>Marked attendance</li>
                    <li>Submitted leave application</li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5 class="text-warning">🕒 Upcoming Tasks</h5>
                <ul>
                    <li>Submit performance review (5th Jul)</li>
                    <li>Project demo presentation (10th Jul)</li>
                    <li>Training session (15th Jul)</li>
                </ul>
            </div>
        </div>
    </div>


    
    
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="<?php echo e(route('staff.dashboard')); ?>" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="month" class="form-label">Select Month</label>
                    <input type="month" id="month" name="month" class="form-control" value="<?php echo e(request('month', now()->format('Y-m'))); ?>">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">View</button>
                </div>
            </form>
        </div>
    </div>


    
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-primary shadow-sm h-100">
                <div class="card-header bg-primary text-white fw-semibold">Attendance (<?php echo e(\Carbon\Carbon::parse($month . '-01')->format('F Y')); ?>)</div>
                <div class="card-body">
                    <p class="mb-2"><strong>✅ Present:</strong> <?php echo e($attendance->where('status', 'Present')->count()); ?></p>
                    <p><strong>🚫 Leave:</strong> <?php echo e($attendance->where('status', 'Leave')->count()); ?></p>
                </div>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="card border-success shadow-sm h-100">
                <div class="card-header bg-success text-white fw-semibold">Salary Details</div>
                <div class="card-body">
                    <?php if($payroll): ?>
                        <p><strong>💰 Gross:</strong> ₹<?php echo e(number_format($payroll->gross_salary, 2)); ?></p>
                        <p><strong>🧾 Net:</strong> ₹<?php echo e(number_format($payroll->net_salary, 2)); ?></p>
                        <a href="<?php echo e(route('payroll.payslip', $payroll->id)); ?>" target="_blank" class="btn btn-outline-dark mt-2">
                            🖨️ Print Payslip (<?php echo e(\Carbon\Carbon::parse($month . '-01')->format('F Y')); ?>)
                        </a>
                    <?php else: ?>
                        <p class="text-danger">No payroll found for <?php echo e(\Carbon\Carbon::parse($month . '-01')->format('F Y')); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card border-dark shadow-sm mb-4">
        <div class="card-header bg-dark text-white fw-semibold">⚙️ Actions</div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><a href="<?php echo e(route('staff.leave.request')); ?>">📝 Submit Leave Request</a></li>
                <li class="list-group-item"><a href="<?php echo e(route('staff.resignation.request')); ?>">📤 Submit Resignation</a></li>
            </ul>
        </div>
    </div>


    
    <div class="card border-warning shadow-sm my-4">
        <div class="card-header bg-warning fw-semibold">🎉 This Month's Birthdays</div>
        <div class="card-body">
            <?php $__empty_1 = true; $__currentLoopData = $birthdays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <p>🎂 <?php echo e($b->name); ?> — <?php echo e(\Carbon\Carbon::parse($b->dob)->format('d M')); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p>No birthdays this month.</p>
            <?php endif; ?>
        </div>
    </div>

    
     
    <div class="card border-dark shadow-sm mb-5">
        <div class="card-header bg-dark text-white fw-semibold">🗓️ Attendance (Last 30 Days)</div>
        <div class="card-body">
            <div class="row row-cols-2 row-cols-sm-4 row-cols-md-7 g-3 text-center">
                <?php for($i = 0; $i < 30; $i++): ?>
                    <?php
                        $date = \Carbon\Carbon::today()->subDays(29 - $i)->format('Y-m-d');
                        $dayLabel = \Carbon\Carbon::parse($date)->format('d M (D)');
                        $status = $calendarData[$date]->status ?? 'N/A';
                        $badgeClass = match ($status) {
                            'Present' => 'success',
                            'Leave' => 'warning',
                            default => 'secondary'
                        };
                    ?>
                    <div class="col">
                        <div class="border rounded p-2 small">
                            <div class="fw-semibold"><?php echo e($dayLabel); ?></div>
                            <span class="badge bg-<?php echo e($badgeClass); ?>"><?php echo e($status); ?></span>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>


</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ajeet Kumar Das\Downloads\Laravel-Project\Laravel-Project\hrsoft\resources\views\dashboard\staff.blade.php ENDPATH**/ ?>