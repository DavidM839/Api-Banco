<?php

namespace App\Http\Controllers;

use App\Models\Transaccion;
use App\Models\Cuenta;
use App\Models\Cliente; 

use Illuminate\Http\Request;

class TransaccionController extends Controller
{
    public function index()
    {
        $transacciones = Transaccion::with(['cuenta.cliente'])->get();
        return response()->json($transacciones, 200);
        
    }

    public function getTransactionsByClientId($idCliente)
{
    $transacciones = Transaccion::with(['cuenta.cliente'])
                        ->whereHas('cuenta.cliente', function ($query) use ($idCliente) {
                            $query->where('id', $idCliente);
                        })
                        ->get();

    return response()->json($transacciones, 200);
}

    public function store(Request $request)
    {
        $transaccion = Transaccion::create($request->all());
    
        // Actualizar el saldo de la cuenta
        $cuenta = Cuenta::find($request->id_cuenta);
        if (!$cuenta) {
            return response()->json(['message' => 'Cuenta no encontrada'], 404);
        }
    
        // Actualizar el saldo de la cuenta según el tipo de transacción
        if ($request->tipo === 'deposito') {
            $cuenta->saldo += $request->monto;
        } elseif ($request->tipo === 'retiro') {
            $cuenta->saldo -= $request->monto;
        }
    
        $cuenta->save(); // Guardar el saldo actualizado en la cuenta
    
        return response()->json($transaccion, 201);
    }
    

    public function show($id)
    {
        $transaccion = Transaccion::with(['cuenta.cliente'])->find($id);
        if (!$transaccion) {
            return response()->json(['message' => 'Transacción no encontrada'], 404);
        }
        return response()->json($transaccion, 200);
    }

    public function update(Request $request, $id)
    {
        $transaccion = Transaccion::find($id);
        if (!$transaccion) {
            return response()->json(['message' => 'Transacción no encontrada'], 404);
        }
        $transaccion->update($request->all());
        return response()->json($transaccion, 200);
    }

    public function destroy($id)
    {
        $transaccion = Transaccion::find($id);
        if (!$transaccion) {
            return response()->json(['message' => 'Transacción no encontrada'], 404);
        }
        $transaccion->delete();
        return response()->json(null, 204);
    }
}
