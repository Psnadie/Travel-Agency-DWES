<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Vacacion;

class ReservaSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener el usuario cliente
        $cliente = User::where('email', 'cliente@vacaciones.com')->first();
        
        // Obtener algunas vacaciones aleatorias
        $vacaciones = Vacacion::inRandomOrder()->limit(5)->get();

        foreach($vacaciones as $vacacion) {
            DB::table('reserva')->insert([
                'iduser' => $cliente->id,
                'idvacacion' => $vacacion->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}