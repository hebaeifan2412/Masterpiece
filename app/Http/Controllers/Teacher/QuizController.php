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
    public function index()
    {
        $teacherId = Auth::user()->teacherProfile->id;

        $quizzes = Quiz::where('teacher_id', $teacherId)
            ->with(['classProfile', 'questions.options'])
            ->get();

        $classes = Auth::user()->teacherProfile->classes()->with('grade')->get();

        return view('teacher.quizzes.index', compact('quizzes', 'classes'));
    }

    public function create()
    {
        $classes = Auth::user()->teacherProfile->classes()->with('grade')->get();
        return view('teacher.quizzes.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $teacherId = Auth::user()->teacherProfile->id;

        $request->validate([
            'class_id' => 'required|exists:class_profiles,id',
            'title' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'duration' => 'required|integer|min:1',
            'status' => 'required|in:show,hide',
        ]);

        Quiz::create([
            'teacher_id' => $teacherId,
            'class_id' => $request->class_id,
            'title' => $request->title,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'duration' => $request->duration,
            'number_of_questions' => 0,
            'status' => $request->status,
        ]);

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

        $quiz = Quiz::where('teacher_id', $teacherId)->findOrFail($id);
        $classes = Auth::user()->teacherProfile->classes()->with('grade')->get();

        return view('teacher.quizzes.edit', compact('quiz', 'classes'));
    }

    public function update(Request $request, $id)
    {
        $teacherId = Auth::user()->teacherProfile->id;

        $request->validate([
            'title' => 'required|string|max:255',
            'class_id' => 'required|exists:class_profiles,id',
            'duration' => 'required|integer|min:1',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'number_of_questions' => 'required|integer|min:1',
            'status' => 'required|in:show,hide',
        ]);

        $quiz = Quiz::where('teacher_id', $teacherId)->findOrFail($id);

        $quiz->update([
            'title' => $request->title,
            'class_id' => $request->class_id,
            'duration' => $request->duration,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'number_of_questions' => $request->number_of_questions,
            'status' => $request->status,
        ]);

        return redirect()->route('teacher.quizzes.index')->with('success', 'Quiz updated successfully.');
    }

    public function destroy($id)
    {
        $teacherId = Auth::user()->teacherProfile->id;

        $quiz = Quiz::where('teacher_id', $teacherId)->findOrFail($id);
        $quiz->delete();

        return redirect()->route('teacher.quizzes.index')->with('success', 'Quiz deleted successfully.');
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
