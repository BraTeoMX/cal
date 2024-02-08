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
                <hr>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <h4>Orden: {{ $datoAX->orden }}</h4>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <h4>Cliente: {{ $datoAX->cliente }}</h4>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <h4>Estilo: {{ $datoAX->estilo }}</h4>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <h4>Material: {{ $datoAX->material }}</h4>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <h4>Color: {{ $datoAX->color }}</h4>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <h4>Pieza: {{ $datoAX->pieza }}</h4>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <h4>Trazo: {{ $datoAX->trazo }}</h4>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <h4>Lienzo: {{ $datoAX->lienzo }}</h4>
                    </div>
                </div>
                <hr>
                <form method="POST" action="{{ route('auditoriaCorte.formAuditoriaMarcada', ['id' => $datoAX->id]) }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $datoAX->id }}">
                    <input type="hidden" name="orden" value="{{ $datoAX->orden }}">
                    <div style="background: #db8036a2">
                        <h4 style="text-align: center">AUDITORIA DE MARCADA</h4>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="yarda_orden" class="col-sm-6 col-form-label">Yardas en la orden</label>
                            <div class="col-sm-12 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input type="number" step="0.0001" class="form-control me-2" name="yarda_orden" id="yarda_orden"
                                        placeholder="..." />
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="quitar-espacio" type="radio" name="yarda_orden_estatus" id="yarda_orden_estatus1"
                                        value="1">
                                    <label class="label-paloma" for="yarda_orden_estatus1">✔ </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="quitar-espacio" type="radio" name="yarda_orden_estatus" id="yarda_orden_estatus2"
                                        value="0">
                                    <label class="label-tache" for="yarda_orden_estatus2">✖ </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="yarda_marcada" class="col-sm-6 col-form-label">Yardas en la marcada</label>
                            <div class="col-sm-12 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input type="number" step="0.0001" class="form-control me-2" name="yarda_marcada" id="yarda_marcada"
                                        placeholder="..." />
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="quitar-espacio" type="radio" name="yarda_marcada_estatus" id="yarda_marcada_estatus1"
                                        value="1">
                                    <label class="label-paloma" for="yarda_marcada_estatus1">✔ </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="quitar-espacio" type="radio" name="yarda_marcada_estatus" id="yarda_marcada_estatus2"
                                        value="0">
                                    <label class="label-tache" for="yarda_marcada_estatus2">✖ </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="yarda_tendido" class="col-sm-6 col-form-label">Yardas en el tendido</label>
                            <div class="col-sm-12 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input type="number" step="0.0001" class="form-control me-2" name="yarda_tendido" id="yarda_tendido"
                                        placeholder="..." />
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="quitar-espacio" type="radio" name="yarda_tendido_estatus" id="yarda_tendido_estatus1"
                                        value="1">
                                    <label class="label-paloma" for="yarda_tendido_estatus1">✔ </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="quitar-espacio" type="radio" name="yarda_tendido_estatus" id="yarda_tendido_estatus2"
                                        value="0">
                                    <label class="label-tache" for="yarda_tendido_estatus2">✖ </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        {{-- 
                        <div class="col-md-6 mb-3">
                            <label for="pieza_bulto" class="col-sm-3 col-form-label">Piezas X Bulto </label>
                            <div class="col-sm-12 d-flex align-items-center">
                                <input type="number" step="0.0001" class="form-control me-2" name="pieza_bulto" id="pieza_bulto"
                                    placeholder="..." />
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pieza_total" class="col-sm-3 col-form-label">Piezas Totales</label>
                            <div class="col-sm-12 d-flex align-items-center">
                                <input type="number" step="0.0001" class="form-control me-2" name="pieza_total" id="pieza_total"
                                    placeholder="..." />
                            </div>
                        </div>
                        --}}
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="talla1" class="col-sm-3 col-form-label">Tallas</label>
                            <div class="col-sm-12 d-flex align-items-center">
                                <input type="number" step="0.0001" class="form-control me-2" name="talla1" id="talla1"
                                    placeholder="..." />
                                <input type="number" step="0.0001" class="form-control me-2" name="talla2" id="talla2"
                                    placeholder="..." />
                                <input type="number" step="0.0001" class="form-control me-2" name="talla3" id="talla3"
                                    placeholder="..." />
                                <input type="number" step="0.0001" class="form-control me-2" name="talla4" id="talla4"
                                    placeholder="..." />
                                <input type="number" step="0.0001" class="form-control me-2" name="talla5" id="talla5"
                                    placeholder="..." />
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="bulto1" class="col-sm-3 col-form-label"># Bultos</label>
                            <div class="col-sm-12 d-flex align-items-center">
                                <input type="number" step="0.0001" class="form-control me-2" name="bulto1" id="bulto1"
                                    placeholder="..." />
                                <input type="number" step="0.0001" class="form-control me-2" name="bulto2" id="bulto2"
                                    placeholder="..." />
                                <input type="number" step="0.0001" class="form-control me-2" name="bulto3" id="bulto3"
                                    placeholder="..." />
                                <input type="number" step="0.0001" class="form-control me-2" name="bulto4" id="bulto4"
                                    placeholder="..." />
                                <input type="number" step="0.0001" class="form-control me-2" name="bulto5" id="bulto5"
                                    placeholder="..." />
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="total_pieza1" class="col-sm-3 col-form-label">Total piezas</label>
                            <div class="col-sm-12 d-flex align-items-center">
                                <input type="number" step="0.0001" class="form-control me-2" name="total_pieza1" id="total_pieza1"
                                    placeholder="..." />
                                <input type="number" step="0.0001" class="form-control me-2" name="total_pieza2" id="total_pieza2"
                                    placeholder="..." />
                                <input type="number" step="0.0001" class="form-control me-2" name="total_pieza3" id="total_pieza3"
                                    placeholder="..." />
                                <input type="number" step="0.0001" class="form-control me-2" name="total_pieza4" id="total_pieza4"
                                    placeholder="..." />
                                <input type="number" step="0.0001" class="form-control me-2" name="total_pieza5" id="total_pieza5"
                                    placeholder="..." />
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="largo_trazo" class="col-sm-3 col-form-label">Largo Trazo </label>
                            <div class="col-sm-12 d-flex align-items-center">
                                <input type="number" step="0.0001" class="form-control me-2" name="largo_trazo" id="largo_trazo"
                                    placeholder="..." />
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="ancho_trazo" class="col-sm-3 col-form-label">Ancho Trazo </label>
                            <div class="col-sm-12 d-flex align-items-center">
                                <input type="number" step="0.0001" class="form-control me-2" name="ancho_trazo" id="ancho_trazo"
                                    placeholder="..." />
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="submit" class="btn btn-danger">Finalizar</button>
                    </div>
                </form>
            
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

@endsection
