<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Vacacion;

class FotoSeeder extends Seeder
{
    public function run(): void
    {
        $vacaciones = Vacacion::all();

        foreach($vacaciones as $vacacion) {
            // Cada vacación tendrá entre 1 y 3 fotos
            $numFotos = rand(1, 3);
            
            for($i = 1; $i <= $numFotos; $i++) {
                $url = 'https://picsum.photos/seed/' . \Illuminate\Support\Str::uuid() . '/800/600.jpg';
                $path = $this->upload($url, $vacacion->id, $i);
                
                if($path != null) {
                    DB::table('foto')->insert([
                        'idvacacion' => $vacacion->id,
                        'ruta' => $path,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    protected function upload($url, $vacacionId, $fotoNum): string|null
    {
        try {
            $response = Http::get($url);
            $fileName = "vacacion_{$vacacionId}_foto_{$fotoNum}.jpg";
            $path = "fotos/" . $fileName;
            Storage::disk("public")->put($path, $response->body());
            return $path;
        } catch(\Exception $e) {
            return null;
        }
    }
}