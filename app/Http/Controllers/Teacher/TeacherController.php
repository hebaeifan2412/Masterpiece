<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\ClassProfile;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\Student;
use App\Models\Subject;
use App\Models\TeacherProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class TeacherController extends Controller
{
    public function __construct()
    {
        // Require auth and teacher role for all actions in this controller
        $this->middleware(['auth', 'role:teacher']);
    }

    public function index()
{
    $user = Auth::user();

    $city = 'Amman';
    $country = 'Jordan';
    $apiKey = '36ad6264e7b8d37843a4a31e30dc0437';

    $url = "https://api.openweathermap.org/data/2.5/weather?q={$city},{$country}&appid={$apiKey}&units=metric";

    $response = Http::get($url);
    $data = $response->json();

    $temperature = $data['main']['temp'] ?? 'N/A';
    $cityName = $data['name'] ?? $city;
    $countryName = $country;
    $icon = $data['weather'][0]['icon'] ?? null;
    $iconUrl = $icon ? "http://openweathermap.org/img/wn/{$icon}@2x.png" : null;

     $teacherProfile = $user->teacherProfile;

     $classes = $teacherProfile->classes()->with('students')->get();
 
     $Classcount = $classes->count();
     $quizzesCount = Quiz::where('teacher_id', $teacherProfile->id)->count();
 $subjectName =  $teacherProfile->subject->name;
     $studentsCount = $classes->sum(function ($class) {
         return $class->students->count();
     });
 
     return view('teacher.home', compact(
         'temperature', 
         'cityName', 
         'countryName', 
         'iconUrl',
         'Classcount',
         'quizzesCount',
         'studentsCount',
         'classes',
         'user',
         'subjectName'
     ));
 }}
