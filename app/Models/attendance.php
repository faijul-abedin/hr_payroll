<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attendance extends Model
{
    use HasFactory;
    public function attendance_employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
