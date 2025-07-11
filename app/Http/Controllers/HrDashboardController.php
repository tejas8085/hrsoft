<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\Resignation;
use Carbon\Carbon;
use DB;


class HrDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Selected date or today
        $selectedDate = $request->get('date') 
            ? Carbon::parse($request->get('date')) 
            : Carbon::today();

        $month = $selectedDate->month;

        // Today's attendance summary
        $todayPresent = Attendance::whereDate('attendance_date', $selectedDate)
            ->where('status', 'Present')->count();

        $todayLeaves = Attendance::whereDate('attendance_date', $selectedDate)
            ->where('status', 'On Leave')->count();

        $monthLeaves = Attendance::whereMonth('attendance_date', $month)
            ->where('status', 'On Leave')->count();

        // Department-wise employee count
        $departmentCounts = Employee::select('department', DB::raw('COUNT(*) as total'))
            ->groupBy('department')->get();

        // Attendance last 7 days
        $sevenDaysAgo = $selectedDate->copy()->subDays(6)->startOfDay();
        $presentRaw = Attendance::where('status', 'Present')
            ->whereBetween('attendance_date', [$sevenDaysAgo, $selectedDate])
            ->selectRaw('DATE(attendance_date) as date, COUNT(*) as total')
            ->groupBy('date')->orderBy('date')->get()->keyBy('date');

        $presentCounts = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date = $selectedDate->copy()->subDays($i)->toDateString();
            $presentCounts->push([
                'date' => $date,
                'total' => $presentRaw[$date]->total ?? 0
            ]);
        }

        // Birthdays
        $currentMonth = $selectedDate->format('m');
        $birthdays = Employee::whereMonth('dob', $currentMonth)->get();

        // New: Pending leave and resignation requests
        $leaveRequests = LeaveRequest::where('status', 'pending')->count(); // This returns an integer (e.g. 0, 3)
        $resignations = Resignation::with('employee')->where('status', 'pending')->get();

        return view('dashboard.hr', compact(
            'todayLeaves',
            'monthLeaves',
            'todayPresent',
            'departmentCounts',
            'presentCounts',
            'selectedDate',
            'birthdays',
            'leaveRequests',
            'resignations',

        ));
    }

    
public function viewRequests()
{
    $leaveRequests = LeaveRequest::with('employee')->latest()->get();
    $resignations = Resignation::with('employee')->latest()->get();
    return view('hr.leave_resignations', compact('leaveRequests', 'resignations'));
}

public function updateLeaveStatus(Request $request, $id)
{
    $request->validate(['status' => 'required|in:Approved,Rejected']);
    LeaveRequest::where('id', $id)->update(['status' => $request->status]);
    return back()->with('success', 'Leave status updated.');
}

public function updateResignationStatus(Request $request, $id)
{
    $request->validate(['status' => 'required|in:Approved,Rejected']);
    Resignation::where('id', $id)->update(['status' => $request->status]);
    return back()->with('success', 'Resignation status updated.');
}

}
