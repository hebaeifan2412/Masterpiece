<?php

namespace Database\Seeders;

use App\Models\ClassProfile;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $targetClasses = [
            ['grade' => 'Grade 1', 'section' => 'A'],
            ['grade' => 'Grade 1', 'section' => 'B'],
            ['grade' => 'Grade 2', 'section' => 'A'],
        ];

        $firstNames = ['Ahmad', 'Yousef', 'Omar', 'Khaled', 'Rami', 'Tariq', 'Lina', 'Sara', 'Mona', 'Noor'];
        $lastNames = ['Al-Fayez', 'Al-Momani', 'Al-Zoubi', 'Al-Kilani', 'Al-Hadidi', 'Al-Dabbas', 'Al-Khatib', 'Al-Shawabkeh'];
        $studentCounter = 1;

        $targetClassProfiles = ClassProfile::with('grade')
            ->whereHas('grade', function ($q) use ($targetClasses) {
                $q->whereIn('name', array_column($targetClasses, 'grade'));
            })
            ->get()
            ->filter(function ($class) use ($targetClasses) {
                foreach ($targetClasses as $target) {
                    if ($class->grade->name === $target['grade'] && $class->section === $target['section']) {
                        return true;
                    }
                }
                return false;
            });

        foreach ($targetClassProfiles as $class) {
            for ($i = 0; $i < 15; $i++) {
                $firstname = $firstNames[array_rand($firstNames)];
                $lastname = $lastNames[array_rand($lastNames)];
                $baseEmail = strtolower($firstname) . strtolower($lastname) . '@numaschool.com';
                $email = $baseEmail;
                $counter = 1;

                while (User::where('email', $email)->exists()) {
                    $email = strtolower($firstname) . strtolower($lastname) . $counter . '@numaschool.com';
                    $counter++;
                }

                $user = User::create([
                    'firstname' => $firstname,
                    'secname' => 'Mohammad',
                    'thirdname' => 'Ali',
                    'lastname' => $lastname,
                    'email' => $email,
                    'phone_no' => '078' . random_int(1000000, 9999999),
                    'password' => Hash::make('Password123'),
                    'image' => '',
                    'role_id' => 2,
                ]);

                Student::create([
                    'user_id' => $user->id,
                    'national_id' => '2000' . str_pad($studentCounter, 5, '0', STR_PAD_LEFT),
                    'class_id' => $class->id,
                    'date_of_birth' => $this->calculateDOB($class->grade->name),
                    'address' => 'Al-Salt',
                    'gender' => $i % 2 == 0 ? 'male' : 'female',
                    'father_phone' => '077' . random_int(1000000, 9999999),
                    'mother_phone' => '078' . random_int(1000000, 9999999),
                    'mother_name' => 'Mother ' . $firstname,
                ]);

                $studentCounter++;
            }
        }
    }

    private function calculateDOB($gradeName)
    {
        $gradeAge = [
            'Grade 1' => 6,
            'Grade 2' => 7,
            'Grade 3' => 8,
            'Grade 4' => 9,
            'Grade 5' => 10,
            'Grade 6' => 11,
            'Grade 7' => 12,
            'Grade 8' => 13,
            'Grade 9' => 14,
            'Grade 10' => 15,
        ];

        $age = $gradeAge[$gradeName] ?? 10;

        return now()->subYears($age)->subMonths(random_int(0, 11))->subDays(random_int(0, 30));
    }
}
