


<?php
    $pf = 1800;
    $professionalTax = 200;
    $inHand = $employee->salary;
    $basic = round(($inHand * 2) / 3);
    $hra = round($inHand / 3);
    $specialAllowance = 0;
    $totalDeductions = $pf + $professionalTax;
    $totalEarnings = $basic + $hra + $specialAllowance;
    $netSalary = $totalEarnings



?>

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
                    <th>Name</th>
                    <td><?php echo e($employee->name); ?></td>
                </tr>

                <tr>
                    <th>Mobile No</th>
                    <td><?php echo e($employee->mobile); ?></td>
                    <th>Email</th>
                    <td><?php echo e($employee->email); ?></td>
                </tr>


                <tr>
                    <th>Designation</th>
                    <td><?php echo e($employee->designation); ?></td>
                    <th>UAN No</th>
                    <td><?php echo e($employee->uan); ?></td>
                </tr>
                
                

            
                <tr>
                    <th>PF No</th>
                    <td><?php echo e($employee->pf); ?></td>
                    <th>ESIC No</th>
                    <td><?php echo e($employee->esic); ?></td>
                </tr>
                <tr><td style="height:20px"></td></tr>

<table class="table table-bordered salary-slip-table">
    <thead class="table">
        <tr>
            <th colspan="3">Earnings</th>
            <th colspan="2">Deductions</th>
        </tr>
        <tr>
            <th>Component</th>
            <th>Actual</th>
            <th>Earned</th>
            <th>Component</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Basic</td>
            <td>₹<?php echo e($basic); ?></td>
            <td>₹<?php echo e($basic); ?></td>
            <td>PF</td>
            <td>₹<?php echo e($pf); ?></td>
        </tr>
        <tr>
            <td>HRA</td>
            <td>₹<?php echo e($hra); ?></td>
            <td>₹<?php echo e($hra); ?></td>
            <td>Professional Tax </td>
            <td>₹<?php echo e($professionalTax); ?></td>
        </tr>
        <tr>
            <td>Special Allowance</td>
            <td>₹<?php echo e($specialAllowance); ?></td>
            <td>₹<?php echo e($specialAllowance); ?></td>
            <td> ESIC</td>
            <td></td>
        </tr>
        <tr class="fw-bold">
            <td>Total Earnings</td>
            <td>₹<?php echo e($totalEarnings); ?></td>
            <td>₹<?php echo e($totalEarnings); ?></td>
            <td>Total Deductions</td>
            <td>₹<?php echo e($totalDeductions); ?></td>
        </tr>
        <tr class="table-success fw-bold">
            <td colspan="2">Net Salary (In-Hand)</td>
            <td colspan="3">₹<?php echo e($netSalary); ?></td>
        </tr>
        

    </tbody>


    <table class="table table-bordered">
                <tr>
                    <th>Payment Mode</th>
                    <td>Bank Transfer</td>
                    <th>Account No</th>
                    <td><?php echo e($employee->account_no); ?></td>
                </tr>

                <tr>
                    <th>Bank Name</th>
                    <td><?php echo e($employee->bank_name); ?></td>
                    <th>IFSC</th>
                    <td><?php echo e($employee->ifsc); ?></td>
                </tr>

</table>
</table>


                
                
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ajeet Kumar Das\Downloads\Laravel-Project\Laravel-Project\hrsoft\resources\views\payroll\show.blade.php ENDPATH**/ ?>