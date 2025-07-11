@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Payroll Summary</h2>

    {{-- Payroll Generation Form --}}
    <form action="{{ route('payroll.generate') }}" method="POST" class="d-flex align-items-center mb-4 gap-3 flex-wrap">
        @csrf
        <label for="month" class="form-label me-2 mb-0">Select Month:</label>
        <input type="month" name="month" id="month" class="form-control w-auto"
            value="{{ request('month') ?? now()->format('Y-m') }}" required>
        <button type="submit" class="btn btn-primary">Generate Payroll</button>
    </form>

    {{-- Summary Overview in Cards --}}
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary shadow-sm h-100">
                <div class="card-body">
                    <h6 class="card-title">Total Salary Paid</h6>
                    <h4 class="card-text">₹{{ number_format($totalSalary, 2) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success shadow-sm h-100">
                <div class="card-body">
                    <h6 class="card-title">Total PF Contribution</h6>
                    <h4 class="card-text">₹{{ number_format($totalPF, 2) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-warning shadow-sm h-100">
                <div class="card-body">
                    <h6 class="card-title">Total Income Tax</h6>
                    <h4 class="card-text">₹{{ number_format($totalIncomeTax, 2) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-danger shadow-sm h-100">
                <div class="card-body">
                    <h6 class="card-title">Total Professional Tax</h6>
                    <h4 class="card-text">₹{{ number_format($totalPT, 2) }}</h4>
                </div>
            </div>
        </div>
    </div>

    {{-- Payroll Table --}}
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
                @foreach($payrolls as $pay)
                <tr>
                    <td>{{ $pay->employee ? $pay->employee->name : 'Employee Not Found' }}</td>
                    <td>{{ \Carbon\Carbon::parse($pay->month)->format('F Y') }}</td>
                    <td>{{ $pay->working_days }}</td>
                    <td>{{ $pay->present_days }}</td>
                    <td>{{ $pay->paid_leaves }}</td>
                    <td>₹{{ number_format($pay->basic_salary, 2) }}</td>
                    <td>₹{{ number_format($pay->hra, 2) }}</td>
                    <td>₹{{ number_format($pay->incentives, 2) }}</td>
                    <!-- <td>₹{{ number_format($pay->bonus, 2) }}</td> -->
                    <td>₹{{ number_format($pay->city_allowance, 2) }}</td>
                    <!-- <td>₹{{ number_format($pay->pf, 2) }}</td> -->
                    <!-- <td>₹{{ number_format($pay->esic, 2) }}</td> -->
                    <td>₹{{ number_format($pay->income_tax, 2) }}</td>
                    <!-- <td>₹{{ number_format($pay->professional_tax, 2) }}</td> -->
                    <!-- <td>₹{{ number_format($pay->labour_welfare_fund, 2) }}</td> -->
                    <td><strong>₹{{ number_format($pay->net_salary, 2) }}</strong></td>
                    <td>
                        <a href="{{ route('payroll.payslip', $pay) }}" class="btn btn-sm btn-outline-secondary"
                            target="_blank">
                            Print Payslip
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
<form method="GET" action="{{ url('/payroll/export') }}" style="display: flex; gap: 10px; align-items: center;">
    <input type="month" name="month" value="{{ request('month') ?? now()->format('Y-m') }}" required>
    <button type="submit" class="btn btn-primary">Export Payroll</button>
</form>



    </div>
</div>
@endsection
