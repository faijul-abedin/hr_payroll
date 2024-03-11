<?php

namespace App\Http\Controllers;

use App\Models\attendance;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    function addattendance()
    {
        
        if (is_null($this->user) || !$this->user->can('Attendance.add')) {
            abort('403', 'Unauthorized access');
        }
        $employee = Employee::all();
        return view('admin.attendance.attendanceform', compact('employee'));
    }
    public function store(Request $request)
    {
        $latestUpload = attendance::whereDate('created_at', Carbon::today())->get();

        if ($latestUpload->count() > 0) {
            $notification = array(
                'message' => 'Attendance already taken',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        } else {
            $selectedEmployees = $request->input('selected_employees', []);
            if (empty($selectedEmployees)) {
                // Set the value to 0 or any default value you want
                $notification = array(
                    'message' => 'Please select employee',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            } else {
                foreach ($request->em_id as $i => $item) {
                    $attendance = new attendance();
                    $attendance->employee_id = $request->em_id[$i];

                    // Check if 'selected_employees' array and its index are valid
                    if (isset($request->selected_employees[$i])) {
                        $attendance->is_present = $request->selected_employees[$i];
                    } else {
                        $attendance->is_present = 0; // Set a default value if it's not present
                    }

                    // Check if 'late' array and its index are valid
                    if (isset($request->late[$i])) {
                        $attendance->is_late = $request->late[$i];
                    } else {
                        $attendance->is_late = 0; // Set a default value if it's not present
                    }

                    $attendance->save();
                }

                $notification = array(
                    'message' => 'Attendance successfuly added',
                    'alert-type' => 'success'
                );
                return back()->with($notification);
            }
        }
    }
    function attendanceindex()
    {
        if (is_null($this->user) || !$this->user->can('Attendance.monthly_report')) {
            abort('403', 'Unauthorized access');
        }
        $currentMonth = date('m');
        $currentYear = date('Y');

        $attendance =  Attendance::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->orderBy('created_at', 'asc') // Sort by date in ascending order
            ->get();

        return view('admin.attendance.attendancereport', compact('attendance'));
    }
    public function showAllAttendance()
    {
        if (is_null($this->user) || !$this->user->can('Attendance.all_report')) {
            abort('403', 'Unauthorized access');
        }
        $attendance = Attendance::orderBy('created_at', 'asc')->get();

        return view('admin.attendance.all_attendance_report', compact('attendance'));
    }

    public function updateStatus(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('Attendance.edit')) {
            abort('403', 'Unauthorized access');
        }
        $record = Attendance::find($request->input('record_id'));

        if (!$record) {
            return back()->with('error', 'Record not found');
        }

        $statusType = $request->input('status_type');
        $newStatus = $request->input('new_status');

        if ($statusType === 'is_present') {
            $record->is_present = $newStatus;
        } elseif ($statusType === 'is_late') {
            $record->is_late = $newStatus;
        }

        $record->save();

        $notification = array(
            'message' => 'Attendance status updated successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }
    
}