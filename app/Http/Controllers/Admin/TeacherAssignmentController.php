<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassProfile;
use App\Models\TeacherProfile;
use App\Models\TeacherClass;
use App\Models\Subject;

class TeacherAssignmentController extends Controller
{
   
    public function create($classId, Request $request)
    {
        $classProfile = ClassProfile::with(['grade', 'teachers.user', 'teachers.subject'])->findOrFail($classId);

        $subjects = Subject::all();

        $subjectId = $request->get('subject_id');

        $teachers = collect();
        if ($subjectId) {
            $teachers = TeacherProfile::with('user', 'subject')
                ->where('subject_id', $subjectId)
                ->get();
        }

        return view('admin.teacher_assignment.create', compact('classProfile', 'subjects', 'subjectId', 'teachers'));

    }

    
    public function store($classId, Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teacher_profiles,id',
        ]);

        $exists = TeacherClass::where('class_id', $classId)
                              ->where('teacher_id', $request->teacher_id)
                              ->exists();

        if ($exists) {
            return redirect()
                ->route('admin.class.assign-teacher', [
                    'class' => $classId,
                    'subject_id' => $request->get('subject_id')
                ])
                ->withErrors(['teacher_id' => 'This teacher is already assigned to this class.']);
        }

        TeacherClass::create([
            'class_id' => $classId,
            'teacher_id' => $request->teacher_id,
        ]);

        return redirect()
            ->route('admin.class_profiles.teachers', $classId)
            ->with('success', 'Teacher assigned successfully.');
    }

    public function getTeachersBySubject($subjectId)
{
    $teachers = TeacherProfile::with('user', 'subject')
                ->where('subject_id', $subjectId)
                ->get();

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
