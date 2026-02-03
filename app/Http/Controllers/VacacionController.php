<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacacionCreateRequest;
use App\Http\Requests\VacacionEditRequest;
use App\Models\Vacacion;
use App\Models\Tipo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class VacacionController extends Controller
{
    function __construct()
    {
        // Solo advanced puede crear
        $this->middleware('advanced')->only(['create', 'store']);
        // Solo admin puede editar y eliminar
        $this->middleware('admin')->only(['edit', 'update', 'destroy']);
    }

    public function index(): View
    {
        $vacaciones = Vacacion::with('tipo')->paginate(15);
        return view('vacacion.index', ['vacaciones' => $vacaciones]);
    }

    public function create(): View
    {
        $tipos = Tipo::pluck('nombre', 'id');
        return view('vacacion.create', ['tipos' => $tipos]);
    }

    public function store(VacacionCreateRequest $request): RedirectResponse
    {
        try {
            $vacacion = Vacacion::create($request->all());
            $message = 'Vacación creada exitosamente.';
            return redirect()->route('vacacion.show', $vacacion->id)->with(['success' => $message]);
        } catch(\Exception $e) {
            $message = 'Error al crear la vacación.';
            return back()->withInput()->withErrors(['general' => $message]);
        }
    }

    public function show(Vacacion $vacacion): View
    {
        // Cargar relaciones
        $vacacion->load('tipo', 'fotos', 'comentarios.user', 'reservas');
        
        // Verificar si el usuario actual tiene una reserva de esta vacación
        $tieneReserva = false;
        if(Auth::check()) {
            $tieneReserva = $vacacion->reservas()
                                     ->where('iduser', Auth::id())
                                     ->exists();
        }

        return view('vacacion.show', [
            'vacacion' => $vacacion,
            'tieneReserva' => $tieneReserva
        ]);
    }

    public function edit(Vacacion $vacacion): View
    {
        $tipos = Tipo::pluck('nombre', 'id');
        return view('vacacion.edit', [
            'vacacion' => $vacacion,
            'tipos' => $tipos,
        ]);
    }

    public function update(VacacionEditRequest $request, Vacacion $vacacion): RedirectResponse
    {
        try {
            $vacacion->update($request->all());
            $message = 'Vacación actualizada exitosamente.';
            return redirect()->route('vacacion.show', $vacacion->id)->with(['success' => $message]);
        } catch(\Exception $e) {
            $message = 'Error al actualizar la vacación.';
            return back()->withInput()->withErrors(['general' => $message]);
        }
    }

    public function destroy(Vacacion $vacacion): RedirectResponse
    {
        try {
            $vacacion->delete();
            $message = 'Vacación eliminada exitosamente.';
            return redirect()->route('main.index')->with(['success' => $message]);
        } catch(\Exception $e) {
            $message = 'Error al eliminar la vacación.';
            return back()->withErrors(['general' => $message]);
        }
    }
}