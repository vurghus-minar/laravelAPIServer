<?php

use Faker\Generator as Faker;

$factory->define(App\Note::class, function (Faker $faker) {
    $users = App\User::pluck('id')->toArray();
    return [
        'title' => $faker->text(50),
        'body' => $faker->text(200),
        'user_id'=> $faker->randomElement($users),
        'theme' => $faker->randomElement(
            [
                "default",
                "dark",
                "blue",
                "midnight",
                "blood",
                "forest",
                "lemon",
                "sky",
                "lavender"
            ]
        )
    ];
});
