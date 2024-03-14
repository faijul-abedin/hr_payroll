<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Home\HomeController;

use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\IncrementController;
use App\Http\Controllers\LatemanagementController;


use App\Http\Controllers\Admin\Leave\LeaveController;
use App\Http\Controllers\Admin\Salary\SalaryController;

use App\Http\Controllers\Admin\HR\DepartmentController;
use App\Http\Controllers\Admin\HR\DesignationController;
use App\Http\Controllers\Admin\HR\DisbarsementController;
use App\Http\Controllers\Admin\HR\ShifitManagementController;

use App\Http\Controllers\HolidayController;
use App\Http\Controllers\Admin\Roles\RolesController;

use App\Http\Controllers\Admin\Employee\EmployeeController;
use App\Http\Controllers\Admin\HRLoan\HRLoanController;
use App\Http\Controllers\Admin\Bonus\BonusController;

use App\Http\Controllers\Admin\Customer\CustomerController;
use App\Http\Controllers\Admin\Employee\EmployeeProfileController;
use App\Http\Controllers\Admin\Fingerprint\FingerprintController;
use App\Http\Controllers\Admin\Notice\NoticeController;
use App\Http\Controllers\Admin\Payment\PaymentController;
use App\Http\Controllers\Admin\Reward\RewardController;
use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Console
Route::get('/ais', function () {
    Artisan::call('app:increment-salaries');
});

//Dashboard

Route::get('/attendance/add',[AttendanceController::class,'addattendance'])->name('add.attendance');
Route::post('/attendance/store',[AttendanceController::class,'store'])->name('attendance.store');
Route::get('/attendance/index',[AttendanceController::class,'attendanceindex'])->name('index.attendance');
Route::get('/latemanage/add',[LatemanagementController::class,'latemanage'])->name('latemanage.add');
Route::get('/latemanage/deduction',[LatemanagementController::class,'deduction'])->name('latemanage.deduction');
Route::get('/attendance/all',[AttendanceController::class,'showAllAttendance'])->name('attendance.all');
Route::get('/fetch_employee_counts', [LatemanagementController::class, 'fetchEmployeeCounts']);

//Increment
Route::controller(IncrementController::class)->group(function () {
    Route::get('/increment/add','increment')->name('increment.add');
    Route::get('/increment/disbursement','disbursement')->name('disbursement.add');
    Route::get('/increment/eligible','eligible')->name('eligible.add');
    Route::post('/increment/submit','incrementSub')->name('increment.submit');
    Route::get('/select/salary', 'SelectSalary')->name('select.salary');
    Route::get('/increment/edit/{id}','incrementEdit')->name('increment.edit');
    Route::post('/increment/update/{id}','incrementUpdate')->name('increment.update');
    // Route::get('/auto-increment-hrp', 'autoIncrement');
});

// Payment Related Routes
Route::controller(PaymentController::class)->group(function () {
    Route::get('/payment/disbursement','Index')->name('payment.disbursement');
    Route::get('/salary/view/{id}', 'ViewSalary')->name('salary.view'); 
    Route::post('/complete/payment', 'Complete')->name('pay.complete');
    Route::get('/print/salary/{id}','PrintSalary')->name('salary.print'); 

});
Route::controller(EmployeeProfileController::class)->group(function () {
    Route::get('/employee/dashboard/{id}','Dashboard')->name('employee.dashboard');
    Route::get('/employee/profile/{id}','Profile')->name('employee.profile');
    Route::get('/employee/holiday/{id}','Holidays')->name('employee.holiday');
    Route::get('/employee/profile/attendance/{id}','Attendance')->name('employee.profile.attendance');
    Route::get('/employee/profile/loans/{id}','Loans')->name('employee.profile.loan');
    Route::get('/employee/application/{id}','ApplicationPage')->name('employee.application');
    Route::post('/employee/application/save/{id}','ApplicationSave')->name('employee.application.save');
    
    Route::get('/employee/application/list/{id}','ApplicationList')->name('employee.application.list');
    Route::get('/employee/login','LoginPage')->name('employee.login');
    Route::get('/employee/logout','Logout')->name('employee.logout');
    Route::post('/employee/login/sub','LoginSubmit')->name('employee.login.sub');
    Route::get('/employee/salarylist/{id}','SalaryList')->name('employee.salary'); 
    Route::get('/print/employee/{id}','PrintEmployee')->name('employee.print'); 
    Route::get('/employee/profile/reward/{id}','EmployeeReward')->name('employee.profile.reward'); 
    Route::get('/select/gift/category','SelectGift')->name('select.gift_category'); 
    Route::post('/employee/redeem/save/{id}','RedeemPointSave')->name('employee.redeempoint');
});


//home
Route::get('/home',[HomeController::class,'homeView'])->name('home');
Route::get('/attendance/count',[HomeController::class,'attendanceCount'])->name('attendance.count');
Route::get('/leave/count',[HomeController::class,'leaveCount'])->name('leave.count');
Route::get('/loan/count',[HomeController::class,'loanCount'])->name('loan.count');

//Attendence
Route::get('/attendance/add', [AttendanceController::class, 'addattendance'])->name('add.attendance');
Route::get('/attendance/index', [AttendanceController::class, 'attendanceindex'])->name('index.attendance');
Route::get('/latemanage/add', [LatemanagementController::class, 'latemanage'])->name('latemanage.add');
Route::get('/latemanage/deduction', [LatemanagementController::class, 'deduction'])->name('latemanage.deduction');
Route::get('/increment/add', [IncrementController::class, 'increment'])->name('increment.add');
Route::post('/update-status', [AttendanceController::class, 'updateStatus'])->name('update.status');

Route::get('/', [HomeController::class, 'homeView'])->name('home');

//Users
Route::get('/user/userlist', [UserController::class, 'userList'])->name('user.index');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/user/add', [UserController::class, 'adduserView'])->name('user.addview');
Route::get('/user/edit/{id}', [UserController::class, 'useredit'])->name('user.edit');
Route::post('/user/editsub', [UserController::class, 'usereditsubmit'])->name('user.editsub');
Route::get('/user/delete/{id}',[UserController::class,'userDelete'])->name('user.delete');

//login
Route::get('/', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'loginsubmit'])->name('login.submit');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
// Salary Setup route

Route::controller(SalaryController::class)->group(function () {
    Route::get('/salary/index', 'Index')->name('salary.index');
    Route::get('/salary/addpage', 'AddPage')->name('salary.addpage');
    Route::get('/salary/payscal/{id}', 'AddPayscal')->name('salary.payscal');
    Route::get('/salary/delete/{id}', 'DeletePayscal')->name('delete.payscal');
    Route::post('/employee/payscal/save/{id}', 'SavePayscal')->name('employee.payscal.save');
    Route::get('/salary/designation/select', 'SelectDesignation')->name('select.designation.payscal');
    Route::get('/salary/employee/select', 'SelectEmployee')->name('select.employee.payscal');
    Route::get('/salary/advance/index','EmployeeAdvance')->name('salary.advance.index');
    Route::get('/salary/advance/{id}', 'AdvanceSalary')->name('advance.salary');
    Route::post('/salary/advance/save/{id}', 'AdvanceSalarySave')->name('advance.salary.save');
    Route::get('/salary/Editpayscal/{id}', 'editPayscal')->name('salary.editpayscal');
    Route::post('/salary/payscal/update/{id}', 'updatePayscal')->name('salary.payscal.update');
});



Route::get('/salary/index', [SalaryController::class, 'Index'])->name('salary.index');
Route::get('/salary/addpage', [SalaryController::class, 'AddPage'])->name('salary.addpage');

Route::get('/salary/payscal', [SalaryController::class, 'AddPayscal'])->name('salary.payscal');

// Leave Setup route
Route::get('/leave/index', [LeaveController::class, 'Index'])->name('leave.index');
Route::get('/leave/addpage', [LeaveController::class, 'AddPage'])->name('leave.addpage');
Route::get('/leave/payscal/{id}', [LeaveController::class, 'AddLeave'])->name('leave.payscal');
Route::get('/leave/application/{id}', [LeaveController::class, 'application'])->name('leave.application');
Route::post('/leave/store/{id}', [LeaveController::class, 'store'])->name('leave.store');
Route::post('/leave/update/{id}', [LeaveController::class, 'status_update'])->name('leave.update');
Route::get('/leave/delete/{id}',[LeaveController::class,'deleteLeave'])->name('delete.leave');
Route::post('/absence/deduction', [LeaveController::class, 'absenceDeduction'])->name('absence.deduction');

//holiday
Route::get('/holiday/create', [HolidayController::class, 'create'])->name('holiday.create');
Route::post('/holiday/store', [HolidayController::class, 'store'])->name('holiday.store');
Route::get('/holiday/index', [HolidayController::class, 'index'])->name('holiday.index');
Route::get('/holiday/edit/{id}', [HolidayController::class, 'edit'])->name('holiday.edit');
Route::post('/holiday/update', [HolidayController::class, 'update'])->name('holiday.update');
Route::get('/holiday/delete/{id}', [HolidayController::class, 'delete'])->name('holiday.delete');
//department
Route::get('/department/create', [DepartmentController::class, 'create'])->name('department.create');
Route::post('/department/store', [DepartmentController::class, 'store'])->name('department.store');
Route::get('/department/edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
Route::post('/department/update/{id}', [DepartmentController::class, 'update'])->name('department.update');
Route::get('department/delete/{id}',[DepartmentController::class,'destroyDepartment'])->name('department.delete');
//designation
Route::get('/designation/create', [DesignationController::class, 'create'])->name('designation.create');

Route::post('/designation/store', [DesignationController::class, 'store'])->name('designation.store');
Route::get('/designation/edit/{id}', [DesignationController::class, 'edit'])->name('designation.edit');
Route::post('/designation/update/{id}', [DesignationController::class, 'update'])->name('designation.update');
Route::get('/holiday/destroy/{id}',[HolidayController::class,'destroy'])->name('holiday.destroy');
Route::get('/designtation/delete/{id}',[DesignationController::class,'designationDelete'])->name('designation.delete');

//shiftmanagement
Route::controller(ShifitManagementController::class)->group(function () {
    Route::get('/shiftmanagement/create', 'create')->name('shiftmanagement.create');
    Route::get('/shiftmanagement/edit/{id}', 'EditPage')->name('shiftmanagement.editpage');
    Route::get('/shiftmanagement/delete/{id}', 'Delete')->name('shiftmanagement.delete');
    Route::post('/shiftmanagement/save', 'ShiftSave')->name('shiftmanagement.save');
    Route::post('/shiftmanagement/update/{id}', 'ShiftSaveUp')->name('shiftmanagement.update');
});

//disbarsement
Route::get('/disbursement/advance/create', [DisbarsementController::class, 'AdvanceCreate'])->name('disbarsement.advance.create');
Route::post('/disbursement/advance/store', [DisbarsementController::class, 'AdvanceStore'])->name('disbarsement.advance.store');
Route::get('/disbursement/ot/create', [DisbarsementController::class, 'OTCreate'])->name('disbarsement.ot.create');
Route::post('/disbursement/ot/store', [DisbarsementController::class, 'OTStore'])->name('disbarsement.ot.store');
Route::get('/employee/allowances', [DisbarsementController::class, 'ArrearCreate'])->name('disbarsement.arrear.create');
Route::post('/disbursement/arrear/store', [DisbarsementController::class, 'ArrearStore'])->name('disbarsement.arrear.store');
Route::get('/disbursement/incometax/create', [DisbarsementController::class, 'IncomeTaxCreate'])->name('disbarsement.incometax.create');
Route::get('/disbursment/payroll_process',[DisbarsementController::class,'PayrollProcess'])->name('disbursment.payroll_process');
Route::post('/disbursment/move',[DisbarsementController::class,'PayrollMove'])->name('disbursment.move');
Route::get('/disbursment/add/allowances',[DisbarsementController::class,'addAllowances'])->name('allowances.add');
Route::post('/disbursment/add/allowances',[DisbarsementController::class,'allowancesSubmit'])->name('allowances.submit');
Route::get('/disbursment/editView/OT/{id}',[DisbarsementController::class,'viewEditOT'])->name('ot.edit.view');
Route::get('/disbursment/delete/OT/{id}',[DisbarsementController::class,'otDelete'])->name('ot.delete');
Route::post('/disbursement/update/OT', [DisbarsementController::class, 'OTUpdate'])->name('ot.update');
Route::get('/allowances/search',[DisbarsementController::class,'searchAllowances'])->name('allowances.search');
Route::get('/allowances/delete/{id}',[DisbarsementController::class,'allowanceDelete'])->name('allowances.delete');
Route::post('/allowances/empoyee',[DisbarsementController::class,'employeeAllowances'])->name('allowances.employee');


//Roles
Route::get('/roles/create', [RolesController::class, 'create'])->name('roles.create');
Route::get('/role.index', [RolesController::class, 'index'])->name('role.dashboard');
Route::post('/role.create', [RolesController::class, 'store'])->name('role.store');
Route::get('/admin.roles.edit/{id}', [RolesController::class, 'edit'])->name('admin.roles.edit');
Route::post('/role.update/{id}', [RolesController::class, 'update'])->name('role.update');
Route::get('/role.delete/{id}', [RolesController::class, 'rolesDelete'])->name('role.delete');




//Employee
Route::controller(EmployeeController::class)->group(function () {
    Route::get('/employee/create', 'createView')->name('employee.create');
    Route::get('/employee.index', 'employeeIndex')->name('employee.index');
    Route::get('/select/designation', 'SelectDesignation')->name('select.designation');
    Route::post('/employee.save', 'SaveEmployee')->name('employee.save');
    Route::get('/employee.editview/{id}', 'employeeEditView')->name('employee.edit.view');
    Route::post('/employee.update/{id}', 'employeeUpdate')->name('employee.update');
    Route::get('/employee/delete/{id}','employeeDelete')->name('employee.delete');
});



//HR Loan Management
Route::get('/HRloan/create', [HRLoanController::class, 'HRViewcreate'])->name('HR.create');
Route::post('/HRloan/store', [HRLoanController::class, 'LoanStore'])->name('loan.store');
Route::get('/HRloan/index', [HRLoanController::class, 'hrIndexView'])->name('HR.index');
Route::get('/HRloan/update/view/{id}', [HRLoanController::class, 'loanUpdateView'])->name('HR.update.view');
Route::post('/HRloan/update/{id}', [HRLoanController::class, 'loanUpdate'])->name('loan.update');
Route::get('/HRloan/delete/{id}', [HRLoanController::class, 'loanDelete'])->name('loan.delete');

//BonusManagement
Route::get('/bonus/setting', [BonusController::class, 'bonusSettingView'])->name('Bonus.setting');
Route::get('/bonus/bonusattendence', [BonusController::class, 'attendenceBonusIndex'])->name('Bonus.attendence');
Route::get('/bonus/festivalbonus', [BonusController::class, 'festivalBonusIndex'])->name('Bonus.festival');
Route::get('/bonus/bonusout', [BonusController::class, 'bonusoutIndex'])->name('Bonus.out');
Route::get('/get-bonus-details', [BonusController::class, 'getBonusDetails'])->name('get.bonus.details');
Route::post('/employee_bonus_upload', [BonusController::class, 'employee_bonus_upload'])->name('employee_bonus_upload');
Route::get('/employee/bonus/editview/{id}', [BonusController::class, 'editViewbonus'])->name('employee_bonus_editview');

//Bonus
Route::controller(BonusController::class)->group(function () {
    Route::get('/bonus/types', 'BonusTypeIndex')->name('bonus.types');
    Route::post('/bonus/save', 'BonusTypeSave')->name('bonus.types.save');
    Route::get('/bonus/delete/{id}', 'BonusTypeDelete')->name('bonus.types.delete');
    Route::post('/bonus/update/{id}', 'bonusTypeUpdate')->name('bonus.types.update');
    Route::get('/employeebonus/delete/{id}', 'bonusoutDelete')->name('bonus.out.delete');
});

//Notice
Route::controller(NoticeController::class)->group(function () {
    Route::get('/notices', 'NoticeIndex')->name('notice.index');
    Route::post('/notice/save', 'NoticeSave')->name('notice.save');
    Route::get('/notice/updatepage/{id}', 'NoticeEdit')->name('notice.updatepage');
    Route::post('/notice/update/{id}', 'NoticeUpdate')->name('notice.update');
    Route::get('/notice/delete/{id}', 'NoticeDelete')->name('notice.delete');
});

//Reward
Route::controller(RewardController::class)->group(function () {
    Route::get('/reward/types', 'RewardTypesIndex')->name('reward.types');
    Route::get('/types/delete/{id}', 'RewardTypeDelete')->name('reward.types.delete');
    Route::get('/types/edit/view/{id}', 'RewardTypeEdit')->name('reward.types.edit');
    Route::get('/reward/reports', 'RewardReports')->name('reward.reports');
    Route::get('/reward/reports/pay/{id}', 'RewardPay')->name('reward.reports.pay');
    Route::post('/reward/types/save', 'RewardTypeSave')->name('reward.types.save');
    Route::post('/reward/types/update/{id}', 'RewardTypeUpdate')->name('reward.types.update');

    Route::get('/gift/types', 'GiftTypesIndex')->name('gift.types');
    Route::get('/gift/delete/{id}', 'GiftTypeDelete')->name('gift.types.delete');
    Route::get('/gift/edit/view/{id}', 'GiftTypeEdit')->name('gift.types.edit');
    Route::post('/gift/types/save', 'GiftTypeSave')->name('gift.types.save');
    Route::post('/gift/types/update/{id}', 'GiftTypeUpdate')->name('gift.types.update');

    Route::get('/reward/otherpoint/index','OtherIndex')->name('otherpoint.index');
    Route::get('/select/point_category','SelectCategory')->name('select.point_category');
    Route::post('/reward/point/store', 'RewardStore')->name('reward.point.store');
    Route::get('/reward/attendence/point','AttendancePoint')->name('attendance.point');
    Route::post('/reward/attendence/point/edit','AttendancePointEdit')->name('attendance.point.edit');
    Route::get('/reward/attendence/point/employee','AttendancePointEmployee')->name('attendance.point.employee');
    Route::get('/reward/attendence/without','AttendancePointWithoutlate')->name('attendance.point.without');
    Route::post('/reward/attendence/point/distribute/{id}','AttendancePointDistribute')->name('attendance.point.distribute');
});

//CRM Routes
Route::get('/customers/all',[CustomerController::class,'Index'])->name('all.customers');
Route::post('/customer/sendmail',[CustomerController::class,'SendEmail'])->name('customer.sendmail');
Route::get('/customer/select',[CustomerController::class,'SelectCustomer'])->name('customer.select');



//BonusManagement
Route::get('/bonus/setting',[BonusController::class,'bonusSettingView'])->name('Bonus.setting');
Route::get('/bonus/bonusattendence',[BonusController::class,'attendenceBonusIndex'])->name('Bonus.attendence');
Route::get('/bonus/festivalbonus',[BonusController::class,'festivalBonusIndex'])->name('Bonus.festival');
Route::get('/bonus/bonusout',[BonusController::class,'bonusoutIndex'])->name('Bonus.out');

//Group Rotes
Route::controller(GroupController::class)->group(function () {
    Route::get('/mg-machineries', 'mechineriesIndex')->name('mechineries');
    Route::get('/mg-school', 'schoolIndex')->name('schools');
    Route::get('/bd-electronic', 'electronicIndex')->name('electronics');
    Route::get('/tipson-electric', 'tipsonIndex')->name('tipsons');
});

Route::controller(FingerprintController::class)->group(function () {
    Route::get('/setup/index', 'setupIndex')->name('setup.index');
    Route::get('/zkteco/index', 'zktecoIndex')->name('zkteco.index');
    Route::get('/inout/index', 'inoutIndex')->name('inout.index');
    Route::post('/setup/update', 'setupUpdate')->name('setup.update');
    Route::get('/get/attendance', 'getAttendance')->name('get.attendance');
});