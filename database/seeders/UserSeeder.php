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
        $faker = Faker::create();

        $adminRole = Role::where('name', 'admin')->first();
        User::create([
            'firstname' => 'Heba',
            'secname' => 'Aifan',
            'thirdname' => 'Mohammad',
            'lastname' => 'Aleifan',
            'image' => '',
            'email' => 'hebaeifan@admin.com',
            'phone_no' => '+962790000000',
            'password' => Hash::make('hebaeifan'),
            'role_id' => $adminRole->id,
            'status' => 'active',
        ]);
    
    }
}