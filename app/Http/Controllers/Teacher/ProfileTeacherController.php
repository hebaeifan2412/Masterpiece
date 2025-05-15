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
        $teacher = auth()->user()->teacherProfile;

        $request->validate([
            'firstname'     => 'required|string|max:255',
            'secname'       => 'nullable|string|max:255',
            'thirdname'     => 'nullable|string|max:255',
            'lastname'      => 'required|string|max:255',
            'phone'         => 'required|digits:10',
            'qualification' => 'required|string|max:255',
            'dob'           => 'nullable|date',
            'address'       => 'required|string|max:255',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = $teacher->user;
        $user->firstname = $request->firstname;
        $user->secname   = $request->secname;
        $user->thirdname = $request->thirdname;
        $user->lastname  = $request->lastname;
        $user->phone_no  = $request->phone;
        if ($request->hasFile('image')) {
            if ($teacher->image && Storage::disk('public')->exists($teacher->image)) {
                Storage::disk('public')->delete($teacher->image);
            }

            $image      = $request->file('image');
            $imageName  = time() . '.' . $image->getClientOriginalExtension();
            $imagePath  = $image->storeAs('teacher_pics', $imageName, 'public');
            $user->image = $imagePath;
        }
        $user->save();

        $teacher->qualification = $request->qualification;
        $teacher->dob           = $request->dob;
        $teacher->address       = $request->address;



        $teacher->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
