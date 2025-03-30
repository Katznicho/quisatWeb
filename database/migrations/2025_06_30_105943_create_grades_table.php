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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            // $table->foreignId('class_id')->constrained()->cascadeOnDelete();
            // $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            // $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            // $table->integer('grade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
