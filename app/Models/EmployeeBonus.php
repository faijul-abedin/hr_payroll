<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
class EmployeeBonus extends Model
{
    use HasFactory;
    public function employee_bonus_employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function employee_bonus_bonus()
    {
        return $this->belongsTo(Bonus::class, 'bonus_id');
    }
}
