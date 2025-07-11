<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function assignedBy()
{
    return $this->belongsTo(User::class, 'assigned_by');
}

public function assignedTo()
{
    return $this->belongsTo(User::class, 'assigned_to');
}

}
