<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email','admin@gmail.com')->first();
        if(is_null($user))
        {
            $user = new User();
        $user->name = "Super Admin";
        $user->business_name = "Super Admin";
        $user->email = "superadmin@gmail.com";
        $user->address = "Dhaka";
        $user->contact_number = "01976540000";
        $user->second_contact_number = "01976540000";
        $user->password = Hash::make("superadmin123");
        $user->image = " ";
        $user->save();
        $user->assignRole('superadmin');
        }
    }
}
