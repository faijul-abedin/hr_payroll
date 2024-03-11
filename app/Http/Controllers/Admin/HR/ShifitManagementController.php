<?php

namespace App\Http\Controllers\Admin\HR;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Http\Request;
use App\Models\User;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class ShifitManagementController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('Shift.create')) {
            abort('403', 'Unauthorized access');
        }
        $shifts = Shift::all();
        return view('HR.shiftmanagement.create', compact('shifts'));
    }
    public function EditPage($id)
    {
        if (is_null($this->user) || !$this->user->can('Shift.edit')) {
            abort('403', 'Unauthorized access');
        }
        $shift = Shift::find($id);
        return view('HR.shiftmanagement.edit_shift', compact('shift'));
    }
    public function ShiftSave(Request $request)
    {
        $shift = new Shift();
        $shift->name = $request->name;
        $shift->starting = $request->start_time;
        $shift->ending = $request->end_time;
        $shift->save();
        $notification = array(
            'message' => 'Shift Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
    public function ShiftSaveUp(Request $request, $id)
    {
        $shift = Shift::find($id);
        $shift->name = $request->name;
        $shift->starting = $request->start_time;
        $shift->ending = $request->end_time;
        $shift->update();
        $notification = array(
            'message' => 'Shift Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function Delete($id)
    {
        if (is_null($this->user) || !$this->user->can('Shift.delete')) {
            abort('403', 'Unauthorized access');
        }
        $shift = Shift::find($id);
        $shift->delete();
        $notification = array(
            'message' => 'Shift Deleted Successfully',
            'alert-type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }
}
