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
    @if (session('sobre-escribir'))
        <div class="alert sobre-escribir">
            {{ session('sobre-escribir') }}
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

        .sobre-escribir {
            background-color: #0a8ba1;
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
                    <h3 id="estatusValue">Estatus: {{ $datoAX->estatus }}</h3>
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
                <div id="accordion">
                    <!--Inicio acordeon 1 -->
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-info btn-block" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    - - AUDITORIA DE MARCADA - - 
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                {{-- Inicio cuerpo acordeon --}}
                                <form method="POST"
                                    action="{{ route('auditoriaCorte.formAuditoriaMarcada', ['id' => $datoAX->id]) }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $datoAX->id }}">
                                    <input type="hidden" name="orden" value="{{ $datoAX->orden }}">
                                    {{--Campo oculto para el boton Finalizar--}}
                                    <input type="hidden" name="accion" value="">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="yarda_orden" class="col-sm-6 col-form-label">Yardas en la
                                                orden</label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <div class="form-check form-check-inline">
                                                    <input type="number" step="0.0001" class="form-control me-2"
                                                        name="yarda_orden" id="yarda_orden" placeholder="..."
                                                        value="{{ isset($auditoriaMarcada) ? $auditoriaMarcada->yarda_orden : '' }}" required />
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="yarda_orden_estatus"
                                                        id="yarda_orden_estatus1" value="1"
                                                        {{ isset($auditoriaMarcada) && $auditoriaMarcada->yarda_orden_estatus == 1 ? 'checked' : '' }} required />
                                                    <label class="label-paloma" for="yarda_orden_estatus1">✔ </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="yarda_orden_estatus"
                                                        id="yarda_orden_estatus2" value="0"
                                                        {{ isset($auditoriaMarcada) && $auditoriaMarcada->yarda_orden_estatus == 0 ? 'checked' : '' }} required />
                                                    <label class="label-tache" for="yarda_orden_estatus2">✖ </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="yarda_marcada" class="col-sm-6 col-form-label">Yardas en la
                                                marcada</label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <div class="form-check form-check-inline">
                                                    <input type="number" step="0.0001" class="form-control me-2"
                                                        name="yarda_marcada" id="yarda_marcada" placeholder="..."
                                                        value="{{ isset($auditoriaMarcada) ? $auditoriaMarcada->yarda_marcada : '' }}" required />
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio"
                                                        name="yarda_marcada_estatus" id="yarda_marcada_estatus1"
                                                        value="1"
                                                        {{ isset($auditoriaMarcada) && $auditoriaMarcada->yarda_marcada_estatus == 1 ? 'checked' : '' }} required />
                                                    <label class="label-paloma" for="yarda_marcada_estatus1">✔ </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio"
                                                        name="yarda_marcada_estatus" id="yarda_marcada_estatus2"
                                                        value="0"
                                                        {{ isset($auditoriaMarcada) && $auditoriaMarcada->yarda_marcada_estatus == 0 ? 'checked' : '' }} required />
                                                    <label class="label-tache" for="yarda_marcada_estatus2">✖ </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="yarda_tendido" class="col-sm-6 col-form-label">Yardas en el
                                                tendido</label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <div class="form-check form-check-inline">
                                                    <input type="number" step="0.0001" class="form-control me-2"
                                                        name="yarda_tendido" id="yarda_tendido" placeholder="..."
                                                        value="{{ isset($auditoriaMarcada) ? $auditoriaMarcada->yarda_tendido : '' }}" required />
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio"
                                                        name="yarda_tendido_estatus" id="yarda_tendido_estatus1"
                                                        value="1"
                                                        {{ isset($auditoriaMarcada) && $auditoriaMarcada->yarda_tendido_estatus == 1 ? 'checked' : '' }} required />
                                                    <label class="label-paloma" for="yarda_tendido_estatus1">✔ </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio"
                                                        name="yarda_tendido_estatus" id="yarda_tendido_estatus2"
                                                        value="0"
                                                        {{ isset($auditoriaMarcada) && $auditoriaMarcada->yarda_tendido_estatus == 0 ? 'checked' : '' }} required />
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
                                                <input type="number" step="0.0001" class="form-control me-2"
                                                    name="talla1" id="talla1" placeholder="..."
                                                    value="{{ isset($auditoriaMarcada) ? $auditoriaMarcada->talla1 : '' }}" required />
                                                <input type="number" step="0.0001" class="form-control me-2"
                                                    name="talla2" id="talla2" placeholder="..."
                                                    value="{{ isset($auditoriaMarcada) ? $auditoriaMarcada->talla2 : '' }}" />
                                                <input type="number" step="0.0001" class="form-control me-2"
                                                    name="talla3" id="talla3" placeholder="..."
                                                    value="{{ isset($auditoriaMarcada) ? $auditoriaMarcada->talla3 : '' }}" />
                                                <input type="number" step="0.0001" class="form-control me-2"
                                                    name="talla4" id="talla4" placeholder="..."
                                                    value="{{ isset($auditoriaMarcada) ? $auditoriaMarcada->talla4 : '' }}" />
                                                <input type="number" step="0.0001" class="form-control me-2"
                                                    name="talla5" id="talla5" placeholder="..."
                                                    value="{{ isset($auditoriaMarcada) ? $auditoriaMarcada->talla5 : '' }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="bulto1" class="col-sm-3 col-form-label"># Bultos</label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <input type="number" step="0.0001" class="form-control me-2"
                                                    name="bulto1" id="bulto1" placeholder="..."
                                                    value="{{ isset($auditoriaMarcada) ? $auditoriaMarcada->bulto1 : '' }}" required />
                                                <input type="number" step="0.0001" class="form-control me-2"
                                                    name="bulto2" id="bulto2" placeholder="..."
                                                    value="{{ isset($auditoriaMarcada) ? $auditoriaMarcada->bulto2 : '' }}" />
                                                <input type="number" step="0.0001" class="form-control me-2"
                                                    name="bulto3" id="bulto3" placeholder="..."
                                                    value="{{ isset($auditoriaMarcada) ? $auditoriaMarcada->bulto3 : '' }}" />
                                                <input type="number" step="0.0001" class="form-control me-2"
                                                    name="bulto4" id="bulto4" placeholder="..."
                                                    value="{{ isset($auditoriaMarcada) ? $auditoriaMarcada->bulto4 : '' }}" />
                                                <input type="number" step="0.0001" class="form-control me-2"
                                                    name="bulto5" id="bulto5" placeholder="..."
                                                    value="{{ isset($auditoriaMarcada) ? $auditoriaMarcada->bulto5 : '' }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="total_pieza1" class="col-sm-3 col-form-label">Total piezas</label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <input type="number" step="0.0001" class="form-control me-2"
                                                    name="total_pieza1" id="total_pieza1" placeholder="..."
                                                    value="{{ isset($auditoriaMarcada) ? $auditoriaMarcada->total_pieza1 : '' }}" required />
                                                <input type="number" step="0.0001" class="form-control me-2"
                                                    name="total_pieza2" id="total_pieza2" placeholder="..."
                                                    value="{{ isset($auditoriaMarcada) ? $auditoriaMarcada->total_pieza2 : '' }}" />
                                                <input type="number" step="0.0001" class="form-control me-2"
                                                    name="total_pieza3" id="total_pieza3" placeholder="..."
                                                    value="{{ isset($auditoriaMarcada) ? $auditoriaMarcada->total_pieza3 : '' }}" />
                                                <input type="number" step="0.0001" class="form-control me-2"
                                                    name="total_pieza4" id="total_pieza4" placeholder="..."
                                                    value="{{ isset($auditoriaMarcada) ? $auditoriaMarcada->total_pieza4 : '' }}" />
                                                <input type="number" step="0.0001" class="form-control me-2"
                                                    name="total_pieza5" id="total_pieza5" placeholder="..."
                                                    value="{{ isset($auditoriaMarcada) ? $auditoriaMarcada->total_pieza4 : '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="largo_trazo" class="col-sm-3 col-form-label">Largo Trazo </label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <input type="number" step="0.0001" class="form-control me-2"
                                                    name="largo_trazo" id="largo_trazo" placeholder="..."
                                                    value="{{ isset($auditoriaMarcada) ? $auditoriaMarcada->largo_trazo : '' }}" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="ancho_trazo" class="col-sm-3 col-form-label">Ancho Trazo </label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <input type="number" step="0.0001" class="form-control me-2"
                                                    name="ancho_trazo" id="ancho_trazo" placeholder="..."
                                                    value="{{ isset($auditoriaMarcada) ? $auditoriaMarcada->ancho_trazo : '' }}" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" name="accion" value="guardar" class="btn btn-success">Guardar</button>
                                        <button type="submit" name="accion" value="finalizar" class="btn btn-danger">Finalizar</button>
                                    </div>
                                </form>
                                {{-- Fin cuerpo acordeon --}}
                            </div>
                        </div>
                    </div>
                    <!--Fin acordeon 1 -->
                    <!--Inicio acordeon 2 -->
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-info btn-block collapsed" data-toggle="collapse"
                                    data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    - - AUDITORIA DE TENDIDO - -
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                {{-- Inicio cuerpo acordeon --}}
                                <form method="POST"
                                    action="{{ route('auditoriaCorte.formAuditoriaTendido', ['id' => $datoAX->id]) }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $datoAX->id }}">
                                    <input type="hidden" name="orden" value="{{ $datoAX->orden }}">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="nombre" class="col-sm-6 col-form-label">NOMBRE TECNICO</label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <select name="nombre" id="nombre" class="form-control"  
                                                    title="Por favor, selecciona una opción">
                                                    <option value="">Selecciona una opción</option>
                                                    @foreach ($CategoriaNoRecibo as $nombre)
                                                        <option value="{{ $nombre->nombre }}" {{ isset($auditoriaTendido) && trim($auditoriaTendido->nombre) === trim($nombre->nombre) ? 'selected' : '' }}>{{ $nombre->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="fecha" class="col-sm-6 col-form-label">Fecha</label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                {{ now()->format('d ') . $mesesEnEspanol[now()->format('n') - 1] . now()->format(' Y') }}
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="mesa" class="col-sm-6 col-form-label">MESA</label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <select name="mesa" id="mesa" class="form-control"  
                                                    title="Por favor, selecciona una opción">
                                                    <option value="">Selecciona una opción</option>
                                                    @foreach ($CategoriaEstilo as $mesa)
                                                        <option value="{{ $mesa->nombre }}" {{ isset($auditoriaTendido) && $auditoriaTendido->mesa == $mesa->nombre ? 'selected' : '' }}>{{ $mesa->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="auditor" class="col-sm-6 col-form-label">AUDITOR</label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <select name="auditor" id="auditor" class="form-control"  
                                                    title="Por favor, selecciona una opción">
                                                    <option value="">Selecciona una opción</option>
                                                    @foreach ($CategoriaAuditor as $auditor)
                                                        <option value="{{ $auditor->nombre }}" {{ isset($auditoriaTendido) && trim($auditoriaTendido->auditor) == trim($auditor->nombre) ? 'selected' : '' }}>{{ $auditor->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="codigo_material" class="col-sm-6 col-form-label">1. Codigo de material</label>
                                            <div class="col-sm-12 d-flex align-items-center" style="margin-right: -5px;">
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado1"
                                                        value="1"  >
                                                    <label class="label-paloma" for="estado1"> ✔ </label>
                                                </div>
                                                <div class="form-check form-check-inline" style="margin-right: -5px;">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado2"
                                                        value="0"  >
                                                    <label class="label-tache" for="estado1"> ✖ </label>
                                                </div>
                                                <input type="text" class="form-control me-2" name="codigo_material"
                                                    id="codigo_material" placeholder=" COMENTARIOS"   />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="codigo_color" class="col-sm-6 col-form-label">2. Codigo de color</label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado1"
                                                        value="1"  >
                                                    <label class="label-paloma" for="estado1"> ✔ </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado2"
                                                        value="0"  >
                                                    <label class="label-tache" for="estado1"> ✖ </label>
                                                </div>
                                                <input type="text" class="form-control me-2" name="codigo_color"
                                                    id="codigo_color" placeholder=" COMENTARIOS"   />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="info_trazo" class="col-sm-6 col-form-label">3. Informacion de trazo</label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado1"
                                                        value="1"  >
                                                    <label class="label-paloma" for="estado1"> ✔ </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado2"
                                                        value="0"  >
                                                    <label class="label-tache" for="estado1"> ✖ </label>
                                                </div>
                                                <input type="text" class="form-control me-2" name="info_trazo" id="info_trazo"
                                                    placeholder=" COMENTARIOS"   />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cantidad_lienzo" class="col-sm-6 col-form-label">4. Cantidad de
                                                lienzos</label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado1"
                                                        value="1"  >
                                                    <label class="label-paloma" for="estado1"> ✔ </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado2"
                                                        value="0"  >
                                                    <label class="label-tache" for="estado1"> ✖ </label>
                                                </div>
                                                <input type="text" class="form-control me-2" name="cantidad_lienzo"
                                                    id="cantidad_lienzo" placeholder=" COMENTARIOS"   />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="longitud_tendido" class="col-sm-6 col-form-label">5. Longitud de
                                                tendido</label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado1"
                                                        value="1"  >
                                                    <label class="label-paloma" for="estado1"> ✔ </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado2"
                                                        value="0"  >
                                                    <label class="label-tache" for="estado1"> ✖ </label>
                                                </div>
                                                <input type="text" class="form-control me-2" name="longitud_tendido"
                                                    id="longitud_tendido" placeholder=" COMENTARIOS"   />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="ancho_tendido" class="col-sm-6 col-form-label">6. Ancho de tendido</label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado1"
                                                        value="1"  >
                                                    <label class="label-paloma" for="estado1"> ✔ </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado2"
                                                        value="0"  >
                                                    <label class="label-tache" for="estado1"> ✖ </label>
                                                </div>
                                                <input type="text" class="form-control me-2" name="ancho_tendido"
                                                    id="ancho_tendido" placeholder=" COMENTARIOS"   />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="material_relajado" class="col-sm-6 col-form-label">7. Material
                                                relajado</label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado1"
                                                        value="1"  >
                                                    <label class="label-paloma" for="estado1"> ✔ </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado2"
                                                        value="0"  >
                                                    <label class="label-tache" for="estado1"> ✖ </label>
                                                </div>
                                                <input type="text" class="form-control me-2" name="material_relajado"
                                                    id="material_relajado" placeholder=" COMENTARIOS"   />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="material_relajado" class="col-sm-6 col-form-label">Accion correctiva </label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <input type="text" class="form-control me-2" name="material_relajado"
                                                    id="material_relajado" placeholder=" COMENTARIOS"   />
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-md-6 mb-3">
                                            <label for="emplame" class="col-sm-6 col-form-label">8. Empalmes</label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado1"
                                                        value="1"  >
                                                    <label class="label-paloma" for="estado1"> ✔ </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado2"
                                                        value="0"  >
                                                    <label class="label-tache" for="estado1"> ✖ </label>
                                                </div>
                                                <input type="text" class="form-control me-2" name="emplame" id="emplame"
                                                    placeholder=" COMENTARIOS"   />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cara_material" class="col-sm-6 col-form-label">9. Cara de material</label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado1"
                                                        value="1"  >
                                                    <label class="label-paloma" for="estado1"> ✔ </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado2"
                                                        value="0"  >
                                                    <label class="label-tache" for="estado1"> ✖ </label>
                                                </div>
                                                <input type="text" class="form-control me-2" name="cara_material"
                                                    id="cara_material" placeholder=" COMENTARIOS"   />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="tono" class="col-sm-6 col-form-label">10. Tonos</label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado1"
                                                        value="1"  >
                                                    <label class="label-paloma" for="estado1"> ✔ </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado2"
                                                        value="0"  >
                                                    <label class="label-tache" for="estado1"> ✖ </label>
                                                </div>
                                                <input type="text" class="form-control me-2" name="tono" id="tono"
                                                    placeholder=" COMENTARIOS"   />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="alineacion_tendido" class="col-sm-6 col-form-label">11. Alineacion de
                                                tendido</label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado1"
                                                        value="1"  >
                                                    <label class="label-paloma" for="estado1"> ✔ </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado2"
                                                        value="0"  >
                                                    <label class="label-tache" for="estado1"> ✖ </label>
                                                </div>
                                                <input type="text" class="form-control me-2" name="alineacion_tendido"
                                                    id="alineacion_tendido" placeholder=" COMENTARIOS"   />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="arruga_tendido" class="col-sm-6 col-form-label">12. Arrugas de tendido</label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado1"
                                                        value="1"  >
                                                    <label class="label-paloma" for="estado1"> ✔ </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado2"
                                                        value="0"  >
                                                    <label class="label-tache" for="estado1"> ✖ </label>
                                                </div>
                                                <input type="text" class="form-control me-2" name="arruga_tendido"
                                                    id="arruga_tendido" placeholder=" COMENTARIOS"   />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="defecto_material" class="col-sm-6 col-form-label">13. defecto de
                                                material</label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado1"
                                                        value="1"  >
                                                    <label class="label-paloma" for="estado1"> ✔ </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="quitar-espacio" type="radio" name="estado" id="estado2"
                                                        value="0"  >
                                                    <label class="label-tache" for="estado1"> ✖ </label>
                                                </div>
                                                <input type="text" class="form-control me-2" name="defecto_material"
                                                    id="defecto_material" placeholder=" COMENTARIOS"   />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="material_relajado" class="col-sm-6 col-form-label">¿Se libera el
                                                tendido?</label>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <input type="text" class="form-control me-2" name="material_relajado"
                                                    id="material_relajado" placeholder=" COMENTARIOS"   />
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                        <button type="submit" class="btn btn-danger">Finalizar</button>
                                    </div>
                                </form>
                                {{-- Fin cuerpo acordeon --}}
                            </div>
                        </div>
                    </div>
                    <!--Fin acordeon 2 -->
                    <!--Inicio acordeon 3 -->
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-info btn-block collapsed" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    - - LECTRA - - 
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordion">
                            <div class="card-body">
                                Contenido del acordeón 3
                            </div>
                        </div>
                    </div>
                    <!--Fin acordeon 3 -->
                    <!--Inicio acordeon 4 -->
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h5 class="mb-0">
                                <button class="btn btn-info btn-block collapsed" data-toggle="collapse"
                                    data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    - - AUDITORIA EN BULTOS - -
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                            <div class="card-body">
                                Contenido del acordeón 4
                            </div>
                        </div>
                    </div>
                    <!--Fin acordeon 4 -->
                    <!--Inicio acordeon 5 -->
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h5 class="mb-0">
                                <button class="btn btn-info btn-block collapsed" data-toggle="collapse"
                                    data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    - - AUDITORIA FINAL - - 
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                            <div class="card-body">
                                Contenido del acordeón 5
                            </div>
                        </div>
                    </div>
                    <!--Fin acordeon 5 -->
                </div>
                <!--Fin div de acordeon -->
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
        <!-- Script para abrir el acordeón correspondiente -->
        <script>
            // Obtenemos el valor del estatus desde el HTML generado por PHP en Laravel
            var estatus = "{{ $datoAX->estatus }}";

            // Verificamos si el valor de estatus se estableció correctamente
            if (estatus) {
                // Mostramos el valor en la página
                document.getElementById("estatusValue").innerText = "Estatus: " + estatus;

                // Dependiendo del valor de estatus, abrimos el acordeón correspondiente
                switch (estatus) {
                    case "primero":
                        // Abre el acordeón 1
                        document.getElementById("collapseOne").classList.add("show");
                        break;
                    case "segundo":
                        // Abre el acordeón 2
                        document.getElementById("collapseTwo").classList.add("show");
                        break;
                    case "tercero":
                        // Abre el acordeón 3
                        document.getElementById("collapseThree").classList.add("show");
                        break;
                    case "cuarto":
                        // Abre el acordeón 4
                        document.getElementById("collapseFour").classList.add("show");
                        break;
                    case "quinto":
                        // Abre el acordeón 5
                        document.getElementById("collapseFive").classList.add("show");
                        break;
                    default:
                        console.log("El valor de estatus no coincide con ninguna opción válida para abrir un acordeón.");
                }
            } else {
                console.log("ERROR: No se pudo obtener el valor de estatus.");
            }
        </script>


    @endsection
