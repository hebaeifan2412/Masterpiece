<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassProfile;
use App\Models\Mark;
use App\Models\Subject;
use App\Models\TeacherProfile;
use Illuminate\Http\Request;

class MarkController extends Controller
{


public function index(Request $request)
{
    $query = Mark::with(['student.user', 'quiz']);

    if ($request->filled('class_id')) {
        $query->whereHas('student', function ($q) use ($request) {
            $q->where('class_id', $request->class_id);
        });
    }

    if ($request->filled('teacher_id')) {
        $query->whereHas('quiz', function ($q) use ($request) {
            $q->where('teacher_id', $request->teacher_id);
        });
    }

    if ($request->filled('subject_id')) {
        $query->whereHas('quiz.teacher.subject', function ($q) use ($request) {
            $q->where('subjects.id', $request->subject_id);
        });
    }

    $marks = $query->get();
    $classess = ClassProfile::with('grade')->get();
    $teachers = TeacherProfile::with('user')->get();
    $subjects = Subject::all();

    return view('admin.marks.index', compact('marks', 'classess', 'teachers', 'subjects'));
}
}
