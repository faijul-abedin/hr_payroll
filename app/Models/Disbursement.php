<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disbursement extends Model
{
    use HasFactory;
    public function disbursement_employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
