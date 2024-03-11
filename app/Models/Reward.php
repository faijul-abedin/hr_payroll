<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;
   

    public function Employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function PointCategory()
    {
        return $this->belongsTo(PointCategory::class, 'point_category_id');
    }

}
