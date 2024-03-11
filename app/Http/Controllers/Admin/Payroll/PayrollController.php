<?php

namespace App\Http\Controllers\Admin\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function create()
    {
        return view('admin.payroll.create_salary');
    }
    public function adjust()
    {
        return view('admin.payroll.adjust_salary');
    }
    public function adjustPartial(Request $request)
    {
        $annnual_ctc = $request->annual_ctc;
        $basic_salary = $request->basic_salary;
        $yearly_salary = $basic_salary * 12;
        $per_year_allowances = $annnual_ctc - $yearly_salary;
        $per_month_allowances = $per_year_allowances/12;
        return view('admin.payroll.adjust_partial_salary',compact('basic_salary','yearly_salary','per_year_allowances','per_month_allowances'));
    }
}
