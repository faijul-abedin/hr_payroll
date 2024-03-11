<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    use HasFactory;
    public function deduction_leave()
    {
        return $this->belongsTo(leave::class, 'leave_id');
    }
    public function deduction_employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    
}
