<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileTeacherController extends Controller
{
    public function edit()
    {
        $teacher = Auth::user()->teacherProfile->load('user');
        return view('teacher.profile.edit', compact('teacher'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'firstname'      => 'required|string|max:50',
            'secname'        => 'required|string|max:50',
            'thirdname'      => 'nullable|string|max:50',
            'lastname'       => 'required|string|max:50',
            'phone'          => 'nullable|string|max:20',
            'qualification'  => 'nullable|string|max:255',
            'dob'            => 'required|date',
            'address'        => 'nullable|string|max:500',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::findOrFail(Auth::id());
        $teacher = $user->teacherProfile;

        $user->update([
            'firstname'  => $request->firstname,
            'secname'    => $request->secname,
            'thirdname'  => $request->thirdname,
            'lastname'   => $request->lastname,
            'phone_no'   => $request->phone,
        ]);

        if ($request->hasFile('image')) {
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
        
            $path = $request->file('image')->store('teachers', 'public');
            $user->update(['image' => $path]);
        }

        $teacher->update([
            'qualification' => $request->qualification,
            'dob'           => $request->dob,
           'address'       => $request->address,
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }
}