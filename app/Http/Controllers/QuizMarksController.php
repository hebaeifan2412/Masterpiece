<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use Illuminate\Http\Request;

class QuizMarksController extends Controller
{
    public function store(Request $request)
    {
        // Store student's marks for a quiz
        $mark = Mark::create([
            'student_id' => $request->student_id,
            'quiz_id' => $request->quiz_id,
            'marks' => $request->marks,
        ]);
        return response()->json($mark, 201);
    }

    public function show($studentId)
    {
        // Get all marks for a specific student
        $marks = Mark::where('student_id', $studentId)->get();
        return response()->json($marks);
    }
}
