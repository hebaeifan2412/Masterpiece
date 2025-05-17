<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    public function edit()
    {
        $admin = Auth::user();

        return view('admin.profile.edit', compact('admin'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $admin */
        $admin = Auth::user();
        $validated = $request->validate([
            'firstname'   => 'nullable|string|max:50',
            'secname'     => 'nullable|string|max:50',
            'thirdname'   => 'nullable|string|max:50',
            'lastname'    => 'nullable|string|max:50',
            'email'       => 'required|email|unique:users,email,' . $admin->id,
            'phone_no' => 'nullable|regex:/^07[0-9]{8}$/',
            'status'      => 'in:active,inactive',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',],
         [
    'phone_no.regex' => 'The phone number must start with 07 and be exactly 10 digits.',
    'email.unique'   => 'This email is already taken.',
    'image.image'    => 'The uploaded file must be an image.',
    'image.mimes'    => 'The image must be a file of type: jpeg, png, jpg.',
    'image.max'      => 'The image size must not exceed 2MB.',
]);


        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('admin_images', 'public');
        }

        $admin->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Admin profile updated successfully.');
    }
}
