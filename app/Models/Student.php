<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $primaryKey = 'national_id';
    public $incrementing = false;
    protected $fillable = [
       'national_id',
        'user_id',
        'class_id',
        'date_of_birth',
        'address',
        'pic',
        'gender',
        'student_status',
        'father_phone',
        'mother_phone',
        'mother_name',
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classProfile()
    {
        return $this->belongsTo(ClassProfile::class, 'class_id');
    }
    public function quizAnswers()
    {
        return $this->hasMany(StudentQuizAnswer::class, 'student_id', 'national_id');
    }
    public function marks()
{
    return $this->hasMany(Mark::class, 'student_id', 'national_id');
}
}
