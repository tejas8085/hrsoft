<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\AttendanceController;


Route::get('/dashboard', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');
Route::get('/employee/{id}', [EmployeeController::class, 'show'])->name('employee.show');



Route::get('/salary', [SalaryController::class, 'index'])->name('salary.index');
Route::get('/salary/{id}', [SalaryController::class, 'show'])->name('salary.show');


// Route::middleware('auth')->group(function () {
//     Route::post('/attendance/mark', [AttendanceController::class, 'mark']);
// });
Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');





// Route::get('/salary', function () {
//     return view('salary.index');
// })->name('salary.index');

Route::get('/leave', function () {
    return view('leave.index');
})->name('leave.index');

Route::get('/tax', function () {
    return view('tax.index');
})->name('tax.index');
