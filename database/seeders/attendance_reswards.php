<?php

namespace Database\Seeders;

use App\Models\AttendanceResward;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class attendance_reswards extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reward = new AttendanceResward();
        $reward->attendance_minimization = 0;
        $reward->late_minimization = 0;
        $reward->with_late_point = 0;
        $reward->without_late_point = 0;
        $reward->save();
    }
}
