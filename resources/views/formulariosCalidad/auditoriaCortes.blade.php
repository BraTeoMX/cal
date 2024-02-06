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
                        {{--Inicio de Acordeon --}}
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
                                                <input type="text" id="busquedaOrden" class="form-control" placeholder="Buscar por orden">
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
                                                        <td><input type="radio" name="seleccion" value="{{ $dato->id }}"></td> <!-- Nuevo -->
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
                                            <option value="{{ $color->id }}">{{ $color->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
                                <label for="pieza" class="col-sm-6 col-form-label">PIEZAS</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" name="pieza" id="pieza"
                                        placeholder="..."   />
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
                                <label for="trazo" class="col-sm-6 col-form-label">TRAZO</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" name="trazo" id="trazo"
                                        placeholder="..."   />
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
                                <label for="lienzo" class="col-sm-6 col-form-label">LIENZOS</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="lienzo" id="lienzo"
                                        placeholder="..."   />
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </form>
                        <hr>
                        <div style="background: #db8036a2">
                            <h4 style="text-align: center">AUDITORIA DE MARCADA</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="yOrden" class="col-sm-6 col-form-label">Yardas en la orden</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <div class="form-check form-check-inline">
                                        <input type="number" class="form-control me-2" name="yOrden" id="yOrden"
                                            placeholder="..."   />
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="quitar-espacio" type="radio" name="estado" id="estado1"
                                            value="1"  >
                                        <label class="label-paloma" for="estado1">✔ </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="quitar-espacio" type="radio" name="estado" id="estado2"
                                            value="0"  >
                                        <label class="label-tache" for="estado2">✖ </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="yMarcada" class="col-sm-6 col-form-label">Yardas en la marcada</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <div class="form-check form-check-inline">
                                        <input type="number" class="form-control me-2" name="yOrden" id="yOrden"
                                            placeholder="..."   />
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="quitar-espacio" type="radio" name="estado" id="estado1"
                                            value="1"  >
                                        <label class="label-paloma" for="estado1">✔ </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="quitar-espacio" type="radio" name="estado" id="estado2"
                                            value="0"  >
                                        <label class="label-tache" for="estado2">✖ </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="yTendido" class="col-sm-6 col-form-label">Yardas en el tendido</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <div class="form-check form-check-inline">
                                        <input type="number" class="form-control me-2" name="yOrden" id="yOrden"
                                            placeholder="..."   />
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="quitar-espacio" type="radio" name="estado" id="estado1"
                                            value="1"  >
                                        <label class="label-paloma" for="estado1">✔ </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="quitar-espacio" type="radio" name="estado" id="estado2"
                                            value="0"  >
                                        <label class="label-tache" for="estado2">✖ </label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-6 mb-3">
                                <label for="pieza_bulto" class="col-sm-3 col-form-label">Piezas X Bulto </label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <input type="number" class="form-control me-2" name="pieza_bulto" id="pieza_bulto"
                                        placeholder="..."   />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="pieza_total" class="col-sm-3 col-form-label">Piezas Totales</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <input type="number" class="form-control me-2" name="pieza_total" id="pieza_total"
                                        placeholder="..."   />
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-6 mb-3">
                                <label for="talla" class="col-sm-3 col-form-label">Tallas</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <input type="number" class="form-control me-2" name="talla" id="talla"
                                        placeholder="..."   />
                                    <input type="number" class="form-control me-2" name="talla" id="talla"
                                        placeholder="..."   />
                                    <input type="number" class="form-control me-2" name="talla" id="talla"
                                        placeholder="..."   />
                                    <input type="number" class="form-control me-2" name="talla" id="talla"
                                        placeholder="..."   />
                                    <input type="number" class="form-control me-2" name="talla" id="talla"
                                        placeholder="..."   />
                                    <input type="number" class="form-control me-2" name="talla" id="talla"
                                        placeholder="..."   />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="bulto" class="col-sm-3 col-form-label"># Bultos</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <input type="number" class="form-control me-2" name="bulto" id="bulto"
                                        placeholder="..."   />
                                    <input type="number" class="form-control me-2" name="bulto" id="bulto"
                                        placeholder="..."   />
                                    <input type="number" class="form-control me-2" name="bulto" id="bulto"
                                        placeholder="..."   />
                                    <input type="number" class="form-control me-2" name="bulto" id="bulto"
                                        placeholder="..."   />
                                    <input type="number" class="form-control me-2" name="bulto" id="bulto"
                                        placeholder="..."   />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="total_pieza" class="col-sm-3 col-form-label">Total piezas</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <input type="number" class="form-control me-2" name="total_pieza" id="total_pieza"
                                        placeholder="..."   />
                                    <input type="number" class="form-control me-2" name="total_pieza" id="total_pieza"
                                        placeholder="..."   />
                                    <input type="number" class="form-control me-2" name="total_pieza" id="total_pieza"
                                        placeholder="..."   />
                                    <input type="number" class="form-control me-2" name="total_pieza" id="total_pieza"
                                        placeholder="..."   />
                                    <input type="number" class="form-control me-2" name="total_pieza" id="total_pieza"
                                        placeholder="..."   />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="largo_trazo" class="col-sm-3 col-form-label">Largo Trazo </label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <input type="number" class="form-control me-2" name="largo_trazo" id="largo_trazo"
                                        placeholder="..."   />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="ancho_trazo" class="col-sm-3 col-form-label">Ancho Trazo </label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <input type="number" class="form-control me-2" name="ancho_trazo" id="ancho_trazo"
                                        placeholder="..."   />
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div style="background: #32d2d8a2">
                            <h4 style="text-align: center">AUDITORIA DE TENDIDO</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="col-sm-3 col-form-label">NOMBRE</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <select name="nombre" id="nombre" class="form-control"  
                                        title="Por favor, selecciona una opción">
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($CategoriaAuditor as $auditor)
                                            <option value="{{ $auditor->id }}">{{ $auditor->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="col-sm-3 col-form-label">Fecha</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    {{ now()->format('d ') . $mesesEnEspanol[now()->format('n') - 1] . now()->format(' Y') }}
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="mesa" class="col-sm-3 col-form-label">MESA</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <select name="mesa" id="mesa" class="form-control"  
                                        title="Por favor, selecciona una opción">
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($CategoriaAuditor as $auditor)
                                            <option value="{{ $auditor->id }}">{{ $auditor->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="col-sm-3 col-form-label">NOMBRE</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <select name="nombre" id="nombre" class="form-control"  
                                        title="Por favor, selecciona una opción">
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($CategoriaAuditor as $auditor)
                                            <option value="{{ $auditor->id }}">{{ $auditor->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
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
                            <hr>
                        </div>
                        <div style="background: #b41873a2">
                            <h4 style="text-align: center">LECTRA</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="col-sm-3 col-form-label">NOMBRE</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <select name="nombre" id="nombre" class="form-control"  
                                        title="Por favor, selecciona una opción">
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($CategoriaAuditor as $auditor)
                                            <option value="{{ $auditor->id }}">{{ $auditor->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="col-sm-3 col-form-label">Fecha</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    {{ now()->format('d ') . $mesesEnEspanol[now()->format('n') - 1] . now()->format(' Y') }}
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="mesa" class="col-sm-3 col-form-label">MESA</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <select name="mesa" id="mesa" class="form-control"  
                                        title="Por favor, selecciona una opción">
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($CategoriaAuditor as $auditor)
                                            <option value="{{ $auditor->id }}">{{ $auditor->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="col-sm-3 col-form-label">NOMBRE</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <select name="nombre" id="nombre" class="form-control"  
                                        title="Por favor, selecciona una opción">
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($CategoriaAuditor as $auditor)
                                            <option value="{{ $auditor->id }}">{{ $auditor->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-6 mb-3">
                                <label for="simetria_pieza" class="col-sm-6 col-form-label">1. Simetria de piezas</label>
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
                                    <input type="text" class="form-control me-2" name="simetria_pieza_pcs"
                                        id="simetria_pieza_pcs" placeholder="Pcs."   />
                                    <input type="text" class="form-control me-2" name="simetria_pieza"
                                        id="simetria_pieza" placeholder=" COMENTARIOS"   />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="codigo_material" class="col-sm-6 col-form-label">2. piezas completas</label>
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
                                    <input type="text" class="form-control me-2" name="codigo_material"
                                        id="codigo_material" placeholder="Pcs."   />
                                    <input type="text" class="form-control me-2" name="codigo_material"
                                        id="codigo_material" placeholder=" COMENTARIOS"   />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="codigo_material" class="col-sm-6 col-form-label">3. Piezas contra
                                    patron</label>
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
                                    <input type="text" class="form-control me-2" name="codigo_material"
                                        id="codigo_material" placeholder="Pcs."   />
                                    <input type="text" class="form-control me-2" name="codigo_material"
                                        id="codigo_material" placeholder=" COMENTARIOS"   />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="codigo_material" class="col-sm-6 col-form-label">4. Sellado de
                                    paquetes</label>
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
                                    <input type="text" class="form-control me-2" name="codigo_material"
                                        id="codigo_material" placeholder="Pcs."   />
                                    <input type="text" class="form-control me-2" name="codigo_material"
                                        id="codigo_material" placeholder=" COMENTARIOS"   />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="codigo_material" class="col-sm-6 col-form-label">Piezas inspeccionadas</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <input type="text" class="form-control me-2" name="codigo_material"
                                        id="codigo_material" placeholder=" COMENTARIOS"   />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="codigo_material" class="col-sm-6 col-form-label">Defectos</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <input type="text" class="form-control me-2" name="codigo_material"
                                        id="codigo_material" placeholder=" COMENTARIOS"   />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="codigo_material" class="col-sm-6 col-form-label">Porcentaje</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <input type="text" class="form-control me-2" name="codigo_material"
                                        id="codigo_material" placeholder=" COMENTARIOS"   />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="codigo_material" class="col-sm-6 col-form-label">Firma de Aprobado</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <input type="text" class="form-control me-2" name="codigo_material"
                                        id="codigo_material" placeholder=" COMENTARIOS"   />
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div style="background: #18b420a2">
                            <h4 style="text-align: center">AUDITORIA EN BULTOS</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="col-sm-3 col-form-label">NOMBRE</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <select name="nombre" id="nombre" class="form-control"  
                                        title="Por favor, selecciona una opción">
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($CategoriaAuditor as $auditor)
                                            <option value="{{ $auditor->id }}">{{ $auditor->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="col-sm-3 col-form-label">Fecha</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    {{ now()->format('d ') . $mesesEnEspanol[now()->format('n') - 1] . now()->format(' Y') }}
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="mesa" class="col-sm-3 col-form-label">MESA</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <select name="mesa" id="mesa" class="form-control"  
                                        title="Por favor, selecciona una opción">
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($CategoriaAuditor as $auditor)
                                            <option value="{{ $auditor->id }}">{{ $auditor->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="col-sm-3 col-form-label">NOMBRE</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <select name="nombre" id="nombre" class="form-control"  
                                        title="Por favor, selecciona una opción">
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($CategoriaAuditor as $auditor)
                                            <option value="{{ $auditor->id }}">{{ $auditor->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-6 mb-3">
                                <label for="simetria_pieza" class="col-sm-6 col-form-label">1. Cantidad de bultos</label>
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
                                    <input type="text" class="form-control me-2" name="simetria_pieza_pcs"
                                        id="simetria_pieza_pcs" placeholder="Pcs."   />
                                    <input type="text" class="form-control me-2" name="simetria_pieza"
                                        id="simetria_pieza" placeholder=" COMENTARIOS"   />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="codigo_material" class="col-sm-6 col-form-label">2. Piezas por paquete</label>
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
                                    <input type="text" class="form-control me-2" name="codigo_material"
                                        id="codigo_material" placeholder="Pcs."   />
                                    <input type="text" class="form-control me-2" name="codigo_material"
                                        id="codigo_material" placeholder=" COMENTARIOS"   />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="codigo_material" class="col-sm-6 col-form-label">3. Encojimiento</label>
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
                                    <input type="text" class="form-control me-2" name="codigo_material"
                                        id="codigo_material" placeholder="Pcs."   />
                                    <input type="text" class="form-control me-2" name="codigo_material"
                                        id="codigo_material" placeholder=" COMENTARIOS"   />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="codigo_material" class="col-sm-6 col-form-label">4. Ingreso de tikets</label>
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
                                    <input type="text" class="form-control me-2" name="codigo_material"
                                        id="codigo_material" placeholder="Pcs."   />
                                    <input type="text" class="form-control me-2" name="codigo_material"
                                        id="codigo_material" placeholder=" COMENTARIOS"   />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="codigo_material" class="col-sm-6 col-form-label">Piezas
                                    inspeccionadas</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <input type="text" class="form-control me-2" name="codigo_material"
                                        id="codigo_material" placeholder=" COMENTARIOS"   />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="codigo_material" class="col-sm-6 col-form-label">Defectos</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <input type="text" class="form-control me-2" name="codigo_material"
                                        id="codigo_material" placeholder=" COMENTARIOS"   />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="codigo_material" class="col-sm-6 col-form-label">Porcentaje</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <input type="text" class="form-control me-2" name="codigo_material"
                                        id="codigo_material" placeholder=" COMENTARIOS"   />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="codigo_material" class="col-sm-6 col-form-label">Firma de Aprobado</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <input type="text" class="form-control me-2" name="codigo_material"
                                        id="codigo_material" placeholder=" COMENTARIOS"   />
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div style="background: #3518b4a2">
                            <h4 style="text-align: center">AUDITORIA EN BULTOS</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="col-sm-3 col-form-label">AUDTORIA FINAL</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <select name="nombre" id="nombre" class="form-control"  
                                        title="Por favor, selecciona una opción">
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($CategoriaAuditor as $auditor)
                                            <option value="{{ $auditor->id }}">{{ $auditor->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="col-sm-3 col-form-label"> </label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label" for="estado1">APROBADO </label>
                                        <input class="quitar-espacio" type="radio" name="estado" id="estado1"
                                            value="1"  >

                                    </div>
                                    <div class="form-check ">
                                        <label class="form-check-label" for="estado2"> RECHAZADO </label>
                                        <input class="quitar-espacio" type="radio" name="estado" id="estado2"
                                            value="0"  >

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="col-sm-6 col-form-label">SUPERVUSOR DE CORTE</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <select name="nombre" id="nombre" class="form-control"  
                                        title="Por favor, selecciona una opción">
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($CategoriaAuditor as $auditor)
                                            <option value="{{ $auditor->id }}">{{ $auditor->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="col-sm-6 col-form-label">SUPERVUSOR DE LINEA</label>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <select name="nombre" id="nombre" class="form-control"  
                                        title="Por favor, selecciona una opción">
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($CategoriaAuditor as $auditor)
                                            <option value="{{ $auditor->id }}">{{ $auditor->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        <!--Fin de la edicion del codigo para mostrar el contenido-->
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#orden').change(function() {
                var estilo = $('option:selected', this).data('estilo');
                var cliente = $('option:selected', this).data('cliente');
                var color = $('option:selected', this).data('color');
                var material = $('option:selected', this).data('material');

                $('#estilo-p').text(estilo);
                $('#cliente-p').text(cliente);
                $('#color-p').text(color);
                $('#material-p').text(material);
            });
        });
    </script>
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
    </script>
@endsection
