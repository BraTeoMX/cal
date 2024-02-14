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
                    <div>
                        {{-- Inicio de Acordeon --}}
                        <div class="accordion" id="accordionExample1">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-danger btn-block" type="button" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            ESTATUS: NO INICIADO
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
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
                                                    @foreach ($DatoAXNoIniciado as $inicio)
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

                                <div id="collapseOne2" class="collapse show" aria-labelledby="headingOne2"
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
                                        <button class="btn btn-success  btn-block" type="button" data-toggle="collapse"
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
@endsection
