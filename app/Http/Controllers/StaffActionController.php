<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffActionController extends Controller
{
    public function leaveForm()
{
    return view('staff.leave_request');
}

public function submitLeave(Request $request)
{
    $request->validate([
        'from_date' => 'required|date',
        'to_date' => 'required|date',
        'reason' => 'required|string',
    ]);

    \App\Models\LeaveRequest::create([
        'employee_id' => auth()->user()->employee_id,
        'from_date' => $request->from_date,
        'to_date' => $request->to_date,
        'reason' => $request->reason,
    ]);

    return back()->with('success', 'Leave request submitted.');
}

public function resignationForm()
{
    return view('staff.resignation_request');
}

public function submitResignation(Request $request)
{
    $request->validate([
        'resignation_date' => 'required|date',
        'reason' => 'required|string',
    ]);

    \App\Models\Resignation::create([
        'employee_id' => auth()->user()->employee_id,
        'resignation_date' => $request->resignation_date,
        'reason' => $request->reason,
    ]);

    return back()->with('success', 'Resignation request submitted.');
}

}
