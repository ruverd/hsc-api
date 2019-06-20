<?php

use Illuminate\Database\Seeder;
use App\Domain\Speciality\Entities\Speciality;

class SpecialitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        factory(Speciality::class)->create(
            [
                'id' => 1,
                'name' => 'Ginecologista'
            ]
        );

        factory(Speciality::class)->create(
            [
                'id' => 2,
                'name' => 'Cardiologista'
            ]
        );

        factory(Speciality::class)->create(
            [
                'id' => 3,
                'name' => 'Dermatologista'
            ]
        );
    }
}
