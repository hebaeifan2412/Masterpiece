<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Mark;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\StudentQuizAnswer;

class StudentController extends Controller
{
    public function index()
    {
        // Get the currently authenticated user (assumed to be a student)
        $student = Student::where('user_id', Auth::id())->first();
        $studentName = $student->user->firstname .' ' .$student->user->secname .' ' 
        .$student->user->thirdname .' ' .$student->user->lastname ?? 'No Name';
    //   dd( $student);
    $className = $student->classProfile
    ? ($student->classProfile->grade->name . ' - ' . $student->classProfile->section)
    : 'N/A';

$coursesCount = Course::where('class_id', $student->class_id)->count();

$quizzesCount = Quiz::whereHas('course', function($query) use ($student) {
    $query->where('class_id', $student->class_id);
})->count();

$averageMark = round(
    Mark::where('student_id', $student->national_id)
        ->whereNotNull('quiz_id')
        ->avg('marks') ?? 0,
    2
);

        return view('student.home', compact(
            'className',
            'coursesCount',
            'quizzesCount',
            'averageMark',
            'studentName'
        ));
    }
}
