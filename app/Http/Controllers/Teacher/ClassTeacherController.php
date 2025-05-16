<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\ClassProfile;
use Illuminate\Support\Facades\Auth;
use App\Models\TeacherClass;
use Barryvdh\DomPDF\Facade\Pdf;

class ClassTeacherController extends Controller
{
    public function index()
    {
        $teacher = Auth::user()->teacherProfile;

        $entries = TeacherClass::where('teacher_id', $teacher->id)
                    ->with(['classProfile.grade','classProfile.students.user'])
                    ->get();
                    $subject = $teacher->subject;
        return view('teacher.classes.index', compact('entries','subject'));
    }
    
public function exportStudents($classId)
{
    $classProfile = ClassProfile::with('students.user', 'grade')->findOrFail($classId);
    
    $pdf = Pdf::loadView('admin.class_profiles.studentspdf', compact('classProfile'));

    return $pdf->download('students_list_'. $classProfile->grade->name . '_section_' . $classProfile->section . '.pdf');
}
}
