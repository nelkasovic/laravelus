<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            SpatiePermissionSeeder::class,
            TenantsTableSeeder::class,
            PersonsTableSeeder::class,
            UsersTableSeeder::class,
            PersonToUserSeeder::class
        ]);
    }
}
