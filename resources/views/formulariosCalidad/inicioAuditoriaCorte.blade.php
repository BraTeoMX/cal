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
                <form method="POST" action="{{ route('formulariosCalidad.formAuditoriaCortes') }}">
                    @csrf
                    <hr>
                    <div class="card-body">
                        <!--Desde aqui inicia la edicion del codigo para mostrar el contenido-->
                        {{-- Inicio de Acordeon --}}
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-primary" type="button" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            ORDEN
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
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
                                                            <td><input type="radio" name="seleccion"
                                                                    value="{{ $dato->id }}"></td> <!-- Nuevo -->
                                                            <td>{{ $dato->orden }}</td>
                                                            <td>{{ $dato->estilo }}</td>
                                                            <td>{{ $dato->cliente }}</td>
                                                            <td>{{ $dato->material }}</td>
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

        .label-paloma {
            font-size: 20px;
            /* Tamaño de fuente personalizado */
            color: #33a533;
            /* Color de texto personalizado */
            font-weight: bold;
            /* Texto en negritas (bold) */
            /* Otros estilos personalizados según tus necesidades */
        }

        .label-tache {
            font-size: 20px;
            /* Tamaño de fuente personalizado */
            color: #b61711;
            /* Color de texto personalizado */
            font-weight: bold;
            /* Texto en negritas (bold) */
            /* Otros estilos personalizados según tus necesidades */
        }

        .form-check-inline {
            margin-right: 25px;
        }

        .form-control.me-2 {
            margin-right: 25px;
            /* Ajusta la cantidad de margen según tus necesidades */
        }

        .quitar-espacio {
            margin-right: 10px;
        }
    </style>

    <script>
        document.getElementById('busquedaOrden').addEventListener('keyup', function() {
            var searchText = this.value.toLowerCase();
            var rows = document.querySelectorAll('tbody tr');
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

        // Código para mantener visible la fila seleccionada después de enviar los datos
        var seleccionado = document.querySelector('input[name="seleccion"]:checked');
        if (seleccionado) {
            var filaSeleccionada = seleccionado.closest('tr');
            filaSeleccionada.style.display = '';
        }
    </script>
@endsection
