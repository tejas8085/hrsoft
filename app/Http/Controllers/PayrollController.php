<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Payroll;
use Carbon\Carbon;
use NumberFormatter;
use App\Exports\PayrollExport;
use Maatwebsite\Excel\Facades\Excel;

class PayrollController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month') ?? now()->format('Y-m');

        $payrolls = Payroll::with('employee')
            ->where('month', $month)
            ->get();

        // Summary
        $totalSalary = $payrolls->sum('net_salary');
        $totalPF = $payrolls->sum('pf');
        $totalIncomeTax = $payrolls->sum('income_tax');
        $totalPT = $payrolls->sum('professional_tax');

        return view('payroll.index', compact(
            'payrolls', 'month', 'totalSalary', 'totalPF', 'totalIncomeTax', 'totalPT'
        ));
    }

    public function generatePayroll(Request $request)
    {
        $month = $request->input('month') ?? now()->format('Y-m');
        $startDate = Carbon::parse("$month-01");
        $endDate = $startDate->copy()->endOfMonth();
        $workingDays = $startDate->daysInMonth;

        $employees = Employee::all();

        foreach ($employees as $employee) {
    if (!$employee->joining_date) {
        continue;
    }

    $joiningDate = Carbon::parse($employee->joining_date);
    $startDate = Carbon::parse("$month-01");
    $endDate = $startDate->copy()->endOfMonth();

    // ❌ SKIP if joined after the payroll month
    if ($joiningDate->gt($endDate)) {
        continue;
    }

            $attendances = Attendance::where('employee_id', $employee->id)
                ->whereBetween('attendance_date', [$startDate, $endDate])
                ->get();

            $present = $attendances->where('status', 'Present')->count();
            $leaves = $attendances->where('status', 'On Leave')->count();
            $paidLeaves = ($present > 0) ? min(0, $leaves) : 0;
            $paidDays = $present + $paidLeaves;

            $annualCTC = (float) $employee->salary * 100000;
            $monthlyCTC = $annualCTC / 12;

            // Fixed salary structure
            $fixedBasic = 15000;
            $fixedHRA = $fixedBasic * 0.20;

            // Salary components
            $basic = 0;
            $hra = 0;
            $cityAllowance = 0;
            $gross = 0;
            $net = 0;

            if ($paidDays > 0) {
                $perDayCTC = $monthlyCTC / $workingDays;
                $adjustedGross = $perDayCTC * $paidDays;

                $perDayBasic = $fixedBasic / $workingDays;
                $perDayHRA = $fixedHRA / $workingDays;

                $basic = $perDayBasic * $paidDays;
                $hra = $perDayHRA * $paidDays;
                $cityAllowance = max(0, $adjustedGross - ($basic + $hra));
                $gross = $adjustedGross;
                $net = $basic + $hra + $cityAllowance;
            }

            // Deductions & extras
            $pf = 0;
            $esic = 0;
            $pt = 0;
            $incomeTax = 0;
            $labourWelfareFund = 0;
            $incentives = 0;
            $bonus = 0;

            Payroll::updateOrCreate(
                ['employee_id' => $employee->id, 'month' => $month],
                [
                    'working_days' => $workingDays,
                    'present_days' => $present,
                    'paid_leaves' => $paidLeaves,
                    'basic_salary' => round($basic, 2),
                    'hra' => round($hra, 2),
                    'city_allowance' => round($cityAllowance, 2),
                    'incentives' => $incentives,
                    'bonus' => $bonus,
                    'pf' => $pf,
                    'esic' => $esic,
                    'labour_welfare_fund' => $labourWelfareFund,
                    'income_tax' => $incomeTax,
                    'professional_tax' => $pt,
                    'net_salary' => round($net, 2),
                ]
            );
        }

        return redirect()->route('payroll.index', ['month' => $month])
                         ->with('success', "Payroll generated for $month.");
    }

    public function printPayslip(Payroll $payroll)
    {
        $employee = $payroll->employee;

        if (!$employee) {
            return back()->with('error', 'Employee record not found for this payroll.');
        }

        $monthName = Carbon::parse($payroll->month . '-01')->format('F Y');
        $payDate   = now()->format('d/m/Y');

        $fmt = new NumberFormatter('en_IN', NumberFormatter::SPELLOUT);
        $amountInWords = 'Indian Rupee ' . ucfirst($fmt->format(floor($payroll->net_salary))) . ' Only';

        return view('payroll.payslip', compact(
            'payroll', 'employee', 'monthName', 'payDate', 'amountInWords'
        ));
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('payroll.show', compact('employee'));
    }
  public function export(Request $request)
{
    $month = $request->input('month'); // format: YYYY-MM

    if (!$month) {
        return back()->with('error', 'Please select a month.');
    }

    return Excel::download(new PayrollExport($month), "Payroll_{$month}.xlsx");
}

}
