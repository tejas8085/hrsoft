@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Employee Details</h5>
            <a href="{{ route('employee.index') }}" class="btn btn-sm btn-light">← Back to List</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $employee->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $employee->name }}</td>
                </tr>
                <tr>
                    <th>Mobile No</th>
                    <td>{{ $employee->mobile }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $employee->email }}</td>
                </tr>
                <tr>
                    <th>Date Of Birth</th>
                    <td>{{ $employee->dob }}</td>
                </tr>
                <tr>
                    <th>Designation</th>
                    <td>{{ $employee->designation }}</td>
                </tr>
                <tr>
                    <th>Joining Date</th>
                    <td>{{ $employee->joining_date }}</td>
                </tr>
                <tr>
                    <th>Department</th>
                    <td>{{ $employee->department }}</td>
                </tr>
                <tr>
                    <th>UAN No</th>
                    <td>{{ $employee->uan }}</td>
                </tr>
                <tr>
                    <th>PAN No</th>
                    <td>{{ $employee->pan }}</td>
                </tr>
                <tr>
                    <th>PF No</th>
                    <td>{{ $employee->pf }}</td>
                </tr>
                <tr>
                    <th>ESIC No</th>
                    <td>{{ $employee->esic }}</td>
                </tr>
                <tr>
                    <th> Permanant Address</th>
                    <td>{{ $employee->paddress }}</td>
                </tr>
                <tr>
                    <th>Current Address</th>
                    <td>{{ $employee->caddress }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $employee->created_at->format('d M Y, h:i A') }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $employee->updated_at->format('d M Y, h:i A') }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
