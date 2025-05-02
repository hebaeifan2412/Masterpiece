<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\ClassProfile;

class AdminStudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['user', 'classProfile'])->get();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $users = User::all();
        $classes = ClassProfile::with('grade')->get();
        return view('admin.students.create', compact('users', 'classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'national_id' => 'required|unique:students,national_id',
            'user_id' => 'required|exists:users,id',
            'class_id' => 'required|exists:class_profiles,id',
            'firstname' => 'nullable|string',
            'secname' => 'nullable|string',
            'thirdname' => 'nullable|string',
            'lastname' => 'nullable|string',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'gender' => 'required|in:male,female',
            'student_status' => 'in:active,graduated,on_leave',
            'father_phone' => 'nullable|string',
            'mother_phone' => 'nullable|string',
            'mother_name' => 'nullable|string',
        ]);

        Student::create($request->all());

        return redirect()->route('admin.students.index')->with('success', 'Student created successfully.');
    }

    public function show($national_id)
{
    $student = Student::with(['user', 'classProfile', 'courses'])->findOrFail($national_id);
    return view('admin.students.show', compact('student'));
}
    public function edit($national_id)
    {
        $student = Student::findOrFail($national_id);
        $users = User::all();
        $classes = ClassProfile::with('grade')->get();
        return view('admin.students.edit', compact('student', 'users', 'classes'));
    }

    public function update(Request $request, $national_id)
    {
        $student = Student::findOrFail($national_id);

        $request->validate([
            'national_id' => 'required|unique:students,national_id',

            'user_id' => 'required|exists:users,id',
            'class_id' => 'required|exists:class_profiles,id',
            'firstname' => 'nullable|string',
            'secname' => 'nullable|string',
            'thirdname' => 'nullable|string',
            'lastname' => 'nullable|string',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'gender' => 'required|in:male,female',
            'student_status' => 'in:active,graduated,on_leave',
            'father_phone' => 'nullable|string',
            'mother_phone' => 'nullable|string',
            'mother_name' => 'nullable|string',
        ]);

        $student->update($request->all());

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    }
    public function trashed()
{
    $students = Student::onlyTrashed()->with(['user', 'classProfile'])->get();
    return view('admin.students.trashed', compact('students'));
}

// Restore a soft-deleted student
public function restore($national_id)
{
    $student = Student::onlyTrashed()->findOrFail($national_id);
    $student->restore();

    return redirect()->route('admin.students.trashed')->with('success', 'Student restored successfully.');
}

// Force delete a soft-deleted student permanently
public function forceDelete($national_id)
{
    $student = Student::onlyTrashed()->findOrFail($national_id);
    $student->forceDelete();

    return redirect()->route('admin.students.trashed')->with('success', 'Student permanently deleted.');
}


    public function destroy($national_id)
    {
        $student = Student::findOrFail($national_id);
        $student->delete();

        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
    }
}
