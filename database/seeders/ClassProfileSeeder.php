<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassProfile;
use App\Models\Grade;  

class ClassProfileSeeder extends Seeder
{
    public function run()
    {

        $grades = Grade::all(); 

        foreach ($grades as $grade) {
            foreach (['A', 'B', 'C'] as $section) {
                ClassProfile::create([
                    'grade_id' => $grade->id,
                    'section' => $section,
                    'capacity' => 20, 
                ]);
            }
        }

       
    }
}

