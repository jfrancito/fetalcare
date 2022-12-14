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
use App\Modelos\Cie as Registro;
use App\Modelos\Receta;
use App\Modelos\DetalleReceta;

use PDF;
use View;
use Session;
use Hashids;
Use Nexmo;
use Keygen;
use Carbon\Carbon;

use App\Traits\GeneralesTraits;
use App\Traits\RegistroPacienteTraits;


class GestionCieController extends Controller
{
	use RegistroPacienteTraits;
	use GeneralesTraits;


	// AGREGAR 
	public function actionAgregarCie($idopcion, Request $request) {
		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Anadir');
		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/

		if ($_POST) {
			// dd('entro');
			/**** Validaciones laravel ****/
			$this->validate($request, [
	            'codigo' => 'unique:cies',
			], [
            	'codigo.unique' => 'Codigo de CIE ya registrado',
        	]);
			/******************************/


			$codigo 				= 	strtoupper($request['codigo']);

			$descripcion 			= 	strtoupper($request['descripcion']);

			$idregistro				= 	$this->funciones->getCreateIdMaestra('cies');
			$registro 				= 	new Registro;
			$registro->id 			= 	$idregistro;
			$registro->codigo 		= 	$codigo;
			$registro->descripcion 	= 	$descripcion;
			$registro->fecha_crea 	= 	$this->fechaactual;
			$registro->usuario_crea 	= 	Session::get('usuario')->id;

			$registro->save();
		
			return Redirect::to('/gestion-de-cie/' . $idopcion)->with('bienhecho', 'Cie ' . $descripcion . ' registrado correctamente.');

		}
		else{


			// $combounidad = $this->gn_generacion_combo_unidad_Cie();

			return View::make('cie/agregarregistro',
				[
					// 'combounidad' => $combounidad,
					'idopcion' => $idopcion,
				]);


		}
	}


	// LISTAR 
	public function actionListarCie($idopcion)
	{

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion,'Ver');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/
	    View::share('titulo','Lista CIE');
		$funcion 				= 	$this;
		$fin					= 	$this->fin;

		$listadatos 		= 	Registro::orderby('id','asc')->get();


		return View::make('cie/listaregistros',
						 [				 	
						 	'idopcion' 				=> $idopcion,
						 	'funcion' 				=> $funcion,
						 	'fin' 					=> $fin,
						 	'listadatos' 		=> $listadatos,				 	
						 ]);
	}


	public function actionAjaxEliminarCieAjax(Request $request) {

		$detalle_control_id 	= 	$request['detalle_control_id'];
		$control_id 			= 	$request['control_id'];
		$control 				= 	DetalleControl::where('id','=',$detalle_control_id)->first();

		$control->activo = 0;
		$control->fecha_mod = $this->fechaactual;
		$control->usuario_mod = Session::get('usuario')->id;
		$control->save();

		$listadetallecie 		= 	DetalleControl::where('control_id','=',$control_id)
									->where('tipo','=','CIE')->where('activo','=','1')->get();
		
		return View::make('atenderpaciente/ajax/alistaregistro',
						 [				 	
						 	'listadetallecie' 		=> $listadetallecie,
						 	'ajax' 					=> true,					 	
						 ]);


	}



	//MODIFICAR
	public function actionModificarCie($idopcion, $idproducto, Request $request) {

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Modificar');
		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/
		$idproducto = $this->funciones->decodificarmaestra($idproducto);

		if ($_POST) {

			$cabecera 				= Registro::find($idproducto);
			$cabecera->codigo 		= strtoupper($request['codigo']);
			$cabecera->descripcion 	= strtoupper($request['descripcion']);
			$cabecera->fecha_mod 	= $this->fechaactual;
			$cabecera->usuario_mod 	= Session::get('usuario')->id;
			$cabecera->activo = $request['activo'];
			$cabecera->save();

			return Redirect::to('/gestion-de-cie/' . $idopcion)->with('bienhecho', 'Cie ' . $request['codigo'] .' '. $request['descripcion'] . ' modificado con exito');

		} else {

			$registro = Registro::where('id', $idproducto)->first();
			$funcion = $this;

			return View::make('cie/modificarregistro',
				[
					'registro' => $registro,
					'idopcion' => $idopcion,
					'funcion' => $funcion,
				]);
		}
	}



}
