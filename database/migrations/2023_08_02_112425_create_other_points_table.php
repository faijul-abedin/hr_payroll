<?php

use App\Models\Employee;
use App\Models\PointCategory;
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
        Schema::create('other_points', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PointCategory::class);
            $table->foreignIdFor(Employee::class);
            $table->string('point')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_points');
    }
};
