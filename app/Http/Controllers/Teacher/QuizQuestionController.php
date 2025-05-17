<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Mark;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuestionOption;
use App\Models\StudentQuizAnswer;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    private function quizHasStarted($quiz)
    {
        return now()->greaterThanOrEqualTo($quiz->start_time);
    }

    public function index(Quiz $quiz)
    {
        // Eager load the questions and options to avoid N+1 queries
        $quiz->load('questions.options');

        return view('teacher.quizzes.questions.index', compact('quiz'));
    }
    public function store(Request $request, $quizId)
    {
        $request->validate([
            'question' => 'required|string',
            'options' => 'required|array|size:4', // Ensure there are exactly 4 options
            'correct_index' => 'required|integer|between:0,3', // Correct answer index (0-3)
        ]);

        // Ensure the quiz exists
        $quiz = Quiz::findOrFail($quizId);
        if ($this->quizHasStarted($quiz)) {
            return redirect()->back()->with('error', 'You cannot add questions after the quiz has started.');
        }
        // Create the quiz question
        $question = QuizQuestion::create([
            'quiz_id' => $quizId,
            'question' => $request->question,
        ]);

        // Create options for the question
        foreach ($request->options as $index => $optionText) {
            $question->options()->create([
                'option_text' => $optionText,
                'is_correct' => $index == $request->correct_index, // Mark the correct option
            ]);
        }

        // Update number of questions in the quiz
        $quiz->increment('number_of_questions');

        return redirect()->route('teacher.quizzes.questions.index', $quizId)->with('success', 'Question added successfully.');
    }
    public function edit(Quiz $quiz, QuizQuestion $question)
    {
        // Optional: Ensure the question belongs to the quiz (to prevent route tampering)
        if ($question->quiz_id !== $quiz->id) {
            abort(404, 'Question does not belong to this quiz.');
        }

        return view('teacher.quizzes.questions.edit', compact('quiz', 'question'));
    }

  public function update(Request $request, $quizId, $questionId)
{
    $request->validate([
        'question' => 'required|string',
        'options' => 'required|array|size:4',
        'correct_option_id' => 'required|exists:question_options,id',
    ]);

    $question = QuizQuestion::findOrFail($questionId);
    $question->update(['question' => $request->question]);

    // ✅ تحديث خيارات السؤال
    foreach ($request->options as $optionId => $text) {
        $question->options()->where('id', $optionId)->update([
            'option_text' => $text,
            'is_correct' => ($optionId == $request->correct_option_id),
        ]);
    }

    // ✅ إعادة تقييم إجابات الطلاب لهذا الكويز
    $quiz = $question->quiz; // يجب أن تكون العلاقة معرفة في QuizQuestion.php

    $studentIds = StudentQuizAnswer::where('quiz_id', $quizId)
                    ->pluck('student_id')->unique();

    foreach ($studentIds as $studentId) {
        $correctCount = 0;

        foreach ($quiz->questions as $q) {
            $studentAnswer = StudentQuizAnswer::where('student_id', $studentId)
                                ->where('quiz_question_id', $q->id)
                                ->first();

            if (!$studentAnswer) continue;

            $selectedOption = $q->options->where('id', $studentAnswer->selected_option_id)->first();
            if ($selectedOption && $selectedOption->is_correct) {
                $correctCount++;
            }
        }
Mark::updateOrCreate(
            ['student_id' => $studentId, 'quiz_id' => $quizId],
            ['marks' => $correctCount]
        );
    }

    return redirect()->route('teacher.quizzes.questions.index', $quizId)
        ->with('success', 'Question and answers updated. Student marks recalculated.');
}


    public function show($id)
    {
        // Load the question with its options
        $question = QuizQuestion::with('options')->findOrFail($id);

        return view('teacher.quizzes.questions.show', compact('question'));
    }
   public function destroy($quizId, $id)
{
    $quiz = Quiz::findOrFail($quizId);
    $question = QuizQuestion::findOrFail($id);

    if ($this->quizHasStarted($quiz)) {
return redirect()->back()->withErrors(['delete' => 'You cannot delete questions after the quiz has started.']);
    }

    // Delete the question
    $question->delete();

    // Update the number of questions in the quiz
    $quiz->decrement('number_of_questions');

    return redirect()->route('teacher.quizzes.questions.index', $quizId)->with('success', 'Question deleted successfully.');
}

}
