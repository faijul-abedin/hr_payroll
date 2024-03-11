<?php

namespace App\Console\Commands;

use App\Models\Increment;
use Illuminate\Console\Command;
use App\Models\salary;
use Carbon\Carbon;

class IncrementSalaries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:increment-salaries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically increment salaries for employees whose join date has crossed one year';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentDate = Carbon::now();
        $employees = salary::all();

        foreach ($employees as $salary) {
            $joinDate = Carbon::parse($salary->Employee->starting);
            $monthsSinceJoining = $currentDate->diffInMonths($joinDate);

            if ($monthsSinceJoining % 12 === 0) {
                $increment = new Increment();
                $increment->employee_id = $salary->employee_id;
                $increment->increment_rate = 5;
        
                $newSalaryRate = $salary->rate * (1 + 5 / 100);
                $salary->rate = $newSalaryRate;
                $salary->save();
                
                $increment->save();
            }
        }

        $this->info('Salaries incremented successfully.');
    }
}
