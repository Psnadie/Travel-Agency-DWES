<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Tipo;

class VacacionSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create('es_ES');
        
        $paises = [
            'España', 'Francia', 'Italia', 'Grecia', 'Portugal',
            'México', 'Brasil', 'Argentina', 'Tailandia', 'Japón',
            'Estados Unidos', 'Canadá', 'Alemania', 'Suiza', 'Austria'
        ];

        $tipoIds = Tipo::pluck('id')->all();

        foreach(range(1, 30) as $i) {
            $tipoId = $tipoIds[array_rand($tipoIds)];
            
            DB::table('vacacion')->insert([
                'titulo' => $faker->sentence(4),
                'descripcion' => $faker->paragraph(5),
                'precio' => $faker->randomFloat(2, 300, 3000),
                'pais' => $paises[array_rand($paises)],
                'idtipo' => $tipoId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}