<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_id',
        'teacher_id',
        'title',
        'duration',
        'number_of_questions',
        'start_time',
        'end_time',
        'status',
    ];
    
  

   
    public function classProfile()
    {
        return $this->belongsTo(ClassProfile::class, 'class_id');
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
