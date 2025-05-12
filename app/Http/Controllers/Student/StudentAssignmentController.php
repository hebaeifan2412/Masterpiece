<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class StudentAssignmentController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;
        $classId = $student->class_id;

        $assignments = Assignment::where('status', 'show')
            ->whereHas('classProfiles', function ($query) use ($classId) {
                $query->where('class_profiles.id', $classId);
            })
            ->where('open_time', '<=', now())
            ->where('close_time', '>=', now())
            ->with(['classProfiles.teachers.subject', 'submissions'])
            ->get();

        return view('student.assignments.index', compact('assignments'));
    }

    public function submit(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|max:20480', // max 20MB    
        ], [
            'file.mimes' => 'The file must be a PDF document.',
            'file.max' => 'The file may not be greater than 20MB.',
        ]);

        $student = Auth::user()->student;
        $assignment = Assignment::with('classProfiles')->findOrFail($id);

        if (!$assignment->classProfiles->pluck('id')->contains($student->class_id)) {
            abort(403, 'Unauthorized');
        }

        if (now()->lt(Carbon::parse($assignment->open_time)) || now()->gt(Carbon::parse($assignment->close_time)))
         {
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

        if ($submission->student_id !== $student->national_id) {
            abort(403);
        }

        $assignment = $submission->assignment;
        $now = now();

        if ($now->lt($assignment->open_time) || $now->gt($assignment->close_time)) {
            return back()->with('error', 'You cannot delete the submission outside of the allowed time.');
        }

        if ($submission->file_path && Storage::disk('public')->exists($submission->file_path)) {
            Storage::disk('public')->delete($submission->file_path);
        }

        $submission->delete();

        return back()->with('success', 'Submission deleted. You can now submit a new file.');
    }
}
