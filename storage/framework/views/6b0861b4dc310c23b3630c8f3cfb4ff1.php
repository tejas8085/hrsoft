

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mb-4">Payroll Summary</h2>

    
    <form action="<?php echo e(route('payroll.generate')); ?>" method="POST" class="d-flex align-items-center mb-4 gap-3 flex-wrap">
        <?php echo csrf_field(); ?>
        <label for="month" class="form-label me-2 mb-0">Select Month:</label>
        <input type="month" name="month" id="month" class="form-control w-auto"
            value="<?php echo e(request('month') ?? now()->format('Y-m')); ?>" required>
        <button type="submit" class="btn btn-primary">Generate Payroll</button>
    </form>

    
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary shadow-sm h-100">
                <div class="card-body">
                    <h6 class="card-title">Total Salary Paid</h6>
                    <h4 class="card-text">₹<?php echo e(number_format($totalSalary, 2)); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success shadow-sm h-100">
                <div class="card-body">
                    <h6 class="card-title">Total PF Contribution</h6>
                    <h4 class="card-text">₹<?php echo e(number_format($totalPF, 2)); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-warning shadow-sm h-100">
                <div class="card-body">
                    <h6 class="card-title">Total Income Tax</h6>
                    <h4 class="card-text">₹<?php echo e(number_format($totalIncomeTax, 2)); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-danger shadow-sm h-100">
                <div class="card-body">
                    <h6 class="card-title">Total Professional Tax</h6>
                    <h4 class="card-text">₹<?php echo e(number_format($totalPT, 2)); ?></h4>
                </div>
            </div>
        </div>
    </div>

    
    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Employee</th>
                    <th>Month</th>
                    <th>Working Days</th>
                    <th>Present</th>
                    <th>Paid Leave</th>
                    <th>Basic</th>
                    <th>HRA</th>
                    <th>Incentives</th>
                    <!-- <th>Bonus</th> -->
                    <th>City Allowance</th>
                    <!-- <th>PF</th> -->
                    <!-- <th>ESIC</th> -->
                    <th>Income Tax</th>
                    <!-- <th>PT</th> -->
                    <!-- <th>LWF</th> -->
                    <th>Net Salary</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $payrolls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($pay->employee ? $pay->employee->name : 'Employee Not Found'); ?></td>
                    <td><?php echo e(\Carbon\Carbon::parse($pay->month)->format('F Y')); ?></td>
                    <td><?php echo e($pay->working_days); ?></td>
                    <td><?php echo e($pay->present_days); ?></td>
                    <td><?php echo e($pay->paid_leaves); ?></td>
                    <td>₹<?php echo e(number_format($pay->basic_salary, 2)); ?></td>
                    <td>₹<?php echo e(number_format($pay->hra, 2)); ?></td>
                    <td>₹<?php echo e(number_format($pay->incentives, 2)); ?></td>
                    <!-- <td>₹<?php echo e(number_format($pay->bonus, 2)); ?></td> -->
                    <td>₹<?php echo e(number_format($pay->city_allowance, 2)); ?></td>
                    <!-- <td>₹<?php echo e(number_format($pay->pf, 2)); ?></td> -->
                    <!-- <td>₹<?php echo e(number_format($pay->esic, 2)); ?></td> -->
                    <td>₹<?php echo e(number_format($pay->income_tax, 2)); ?></td>
                    <!-- <td>₹<?php echo e(number_format($pay->professional_tax, 2)); ?></td> -->
                    <!-- <td>₹<?php echo e(number_format($pay->labour_welfare_fund, 2)); ?></td> -->
                    <td><strong>₹<?php echo e(number_format($pay->net_salary, 2)); ?></strong></td>
                    <td>
                        <a href="<?php echo e(route('payroll.payslip', $pay)); ?>" class="btn btn-sm btn-outline-secondary"
                            target="_blank">
                            Print Payslip
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
<form method="GET" action="<?php echo e(url('/payroll/export')); ?>" style="display: flex; gap: 10px; align-items: center;">
    <input type="month" name="month" value="<?php echo e(request('month') ?? now()->format('Y-m')); ?>" required>
    <button type="submit" class="btn btn-primary">Export Payroll</button>
</form>



    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ajeet Kumar Das\Downloads\Laravel-Project\Laravel-Project\hrsoft\resources\views\payroll\index.blade.php ENDPATH**/ ?>