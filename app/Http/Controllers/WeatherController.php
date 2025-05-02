<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function showWeather()
    {
        
    
        return view('admin.home', compact('temperature', 'cityName', 'countryName'));
    }
}
