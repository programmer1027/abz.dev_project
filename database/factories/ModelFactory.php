<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->defineAs(App\Employees::class,'general', function (Faker\Generator $faker) {
    $faker = \Faker\Factory::create('ru_RU');
    return [
        'name' => $faker->name,
        'parent_id' => 0,
        'position_id' => 1,
        'date' => $faker->date,
        'image'=>  'img/general.jpg'
    ];
});

$factory->defineAs(App\Employees::class,'top_menager', function (Faker\Generator $faker) {
    $faker = \Faker\Factory::create('ru_RU');
    return [
        'name' => $faker->name,
        'parent_id' => 1,
        'position_id' => 2,
        'date' => $faker->date,
        'image'=>  'img/top_manager.jpg'
    ];
});

$factory->defineAs(App\Employees::class,'midle_menager', function (Faker\Generator $faker) {
    $faker = \Faker\Factory::create('ru_RU');
    return [
        'name' => $faker->name,
        'parent_id' => $faker->numberBetween(2, 3),
        'position_id' => 3,
        'date' => $faker->date,
        'image'=>  'img/midle_manager.jpg'
    ];
});

$factory->defineAs(App\Employees::class,'junior_menager', function (Faker\Generator $faker) {
    $faker = \Faker\Factory::create('ru_RU');
    return [
        'name' => $faker->name,
        'parent_id' => $faker->numberBetween(4, 7),
        'position_id' => 4,
        'date' => $faker->date,
        'image'=>  'img/jun_manager.jpg'
    ];
});

$factory->defineAs(App\Employees::class,'common_employee', function (Faker\Generator $faker) {
    $faker = \Faker\Factory::create('ru_RU');
    return [
        'name' => $faker->name,
        'parent_id' => $faker->numberBetween(10, 17),
        'position_id' => 5,
        'date' => $faker->date,
        'image'=>  'img/common.jpg'
    ];
});
