<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\ClassProfile;
use App\Models\Mark;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherMarkController extends Controller
{
    public function index()
    {
        $teacher = Auth::user()->teacherProfile;

        //  classes with students and grades
        $classess = $teacher->classes()->with(['students.user', 'grade'])->get();

        //  class IDs the teacher teaches
        $classIds = $classess->pluck('id');


        // quizzes for those classes that the teacher created
        $quizzes = Quiz::where('teacher_id', $teacher->id)
            ->whereHas('classes', function ($q) use ($classIds) {
                $q->whereIn('class_profile_id', $classIds);
            })
            ->get();

        //  marks for quizzes by this teacher
        $marks = Mark::with(['student.user', 'quiz'])
            ->whereIn('quiz_id', $quizzes->pluck('id'))
            ->get();

        return view('teacher.marks.index', compact('classess', 'quizzes', 'marks'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'student_id'     => 'required|exists:students,national_id',
            'class_id'       => 'required|exists:class_profiles,id',
            'quiz_id'        => 'required|exists:quizzes,id',
            'marks'          => 'required|integer|min:0',
        ]);

        $teacherId = Auth::user()->teacherProfile->id;

        // Check if the teacher teaches the class
        $class = ClassProfile::whereHas('teachers', function ($q) use ($teacherId) {
            $q->where('teacher_id', $teacherId);
        })->where('id', $request->class_id)
            ->with('students')
            ->firstOrFail();

        // Check if student belongs to the class
        $student = $class->students->where('national_id', $request->student_id)->first();
        if (!$student) {
            return back()->with('error', 'Student does not belong to this class.');
        }

        // Validate that quiz belongs to teacher and class
        $validQuiz = Quiz::where('id', $request->quiz_id)
            ->where('teacher_id', $teacherId)
            ->where('class_id', $request->class_id)
            ->exists();
        if (!$validQuiz) {
            return back()->with('error', 'Quiz does not belong to this class.');
        }

        // Save or update mark
        Mark::updateOrCreate([
            'student_id' => $request->student_id,
            'quiz_id'    => $request->quiz_id,
        ], [
            'marks' => $request->marks,
        ]);

        return back()->with('success', 'Mark updated successfully.');
    }
}
