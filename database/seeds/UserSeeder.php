<?php

use Illuminate\Database\Seeder;

use App\User;

use App\Helpers\Helper;

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
            'name' => $faker->firstNameMale,
            'email'	=>  $faker->email,
            'password' => \Hash::make('123456'),
            'description' => $faker->city,
            'gender' => 'male',
            'mobile' => $faker->phoneNumber,
            'token' => Helper::generate_token(),
            'token_expiry' => Helper::generate_token_expiry(),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);        
    }
}
