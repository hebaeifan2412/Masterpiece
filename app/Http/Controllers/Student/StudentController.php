<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Mark;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\StudentQuizAnswer;
use App\Models\TeacherProfile;

class StudentController extends Controller
{
    public function index()
    {
        $student = Student::where('user_id', Auth::id())->first();
        $studentName = $student->user->firstname .' ' .$student->user->secname .' ' 
        .$student->user->thirdname .' ' .$student->user->lastname ?? 'No Name';

        $classId = $student->class_id;

    $className = $student->classProfile
    ? ($student->classProfile->grade->name . ' - ' . $student->classProfile->section)
    : 'N/A';

$coursesCount = 0;

$quizzesCount = Quiz::where('class_id', $classId)->count();

$averageMark = round(
    Mark::where('student_id', $student->national_id)
        ->whereNotNull('quiz_id')
        ->avg('marks') ?? 0,
    2
);

$teacherProfiles = TeacherProfile::whereHas('classes', function ($q) use ($classId) {
    $q->where('class_id', $classId);
})->with('subject')->get();


    $quizCountsBySubject = [];



foreach ($teacherProfiles as $teacher) {
    if ($teacher->subject && $teacher->subject->name) {
        $subjectName = $teacher->subject->name;

        $quizCount = Quiz::where('class_id', $classId)
                         ->where('teacher_id', $teacher->id)
                         ->count();

        $quizCountsBySubject[$subjectName] = $quizCountsBySubject[$subjectName] ?? 0;
        $quizCountsBySubject[$subjectName] += $quizCount;
    }
}


      





return view('student.home', compact(
    'className',
    'coursesCount',
    'quizzesCount',
    'averageMark',
    'studentName',
    'quizCountsBySubject'
));
    }
}
