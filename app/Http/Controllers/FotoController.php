<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Vacacion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    function __construct()
    {
        // Solo advanced puede subir fotos
        $this->middleware('advanced')->only(['store']);
        // Solo admin puede eliminar fotos
        $this->middleware('admin')->only(['destroy']);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'idvacacion' => 'required|exists:vacacion,id',
            'foto' => 'required|image|max:2048', // Max 2MB
        ]);

        try {
            $vacacion = Vacacion::findOrFail($request->idvacacion);
            
            // Contar cuántas fotos ya tiene
            $numFotos = $vacacion->fotos()->count();
            
            // Subir la foto
            $path = $this->upload($request, $vacacion->id, $numFotos + 1);
            
            if($path != null) {
                Foto::create([
                    'idvacacion' => $vacacion->id,
                    'ruta' => $path,
                ]);
                $message = 'Foto subida exitosamente.';
                return back()->with(['success' => $message]);
            } else {
                return back()->withErrors(['error' => 'Error al subir la foto.']);
            }
        } catch(\Exception $e) {
            $message = 'Error al subir la foto.';
            return back()->withErrors(['general' => $message]);
        }
    }

    public function destroy(Foto $foto): RedirectResponse
    {
        try {
            // Eliminar archivo físico
            if(Storage::disk('public')->exists($foto->ruta)) {
                Storage::disk('public')->delete($foto->ruta);
            }
            
            // Eliminar registro de la base de datos
            $idvacacion = $foto->idvacacion;
            $foto->delete();
            
            $message = 'Foto eliminada exitosamente.';
            return redirect()->route('vacacion.edit', $idvacacion)->with(['success' => $message]);
        } catch(\Exception $e) {
            $message = 'Error al eliminar la foto.';
            return back()->withErrors(['general' => $message]);
        }
    }

    private function upload(Request $request, $vacacionId, $fotoNum): string|null
    {
        if($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $foto = $request->file('foto');
            $fileName = "vacacion_{$vacacionId}_foto_{$fotoNum}." . $foto->getClientOriginalExtension();
            $path = $foto->storeAs('fotos', $fileName, 'public');
            return $path;
        }
        return null;
    }
}