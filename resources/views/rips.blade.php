@extends('layouts.main')
@section('content')
    <div class="row">
        <table class="table col-12" id="tablaProductos">
            <thead>
                <tr>
                    <th>Que es?</th>
                    <th>Nro Serie</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @foreach ($productos as $producto)
                    <tr @if ($producto->estado == 'Roto') class='text-danger'
                @elseif($producto->estado == "Reparado")
                        class='text-success'
                @else
                        class='text-secondary' @endif>
                        <td>{{ $producto->queEs }}</td>
                        <td>{{ $producto->nroSerie }}</td>
                        <td>{{ $producto->marca }}</td>
                        <td>{{ $producto->modelo }}</td>
                        <td>{{ date('d/m/Y', strtotime($producto->fecha)) }}</td>
                        <td>{{ $producto->estado }}</td>
                        <td>
                            <a class="btn btn.round" href="/historial/{{ $producto->id }}"><i class="far fa-eye"></i> </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
