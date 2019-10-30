<?php
use Illuminate\Database\Seeder;
use App\Domain\User\Entities\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'medico',
            'email' => 'medico@mail.com',
            'profile_id' => 1,
            'password' => Hash::make('secret')
        ]);

        factory(User::class)->create([
            'name' => 'validador',
            'email' => 'validador@mail.com',
            'profile_id' => 2,
            'password' => Hash::make('secret')
        ]);

        factory(User::class)->create([
            'name' => 'aprovador',
            'email' => 'aprovador@mail.com',
            'profile_id' => 3,
            'password' => Hash::make('secret')
        ]);
        factory(User::class,100)->create();
    }
}
