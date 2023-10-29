<?php

namespace App\Http\Controllers;
use App\Models\Transaccion; 
use Illuminate\Http\Request;

class EstadisticasController extends Controller
{
    public function margenDepositos()
    {
        $depositosPorFecha = Transaccion::where('tipo', 'deposito')
            ->selectRaw('DATE(fecha) as fecha, SUM(monto) as total_deposito')
            ->groupBy('fecha')
            ->orderBy('total_deposito', 'desc')
            ->get();

        return response()->json($depositosPorFecha, 200);
    }

    public function margenRetiros()
    {
        $retirosPorFecha = Transaccion::where('tipo', 'retiro')
            ->selectRaw('DATE(fecha) as fecha, SUM(monto) as total_retiro')
            ->groupBy('fecha')
            ->orderBy('total_retiro', 'desc')
            ->get();

        return response()->json($retirosPorFecha, 200);
    }
}