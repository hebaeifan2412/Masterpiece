<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
   

        $adminRole = Role::where('name', 'admin')->first();
        User::create([
            'firstname' => 'Heba',
            'secname' => 'Qasim',
            'thirdname' => 'Mohammad',
            'lastname' => 'Aleifan',
            'image' => '',
            'email' => 'hebaeifan@numaschool.com',
            'phone_no' => '+962790000000',
            'password' => Hash::make('hebaeifan'),
            'role_id' => $adminRole->id,
            'status' => 'active',
        ]);
    
    }
}