@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <div style="display: flex; gap: 10px; align-items: center;">
        <h2>{{ \Carbon\Carbon::create($year, $month)->format('F Y') }}</h2>
        <form method="GET" action="{{ url('/attendance') }}" style="display: flex; gap: 5px;">
            <select name="month" onchange="this.form.submit()">
                @foreach(range(1,12) as $m)
                <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                </option>
                @endforeach
            </select>
            <select name="year" onchange="this.form.submit()">
                @foreach(range(now()->year - 5, now()->year + 5) as $y)
                <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>
                    {{ $y }}
                </option>
                @endforeach
            </select>
        </form>
    </div>

    {{-- Top Export Period Selection --}}
    <!-- <form method="GET" action="{{ url('/attendance/export') }}" style="display: flex; gap: 5px; align-items: center;">
        <label>
            From:
            <input type="date" name="from" value="{{ request('from') ?? $dates[0] }}" required>
        </label>
        <label>
            To:
            <input type="date" name="to" value="{{ request('to') ?? $dates[count($dates)-1] }}" required>
        </label>
        <button type="submit">Export</button>
    </form> -->
</div>

{{-- Weekday headers --}}
<div style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 10px; text-align: center; font-weight: bold;">
    <div>Sun</div>
    <div>Mon</div>
    <div>Tue</div>
    <div>Wed</div>
    <div>Thu</div>
    <div>Fri</div>
    <div>Sat</div>
</div>

{{-- Dates grid --}}
<div style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 10px;">
    @php
    $firstDayOfMonth = \Carbon\Carbon::parse($dates[0])->dayOfWeek;
    $todayStr = now()->toDateString();
    @endphp

    {{-- Empty slots --}}
    @for ($i = 0; $i < $firstDayOfMonth; $i++) <div>
</div>
@endfor

@foreach($dates as $date)
@php
$record = $attendanceSummary[$date] ?? ['Present' => 0, 'Absent' => 0, 'On Leave' => 0];
$isPast = \Carbon\Carbon::parse($date)->isPast();
$isToday = $date === $todayStr;
@endphp

<a href="{{ url('/attendance/'.$date) }}" style="text-decoration: none; color: inherit;">
    <div style="
                border:1px solid #ccc;
                padding:10px;
                border-radius: 8px;
                text-align: center;
                background: {{ $isToday ? '#87CEEB' : '#f9f9f9' }};
                transition: background 0.3s, box-shadow 0.3s;"
        onmouseover="this.style.background='{{ $isToday ? '#87CEEB' : '#eef' }}'; this.style.boxShadow='0 0 10px rgba(0,0,0,0.2)'"
        onmouseout="this.style.background='{{ $isToday ? '#87CEEB' : '#f9f9f9' }}'; this.style.boxShadow='none'">

        <div style="font-size: 24px; font-weight: bold;">{{ \Carbon\Carbon::parse($date)->day }}</div>
        <div style="font-size: 12px; color: gray;">{{ $date }}</div>

        @if($isPast)
        <div style="font-size: 12px; margin-top: 5px; display: flex; justify-content: center; gap: 6px;">
            <span>P: {{ $record['Present'] }}</span>
            <span>A: {{ $record['Absent'] }}</span>
            <span>L: {{ $record['On Leave'] }}</span>
        </div>
        @endif
    </div>
</a>
@endforeach
</div>
<div
    style="position: fixed; padding_top:100px; bottom: 20px; right: 20px; background: #000; padding: 8px 10px; border-radius: 8px;">
<form method="GET" action="{{ url('/payroll/export') }}" style="display: flex; gap: 5px; align-items: center;">
    <input type="date" name="from" value="{{ old('from', '2024-06-01') }}" required style="padding: 3px 5px; font-size: 12px;">
    <input type="date" name="to" value="{{ old('to', now()->toDateString()) }}" required style="padding: 3px 5px; font-size: 12px;">
    <button type="submit"
        style="background: #007BFF; color: #fff; border: none; padding: 4px 8px; border-radius: 4px; font-size: 12px; cursor: pointer;">
        Export
    </button>
</form>



</div>
@endsection