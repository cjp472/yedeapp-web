<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    
    // Any time in this month
    $updated_at = $faker->dateTimeThisMonth();

    // The created time is before the updated time.
    $created_at = $faker->dateTimeThisMonth($updated_at);
    
    return [
        'body' => $faker->text(),
        'created_at' => $created_at,
        'updated_at' => $updated_at
    ];
});
