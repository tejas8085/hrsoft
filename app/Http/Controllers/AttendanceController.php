<?php

namespace App\Http\Controllers;
use App\Models\Attendance;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
{
    $request->validate([
        'status' => 'required|in:present,absent,late',
    ]);

    $attendance = Attendance::updateOrCreate(
        ['user_id' => auth()->id(), 'date' => now()->toDateString()],
        ['status' => $request->status]
    );

    return response()->json(['message' => 'Attendance marked successfully', 'data' => $attendance]);
}


}
