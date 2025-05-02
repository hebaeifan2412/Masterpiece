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
        Schema::create('student_quiz_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
            $table->string('student_id');
            $table->foreign('student_id')->references('national_id')->on('students')->onDelete('cascade');             $table->foreignId('quiz_question_id')->constrained('quiz_questions')->onDelete('cascade');
            $table->foreignId('selected_option_id')->constrained('question_options');
            $table->boolean('is_correct')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_quiz_answers');
    }
};
