<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
            Schema::create('students', function (Blueprint $table) {
                $table->string('national_id')->primary()->comment('National ID number');
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                
                $table->foreignId('class_id')->constrained('class_profiles')->onDelete('cascade');
                
                $table->date('date_of_birth');
                $table->text('address');
                $table->enum('gender', ['male', 'female']);
                $table->enum('student_status', ['active', 'graduated', 'on_leave'])->default('active');
                
                $table->string('father_phone')->nullable();
                $table->string('mother_phone')->nullable();
                $table->string('mother_name')->nullable();
                
                $table->softDeletes();
                $table->timestamps();
            });                                                                                       
        }
    

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
