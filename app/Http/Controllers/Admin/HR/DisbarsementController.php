<?php

namespace App\Http\Controllers\Admin\HR;

use App\Http\Controllers\Controller;
use App\Models\Allowance;
use App\Models\ArrearDisversement;
use App\Models\Bonus;
use App\Models\Deduction;
use App\Models\Disbursement;
use App\Models\Employee;
use App\Models\EmployeeAllowance;
use App\Models\EmployeeBonus;
use App\Models\HrLoan;
use App\Models\leave;
use App\Models\OtDisversement;
use App\Models\ProcessPayroll;
use Illuminate\Http\Request;
use App\Models\User;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DisbarsementController extends Controller
{
   public $user;
   public function __construct()
   {
      $this->middleware(function ($request, $next) {
         $this->user = Auth::guard('web')->user();
         return $next($request);
      });
   }
   public function AdvanceCreate()
   {
      if (is_null($this->user) || !$this->user->can('Advance.create')) {
         abort('403', 'Unauthorized access');
      }
      $employee = Employee::all();
      $disbursement = Disbursement::all();
      return view('HR.disbursements.create_advance', compact('employee', 'disbursement'));
   }

   public function AdvanceStore(Request $request)
   {
      $disbursement =  new Disbursement();
      $disbursement->employee_id = $request->employee_id;
      $disbursement->amount = $request->amount;
      $disbursement->reason = $request->reason;
      $disbursement->save();
      $notification = array(
         'message' => 'Advance disbursement Added Successfully',
         'alert-type' => 'success'
      );
      return redirect()->back()->with($notification);
   }
   public function OTCreate()
   {
      if (is_null($this->user) || !$this->user->can('Over_Time.create')) {
         abort('403', 'Unauthorized access');
      }
      $employee = Employee::all();
      $disbursement = OtDisversement::all();
      return view('HR.disbursements.create_ot', compact('employee', 'disbursement'));
   }
   public function OTStore(Request $request)
   {
      $disbursement =  new OtDisversement();
      $disbursement->employee_id = $request->employee_id;
      $disbursement->hrs = $request->hours;
      $disbursement->rate = $request->rate;
      $disbursement->total = round(($request->hours) * ($request->rate));
      $disbursement->save();
      $notification = array(
         'message' => 'Overtime disbursement Added Successfully',
         'alert-type' => 'success'
      );
      return redirect()->back()->with($notification);
   }

   public function viewEditOT($id)
    {
        
      $disbursement = OtDisversement::find($id);
        return response()->json([
         "info"=>$disbursement,
         "name"=>$disbursement->Employee->name
        ]);
    }

   public function OTUpdate(Request $request)
   {
      
     
      $disbursement = OtDisversement::where('id', $request->id)->first();
      $disbursement->employee_id = $request->employee_id;
      $disbursement->hrs = $request->hours;
      $disbursement->rate = $request->rate;
      $disbursement->total = round(($request->hours) * ($request->rate));
      $disbursement->update();

      $notification = array(
         'message' => 'OT Updated Successfully',
         'alert-type' => 'success'
      );
      return redirect()->back()->with($notification);
   }

   public function otDelete($id)
   {
      $disbursement = OtDisversement::find($id);
      $disbursement->delete();
      $notification = array(
         'message' => 'OT Deleted Successfully',
         'alert-type' => 'warning'
      );
      return redirect()->back()->with($notification);
   }
   public function ArrearCreate()
   {
      $employee = Employee::all();
      $allowance = Allowance::all();
      $employee_allowance = EmployeeAllowance::all();
      return view('HR.disbursements.create_arrear', compact('employee', 'allowance','employee_allowance'));
   }
   public function ArrearStore(Request $request)
   {
      $disbursement =  new ArrearDisversement();
      $disbursement->employee_id = $request->employee_id;
      $disbursement->amount = $request->amount;
      $disbursement->reason = $request->reason;
      $disbursement->save();
      $notification = array(
         'message' => 'Arrear disbursement Added Successfully',
         'alert-type' => 'success'
      );
      return redirect()->back()->with($notification);
   }
   public function IncomeTaxCreate()
   {
      return view('HR.disbursements.create_income_tax');
   }
   public function PayrollProcess()
   {
      if (is_null($this->user) || !$this->user->can('Process_payroll')) {
         abort('403', 'Unauthorized access');
      }
      $employee = Employee::all();
      return view('HR.disbursements.process_payroll', compact('employee'));
   }
   public function PayrollMove(Request $request)
   {

      $selectedUserIds = $request->input('selected_users');

      if ($selectedUserIds) {

         foreach ($selectedUserIds as $employeeId) {
            // Save the selected salary for the employee
            //  $salary = $request->input('salary')[$userId] ?? 0;

            // Save the selected allowance for the employee
            $salary = $request->input('salary')[$employeeId] ?? 0;

            $bonus = $request->input('bonus')[$employeeId] ?? 0;
            if ($bonus > 0) {
               $bonus_id = EmployeeBonus::where('employee_id', $employeeId)->where('status', "active")->get();
               foreach ($bonus_id as $b_id) {
                  $bs = EmployeeBonus::findOrFail($b_id->id);
                  $bs->status = 'moved';
                  $bs->update();
               }
            }

            $ot = $request->input('ot')[$employeeId] ?? 0;
            if ($ot > 0) {
               $ot_id = OtDisversement::where('employee_id', $employeeId)->where('status', "active")->get();
               foreach ($ot_id as $t_id) {
                  $bt = OtDisversement::findOrFail($t_id->id);
                  $bt->status = 'moved';
                  $bt->update();
               }
            }

            $advance = $request->input('advance')[$employeeId] ?? 0;
            if ($advance > 0) {
               $advance_id = Disbursement::where('employee_id', $employeeId)->where('status', "active")->get();
               foreach ($advance_id as $ad_id) {
                  $adv = Disbursement::findOrFail($ad_id->id);
                  $adv->status = 'moved';
                  $adv->update();
               }
            }

            $loan = $request->input('loan')[$employeeId] ?? 0;
            if ($loan > 0) {
               $loan_id = HrLoan::where('employee_id', $employeeId)->where('due', '>', 0)->get();
               foreach ($loan_id as $ln_id) {
                  $ln = HrLoan::findOrFail($ln_id->id);
                  $ln->due = ($ln->due) - ($ln->per_month);
                  $ln->update();
               }
            }

            $deduction = $request->input('deduction')[$employeeId] ?? 0;
            if ($deduction > 0) {
               $leave_id = leave::where('employee_id', $employeeId)->where('status', "Approved")->get();
               foreach ($leave_id as $lv_id) {
                  $lv = Deduction::where('leave_id', $lv_id->id)->first();
                  if ($lv) {
                     $lv->status = 'moved';
                     $lv->update();
                  } else {
                     return response('No Deduction Available!');
                  }
               }
               $attendance_id = Deduction::where('type',"absence")->where('employee_id',$employeeId)->where('status',"Approved")->get();
               foreach ($attendance_id as $at_id) {
                  $at = Deduction::findOrFail($at_id->id);
                  if ($at) {
                     $at->status = 'moved';
                     $at->update();
                  } else {
                     return response('No Attendance Deduction Available!');
                  }
               }
               
            }


            $total = $request->input('total')[$employeeId] ?? 0;

            // Create a new Employee record and save it to the database
            ProcessPayroll::create([
               'employee_id' => $employeeId,
               'salary' => $salary,
               'bonus' => $bonus,
               'overtime' => $ot,
               'advance' => $advance,
               'loan' => $loan,
               'diduction' => $deduction,
               'total' => $total,

            ]);
         }

         $notification = array(
            'message' => 'Successfully Processed, Move to Payment Disbursement',
            'alert-type' => 'success'
         );
         return redirect()->back()->with($notification);
      } else {

         $notification = array(
            'message' => "You Don't select any Employee",
            'alert-type' => 'error'
         );
         return redirect()->back()->with($notification);
      }
   }
   public function addAllowances()
   {
      $allowances = Allowance::all();
      return view('HR.disbursements.add_allownaces_type', compact('allowances'));
   }
   public function AllowancesSubmit(Request $request)
   {
      $request->validate(
         [
            'name' => 'required',
            'amount' => 'required',
            'details' => 'required',
         ],
         [
            'name' => 'Please Give Bonus Name',
            'amount' => 'Amount Required',
            'details' => 'Please Give Bonus Details',
         ]
      );
      $allowance = new Allowance();
      $allowance->name = $request->name;
      $allowance->amount = $request->amount;
      $allowance->details = $request->details;
      $allowance->save();

      $notification = array(
         'message' => 'Allowance Added Successfully',
         'alert-type' => 'success'
      );
      return redirect()->back()->with($notification);
   }
   

   public function allowanceDelete($id)
   {
      $allowances = Allowance::find($id);
      $allowances->delete();
      $notification = array(
         'message' => 'Allowance Deleted Successfully',
         'alert-type' => 'warning'
      );
      return redirect()->back()->with($notification);
   }
  
   public function searchAllowances(Request $request)
   {
      $allowance = Allowance::where('id', $request->bonus_type)->first();
      return response()->json([
         'amount' => $allowance ? $allowance->amount : '',
         'details' => $allowance ? $allowance->details : '',
      ]);
   }
   public function employeeAllowances(Request $request)
   {
      $allowance = new EmployeeAllowance();
      $allowance->employee_id = $request->employee_id;
      $allowance->allowance_id = $request->allowance;
      $allowance->save();
      $notification = array(
         'message' => 'Allowance Added Successfully',
         'alert-type' => 'success'
      );
      return redirect()->back()->with($notification);
   }
}
