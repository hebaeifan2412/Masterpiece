<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\TeacherProfile;
use Illuminate\Support\Facades\Auth;

class StudentSubjectController extends Controller
{
    public function index()
    {
        // الطالب الحالي مع صفه
        $student = Student::with('classProfile')->where('user_id', Auth::id())->firstOrFail();
        $classId = $student->class_id;

        // المعلمين الذين يدرّسون صف الطالب
        $teachers = TeacherProfile::with(['subject', 'user'])
            ->whereHas('classes', function ($query) use ($classId) {
                $query->where('class_id', $classId);
            })
            ->get();

        return view('student.subjects.index', compact('teachers'));
    }
}
