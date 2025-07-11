<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AttendanceExport;

class AttendanceController extends Controller
{
    /**
     * Display attendance calendar view.
     */
    public function index(Request $request)
    {
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);

        $firstDay = Carbon::create($year, $month, 1);
        $daysInMonth = $firstDay->daysInMonth;

        $dates = [];
        for ($d = 1; $d <= $daysInMonth; $d++) {
            $dates[] = Carbon::create($year, $month, $d)->toDateString();
        }

        $attendanceSummary = Attendance::selectRaw('attendance_date, status, COUNT(*) as total')
            ->whereMonth('attendance_date', $month)
            ->whereYear('attendance_date', $year)
            ->groupBy('attendance_date', 'status')
            ->get()
            ->groupBy('attendance_date')
            ->map(function ($group) {
                return [
                    'Present' => $group->where('status', 'Present')->sum('total'),
                    'Absent' => $group->where('status', 'Absent')->sum('total'),
                    'On Leave' => $group->where('status', 'On Leave')->sum('total'),
                ];
            })
            ->toArray();

        return view('attendance.index', compact('dates', 'attendanceSummary', 'month', 'year'));
    }

    /**
     * Show attendance marking form for a date.
     */
    public function mark($attendance_date)
{
    $employees = Employee::whereDate('joining_date', '<=', $attendance_date)->get();
    return view('attendance.mark', compact('employees', 'attendance_date'));
}


    /**
     * Save submitted attendance records.
     */
    public function save(Request $request)
    {
        foreach ($request->attendance as $employee_id => $data) {
            Attendance::updateOrCreate(
                [
                    'employee_id' => $employee_id,
                    'attendance_date' => $request->attendance_date,
                ],
                [
                    'status' => $data['status'],
                    'in_time' => $data['in_time'] ?? null,
                    'out_time' => $data['out_time'] ?? null,
                ]
            );
        }

        return redirect('/attendance')->with('success', 'Attendance saved successfully!');
    }

    /**
     * Export attendance between selected date range.
     */
    public function export(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');

        if (!$from || !$to) {
            return back()->with('error', 'Please select a valid date range.');
        }

        return Excel::download(new AttendanceExport($from, $to), "Attendance_{$from}_to_{$to}.xlsx");
    }
}
