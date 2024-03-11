<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
class Increment extends Model
{
    use HasFactory;
    public function employeeIncrement()
    {
        return $this->belongsTo(employee::class,'employee_id');
    }

    public function incrementsalary()
    {
        return $this->hasOne(Salary::class, 'employee_id');
    }
}
