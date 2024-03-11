<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leave extends Model
{
    use HasFactory;
    public function leave_user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function leave_employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function approved()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function Deduction()
    {
        return $this->hasOne(Deduction::class, 'leave_id');
    }
}
