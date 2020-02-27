<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::insert([
    		[
    			'name' => 'Bangladesh University',
    			'FI' => '601',
    			'identity' => '1',
    			'abbreviation' => 'BU',
    			'area' => 'Dhaka',
    			'address' => 'House no. 32, Road no. 14, Rupnagar Residential Area, Mirpur-2, Dhaka 1216',
    			'email' => 'ahf@gmail.com',
    			'password' => bcrypt(123),
    			'owner' => 'Mr ABC',
    			'owner_phone' => '12345',
    			'inst_phone' => '12345',
    			'active' => '0',
    			'type' => 'coaching',
    			'service' => 10000,
    			'email_verified_at' => now(),
    		],
    		[
    			'name' => 'Bangladesh University of Dhaka',
    			'FI' => '602',
    			'identity' => '2',
    			'abbreviation' => 'BUD',
    			'area' => 'Dhaka',
    			'address' => 'House no. 32, Road no. 15, Rupnagar Residential Area, Mirpur-2, Dhaka 1216',
    			'email' => 'al@gmail.com',
    			'password' => bcrypt(123),
    			'owner' => 'Mr XYZ',
    			'owner_phone' => '12345',
    			'inst_phone' => '12345',
    			'active' => '0',
    			'type' => 'coaching',
    			'service' => 10000,
    			'email_verified_at' => now(),
    		],
    	]);
    }
}
