<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use App\Models\attendance;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\HrLoan;
use App\Models\leave;
use App\Models\Notice;
use App\Models\PointGift;
use App\Models\ProcessPayroll;
use App\Models\RedeemPoint;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class EmployeeProfileController extends Controller
{
    public function LoginPage()
    {
        return view('admin.employee.employee_login');
    }
    public function Dashboard($id)
    {
        if (Session::has('key')) {

            $loggedInEmployeeId = session('key');

            if ($loggedInEmployeeId == $id) {
            $employee = Employee::findOrFail($id);
            $notices = Notice::all();
            return view('admin.employee.employee_dashboard', compact('employee','notices'));
        } else {
            $notification = array(
                'message' => 'Unauthorized Acceess!',
                'alert-type' => 'error'
            );
        return redirect()->back()->with($notification);
    }
    } else {
        return redirect()->back();
    }
    }
    public function Profile($id)
    {
        if(Session::has('key')){
            $loggedInEmployeeId = session('key');
            if ($loggedInEmployeeId == $id) {
                $profileData = Employee::findOrFail($id);
                return view('admin.employee.profile',compact('profileData'));
            } else {
                $notification = array(
                    'message' => 'Unauthorized Acceess!',
                    'alert-type' => 'error'
                );
            return redirect()->back()->with($notification);
        }

            
        }else{
            return redirect()->route('employee.login');
        }
        
    }

    public function Holidays($id)
    {
        if(Session::has('key')){
            $loggedInEmployeeId = session('key');
            if ($loggedInEmployeeId == $id) {
                $holidays = Holiday::all();
                return view('admin.employee.holiday',compact('holidays'));
            } else {
                $notification = array(
                    'message' => 'Unauthorized Acceess!',
                    'alert-type' => 'error'
                );
            return redirect()->back()->with($notification);
        }

            
        }else{
            return redirect()->route('employee.login');
        }
        
    }
    public function EmployeeReward($id)
    {
        if(Session::has('key')){

            $loggedInEmployeeId = session('key');
            if ($loggedInEmployeeId == $id) {
                $rewards = Reward::where('employee_id',$id)->orderByDesc('id')->get();
                $redeems = RedeemPoint::where('employee_id',$id)->orderByDesc('id')->get();
                $sub = ($rewards->where('status',"active")->pluck('point')->sum())-($redeems->pluck('redeem_point')->sum());
                $gift = PointGift::all();
                return view('admin.employee.rewards',compact('rewards','gift','sub'));
            } else {
                $notification = array(
                    'message' => 'Unauthorized Acceess!',
                    'alert-type' => 'error'
                );
            return redirect()->back()->with($notification);
        }
        }else{
            return redirect()->route('employee.login');
        }
    }
    public function Attendance($id)
    {
        if(Session::has('key')){

            $loggedInEmployeeId = session('key');
            if ($loggedInEmployeeId == $id) {
                $attendance = attendance::where('employee_id',$id)->orderByDesc('id')->get();
                return view('admin.employee.attendance',compact('attendance'));
            } else {
                $notification = array(
                    'message' => 'Unauthorized Acceess!',
                    'alert-type' => 'error'
                );
            return redirect()->back()->with($notification);
        }
        }else{
            return redirect()->route('employee.login');
        }
    }

    public function Loans($id)
    {
        if(Session::has('key')){

            $loggedInEmployeeId = session('key');
            if ($loggedInEmployeeId == $id) {
                $loans = HrLoan::where('employee_id',$id)->orderByDesc('id')->get();
                return view('admin.employee.loans',compact('loans'));
            } else {
                $notification = array(
                    'message' => 'Unauthorized Acceess!',
                    'alert-type' => 'error'
                );
            return redirect()->back()->with($notification);
        }
        }else{
            return redirect()->route('employee.login');
        }
    }

    public function ApplicationPage($id)
    {
        // $attendance = Attendance::where('employee_id',1)->orderByDesc('id')->get();
        
        if(Session::has('key')){

            $loggedInEmployeeId = session('key');
            if ($loggedInEmployeeId == $id) {
                return view('admin.employee.application');
            } else {
                $notification = array(
                    'message' => 'Unauthorized Acceess!',
                    'alert-type' => 'error'
                );
            return redirect()->back()->with($notification);
        }    
        }else{
            return redirect()->route('employee.login');
        }
    }


    
    public function ApplicationList($id)
    {
        if(Session::has('key')){

            $loggedInEmployeeId = session('key');
            if ($loggedInEmployeeId == $id) {
                $leave = leave::where('employee_id',$id)->get();
                return view('admin.employee.applicationlist', compact('leave'));
            } else {
                $notification = array(
                    'message' => 'Unauthorized Acceess!',
                    'alert-type' => 'error'
                );
            return redirect()->back()->with($notification);
        }
        }else{
            return redirect()->route('employee.login');
        }

    }


    public function SalaryList($id)
    {
        if(Session::has('key')){

            $loggedInEmployeeId = session('key');
            if ($loggedInEmployeeId == $id) {
                $employees = ProcessPayroll::where('employee_id',$id)->get();
                return view('admin.employee.salarylist', compact('employees'));
            } else {
                $notification = array(
                    'message' => 'Unauthorized Acceess!',
                    'alert-type' => 'error'
                );
            return redirect()->back()->with($notification);
        }
        }else{
            return redirect()->route('employee.login');
        }

    }

    public function PrintEmployee($id)
    {
        $salary = ProcessPayroll::findOrFail($id);
        
        return view('admin.employee.emp_print_salary',compact('salary'));
         
    }


    public function ApplicationSave(Request $request, $id)
    {
        if(Session::has('key')){
            $leave = new leave();
        $leave->type = $request->type;
        $leave->duration = $request->duration;
        $leave->start = $request->start;
        $leave->pay_status = 'Paid';
        $leave->employee_id = $id;
        $leave->user_id =  0;
        $leave->reason = $request->reason;
        $leave->status = 'pending';
        $leave->save();
        $notification = array(
            'message' => 'Application Submitted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        }else{
            return redirect()->route('employee.login');
        }
    }

    public function RedeemPointSave(Request $request, $id)
    {
        if(Session::has('key')){
            $redeem = new RedeemPoint();
            $redeem->employee_id = $id;
            $redeem->point_gift_id = $request->gift_category;
            $redeem->last_total = $request->last_total;
            $redeem->redeem_point = $request->redeem_point;
            $redeem->save();
        $notification = array(
            'message' => 'Reward Remeeded Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        }else{
            return redirect()->route('employee.login');
        }
    }
    public function SelectGift(Request $request)
    {
        $gift_cat = PointGift::where('id', $request->gift_category)->first();
        return response()->json($gift_cat);
    }

    public function LoginSubmit(Request $request)
    {
        $profileData=employee::where('email',$request->email)->where('password',$request->password)->first();
        if($profileData)
        {
            $employee_id = $profileData->id;
            Session::put('key',$employee_id);
            return redirect()->route('employee.dashboard',$employee_id);
        }
        else {
            return redirect()->back();
        }
    }

    public function Logout(Request $request){
        // $request->session()->forget('user_id');
        $request->session()->flush();
        return redirect()->route('employee.login');
    }

}
