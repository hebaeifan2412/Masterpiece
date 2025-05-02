<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentAssignmentController extends Controller
{
    public function index()
{
    $student = Auth::user()->student;

    $assignments = Assignment::where('status', 'show')
        ->whereHas('course', function ($query) use ($student) {
            $query->where('class_id', $student->class_id);
        })
        ->where('open_time', '<=', now())
        ->where('close_time', '>=', now())
        ->with(['course', 'submissions'])

        ->get();

    return view('student.assignments.index', compact('assignments'));
}
public function submit(Request $request, $id)
{
    $request->validate([
       'file' => 'required|file|mimes:pdf|max:20480',// max 20MB
    ] ,[
        'file.mimes' => 'The file must be a PDF document.',
        'file.max' => 'The file may not be greater than 20MB.',
    ]);

    $student = Auth::user()->student;
    $assignment = Assignment::with('course')->findOrFail($id);

    // تأكد أن الطالب من نفس الصف
    if ($assignment->course->class_id !== $student->class_id) {
        abort(403, 'Unauthorized');
    }

    // تحقق من الوقت
    if (now()->lt($assignment->open_time) || now()->gt($assignment->close_time)) {
        return back()->with('error', 'Submission is not allowed at this time.');
    }

    $path = $request->file('file')->store('submissions', 'public');

    Submission::updateOrCreate(
        ['assignment_id' => $id, 'student_id' => $student->national_id],
        ['file_path' => $path, 'submitted_at' => now()]
    );

    return back()->with('success', 'Assignment submitted successfully!');
}

public function destroySubmission($id)
{
    $submission = Submission::findOrFail($id);
    $student = Auth::user()->student;

    // تحقق إن الطالب نفسه هو اللي رافع الملف
    if ($submission->student_id !== $student->national_id) {
        abort(403);
    }

    // تحقق من الوقت المسموح للتسليم
    $assignment = $submission->assignment;
    $now = now();

    if ($now->lt($assignment->open_time) || $now->gt($assignment->close_time)) {
        return back()->with('error', 'You cannot delete the submission outside of the allowed time.');
    }

    // حذف الملف من التخزين
    if ($submission->file_path && Storage::disk('public')->exists($submission->file_path)) {
        Storage::disk('public')->delete($submission->file_path);
    }

    // حذف السجل من قاعدة البيانات
    $submission->delete();

    return back()->with('success', 'Submission deleted. You can now submit a new file.');
}



}
