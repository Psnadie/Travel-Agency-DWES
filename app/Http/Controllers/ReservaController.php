<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Vacacion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReservaController extends Controller
{
    function __construct()
    {
        // Solo usuarios verificados pueden reservar
        $this->middleware('verified');
    }

    public function index(): View
    {
        $reservas = Reserva::where('iduser', Auth::id())
                           ->with('vacacion.tipo', 'vacacion.fotos')
                           ->orderBy('created_at', 'desc')
                           ->paginate(10);

        return view('reserva.index', ['reservas' => $reservas]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'idvacacion' => 'required|exists:vacacion,id',
        ]);

        // Verificar que no tenga ya una reserva de esta vacación
        $yaReservado = Reserva::where('iduser', Auth::id())
                              ->where('idvacacion', $request->idvacacion)
                              ->exists();

        if($yaReservado) {
            return back()->withErrors(['error' => 'Ya tienes una reserva para esta vacación.']);
        }

        try {
            Reserva::create([
                'iduser' => Auth::id(),
                'idvacacion' => $request->idvacacion,
            ]);
            $message = 'Reserva realizada exitosamente.';
            return redirect()->route('reserva.index')->with(['success' => $message]);
        } catch(\Exception $e) {
            $message = 'Error al realizar la reserva.';
            return back()->withErrors(['general' => $message]);
        }
    }

    public function destroy(Reserva $reserva): RedirectResponse
    {
        // Verificar que la reserva pertenezca al usuario
        if($reserva->iduser != Auth::id()) {
            return back()->withErrors(['error' => 'No tienes permiso para cancelar esta reserva.']);
        }

        try {
            $reserva->delete();
            $message = 'Reserva cancelada exitosamente.';
            return redirect()->route('reserva.index')->with(['success' => $message]);
        } catch(\Exception $e) {
            $message = 'Error al cancelar la reserva.';
            return back()->withErrors(['general' => $message]);
        }
    }
}