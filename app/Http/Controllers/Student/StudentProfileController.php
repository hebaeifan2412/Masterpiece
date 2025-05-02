<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Student;

class StudentProfileController extends Controller
{
    public function edit()
    {
        $student = Auth::user()->student;
        return view('student.profile.edit', compact('student'));
    }

    public function update(Request $request)
    {
                /** @var \App\Models\User $user */

        $user = Auth::user();
        $student = $user->student;

        $validated = $request->validate([
            'firstname'     => 'required|string|max:50',
            'secname'       => 'nullable|string|max:50',
            'thirdname'     => 'nullable|string|max:50',
            'lastname'      => 'required|string|max:50',
            'email'         => 'required|email|unique:users,email,' . $user->id,
            'phone_no'      => 'nullable|string|max:15',
            'date_of_birth' => 'required|date',
            'address'       => 'nullable|string|max:500',
            'gender'        => 'required|in:male,female',
            'father_phone'  => 'nullable|string|max:15',
            'mother_phone'  => 'nullable|string|max:15',
            'mother_name'   => 'nullable|string|max:100',
        ]);

        $user->update([
            'firstname' => $validated['firstname'],
            'secname' => $validated['secname'],
            'thirdname' => $validated['thirdname'],
            'lastname' => $validated['lastname'],
            'email' => $validated['email'],
            'phone_no' => $validated['phone_no'],
        ]);

        $student->update([
            'date_of_birth' => $validated['date_of_birth'],
            'address' => $validated['address'],
            'gender' => $validated['gender'],
            'father_phone' => $validated['father_phone'],
            'mother_phone' => $validated['mother_phone'],
            'mother_name' => $validated['mother_name'],
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }
}
