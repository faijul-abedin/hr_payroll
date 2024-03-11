<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Http\Controllers\Controller;
use App\Models\ProcessPayroll;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
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
        if (is_null($this->user) || !$this->user->can('payment_disbursement')) {
            abort('403', 'Unauthorized access');
         }
        $employees = ProcessPayroll::orderByDesc('id')->get();
        return view('HR.disbursements.payment_index',compact('employees'));
    }
    public function ViewSalary(Request $req)
    {
        $employee = ProcessPayroll::with('Employee')->where('id', $req->id)->first();
        $createdAt = $employee->created_at;
        $monthName = Carbon::parse($createdAt)->format('F');

        return response()->json([
            'id' => $employee->id,
            'emp_id' => $employee->Employee->employee_id,
            'name' => $employee->Employee->name,
            'salary' => $employee->total,
            'date' => $monthName,
        ]);
    }

    public function Complete(Request $request)
    {
        $index = ProcessPayroll::findOrFail($request->payroll_id);
        $index->status = 'paid';
        $index->update();
        $notification = array(
            'message' => "Payment completed",
            'alert-type' => 'success'
         );
         return redirect()->back()->with($notification);
    }

    public function PrintSalary($id)
    {
        $salary = ProcessPayroll::findOrFail($id);
        
        return view('admin.employee.print_salary',compact('salary'));
         
    }
}
