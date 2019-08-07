<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Result;
use Faker\Generator as Faker;

$factory->define(Result::class, function (Faker $faker) {
    return [
        'rating'=>$faker->numberBetween(1,4),
        'time'=>$faker->numberBetween(1,2000),
        'user_id'=>factory('App\User')->create()->id
    ];
});
