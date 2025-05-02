<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\TeacherClass;

class ClassTeacherController extends Controller
{
    public function index()
    {
        $teacher = Auth::user()->teacherProfile;

        // كل صف يدرّسه المعلم + المادة + الطلاب
        $entries = TeacherClass::where('teacher_id', $teacher->id)
                    ->with(['classProfile.grade','classProfile.students.user'])
                    ->get();
                    $subject = $teacher->subject;
        return view('teacher.classes.index', compact('entries','subject'));
    }
}
