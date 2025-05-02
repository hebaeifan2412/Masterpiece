<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $subjects = [
            'Mathematics',
            'Physics',
            'Chemistry',
            'Biology',
            'English',
            'Arabic',
            'Computer Science',
            'History',
            'Geography',
            'Earth and Environmental Science ',
            'Science',
            'Islamic Education'
        ];

        foreach ($subjects as $index => $name) {
            Subject::create([
                'name' => $name,
                'code' => 'SUB' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),                
            ]);
        }
    }
}
