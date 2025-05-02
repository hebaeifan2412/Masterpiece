<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherClass extends Model
{
    use HasFactory;

    protected $table = 'teacher_class';

    protected $fillable = [
        'teacher_id',
        'class_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(TeacherProfile::class);
    }
    public function classProfile()
    {
        return $this->belongsTo(ClassProfile::class, 'class_id');
    }
}
