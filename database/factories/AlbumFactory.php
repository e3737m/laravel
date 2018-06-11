<?php

use Faker\Generator as Faker;
use App\Models\Album; //<----
use App\User;


$factory->define(App\Models\Album::class, function (Faker $faker) {
    return [
        'album_name' => $faker->text(30),
        'description' =>  $faker->text(100),
        'user_id' => User::inRandomOrder()->first()->id,
		'album_thumb' => "https://loremflickr.com/320/240",
		
    ];
});
