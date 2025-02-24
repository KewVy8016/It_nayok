<?php

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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('education_level', 10); // ปวช.1, ปวช.2, ปวช.3, ปวส.1, ปวส.2
            $table->integer('male_count'); // จำนวนนักเรียนชาย
            $table->integer('female_count'); // จำนวนนักเรียนหญิง
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
