<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

use App\Modelos\Paciente;
use App\Modelos\Control;
use App\Modelos\DetalleControl;

use App\Modelos\Medicamento;

use PDF;
use View;
use Session;
use Hashids;
Use Nexmo;
use Keygen;
use Carbon\Carbon;

use App\Traits\GeneralesTraits;
use App\Traits\RegistroPacienteTraits;

class GestionProductoController extends Controller
{
	use RegistroPacienteTraits;
	use GeneralesTraits;



	// AGREGAR CONTROL PACIENTE
	public function actionAgregarProducto($idopcion, Request $request) {
		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Anadir');
		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/

		if ($_POST) {
			// dd('entro');
			/**** Validaciones laravel ****/
			$this->validate($request, [
	            'codigo' => 'unique:medicamentos',
			], [
            	'codigo.unique' => 'Producto ya registrado',
        	]);
			/******************************/


			// $ind_paciente 		= 	$request['ind_paciente'];
			// $dni 				= 	$request['dni'];
			$codigo 				= 	strtoupper($request['codigo']);
			$unidad 				= 	strtoupper($request['unidad']);
			$descripcion 			= 	strtoupper($request['descripcion']);
			// dd($codigo);
			// dd($request);
			$idmedicamento				= 	$this->funciones->getCreateIdMaestra('medicamentos');
			$medicamento 				= 	new Medicamento;
			$medicamento->id 			= 	$idmedicamento;
			$medicamento->codigo 		= 	$codigo;
			$medicamento->descripcion 	= 	$descripcion;
			$medicamento->unidad 		= 	$unidad;
			$medicamento->fecha_crea 	= 	$this->fechaactual;
			$medicamento->usuario_crea 	= 	Session::get('usuario')->id;

			$medicamento->save();
		
			return Redirect::to('/gestion-de-productos/' . $idopcion)->with('bienhecho', 'Producto ' . $descripcion . ' registrado correctamente.');

		}
		else{


			$rol = DB::table('Rols')->where('id', '<>', $this->prefijomaestro . '00000001')->pluck('nombre', 'id')->toArray();
			// $combounidad = $this->gn_generacion_combo_unidad_medicamentos();

			return View::make('buscarproducto/agregarproducto',
				[
					// 'combounidad' => $combounidad,
					'idopcion' => $idopcion,
				]);


		}
	}


	// LISTAR PRODUCTOS
	public function actionListarProductos($idopcion)
	{

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion,'Ver');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/
	    View::share('titulo','Lista Pacientes por atender');
		$funcion 				= 	$this;
		$fin					= 	$this->fin;

		$listaproductos 		= 	Medicamento::orderby('id','asc')->get();


		return View::make('buscarproducto/listaproductos',
						 [				 	
						 	'idopcion' 				=> $idopcion,
						 	'funcion' 				=> $funcion,
						 	'fin' 					=> $fin,
						 	'listaproductos' 		=> $listaproductos,				 	
						 ]);
	}


	public function actionAjaxEliminarProductoAjax(Request $request) {

		$detalle_control_id 	= 	$request['detalle_control_id'];
		$control_id 			= 	$request['control_id'];
		$control 				= 	DetalleControl::where('id','=',$detalle_control_id)->first();

		$control->activo = 0;
		$control->fecha_mod = $this->fechaactual;
		$control->usuario_mod = Session::get('usuario')->id;
		$control->save();

		$listadetallecie 		= 	DetalleControl::where('control_id','=',$control_id)
									->where('tipo','=','CIE')->where('activo','=','1')->get();
		
		return View::make('atenderpaciente/ajax/alistadiagnostico',
						 [				 	
						 	'listadetallecie' 		=> $listadetallecie,
						 	'ajax' 					=> true,					 	
						 ]);


	}




	public function actionModificarProducto($idopcion, $idproducto, Request $request) {

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Modificar');
		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/
		$idproducto = $this->funciones->decodificarmaestra($idproducto);

		if ($_POST) {

			$cabecera 				= Medicamento::find($idproducto);
			$cabecera->codigo 		= strtoupper($request['codigo']);
			$cabecera->descripcion 	= strtoupper($request['descripcion']);
			$cabecera->fecha_mod 	= $this->fechaactual;
			$cabecera->usuario_mod 	= Session::get('usuario')->id;
			$cabecera->activo = $request['activo'];
			$cabecera->save();

			return Redirect::to('/gestion-de-productos/' . $idopcion)->with('bienhecho', 'Producto ' . $request['codigo'] .' '. $request['descripcion'] . ' modificado con exito');

		} else {

			$medicamento = Medicamento::where('id', $idproducto)->first();
			$funcion = $this;

			return View::make('buscarproducto/modificarproducto',
				[
					'medicamento' => $medicamento,

					'idopcion' => $idopcion,
					'funcion' => $funcion,
				]);
		}
	}





}
