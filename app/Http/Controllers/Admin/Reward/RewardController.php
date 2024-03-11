<?php

namespace App\Http\Controllers\Admin\Reward;

use App\Http\Controllers\Controller;
use App\Models\attendance;
use App\Models\AttendanceResward;
use App\Models\Employee;
use App\Models\PointCategory;
use App\Models\PointGift;
use App\Models\RedeemPoint;
use App\Models\Reward;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RewardController extends Controller
{

    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    public function RewardTypesIndex()
    {
        if (is_null($this->user) || !$this->user->can('reward.type')) {
            $notification = array(
                'message' => 'Unauthorized access',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $r_category = PointCategory::all();
        return view('admin.reward.reward_types', compact('r_category'));
    }
    public function RewardTypeEdit($id)
    {
        $type = PointCategory::findOrFail($id);
        return view('admin.reward.edit_types', compact('type'));
    }
    public function RewardTypeSave(Request $request)
    {
        $type = new PointCategory();
        $type->name = $request->name;
        $type->point = $request->point;
        $type->save();
        $notification = array(
            'message' => 'Point Category Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function RewardTypeUpdate(Request $request, $id)
    {
        $type = PointCategory::findOrFail($id);
        $type->name = $request->name;
        $type->point = $request->point;
        $type->update();
        $notification = array(
            'message' => 'Point Category Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('reward.types')->with($notification);
    }
    public function RewardTypeDelete($id)
    {
        $type = PointCategory::find($id);
        $type->delete();
        $notification = array(
            'message' => 'Point Category Deleted Successfully',
            'alert-type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }



    // Gift Controller Start
    public function GiftTypesIndex()
    {
        if (is_null($this->user) || !$this->user->can('reward.gift')) {
            $notification = array(
                'message' => 'Unauthorized access',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $gift = PointGift::all();
        return view('admin.gift.gifts_index', compact('gift'));
    }
    public function GiftTypeSave(Request $request)
    {
        $gift = new PointGift();
        $gift->name = $request->name;
        $gift->point = $request->point;
        $gift->save();
        $notification = array(
            'message' => 'Gift Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function GiftTypeDelete($id)
    {
        $gift = PointGift::find($id);
        $gift->delete();
        $notification = array(
            'message' => 'Gift Deleted Successfully',
            'alert-type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }
    public function GiftTypeEdit($id)
    {
        $gift = PointGift::findOrFail($id);
        return view('admin.gift.edit_gift', compact('gift'));
    }
    public function GiftTypeUpdate(Request $request, $id)
    {
        $gift = PointGift::findOrFail($id);
        $gift->name = $request->name;
        $gift->point = $request->point;
        $gift->update();
        $notification = array(
            'message' => 'Gift Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('gift.types')->with($notification);
    }

    public function OtherIndex()
    {
        if (is_null($this->user) || !$this->user->can('reward.others')) {
            $notification = array(
                'message' => 'Unauthorized access',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $employees = Employee::all();
        $points_category = PointCategory::all();
        return view('admin.reward.other_points', compact('employees', 'points_category'));
    }
    public function SelectCategory(Request $request)
    {
        $category = PointCategory::where('id', $request->point_category)->first();
        return response()->json($category);
    }
    public function RewardStore(Request $request)
    {
        $reward = new Reward();
        $reward->employee_id = $request->employee_id;
        $reward->point_category_id = $request->point_category;
        $reward->point = $request->point_amount;
        $reward->save();
        $notification = array(
            'message' => 'Points Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function AttendancePoint()
    {
        if (is_null($this->user) || !$this->user->can('reward.attendance_point')) {
            $notification = array(
                'message' => 'Unauthorized access',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $point = AttendanceResward::find(1);
        return view('admin.reward.attendance_point', compact('point'));
    }
    public function AttendancePointEdit(Request $request)
    {
        $point = AttendanceResward::find(1);
        $point->attendance_minimization = $request->attendance_minimization;
        $point->late_minimization = $request->late_minimization;
        $point->with_late_point = $request->point_with_late;
        $point->without_late_point = $request->point_without_late;
        $point->update();
        $notification = array(
            'message' => 'Attendance point successfuly updated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function AttendancePointEmployee()
    {

        $currentMonth = date('m');
        $currentYear = date('Y');
        $hasDataForCurrentMonth = Reward::whereMonth('created_at', '=', $currentMonth)
            ->whereYear('created_at', '=', $currentYear)
            ->get();
        $point = AttendanceResward::find(1);
        $currentDate = Carbon::now();

        // Get the first day of the current month
        $firstDayOfCurrentMonth = $currentDate->firstOfMonth();

        // Get the first day of the last month
        $firstDayOfLastMonth = $firstDayOfCurrentMonth->subMonth();

        // Get the month and year of the last month
        $lastMonth = $firstDayOfLastMonth->format('m');
        $currentYear = $firstDayOfLastMonth->format('Y');

        // Retrieve attendance for the last month in the current year
        $attendanceLastMonth = attendance::whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $currentYear)
            ->orderBy('created_at', 'asc')
            ->get();
        $working_day = $attendanceLastMonth->count() - $point->attendance_minimization;

        $employees =  attendance::whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $currentYear)
            ->select('employee_id', DB::raw('SUM(is_present) as total_attendance'), DB::raw('SUM(is_late) as total_late_days'))
            ->groupBy('employee_id')
            ->having('total_attendance', '>=', $working_day)
            ->having('total_late_days', '<=', $point->late_minimization)
            ->get();

        return view('admin.reward.attendance_point_employee', compact('employees', 'point', 'hasDataForCurrentMonth'));
    }
    public function AttendancePointWithoutlate()
    {
        if (is_null($this->user) || !$this->user->can('reward.attendee_employee')) {
            $notification = array(
                'message' => 'Unauthorized access',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $currentMonth = date('m');
        $currentYear = date('Y');
        $hasDataForCurrentMonth = Reward::whereMonth('created_at', '=', $currentMonth)
            ->whereYear('created_at', '=', $currentYear)
            ->get();
        $point = AttendanceResward::find(1);
        $currentDate = Carbon::now();

        // Get the first day of the current month
        $firstDayOfCurrentMonth = $currentDate->firstOfMonth();

        // Get the first day of the last month
        $firstDayOfLastMonth = $firstDayOfCurrentMonth->subMonth();

        // Get the month and year of the last month
        $lastMonth = $firstDayOfLastMonth->format('m');
        $currentYear = $firstDayOfLastMonth->format('Y');

        // Retrieve attendance for the last month in the current year
        $attendanceLastMonth = attendance::whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $currentYear)
            ->orderBy('created_at', 'asc')
            ->get();
        $working_day = $attendanceLastMonth->count();
        $type = "full";
        $employees =  attendance::whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $currentYear)
            ->select('employee_id', DB::raw('SUM(is_present) as total_attendance'), DB::raw('SUM(is_late) as total_late_days'))
            ->groupBy('employee_id')
            ->having('total_attendance', '>=', $working_day)
            ->having('total_late_days', '<=', 0)
            ->get();
        if ($employees->count() > 0) {
            return view('admin.reward.attendance_point_without_late', compact('employees', 'point', 'hasDataForCurrentMonth', 'type'));
        } else {
            $working_day = $attendanceLastMonth->count() - $point->attendance_minimization;
            $employees =  attendance::whereMonth('created_at', $lastMonth)
                ->whereYear('created_at', $currentYear)
                ->select('employee_id', DB::raw('SUM(is_present) as total_attendance'), DB::raw('SUM(is_late) as total_late_days'))
                ->groupBy('employee_id')
                ->having('total_attendance', '>=', $working_day)
                ->having('total_late_days', '<=', $point->late_minimization)
                ->get();
            $type = "late";
            return view('admin.reward.attendance_point_employee', compact('employees', 'point', 'hasDataForCurrentMonth', 'type'));
        }
    }
    public function AttendancePointDistribute(Request $request, $id)
    {

        $reward = new Reward();
        $reward->employee_id = $id;
        $reward->point_category_id = 0;
        $reward->point = $request->point;
        $reward->save();
        $notification = array(
            'message' => 'Reward point successfuly added for this employee',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function RewardReports()
    {
        if (is_null($this->user) || !$this->user->can('reward.report')) {
            $notification = array(
                'message' => 'Unauthorized access',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $redeems = RedeemPoint::all();
        return view('admin.reward.reward_reports', compact('redeems'));
    }
    public function RewardPay($id)
    {
        $pay = RedeemPoint::findOrFail($id);
        $pay->status = 'paid';
        $pay->update();
        $notification = array(
            'message' => 'Reward gift status changed successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
