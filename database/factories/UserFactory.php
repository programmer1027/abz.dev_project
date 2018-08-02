<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 14.05.2018
 * Time: 21:14
 */

$factory->define(App\User::class, function () {
    return [
        'name' => 'Доценко А. В.',
        'email' => 'admin@laravel.net',
        'password' => bcrypt('qazwsx1027'),
        'remember_token' => str_random(10),
    ];
});