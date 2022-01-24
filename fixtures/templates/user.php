<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'registered_at' => $faker->dateTime(),
    'user_name' => $faker->name(),
    'email' => $faker->email,
    'user_password' => $faker->password(),
    'cities_id' => $faker->randomNumber(3, true),
];