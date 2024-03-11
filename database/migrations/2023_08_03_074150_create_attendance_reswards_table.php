<?php

use App\Models\Employee;
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
        Schema::create('attendance_reswards', function (Blueprint $table) {
            $table->id();
            $table->string("attendance_minimization")->default(0);
            $table->string("late_minimization")->default(0);
            $table->string("with_late_point")->default(0);
            $table->string("without_late_point")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_reswards');
    }
};
