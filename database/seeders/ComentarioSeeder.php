<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Reserva;

class ComentarioSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create('es_ES');
        
        // Obtener todas las reservas
        $reservas = Reserva::all();

        foreach($reservas as $reserva) {
            // 70% de chance de que haya comentario
            if(rand(1, 10) <= 7) {
                DB::table('comentario')->insert([
                    'iduser' => $reserva->iduser,
                    'idvacacion' => $reserva->idvacacion,
                    'texto' => $faker->paragraph(3),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}