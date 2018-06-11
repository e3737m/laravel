<?php

use Faker\Generator as Faker;
//use App\Models\Photo; //<----
use App\Models\Album;



$factory->define(App\Models\Photo::class, function (Faker $faker) {
    return [
        'album_id' => 1,
		'name' =>  $faker->text(60),
		'description' => $faker->text(30),
		'img_path' => $faker->imageUrl(640, 480, 'cats'),
    ];
});
