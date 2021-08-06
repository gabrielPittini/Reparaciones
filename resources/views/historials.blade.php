@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <div class="align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        <a href="/" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i
                class="fas fa-chevron-circle-left"></i> Volver</a>
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
        <table class="table col-12" id="tablaHistorial">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Detalle</th>
                    <th>Tecnico</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @foreach ($historiales as $hist)
                    <tr
                    @if($hist->estado == "Roto")
                        class='text-danger'
                    @elseif($hist->estado == "Reparado")
                        class='text-success'
                    @else
                        class='text-secondary'
                    @endif
                    >
                        <td>{{ date('d/m/Y', strtotime($hist->fecha)) }}</td>
                        <td>{{ $hist->detalle }}</td>
                        <td>{{ $hist->tecnico }}</td>
                        <td>
                            <button class="btn btn.round btnEditar" data-id="{{ $hist->id }}"
                                data-fecha="{{ $hist->fecha }}" data-detalle="{{ $hist->detalle }}"
                                data-tecnico="{{ $hist->tecnico }}" data-estado="{{ $hist->estado }}"
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
                <form action="/historial/create" method="POST">
                    <input type="hidden" name="producto" value="{{ $producto }}">
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
                            <label for="fecha">Fecha</label>
                            <input type="date" class="form-control" name="fecha" placeholder="Ingrese la fecha" required>
                        </div>
                        <div class="form-group">
                            <label for="tecnico">Tecnico</label>
                            <select class="form-control" name="tecnico" aria-label="Default select example">
                                <option value="Aldo Paredes">Aldo Paredes</option>
                                <option value="Pablo Labissier">Pablo Labissier</option>
                                <option value="Gabriel Pittini">Gabriel Pittini</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select class="form-control" name="estado" aria-label="Default select example">
                                <option value="Roto">Roto</option>
                                <option value="Reparado">Reparado</option>
                                <option value="Sin Arreglo">Sin Arreglo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="detalle">Detalles</label>
                                <textarea class="form-control" name="detalle" placeholder="Ingrese el detalle" required
                                    rows="3"></textarea>
                            </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Editar Registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/historial/update" method="POST">
                    <input type="hidden" name="producto" value="{{ $producto }}">
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
                            <label for="fechaEdit">Fecha</label>
                            <input type="date" class="form-control" name="fecha" id="fechaEdit"
                                placeholder="Ingrese la fecha" required>
                        </div>
                        <div class="form-group">
                            <label for="tecnicoEdit">Tecnico</label>
                            <select class="form-control" name="tecnico" id="tecnicoEdit"
                                aria-label="Default select example">
                                <option value="Aldo Paredes">Aldo Paredes</option>
                                <option value="Pablo Labissier">Pablo Labissier</option>
                                <option value="Gabriel Pittini">Gabriel Pittini</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="estadoEdit">Estado</label>
                            <select class="form-control" name="estado" id="estadoEdit" aria-label="Default select example">
                                <option value="Roto">Roto</option>
                                <option value="Reparado">Reparado</option>
                                <option value="Sin Arreglo">Sin Arreglo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="detalleEdit">Detalles</label>
                            <div class="form-group">
                                <textarea class="form-control" name="detalle" id="detalleEdit"
                                    placeholder="Ingrese el detalle" required rows="3"></textarea>
                            </div>
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
                $.each($("#tablaHistorial tbody tr"), function() {
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
                $("#fechaEdit").val($(this).data('fecha'));
                $("#detalleEdit").val($(this).data('detalle'));
                seleccionarTecnico($(this).data('tecnico'));
                seleccionarEstado($(this).data('estado'));
            })
        });

        function seleccionarTecnico($tec) {
            if ($tec == 'Gabriel Pittini') {
                $("#tecnicoEdit option:contains('Gabriel Pittini')").attr('selected', true);
                $("#tecnicoEdit option:contains('Alto Paredes')").attr('selected', false);
                $("#tecnicoEdit option:contains('Pablo Labissier')").attr('selected', false);
            } else if ($tec == 'Aldo Paredes') {
                $("#tecnicoEdit option:contains('Gabriel Pittini')").attr('selected', false);
                $("#tecnicoEdit option:contains('Alto Paredes')").attr('selected', true);
                $("#tecnicoEdit option:contains('Pablo Labissier')").attr('selected', false);
            } else {
                $("#tecnicoEdit option:contains('Gabriel Pittini')").attr('selected', false);
                $("#tecnicoEdit option:contains('Alto Paredes')").attr('selected', false);
                $("#tecnicoEdit option:contains('Pablo Labissier')").attr('selected', true);
            }
        }

        function seleccionarEstado($est) {
            if ($est == 'Roto') {
                $("#estadoEdit option:contains('Roto')").attr('selected', true);
                $("#estadoEdit option:contains('Reparado')").attr('selected', false);
                $("#estadoEdit option:contains('Sin Arreglo')").attr('selected', false);
            } else if ($est == 'Reparado') {
                $("#estadoEdit option:contains('Roto')").attr('selected', false);
                $("#estadoEdit option:contains('Reparado')").attr('selected', true);
                $("#estadoEdit option:contains('Sin Arreglo')").attr('selected', false);
            } else {
                $("#estadoEdit option:contains('Roto')").attr('selected', false);
                $("#estadoEdit option:contains('Reparado')").attr('selected', false);
                $("#estadoEdit option:contains('Sin Arreglo')").attr('selected', true);
            }



        }
    </script>
@endsection
