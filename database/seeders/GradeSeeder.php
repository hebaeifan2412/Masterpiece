<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
public function run()
{
    for ($i = 1; $i <= 10; $i++) {
        Grade::create(['name' => 'Grade ' . $i]);
    }
}

}
