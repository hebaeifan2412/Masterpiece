<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\QuestionOption;
use Illuminate\Http\Request;

class QuestionOptionController extends Controller
{
    public function edit($questionId, $id)
    {
        $option = QuestionOption::where('quiz_question_id', $questionId)->findOrFail($id);
        return view('teacher.questions.options.edit', compact('option'));
    }

    public function update(Request $request, $questionId, $id)
    {
        $request->validate([
            'option_text' => 'required|string',
            'is_correct' => 'nullable|boolean',
        ]);

        $option = QuestionOption::where('quiz_question_id', $questionId)->findOrFail($id);
        $option->update([
            'option_text' => $request->option_text,
            'is_correct' => $request->has('is_correct'),
        ]);

        return redirect()->route('teacher.quizzes.questions.show', $questionId)->with('success', 'Option updated successfully.');
    }

    public function destroy($questionId, $id)
    {
        $option = QuestionOption::where('quiz_question_id', $questionId)->findOrFail($id);
        $option->delete();

        return redirect()->route('teacher.quizzes.questions.show', $questionId)->with('success', 'Option deleted.');
    }
}
