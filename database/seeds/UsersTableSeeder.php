<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create();

        foreach (range(1,10) as $index) {

        User::create([
 			
 			'unique_id'	=> uniqid(base64_encode(str_random(60))), 

            'name'	=>  $faker->firstNameMale,

            'email'	=>  $faker->email,

            'password' => bcrypt('naveen123'),

            'description'	=>  $faker->city,

            'gender'	=>  'male',

            'mobile'	=>  $faker->phoneNumber,
        ]);

    }
    }
}
