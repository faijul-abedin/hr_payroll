<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAllowance extends Model
{
    use HasFactory;
    public function Employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function Allowance()
    {
        return $this->belongsTo(Allowance::class, 'allowance_id');
    }
}
