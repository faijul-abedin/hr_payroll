<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Disbursement;
use App\Models\Increment;
use App\Models\leave;
class employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function employee_disbursement()
    {
        return $this->hasMany(Disbursement::class);
    }
    public function Designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }
    public function Department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function increments()
    {
        return $this->hasOne(Increment::class);
    }
    
    
    public function Shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }

    
    public function Salary()
    {
        return $this->hasOne(salary::class, 'employee_id');
    }
    public function Disbursement()
    {
        return $this->hasMany(Disbursement::class, 'employee_id');
    }
    public function employee_leave()
    {
        return $this->hasMany(leave::class);
    }
    public function Bonuses()
    {
        return $this->hasMany(EmployeeBonus::class, 'employee_id');
    }
    public function Loans()
    {
        return $this->hasMany(HrLoan::class, 'employee_id');
    }
    public function Leaves()
    {
        return $this->hasMany(Leave::class, 'employee_id');
    }
    public function Overtimes()
    {
        return $this->hasMany(OtDisversement::class, 'employee_id');
    }
    public function Attendance()
    {
        return $this->hasMany(Deduction::class, 'employee_id');
    }
    public function Reward()
    {
        return $this->hasMany(Reward::class, 'employee_id');
    }
    public function RedeemPoint()
    {
        return $this->hasMany(RedeemPoint::class, 'employee_id');
    }
}
