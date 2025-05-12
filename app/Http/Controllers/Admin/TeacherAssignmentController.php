<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassProfile;
use App\Models\TeacherProfile;
use App\Models\TeacherClass;
use App\Models\Subject;
use Illuminate\Support\Facades\Log;

class TeacherAssignmentController extends Controller
{
   
public function create($classId)
{
    $classProfile = ClassProfile::with(['grade', 'teachers'])->findOrFail($classId);
    $subjects = Subject::all();

    // نبدأ بدون معلمين
    $availableTeachers = collect(); 

    return view('admin.teacher_assignment.create', compact(
        'classProfile',
        'subjects',
        'availableTeachers'
    ));
}


    
public function store($classId, Request $request)
{
    $request->validate([
        'teacher_id' => 'required|exists:teacher_profiles,id',
    ]);

    $teacher = TeacherProfile::findOrFail($request->teacher_id);
    $teacherSubjectId = $teacher->subject_id;

    // نبحث عن أي معلم آخر في نفس الصف له نفس المادة
    $alreadyAssigned = TeacherClass::where('class_id', $classId)
        ->whereIn('teacher_id', function ($query) use ($teacherSubjectId) {
            $query->select('id')
                  ->from('teacher_profiles')
                  ->where('subject_id', $teacherSubjectId);
        })
        ->exists();

    if ($alreadyAssigned) {
        return redirect()
            ->route('admin.class.assign-teacher', [
                'class' => $classId,
                'subject_id' => $teacherSubjectId,
            ])
            ->withErrors(['subject_id' => 'This subject is already assigned to this class.']);
    }

    TeacherClass::create([
        'class_id' => $classId,
        'teacher_id' => $teacher->id,
    ]);

    return redirect()
        ->route('admin.class_profiles.teachers', $classId)
        ->with('success', 'Teacher assigned successfully.');
}


    public function getTeachersBySubject($subjectId, Request $request)
{
    $classId = $request->get('class_id');

    $assignedIds = TeacherClass::where('class_id', $classId)->pluck('teacher_id');

    $teachers = TeacherProfile::with('user')
        ->where('subject_id', $subjectId)
        ->whereNotIn('id', $assignedIds)
        ->get();

    // DEBUGGING
     Log::info($teachers); 

    return response()->json($teachers);
}


public function ajaxAssign($classId, Request $request)
{
    $request->validate([
        'teacher_id' => 'required|exists:teacher_profiles,id',
    ]);

    $exists = TeacherClass::where('class_id', $classId)
                          ->where('teacher_id', $request->teacher_id)
                          ->exists();

    if ($exists) {
        return response()->json(['message' => 'Teacher already assigned.'], 409);
    }

    TeacherClass::create([
        'class_id' => $classId,
        'teacher_id' => $request->teacher_id,
    ]);

    return response()->json(['message' => 'Teacher assigned successfully.']);
}
public function unassign($classId, $teacherId)
{
    $assignment = TeacherClass::where('class_id', $classId)
                              ->where('teacher_id', $teacherId)
                              ->first();

    if ($assignment) {
        $assignment->delete();
        return back()->with('success', 'Teacher unassigned successfully.');
    }

    return back()->withErrors(['unassign' => 'Teacher assignment not found.']);
}


}
