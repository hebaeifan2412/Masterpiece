<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Student;
use App\Models\ClassProfile;
use App\Models\Role;
use App\Models\TeacherProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with(['role', 'student', 'teacherProfile'])->withTrashed();
    
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('firstname', 'like', '%' . $request->search . '%')
                  ->orWhere('lastname', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
    
        if ($request->filled('role')) {
            $query->whereHas('role', function ($q) use ($request) {
                $q->where('name', $request->role);
            });
        }
    
        $users = $query->latest()->get();
    
        $roles = Role::all(); 
        return view('admin.users.index', compact('users', 'roles'));
    }
    

    public function create()
    {
        $roles = Role::all();
        $ClassProfile = ClassProfile::with('grade')->get();
        return view('admin.users.create', compact('roles', 'ClassProfile'));
    }

    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:users,email',
            'phone_no' => 'nullable|string|size:10',
            'password' => [
                'required',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
            ],
            'role_id' => 'required|exists:roles,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'firstname' => 'required_if:role_id,2,3',
            'secname' => 'required|string',
            'thirdname' => 'required|string',

            'lastname' => 'required_if:role_id,2,3',
        ];

        if ($request->role_id == 2) { // Student
            $rules = array_merge($rules, [
                'national_id' => 'required|unique:students,national_id',
                'class_id' => 'required|exists:class_profiles,id',
                'date_of_birth' => 'required|date',
                'address' => 'required|string',
                'gender' => 'required|in:male,female',
                'father_phone' => 'required|string|size:10',
                'mother_phone' => 'required|string|size:10',
                'mother_name' => 'required|string',
            ]);
        }

        if ($request->role_id == 3) { // Teacher
            $rules = array_merge($rules, [
                'qualification' => 'required|string',
                'dob' => 'required|date',
                'gender' => 'required|in:male,female',
                'address' => 'required|string',
                'joining_date' => 'required|date',
                'leave_date' => 'required|date|after:joining_date',
            ]);
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle image upload
        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('users', 'public')
            : 'users/user.jpg';

        $user = User::create([
            'firstname' => $request->firstname,
            'secname' => $request->secname,
            'thirdname' => $request->thirdname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'password' => Hash::make($request->password),
            'image' => $imagePath,
            'role_id' => $request->role_id,
        ]);

        if ($request->role_id == 2) {
            Student::create([
                'national_id' => $request->national_id,
                'user_id' => $user->id,
                'class_id' => $request->class_id,
                'date_of_birth' => $request->date_of_birth,
                'address' => $request->address,
                'gender' => $request->gender,
                'father_phone' => $request->father_phone,
                'mother_phone' => $request->mother_phone,
                'mother_name' => $request->mother_name,
            ]);
        }

        if ($request->role_id == 3) {
            TeacherProfile::create([
                'user_id' => $user->id,
                'qualification' => $request->qualification,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'address' => $request->address,
                'joining_date' => $request->joining_date,
                'leave_date' => $request->leave_date,
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }
    public function destroy($id)
{
    $user = User::findOrFail($id);

    // Delete related profile based on role
    if ($user->role_id == 2 && $user->student) {
        $user->student()->delete();
    }

    if ($user->role_id == 3 && $user->teacherProfile) {
        $user->teacherProfile()->delete();
    }

    // Delete the user (soft delete if using SoftDeletes)
    $user->delete();

    return redirect()->route('admin.users.index')->with('success', 'User and associated profile deleted successfully.');
}
public function restore($id)
{
    $user = User::withTrashed()->findOrFail($id);
    $user->restore();

    return redirect()->route('admin.users.index')->with('success', 'User restored successfully.');
}

}
