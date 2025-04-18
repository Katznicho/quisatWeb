<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_classes');
    }
};
