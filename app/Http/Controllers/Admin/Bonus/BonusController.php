<?php

namespace App\Http\Controllers\Admin\Bonus;

use App\Http\Controllers\Controller;
use App\Models\Bonus;
use App\Models\Employee;
use App\Models\EmployeeBonus;
use App\Models\salary;
use Illuminate\Http\Request;
use App\Models\User;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class BonusController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    public function bonusSettingView()
    {
        if (is_null($this->user) || !$this->user->can('Bonus.setting')) {
            abort('403', 'Unauthorized access');
        }
        $bonus = Bonus::all();
        $employee = salary::all();
        return view('admin.bonus.attendance_bonus_setting', compact('employee', 'bonus'));
    }
    public function bonusoutIndex()
    {
        if (is_null($this->user) || !$this->user->can('Bonus.out')) {
            abort('403', 'Unauthorized access');
        }
        $employee_bonus = EmployeeBonus::all();
        return view('admin.bonus.bonus_out_with_bank_cash', compact('employee_bonus'));
    }

    public function BonusTypeIndex()
    {
        if (is_null($this->user) || !$this->user->can('Bonus.type.add')) {
            abort('403', 'Unauthorized access');
        }
        $bonuses = Bonus::all();

        return view('admin.bonus.bonus_types', compact('bonuses'));
    }
    public function BonusTypeSave(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'scale' => 'required',
                'details' => 'required',
            ],
            [
                'name' => 'Please Give Bonus Name',
                'scale' => 'Scale Required',
                'details' => 'Please Give Bonus Details',
            ]
        );
        $bonus = new Bonus();
        $bonus->name = $request->name;
        $bonus->scale = $request->scale;
        $bonus->details = $request->details;
        $bonus->save();

        $notification = array(
            'message' => 'Bonus Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function BonusTypeDelete($id)
    {
        if (is_null($this->user) || !$this->user->can('Bonus.type.delete')) {
            abort('403', 'Unauthorized access');
        }
        $bonus = Bonus::find($id);
        $bonus->delete();
        $notification = array(
            'message' => 'Bonus Deleted Successfully',
            'alert-type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }


    public function getBonusDetails(Request $request)
    {
        $bonusType = $request->input('bonus_type');
        $bonus = Bonus::where('id', $bonusType)->first();

        return response()->json([
            'bonus_scale' => $bonus ? $bonus->scale : '',
            'details' => $bonus ? $bonus->details : '',
        ]);
    }
    public function employee_bonus_upload(Request $request)
    {
        $selectedEmployees = $request->input('selected_employees', []);
        if (empty($selectedEmployees)) {
            $notification = array(
                'message' => 'Please select employee',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        } else {
            foreach ($request->selected_employees as $m => $mitem) {
                $exist = EmployeeBonus::where('employee_id', $request->selected_employees[$m])
                    ->where('bonus_id', $request->bonus_type)
                    ->where('status', 'active')->get();
                if ($exist->count() <= 0) {
                    $employee = new EmployeeBonus();
                    $employee->employee_id = $request->selected_employees[$m];
                    $employee->bonus_id = $request->bonus_type;
                    $employee->status = 'active';
                    $exist_employee = Employee::where('id', $request->selected_employees[$m])->first();
                    $exist_bonus = Bonus::where('id', $request->bonus_type)->first();
                    $salary = $exist_employee->Salary->rate;
                    if ($salary) {
                        $total = round(($salary * $exist_bonus->scale) / 100);
                        $employee->total = $total;
                    }
                    $employee->save();
                }
            }

            $notification = array(
                'message' => 'Bonus Successfully added for selected employee',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function editViewbonus($id)
    {
        if (is_null($this->user) || !$this->user->can('Bonus.type.edit')) {
            abort('403', 'Unauthorized access');
        }
        $bonuses = Bonus::find($id);

        return view('admin.bonus.edit_bonus_type', compact('bonuses'));
    }


    public function bonusTypeUpdate(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required',
                'scale' => 'required',
                'details' => 'required',
            ],
            [
                'name' => 'Bonus Name Required',
                'scale' => 'Scale Required',
                'details' => 'Bonus Details Required',
            ]
        );
        $bonuses = Bonus::find($id);
        $bonuses->name = $request->name;
        $bonuses->scale = $request->scale;
        $bonuses->details = $request->details;
        $bonuses->update();

        $notification = array(
            'message' => 'Bonus updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function bonusoutDelete($id)
    {
        if (is_null($this->user) || !$this->user->can('Bonus.out.delete')) {
            abort('403', 'Unauthorized access');
        }
        $employee_bonus = EmployeeBonus::find($id);
        $employee_bonus->delete();
        $notification = array(
            'message' => 'Employee Bonus Deleted Successfully',
            'alert-type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }
}
