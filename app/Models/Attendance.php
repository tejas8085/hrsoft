<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['employee_id', 'attendance_date', 'status', 'in_time', 'out_time'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}