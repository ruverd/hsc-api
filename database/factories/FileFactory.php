<?php

use App\Domain\File\Entities\File;
use Faker\Generator as Faker;

$factory->define(File::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});

