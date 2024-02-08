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
        // Obtener el dato con el id seleccionado
        $datoAX = DatoAX::find($id);

        $mesesEnEspanol = [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ];

        return view('auditoriaCorte.auditoriaMarcada', array_merge($categorias, ['mesesEnEspanol' => $mesesEnEspanol, 'activePage' => $activePage, 'datoAX' => $datoAX]));
    }

    public function formAuditoriaMarcada(Request $request)
    {
        $activePage ='';
        // Validar los datos del formulario si es necesario
        $request->validate([
            'yarda_orden' => 'required',
            'yarda_orden_estatus' => 'required',
        ]);

        // Obtener el ID seleccionado
        $idSeleccionado = $request->input('id');

        // Realizar la actualización en la base de datos
        $auditoria = DatoAX::find($idSeleccionado);
        $auditoria->yarda_orden = $request->input('yarda_orden');
        $auditoria->yarda_orden_estatus = $request->input('yarda_orden_estatus');
        $auditoria->estatus = "proceso";
        $auditoria->save();
        return back()->with('success', 'Datos guardados correctamente.')->with('activePage', $activePage);
    }

}
