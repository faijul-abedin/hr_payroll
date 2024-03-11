<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\attendance;
use App\Models\AttendanceResward;
use App\Models\Employee;
use App\Models\HrLoan;
use App\Models\leave;
use App\Models\Reward;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    // public function dashboard()
    // {
    //     return view('admin.layouts.dashboard');
    // }

    public function homeView()
    {
        if (is_null($this->user) || !$this->user->can('superadmin.dashboard')) {
            $notification = array(
                'message' => 'Unauthorized access',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $currentDate = Carbon::now();
        $currentMonth = date('m');
        $currentYear = date('Y');
        $hasDataForCurrentMonth = Reward::whereMonth('created_at', '=', $currentMonth)
            ->whereYear('created_at', '=', $currentYear)->where('point_category_id', 0)
            ->get();

        // Get the first day of the current month
        $firstDayOfCurrentMonth = $currentDate->firstOfMonth();

        // Get the first day of the last month
        $firstDayOfLastMonth = $firstDayOfCurrentMonth->subMonth();

        // Get the month and year of the last month
        $lastMonth = $firstDayOfLastMonth->format('m');
        $currentYear = $firstDayOfLastMonth->format('Y');
        $point = AttendanceResward::find(1);
        $attendanceLastMonth = attendance::whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $currentYear)
            ->orderBy('created_at', 'asc')
            ->get();

        $working_day = $attendanceLastMonth->count() - $point->attendance_minimization;
        $reward_employee =  attendance::whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $currentYear)
            ->select('employee_id', DB::raw('SUM(is_present) as total_attendance'), DB::raw('SUM(is_late) as total_late_days'))
            ->groupBy('employee_id')
            ->having('total_attendance', '>=', $working_day)
            ->having('total_late_days', '<=', $point->late_minimization)
            ->get();

        $latestUpload = attendance::whereDate('created_at', Carbon::today())->get();
        $leave = leave::where('status', 'pending')->get();
        $due_loan = HrLoan::all()->sum('due');
        $attendance = [];
        $late = [];
        $employeesWithoutSalary = Employee::leftJoin('salaries', 'employees.id', '=', 'salaries.employee_id')
            ->whereNull('salaries.id')
            ->get(['employees.id', 'employees.name', 'employees.employee_id']);
        $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September"];
        foreach ($months as $month) {
            $attendanceTotal = attendance::whereMonth('created_at', Carbon::parse($month)->month)->sum('is_present');
            $lateTotal = attendance::whereMonth('created_at', Carbon::parse($month)->month)->sum('is_late');

            $attendance[] = $attendanceTotal;
            $late[] = $lateTotal;
        }
        $eligible_employee = $reward_employee->count() - $hasDataForCurrentMonth->count();
        return view('admin.home.index3', compact('latestUpload', 'leave', 'due_loan', 'attendance', 'late', 'months', 'employeesWithoutSalary','eligible_employee'));
    }
    public function attendanceCount()
    {
        $attendance = attendance::whereDate('created_at', Carbon::today())->get();
        return view('admin.attendance.attendancereport', compact('attendance'));
    }
    public function leaveCount()
    {
        $leave = leave::where('status', 'pending')->get();
        return view('admin.leave.leave_index', compact('leave'));
    }
    public function loanCount()
    {
        $loans = HrLoan::where('due', '>', 0)->get();
        return view('admin.hr loan.index', compact('loans'));
    }
}
