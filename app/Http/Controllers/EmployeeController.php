<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();

        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $employees = $query->paginate(10);

        return view('employee.index', compact('employees'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'mobile' => 'required|string|max:10',
        'email' => 'required|string|email|max:255',
        'designation' => 'required|string|max:255',
        'salary' => 'required|string|max:255',
        'joining_date' => 'required|date',
        'department' => 'required|string|max:255',
        'uan' => 'required|string|max:12',
        'pf' => 'required|string|max:12',
        'pan' => 'required|string|max:10',
        'dob' => 'required|string|max:255',
        'esic' => 'required|string|max:17',
        'paddress' => 'required|string|max:255',
        'caddress' => 'required|string|max:255',
        'bank_name' => 'required|string|max:255',
        'account_no' => 'required|string|max:255',
        'ifsc' => 'required|string|max:11',
    ]);

    Employee::create($validated);

    return redirect()->route('employee.index')->with('success', 'Employee added successfully!');
}

    public function create()
    {
         return view('employee.create'); // You can build the form here
    }

    public function show($id)
{
    $employee = Employee::findOrFail($id);
    return view('employee.show', compact('employee'));
}

}
