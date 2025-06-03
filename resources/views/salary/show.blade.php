@extends('layouts.app')


@php
    $pf = 1800;
    $professionalTax = 200;
    $inHand = $employee->salary;
    $basic = round(($inHand * 2) / 3);
    $hra = round($inHand / 3);
    $specialAllowance = 0;
    $totalDeductions = $pf + $professionalTax;
    $totalEarnings = $basic + $hra + $specialAllowance;
    $netSalary = $totalEarnings



@endphp

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Employee Details</h5>
            <a href="{{ route('employee.index') }}" class="btn btn-sm btn-light">← Back to List</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $employee->id }}</td>
                    <th>Name</th>
                    <td>{{ $employee->name }}</td>
                </tr>

                <tr>
                    <th>Mobile No</th>
                    <td>{{ $employee->mobile }}</td>
                    <th>Email</th>
                    <td>{{ $employee->email }}</td>
                </tr>


                <tr>
                    <th>Designation</th>
                    <td>{{ $employee->designation }}</td>
                    <th>UAN No</th>
                    <td>{{ $employee->uan }}</td>
                </tr>
                
                

            
                <tr>
                    <th>PF No</th>
                    <td>{{ $employee->pf }}</td>
                    <th>ESIC No</th>
                    <td>{{ $employee->esic }}</td>
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
            <td>₹{{ $basic }}</td>
            <td>₹{{ $basic }}</td>
            <td>PF</td>
            <td>₹{{ $pf }}</td>
        </tr>
        <tr>
            <td>HRA</td>
            <td>₹{{ $hra }}</td>
            <td>₹{{ $hra }}</td>
            <td>Professional Tax </td>
            <td>₹{{ $professionalTax }}</td>
        </tr>
        <tr>
            <td>Special Allowance</td>
            <td>₹{{ $specialAllowance }}</td>
            <td>₹{{ $specialAllowance }}</td>
            <td> ESIC</td>
            <td></td>
        </tr>
        <tr class="fw-bold">
            <td>Total Earnings</td>
            <td>₹{{ $totalEarnings }}</td>
            <td>₹{{ $totalEarnings }}</td>
            <td>Total Deductions</td>
            <td>₹{{ $totalDeductions }}</td>
        </tr>
        <tr class="table-success fw-bold">
            <td colspan="2">Net Salary (In-Hand)</td>
            <td colspan="3">₹{{ $netSalary }}</td>
        </tr>
        

    </tbody>


    <table class="table table-bordered">
                <tr>
                    <th>Payment Mode</th>
                    <td>Bank Transfer</td>
                    <th>Account No</th>
                    <td>{{ $employee->account_no }}</td>
                </tr>

                <tr>
                    <th>Bank Name</th>
                    <td>{{ $employee->bank_name }}</td>
                    <th>IFSC</th>
                    <td>{{ $employee->ifsc }}</td>
                </tr>

</table>
</table>


                
                
            </table>
        </div>
    </div>
</div>
@endsection
