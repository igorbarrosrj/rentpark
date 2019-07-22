<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        User::create([
 			
 			'unique_id'	=> uniqid(base64_encode(str_random(60))), 

            'name'	=>  $faker->firstNameMale,

            'email'	=>  $faker->email,

            'password' => \Hash::make('123456'),

            'description'	=>  $faker->city,

            'gender'	=>  'male',

            'mobile'	=>  $faker->phoneNumber,
        ]);

        
    }
}
