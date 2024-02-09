<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaAuditor;
use App\Models\CategoriaCliente;
use App\Models\CategoriaColor;
use App\Models\CategoriaEstilo;
use App\Models\CategoriaNoRecibo;
use App\Models\CategoriaTallaCantidad;
use App\Models\CategoriaTamañoMuestra;
use App\Models\CategoriaDefecto;
use App\Models\CategoriaTipoDefecto;
use App\Models\AuditoriaMarcada;
use App\Models\AuditoriaTendido;

use App\Exports\DatosExport;
use App\Models\DatoAX;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon; // Asegúrate de importar la clase Carbon

class AuditoriaCorteController extends Controller
{

    // Método privado para cargar las categorías
    private function cargarCategorias() {
        return [
            'CategoriaCliente' => CategoriaCliente::where('estado', 1)->get(),
            'CategoriaColor' => CategoriaColor::where('estado', 1)->get(),
            'CategoriaEstilo' => CategoriaEstilo::where('estado', 1)->get(),
            'CategoriaNoRecibo' => CategoriaNoRecibo::where('estado', 1)->get(),
            'CategoriaTallaCantidad' => CategoriaTallaCantidad::where('estado', 1)->get(),
            'CategoriaTamañoMuestra' => CategoriaTamañoMuestra::where('estado', 1)->get(),
            'CategoriaDefecto' => CategoriaDefecto::where('estado', 1)->get(),
            'CategoriaTipoDefecto' => CategoriaTipoDefecto::where('estado', 1)->get(),
            'CategoriaAuditor' => CategoriaAuditor::where('estado', 1)->get(),
            'DatoAX' => DatoAX::where('estatus', NULL)->get(),
            'DatoAXIniciado' => DatoAX::where('estatus', 'iniciado')->get(),
            'DatoAXProceso' => DatoAX::where('estatus', 'proceso')->get(),
            'DatoAXFin' => DatoAX::where('estatus', 'fin')->get(),
        ];
    }

    public function inicioAuditoriaCorte()
    {
        $activePage ='';
        $categorias = $this->cargarCategorias();


        $mesesEnEspanol = [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ];

        return view('auditoriaCorte.inicioAuditoriaCorte', array_merge($categorias, ['mesesEnEspanol' => $mesesEnEspanol, 'activePage' => $activePage]));
    }

    public function formAuditoriaCortes(Request $request)
    {
        $activePage ='';
        // Validar los datos del formulario si es necesario
        $request->validate([
            'seleccion' => 'required',
            'color' => 'required',
            'pieza' => 'required|numeric',
            'trazo' => 'required|numeric',
            'lienzo' => 'required',
        ]);

        // Obtener el ID seleccionado
        $idSeleccionado = $request->input('seleccion');

        // Realizar la actualización en la base de datos
        $auditoria = DatoAX::find($idSeleccionado);
        $auditoria->color = $request->input('color');
        $auditoria->pieza = $request->input('pieza');
        $auditoria->trazo = $request->input('trazo');
        $auditoria->lienzo = $request->input('lienzo');
        // Establecer fecha_inicio con la fecha y hora actual
        $auditoria->fecha_inicio = Carbon::now()->format('Y-m-d H:i:s');
        $auditoria->estatus = "iniciado";
        $auditoria->save();
        return back()->with('success', 'Datos guardados correctamente.')->with('activePage', $activePage);
    }

    public function auditoriaMarcada($id)
    {
        $activePage ='';
        $categorias = $this->cargarCategorias();
        // Obtener el dato con el id seleccionado y el valor de la columna "orden"
        $datoAX = DatoAX::select('id','estatus', 'orden', 'cliente', 'estilo', 'material', 'color', 'pieza', 'trazo', 'lienzo')->find($id);

        $mesesEnEspanol = [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ];
        // Obtener el registro correspondiente en la tabla AuditoriaMarcada si existe
        $auditoriaMarcada = AuditoriaMarcada::where('dato_ax_id', $id)->first();
        $auditoriaTendido = AuditoriaTendido::where('dato_ax_id', $id)->first();
        return view('auditoriaCorte.auditoriaMarcada', array_merge($categorias, [
            'mesesEnEspanol' => $mesesEnEspanol, 
            'activePage' => $activePage, 
            'datoAX' => $datoAX, 
            'auditoriaMarcada' => $auditoriaMarcada,
            'auditoriaTendido' => $auditoriaTendido,]));
    }

    public function formAuditoriaMarcada(Request $request)
    {
        $activePage ='';
        // Validar los datos del formulario si es necesario
        // Obtener el ID seleccionado desde el formulario
        $idSeleccionado = $request->input('id');
        $orden = $request->input('orden');

        // Verificar si ya existe un registro con el mismo valor de orden_id
        $existeOrden = AuditoriaMarcada::where('orden_id', $orden)->first();

        // Si ya existe un registro con el mismo valor de orden_id, puedes mostrar un mensaje de error o tomar alguna otra acción
        if ($existeOrden) {
            $existeOrden->yarda_orden = $request->input('yarda_orden');
            $existeOrden->yarda_orden_estatus = $request->input('yarda_orden_estatus');
            $existeOrden->yarda_marcada = $request->input('yarda_marcada');
            $existeOrden->yarda_marcada_estatus = $request->input('yarda_marcada_estatus');
            $existeOrden->yarda_tendido = $request->input('yarda_tendido');
            $existeOrden->yarda_tendido_estatus = $request->input('yarda_tendido_estatus');
            $existeOrden->talla1 = $request->input('talla1');
            $existeOrden->talla2 = $request->input('talla2');
            $existeOrden->talla3 = $request->input('talla3');
            $existeOrden->talla4 = $request->input('talla4');
            $existeOrden->talla5 = $request->input('talla5');
            $existeOrden->talla6 = $request->input('talla6');
            $existeOrden->talla7 = $request->input('talla7');
            $existeOrden->talla8 = $request->input('talla8');
            $existeOrden->talla9 = $request->input('talla9');
            $existeOrden->talla10 = $request->input('talla10');
            $existeOrden->bulto1 = $request->input('bulto1');
            $existeOrden->bulto2 = $request->input('bulto2');
            $existeOrden->bulto3 = $request->input('bulto3');
            $existeOrden->bulto4 = $request->input('bulto4');
            $existeOrden->bulto5 = $request->input('bulto5');
            $existeOrden->bulto6 = $request->input('bulto6');
            $existeOrden->bulto7 = $request->input('bulto7');
            $existeOrden->bulto8 = $request->input('bulto8');
            $existeOrden->bulto9 = $request->input('bulto9');
            $existeOrden->bulto10 = $request->input('bulto10');
            $existeOrden->total_pieza1 = $request->input('total_pieza1');
            $existeOrden->total_pieza2 = $request->input('total_pieza2');
            $existeOrden->total_pieza3 = $request->input('total_pieza3');
            $existeOrden->total_pieza4 = $request->input('total_pieza4');
            $existeOrden->total_pieza5 = $request->input('total_pieza5');
            $existeOrden->total_pieza6 = $request->input('total_pieza6');
            $existeOrden->total_pieza7 = $request->input('total_pieza7');
            $existeOrden->total_pieza8 = $request->input('total_pieza8');
            $existeOrden->total_pieza9 = $request->input('total_pieza9');
            $existeOrden->total_pieza10 = $request->input('total_pieza10');
            $existeOrden->largo_trazo =  $request->input('largo_trazo');
            $existeOrden->ancho_trazo = $request->input('ancho_trazo');
            $existeOrden->save();
            
            return back()->with('sobre-escribir', 'Actualilzacion realizada con exito');
        }

        // Realizar la actualización en la base de datos usando el modelo AuditoriaMarcada
        $auditoria = new AuditoriaMarcada(); // Crear una nueva instancia del modelo
        $auditoria->dato_ax_id = $idSeleccionado; // Asignar el ID obtenido desde la vista
        $auditoria->orden_id = $orden; // Aquí asumiendo que la columna en la tabla auditoria_marcadas se llama "orden_id"
        $auditoria->estatus = "proceso";
        $auditoria->yarda_orden = $request->input('yarda_orden');
        $auditoria->yarda_orden_estatus = $request->input('yarda_orden_estatus');
        $auditoria->yarda_marcada = $request->input('yarda_marcada');
        $auditoria->yarda_marcada_estatus = $request->input('yarda_marcada_estatus');
        $auditoria->yarda_tendido = $request->input('yarda_tendido');
        $auditoria->yarda_tendido_estatus = $request->input('yarda_tendido_estatus');
        $auditoria->talla1 = $request->input('talla1');
        $auditoria->talla2 = $request->input('talla2');
        $auditoria->talla3 = $request->input('talla3');
        $auditoria->talla4 = $request->input('talla4');
        $auditoria->talla5 = $request->input('talla5');
        $auditoria->talla6 = $request->input('talla6');
        $auditoria->talla7 = $request->input('talla7');
        $auditoria->talla8 = $request->input('talla8');
        $auditoria->talla9 = $request->input('talla9');
        $auditoria->talla10 = $request->input('talla10');
        $auditoria->bulto1 = $request->input('bulto1');
        $auditoria->bulto2 = $request->input('bulto2');
        $auditoria->bulto3 = $request->input('bulto3');
        $auditoria->bulto4 = $request->input('bulto4');
        $auditoria->bulto5 = $request->input('bulto5');
        $auditoria->bulto6 = $request->input('bulto6');
        $auditoria->bulto7 = $request->input('bulto7');
        $auditoria->bulto8 = $request->input('bulto8');
        $auditoria->bulto9 = $request->input('bulto9');
        $auditoria->bulto10 = $request->input('bulto10');
        $auditoria->total_pieza1 = $request->input('total_pieza1');
        $auditoria->total_pieza2 = $request->input('total_pieza2');
        $auditoria->total_pieza3 = $request->input('total_pieza3');
        $auditoria->total_pieza4 = $request->input('total_pieza4');
        $auditoria->total_pieza5 = $request->input('total_pieza5');
        $auditoria->total_pieza6 = $request->input('total_pieza6');
        $auditoria->total_pieza7 = $request->input('total_pieza7');
        $auditoria->total_pieza8 = $request->input('total_pieza8');
        $auditoria->total_pieza9 = $request->input('total_pieza9');
        $auditoria->total_pieza10 = $request->input('total_pieza10');
        $auditoria->largo_trazo =  $request->input('largo_trazo');
        $auditoria->ancho_trazo = $request->input('ancho_trazo');
        
        $auditoria->save();
        return back()->with('success', 'Datos guardados correctamente.')->with('activePage', $activePage);
    }

    public function formAuditoriaTendido(Request $request)
    {
        $activePage ='';
        // Validar los datos del formulario si es necesario
        // Obtener el ID seleccionado desde el formulario
        $idSeleccionado = $request->input('id');
        $orden = $request->input('orden');

        // Verificar si ya existe un registro con el mismo valor de orden_id
        $existeOrden = AuditoriaTendido::where('orden_id', $orden)->first();

        // Si ya existe un registro con el mismo valor de orden_id, puedes mostrar un mensaje de error o tomar alguna otra acción
        if ($existeOrden) {
            $existeOrden->nombre = $request->input('nombre');
            $existeOrden->mesa = $request->input('mesa');
            $existeOrden->auditor = $request->input('auditor');
            $existeOrden->yarda_orden = $request->input('yarda_orden');
            $existeOrden->yarda_orden_estatus = $request->input('yarda_orden_estatus');
            $existeOrden->yarda_marcada = $request->input('yarda_marcada');
            $existeOrden->yarda_marcada_estatus = $request->input('yarda_marcada_estatus');
            $existeOrden->yarda_tendido = $request->input('yarda_tendido');
            $existeOrden->yarda_tendido_estatus = $request->input('yarda_tendido_estatus');
            $existeOrden->talla1 = $request->input('talla1');
            $existeOrden->talla2 = $request->input('talla2');
            $existeOrden->talla3 = $request->input('talla3');
            $existeOrden->talla4 = $request->input('talla4');
            $existeOrden->talla5 = $request->input('talla5');
            $existeOrden->talla6 = $request->input('talla6');
            $existeOrden->talla7 = $request->input('talla7');
            $existeOrden->talla8 = $request->input('talla8');
            $existeOrden->talla9 = $request->input('talla9');
            $existeOrden->talla10 = $request->input('talla10');
            $existeOrden->bulto1 = $request->input('bulto1');
            $existeOrden->bulto2 = $request->input('bulto2');
            $existeOrden->bulto3 = $request->input('bulto3');
            $existeOrden->bulto4 = $request->input('bulto4');
            $existeOrden->bulto5 = $request->input('bulto5');
            $existeOrden->bulto6 = $request->input('bulto6');
            $existeOrden->bulto7 = $request->input('bulto7');
            $existeOrden->bulto8 = $request->input('bulto8');
            $existeOrden->bulto9 = $request->input('bulto9');
            $existeOrden->bulto10 = $request->input('bulto10');
            $existeOrden->total_pieza1 = $request->input('total_pieza1');
            $existeOrden->total_pieza2 = $request->input('total_pieza2');
            $existeOrden->total_pieza3 = $request->input('total_pieza3');
            $existeOrden->total_pieza4 = $request->input('total_pieza4');
            $existeOrden->total_pieza5 = $request->input('total_pieza5');
            $existeOrden->total_pieza6 = $request->input('total_pieza6');
            $existeOrden->total_pieza7 = $request->input('total_pieza7');
            $existeOrden->total_pieza8 = $request->input('total_pieza8');
            $existeOrden->total_pieza9 = $request->input('total_pieza9');
            $existeOrden->total_pieza10 = $request->input('total_pieza10');
            $existeOrden->largo_trazo =  $request->input('largo_trazo');
            $existeOrden->ancho_trazo = $request->input('ancho_trazo');
            $existeOrden->save();
            
            return back()->with('sobre-escribir', 'Actualilzacion realizada con exito');
        }

        // Realizar la actualización en la base de datos usando el modelo AuditoriaTendido
        $auditoria = new AuditoriaTendido(); // Crear una nueva instancia del modelo
        $auditoria->dato_ax_id = $idSeleccionado; // Asignar el ID obtenido desde la vista
        $auditoria->orden_id = $orden; // Aquí asumiendo que la columna en la tabla auditoria_marcadas se llama "orden_id"
        $auditoria->estatus = "proceso";
        $auditoria->nombre = $request->input('nombre');
        $auditoria->mesa = $request->input('mesa');
        $auditoria->auditor = $request->input('auditor');
        $auditoria->yarda_orden = $request->input('yarda_orden');
        $auditoria->yarda_orden_estatus = $request->input('yarda_orden_estatus');
        $auditoria->yarda_marcada = $request->input('yarda_marcada');
        $auditoria->yarda_marcada_estatus = $request->input('yarda_marcada_estatus');
        $auditoria->yarda_tendido = $request->input('yarda_tendido');
        $auditoria->yarda_tendido_estatus = $request->input('yarda_tendido_estatus');
        $auditoria->talla1 = $request->input('talla1');
        $auditoria->talla2 = $request->input('talla2');
        $auditoria->talla3 = $request->input('talla3');
        $auditoria->talla4 = $request->input('talla4');
        $auditoria->talla5 = $request->input('talla5');
        $auditoria->talla6 = $request->input('talla6');
        $auditoria->talla7 = $request->input('talla7');
        $auditoria->talla8 = $request->input('talla8');
        $auditoria->talla9 = $request->input('talla9');
        $auditoria->talla10 = $request->input('talla10');
        $auditoria->bulto1 = $request->input('bulto1');
        $auditoria->bulto2 = $request->input('bulto2');
        $auditoria->bulto3 = $request->input('bulto3');
        $auditoria->bulto4 = $request->input('bulto4');
        $auditoria->bulto5 = $request->input('bulto5');
        $auditoria->bulto6 = $request->input('bulto6');
        $auditoria->bulto7 = $request->input('bulto7');
        $auditoria->bulto8 = $request->input('bulto8');
        $auditoria->bulto9 = $request->input('bulto9');
        $auditoria->bulto10 = $request->input('bulto10');
        $auditoria->total_pieza1 = $request->input('total_pieza1');
        $auditoria->total_pieza2 = $request->input('total_pieza2');
        $auditoria->total_pieza3 = $request->input('total_pieza3');
        $auditoria->total_pieza4 = $request->input('total_pieza4');
        $auditoria->total_pieza5 = $request->input('total_pieza5');
        $auditoria->total_pieza6 = $request->input('total_pieza6');
        $auditoria->total_pieza7 = $request->input('total_pieza7');
        $auditoria->total_pieza8 = $request->input('total_pieza8');
        $auditoria->total_pieza9 = $request->input('total_pieza9');
        $auditoria->total_pieza10 = $request->input('total_pieza10');
        $auditoria->largo_trazo =  $request->input('largo_trazo');
        $auditoria->ancho_trazo = $request->input('ancho_trazo');
        
        $auditoria->save();
        return back()->with('success', 'Datos guardados correctamente.')->with('activePage', $activePage);
    }

}
