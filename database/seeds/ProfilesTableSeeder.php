<?php

use Illuminate\Database\Seeder;
use App\Domain\Profile\Entities\Profile;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        factory(Profile::class)->create(
            [
                'id' => 1,
                'name' => 'Médico'
            ]
        );

        factory(Profile::class)->create(
            [
                'id' => 2,
                'name' => 'CAM'
            ]
        );

        factory(Profile::class)->create(
            [
                'id' => 3,
                'name' => 'Administrador'
            ]
        );
    }
}
