<?php

namespace Database\Seeders;

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
        $this->call(UserSeed::class);
        $this->call(MenuSeed::class);
        $this->call(RoleSeed::class);
        $this->call(CompetitionCategorySeeder::class);
        $this->call(DummySeeder::class);
    }
}
