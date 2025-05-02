<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    protected $fillable = [ 'teacher_id', 'title', 'description', 'open_time','close_time' ,'status'];

    public function classProfile()
    {
        return $this->belongsTo(ClassProfile::class, 'class_id');
    }
    public function classProfiles()
{
    return $this->belongsToMany(ClassProfile::class, 'assignment_class', 'assignment_id', 'class_profile_id');
}


    public function teacher()
    {
        return $this->belongsTo(TeacherProfile::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
}
