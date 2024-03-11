<?php

namespace App\Http\Controllers\Admin\Leave;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Models\Deduction;
use App\Models\leave;
use App\Models\Role;
use App\Models\salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;

class LeaveController extends Controller
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
        if (is_null($this->user) || !$this->user->can('Leaves.list')) {
            abort('403', 'Unauthorized access');
        }
        $roles = Role::all();
        $leave = leave::all();
        return view('admin.leave.leave_index', compact('leave'));
    }
    public function AddPage()
    {

        if (is_null($this->user) || !$this->user->can('Leaves.add')) {
            abort('403', 'Unauthorized access');
        }
        $employee = salary::all();

        return view('admin.leave.addpage', compact('employee'));
    }
    public function AddLeave($id)
    {
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();
        $activities = leave::where('employee_id', $id)
            ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
            ->get();
        $employee = Employee::where('id', $id)->first();
        $salary = $employee->Salary->rate;
        $per_day_salary = round($salary / 22);
        return view('admin.leave.add_leave', compact('employee', 'activities', 'per_day_salary'));
    }
    public function store(Request $request, $id)
    {
        $request->validate(
            [
                'type' => 'required',
                'duration' => 'required',
                'start' => 'required',
                'status' => 'required',
                'reason' => 'required',
            ],

            [

                'type' => 'Please Select Leave Type',
                'duration' => 'Please Enter Duration',
                'start' => 'Please Give Leave Start Date',
                'status' => 'Please Select Paid or Unpaid',
                'reason' => 'Please Write The Reason',
            ]
        );
        $leave = new leave();
        $leave->type = $request->type;
        $leave->duration = $request->duration;
        $leave->start = $request->start;
        $leave->pay_status = $request->status;
        $leave->employee_id = $id;
        $leave->user_id =  Auth::guard('web')->user()->id;
        $leave->reason = $request->reason;
        $leave->status = 'pending';
        $leave->save();
        if ($request->status == 'Unpaid') {
            $deduct = new Deduction();
            $salary = salary::where('employee_id', $id)->first();
            $per_day_salary = $salary->rate / 22;
            $total = $per_day_salary * $request->duration;

            $deduct->leave_id = $leave->id;

            $deduct->rate = round($per_day_salary);
            $deduct->status = 'pending';
            $deduct->type = 'leave';
            $deduct->total = round($total);
            $deduct->save();
        }
        $notification = array(
            'message' => 'Leave Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function application($id)
    {

        $leave = leave::where('id', $id)->first();
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();
        $activities = leave::where('employee_id', $leave->employee_id)
            ->where('status', 'Approved')
            ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
            ->get();
        return view('admin.leave.leave_application', compact('leave', 'activities'));
    }
    public function status_update($id, Request $request)
    {

        if (is_null($this->user) || !$this->user->can('Leaves.edit')) {
            $notification = array(
                'message' => 'Permission denied',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $request->validate(
            [
                'status' => 'required',
            ],

            [
                'status' => 'Please Select Paid or Unpaid',
            ]
        );

        $leave = leave::where('id', $id)->first();
        $leave->status = $request->status;
        $leave->approved_by =  Auth::guard('web')->user()->id;
        $leave->save();
        $deduction = Deduction::where('leave_id', $id)->first();
        if ($deduction) {
            if ($request->status == 'Approved') {
                $deduction->status = 'Approved';
            } else {
                $deduction->status = 'Rejected';
            }
            $deduction->save();
        }

        $notification = array(
            'message' => 'Leave Status Successfully Updated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function deleteLeave($id)
    {

        if (is_null($this->user) || !$this->user->can('Leaves.delete')) {
            $notification = array(
                'message' => 'Permission denied',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $leave = leave::find($id);
        $leave->delete();
        $notificcation = array(
            'message' => 'Deletd From Leave List Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notificcation);
    }
    public function absenceDeduction(Request $request)
    {
        $employeeId = $request->input('employee_id');
        $year = $request->input('year');
        $month = $request->input('month');

        $deduction = Deduction::where('employee_id', $employeeId)
            ->where('year', $year)
            ->where('month', $month)
            ->get();

        if ($deduction->count() > 0) {
            $notification = array(
                'message' => 'Deduction is alreay added for this month',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        } else {
            $deduction = new Deduction();
            $deduction->employee_id = $request->employee_id;
            $salary = salary::where('employee_id', $request->employee_id)->first();
            $per_day_salary = round($salary->rate / 22);
            $total = round($per_day_salary * $request->total_deductions);
            $deduction->rate = $per_day_salary;
            $deduction->status = 'Approved';
            $deduction->type = 'absence';
            $deduction->total = $total;
            $deduction->month = $month;
            $deduction->year = $year;
            $deduction->save();
            $notification = array(
                'message' => 'Late deduction Added Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }
}
