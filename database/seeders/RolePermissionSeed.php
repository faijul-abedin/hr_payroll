<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create roles

        $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        $roleAdmin = Role::create(['name' => 'admin']);

        //permission roles
        $permissions = [
            [
                'group_name' => 'superadmin',
                'permissions' => [
                    //superadmin permission
                    'superadmin.dashboard',
                ],
            ],
            [
                'group_name' => 'User',
                'permissions' => [
                    //admin permission
                    'user.create',
                    'user.view',
                    'user.edit',
                    'user.delete'
                ],
            ],
            [
                'group_name' => 'CRM',
                'permissions' => [

                    //CRM permission

                    'CRM.Customer_index',
                    'CRM.Send_mail',
                    'CRM.Leads',
                ],
            ],
            [

                'group_name' => 'Roles',
                'permissions' => [
                    //roles permission
                    'roles.create',
                    'roles.view',
                    'roles.edit',
                    'roles.delete'
                ],
            ],

            [
                'group_name' => 'HR-Setup',
                'permissions' => [
                    //HR-Setup
                    'Holiday.add',
                    'Holiday.edit',
                    'Holiday.delete',
                    'Holiday.Calander_view',
                    //Department group
                    'Department.create',
                    'Department.view',
                    'Department.edit',
                    'Department.delete',
                    //Designation group
                    'Designation.create',
                    'Designation.view',
                    'Designation.edit',
                    'Designation.delete',
                    //Shift group
                    'Shift.create',
                    'Shift.view',
                    'Shift.edit',
                    'Shift.delete',
                ],
            ],

            [
                'group_name' => 'Disbursement',
                'permissions' => [

                    //advance
                    'Advance.create',
                    'Advance.view',
                    'Advance.edit',
                    'Advance.delete',
                    //Over_Time
                    'Over_Time.create',
                    'Over_Time.view',
                    'Over_Time.edit',
                    'Over_Time.delete',
                    'Process_payroll',
                    'payment_disbursement',
                ],
            ],


            [
                'group_name' => 'Employee',
                'permissions' => [

                    //Employee permission
                    'Employee.view',
                    'Employee.create',
                    'Employee.edit',
                    'Employee.delete',

                ],
            ],
            [
                'group_name' => 'Salary-Setup',
                'permissions' => [

                    //Salary-Setup
                    'Salary.view',
                    'Salary.create',
                    'Salary.edit',
                    'Salary.delete',

                ],
            ],

            [
                'group_name' => 'Leaves',
                'permissions' => [


                    //Leaves-Setup
                    'Leaves.list',
                    'Leaves.add',
                    'Leaves.edit',
                    'Leaves.delete',
                ],
            ],
            [
                'group_name' => 'Attendances',
                'permissions' => [

                    'Attendance.monthly_report',
                    'Attendance.all_report',
                    'Attendance.add',
                    'Attendance.edit',
                    // 'Attendance.delete',
                ],
            ],
            [
                'group_name' => 'Late-Manage',
                'permissions' => [

                    'Late-Manage.add',
                    'Late-Manage.deduction_list',
                    // 'Late-Manage.deduction.edit',
                    // 'Late-Manage.deduction.delete',
                ],

            ],
            [
                'group_name' => 'Hr-Loan',
                'permissions' => [

                    'Hr-Loan.add',
                    'Hr-Loan.index',
                    'Hr-Loan.edit',
                    'Hr-Loan.delete',
                ]
            ],
            [
                'group_name' => 'Increment',
                'permissions' => [

                    'Hr-Increment.add',
                    'Increment.edit',
                    // 'Increment.delete',
                ]
            ],
            [
                'group_name' => 'Bonus',
                'permissions' => [

                    'Bonus.type.add',
                    'Bonus.type.edit',
                    'Bonus.type.delete',
                    'Bonus.setting',
                    'Bonus.out',
                    'Bonus.out.delete',
                ]
            ],
            [
                'group_name' => 'Reward',
                'permissions' => [

                    'reward.type',
                    'reward.gift',
                    'reward.others',
                    'reward.attendance_point',
                    'reward.attendee_employee',
                    'reward.report',
                ]
            ],
            [
                'group_name' => 'Notice',
                'permissions' => [

                    'notice.index',
                    'notice.add',
                    'notice.edit',
                    'notice.delete',
                ]
            ],


        ];
        //create & assign permission
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup]);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }
    }
}
