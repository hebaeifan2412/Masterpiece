<?php

namespace App\Http\Controllers;

use App\Models\QuestionOption;
use App\Models\StudentQuizAnswer;
use Illuminate\Http\Request;

class StudentQuizAnswerController extends Controller
{
    public function store(Request $request)
    {
        $selectedOption = QuestionOption::find($request->selected_option);
    
        if (!$selectedOption) {
            return response()->json(['message' => 'Invalid selected option.'], 422);
        }
    
        $isCorrect = $selectedOption->is_correct;
    
        $answer = StudentQuizAnswer::create([
            'quiz_id' => $request->quiz_id,
            'student_id' => $request->student_id,
            'quiz_question_id' => $request->quiz_question_id,
            'selected_option_id' => $selectedOption->id,
            'is_correct' => $selectedOption->is_correct,
        ]);
    
        return response()->json([
            'message' => 'Answer submitted successfully.',
            'data' => $answer
        ], 201);
    }
    
    public function show($studentId, $quizId)
    {
        // Get all answers for a specific student in a quiz
        $answers = StudentQuizAnswer::where('student_id', $studentId)
                                    ->where('quiz_id', $quizId)
                                    ->get();
        return response()->json($answers);
    }
}
