<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(RoleSeeder::class);

    }
}
