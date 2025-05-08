<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassProfile;
use App\Models\Grade;
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
    $classProfile = ClassProfile::with(['teachers.user'])->findOrFail($id);
    return view('admin.class_profiles.teachers', compact('classProfile'));
}


public function showStudents($id)
{
    $classProfile = ClassProfile::with(['grade', 'students.user'])->findOrFail($id);
    return view('admin.class_profiles.students', compact('classProfile'));
}

    public function create()
    {
        $grades = Grade::all();
        return view('admin.class_profiles.create', compact('grades'));
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
        $grades = Grade::all();
        return view('admin.class_profiles.edit', compact('classProfile', 'grades'));
    }

    public function update(Request $request, ClassProfile $classProfile)
    {
        $request->validate([
            'grade_id' => 'required|exists:grades,id',
            'section' => 'required|in:A,B,C',
            'capacity' => 'required|integer|min:1',
        ]);
    
        // تحقق من عدد الطلاب الموجودين
        $studentCount = $classProfile->students()->count();
    
        if ($request->capacity < $studentCount) {
            return back()->withErrors([
                'capacity' => "Capacity cannot be less than current student count ($studentCount)."
            ])->withInput();
        }
    
        $duplicate = ClassProfile::where('grade_id', $request->grade_id)
            ->where('section', $request->section)
            ->where('id', '!=', $classProfile->id)
            ->exists();
    
        if ($duplicate) {
            return back()->withErrors([
                'section' => 'Another class with the same grade and section already exists.'
            ])->withInput();
        }
    
        $classProfile->update($request->only('grade_id', 'section', 'capacity'));
    
        return redirect()->route('admin.grades.class_profiles', $request->grade_id)
                         ->with('success', 'Class profile updated successfully.');
    }
    

    public function destroy(ClassProfile $classProfile)
    {
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
