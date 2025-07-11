@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center fw-bold text-primary">Welcome, {{ $employee->name }}!</h2>

    {{-- Notifications --}}
    <div class="card border-info shadow-sm mb-5">
        <div class="card-header bg-info text-white fw-semibold">🔔 Notifications</div>
        <div class="card-body">
            @if ($notifications && count($notifications))
                <ul class="mb-0">
                    @foreach ($notifications as $note)
                        <li>{{ $note }}</li>
                    @endforeach
                </ul>
            @else
                <p>No notifications.</p>
            @endif
        </div>
    </div>

        {{-- Tasks Section --}}
    <div class="card border-secondary shadow-sm mb-5">
        <div class="card-header bg-secondary text-white fw-semibold">📝 Task Overview</div>
        <div class="card-body row g-4">
            <div class="col-md-4">
                <h5 class="text-primary">📌 Current Tasks</h5>
                <ul>
                    <li>Submit daily report</li>
                    <li>Attend team meeting</li>
                    <li>Review payroll entries</li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5 class="text-success">✅ Completed Tasks</h5>
                <ul>
                    <li>Updated profile information</li>
                    <li>Marked attendance</li>
                    <li>Submitted leave application</li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5 class="text-warning">🕒 Upcoming Tasks</h5>
                <ul>
                    <li>Submit performance review (5th Jul)</li>
                    <li>Project demo presentation (10th Jul)</li>
                    <li>Training session (15th Jul)</li>
                </ul>
            </div>
        </div>
    </div>


    
    {{-- Month Selector --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('staff.dashboard') }}" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="month" class="form-label">Select Month</label>
                    <input type="month" id="month" name="month" class="form-control" value="{{ request('month', now()->format('Y-m')) }}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">View</button>
                </div>
            </form>
        </div>
    </div>


    {{-- Attendance --}}
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-primary shadow-sm h-100">
                <div class="card-header bg-primary text-white fw-semibold">Attendance ({{ \Carbon\Carbon::parse($month . '-01')->format('F Y') }})</div>
                <div class="card-body">
                    <p class="mb-2"><strong>✅ Present:</strong> {{ $attendance->where('status', 'Present')->count() }}</p>
                    <p><strong>🚫 Leave:</strong> {{ $attendance->where('status', 'Leave')->count() }}</p>
                </div>
            </div>
        </div>

        {{-- Salary --}}
        <div class="col-md-6">
            <div class="card border-success shadow-sm h-100">
                <div class="card-header bg-success text-white fw-semibold">Salary Details</div>
                <div class="card-body">
                    @if ($payroll)
                        <p><strong>💰 Gross:</strong> ₹{{ number_format($payroll->gross_salary, 2) }}</p>
                        <p><strong>🧾 Net:</strong> ₹{{ number_format($payroll->net_salary, 2) }}</p>
                        <a href="{{ route('payroll.payslip', $payroll->id) }}" target="_blank" class="btn btn-outline-dark mt-2">
                            🖨️ Print Payslip ({{ \Carbon\Carbon::parse($month . '-01')->format('F Y') }})
                        </a>
                    @else
                        <p class="text-danger">No payroll found for {{ \Carbon\Carbon::parse($month . '-01')->format('F Y') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- Action Menu --}}
    <div class="card border-dark shadow-sm mb-4">
        <div class="card-header bg-dark text-white fw-semibold">⚙️ Actions</div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><a href="{{ route('staff.leave.request') }}">📝 Submit Leave Request</a></li>
                <li class="list-group-item"><a href="{{ route('staff.resignation.request') }}">📤 Submit Resignation</a></li>
            </ul>
        </div>
    </div>


    {{-- Birthdays --}}
    <div class="card border-warning shadow-sm my-4">
        <div class="card-header bg-warning fw-semibold">🎉 This Month's Birthdays</div>
        <div class="card-body">
            @forelse ($birthdays as $b)
                <p>🎂 {{ $b->name }} — {{ \Carbon\Carbon::parse($b->dob)->format('d M') }}</p>
            @empty
                <p>No birthdays this month.</p>
            @endforelse
        </div>
    </div>

    
     {{-- Calendar View (Last 30 Days) --}}
    <div class="card border-dark shadow-sm mb-5">
        <div class="card-header bg-dark text-white fw-semibold">🗓️ Attendance (Last 30 Days)</div>
        <div class="card-body">
            <div class="row row-cols-2 row-cols-sm-4 row-cols-md-7 g-3 text-center">
                @for ($i = 0; $i < 30; $i++)
                    @php
                        $date = \Carbon\Carbon::today()->subDays(29 - $i)->format('Y-m-d');
                        $dayLabel = \Carbon\Carbon::parse($date)->format('d M (D)');
                        $status = $calendarData[$date]->status ?? 'N/A';
                        $badgeClass = match ($status) {
                            'Present' => 'success',
                            'Leave' => 'warning',
                            default => 'secondary'
                        };
                    @endphp
                    <div class="col">
                        <div class="border rounded p-2 small">
                            <div class="fw-semibold">{{ $dayLabel }}</div>
                            <span class="badge bg-{{ $badgeClass }}">{{ $status }}</span>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>


</div>
@endsection
