<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    public function userList()
    {
        if (is_null($this->user) || !$this->user->can('user.view')) {
            abort('403', 'Unauthorized access');
        }
        $user = User::all();
        return view('admin.user.userlist', compact('user'));
    }

    public function addUserView()
    {
        if (is_null($this->user) || !$this->user->can('user.create')) {
            abort('403', 'Unauthorized access');
        }
        $roles = Role::all();
        return view('admin.user.adduser', compact('roles'));
    }
    public function store(Request $request)
    {
        // Validation Data
        $request->validate(
            [
                'name' => 'required|max:50',
                'business_name' => 'required|max:50',
                'email' => 'required|max:100|email|unique:users',
                'contact_number' => 'required',
                'second_contact_number' => 'nullable',
                'address' => 'required',
                'password' => 'required|confirmed',
                'image' => 'required',
                'roles' => 'required|array',
            ],
            [
                'name' => 'First Name Required',
                'business_name' => 'Last Name Required',
                'email' => 'Email Address Required',
                'email.unique' => "Email address is already used",
                'contact_number.required' => 'The contact number field is required.',
                'address.required' => 'The address field is required.',
                'password.required' => 'The password field is required.',
                'password.confirmed' => 'The password confirmation does not match.',
                'image.required' => 'An image is required.',
                // 'image.image' => 'The file must be an image.',
                'roles.required' => 'At least one role must be selected.',
                'roles.array' => 'The roles must be an array.',
            ]
        );

        // Create New User
        $user = new User();
        $user->name = $request->name;
        $user->business_name = $request->business_name;
        $user->email = $request->email;
        $user->contact_number = $request->contact_number;
        $user->second_contact_number = $request->second_contact_number;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $imageName = '';
        if ($image = $request->file('image')) {
            $imageName = time() . '' . uniqid() . '' . $image->getClientOriginalExtension();
            $image->move('UserImage/profile', $imageName);
        }
        $user->image = $imageName;
        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }
        $notification = array(
            'message' => 'User added successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function login()
    {
        return view('admin.components.login');
    }
    function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }
    function loginsubmit(Request $request)
    {
        // Validate Login Data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to login
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect to dashboard
            session()->flash('success', 'Successully Logged in !');
            return redirect(route('home'));
        } else {
            $notification = array(
                'message' => 'Incorrect email or password',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
    function useredit(Request $req)
    {
        $users=User::where('id',$req->id)->first();
        $roles=Role::all();
        return view('admin.user.edituser')->with('user',$users)->with('role',$roles);
    }
    function usereditsubmit(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:50',
                'business_name' => 'required|max:50',
                'email' => 'required|max:100|email',
                'contact_number' => 'required',
                'second_contact_number' => 'nullable',
                'address' => 'required',
                'roles' => 'required|array',
            ],
            [
                'name' => 'First Name Required',
                'business_name' => 'Last Name Required',
                'email' => 'Email Address Required',
                'contact_number.required' => 'The contact number field is required.',
                'address.required' => 'The address field is required.',
                'password.required' => 'The password field is required.',
                'password.confirmed' => 'The password confirmation does not match.',
                'image.required' => 'An image is required.',
                // 'image.image' => 'The file must be an image.',
                'roles.required' => 'At least one role must be selected.',
                'roles.array' => 'The roles must be an array.',
            ]
        );
        $user =  User::where('id',$request->user_id)->first();
        $user->name = $request->name;
        $user->business_name = $request->business_name;
        $user->email = $request->email;
        $user->contact_number = $request->contact_number;
        $user->second_contact_number = $request->second_contact_number;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $imageName = '';
        if ($image = $request->file('image')) {
            $imageName = time() . '' . uniqid() . '' . $image->getClientOriginalExtension();
            $image->move('UserImage/profile', $imageName);
        }
        $user->image = $imageName;
        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }
        $notification = array(
            'message' => 'User added successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function userDelete($id)
    {
        $user =  User::find($id);
        $user->delete();
        $notification = array(
            'message' => 'User Deleted From System',
            'alert-type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }
}