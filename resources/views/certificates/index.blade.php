@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Generate Certificate</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('certificates.store') }}">
        @csrf
        <div class="mb-3">
            <label for="employee_id" class="form-label">Select Employee</label>
            <select name="employee_id" id="employee_id" class="form-control" required>
                <option value="">-- Select --</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }} ({{ $employee->employee_code }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Certificate Type</label>
            <select name="type" id="type" class="form-control" required>
                <option value="offer">Offer Letter</option>
                <option value="appointment">Appointment Letter</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Generate Certificate</button>
    </form>
</div>
@endsection
