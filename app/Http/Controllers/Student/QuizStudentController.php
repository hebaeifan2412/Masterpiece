<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Quiz, StudentQuizAnswer, QuestionOption, Mark};
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class QuizStudentController extends Controller
{
    public function index()
    {
        $now =  Carbon::now();
        $student = Auth::user()->student;

        $classId = $student->class_id;
$quizzes = Quiz::where('status', 'show')
    ->whereHas('classes', function ($query) use ($classId) {
        $query->where('class_profile_id', $classId);
    })
    ->with(['classes.grade', 'teacher.subject' , 'teacher.user']) 
    ->get();

        return view('student.quiz.index', compact('quizzes', 'now'));
    }

    public function show($id)
    {
        $quiz = Quiz::with(['questions.options'])->findOrFail($id);
        $now = Carbon::now();

        if (
            $quiz->status !== 'show' ||
            $now->lt($quiz->start_time) ||
            $now->gt($quiz->end_time)
        ) {
            return redirect()->route('student.quizzes.index')
                ->with('error', 'Quiz not available at this time.');
        }

        return view('student.quiz.show', compact('quiz'));
    }

    public function submit(Request $request, $quizId)
    {
        $student = Auth::user()->student;
        $quiz = Quiz::with('questions.options')->findOrFail($quizId);

        $score = 0;

        foreach ($quiz->questions as $question) {
            $selectedOptionId = $request->input("question_{$question->id}");
            $selectedOption = QuestionOption::find($selectedOptionId);

            if (!$selectedOption) continue;

            $isCorrect = $selectedOption->is_correct;

            StudentQuizAnswer::updateOrCreate([
                'quiz_id' => $quiz->id,
                'student_id' => $student->national_id,
                'quiz_question_id' => $question->id,
            ], [
                'selected_option_id' => $selectedOptionId,
                'is_correct' => $isCorrect,
            ]);

            if ($isCorrect) {
                $score++;
            }
        }

        Mark::updateOrCreate([
            'quiz_id' => $quiz->id,
            'student_id' => $student->national_id,
        ], [
            'marks' => $score,
        ]);

        return redirect()->route('student.quizzes.results', $quiz->id)
            ->with('success', 'Quiz submitted successfully.');
    }

    public function result($quizId)
    {
        $student = Auth::user()->student;
        $quiz = Quiz::with('questions.options')->findOrFail($quizId);

        $answers = StudentQuizAnswer::where('quiz_id', $quizId)
            ->where('student_id', $student->national_id)
            ->get();

        $mark = Mark::where('quiz_id', $quizId)
            ->where('student_id', $student->national_id)
            ->first();

        return view('student.quiz.result', compact('quiz', 'answers', 'mark'));
    }
}
