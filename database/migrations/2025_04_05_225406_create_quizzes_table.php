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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('teacher_profiles')->onDelete('cascade');
            $table->string('title');
            $table->integer('duration'); 
            $table->unsignedInteger('number_of_questions')->default(1);
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->enum('status', ['show', 'hide'])->default('hide');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
