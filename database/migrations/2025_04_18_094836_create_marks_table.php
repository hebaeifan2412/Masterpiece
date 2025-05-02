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
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->foreign('student_id')->references('national_id')->on('students')->onDelete('cascade');
            $table->foreignId('quiz_id')->nullable()->constrained()->onDelete('cascade');
            $table->integer('marks');
            $table->timestamps();
       


            $table->unique(['student_id', 'quiz_id']);
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marks');
    }
};
