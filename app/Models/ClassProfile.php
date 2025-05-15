<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassProfile extends Model
{
    use HasFactory;

    protected $fillable = ['grade_id', 'section', 'capacity'];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
 public function quizzes()
{
    return $this->belongsToMany(Quiz::class, 'class_quiz', 'class_profile_id', 'quiz_id');
}



    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

   
    public function teachers()
    {
        return $this->belongsToMany(TeacherProfile::class, 'teacher_class', 'class_id', 'teacher_id');
    }
    public function assignments()
{
    return $this->belongsToMany(Assignment::class, 'assignment_class', 'class_profile_id', 'assignment_id');
}

    
}
