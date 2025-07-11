<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'employee_id', 'type', 'content', 'generated_by', 'viewed_by_employee_at'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
