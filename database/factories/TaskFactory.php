<?php

use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        'cat' => $faker->text(10),
        'name' => $faker->text(50)
    ];
});
