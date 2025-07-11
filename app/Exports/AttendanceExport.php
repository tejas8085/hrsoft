<?php
namespace App\Exports;

use App\Models\Attendance;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class AttendanceExport implements FromCollection, WithHeadings
{
    protected $from, $to;

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function collection()
    {
        $employees = Employee::all();
        $dates = collect();
        $period = \Carbon\CarbonPeriod::create($this->from, $this->to);

        foreach ($period as $date) {
            $dates->push($date->toDateString());
        }

        $rows = collect();

        foreach ($employees as $emp) {
            $row = [
                'Employee ID' => $emp->id,
                'Employee Name' => $emp->name,
            ];

            foreach ($dates as $d) {
                $att = Attendance::where('employee_id', $emp->id)
                    ->where('attendance_date', $d)
                    ->first();

                $row[$d] = $att->status ?? '';
            }

            $rows->push(collect($row));
        }

        return $rows;
    }

    public function headings(): array
    {
        $period = \Carbon\CarbonPeriod::create($this->from, $this->to);
        $dateHeadings = [];
        foreach ($period as $date) {
            $dateHeadings[] = $date->toDateString();
        }

        return array_merge(['Employee ID', 'Employee Name'], $dateHeadings);
    }
}
