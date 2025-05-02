<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    

    public function editTeacher()
{
    return view('teacher.auth.password-edit');
}

public function updateTeacher(Request $request)
{
    $request->validate([
        'current_password' => ['required', 'current_password'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
    
    /** @var \App\Models\User $user */
    $user = Auth::user();

    $user->update([
        'password' => Hash::make($request->password),
    ]);

    return back()->with('success', 'Password updated successfully.');
}


public function editStudent() {
    return view('student.auth.password-edit');
}
public function updateStudent(Request $request) {
    $this->updatePassword($request);
    return redirect()->back()->with('success', 'Password updated successfully.');
}

public function editAdmin() {
    return view('admin.auth.password-edit');
}
public function updateAdmin(Request $request) {
    $this->updatePassword($request);
    return redirect()->back()->with('success', 'Password updated successfully.');
}

protected function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required', 'current_password'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $user = User::findOrFail(Auth::id());
    $user->update([
        'password' => bcrypt($request->password),
    ]);
}

}
