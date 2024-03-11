<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedeemPoint extends Model
{
    use HasFactory;
    public function Employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function PointGift()
    {
        return $this->belongsTo(PointGift::class, 'point_gift_id');
    }
}
