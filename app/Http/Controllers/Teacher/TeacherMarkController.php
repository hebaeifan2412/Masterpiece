<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\ClassProfile;
use App\Models\Mark;
use App\Models\Course;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherMarkController extends Controller
{
    public function index()
    {
        $teacher = Auth::user()->teacherProfile;
    
        $classess =$teacher->classes()->with(['students.user', 'grade'])->get();
    
        $quizzes = Quiz::where('teacher_id', $teacher->id)->get();
        $assignments = Assignment::where('teacher_id', $teacher->id)->get();
    
        return view('teacher.marks.index', compact('classess', 'quizzes', 'assignments'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'student_id'     => 'required|exists:students,national_id',
            'class_id'       => 'required|exists:class_profiles,id',
            'quiz_id'        => 'nullable|exists:quizzes,id',
            'assignment_id'  => 'nullable|exists:assignments,id',
            'marks'          => 'required|integer|min:0',
        ]);
    
        $teacherId = Auth::user()->teacherProfile->id;
    
        // التأكد من أن المعلم يدرّس هذا الكورس
        $class = ClassProfile::whereHas('teachers', function($q) use ($teacherId) {
            $q->where('teacher_id', $teacherId);
        })->where('id', $request->class_id)
          ->with('students')
          ->firstOrFail();
    
        // التحقق أن الطالب ضمن الصف المرتبط بالكورس
        $student = $class->students->where('national_id', $request->student_id)->first();
        if (!$student) {
            return back()->with('error', 'Student does not belong to this course.');
        }
    
        // التحقق من تبعية الاختبار أو الواجب للكورس
        if ($request->quiz_id) {
            $validQuiz = Quiz::where('id', $request->quiz_id)
                             ->where('teacher_id', $teacherId)
                             ->where('class_id', $request->class_id)
                             ->exists();
            if (!$validQuiz) {
                return back()->with('error', 'Quiz does not belong to this class.');
            }
        }
        if ($request->assignment_id) {
            $validAssignment = Assignment::where('id', $request->assignment_id)
                                         ->where('teacher_id', $teacherId)
                                         ->where('class_id', $request->class_id)
                                         ->exists();
            if (!$validAssignment) {
                return back()->with('error', 'Assignment does not belong to this class.');
            }
        }
    
        // حفظ العلامة
         Mark::updateOrCreate([
            'student_id'     => $request->student_id,
            'quiz_id'        => $request->quiz_id,
            'assignment_id'  => $request->assignment_id,
        ], [
            'marks' => $request->marks,
        ]);
    
        return back()->with('success', 'Mark updated successfully.');
    }
    
}
