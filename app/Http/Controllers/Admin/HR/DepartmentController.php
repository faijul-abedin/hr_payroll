<?php

namespace App\Http\Controllers\Admin\HR;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\User;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class DepartmentController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    public function index()
    {
        // $departments = Department::all();
        //  return view('D');
    }

    public function create()
    {
        if (is_null($this->user) || !$this->user->can('Department.create')) {
            abort('403', 'Unauthorized access');
        }
        $departments = Department::all();
        return view('HR.department.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:departments',
        ]);

        $department = new Department();
        $department->name = $request->name;
        $department->save();

        $notification = array(
            'message' => 'Department Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('Department.edit')) {
            abort('403', 'Unauthorized access');
        }
        $departments = Department::where('id', $id)->first();
        return view('HR.department.update', compact('departments'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $department = Department::where('id', $id)->first();
        $department->name = $request->name;
        $department->save();

        $notification = array(
            'message' => 'Department Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function destroyDepartment($id)
    {
        if (is_null($this->user) || !$this->user->can('Department.delete')) {
            abort('403', 'Unauthorized access');
        }
        $department = Department::find($id);
        $department->delete();

        $notification = array(
            'message' => 'Department Deleted Successfully',
            'alert-type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }
}
