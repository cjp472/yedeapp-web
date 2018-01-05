<?php

use Faker\Generator as Faker;

$factory->define(App\Topic::class, function (Faker $faker) {
    $sentence = $faker->sentence();

    // Any time in this month
    $updated_at = $faker->dateTimeThisMonth();

    // The created time is before the updated time.
    $created_at = $faker->dateTimeThisMonth($updated_at);
    
    return [
        'title' => $sentence,
        'body' => $faker->text(),
        'desc' => $sentence,
        'created_at' => $created_at,
        'updated_at' => $updated_at
    ];
});
