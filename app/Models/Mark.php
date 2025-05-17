<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'quiz_id',  'marks'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'national_id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }
}
