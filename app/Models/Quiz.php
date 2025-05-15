<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'teacher_id',
        'title',
        'duration',
        'number_of_questions',
        'start_time',
        'end_time',
        'status',
    ];
    
  
public function classes()
{
    return $this->belongsToMany(ClassProfile::class, 'class_quiz', 'quiz_id', 'class_profile_id');
}

    

    public function teacher()
    {
        return $this->belongsTo(TeacherProfile::class, 'teacher_id');
    }

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function studentAnswers()
    {
        return $this->hasMany(StudentQuizAnswer::class);
    }
}
