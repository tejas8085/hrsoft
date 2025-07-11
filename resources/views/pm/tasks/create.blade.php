@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Assign New Task</h3>
    <form method="POST" action="{{ route('pm.tasks.store') }}">
        @csrf
        <div class="mb-3">
            <label>Assign To (Team Member)</label>
            <select name="assigned_to" class="form-control">
                @foreach ($teamMembers as $member)
                    <option value="{{ $member->employee->id }}">{{ $member->employee->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Due Date</label>
            <input type="date" name="due_date" class="form-control">
        </div>
        <button class="btn btn-primary">Assign Task</button>
    </form>
</div>
@endsection
