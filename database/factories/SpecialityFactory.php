<?php

use Faker\Generator as Faker;
use App\Domain\Speciality\Entities\Speciality;

$factory->define(Speciality::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
