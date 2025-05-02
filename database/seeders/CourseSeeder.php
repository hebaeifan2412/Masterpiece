<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Subject;
use App\Models\TeacherProfile;
use App\Models\ClassProfile;
use App\Models\Grade;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $subjects = Subject::all();      
        $teachers = TeacherProfile::all(); 
        $classes = ClassProfile::with('grade')->get();

        $teacherSubjectMap = [
            0 => [0], // Ahmad => Mathematics
            1 => [1], // Sara => English
            2 => [2], // Yousef => Chemistry
            3 => [3], // Maha => Biology
            4 => [4], // Omar => Arabic
            5 => [5], // Rana => Physics
            6 => [6], // Khaled => Computer Science
            7 => [7,8], // Noor => History, Geography
            8 => [11], // Abdulrahman => Islamic Education
            9 => [9, 10], // Lina => Earth and Environmental Science + Science
        ];
        foreach ($teacherSubjectMap as $teacherIndex => $subjectIndices) {
            $teacher = $teachers[$teacherIndex];
        
            foreach ($subjectIndices as $subjectIndex) {
                $subject = $subjects[$subjectIndex];
        
                foreach ($classes->random(3) as $class) {
                    Course::create([
                        'subject_id'  => $subject->id,
                        'teacher_id'  => $teacher->id,
                        'class_id'    => $class->id,
                    ]);
                }
            }
        }
        
    }
}
