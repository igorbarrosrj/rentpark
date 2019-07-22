<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 3; $i++) { 

	    	Admin::create([

	            'name' => str_random(8),

	            'email' => str_random(12).'@gmail.com',

	            'password' => bcrypt('naveen123')

	        ]);

    	}
    }
}
