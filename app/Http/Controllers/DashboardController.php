<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'superadmin') {
            return view('dashboard.superadmin');
        } elseif ($user->role === 'hr') {
            return view('dashboard.hr');
        } elseif ($user->role === 'employee') {
            return view('dashboard.employee');
        }

        abort(403); // Role not allowed
    }
}