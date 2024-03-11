<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Shift;
use Illuminate\Http\Request;
use App\Models\User;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    public function createView()
    {
        if (is_null($this->user) || !$this->user->can('Employee.create')) {
            abort('403', 'Unauthorized access');
        }
        $department = Department::all();
        $designation = Designation::all();
        $shift = Shift::all();

        return view('admin.employee.addemployee', compact('department', 'designation', 'shift'));
    }

    protected function SelectDesignation(Request $request)
    {
        $designations = Designation::where('department_id', $request->department_id)->pluck('name', 'id');
        return response()->json($designations);
    }

    public function employeeIndex()
    {
        if (is_null($this->user) || !$this->user->can('Employee.view')) {
            abort('403', 'Unauthorized access');
        }
        $employees = Employee::all();
        return view('admin.employee.indexemployee', compact('employees'));
    }

    public function SaveEmployee(Request $request)
    {
        $request->validate(
            [
                'employee_name'=>'required',
                'email'=>'required',
                'password'=>'required',
                'birth'=>'required',
                'gender'=>'required',
                'phone_1'=>'required',
                'present_address'=>'required',
                'permanent_address'=>'required',
                'nationality'=>'required',
                'marital_status'=>'required',
                'department'=>'required',
                'designation'=>'required',
                'shift'=>'required',
                'join_date'=>'required',
                'status'=>'required',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ],
            
            [
                'employee_name'=>'Please Enter Employee Name',
                'email'=>'Please Enter Email',
                'password'=>'Please Enter Password',
                'birth'=>'Please Enter Date of Birth',
                'gender'=>'Please Enter Gender',
                'phone_1'=>'Please Enter Contact Number',
                'present_address'=>'Please Enter Present Address',
                'permanent_address'=>'Please Enter Permanant Address',
                'nationality'=>'Please Enter Nationality',
                'marital_status'=>'Please Select Marital Status',
                'department'=>'Please Select Department',
                'designation'=>'Please Select Designation',
                'shift'=>'Please Select Shift',
                'join_date'=>'Please Select Joining Date',
                'status'=>'Please Select Employee Status',
                'image' => 'Please Give an Employee Image |  jpeg,png,jpg',
                
            ]
        );

        $employee = new Employee();
        $employee->name = $request->employee_name;
        $employee->email = $request->email;
        $employee->password = $request->password;
        $employee->date_of_birth = $request->birth;
        $employee->gender = $request->gender;
        $employee->contact = $request->phone_1;
        $employee->alternative_contact = $request->phone_2;
        $employee->present_address = $request->present_address;
        $employee->permanent_address = $request->permanent_address;
        $employee->nationality = $request->nationality;
        $employee->marital_status = $request->marital_status;
        $employee->rer_1 = $request->rer_1;
        $employee->ref_1_phone = $request->ref_1_phone;
        $employee->rer_2 = $request->rer_2;
        $employee->ref_2_phone = $request->ref_2_phone;

        // $employee->employee_id=$request->employee_id;

        $last_employee_id = Employee::orderBy('id', 'desc')->first();
        $employee_number = $last_employee_id ? sprintf('%06d', intval($last_employee_id->id) + 1) : '000001';
        $employee->employee_id = $employee_number;

        $employee->department_id = $request->department;
        $employee->designation_id = $request->designation;
        $employee->shift_id = $request->shift;
        $employee->starting = $request->join_date;
        $employee->ending = $request->leave_date;
        $employee->comment = $request->comment;


        // $employee->manager_id=$request->manager_id;
        // $employee->ending=$request->leave_date;
        $employee->status = $request->status;

        if ($request->file('image')) {
            $file = $request->file('image');
            // @unlink('backend/images/brands/'.$brand->image);
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('admin/images/employees/', $filename);
            $employee->photo = $filename;
        }

        $employee->save();
        $notification = array(
            'message' => 'Employee Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function employeeEditView($id)
    {
        if (is_null($this->user) || !$this->user->can('Employee.edit')) {
            abort('403', 'Unauthorized access');
        }
        $employee = Employee::find($id);
        $department = Department::all();
        $designation = Designation::all();
        $shift = Shift::all();
        return view('admin.employee.editemployee', compact('employee','department','designation','shift'));
    }

    public function employeeUpdate(Request $request, $id)
    {

        $employee = Employee::find($id);
        $employee->name = $request->employee_name;
        $employee->email = $request->email;
        $employee->password = $request->password;
        $employee->date_of_birth = $request->birth;
        $employee->gender = $request->gender;
        $employee->contact = $request->phone_1;
        $employee->alternative_contact = $request->phone_2;
        $employee->present_address = $request->present_address;
        $employee->permanent_address = $request->permanent_address;
        $employee->nationality = $request->nationality;
        $employee->marital_status = $request->marital_status;
        $employee->rer_1 = $request->rer_1;
        $employee->ref_1_phone = $request->ref_1_phone;
        $employee->rer_2 = $request->rer_2;
        $employee->ref_2_phone = $request->ref_2_phone;

        $employee->department_id = $request->department;
        $employee->designation_id = $request->designation;
        $employee->shift_id = $request->shift;
        $employee->starting = $request->join_date;
        $employee->ending = $request->leave_date;
        $employee->comment = $request->comment;
        $employee->status = $request->status;

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('admin/images/employees/', $filename);
            $employee->photo = $filename;
        }

        $employee->update();

        $notification = array(
            'message' => 'Employee Information Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function employeeDelete($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        $notificcation = array(
            'message' => 'Deleted From Employee List Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notificcation);
    }
}
