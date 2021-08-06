<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use App\Models\Producto;
use Illuminate\Http\Request;

class HistorialController extends Controller
{
    public function index($id)
    {
        $historiales = \DB::table('historials')
            ->select('historials.*')
            ->orderBy('fecha', 'DESC')
            ->where('producto', '=', $id)
            ->get();
        return view('historials')->with('historiales', $historiales)->with('producto', $id);
    }

    public function create(Request $request)
    {
        $historial = Historial::create([
            'fecha' => $request->fecha,
            'detalle' => $request->detalle,
            'tecnico' => $request->tecnico,
            'producto' => $request->producto,
            'estado' => $request->estado
        ]);

        $producto = Producto::find($request->producto);
        $producto->estado = $request->estado;
        $producto->save();

        return back()->with('Listo', 'Se ha insertado correctamente.');
    }

    public function update(Request $request)
    {
        $historial = Historial::find($request->id);
        $historial->fecha = $request->fecha;
        $historial->detalle = $request->detalle;
        $historial->tecnico = $request->tecnico;
        $historial->estado = $request->estado;
        $historial->save();

        $producto = Producto::find($request->producto);
        $producto->estado = $request->estado;
        $producto->save();

        return back()->with('Listo', 'Se modifico correctamente');
    }
}
