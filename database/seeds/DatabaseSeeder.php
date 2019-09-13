<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProfilesTableSeeder::class);
        $this->call(UserStatusTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SpecialitiesTableSeeder::class);
        $this->call(FilesTableSeeder::class);
    }
}
