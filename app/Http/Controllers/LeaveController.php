<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;

class LeaveController extends Controller
{
    public function create()
    {
        return view('staff.leave_request');
    }

    public function store(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date',
            'reason' => 'required|string',
        ]);

        LeaveRequest::create([
            'employee_id' => auth()->user()->employee_id,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'reason' => $request->reason,
            'status' => 'Pending',
        ]);

        return back()->with('success', 'Leave request submitted successfully.');
    }
}
