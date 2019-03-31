<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'type' => $faker->name,
        'status' => $faker->address,
        'content' => $faker->text,
    ];
});
