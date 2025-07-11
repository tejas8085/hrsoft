<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectManagerTeam extends Model
{
    public function manager()
{
    return $this->belongsTo(User::class, 'project_manager_id');
}

public function employee()
{
    return $this->belongsTo(User::class, 'employee_id');
}

}
