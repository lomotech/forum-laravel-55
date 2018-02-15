<?php

use Faker\Generator as Faker;

$factory->define(App\Channel::class, function (Faker $faker) {
    $name = $faker->word;
    return [
        'name' => $name, // Server Admin
        'slug' => preg_replace("/[^A-Za-z0-9]/", '-', strtolower($name)), // server-admin
    ];
});
