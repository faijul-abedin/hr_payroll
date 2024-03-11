<?php

namespace App\Http\Controllers\Admin\HRLoan;

use App\Http\Controllers\Controller;
use App\Models\employee;
use App\Models\HrLoan;
use App\Models\salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class HRLoanController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    protected function HRViewcreate()
    {
        
        if (is_null($this->user) || !$this->user->can('Hr-Loan.add')) {
            abort('403', 'Unauthorized access');
        }
        $employee = salary::all();
        return view('admin.hr loan.create', compact('employee'));
    }
    protected function LoanStore(Request $request)
    {
        $request->validate(
            [
                'employee_id'=>'required',
                'loan_amount'=>'required',
                'interest_rate'=>'required',
                'repayment_term'=>'required',
                'loan_year'=>'required',
            ],
            
            [
                'employee_id'=>'Please Select Employee Name',
                'loan_amount'=>'Please Give Loan Amount',
                'interest_rate'=>'Please Give Interest Rate',
                'repayment_term'=>'Please Give Repayment Term',
                'loan_year'=>'Please Give Loan Year',
            ]
        );
        $exist_loan = HrLoan::where('employee_id', $request->employee_id)->sum('due');
        if ($exist_loan > 0) {
            $notification = array(
                'message' => 'This user has  due loan',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        } else {
            $hr_loan = new HrLoan();
            $hr_loan->employee_id = $request->employee_id;
            $hr_loan->amount = $request->loan_amount;
            $hr_loan->interest_rate = $request->interest_rate;
            $hr_loan->payment_term = $request->repayment_term;
            $total_amount = (($request->loan_amount * $request->interest_rate) / 100) + $request->loan_amount;
            $hr_loan->total_amount_with_loan = round($total_amount);
            $payment_rate = $total_amount / $request->loan_year;
            $hr_loan->loan_year = $request->loan_year;
            $hr_loan->per_month = round($payment_rate);
            $hr_loan->due = round($total_amount);
            $hr_loan->save();
            $notification = array(
                'message' => 'Loan Added Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    protected function hrIndexView()
    {
        if (is_null($this->user) || !$this->user->can('Hr-Loan.index')) {
            abort('403', 'Unauthorized access');
        }
        $loans = HrLoan::all();
        return view('admin.hr loan.index', compact('loans'));
    }

    protected function loanUpdateView($id)
    {
        if (is_null($this->user) || !$this->user->can('Hr-Loan.edit')) {
            abort('403', 'Unauthorized access');
        }
        $loans = HrLoan::find($id);
        return view('admin.hr loan.edit_loan', compact('loans'));
    }

    protected function loanUpdate(Request $request, $id)
    {
        $request->validate(
            [
                'employee_id'=>'required',
                'loan_amount'=>'required',
                'interest_rate'=>'required',
                'repayment_term'=>'required',
                'loan_year'=>'required',
            ],
            
            [
                'employee_id'=>'Employee Name Required',
                'loan_amount'=>'Loan Amount Required',
                'interest_rate'=>'Interest Rate Required',
                'repayment_term'=>'Repayment Term Required',
                'loan_year'=>'Loan Year Required',
            ]
        );

        $hr_loan = HrLoan::find($id);
        $hr_loan->employee_id = $request->employee_id;
        $hr_loan->amount = $request->loan_amount;
        $hr_loan->interest_rate = $request->interest_rate;
        $hr_loan->payment_term = $request->repayment_term;
        $total_amount = (($request->loan_amount * $request->interest_rate) / 100) + $request->loan_amount;
        $hr_loan->total_amount_with_loan = round($total_amount);
        $payment_rate = $total_amount / $request->loan_year;
        $hr_loan->loan_year = $request->loan_year;
        $hr_loan->per_month = round($payment_rate);
        $hr_loan->due = round($total_amount);
        $hr_loan->update();
        $notification = array(
            'message' => 'Loan Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function loanDelete($id)
    {
        $hr_loan = HrLoan::find($id);
        $hr_loan->delete();
        $notification = array(
            'message' => 'Loan Deleted Successfully',
            'alert-type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }
}
