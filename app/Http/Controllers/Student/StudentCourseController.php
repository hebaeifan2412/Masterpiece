<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentCourseController extends Controller
{
    public function index()
{
    $student = Student::where('user_id', Auth::id())->first();
    $student = Student::where('user_id', Auth::id())->first();

    $courses = Course::withCount(['quizzes', 'assignments']) 
                ->where('class_id', $student->class_id)
                ->get();

    return view('student.courses.index', compact('courses'));
}
public function showCourse(Course $course)
{
    $course->load(['teacher', 'quizzes', 'assignments']); // نحمل المعلم والكويزات والأسايمنتات

    return view('student.courses.show', compact('course'));
}
}
