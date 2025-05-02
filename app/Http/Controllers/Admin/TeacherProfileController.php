<?php
// app/Http/Controllers/Admin/TeacherProfileController.php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\TeacherProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherProfileController extends Controller
{
    public function index()
    {
        $teachers = TeacherProfile::with('user')->latest()->get();
        return view('admin.teachers.index', compact('teachers'));
    }



    public function edit($id)
    {
        $teacherProfile = TeacherProfile::findOrFail($id);
        $users = User::all();
    
        return view('admin.teachers.edit', compact('teacherProfile', 'users'));
    }

    public function update(Request $request, TeacherProfile $teacher_profile)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'qualification' => 'nullable|string',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female',
            'address' => 'nullable|string|max:500',
            'joining_date' => 'required|date',
            'leave_date' => 'nullable|date|after_or_equal:joining_date',
            'pic' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('pic')) {
            $validated['pic'] = $request->file('pic')->store('teacher_pics', 'public');
        }

        $teacher_profile->update($validated);
        return redirect()->route('admin.teacher_profiles.index')->with('success', 'Teacher profile updated.');
    }

    public function destroy(TeacherProfile $teacher_profile)
    {
        $teacher_profile->delete();
        return redirect()->back()->with('success', 'Teacher profile deleted.');
    }
}

