<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Payroll;
use App\Models\LeaveRequest;
use App\Models\Resignation;
use Carbon\Carbon;

class StaffDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $employee = Employee::where('email', $user->email)->firstOrFail();

        $month = $request->input('month', now()->format('Y-m')); // Default to current month

        $attendance = Attendance::where('employee_id', $employee->id)
            ->where('attendance_date', 'like', "$month%")
            ->get();

        $payroll = Payroll::where('employee_id', $employee->id)
            ->where('month', $month)
            ->first();

        $birthdays = Employee::whereMonth('dob', now()->month)->get();

        $notifications = [];

        // Viewing month notification
        $notifications[] = "📅 Viewing data for: " . Carbon::parse($month . '-01')->format('F Y');

        // Leave request status notifications
        $leaveRequests = LeaveRequest::where('employee_id', $employee->id)
            ->whereIn('status', ['Approved', 'Rejected'])
            ->latest('updated_at')
            ->take(5)
            ->get();

        foreach ($leaveRequests as $leave) {
            $notifications[] = "📝 Your leave request from {$leave->from_date} to {$leave->to_date} was <strong>{$leave->status}</strong>.";
        }

        // Resignation status notifications
        $resignations = Resignation::where('employee_id', $employee->id)
            ->whereIn('status', ['Approved', 'Rejected'])
            ->latest('updated_at')
            ->take(5)
            ->get();

        foreach ($resignations as $resignation) {
            $notifications[] = "📤 Your resignation dated {$resignation->resignation_date} was <strong>{$resignation->status}</strong>.";
        }

        // Last 30 days attendance for calendar view
        $startDate = Carbon::today()->subDays(29);
        $endDate = Carbon::today();

        $calendarData = $employee->attendances()
            ->whereBetween('attendance_date', [$startDate, $endDate])
            ->get()
            ->keyBy('attendance_date');

        return view('dashboard.staff', compact(
            'employee',
            'attendance',
            'payroll',
            'birthdays',
            'notifications',
            'month',
            'calendarData'
        ));
    }
}
