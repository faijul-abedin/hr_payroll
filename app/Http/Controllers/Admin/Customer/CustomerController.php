<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
class CustomerController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    public function Index()
    {
        if (is_null($this->user) || !$this->user->can('CRM.Customer_index')) {
            abort('403', 'Unauthorized access');
        }
        $customers = User::all();
        return view('admin.customers.customer_index',compact('customers'));
    }
    public function SelectCustomer()
    {
        if (is_null($this->user) || !$this->user->can('CRM.Send_mail')) {
            abort('403', 'Unauthorized access');
        }
        $customers = User::all();
        return view('admin.customers.send_mail',compact('customers'));
    }
    // public function SendEmail()
    // {
    //     $users = User::take(2)->get();

    //     foreach ($users as $user) {
    //         Mail::to($user->email)->send(new SendMail);
    //         sleep(1);
    //     }
    //     return 'Emails Sent Successfully';
    // }
    public function SendEmail(Request $request)
{
    
    $selectedUserIds = $request->input('selected_users');

    $users = User::whereIn('id', $selectedUserIds)->get();

    foreach ($users as $user) {
        Mail::to($user->email)->send(new SendMail);
    }

    return 'Emails Sent Successfully to selected users';
}
}
