<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id'); // Can be from students OR old_students
            $table->foreignId('module_id')->constrained('modules')->cascadeOnDelete();
            $table->timestamp('enrolled_at')->useCurrent();
            $table->timestamp('completed_at')->nullable();
            $table->enum('status', ['active', 'completed', 'dropped'])->default('active');
            $table->enum('pass_status', ['pending', 'pass', 'fail'])->default('pending');
            $table->timestamps();
            
            // Prevent duplicate active enrollments
            $table->unique(['student_id', 'module_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};