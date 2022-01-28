<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'created_at' => $faker->dateTime(),
    'title' => $faker->text(100),
    'description' => $faker->text(300),
    'author_id' => $faker->numberBetween(1, 10), 
    'category_id' => $faker->numberBetween(1, 8),
    'city_id' => $faker->randomNumber(3, true),
    'status_id' => $faker->numberBetween(1, 1),
];