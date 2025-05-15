<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\ClassProfile;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function index()
    {
        $teacherId = Auth::user()->teacherProfile->id;

        $assignments = Assignment::where('teacher_id', $teacherId)
            ->with('classProfiles')
            ->latest()
            ->get()
            ->map(function ($assignment) {
                $assignment->open_time_formatted = Carbon::parse($assignment->open_time)->format('Y-m-d H:i');
                $assignment->close_time_formatted = Carbon::parse($assignment->close_time)->format('Y-m-d H:i');
                return $assignment;
            });

        return view('teacher.assignments.index', compact('assignments'));
    }

    public function create()
    {
        $teacher = auth()->user()->teacherProfile;
        $classess = $teacher->classes()->with('grade')->get();
        $grades = $classess->pluck('grade')->unique('id');

        return view('teacher.assignments.create', compact('classess', 'grades'));
    }
    public function getSectionsByGrade($gradeId)
    {
        $teacher = auth()->user()->teacherProfile;

        $sections = $teacher->classes()
            ->where('grade_id', $gradeId)
            ->with('grade')
            ->get()
            ->map(function ($class) {
                return [
                    'id' => $class->id,
                    'section' => $class->section,
                    'grade_name' => $class->grade->name,
                ];
            });

        return response()->json($sections);
    }


    public function store(Request $request)
    {
        $request->validate([
            'grade_id' => 'required|exists:grades,id',
            'class_ids' => 'required|array|min:1',
            'class_ids.*' => 'exists:class_profiles,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'fullmark' => 'required|integer|min:1',
            'open_time' => 'required|date',
            'close_time' => 'required|date|after:open_time',
            'status' => 'required|in:show,hide',
            'attachment' => 'nullable|file|max:10240', // max 10MB
        ]);

        $assignmentData = $request->only([
            'title',
            'description',
            'fullmark',
            'open_time',
            'close_time',
            'status'
        ]);

        $assignmentData['teacher_id'] = auth()->user()->teacherProfile->id;

        if ($request->hasFile('attachment')) {
            $assignmentData['attachment'] = $request->file('attachment')->store('assignments', 'public');
        }

        $assignment = Assignment::create($assignmentData);
        $assignment->classProfiles()->attach($request->class_ids);

        return redirect()->route('teacher.assignments.index')->with('success', 'Assignment created successfully.');
    }

    public function show($id)
    {
        $assignment = Assignment::with('classProfiles')->findOrFail($id);
        return view('teacher.assignments.show', compact('assignment'));
    }

    public function submissions(Request $request, $id)
    {
        $assignment = Assignment::with(['classProfiles', 'submissions.student.user'])->findOrFail($id);
        $classId = $request->get('class');

        if ($classId) {
            $class = ClassProfile::with(['grade', 'students.user'])->findOrFail($classId);
            $students = $class->students;

            $submissions = $assignment->submissions->filter(function ($submission) use ($classId) {
                return $submission->student && $submission->student->class_id == $classId;
            });
        } else {
            $students = collect();
            $submissions = collect();
            $class = null;
        }

        return view('teacher.assignments.submissions', compact(
            'assignment',
            'class',
            'students',
            'submissions',
            'classId'
        ));
    }

    public function updateMark(Request $request, $submissionId)
    {
        $submission = Submission::with('assignment')->findOrFail($submissionId);

        if (Carbon::now()->lt(Carbon::parse($submission->assignment->close_time))) {
            return redirect()->back()->with('error', 'You can only add marks after the assignment has closed.');
        }

        $request->validate([
            'mark' => 'required|integer|min:0|max:' . $submission->assignment->fullmark,
            'feedback' => 'nullable|string|max:2000',
        ]);

        $submission->mark = $request->mark;
        $submission->feedback = $request->feedback;
        $submission->save();

        return redirect()->back()->with('success', 'Mark and feedback saved successfully.');
    }

    public function edit($id)
    {
        $assignment = Assignment::with('classProfiles')->findOrFail($id);
        $assignment->open_time = Carbon::parse($assignment->open_time)->format('Y-m-d\TH:i');
        $assignment->close_time = Carbon::parse($assignment->close_time)->format('Y-m-d\TH:i');
        $classess = Auth::user()->teacherProfile->classes()->with('grade')->get();
        $grades = $classess->pluck('grade')->unique('id');

        return view('teacher.assignments.edit', compact('assignment', 'classess', 'grades'));
    }

    public function update(Request $request, $id)
    {
        $assignment = Assignment::findOrFail($id);

        $request->validate([
            'grade_id' => 'required|exists:grades,id',
            'class_ids' => 'required|array|min:1',
            'class_ids.*' => 'exists:class_profiles,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'open_time' => 'required|date',
            'close_time' => 'required|date|after:open_time',
            'status' => 'required|in:show,hide',
            'fullmark' => 'required|integer|min:0',
            'attachment' => 'nullable|file|max:10240',
        ]);

        $data = $request->only(['title', 'description', 'open_time', 'close_time', 'status', 'fullmark']);

        if ($request->hasFile('attachment')) {
            if ($assignment->attachment) {
                Storage::disk('public')->delete($assignment->attachment);
            }
            $data['attachment'] = $request->file('attachment')->store('assignments', 'public');
        }

        $assignment->update($data);
        $assignment->classProfiles()->sync($request->class_ids);

        return redirect()->route('teacher.assignments.index')->with('success', 'Assignment updated successfully.');
    }

    public function destroy($id)
    {
        $assignment = Assignment::findOrFail($id);

        if ($assignment->attachment) {
            Storage::disk('public')->delete($assignment->attachment);
        }

        $assignment->delete();

        return redirect()->route('teacher.assignments.index')->with('success', 'Assignment deleted successfully.');
    }
}
