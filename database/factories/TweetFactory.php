<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tweet;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(Tweet::class, function (Faker $faker) {
    $users = User::get()->pluck('id')->toArray();
    // dd($users);
    return [
        'user_id' => Arr::random($users),
        'body' => $faker->sentence(12)
    ];
});
