@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Leave Requests</h2>
    <table class="table table-bordered">
        <thead><tr><th>Employee</th><th>From</th><th>To</th><th>Reason</th><th>Status</th><th>Action</th></tr></thead>
        <tbody>
            @foreach ($leaveRequests as $leave)
                <tr>
                    <td>{{ $leave->employee->name }}</td>
                    <td>{{ $leave->from_date }}</td>
                    <td>{{ $leave->to_date }}</td>
                    <td>{{ $leave->reason }}</td>
                    <td>{{ $leave->status }}</td>
                    <td>
                        @if ($leave->status === 'Pending')
                            <form method="POST" action="{{ route('hr.leave.update', $leave->id) }}">
                                @csrf @method('PATCH')
                                <button name="status" value="Approved" class="btn btn-success btn-sm">Approve</button>
                                <button name="status" value="Rejected" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        @else
                            <em>{{ $leave->status }}</em>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 class="mt-5">Resignation Requests</h2>
    <table class="table table-bordered">
        <thead><tr><th>Employee</th><th>Date</th><th>Reason</th><th>Status</th><th>Action</th></tr></thead>
        <tbody>
            @foreach ($resignations as $resign)
                <tr>
                    <td>{{ $resign->employee->name }}</td>
                    <td>{{ $resign->resignation_date }}</td>
                    <td>{{ $resign->reason }}</td>
                    <td>{{ $resign->status }}</td>
                    <td>
                        @if ($resign->status === 'Pending')
                            <form method="POST" action="{{ route('hr.resignation.update', $resign->id) }}">
                                @csrf @method('PATCH')
                                <button name="status" value="Approved" class="btn btn-success btn-sm">Approve</button>
                                <button name="status" value="Rejected" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        @else
                            <em>{{ $resign->status }}</em>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
