<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtDisversement extends Model
{
    use HasFactory;
    
    public function Employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
