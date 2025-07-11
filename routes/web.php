<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\HrDashboardController;
use App\Http\Controllers\StaffActionController;
use App\Http\Controllers\LeaveController;

use App\Http\Controllers\CertificateController;

// Public landing page
Route::get('/', function () {
    return view('welcome');
});




// Redirect based on role after login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $role = auth()->user()->role;
        return match ($role) {
            'superadmin' => redirect()->route('admin.dashboard'),
            'hr' => redirect()->route('hr.dashboard'),
            'staff' => redirect()->route('staff.dashboard'),
            default => abort(403, 'Unauthorized'),
        };

    })->name('dashboard');

    // Breeze profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/payroll/{payroll}/payslip', [PayrollController::class, 'printPayslip'])->name('payroll.payslip');

});

// -------------------
// SUPERADMIN ROUTES
// -------------------
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard.admin');
    })->name('admin.dashboard');

    // Share HR/Admin routes
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/employee/{id}', [EmployeeController::class, 'show'])->name('employee.show');

    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('/attendance/export', [AttendanceController::class, 'export']);
    Route::get('/attendance/{date}', [AttendanceController::class, 'mark']);
    Route::post('/attendance/save', [AttendanceController::class, 'save']);

    Route::post('/payroll/generate', [PayrollController::class, 'generatePayroll'])->name('payroll.generate');
    Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');
    // Route::get('/payroll/{payroll}/payslip', [PayrollController::class, 'printPayslip'])->name('payroll.payslip');
});

// ----------------
// HR ROUTES
// ----------------
Route::middleware(['auth', 'role:hr'])->group(function () {
    Route::get('/hr/dashboard', [HrDashboardController::class, 'index'])->name('hr.dashboard');
    
    // Shared HR/Admin routes
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/employee/{id}', [EmployeeController::class, 'show'])->name('employee.show');

    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('/attendance/export', [AttendanceController::class, 'export']);
    Route::get('/attendance/{date}', [AttendanceController::class, 'mark']);
    Route::post('/attendance/save', [AttendanceController::class, 'save']);

    Route::post('/payroll/generate', [PayrollController::class, 'generatePayroll'])->name('payroll.generate');
    Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');
    Route::get('/payroll/export', [PayrollController::class, 'export'])->name('payroll.export');

    Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates.index');
    Route::post('/certificates', [CertificateController::class, 'store'])->name('certificates.store');
    Route::get('/hr/leave-resignations', [HrDashboardController::class, 'viewRequests'])->name('hr.requests');
    Route::patch('/hr/leave/{id}/status', [HrDashboardController::class, 'updateLeaveStatus'])->name('hr.leave.update');
    Route::patch('/hr/resignation/{id}/status', [HrDashboardController::class, 'updateResignationStatus'])->name('hr.resignation.update');

    Route::get('/project-managers', [HRProjectManagerController::class, 'index'])->name('hr.project_managers');
    Route::get('/project-managers/{id}/assign', [HRProjectManagerController::class, 'assignTeam'])->name('hr.assign_team');
    Route::post('/project-managers/assign', [HRProjectManagerController::class, 'storeAssignment'])->name('hr.store_assignment');

    // HR routes for updating status

   

});

Route::middleware(['auth', 'role:project_manager'])->group(function () {
    Route::get('/pm/dashboard', [ProjectManagerController::class, 'dashboard'])->name('pm.dashboard');
    Route::get('/pm/tasks', [ProjectManagerTaskController::class, 'index'])->name('pm.tasks');
    Route::get('/pm/tasks/create', [ProjectManagerTaskController::class, 'create'])->name('pm.tasks.create');
    Route::post('/pm/tasks', [ProjectManagerTaskController::class, 'store'])->name('pm.tasks.store');
});

// --------------------
// EMPLOYEE ROUTES
// --------------------
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff/dashboard', [\App\Http\Controllers\StaffDashboardController::class, 'index'])->name('staff.dashboard');
    Route::get('/staff/certificates', [CertificateController::class, 'myCertificates'])->name('staff.certificates');


    // Route::get('/certificates/view/{id}', [CertificateController::class, 'view'])->name('certificates.view');
    Route::get('/certificates/pdf/{id}', [CertificateController::class, 'downloadPdf'])->name('certificates.pdf');
    Route::get('/certificate/{id}/view', [CertificateController::class, 'view'])->name('certificates.view');
    Route::get('/certificate/{id}/download', [App\Http\Controllers\CertificateController::class, 'downloadPdf'])->name('certificates.pdf');

    Route::get('/certificate/{id}/download', [CertificateController::class, 'downloadPdf'])->name('certificates.download');

    Route::get('/leave/request', [LeaveController::class, 'create'])->name('staff.leave.request');
    Route::post('/leave/request', [LeaveController::class, 'store'])->name('staff.leave.submit');
    Route::get('/resignation/request', [ResignationController::class, 'create'])->name('staff.resignation.request');
    Route::post('/resignation/request', [ResignationController::class, 'store'])->name('staff.resignation.submit');


});


require __DIR__.'/auth.php';
