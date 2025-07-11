

<?php $__env->startSection('content'); ?>
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <div style="display: flex; gap: 10px; align-items: center;">
        <h2><?php echo e(\Carbon\Carbon::create($year, $month)->format('F Y')); ?></h2>
        <form method="GET" action="<?php echo e(url('/attendance')); ?>" style="display: flex; gap: 5px;">
            <select name="month" onchange="this.form.submit()">
                <?php $__currentLoopData = range(1,12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($m); ?>" <?php echo e($m == $month ? 'selected' : ''); ?>>
                    <?php echo e(\Carbon\Carbon::create()->month($m)->format('F')); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select name="year" onchange="this.form.submit()">
                <?php $__currentLoopData = range(now()->year - 5, now()->year + 5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($y); ?>" <?php echo e($y == $year ? 'selected' : ''); ?>>
                    <?php echo e($y); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </form>
    </div>

    
    <!-- <form method="GET" action="<?php echo e(url('/attendance/export')); ?>" style="display: flex; gap: 5px; align-items: center;">
        <label>
            From:
            <input type="date" name="from" value="<?php echo e(request('from') ?? $dates[0]); ?>" required>
        </label>
        <label>
            To:
            <input type="date" name="to" value="<?php echo e(request('to') ?? $dates[count($dates)-1]); ?>" required>
        </label>
        <button type="submit">Export</button>
    </form> -->
</div>


<div style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 10px; text-align: center; font-weight: bold;">
    <div>Sun</div>
    <div>Mon</div>
    <div>Tue</div>
    <div>Wed</div>
    <div>Thu</div>
    <div>Fri</div>
    <div>Sat</div>
</div>


<div style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 10px;">
    <?php
    $firstDayOfMonth = \Carbon\Carbon::parse($dates[0])->dayOfWeek;
    $todayStr = now()->toDateString();
    ?>

    
    <?php for($i = 0; $i < $firstDayOfMonth; $i++): ?> <div>
</div>
<?php endfor; ?>

<?php $__currentLoopData = $dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
$record = $attendanceSummary[$date] ?? ['Present' => 0, 'Absent' => 0, 'On Leave' => 0];
$isPast = \Carbon\Carbon::parse($date)->isPast();
$isToday = $date === $todayStr;
?>

<a href="<?php echo e(url('/attendance/'.$date)); ?>" style="text-decoration: none; color: inherit;">
    <div style="
                border:1px solid #ccc;
                padding:10px;
                border-radius: 8px;
                text-align: center;
                background: <?php echo e($isToday ? '#87CEEB' : '#f9f9f9'); ?>;
                transition: background 0.3s, box-shadow 0.3s;"
        onmouseover="this.style.background='<?php echo e($isToday ? '#87CEEB' : '#eef'); ?>'; this.style.boxShadow='0 0 10px rgba(0,0,0,0.2)'"
        onmouseout="this.style.background='<?php echo e($isToday ? '#87CEEB' : '#f9f9f9'); ?>'; this.style.boxShadow='none'">

        <div style="font-size: 24px; font-weight: bold;"><?php echo e(\Carbon\Carbon::parse($date)->day); ?></div>
        <div style="font-size: 12px; color: gray;"><?php echo e($date); ?></div>

        <?php if($isPast): ?>
        <div style="font-size: 12px; margin-top: 5px; display: flex; justify-content: center; gap: 6px;">
            <span>P: <?php echo e($record['Present']); ?></span>
            <span>A: <?php echo e($record['Absent']); ?></span>
            <span>L: <?php echo e($record['On Leave']); ?></span>
        </div>
        <?php endif; ?>
    </div>
</a>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div
    style="position: fixed; padding_top:100px; bottom: 20px; right: 20px; background: #000; padding: 8px 10px; border-radius: 8px;">
<form method="GET" action="<?php echo e(url('/payroll/export')); ?>" style="display: flex; gap: 5px; align-items: center;">
    <input type="date" name="from" value="<?php echo e(old('from', '2024-06-01')); ?>" required style="padding: 3px 5px; font-size: 12px;">
    <input type="date" name="to" value="<?php echo e(old('to', now()->toDateString())); ?>" required style="padding: 3px 5px; font-size: 12px;">
    <button type="submit"
        style="background: #007BFF; color: #fff; border: none; padding: 4px 8px; border-radius: 4px; font-size: 12px; cursor: pointer;">
        Export
    </button>
</form>



</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ajeet Kumar Das\Downloads\Laravel-Project\Laravel-Project\hrsoft\resources\views\attendance\index.blade.php ENDPATH**/ ?>