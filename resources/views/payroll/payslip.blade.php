<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Payslip - {{ $employee->name }} - {{ $monthName }}</title>
<style>
    body {
        font-family: Arial, sans-serif;
        color: #333;
        padding: 20px;
    }

    .header {
        text-align: center;
        margin-bottom: 20px;
    }

    .logo {
        width: 80px;
        margin-bottom: 10px;
    }

    .section {
        margin-bottom: 20px;
    }

    .section h2 {
        font-size: 16px;
        margin-bottom: 5px;
        border-bottom: 1px solid #ccc;
        padding-bottom: 3px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
    }

    th, td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }

    .text-right {
        text-align: right;
    }

    .no-border {
        border: none !important;
    }

    .print-btn {
        position: fixed;
        top: 10px;
        right: 10px;
        background: #007bff;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        cursor: pointer;
    }

    .dual-table td {
        vertical-align: top;
        border: none;
        padding: 0;
    }

    .inner-table {
        width: 100%;
        border-collapse: collapse;
    }

    .inner-table th, .inner-table td {
        border: 1px solid #ccc;
        padding: 6px;
    }

    @media print {
        .print-btn {
            display: none;
        }

        body {
            margin: 0;
            padding: 10mm;
            font-size: 12px;
        }

        .header h1, .header h2 {
            margin: 0;
        }

        .section {
            page-break-inside: avoid;
        }
    }
</style>

</head>

<body>
    <button class="print-btn" onclick="window.print()">Print</button>

    <div class="header">
        <img src="/images/image.png" alt="Company Logo" class="logo">
        <h1>TPIpay Fintech Pvt. Ltd.</h1>
        <div>Pune, India</div>
        <h2>Payslip for {{ $monthName }}</h2>
    </div>

    <div class="section">
        <h2>EMPLOYEE DETAILS</h2>
        <table>
            <tr>
                <th>Employee Name</th>
                <td>{{ $employee->name }}</td>
                <th>Employee ID</th>
                <td>{{ $employee->id }}</td>
            </tr>
            <tr>
                <th>Pay Period</th>
                <td>{{ $monthName }}</td>
                <th>Pay Date</th>
                <td>{{ $payDate }}</td>
            </tr>
            <tr>
                <th>Total Net Pay</th>
                <td colspan="3" class="text-right">₹{{ number_format($payroll->net_salary, 2) }}</td>
            </tr>
            <tr>
                <th>Paid Days</th>
                <td>{{ $payroll->present_days + $payroll->paid_leaves }}</td>
                <th>LOP Days</th>
                <td>{{ $payroll->working_days - ($payroll->present_days + $payroll->paid_leaves) }}</td>
            </tr>
            <tr>
                <th>Bank Name</th>
                <td>{{ $employee->bank_name }}</td>
                <th>Account No.</th>
                <td>XXXXXXXX{{ substr($employee->account_no, -4) }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>EARNINGS & DEDUCTIONS</h2>
        <table class="dual-table">
            <tr>
                <td style="width: 50%;">
                    <table class="inner-table">
                        <tr><th colspan="2">EARNINGS</th></tr>
                        <tr><td>Basic Salary</td><td class="text-right">{{ number_format($payroll->basic_salary, 2) }}</td></tr>
                        <tr><td>HRA</td><td class="text-right">{{ number_format($payroll->hra, 2) }}</td></tr>
                        <tr><td>Incentives</td><td class="text-right">{{ number_format($payroll->incentives, 2) }}</td></tr>
                        <tr><td>Bonus</td><td class="text-right">{{ number_format($payroll->bonus, 2) }}</td></tr>
                        <tr><td>City Allowance</td><td class="text-right">{{ number_format($payroll->city_allowance, 2) }}</td></tr>
                        <tr>
                            <th>Total Earnings</th>
                            <th class="text-right">
                                ₹{{ number_format($payroll->basic_salary + $payroll->hra + $payroll->incentives + $payroll->bonus + $payroll->city_allowance, 2) }}
                            </th>
                        </tr>
                    </table>
                </td>
                <td style="width: 50%;">
                    <table class="inner-table">
                        <tr><th colspan="2">DEDUCTIONS</th></tr>
                        <tr><td>PF</td><td class="text-right">{{ number_format($payroll->pf, 2) }}</td></tr>
                        <tr><td>ESIC</td><td class="text-right">{{ number_format($payroll->esic, 2) }}</td></tr>
                        <tr><td>Income Tax</td><td class="text-right">{{ number_format($payroll->income_tax, 2) }}</td></tr>
                        <tr><td>Professional Tax</td><td class="text-right">{{ number_format($payroll->professional_tax, 2) }}</td></tr>
                        <tr><td>LWF</td><td class="text-right">{{ number_format($payroll->labour_welfare_fund, 2) }}</td></tr>
                        <tr>
                            <th>Total Deductions</th>
                            <th class="text-right">
                                ₹{{ number_format($payroll->pf + $payroll->esic + $payroll->income_tax + $payroll->professional_tax + $payroll->labour_welfare_fund, 2) }}
                            </th>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>NET SALARY</h2>
        <table>
            <tr>
                <td class="no-border">Total Earnings - Total Deductions</td>
                <td class="text-right no-border"><strong>₹{{ number_format($payroll->net_salary, 2) }}</strong></td>
            </tr>
        </table>
        <div><em>Amount in words: {{ $amountInWords }}</em></div>
    </div>

    <div style="font-size: 11px; margin-top: 20px;">
        -- This is a system-generated document --
    </div>
</body>

</html>
