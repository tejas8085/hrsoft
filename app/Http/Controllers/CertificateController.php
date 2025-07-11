<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Certificate;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use App\Mail\CertificateMail;

class CertificateController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('certificates.index', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'type' => 'required|in:offer,appointment',
        ]);

        $employee = Employee::findOrFail($request->employee_id);

        // Render HTML from Blade template
        $viewName = 'certificates.templates.' . $request->type . '_letter';
        $html = View::make($viewName, compact('employee'))->render();

        $certificate = Certificate::create([
            'employee_id' => $employee->id,
            'type' => $request->type,
            'content' => $html,
            'generated_by' => auth()->id()
        ]);

        // Send certificate email to employee
        $employeeUser = User::where('employee_id', $employee->id)->first();
        if ($employeeUser) {
            Mail::to($employeeUser->email)->send(new CertificateMail(
                $employee,
                ucfirst($request->type) . ' Letter',
                $html,
                auth()->user()->name
            ));
        }

        return redirect()->back()->with('success', 'Certificate generated and sent to employee.');
    }

    public function view($id)
    {
        $certificate = Certificate::findOrFail($id);

        if (auth()->user()->employee_id !== $certificate->employee_id) {
            abort(403);
        }

        return view('certificates.view', compact('certificate'));
    }

    public function downloadPdf($id)
    {
        $certificate = Certificate::findOrFail($id);

        if (auth()->user()->employee_id !== $certificate->employee_id) {
            abort(403);
        }

        $pdf = Pdf::loadHTML($certificate->content);
        return $pdf->download('certificate-' . $certificate->type . '.pdf');
    }
    public function myCertificates()
{
    $employeeId = auth()->user()->employee_id;

    if (!$employeeId) {
        abort(403, 'Not linked to an employee.');
    }

    $certificates = Certificate::where('employee_id', $employeeId)->latest()->get();

    return view('certificates.staff', compact('certificates'));
}

}
