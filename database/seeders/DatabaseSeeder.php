<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(ClassProfileSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TeacherProfileSeeder::class);
       // $this->call( CourseSeeder::class);
        $this->call(StudentSeeder::class);


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
