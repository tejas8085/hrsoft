<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'designation', 'joining_date', 'department', 'mobile', 'email',
        'uan', 'pf', 'pan', 'dob', 'esic', 'paddress', 'caddress', 'salary',
        'bank_name', 'account_no', 'ifsc', 'incentives', 'bonus', 'city_allowance',
        'password' // ✅ add password field
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
     public function attendances()
    {
        return $this->hasMany(\App\Models\Attendance::class, 'employee_id');
    }
}