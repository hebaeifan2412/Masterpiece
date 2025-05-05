<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\ClassProfile;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;


class AssignmentController extends Controller
{
    public function index()
    {
        $teacherId = Auth::user()->teacherProfile->id;
        $assignments = Assignment::where('teacher_id', $teacherId)
            ->with('classProfile')
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
        $classess = Auth::user()->teacherProfile->classes()->with('grade')->get();
        return view('teacher.assignments.create', compact('classess'));
    }

    public function store(Request $request)
    {
        $teacherId = Auth::user()->teacherProfile->id;

        $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'open_time'        => 'required|date',
            'close_time'       => 'required|date|after:open_time',
            'status'           => 'required|in:show,hide',
            'classes_display'  => 'required|array|min:1',
            'classes_display.*'=> 'exists:class_profiles,id',
        ]);

        $assignment = Assignment::create([
            'class_id' =>$request->class_id,
            'teacher_id'  => $teacherId,
            'title'       => $request->title,
            'description' => $request->description,
            'open_time'   => $request->open_time,
            'close_time'  => $request->close_time,
            'status'      => $request->status,
        ]);

        // ربط الواجب بالصفوف المختارة
        $assignment->classProfiles()->attach($request->classes_display);

        return redirect()->route('teacher.assignments.index')
                         ->with('success', 'Assignment created successfully.');
    }

    public function show($id)
    {
        $assignment = Assignment::with('classProfile')->findOrFail($id);
        return view('teacher.assignments.show', compact('assignment'));
    }

    public function submissions($id)
    {
        $assignment = Assignment::with([
            'classProfile',
            'submissions' => function ($q) {
                $q->with('student.user');
            }
        ])->findOrFail($id);
        
    
        return view('teacher.assignments.submissions', compact('assignment'));
    }
    
    public function updateMark(Request $request, $submissionId)
    {
        $request->validate([
            'mark' => 'required|integer|min:0|max:100',
            'feedback' => 'nullable|string|max:2000',
        ]);
    
        $submission = Submission::findOrFail($submissionId);
        $submission->mark = $request->mark;
        $submission->feedback = $request->feedback;
        $submission->save();
    
        return redirect()->back()->with('success', 'Mark and feedback saved successfully.');
    }
    

    public function edit($id)
    {
        $assignment = Assignment::findOrFail($id);
        $assignment->open_time = Carbon::parse($assignment->open_time)->format('Y-m-d\TH:i');
        $assignment->close_time =Carbon::parse($assignment->close_time)->format('Y-m-d\TH:i');
        $classess = Auth::user()->teacherProfile->classes()->with('grade')->get();
        return view('teacher.assignments.edit', compact('assignment', 'classess'));
    }

    public function update(Request $request, $id)
    {
        $assignment = Assignment::findOrFail($id);

        $request->validate([
            'class_id' => 'required|exists:class_profiles,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'open_time'    => 'required|date',
            'close_time'   => 'required|date|after:open_time',
            'status' => 'required|in:show,hide'
        ]);

        $assignment->update([
            'class_id' => $request->class_id,
            'title' => $request->title,
            'description' => $request->description,
            'open_time'   => $request->open_time,
            'close_time'  => $request->close_time,
            'status' => $request->status,
        ]);

        return redirect()->route('teacher.assignments.index')->with('success', 'Assignment updated successfully.');
    }

    public function destroy($id)
    {
        $assignment = Assignment::findOrFail($id);
        $assignment->delete();

        return redirect()->route('teacher.assignments.index')->with('success', 'Assignment deleted successfully.');
    }
}