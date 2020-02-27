<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Coaching\CoachingStudent;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$x = 0;
$b = 1960101050;
for($a = 1960101001; $a<=$b; $a++){
	$x++;
$factory->define(CoachingStudent::class, function (Faker $faker) {
    return [
        		'name' => 'Md Hafiz Al Foisal',
        		'school_name' => 'Bangladesh University Business and Technology',
        		'std_id' => $a,
        		'amd_class' => '1',
        		'amd_type' => 'regular',
        		'class_roll' => '1',
        		'tution_fee' => '1234',
        		'address' => 'Rupnagar Residential area',
        		'guardian_name' => 'Mr qwer',
        		'grd_phone' => '1233456',
        		'std_phone' => '1233456',
        		'std_serial' => $x,
        		'reference' => 'AL',
        		'section' => 'B-07',
        		'commitment' => 'Regular student so no commitment',
        		'inst_identity' => '601',
        		'created_at' => now(),
           ];
});
}
