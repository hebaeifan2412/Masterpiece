<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\TeacherProfile;
use App\Models\ClassProfile;


class HomeController extends Controller
{

public function index()
{
    $studentsCount = Student::count();
    $teachersCount = TeacherProfile::count();
    $classesCount = ClassProfile::count();
    $featuredTeachers = TeacherProfile::with('user')->take(3)->get();


    return view('welcome', compact('studentsCount', 'teachersCount', 'classesCount' , 'featuredTeachers'));
}

}
