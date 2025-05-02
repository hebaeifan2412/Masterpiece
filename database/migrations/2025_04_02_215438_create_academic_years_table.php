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
            Schema::create('academic_years', function (Blueprint $table) {
                $table->id();
                $table->string('title')->unique()->comment('"2023/2024 Academic Year"');
                $table->date('start_date');
                $table->date('end_date');
                $table->boolean('is_open_for_admission')->default(false);
                $table->enum('status', ['active', 'planned', 'archived'])->default('planned');
                $table->timestamps();
                $table->softDeletes();
                
             
              

            });
            }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_years');
    }
};
