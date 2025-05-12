<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\ClassProfile;
use App\Models\TeacherProfile;
use Illuminate\Support\Facades\Hash;

class AdminStudentController extends Controller
{
  
 public function index(Request $request)
{
    $query = Student::with(['user', 'classProfile']);
    

    if ($request->filled('class_id')) {
        $query->where('class_id', $request->class_id);
    }
    if ($request->filled('search')) {
        $search = $request->search;
        $query->whereHas('user', function ($q) use ($search) {
            $q->where('firstname', 'like', "%{$search}%")
              ->orWhere('secname', 'like', "%{$search}%")
              ->orWhere('thirdname', 'like', "%{$search}%")
              ->orWhere('lastname', 'like', "%{$search}%");
        });
    }

    $students = $query->paginate(10); 

    $classProfiles = ClassProfile::with('grade')->get(); 

    return view('admin.students.index', compact('students', 'classProfiles'));
}
    

    public function create()
    {
        $users = User::all();
        $classProfiles = ClassProfile::with('grade')->get();
        return view('admin.students.create', compact('users', 'classProfiles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // User fields
            'firstname' => 'required|string|max:50',
            'secname' => 'nullable|string|max:50',
            'thirdname' => 'nullable|string|max:50',
            'lastname' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'phone_no' => 'nullable|string|max:15',
            'password' => 'required|string|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    
            // Student fields
            'national_id' => 'required|string|unique:students,national_id',
            'class_id' => 'required|exists:class_profiles,id',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'gender' => 'required|in:male,female',
            'father_phone' => 'nullable|string',
            'mother_phone' => 'nullable|string',
            'mother_name' => 'nullable|string',
        ]);
    
        $user = User::create([
            'firstname' => $request->firstname,
            'secname' => $request->secname,
            'thirdname' => $request->thirdname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'password' => Hash::make($request->password),
            'image' => $request->hasFile('image')
                        ? $request->file('image')->store('users', 'public')
                        : 'users/default.jpg',
            'role_id' => 2, 
        ]);
    
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

        return redirect()->route('admin.students.index')->with('success', 'Student created successfully.');
    }

    public function show($id)
    {
        $student = Student::with([
            'user',
            'classProfile.grade',
            'classProfile.teachers.subject',
            'classProfile.teachers.user',
        ])->findOrFail($id);
    
        return view('admin.students.show', compact('student'));
    }
    
    public function edit($national_id)
    {
        $student = Student::findOrFail($national_id);
        $users = User::all();
        $classProfiles = ClassProfile::with('grade')->get();
        return view('admin.students.edit', compact('student', 'users', 'classProfiles'));
    }

    public function update(Request $request, $national_id)
    {
        $student = Student::where('national_id', $national_id)->with('user')->firstOrFail();
    
        $validated = $request->validate([
            'firstname'     => 'nullable|string|max:50',
            'secname'       => 'nullable|string|max:50',
            'thirdname'     => 'nullable|string|max:50',
            'lastname'      => 'nullable|string|max:50',
            'email'         => 'required|email|max:100|unique:users,email,' . $student->user_id,
            'phone_no'      => 'nullable|string|max:15',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    
'national_id' => 'required|unique:students,national_id,' . $student->national_id . ',national_id',
            'class_id'      => 'required|exists:class_profiles,id',
            'date_of_birth' => 'required|date',
            'gender'        => 'required|in:male,female',
            'address'       => 'required|string',
            'father_phone'  => 'nullable|string',
            'mother_phone'  => 'nullable|string',
            'mother_name'   => 'nullable|string',
        ]);
    
        // Update User
        $student->user->update([
            'firstname' => $request->firstname,
            'secname'   => $request->secname,
            'thirdname' => $request->thirdname,
            'lastname'  => $request->lastname,
            'email'     => $request->email,
            'phone_no'  => $request->phone_no,
        ]);
    
        // Update image if exists
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('users', 'public');
            $student->user->image = $path;
            $student->user->save();
        }
    
        // Update Student
        $student->update([
            'national_id'   => $request->national_id,
            'class_id'      => $request->class_id,
            'date_of_birth' => $request->date_of_birth,
            'gender'        => $request->gender,
            'address'       => $request->address,
            'father_phone'  => $request->father_phone,
            'mother_phone'  => $request->mother_phone,
            'mother_name'   => $request->mother_name,
        ]);
    
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
