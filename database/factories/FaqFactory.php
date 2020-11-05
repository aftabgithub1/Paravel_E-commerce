<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Faq;
use Faker\Generator as Faker;

$factory->define(Faq::class, function (Faker $faker) {
    return [
        'faq_question' => $faker->realText(15),
        'faq_answer' => $faker->realText(30),
        'created_at' => now() 
    ];
});
