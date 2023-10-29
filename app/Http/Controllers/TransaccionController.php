<?php
namespace App\Http\Controllers;
use App\Models\Transaccion; 
use Illuminate\Http\Request;

class TransaccionController extends Controller
{
    public function index()
    {
        $transacciones = Transaccion::all();
        return response()->json($transacciones, 200);
    }

    public function store(Request $request)
    {
        $transaccion = Transaccion::create($request->all());
        return response()->json($transaccion, 201);
    }

    public function show($id)
    {
        $transaccion = Transaccion::find($id);
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
