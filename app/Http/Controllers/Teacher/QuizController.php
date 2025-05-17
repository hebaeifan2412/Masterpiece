<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class QuizController extends Controller
{
    private function quizHasStarted($quiz)
    {
        return now()->greaterThanOrEqualTo($quiz->start_time);
    }
    public function index()
    {
        $teacherId = Auth::user()->teacherProfile->id;

        $quizzes = Quiz::where('teacher_id', $teacherId)
            ->with(['classes', 'questions.options'])
            ->get();
        $classess = auth()->user()->teacherProfile->classes()->with('grade')->get();
        $grades = $classess->pluck('grade')->unique('id');

        return view('teacher.quizzes.index', compact('quizzes', 'classess', 'grades'));
    }

    public function create()
    {
        $classess = Auth::user()->teacherProfile->classes()->with('grade')->get();
        $grades = $classess->pluck('grade')->unique('id');

        return view('teacher.quizzes.create', compact('classess', 'grades'));
    }

    public function store(Request $request)
    {
        $teacherId = Auth::user()->teacherProfile->id;

        $quiz_date = $request->input('quiz_date');
        $start_hour = $request->input('start_hour');
        $end_hour = $request->input('end_hour');

        $start_time = "{$quiz_date} {$start_hour}";
        $end_time = "{$quiz_date} {$end_hour}";

        $request->merge([
            'start_time' => $start_time,
            'end_time' => $end_time,
        ]);

        $request->validate([
            'class_ids' => 'required|array',
            'class_ids.*' => 'exists:class_profiles,id',
            'title' => 'required|string|max:255',
            'quiz_date' => 'required|date|after_or_equal:today',
            'start_hour' => 'required|date_format:H:i',
            'end_hour' => 'required|date_format:H:i|after:start_hour',
            'duration' => 'required|integer|min:1',
            'status' => 'required|in:show,hide',
        ]);

        $startDateTime = Carbon::parse("$quiz_date $start_hour");

        if (Carbon::parse($quiz_date)->isToday() && $startDateTime->lt(now())) {
            return back()->withErrors([
                'start_hour' => 'Start time must be in the future if quiz date is today.'
            ])->withInput();
        }
        $quiz = Quiz::create([
            'teacher_id' => $teacherId,
            'title' => $request->title,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'duration' => $request->duration,
            'number_of_questions' => 0,
            'status' => $request->status,
        ]);

        $quiz->classes()->attach($request->class_ids);

        return redirect()->route('teacher.quizzes.index')->with('success', 'Quiz created successfully.');
    }

    public function show($quizId)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($quizId);
        return view('teacher.quizzes.questions.show', compact('quiz'));
    }

    public function edit($id)
    {
        $teacherId = Auth::user()->teacherProfile->id;
        
  $quiz = Quiz::where('teacher_id', $teacherId)
        ->with('classes.grade')
        ->findOrFail($id);

    $gradeIds = $quiz->classes->pluck('grade_id')->unique();

    $classess = Auth::user()->teacherProfile->classes()
        ->whereIn('grade_id', $gradeIds)
        ->with('grade')
        ->get();

        // $quiz = Quiz::where('teacher_id', $teacherId)
        //     ->with('classes')
        //     ->findOrFail($id);

        // if ($this->quizHasStarted($quiz)) {
        //     return redirect()->route('teacher.quizzes.index')
        //         ->withErrors(['edit' => 'You cannot edit a quiz after it has started.']);
        // }
      // $classess = Auth::user()->teacherProfile->classes()->with('grade')->get();

        return view('teacher.quizzes.edit', compact('quiz', 'classess'));
    }
    public function update(Request $request, $id)
    {
        $teacherId = Auth::user()->teacherProfile->id;

        $quiz_date = $request->input('quiz_date');
        $start_hour = $request->input('start_hour');
        $end_hour = $request->input('end_hour');

        $start_time = "{$quiz_date} {$start_hour}";
        $end_time = "{$quiz_date} {$end_hour}";

        $request->merge([
            'start_time' => $start_time,
            'end_time' => $end_time,
        ]);
        $request->validate([
            'title' => 'required|string|max:255',
            'class_ids' => 'required|array',
            'class_ids.*' => 'exists:class_profiles,id',
            'duration' => 'required|integer|min:1',
            'quiz_date' => 'required|date|after_or_equal:today',
            'start_hour' => 'required|date_format:H:i',
            'end_hour' => 'required|date_format:H:i|after:start_hour',

            'status' => 'required|in:show,hide',
        ]);

        $startDateTime = Carbon::parse("$quiz_date $start_hour");

        if (Carbon::parse($quiz_date)->isToday() && $startDateTime->lt(now())) {
            return back()->withErrors([
                'start_hour' => 'Start time must be in the future if quiz date is today.'
            ])->withInput();
        }
        $quiz = Quiz::where('teacher_id', $teacherId)->findOrFail($id);

        $quiz->update([
            'title' => $request->title,
            'duration' => $request->duration,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,

            'status' => $request->status,
        ]);

        // Sync classes
        $quiz->classes()->sync($request->class_ids);

        return redirect()->route('teacher.quizzes.index')->with('success', 'Quiz updated successfully.');
    }

    public function destroy($id)
    {
        $teacherId = Auth::user()->teacherProfile->id;

        $quiz = Quiz::where('teacher_id', $teacherId)->findOrFail($id);

        if ($this->quizHasStarted($quiz)) {
            return redirect()->route('teacher.quizzes.index')
                ->withErrors(['delete' => 'You cannot delete a quiz after it has started.']);
        }

        $quiz->delete();

        return redirect()->route('teacher.quizzes.index')->with('success', 'Quiz deleted successfully.');
    }

    public function getSectionsByGrade($gradeId)
    {
        $teacher = auth()->user()->teacherProfile;

        $sections = $teacher->classes()
            ->with('grade')
            ->whereHas('grade', function ($query) use ($gradeId) {
                $query->where('id', $gradeId);
            })
            ->get()
            ->map(function ($class) {
                return [
                    'id' => $class->id,
                    'grade' => $class->grade->name,
                    'section' => $class->section
                ];
            });

        return response()->json($sections);
    }


    public function startQuiz($id)
    {
        $teacherId = Auth::user()->teacherProfile->id;

        $quiz = Quiz::where('teacher_id', $teacherId)->findOrFail($id);

        if (Carbon::now()->between($quiz->start_time, $quiz->end_time)) {
            return redirect()->route('teacher.quizzes.show', $id)->with('info', 'Quiz is active now.');
        }

        return redirect()->route('teacher.quizzes.index')->with('error', 'Quiz is not available yet or already closed.');
    }

    public function closeQuiz($id)
    {
        $teacherId = Auth::user()->teacherProfile->id;

        $quiz = Quiz::where('teacher_id', $teacherId)->findOrFail($id);

        if (Carbon::now()->gt($quiz->end_time)) {
            return redirect()->route('teacher.quizzes.index')->with('info', 'Quiz has ended.');
        }

        return redirect()->route('teacher.quizzes.index')->with('warning', 'Quiz is still open.');
    }
}
