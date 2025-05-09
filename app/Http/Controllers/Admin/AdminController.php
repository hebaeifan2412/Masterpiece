<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\TeacherProfile;
use App\Models\Student;
use App\Models\ClassProfile;
use App\Models\Subject;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    public function __construct()
    {
        // Require auth and admin role for all actions in this controller
        $this->middleware(['auth', 'role:admin']);
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
    
        // Get temperature and weather icon
        $temperature = $data['main']['temp'] ?? 'N/A';
        $cityName = $data['name'] ?? $city;
        $countryName = $country;
        $icon = $data['weather'][0]['icon'] ?? null;  
        $iconUrl = $icon ? "http://openweathermap.org/img/wn/{$icon}@2x.png" : null;
    
        // Fetch data from the database
        $teachersCount = TeacherProfile::count();
        $studentsCount = Student::count();
        $classesCount = ClassProfile::count();
        $subjectsCount = Subject::count();
    
        return view('admin.home', compact(
            'temperature',
            'cityName',
            'countryName',
            'iconUrl',
            'teachersCount',
            'studentsCount',
            'classesCount',
            'subjectsCount',
            'user'
        ));
        
    }
    
public function genderChartData()
{
    $genderCounts = Student::selectRaw('gender, COUNT(*) as count')
        ->groupBy('gender')
        ->pluck('count', 'gender');

    return response()->json([
        'labels' => $genderCounts->keys(),
        'values' => $genderCounts->values(),
    ]);
}

public function studentCountByGrade()
{
    $grades = Grade::withCount(['classProfiles as student_count' => function ($query) {
        $query->join('students', 'class_profiles.id', '=', 'students.class_id');
    }])->get();

    $labels = $grades->pluck('name');
    $counts = $grades->pluck('student_count');

    return response()->json([
        'labels' => $labels,
        'data' => $counts,
    ]);
}
}
