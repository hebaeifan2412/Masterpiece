<?php
// app/Http/Controllers/Admin/TeacherProfileController.php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\TeacherProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Support\Facades\Hash;

class TeacherProfileController extends Controller
{
    public function index(Request $request)
    {
        $query = TeacherProfile::with(['user', 'subject']);

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('firstname', 'like', "%{$search}%")
                  ->orWhere('secname', 'like', "%{$search}%")
                  ->orWhere('thirdname', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
    
        if ($request->filled('subject')) {
            $query->whereHas('subject', function ($q) use ($request) {
                $q->where('name', $request->input('subject'));
            });
        }
    
        $teachers = $query->paginate(10);
    
        $subjects = Subject::all();
        return view('admin.teachers.index', compact('teachers' ,'subjects'));
    }



    public function create()
    {
        $subjects = Subject::all();
        return view('admin.teachers.create', compact('subjects'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'subject_id' => 'required|exists:subjects,id',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female',
            'joining_date' => 'required|date',
        ]);
    
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 3 // teacher role
        ]);
    
        TeacherProfile::create([
            'user_id' => $user->id,
            'subject_id' => $request->subject_id,
            'qualification' => $request->qualification,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'joining_date' => $request->joining_date,
            'leave_date' => $request->leave_date,
        ]);
    
        return redirect()->route('admin.teacher_profiles.index')->with('success', 'Teacher created successfully.');
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
            // user fields
            'firstname' => 'required|string|max:50',
            'secname'   => 'nullable|string|max:50',
            'thirdname' => 'nullable|string|max:50',
            'lastname'  => 'required|string|max:50',
            'email'     => 'required|email|max:100',
    
            // profile fields
            'dob'           => 'required|date',
            'gender'        => 'required|in:male,female',
            'qualification' => 'nullable|string|max:255',
            'joining_date'  => 'required|date',
            'leave_date'    => 'nullable|date|after_or_equal:joining_date',
            'address'       => 'nullable|string|max:500',
            'image'           => 'nullable|image|max:2048',
        ]);
    
        $teacher_profile->user->update([
            'firstname' => $request->firstname,
            'secname'   => $request->secname,
            'thirdname' => $request->thirdname,
            'lastname'  => $request->lastname,
            'email'     => $request->email,
        ]);
    
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('teacher_pics', 'public');
            $teacher_profile->user->image = $path;
            $teacher_profile->user->save();
        }
    
        $teacher_profile->update([
            'dob'           => $request->dob,
            'gender'        => $request->gender,
            'qualification' => $request->qualification,
            'joining_date'  => $request->joining_date,
            'leave_date'    => $request->leave_date,
            'address'       => $request->address,
        ]);
    
        return redirect()->route('admin.teacher_profiles.show', $teacher_profile->id)
        ->with('success', 'Teacher profile updated successfully.');    }
    public function show($id)
{
    $teacherProfile = TeacherProfile::with(['user', 'subject', 'classes'])->findOrFail($id);
    return view('admin.teachers.show', compact('teacherProfile'));
}


    public function destroy(TeacherProfile $teacher_profile)
    {
        $teacher_profile->delete();
        return redirect()->back()->with('success', 'Teacher profile deleted.');
    }
}

