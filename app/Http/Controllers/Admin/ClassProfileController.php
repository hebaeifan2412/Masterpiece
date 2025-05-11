<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassProfile;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\TeacherClass;
use PDF;

class ClassProfileController extends Controller
{
  public function showByGrade($gradeId)
  { 
    $grade = Grade::with(['classProfiles' => function ($query) {
    $query->withCount('students');
}])->findOrFail($gradeId);

    return view('admin.class_profiles.index', compact('grade'));
}
public function showTeachers($id)
{
    $subjects = Subject:: all();
    
    $classProfile = ClassProfile::with(['teachers.user'])->findOrFail($id);
    return view('admin.class_profiles.teachers', compact('classProfile', 'subjects'));
}


public function showStudents($id)
{
    $classProfile = ClassProfile::with(['grade', 'students.user'])->findOrFail($id);
    return view('admin.class_profiles.students', compact('classProfile'));
}

  public function create($gradeId)
{
    $grade = Grade::findOrFail($gradeId); 

    return view('admin.class_profiles.create', compact('grade'));
}
    public function store(Request $request)
    {
        $request->validate([
            'grade_id' => 'required|exists:grades,id',
            'section' => 'required|in:A,B,C',
            'capacity' => 'required|integer|min:1',
        ]);
    
        $exists = ClassProfile::where('grade_id', $request->grade_id)
                              ->where('section', $request->section)
                              ->exists();
    
        if ($exists) {
            return back()->withErrors(['section' => 'This class section already exists in this grade.'])->withInput();
        }
    
        ClassProfile::create($request->only('grade_id', 'section', 'capacity'));
    
        return redirect()->route('admin.grades.class_profiles', $request->grade_id)
                         ->with('success', 'Class profile created successfully.');
    }
    

    public function edit(ClassProfile $classProfile)
{
    $grade = $classProfile->grade;
    return view('admin.class_profiles.edit', compact('classProfile', 'grade'));
}

public function update(Request $request, ClassProfile $classProfile)
{
    $request->validate([
        'capacity' => 'required|integer|min:1',
    ]);

    $studentCount = $classProfile->students()->count();

    if ($request->capacity < $studentCount) {
        return back()->withErrors([
            'capacity' => "Capacity cannot be less than current student count ($studentCount)."
        ])->withInput();
    }

    // لا يُسمح بتغيير القسم أو المرحلة الدراسية
    $classProfile->update([
        'capacity' => $request->capacity
    ]);

    return redirect()->route('admin.grades.class_profiles', $classProfile->grade_id)
                     ->with('success', 'Class capacity updated successfully.');
}
public function destroy(ClassProfile $classProfile)
{
    $studentCount = $classProfile->students()->count();

    if ($studentCount > 0) {
        return back()->with('error', 'Cannot delete a class that contains students.');
    }

    $classProfile->delete();

    return redirect()->route('admin.grades.class_profiles', $classProfile->grade_id)
                     ->with('success', 'Class profile deleted successfully.');
}

    public function downloadStudentsPdf($id)
{
    $classProfile = ClassProfile::with(['grade', 'students.user'])->findOrFail($id);

    $pdf = PDF::loadView('admin.class_profiles.studentspdf', compact('classProfile'));
    return $pdf->download('students_list_grade_' . $classProfile->grade->name . '_section_' . $classProfile->section . '.pdf');
}
}
