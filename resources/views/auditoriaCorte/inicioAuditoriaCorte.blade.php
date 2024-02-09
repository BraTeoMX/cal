@extends('layouts.app', ['activePage' => 'Corte', 'titlePage' => __('Corte')])

@section('content')
    {{-- ... dentro de tu vista ... --}}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alerta-exito">
            {{ session('success') }}
            @if (session('sorteo'))
                <br>{{ session('sorteo') }}
            @endif
        </div>
    @endif
    @if (session('status'))
        {{-- A menudo utilizado para mensajes de estado genéricos --}}
        <div class="alert alert-secondary">
            {{ session('status') }}
        </div>
    @endif
    <style>
        .alerta-exito {
            background-color: #28a745;
            /* Color de fondo verde */
            color: white;
            /* Color de texto blanco */
            padding: 20px;
            border-radius: 15px;
            font-size: 20px;
        }
    </style>
    {{-- ... el resto de tu vista ... --}}
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <!--Aqui se edita el encabezado que es el que se muestra -->
                <div class="card-header card-header-primary">
                    <h3 class="card-title">CONTROL DE CALIDAD EN CORTE</h3>
                </div>
                <div class="card-body">
                    <!--Desde aqui inicia la edicion del codigo para mostrar el contenido-->
                    <form method="POST" action="{{ route('auditoriaCorte.formAuditoriaCortes') }}">
                        @csrf
                        <!-- Desde aquí inicia la edición del código para mostrar el contenido -->
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" id="busquedaOrden" class="form-control"
                                    placeholder="Buscar por orden">
                            </div>
                        </div>
                        <div class="table-responsive" id="tablaDatos" style="display:none;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Seleccionar</th> <!-- Nuevo -->
                                        <th>Orden</th>
                                        <th>Estilo</th>
                                        <th>Cliente</th>
                                        <th>Material</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($DatoAX as $dato)
                                        <tr>
                                            <td><input type="radio" name="seleccion" value="{{ $dato->id }}"></td>
                                            <!-- Nuevo -->
                                            <td>{{ $dato->orden }}</td>
                                            <td>{{ $dato->estilo }}</td>
                                            <td>{{ $dato->cliente }}</td>
                                            <td>{{ $dato->material }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
                                <label for="color" class="col-sm-6 col-form-label">COLOR</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <select name="color" id="color" class="form-control"
                                        title="Por favor, selecciona una opción">
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($CategoriaColor as $color)
                                            <option value="{{ $color->nombre }}">{{ $color->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
                                <label for="pieza" class="col-sm-6 col-form-label">PIEZAS</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" name="pieza" id="pieza"
                                        placeholder="..." />
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
                                <label for="trazo" class="col-sm-6 col-form-label">TRAZO</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" name="trazo" id="trazo"
                                        placeholder="..." />
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
                                <label for="lienzo" class="col-sm-6 col-form-label">LIENZOS</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="lienzo" id="lienzo"
                                        placeholder="..." />
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </form>
                    <hr>
                    <div>
                        {{-- Inicio de Acordeon 
                        <div class="accordion" id="accordionExample1">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-sucess btn-block" type="button" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            ESTATUS: INICIADO
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <!-- Desde aquí inicia la edición del código para mostrar el contenido -->
                                        <div class="table-responsive" data-filter="false">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>iniciar</th>
                                                        <th>Orden</th>
                                                        <th>Estilo</th>
                                                        <th>Cliente</th>
                                                        <th>Material</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($DatoAXIniciado as $inicio)
                                                        <tr>
                                                            <td><a href="{{ route('auditoriaCorte.auditoriaMarcada', ['id' => $inicio->id]) }}" class="btn btn-info">Acceder</a></td>
                                                            <td>{{ $inicio->orden }}</td>
                                                            <td>{{ $inicio->estilo }}</td>
                                                            <td>{{ $inicio->cliente }}</td>
                                                            <td>{{ $inicio->material }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        --}}
                        <!-- Fin del acordeón -->
                    </div>
                    <div>
                        {{-- Inicio de Acordeon --}}
                        <div class="accordion" id="accordionExample2">
                            <div class="card">
                                <div class="card-header" id="headingOne2">
                                    <h2 class="mb-0">
                                        <button class="btn btn-warning btn-block" type="button" data-toggle="collapse"
                                            data-target="#collapseOne2" aria-expanded="true" aria-controls="collapseOne2">
                                            ESTATUS: EN PROCESO
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne2" class="collapse" aria-labelledby="headingOne2"
                                    data-parent="#accordionExample2">
                                    <div class="card-body">
                                        <!-- Desde aquí inicia la edición del código para mostrar el contenido -->
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>iniciar</th>
                                                        <th>Orden</th>
                                                        <th>Estilo</th>
                                                        <th>Cliente</th>
                                                        <th>Material</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($DatoAXProceso as $proceso)
                                                        <tr>
                                                            <td><a href="{{ route('auditoriaCorte.auditoriaMarcada', ['id' => $proceso->id]) }}" class="btn btn-info">Acceder</a></td>
                                                            <td>{{ $proceso->orden }}</td>
                                                            <td>{{ $proceso->estilo }}</td>
                                                            <td>{{ $proceso->cliente }}</td>
                                                            <td>{{ $proceso->material }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin del acordeón -->
                    </div>
                    <div>
                        {{-- Inicio de Acordeon --}}
                        <div class="accordion" id="accordionExample3">
                            <div class="card">
                                <div class="card-header" id="headingOne3">
                                    <h2 class="mb-0">
                                        <button class="btn btn-danger  btn-block" type="button" data-toggle="collapse"
                                            data-target="#collapseOne3" aria-expanded="true" aria-controls="collapseOne3">
                                            ESTATUS: FINAL
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne3" class="collapse" aria-labelledby="headingOne3"
                                    data-parent="#accordionExample3">
                                    <div class="card-body">
                                        <!-- Desde aquí inicia la edición del código para mostrar el contenido -->
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>iniciar</th>
                                                        <th>Orden</th>
                                                        <th>Estilo</th>
                                                        <th>Cliente</th>
                                                        <th>Material</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($DatoAXFin as $proceso)
                                                        <tr>
                                                            <td><a href="{{ route('auditoriaCorte.inicioAuditoriaCorte') }}" class="btn btn-info">Acceder</a></td>
                                                            <td>{{ $proceso->orden }}</td>
                                                            <td>{{ $proceso->estilo }}</td>
                                                            <td>{{ $proceso->cliente }}</td>
                                                            <td>{{ $proceso->material }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin del acordeón -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Estilos personalizados para los elementos de tipo "radio" */
        input[type="radio"] {
            width: 20px;
            /* Ancho personalizado */
            height: 20px;
            /* Altura personalizada */
            /* Otros estilos personalizados según tus necesidades */
        }
    </style>

    <script>
        document.getElementById('busquedaOrden').addEventListener('keyup', function() {
        var searchText = this.value.toLowerCase();
        var rows = document.querySelectorAll('#tablaDatos tbody tr'); // Selecciona solo las filas de la tabla dentro de #tablaDatos
        var tablaDatos = document.getElementById('tablaDatos');

        if (searchText.trim() !== '') {
            tablaDatos.style.display = 'block';
        } else {
            tablaDatos.style.display = 'none';
        }

        rows.forEach(function(row) {
            var cells = row.querySelectorAll('td');
            var found = false;
            cells.forEach(function(cell, index) {
                if (index === 1 && cell.textContent.toLowerCase().includes(searchText)) {
                    found = true;
                }
            });

            if (found) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    </script>
@endsection
