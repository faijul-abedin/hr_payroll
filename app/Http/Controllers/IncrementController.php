<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Increment;
use App\Models\salary;
class IncrementController extends Controller
{
    
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    public function increment(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('Hr-Increment.add')) {
            abort('403', 'Unauthorized access');
        }
        $employee = Employee::all();
        $salary = Salary::all();
        $increment = Increment::all();

        foreach ($increment as $item) {
            $item->previousSalary = $item->employeeIncrement->Salary->rate / (1 + ($item->increment_rate / 100));
        }

        return view('admin.increment.increment', compact('employee', 'salary', 'increment'));
    }


    protected function SelectSalary(Request $request)
    {
        $salary = salary::where('employee_id', $request->employee_id)->pluck('rate', 'id');
        return response()->json($salary);
    }

    public function incrementSub(Request $request)
    {
        $request->validate(
            [
               'employee_id'=>'required',
               'increment_rate'=>'required',
            ],

            [
                'employee_id'=>'Please Select Employee Name',
                'increment_rate'=>'Please Give Increment Percentage',
                'increment_rate.number'=>'Please Give only Digit',
            ]

        );
        $increment = new Increment();
        $increment->employee_id = $request->input('employee_id');
        $increment->increment_rate = $request->input('increment_rate');
        
        $selectedSalaryId = $request->input('salaryrate');
        $selectedSalary = Salary::find($selectedSalaryId);
        
        $incrementPercentage = $request->input('increment_rate');
        $newSalaryRate = $selectedSalary->rate * (1 + $incrementPercentage / 100);
        
        $selectedSalary->rate=$newSalaryRate;
        $selectedSalary->update();
        
        $increment->save();
        $notification = array(
            'message' => 'Incremnet Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        
    }



    function incrementEdit($id)
    {
        if (is_null($this->user) || !$this->user->can('Increment.edit')) {
            abort('403', 'Unauthorized access');
        }
    
        $increments = Increment::find($id);
        $previousSalary= $increments->employeeIncrement->Salary->rate / (1 + ($increments->increment_rate / 100));

        return view('admin.increment.incrementedit', compact('increments', 'previousSalary'));
    }

    

    public function incrementUpdate(Request $request, $id)
    {
        $request->validate(
            [
                'increment_rate'=>'required',
            ],

            [
                'increment_rate'=>'Increment Percentage Cannot be Empty',
                'increment_rate.number'=>'Please Give only Digit'
            ]
        );
        
        $increment = Increment::find($id);
        
        $increment->increment_rate = $request->input('increment_rate');
        $selectedSalary = salary::where('employee_id',$request->employee_in)->first();

        if ($selectedSalary) {
            $incrementPercentage = $request->input('increment_rate');
            $newSalaryRate = $selectedSalary->rate * (1 + $incrementPercentage / 100);
            $selectedSalary->rate = $newSalaryRate;
            $selectedSalary->update();
        } else {
            $notification = array(
                'message' => 'Error: Salary not found.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $increment->save();

        $notification = array(
            'message' => 'Increment Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    // public function autoIncrement()
    // {
    //     $currentDate = Carbon::now();
    //     $employees = salary::all();

    //     foreach ($employees as $salary) {
    //         $joinDate = Carbon::parse($salary->Employee->starting);
    //         $monthsSinceJoining = $currentDate->diffInMonths($joinDate);

    //         if ($monthsSinceJoining % 12 === 0) {
    //             $increment = new Increment();
    //             $increment->employee_id = $salary->employee_id;
    //             $increment->increment_rate = 5;
        
    //             $newSalaryRate = $salary->rate * (1 + 5 / 100);
    //             $salary->rate = $newSalaryRate;
    //             $salary->save();
                
    //             $increment->save();
    //         }
    //     }
    //     // dd($monthsSinceJoining);

    //     $notification = array(
    //         'message' => 'Incremnet Added Successfully',
    //         'alert-type' => 'success'
    //     );
    //     return redirect()->back()->with($notification);
        
    // }



}