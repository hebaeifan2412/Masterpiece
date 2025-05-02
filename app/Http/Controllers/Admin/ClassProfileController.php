<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassProfile;
use App\Models\Grade;

class ClassProfileController extends Controller
{
    public function index()
    {
        $classProfiles = ClassProfile::with('grade')
        ->withCount('students')
        ->get();
     
        return view('admin.class_profiles.index', compact('classProfiles' ));
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

        ClassProfile::create($request->only('grade_id', 'section', 'capacity'));

        return redirect()->route('admin.class_profiles.index')
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

        $classProfile->update($request->only('grade_id', 'section', 'capacity'));

        return redirect()->route('admin.class_profiles.index')
                         ->with('success', 'Class profile updated successfully.');
    }

    public function destroy(ClassProfile $classProfile)
    {
        $classProfile->delete();
        return redirect()->route('admin.class_profiles.index')
                         ->with('success', 'Class profile deleted successfully.');
    }
}
