<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\FormulariosCalidadController;
use App\Http\Controllers\AuditoriaCorteController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::get('/tipoAuditorias', [UserManagementController::class, 'tipoAuditorias']);
Route::post('/AddUser', [UserManagementController::class, 'AddUser'])->name('user.AddUser');
Route::get('/puestos', [UserManagementController::class, 'puestos']);
Route::post('/editUser', [UserManagementController::class, 'editUser'])->name('users.editUser');

Route::post('/blockUser/{noEmpleado}', [UserManagementController::class, 'blockUser'])->name('blockUser');
Route::put('/blockUser/{noEmpleado}', [UserManagementController::class, 'blockUser'])->name('blockUser');

//ruta para generar archivo pdf
Route::get('/descargar-pdf', [PDFController::class, 'descargarPDF']);
//apartado para el primer formuarlio
Route::get('/auditoriaEtiquetas', [FormulariosCalidadController::class, 'auditoriaEtiquetas'])->name('formulariosCalidad.auditoriaEtiquetas');
Route::get('/auditoriaCortes', [FormulariosCalidadController::class, 'auditoriaCortes'])->name('formulariosCalidad.auditoriaCortes');
Route::get('/auditoriaLimpieza', [FormulariosCalidadController::class, 'auditoriaLimpieza'])->name('formulariosCalidad.auditoriaLimpieza');
Route::get('/evaluacionCorte', [FormulariosCalidadController::class, 'evaluacionCorte'])->name('formulariosCalidad.evaluacionCorte');
Route::get('/auditoriaFinalAQL', [FormulariosCalidadController::class, 'auditoriaFinalAQL'])->name('formulariosCalidad.auditoriaFinalAQL');
Route::get('/mostrarAuditoriaEtiquetas', [FormulariosCalidadController::class, 'mostrarAuditoriaEtiquetas'])->name('formulariosCalidad.mostrarAuditoriaEtiquetas'); 
Route::get('/aseguramientoCalidad', [FormulariosCalidadController::class, 'aseguramientoCalidad'])->name('formulariosCalidad.aseguramientoCalidad');
Route::post('/formAseguramientoCalidad', [FormulariosCalidadController::class, 'formAseguramientoCalidad'])->name('formulariosCalidad.formAseguramientoCalidad');
Route::post('/formAuditoriaEtiquetas', [FormulariosCalidadController::class, 'formAuditoriaEtiquetas'])->name('formulariosCalidad.formAuditoriaEtiquetas');
Route::post('/formAuditoriaCortes1', [FormulariosCalidadController::class, 'formAuditoriaCortes1'])->name('formulariosCalidad.formAuditoriaCortes1');
Route::post('/formEvaluacionCorte', [FormulariosCalidadController::class, 'formEvaluacionCorte'])->name('formulariosCalidad.formEvaluacionCorte');
//Apartado para el formulario para mostrar datos filtrados
Route::get('/filtrarDatosEtiquetas', [FormulariosCalidadController::class, 'filtrarDatosEtiquetas'])->name('formulariosCalidad.filtrarDatosEtiquetas');

Route::get('/listaFormularios', [FormulariosCalidadController::class, 'listaFormularios'])->name('listaFormularios');
//aparado para exportar el archivo de excel
Route::get('/exportar-excel', [FormulariosCalidadController::class, 'exportarExcel'])->name('exportar-excel');

Route::get('/controlCalidadEmpaque', [FormulariosCalidadController::class, 'controlCalidadEmpaque'])->name('formulariosCalidad.controlCalidadEmpaque');
Route::post('/formControlCalidadEmpaque', [FormulariosCalidadController::class, 'formControlCalidadEmpaque'])->name('formulariosCalidad.formControlCalidadEmpaque');



//Apartado de una nueva seccion para corte, ya que es uno de los mas grandes 
Route::get('/inicioAuditoriaCorte', [AuditoriaCorteController::class, 'inicioAuditoriaCorte'])->name('auditoriaCorte.inicioAuditoriaCorte'); 
Route::post('/formAuditoriaCortes', [AuditoriaCorteController::class, 'formAuditoriaCortes'])->name('auditoriaCorte.formAuditoriaCortes');

Route::get('/auditoriaCorte/{id}/{orden}', [AuditoriaCorteController::class, 'auditoriaCorte'])->name('auditoriaCorte.auditoriaCorte'); 
Route::post('/formEncabezadoAuditoriaCorte', [AuditoriaCorteController::class, 'formEncabezadoAuditoriaCorte'])->name('auditoriaCorte.formEncabezadoAuditoriaCorte');
Route::post('/formAuditoriaMarcada', [AuditoriaCorteController::class, 'formAuditoriaMarcada'])->name('auditoriaCorte.formAuditoriaMarcada');
Route::post('/formAuditoriaTendido', [AuditoriaCorteController::class, 'formAuditoriaTendido'])->name('auditoriaCorte.formAuditoriaTendido');
Route::post('/formLectra', [AuditoriaCorteController::class, 'formLectra'])->name('auditoriaCorte.formLectra');
Route::post('/formAuditoriaBulto', [AuditoriaCorteController::class, 'formAuditoriaBulto'])->name('auditoriaCorte.formAuditoriaBulto');
Route::post('/formAuditoriaFinal', [AuditoriaCorteController::class, 'formAuditoriaFinal'])->name('auditoriaCorte.formAuditoriaFinal');
