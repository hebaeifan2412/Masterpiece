<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassProfile;
use App\Models\Mark;
use App\Models\Subject;
use App\Models\TeacherProfile;
use Illuminate\Http\Request;

class MarkController extends Controller
{


public function index(Request $request)
{
    $classesWithQuizzes = ClassProfile::with([
        'grade',
        'quizzes.questions',
        'quizzes.marks',
        'quizzes.teacher.user', 
        'students.user',
        'students.marks'
    ])->get();

    return view('admin.marks.index', ['classess' => $classesWithQuizzes]);
}


}
