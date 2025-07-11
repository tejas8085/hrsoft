<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

    public function home()
    {
        return view('dashboard.home');
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'mobile' => 'required|string|max:10',
        'email' => 'required|string|email|max:255|unique:users,email',
        'designation' => 'required|string|max:255',
        'salary' => 'required|string|max:255',
        'joining_date' => 'required|date',
        'department' => 'required|string|max:255',
        'uan' => 'nullable|string|max:12',
        'pf' => 'nullable|string|max:12',
        'pan' => 'required|string|max:10',
        'dob' => 'required|string|max:255',
        'esic' => 'nullable|string|max:17',
        'paddress' => 'required|string|max:255',
        'caddress' => 'required|string|max:255',
        'bank_name' => 'required|string|max:255',
        'account_no' => 'required|string|max:255',
        'ifsc' => 'required|string|max:11',
        'incentives' => 'nullable|numeric',
        'bonus' => 'nullable|numeric',
        'city_allowance' => 'nullable|numeric',
    ]);

    // 1. Create employee record
    $employee = Employee::create($validated);

    // 2. Extract first name (before first space)
    $firstName = \Illuminate\Support\Str::before($validated['name'], ' ');

    // 3. Create associated user and link employee_id
    \App\Models\User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => \Illuminate\Support\Facades\Hash::make(Str::lower($firstName)),
        'role' => 'staff',
        'employee_id' => $employee->id, // 🔴 this is the important fix
    ]);

    return redirect()->route('employee.index')->with('success', 'Employee and user account created successfully!');
}

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employee.show', compact('employee'));
    }
}
