<?php
namespace App\Exports;

use App\Models\Payroll;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PayrollExport implements FromCollection, WithHeadings
{
    protected $month;

    public function __construct($month)
    {
        $this->month = $month;
    }

    public function collection()
    {
        return Payroll::with('employee')
            ->where('month', $this->month)
            ->get()
            ->map(function ($pay) {
                return [
                    'Employee' => $pay->employee->name ?? 'N/A',
                    'Month' => \Carbon\Carbon::parse($pay->month)->format('F Y'),
                    'Working Days' => $pay->working_days,
                    'Present Days' => $pay->present_days,
                    'Paid Leave' => $pay->paid_leaves,
                    'Basic' => $pay->basic_salary,
                    'HRA' => $pay->hra,
                    'Incentives' => $pay->incentives,
                    'City Allowance' => $pay->city_allowance,
                    'Income Tax' => $pay->income_tax,
                    'Net Salary' => $pay->net_salary,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Employee', 'Month', 'Working Days', 'Present Days', 'Paid Leave',
            'Basic', 'HRA', 'Incentives', 'City Allowance', 'Income Tax', 'Net Salary'
        ];
    }
}
