<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class SalaryController extends Controller
{
    public function index()
    {
        $employees = Employee::query()->paginate(10)->withQueryString();

        return view('salary.index', compact('employees'));
        
    }
    public function show($id)
{
    $employee = Employee::findOrFail($id);
    return view('salary.show', compact('employee'));
}
}