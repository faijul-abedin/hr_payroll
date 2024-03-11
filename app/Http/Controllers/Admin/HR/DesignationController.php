<?php

namespace App\Http\Controllers\Admin\HR;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\User;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class DesignationController extends Controller
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
        if (is_null($this->user) || !$this->user->can('Designation.create')) {
            abort('403', 'Unauthorized access');
        }
        $department = Department::all();
        $designation = Designation::all();
        return view('HR.designation.create',compact('department','designation'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'department' => 'required',
        ]);

        $designation = new Designation();
        $designation->name = $request->name;
        $designation->description = $request->description;
        $designation->department_id = $request->department;
        $designation->save();

        $notification = array(
            'message' => 'Designation Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('Designation.edit')) {
            abort('403', 'Unauthorized access');
        }
        $department = Department::all();
        $designation = Designation::where('id',$id)->first();
        return view('HR.designation.edit',compact('designation','department'));
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'department' => 'required',
        ]);

        $designation =  Designation::where('id',$id)->first();
        $designation->name = $request->name;
        $designation->description = $request->description;
        $designation->department_id = $request->department;
        $designation->save();

        return back()->with('success', 'Designation updated successfully.');
    }

    public function designationDelete($id)
    {

        $designation =  Designation::find($id);
        $designation->delete();

        $notification = array(
            'message' => 'Designation Deleted Successfully',
            'alert-type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }
}
