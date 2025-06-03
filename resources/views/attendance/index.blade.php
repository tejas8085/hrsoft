<form method="POST" action="{{ url('/attendance') }}">
    @csrf
    <select name="status" required>
        <option value="present">Present</option>
        <option value="absent">Absent</option>
        <option value="late">Late</option>
    </select>
    <button type="submit">Mark Attendance</button>
</form>
