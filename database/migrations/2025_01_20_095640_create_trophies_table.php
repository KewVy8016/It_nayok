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
        Schema::create('trophy', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('trophy_name');
            $table->string('trophy_detail', 1000);
            $table->string('trophy_type');
            $table->string('trophy_level');
            $table->string('placename');
            $table->date('date');
            $table->string('teacher_name');
            $table->string('student_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trophy');
    }
};
