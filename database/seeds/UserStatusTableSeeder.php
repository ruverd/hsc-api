<?php

use Illuminate\Database\Seeder;
use App\Domain\User\Entities\UserStatus;

class UserStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(UserStatus::class)->create(
            [
                'id'   => 1,
                'name' => 'Aguardando importação de arquivos'
            ]
        );

        factory(UserStatus::class)->create(
            [
                'id'   => 2,
                'name' => 'Arquivos enviados'
            ]
        );

        factory(UserStatus::class)->create(
            [
                'id'   => 3,
                'name' => 'Validado'
            ]
        );

        factory(UserStatus::class)->create(
            [
                'id'   => 4,
                'name' => 'Não validado'
            ]
        );

        factory(UserStatus::class)->create(
            [
                'id'   => 5,
                'name' => 'Aprovado'
            ]
        );

        factory(UserStatus::class)->create(
            [
                'id'   => 6,
                'name' => 'Reprovado'
            ]
        );
    }
}
