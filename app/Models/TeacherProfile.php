<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeacherProfile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'qualification',
        'dob',
        'subject_id', 
        'gender',
        'address',
        'joining_date',
        'leave_date',
        'pic',
    ];

    /**
     * العلاقة مع جدول المستخدمين
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * العلاقة مع جدول المواد
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

 

    /**
     * العلاقة مع الصفوف (Many-to-Many مباشرة)
     */
    public function classes()
    {
        return $this->belongsToMany(ClassProfile::class, 'teacher_class', 'teacher_id', 'class_id');
    }
   
    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'teacher_id');
    }
}
