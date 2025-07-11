@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📝 Submit Leave Request</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('staff.leave.submit') }}">
        @csrf

        <div class="mb-3">
            <label for="from_date" class="form-label">From Date</label>
            <input type="date" class="form-control" id="from_date" name="from_date" required>
        </div>

        <div class="mb-3">
            <label for="to_date" class="form-label">To Date</label>
            <input type="date" class="form-control" id="to_date" name="to_date" required>
        </div>

        <div class="mb-3">
            <label for="reason" class="form-label">Reason</label>
            <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Leave Request</button>
    </form>
</div>
@endsection
