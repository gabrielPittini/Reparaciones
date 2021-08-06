<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    public function index()//FILTRAR X NO RIPEADOS
    {
        $productos = \DB::table('productos')
            ->select('productos.*')
            ->orderBy('fecha', 'DESC')
            ->where('estado', '!=', 'Sin Arreglo')
            ->get();
        return view('productos')->with('productos', $productos);
    }

    public function rips(){//FALTA FILTRAR POR RIPEADOS
        $rips = \DB::table('productos')
            ->select('productos.*')
            ->orderBy('fecha', 'DESC')
            ->where('estado', '=', 'Sin Arreglo')
            ->get();
        return view('rips')->with('productos', $rips);
    }

    public function create(Request $request)
    {
        $producto = Producto::create([
            'nroSerie' => $request->nroSerie,
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'queEs' => $request->queEs,
            'estado' => '-',
            'fecha' => date('Y-m-d')
        ]);
        return back()->with('Listo', 'Se ha insertado correctamente.');
    }


    public function update(Request $request)
    {
        $prod = Producto::find($request->id);

        $prod->nroSerie = $request->nroSerie;
        $prod->marca = $request->marca;
        $prod->modelo = $request->modelo;
        $prod->queEs = $request->queEs;
        $prod->save();

        return back()->with('Listo', 'Se modifico correctamente');
    }
}
