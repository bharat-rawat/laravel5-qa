<?php

use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {
    return [
        'title'=> rtrim($faker->sentence(rand(5,10)),"."),
        'body'=>$faker->paragraphs(rand(2,5),true),
        'views'=>rand(0,10),
        //'answers_count'=>rand(0,10),
        //'votes-count'=>rand(-5,10),
    ];
});
