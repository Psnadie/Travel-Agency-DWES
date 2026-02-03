<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TipoSeeder::class,
            VacacionSeeder::class,
            FotoSeeder::class,
            ReservaSeeder::class,
            ComentarioSeeder::class,
        ]);
    }
}