<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherProfilesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teacher_profiles', function (Blueprint $table) {
            
            $table->id();

            $table->foreignId('user_id')->nullable()  ->constrained() ->onDelete('set null');
            $table->string('qualification')->nullable();
            $table->date('dob'); 
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->string('address', 500)->nullable();
            $table->date('joining_date');
            $table->date('leave_date')->nullable();
            $table->softDeletes(); 
            $table->timestamps();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_profiles');
    }
}
