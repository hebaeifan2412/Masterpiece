<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\TeacherProfile;
use App\Models\Student;
use App\Models\ClassProfile;
use App\Models\Subject;
use App\Models\User;
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
        $icon = $data['weather'][0]['icon'] ?? null; // التصحيح هون
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
    
    
}
