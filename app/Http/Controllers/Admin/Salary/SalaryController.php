<?php

namespace App\Http\Controllers\Admin\Salary;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Disbursement;
use App\Models\Employee;
use App\Models\salary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;

class SalaryController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    public function Index()
    {
        if (is_null($this->user) || !$this->user->can('Salary.view')) {
            abort('403', 'Unauthorized access');
        }
        $salaries = salary::all();
        return view('admin.salary.salary_index', compact('salaries'));
    }
    public function AddPage()
    {
        if (is_null($this->user) || !$this->user->can('Salary.create')) {
            abort('403', 'Unauthorized access');
        }
        $departments = Department::all();
        return view('admin.salary.add_payscal',compact('departments'));
    }
    public function AddPayscal($id)
    {
        $employee = Employee::find($id);

        return view('admin.salary.payscal',compact('employee'));
    }
    public function DeletePayscal($id)
    {
        if (is_null($this->user) || !$this->user->can('Salary.delete')) {
            $notification = array(
                'message' => 'Role has been updated',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
        $salary = salary::find($id);
        $salary->delete();
        $notification = array(
            'message' => 'Salary Deleted Successfully',
            'alert-type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }

    public function SavePayscal(Request $request, $id)
    {

        $request->validate(
            [
                'scal'=>'required',
                'rate'=>'required',
                
            ],
            
            [
                'scal'=>'Please Select Pay Scal',
                'rate'=>'Please Give Pay Rate',
            ]
        );
        $salary = new salary();

        $exists = salary::where('employee_id',$id)->first();
      
                  if (!$exists) {

                    $salary->employee_id = $id;
                    $salary->scal = $request->scal;
                    $salary->rate = $request->rate;
                    $salary->save();

                    $notification = array(
                        'message' => 'Salary Scal Added Successfully',
                        'alert-type' => 'success'
                    );
                    return redirect()->back()->with($notification);        
                  } else{
                    $notification = array(
                        'message' => 'Salary already added for this Employee',
                        'alert-type' => 'error'
                    );
                    return redirect()->back()->with($notification); 
                  }   
    }

    public function AdvanceSalarySave(Request $request, $id)
    {
        // $employee = Employee::find($id);
        $advance = new Disbursement();

        $advance->employee_id = $id;
        $advance->amount = $request->amount;
        $advance->reason = $request->reason;
        $advance->save();
        $notification = array(
            'message' => 'Advance Salary Pay Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function SelectDesignation(Request $request)
    {
        $designations = Designation::where('department_id', $request->department_id)->pluck('name', 'id');
        return response()->json($designations);
    }

    protected function SelectEmployee(Request $request)
    {
        // $wishlist = Wishlist::with('products')->where('user_id',Auth::id())->latest()->get();
        $employees = Employee::with('Designation','Department')->where('designation_id', $request->designation_id)->get();
        return response()->json(['employees'=> $employees]);
    }

    public function EmployeeAdvance()
    {
        $employees = Employee::all();
        return view('HR.disbursements.advance_index',compact('employees'));
    }

    public function AdvanceSalary($id)
    {
        $employee = Employee::find($id);

        $currentMonth = Carbon::now()->format('Y-m');

        $advance = Disbursement::where('employee_id',$employee->id)->whereYear('created_at', '=', Carbon::now()->year)
                    ->whereMonth('created_at', '=', Carbon::now()->month)
                    ->first();
        return view('HR.disbursements.add_advance',compact('employee','advance'));
    }

    public function editPayscal($id)
    {
        if (is_null($this->user) || !$this->user->can('Salary.edit')) {
            $notification = array(
                'message' => 'Role has been updated',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
        $employee=Employee::find($id);

        return view('admin.salary.edit_payscal',compact('employee'));

    }

    public function updatePayscal(Request $request, $id)
    {

        $request->validate(
            [
                'rate'=>'required', 
            ],
            
            [
                'rate'=>'Pay Rate Required',
            ]
        );
        $salary=salary::where('employee_id',$id)->first();
        $salary->employee_id = $id;
        $salary->scal = $request->scal;
        $salary->rate = $request->rate;
        $salary->update();

        $notification = array(
            'message' => 'Salary Scal updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);    

    }
}
