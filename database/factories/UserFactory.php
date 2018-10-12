<?php

use Faker\Generator as Faker;

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

$factory->define(App\Instruction::class, function (Faker $faker) {
    return [
        
        'subject_id' => rand(1,5),
        'instruction' => str_random(20),
    ];
});
