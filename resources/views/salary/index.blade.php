@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-4">
    <form method="GET" action="{{ route('employee.index') }}" class="d-flex gap-2">
        <input type="text" name="id" class="form-control" placeholder="Filter by ID" value="{{ request('id') }}">
        <input type="text" name="name" class="form-control" placeholder="Filter by Name" value="{{ request('name') }}">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    
    <a href="{{ route('employee.create') }}" class="btn btn-success">+ Add Employee</a>
</div>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Salary</th>
            <th>Department</th>
        </tr>
    </thead>
    <tbody>
        @forelse($employees as $employee)
        <tr>
            <td>{{ $employee->id }}</td>
            <td>
    <a href="{{ route('salary.show', $employee->id) }}" style="text-decoration: none; color: inherit;"
   onmouseover="this.style.fontWeight='bold'; this.style.textDecoration='underline';"
   onmouseout="this.style.fontWeight='normal'; this.style.textDecoration='none';">
        {{ $employee->name }}
    </a>
</td>

            <td>{{ $employee->designation }}</td>
            <td>{{ $employee->salary }}</td>
            <td>{{ $employee->department }}</td>

            
        </tr>
        @empty
        <tr>
            <td colspan="5">No employees found.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $employees->withQueryString()->links() }} {{-- Pagination --}}
@endsection
