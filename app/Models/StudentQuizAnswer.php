<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentQuizAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'student_id',
        'quiz_question_id',
        'selected_option_id',
        'is_correct',
    ];


    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function question()
    {
        return $this->belongsTo(QuizQuestion::class, 'quiz_question_id');
    }

    public function selectedOption()
    {
        return $this->belongsTo(QuestionOption::class, 'selected_option_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'national_id');
    }
}
