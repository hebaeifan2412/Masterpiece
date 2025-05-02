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
        Schema::create('teacher_class', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('teacher_profiles')->onDelete('cascade');
            $table->foreignId('class_id')->constrained('class_profiles')->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_class');
    }
};
