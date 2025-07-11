

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4 text-center">Welcome <?php echo e(auth()->user()->name); ?></h1>

    <form method="GET" action="<?php echo e(route('hr.dashboard')); ?>" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <label for="date" class="form-label">Select Date:</label>
                <input type="date" name="date" id="date" class="form-control"
                    value="<?php echo e(request('date', \Carbon\Carbon::today()->toDateString())); ?>"
                    onchange="this.form.submit()">
            </div>
        </div>
    </form>

    <h5 class="mb-4">Showing data for: <?php echo e(\Carbon\Carbon::parse($selectedDate)->format('d M, Y')); ?></h5>

    
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card text-center bg-light p-3 shadow-sm">
                <h5><i class="bi bi-person-check text-success me-2"></i>Today's Present</h5>
                <h2><?php echo e($todayPresent); ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-light p-3 shadow-sm">
                <h5><i class="bi bi-person-x text-danger me-2"></i>Today's Leaves</h5>
                <h2><?php echo e($todayLeaves); ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-light p-3 shadow-sm">
                <h5><i class="bi bi-calendar-check text-warning me-2"></i><?php echo e(\Carbon\Carbon::parse($selectedDate)->format('F')); ?>'s Leaves</h5>
                <h2><?php echo e($monthLeaves); ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-light p-3 shadow-sm">
                <h5><i class="bi bi-envelope-open text-primary me-2"></i>Leave Requests</h5>
<h2><?php echo e($leaveRequests ?? 0); ?></h2>

            </div>
        </div>
    </div>

    
    <div class="row g-4 mb-4">
        
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title text-secondary mb-4">👨‍💼 Department-wise Employees</h5>
                    <div class="mx-auto" style="max-width: 300px;">
                        <canvas id="departmentChart" style="width: 100%; height: auto;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-secondary">📊 Employee Presence - Last 7 Days</h5>
                    <div style="width: 100%;">
                        <canvas id="presenceChart" style="width: 100%; height: auto;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row g-4">
        
        <div class="col-md-4">
            <div class="card border-success shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title text-success">📅 Upcoming Joinings</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Aman Gupta - 02 Jul</li>
                        <li class="list-group-item">Priya Mehta - 04 Jul</li>
                        <li class="list-group-item">Siddharth Rao - 07 Jul</li>
                    </ul>
                    <p class="mt-2 text-muted small">* Based on upcoming joining dates</p>
                </div>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="card border-danger shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title text-danger">🚪 Upcoming Resignations</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Ravi Kumar - 10 Jul</li>
                    </ul>
                    <p class="mt-2 text-muted small">* Based on resignation notices</p>
                </div>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="card border-primary shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary">🎂 Birthdays This Month</h5>
                    <?php if($birthdays->count() > 0): ?>
                        <ul class="list-group list-group-flush">
                            <?php $__currentLoopData = $birthdays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item">
                                    <?php echo e($emp->name); ?> - <?php echo e(\Carbon\Carbon::parse($emp->dob)->format('d M')); ?>

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted">No birthdays this month.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const departmentLabels = <?php echo json_encode($departmentCounts->pluck('department'), 15, 512) ?>;
    const departmentData = <?php echo json_encode($departmentCounts->pluck('total'), 15, 512) ?>;

    const presenceLabels = <?php echo json_encode($presentCounts->pluck('date'), 15, 512) ?>;
    const presenceData = <?php echo json_encode($presentCounts->pluck('total'), 15, 512) ?>;

    document.addEventListener('DOMContentLoaded', () => {
        // Department Chart
        const deptCtx = document.getElementById('departmentChart');
        if (deptCtx && departmentLabels.length > 0) {
            new Chart(deptCtx, {
                type: 'pie',
                data: {
                    labels: departmentLabels,
                    datasets: [{
                        data: departmentData,
                        backgroundColor: [
                            '#007bff', '#28a745', '#ffc107', '#dc3545',
                            '#6610f2', '#fd7e14', '#20c997', '#6f42c1',
                            '#e83e8c', '#17a2b8', '#343a40'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        // Presence Chart
        const presenceCtx = document.getElementById('presenceChart');
        if (presenceCtx && presenceLabels.length > 0) {
            new Chart(presenceCtx, {
                type: 'bar',
                data: {
                    labels: presenceLabels,
                    datasets: [{
                        label: 'Present',
                        data: presenceData,
                        backgroundColor: '#17a2b8'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ajeet Kumar Das\Downloads\Laravel-Project\Laravel-Project\hrsoft\resources\views\dashboard\hr.blade.php ENDPATH**/ ?>