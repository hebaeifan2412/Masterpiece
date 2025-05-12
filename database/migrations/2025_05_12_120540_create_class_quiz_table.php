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
        Schema::create('class_quiz', function (Blueprint $table) {
    $table->id();
    $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
    $table->foreignId('class_profile_id')->constrained('class_profiles')->onDelete('cascade');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_quiz');
    }
};
