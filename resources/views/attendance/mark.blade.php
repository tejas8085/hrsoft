@extends('layouts.app')

@section('content')
<h2 style="margin-bottom: 20px; font-size: 24px; font-weight: bold; color: #333;">
    Mark Attendance for {{ $attendance_date }}
</h2>

@if(session('success'))
<div style="color: #28a745; background: #e9f7ef; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
    {{ session('success') }}
</div>
@endif

<form method="POST" action="{{ url('/attendance/save') }}" id="attendance-form">
    @csrf
    <input type="hidden" name="attendance_date" value="{{ $attendance_date }}">

    <div id="employee-list" style="max-height: 70vh; overflow-y: auto; padding-right: 10px;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px;">
            @foreach($employees as $employee)
            <div class="employee-card" data-id="{{ $employee->id }}" style="border: 1px solid #ddd; border-radius: 8px; padding: 15px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.05); transition: box-shadow 0.3s, transform 0.3s;">
                <strong style="font-size: 16px; color: #333;">{{ $employee->name }}</strong>

                <div class="employee-form-wrapper">
                    <div style="margin-top: 10px; font-size: 14px;">
                        <label><input type="radio" name="attendance[{{ $employee->id }}][status]" value="Present" required> Present</label>
                        <label><input type="radio" name="attendance[{{ $employee->id }}][status]" value="Absent"> Absent</label>
                        <label><input type="radio" name="attendance[{{ $employee->id }}][status]" value="On Leave"> On Leave</label>
                    </div>

                    <div style="margin-top: 10px; font-size: 13px;">
                        <label style="display: block; margin-bottom: 5px;">
                            In Time:
                            <input type="time" name="attendance[{{ $employee->id }}][in_time]" value="{{ now()->setTimezone('Asia/Kolkata')->format('H:i') }}" style="width: 130px; padding: 4px;">
                        </label>
                        <label>
                            Out Time:
                            <input type="time" name="attendance[{{ $employee->id }}][out_time]" style="width: 130px; padding: 4px;">
                        </label>
                    </div>
                </div>

                <div style="text-align: right; margin-top: 10px;">
                    <button type="button" class="btn-mark btn" style="padding: 5px 10px; background-color: #28a745; color: #fff; border: none; border-radius: 4px; cursor: pointer;">
                        ✅ Mark
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div style="text-align: center; margin-top: 30px;">
        <button type="submit" class="btn btn-primary">Submit All Attendance</button>
    </div>
</form>

{{-- Marked List --}}
<div id="marked-list" style="margin-top: 40px;">
    <h4 style="margin-bottom: 15px; font-weight: bold;">✅ Marked Employees</h4>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px;" id="marked-container">
        <!-- Marked employee cards will appear here -->
    </div>
</div>

{{-- JavaScript --}}
<script>
    document.querySelectorAll('.btn-mark').forEach(btn => {
        btn.addEventListener('click', function () {
            const card = this.closest('.employee-card');
            const employeeId = card.dataset.id;
            const radios = card.querySelectorAll(`input[name="attendance[${employeeId}][status]"]`);
            let selected = false;

            radios.forEach(radio => {
                if (radio.checked) selected = true;
            });

            if (!selected) {
                alert("Please select a status before marking.");
                return;
            }

            // Clone card for display
            const visualClone = card.cloneNode(true);
            visualClone.querySelector('.btn-mark')?.remove(); // remove mark button
            visualClone.querySelectorAll('input').forEach(input => input.disabled = true);

            // Move to marked section
            document.getElementById('marked-container').appendChild(visualClone);

            // Keep form inputs in DOM (important)
            card.style.display = 'none'; // hide original card but keep inputs in form
        });
    });
</script>
@endsection
