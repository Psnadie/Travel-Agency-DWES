<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComentarioCreateRequest;
use App\Http\Requests\ComentarioEditRequest;
use App\Models\Comentario;
use App\Models\Vacacion;
use App\Models\Reserva;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ComentarioController extends Controller
{
    function __construct()
    {
        // Solo usuarios verificados pueden comentar
        $this->middleware('verified');
    }

    public function store(ComentarioCreateRequest $request): RedirectResponse
    {
        // Verificar que el usuario tenga una reserva de esta vacación
        $tieneReserva = Reserva::where('iduser', Auth::id())
                               ->where('idvacacion', $request->idvacacion)
                               ->exists();

        if(!$tieneReserva) {
            return back()->withErrors(['error' => 'Solo puedes comentar en vacaciones que has reservado.']);
        }

        try {
            Comentario::create([
                'iduser' => Auth::id(),
                'idvacacion' => $request->idvacacion,
                'texto' => $request->texto,
            ]);
            $message = 'Comentario publicado exitosamente.';
            return back()->with(['success' => $message]);
        } catch(\Exception $e) {
            $message = 'Error al publicar el comentario.';
            return back()->withErrors(['general' => $message]);
        }
    }

    public function edit(Comentario $comentario): View
    {
        // Verificar que el comentario pertenezca al usuario
        if(!$comentario->isOwner()) {
            abort(403, 'No tienes permiso para editar este comentario.');
        }

        return view('comentario.edit', ['comentario' => $comentario]);
    }

    public function update(ComentarioEditRequest $request, Comentario $comentario): RedirectResponse
    {
        // Verificar que el comentario pertenezca al usuario
        if(!$comentario->isOwner()) {
            return redirect()->route('main.index')->withErrors(['error' => 'No tienes permiso.']);
        }

        try {
            $comentario->update($request->all());
            $message = 'Comentario actualizado exitosamente.';
            return redirect()->route('vacacion.show', $comentario->idvacacion)->with(['success' => $message]);
        } catch(\Exception $e) {
            $message = 'Error al actualizar el comentario.';
            return back()->withInput()->withErrors(['general' => $message]);
        }
    }

    public function destroy(Comentario $comentario): RedirectResponse
    {
        // Solo el dueño o admin puede eliminar
        if(!$comentario->isOwner() && !Auth::user()->isAdmin()) {
            return back()->withErrors(['error' => 'No tienes permiso para eliminar este comentario.']);
        }

        try {
            $idvacacion = $comentario->idvacacion;
            $comentario->delete();
            $message = 'Comentario eliminado exitosamente.';
            return redirect()->route('vacacion.show', $idvacacion)->with(['success' => $message]);
        } catch(\Exception $e) {
            $message = 'Error al eliminar el comentario.';
            return back()->withErrors(['general' => $message]);
        }
    }
}