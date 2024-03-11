<?php

use App\Models\Department;
use App\Models\Designation;
use App\Models\Shift;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('contact')->nullable();
            $table->string('alternative_contact')->nullable();
            $table->string('present_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('nationality')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('rer_1')->nullable();
            $table->string('ref_1_phone')->nullable();
            $table->string('rer_2')->nullable();
            $table->string('ref_2_phone')->nullable();
            $table->string('employee_id')->nullable();
            $table->foreignIdFor(Department::class)->nullable();
            $table->foreignIdFor(Designation::class)->nullable();
            $table->foreignIdFor(Shift::class)->nullable();
            $table->date('starting')->nullable();
            $table->date('ending')->nullable();
            $table->string('manager_id')->nullable();
            // $table->string('shift')->nullable();
            $table->string('photo')->nullable();
            $table->string('comment')->nullable();
            $table->string('status')->nullable();
            $table->string('password')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
