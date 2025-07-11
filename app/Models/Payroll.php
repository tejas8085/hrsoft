<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'month',
        'working_days',
        'present_days',
        'paid_leaves',
        'basic_salary',
        'hra',
        'pf',
        'esic',
        'incentives',
        'bonus',
        'city_allowance',
        'labour_welfare_fund',
        'income_tax',
        'professional_tax',
        'net_salary',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}