<?php

namespace App\Http\Controllers\Admin\Roles;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
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
        if (is_null($this->user) || !$this->user->can('roles.create')) {
            abort('403', 'Unauthorized access');
        }
        $permissions = Permission::all();
        $permissionsGroup = User::getPermissionGroups();
        return view('admin.roles.create', compact('permissions', 'permissionsGroup'));
    }



    public function index()
    {
        if (is_null($this->user) || !$this->user->can('roles.view')) {
            abort('403', 'Unauthorized access');
        }
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required | max:100 | unique:roles'
            ],
            [
                'name.required' => 'Please give a role name'
            ]
        );
        $role = Role::create(['name' => $request->name]);
        $permission = $request->permissions;
        if (!empty($permission)) {
            $role->syncPermissions($permission);
        }
        $notification = array(
            'message' => 'Role Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function edit($id)
    {

        if (is_null($this->user) || !$this->user->can('roles.edit')) {
            $notification = array(
                'message' => 'Permission denied',
                'alert-type' => 'error'
            );
        }
        $roles = Role::findById($id);
        $permissions = Permission::all();
        $permissionsGroup = User::getPermissionGroups();
        return view('admin.roles.edit', compact('permissions', 'permissionsGroup', 'roles'));
    }
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required | max:100 | unique:roles,name,' . $id
            ],
            [
                'name.required' => 'Please give a role name'
            ]
        );
        $roles = Role::findById($id);
        $permission = $request->permissions;
        if (!empty($permission)) {
            $roles->name = $request->name;
            $roles->save();
            $roles->syncPermissions($permission);
        }
        $notification = array(
            'message' => 'Role has been updated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function rolesDelete($id)
    {
     
        $roles = Role::find($id);
        $roles->delete();
        $notificcation = array(
            'message' => 'This Role is Deleted Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notificcation);


    }
}
