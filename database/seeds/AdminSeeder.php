<?php

use Illuminate\Database\Seeder;

use App\Admin;

use App\Helpers\Helper;

class AdminSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        DB::table('admins')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@rentpark.com',
                'password' => \Hash::make('123456'),
                'picture' => env('APP_URL')."/placeholder.jpg",
                'status' => APPROVED,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
