@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <div class="align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
            data-target="#modalAgregar">
            <i class="fas fa-plus-circle"></i> Agregar registro
        </a>
    </div>

    <div class="row">
        @if ($message = Session::get('Listo'))
            <div class="col-12 alert alert-success alert-dismissable fade show" role="alert">
                <span>{{ $message }}</span>
            </div>
        @endif
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
                    <th>Modificar</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @foreach ($productos as $producto)
                    <tr
                    @if($producto->estado == "Roto")
                        class='text-danger'
                    @elseif($producto->estado == "Reparado")
                        class='text-success'
                    @else
                        class='text-secondary'
                    @endif
                    >
                        <td>{{ $producto->queEs }}</td>
                        <td>{{ $producto->nroSerie }}</td>
                        <td>{{ $producto->marca }}</td>
                        <td>{{ $producto->modelo }}</td>
                        <td>{{ date("d/m/Y", strtotime($producto->fecha)) }}</td>
                        <td>{{ $producto->estado }}</td>
                        <td>
                            <a class="btn btn.round" href="/historial/{{ $producto->id }}"><i class="far fa-eye"></i> </a>
                        </td>
                        <td>
                            <button class="btn btn.round btnEditar" data-id="{{ $producto->id }}"
                                data-quees="{{ $producto->queEs }}" data-nroserie="{{ $producto->nroSerie }}"
                                data-marca="{{ $producto->marca }}" data-modelo="{{ $producto->modelo }}"
                                data-toggle="modal" data-target="#modalEditar"><i class="fa fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Agregar -->
    <div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/create" method="POST">
                    @csrf
                    @if ($message = Session::get('ErrorInsert'))
                        <div class="col-12 alert alert-danger alert-dismissable fade show" role="alert">
                            <h5>Errores:</h5>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="queEs">Que es?</label>
                            <input type="text" class="form-control" name="queEs" placeholder="Ingrese lo que es."
                                value="{{ old('queEs') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="nroSerie">Numero de Serie</label>
                            <input type="text" class="form-control" name="nroSerie" placeholder="Ingrese el numero de serie"
                                value="{{ old('nroSerie') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="marca">Marca</label>
                            <input type="text" class="form-control" name="marca" placeholder="Ingrese la marca"
                                value="{{ old('marca') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="modelo">Modelo</label>
                            <input type="text" class="form-control" name="modelo" placeholder="Ingrese el modelo"
                                value="{{ old('modelo') }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/update" method="POST">
                    @csrf
                    @if ($message = Session::get('ErrorInsert'))
                        <div class="col-12 alert alert-danger alert-dismissable fade show" role="alert">
                            <h5>Errores:</h5>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="modal-body">
                        <input type="hidden" name="id" id="idEdit">
                        <div class="form-group">
                            <label for="queEs">Que es?</label>
                            <input type="text" class="form-control" name="queEs" placeholder="Ingrese lo que es."
                                id='queEsEdit' required>
                        </div>
                        <div class="form-group">
                            <label for="nroSerie">Numero de Serie</label>
                            <input type="text" class="form-control" name="nroSerie" placeholder="Ingrese el numero de serie"
                                id='nroEdit' required>
                        </div>
                        <div class="form-group">
                            <label for="marca">Marca</label>
                            <input type="text" class="form-control" name="marca" placeholder="Ingrese la marca"
                                id='marcaEdit' required>
                        </div>
                        <div class="form-group">
                            <label for="modelo">Modelo</label>
                            <input type="text" class="form-control" name="modelo" placeholder="Ingrese el modelo"
                                id='modeloEdit' required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Modificar</button>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script>
        var idEliminar = 0;
        $('document').ready(function() {

            $("#search").keyup(function() {
                _this = this;
                $.each($("#tablaProductos tbody tr"), function() {
                    if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -
                        1)
                        $(this).hide();
                    else
                        $(this).show();
                });
            });

            @if ($message = Session::get('ErrorInsert'))
                $("#modalAgregar").modal('show');
            @endif
            $(".btnEliminar").click(function() {
                idEliminar = $(this).data('id');
            })
            $(".btnModalEliminar").click(function() {
                $('#formEli_' + idEliminar).submit();
            })
            $(".btnEditar").click(function() {
                $("#idEdit").val($(this).data('id'));
                $("#nroEdit").val($(this).data('nroserie'));
                $("#marcaEdit").val($(this).data('marca'));
                $("#modeloEdit").val($(this).data('modelo'));
                $("#queEsEdit").val($(this).data('quees'));
            })
        });
    </script>
@endsection
