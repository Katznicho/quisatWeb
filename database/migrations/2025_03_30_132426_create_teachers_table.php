<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['male', 'female']);
            $table->date('date_of_birth');
            $table->string("profile_image")->nullable();
            $table->string("national_id")->nullable();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('emergency_contact');
            $table->text('address')->nullable();
            $table->string('qualification');
            $table->date('join_date');
            $table->foreignId('school_id')->constrained('schools')->cascadeOnDelete();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
