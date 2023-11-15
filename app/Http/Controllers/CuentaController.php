<?php

namespace App\Http\Controllers;
use App\Models\Cuenta; 
use Illuminate\Http\Request;

class CuentaController extends Controller
{
    public function index()
    {
        $cuentas = Cuenta::with('cliente')->get();
        return response()->json($cuentas, 200);
    }

    public function store(Request $request)
    {
        $cuenta = Cuenta::create($request->all());
        return response()->json($cuenta, 201);
    }

    public function show($id)
    {
        $cuenta = Cuenta::with('cliente')->find($id);
        if (!$cuenta) {
            return response()->json(['message' => 'Cuenta no encontrada'], 404);
        }
        return response()->json($cuenta, 200);
    }

    public function update(Request $request, $id)
    {
        $cuenta = Cuenta::find($id);
        if (!$cuenta) {
            return response()->json(['message' => 'Cuenta no encontrada'], 404);
        }
        $cuenta->update($request->all());
        return response()->json($cuenta, 200);
    }

    public function destroy($id)
    {
        $cuenta = Cuenta::find($id);
        if (!$cuenta) {
            return response()->json(['message' => 'Cuenta no encontrada'], 404);
        }
        $cuenta->delete();
        return response()->json(null, 204);
    }
}
