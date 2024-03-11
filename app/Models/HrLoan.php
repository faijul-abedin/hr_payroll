<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrLoan extends Model
{
    use HasFactory;

    public function employeeLoan()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

}
