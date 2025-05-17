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
       $classess = $teacher->classes()->with([
    'students.user',
    'grade',
    'quizzes' => function ($query) use ($teacher) {
        $query->where('teacher_id', $teacher->id);
    },
    'quizzes.questions'
])->get();
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
    'student_id' => 'required|exists:students,national_id',
    'quiz_id'    => 'required|exists:quizzes,id',
    'marks'      => 'required|integer|min:0',
]);

$teacherId = Auth::user()->teacherProfile->id;

//  the quiz and its assigned classes
$quiz = Quiz::where('id', $request->quiz_id)
    ->where('teacher_id', $teacherId)
    ->with('classes')
    ->first();

if (!$quiz) {
    return back()->with('error', 'Quiz not found or not assigned to this teacher.');
}

//  student by national ID and check class
$student = \App\Models\Student::where('national_id', $request->student_id)
    ->with('classProfile')
    ->first();

if (!$student || !$student->classProfile || ! $quiz->classes->pluck('id')->contains($student->classProfile->id)) {
    return back()->with('error', 'Student not in class assigned to this quiz.');
}

Mark::updateOrCreate([
    'student_id' => $request->student_id, // still national_id (string)
    'quiz_id'    => $request->quiz_id,
], [
    'marks' => $request->marks,
]);

return back()->with(['success' => 'Mark updated successfully.','open_quiz_id' => $request->quiz_id
,
    'open_class_id' => $student->classProfile->id ?? null,]);
    }
}
