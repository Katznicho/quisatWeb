<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) { // Change from Schema::table() to Schema::create()
            $table->id();
            $table->string('admission_number')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['male', 'female']);
            $table->date('date_of_birth');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            $table->foreignId('class_id')->constrained('school_classes')->cascadeOnDelete();
            $table->foreignId('guardian_id')->constrained('guardians')->cascadeOnDelete();
            $table->timestamps(); // Add timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
