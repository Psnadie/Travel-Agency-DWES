<?php

namespace App\Http\Controllers;

use App\Models\Vacacion;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(Request $request): View
    {
        // Obtener parámetros de búsqueda y filtros
        $q = $request->q;
        $idtipo = $request->idtipo;
        $precioMin = $request->precio_min;
        $precioMax = $request->precio_max;
        $pais = $request->pais;
        
        // Parámetros de ordenamiento
        $campo = $this->limpiarCampo($request->campo);
        $orden = $this->limpiarOrden($request->orden);

        // Query
        $query = Vacacion::query();
        $query->join('tipo', 'vacacion.idtipo', '=', 'tipo.id')
              ->select('vacacion.*', 'tipo.nombre as tipo_nombre');

        // Filtro por tipo
        if($idtipo != null) {
            $query->where('vacacion.idtipo', '=', $idtipo);
        }

        // Filtro por país
        if($pais != null) {
            $query->where('vacacion.pais', 'like', '%' . $pais . '%');
        }

        // Filtro por rango de precio
        if($precioMin != null) {
            $query->where('vacacion.precio', '>=', $precioMin);
        }
        if($precioMax != null) {
            $query->where('vacacion.precio', '<=', $precioMax);
        }

        // Búsqueda textual
        if($q != null) {
            $query->where(function($sq) use ($q) {
                $sq->where('vacacion.titulo', 'like', '%' . $q . '%')
                   ->orWhere('vacacion.descripcion', 'like', '%' . $q . '%')
                   ->orWhere('vacacion.pais', 'like', '%' . $q . '%')
                   ->orWhere('tipo.nombre', 'like', '%' . $q . '%');
            });
        }

        // Ordenamiento
        $campoOrder = $this->getOrderBy($campo);
        $query->orderBy($campoOrder, $orden);

        // Paginación
        $vacaciones = $query->paginate(12)->withQueryString();

        // Tipos para el filtro
        $tipos = Tipo::pluck('nombre', 'id');

        return view('main.index', [
            'vacaciones' => $vacaciones,
            'tipos' => $tipos,
            'q' => $q,
            'idtipo' => $idtipo,
            'precio_min' => $precioMin,
            'precio_max' => $precioMax,
            'pais' => $pais,
            'campo' => $campo,
            'orden' => $orden,
        ]);
    }

    private function limpiarCampo($campo): string
    {
        return $this->limpiarInput($campo, ['recent', 'titulo', 'precio', 'pais']);
    }

    private function limpiarOrden($orden): string
    {
        return $this->limpiarInput($orden, ['desc', 'asc']);
    }

    private function limpiarInput($input, array $array): string
    {
        $valor = $array[0];
        if(in_array($input, $array)) {
            $valor = $input;
        }
        return $valor;
    }

    private function getOrderBy($orderRequest): string
    {
        $array = [
            'recent' => 'vacacion.id',
            'titulo' => 'vacacion.titulo',
            'precio' => 'vacacion.precio',
            'pais' => 'vacacion.pais',
        ];
        return $array[$orderRequest];
    }
}