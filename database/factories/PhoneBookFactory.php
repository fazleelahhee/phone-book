<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PhoneBook;
use Faker\Generator as Faker;

$factory->define(PhoneBook::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'telephone' => $faker->phoneNumber,
        'mobile' => $faker->phoneNumber,
        'user_id' =>  factory(App\User::class)
    ];
});
