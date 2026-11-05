<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SectorSeeder::class,
            JenepontoVillageSeeder::class,
            EsdmUserSeeder::class,
            DinasSectorsSeeder::class,
        ]);
    }
}
