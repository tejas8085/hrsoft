<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // ✅ Add this line
        'employee_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function teamMembers()
{
    return $this->hasMany(ProjectManagerTeam::class, 'project_manager_id');
}

public function assignedTasks()
{
    return $this->hasMany(Task::class, 'assigned_by');
}

public function tasks()
{
    return $this->hasMany(Task::class, 'assigned_to');
}

}