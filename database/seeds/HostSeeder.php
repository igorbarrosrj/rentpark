<?php

use Illuminate\Database\Seeder;
use App\Host;

class HostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('hosts')->insert([

            [
            	'host_name' => 'Codegama',

            	'provider_id' => 1,

            	'host_type' => 'driveway',

            	'description' => 'This is the complex',

            	'service_location_id' => 1,

            	'total_spaces' => 4,

            	'full_address' => 'Wipro Gate',

            	'per_hour' => 5,

            	'is_admin_verified' => 1,

            	'admin_status' => 0,

            	'status' => 1,

            	'uploaded_by' => 'admin',
              
            ]
        ]);
    }
}
