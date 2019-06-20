<?php

use Faker\Generator as Faker;
use App\Domain\Profile\Entities\Profile;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});