<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use App\Models\TeacherProfile;
use App\Models\ClassProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {

        $courses = Course::with(['subject', 'teacher.user', 'classProfile'])->get();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $subjects = Subject::all();
        $teachers = TeacherProfile::with('user')->get(); // This fetches teachers along with their user info
        $classProfiles = ClassProfile::with('grade')->get();
        return view('admin.courses.create', compact('subjects', 'teachers', 'classProfiles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teacher_profiles,id',
            'class_id' => 'required|exists:class_profiles,id',
        ]);
    
        Course::create($validated);
        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
    }

    public function show(Course $course)
    {
        $course->load(['subject', 'teacher.user', 'classProfile.grade']);
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $subjects = Subject::all();
        $teachers = TeacherProfile::with('user')->get();
        $classProfiles = ClassProfile::with('grade')->get();
        return view('admin.courses.edit', compact('course', 'subjects', 'teachers', 'classProfiles'));
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
           
            'subject_id'  => 'required|exists:subjects,id',
            'teacher_id'  => 'required|exists:teacher_profiles,id',
            'class_id'    => 'required|exists:class_profiles,id',
        ]);

        $course->update($data);
        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
    }
}
