<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\TeacherProfile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $subjects = Subject::pluck('id')->toArray(); 

        $teachers = [
            ['firstname' => 'Ahmad', 'secname' => 'Mohammad', 'thirdname' => 'Saeed', 'lastname' => 'Alzahrani', 'gender' => 'male'],
            ['firstname' => 'Sara', 'secname' => 'Khaled', 'thirdname' => 'Mahmoud', 'lastname' => 'Alanzi', 'gender' => 'female'],
            ['firstname' => 'Yousef', 'secname' => 'Abdullah', 'thirdname' => 'Naser', 'lastname' => 'Alghamdi', 'gender' => 'male'],
            ['firstname' => 'Maha', 'secname' => 'Salem', 'thirdname' => 'Ali', 'lastname' => 'Alshareef', 'gender' => 'female'],
            ['firstname' => 'Omar', 'secname' => 'Saeed', 'thirdname' => 'Ahmad', 'lastname' => 'Alqurashi', 'gender' => 'male'],
            ['firstname' => 'Rana', 'secname' => 'Abdulaziz', 'thirdname' => 'Khaled', 'lastname' => 'Alharbi', 'gender' => 'female'],
            ['firstname' => 'Khaled', 'secname' => 'Salman', 'thirdname' => 'Fahad', 'lastname' => 'Alshahri', 'gender' => 'male'],
            ['firstname' => 'Noor', 'secname' => 'Badr', 'thirdname' => 'Majed', 'lastname' => 'Alotaibi', 'gender' => 'female'],
            ['firstname' => 'Abdulrahman', 'secname' => 'Turki', 'thirdname' => 'Saud', 'lastname' => 'Alomar', 'gender' => 'male'],
            ['firstname' => 'Lina', 'secname' => 'Faisal', 'thirdname' => 'Tariq', 'lastname' => 'Alnasser', 'gender' => 'female'],
        ];
    
        foreach ($teachers as $index => $teacher) {
            $user = User::create([
                'firstname' => $teacher['firstname'],
                'secname' => $teacher['secname'],
                'thirdname' => $teacher['thirdname'],
                'lastname' => $teacher['lastname'],
                'email' => strtolower($teacher['firstname']) . $index . '@schoolmind.com',
                'phone_no' => '079' . str_pad($index + 1000, 7, '0', STR_PAD_LEFT),
                'password' => Hash::make('Password123'),
                'image' => 'users/default.jpg',
                'role_id' => 3, // Assuming 3 = Teacher
            ]);
    
            TeacherProfile::create([
                'user_id' => $user->id,
                'qualification' => 'Bachelor of Education',
                'dob' => now()->subYears(rand(28, 40))->subDays($index * 10),
                'subject_id' => $subjects[array_rand($subjects)],
                'gender' => $teacher['gender'],
                'address' => 'Amman - Street ' . ($index + 1),
                'joining_date' => now()->subYears(rand(3, 7)),
                'leave_date' => now()->addYears(2),
            ]);
        }
    }
}    