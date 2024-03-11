<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Designation;
class Department extends Model
{
    use HasFactory;
    public function department_designation()
    {
        return $this->hasMany(Designation::class);
    }
}
