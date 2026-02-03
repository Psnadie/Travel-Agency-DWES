<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = [
            'Playa',
            'Montaña',
            'Cultural',
            'Aventura',
            'Urbano',
            'Rural',
            'Romántico',
            'Familiar'
        ];

        foreach($tipos as $tipo) {
            DB::table('tipo')->insert([
                'nombre' => $tipo,
            ]);
        }
    }
}