<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'admin', 'slug' => 'admin'],
            ['name' => 'student', 'slug' => 'student'],
            ['name' => 'teacher', 'slug' => 'teacher'],
        ]);
    }
}
