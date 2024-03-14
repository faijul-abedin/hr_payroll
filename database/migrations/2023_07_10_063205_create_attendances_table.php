<?php

use App\Models\Employee;
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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class)->nullable(); // id in machine

            $table->integer('uid')->nullable();
            $table->integer('state')->nullable();
            $table->timestamp('timestamp')->nullable();
            $table->integer('type')->nullable();

            $table->string('is_present')->nullable();
            $table->string('is_late')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
