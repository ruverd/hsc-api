<?php

use Faker\Generator as Faker;
use App\Domain\User\Entities\UserStatus;

$factory->define(UserStatus::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});