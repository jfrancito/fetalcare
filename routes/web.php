<?php

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

/********************** USUARIOS *************************/
// header('Access-Control-Allow-Origin:  *');
// header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
// header('Access-Control-Allow-Headers: *');

Route::group(['middleware' => ['guestaw']], function () {

	Route::any('/', 'UserController@actionLogin');
	Route::any('/login', 'UserController@actionLogin');
	Route::any('/acceso', 'UserController@actionAcceso');

});

Route::get('/cerrarsession', 'UserController@actionCerrarSesion');

Route::group(['middleware' => ['authaw']], function () {

	Route::get('/bienvenido', 'UserController@actionBienvenido');

	Route::any('/gestion-de-usuarios/{idopcion}', 'UserController@actionListarUsuarios');
	Route::any('/agregar-usuario/{idopcion}', 'UserController@actionAgregarUsuario');
	Route::any('/modificar-usuario/{idopcion}/{idusuario}', 'UserController@actionModificarUsuario');
	Route::any('/ajax-activar-perfiles', 'UserController@actionAjaxActivarPerfiles');

	Route::any('/gestion-de-roles/{idopcion}', 'UserController@actionListarRoles');
	Route::any('/agregar-rol/{idopcion}', 'UserController@actionAgregarRol');
	Route::any('/modificar-rol/{idopcion}/{idrol}', 'UserController@actionModificarRol');

	Route::any('/gestion-de-permisos/{idopcion}', 'UserController@actionListarPermisos');
	Route::any('/ajax-listado-de-opciones', 'UserController@actionAjaxListarOpciones');
	Route::any('/ajax-activar-permisos', 'UserController@actionAjaxActivarPermisos');

	Route::any('/gestion-de-registro-paciente/{idopcion}', 'RegistroPacienteController@actionRegistroPaciente');
	Route::any('/agregar-control-paciente/{idopcion}', 'RegistroPacienteController@actionAgregarControlPaciente');
	Route::any('/ajax-buscar-paciente', 'RegistroPacienteController@actionAjaxBuscarPaciente');
	Route::any('/ajax-buscar-controles-recepcionista-xdia', 'RegistroPacienteController@actionAjaxBuscarPacienteRecepcionista');
	Route::any('/ajax-buscar-controles-doctor-xdia', 'RegistroPacienteController@actionAjaxBuscarPacienteDoctor');

	Route::any('/ajax-buscar-control-historial', 'RegistroPacienteController@actionAjaxBuscarControlHistorial');

	Route::any('/gestion-de-atender-paciente/{idopcion}', 'RegistroPacienteController@actionListaAtenderPaciente');
	Route::any('/atender-paciente/{idopcion}/{idcontrol}', 'RegistroPacienteController@actionAtenderPaciente');
	Route::any('/ajax-asignar-cie-control', 'RegistroPacienteController@actionAjaxAsignarCieControl');
	Route::any('/ajax-eliminar-cie-control', 'RegistroPacienteController@actionAjaxEliminarCieControl');
	Route::any('/ajax-eliminar-doc-control', 'RegistroPacienteController@actionAjaxEliminarDocControl');




	Route::any('/pop-up-detalle-control/{idcontrol}', 'RegistroPacienteController@actionPopUpDetalleControl');
	Route::any('/pdf-detalle-control/{idcontrol}', 'RegistroPacienteController@actionPdfDetalleControl');
	Route::any('/descargar-documento-control/{iddetallecontrol}', 'RegistroPacienteController@actionDescargarDocumento');


	Route::any('/gestion-de-buscar-paciente/{idopcion}', 'RegistroPacienteController@actionBuscarPaciente');
	Route::any('/ajax-buscar-paciente-xdni', 'RegistroPacienteController@actionAjaxBuscarPacienteXDni');
	Route::any('/ajax-modificar-paciente', 'RegistroPacienteController@actionAjaxModificarPaciente');
	Route::any('/ajax-eliminar-control', 'RegistroPacienteController@actionAjaxEliminarControl');



	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////	GESTION RECETA
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	Route::any('/ajax-eliminar-medicamento-receta', 'RecetaController@actionAjaxEliminarMedicamentoReceta');
	Route::any('/ajax-asignar-medicamento-receta', 'RecetaController@actionAjaxAsignarMedicamentoReceta');
	Route::any('/ajax-asignar-combo-diagnostico', 'RecetaController@actionAjaxAsignarComboDiagnostico');
	Route::any('/ajax-cargar-lista-medicamentos', 'RecetaController@actionAjaxCargarListaMedicamentos');
	Route::any('/pdf-receta-control/{idcontrol}', 'RecetaController@actionPdfRecetaControl');
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////	GESTION PRODUCTO
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	Route::any('/gestion-de-productos/{idopcion}', 'GestionProductoController@actionListarProductos');
	Route::any('/agregar-producto/{idopcion}', 'GestionProductoController@actionAgregarProducto');
	Route::any('/modificar-producto/{idopcion}/{idproducto}', 'GestionProductoController@actionModificarProducto');
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	


	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////	GESTION EXAMENES
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	Route::any('/gestion-de-examenes/{idopcion}', 'GestionExamenesController@actionListarExamenes');
	Route::any('/agregar-examenes/{idopcion}', 'GestionExamenesController@actionAgregarExamenes');
	Route::any('/modificar-examenes/{idopcion}/{idproducto}', 'GestionExamenesController@actionModificarExamenes');
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////	GESTION DIAGNOSTICO EXAMENES
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	Route::any('/ajax-asignar-combo-diagnostico-examen', 'GestionDiagnosticoExamenesController@actionAjaxAsignarComboDiagnosticoExamen');
	Route::any('/ajax-cargar-lista-examenes', 'GestionDiagnosticoExamenesController@actionAjaxCargarListaExamenes');
	Route::any('/ajax-asignar-diagnostico-examen', 'GestionDiagnosticoExamenesController@actionAjaxAsignarDiagnosticoExamen');
	Route::any('/ajax-eliminar-diagnostico-examen', 'GestionDiagnosticoExamenesController@actionAjaxEliminarDiagnosticoExamen');
	Route::any('/pdf-diagnostico-examen/{idcontrol}', 'GestionDiagnosticoExamenesController@actionPdfDiagnosticoExamen');
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	


	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////	GESTION CIES
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	Route::any('/gestion-de-cie/{idopcion}', 'GestionCieController@actionListarCie');
	Route::any('/agregar-cie/{idopcion}', 'GestionCieController@actionAgregarCie');
	Route::any('/modificar-cie/{idopcion}/{idproducto}', 'GestionCieController@actionModificarCie');
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



});


