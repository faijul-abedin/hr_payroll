<?php

namespace App\Http\Controllers;

use App\Models\attendance;
use App\Models\Deduction;
use App\Models\leave;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\salary;

class LatemanagementController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    function latemanage()
    {
        if (is_null($this->user) || !$this->user->can('Late-Manage.add')) {
            abort('403', 'Unauthorized access');
        }
        $salary = salary::all();
        return view('admin.latemanagement.createlatemanagement', compact('salary'));
    }
    function deduction()
    {
        if (is_null($this->user) || !$this->user->can('Late-Manage.deduction_list')) {
            abort('403', 'Unauthorized access');
        }
        $deduction = Deduction::all();
        return view('admin.attendance.deduction', compact('deduction'));
    }
    public function fetchEmployeeCounts(Request $request)
    {
        
        $employeeId = $request->input('employee_id');
        $year = $request->input('year');
        $month = $request->input('month');

        // Retrieve the employee based on the given employee_id
        $attendance = attendance::where('employee_id', $employeeId)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        if ($attendance) {
            // Assuming you have attendance_count and late_count fields in your Employee model
            $total_days = $attendance->count();
            $attendanceCount = $attendance->sum('is_present');
            $lateCount = $attendance->sum('is_late');
            $leave = leave::where('employee_id', $employeeId)
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('status', 'Approved')->get();

            return response()->json([
                'total_days' => $total_days,
                'attendance_count' => $attendanceCount,
                'late_count' => $lateCount,
                'leave_count' => $leave->sum('duration'),
            ]);
        }

        // If the employee is not found, return an error response
        return response()->json(['error' => 'Employee not found'], 404);
    }
}
