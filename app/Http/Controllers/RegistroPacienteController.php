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

use App\Modelos\Receta;
use App\Modelos\DetalleReceta;
use App\Modelos\Medicamento;
use App\Modelos\DiagnosticoExamen;
use App\Modelos\Cie;



use PDF;
use View;
use Session;
use Hashids;
Use Nexmo;
use Keygen;
use Carbon\Carbon;

use App\Traits\GeneralesTraits;
use App\Traits\RegistroPacienteTraits;

class RegistroPacienteController extends Controller
{
	use RegistroPacienteTraits;
	use GeneralesTraits;

	public function actionRegistroPaciente($idopcion)
	{

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion,'Ver');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/
	    View::share('titulo','Registro Paciente');
		$funcion 				= 	$this;
		$fin					= 	date('Y-m-d',strtotime($this->fin));

		$listacontroles 		= 	Control::where('fecha','=',$fin)->orderby('orden','asc')->where('activo','=',1)->get();
	    $combo_sexo  			= 	$this->rp_generacion_combo_sexo('Seleccione sexo');
	    $combo_doctores  		= 	$this->rp_generacion_combo_doctores('Seleccione doctor','');
	    $combo_tipo_cita  		= 	$this->rp_generacion_combo_resultado_control('Tipo de cita');
	    $sel_tipo_cita 			= 	'';
	    $sel_sexo 				= 	'';
	    $sel_doctor 			= 	'';
	    $ind_paciente 			= 	0;
	    $titulo_paciente		=	'Paciente Nuevo';
	    $campo_disabled 		= 	'';

		return View::make('registrocliente/registrocliente',
						 [				 	
						 	'idopcion' 				=> $idopcion,
						 	'funcion' 				=> $funcion,
						 	'fin' 					=> $fin,
						 	'listacontroles' 		=> $listacontroles,
						 	'combo_sexo' 			=> $combo_sexo,	
						 	'sel_sexo' 				=> $sel_sexo,
						 	'combo_doctores' 		=> $combo_doctores,
						 	'combo_tipo_cita' 		=> $combo_tipo_cita,
						 	'sel_doctor' 			=> $sel_doctor,
						 	'sel_tipo_cita' 		=> $sel_tipo_cita,
						 	'ind_paciente' 			=> $ind_paciente,
						 	'titulo_paciente' 		=> $titulo_paciente,
						 	'campo_disabled' 		=> $campo_disabled,					 	
						 ]);
	}

	public function actionAjaxBuscarPaciente(Request $request) {


		$dni 				= 	trim($request['dni']);
		$paciente 			= 	Paciente::where('dni','=',$dni)->first();
	    $sel_sexo 			= 	'';
	    $sel_tipo_cita 		= 	'';
	    $sel_doctor 		= 	'';
	    $ind_paciente 		= 	0;
	    $funcion 			= 	$this;
		$combo_sexo  		= 	$this->rp_generacion_combo_sexo('Seleccione sexo');
		$combo_doctores  	= 	$this->rp_generacion_combo_doctores('Seleccione doctor','');
		$combo_tipo_cita  	= 	$this->rp_generacion_combo_resultado_control('Tipo de cita');
		$titulo_paciente	=	'Paciente No encontrado';
		$campo_disabled 		= 	'';

		if(count($paciente)>0){
		    $sel_sexo 				= 	$paciente->sexo;
		    $ind_paciente 			= 	1;
		    $titulo_paciente		=	'Paciente encontrado';
		    $campo_disabled 		= 	'readonly';
		}else{
			$paciente 				= 	array();
		}

		return View::make('registrocliente/form/fregistropaciente',
						 [				 	
						 	'funcion' 				=> $funcion,
						 	'combo_sexo' 			=> $combo_sexo,	
						 	'sel_sexo' 				=> $sel_sexo,
						 	'combo_doctores' 		=> $combo_doctores,	
						 	'combo_tipo_cita' 		=> $combo_tipo_cita,
						 	'sel_doctor' 			=> $sel_doctor,
						 	'sel_tipo_cita' 		=> $sel_tipo_cita,
						 	'ind_paciente' 			=> $ind_paciente,
						 	'paciente' 				=> $paciente,
						 	'titulo_paciente' 		=> $titulo_paciente,
						 	'campo_disabled' 		=> $campo_disabled,	
						 	'ajax' 					=> true,					 	
						 ]);


	}


	public function actionAjaxBuscarPacienteRecepcionista(Request $request) {


		$fecha 					= 	date('Y-m-d',strtotime($request['fecha']));
		$listacontroles 		= 	Control::where('fecha','=',$fecha)->orderby('orden','asc')->where('activo','=',1)->get();
		$funcion 				= 	$this;

		return View::make('registrocliente/ajax/alistaatencionpaciente',
						 [				 	
						 	'funcion' 				=> $funcion,
						 	'listacontroles' 		=> $listacontroles,	
						 	'ajax' 					=> true,					 	
						 ]);


	}








	public function actionAgregarControlPaciente($idopcion, Request $request) {
		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion, 'Anadir');
		if ($validarurl != 'true') {return $validarurl;}
		/******************************************************/

		if ($_POST) {

			$ind_paciente 		= 	$request['ind_paciente'];
			$dni 				= 	$request['dni'];
			$apellido_paterno 	= 	strtoupper($request['apellido_paterno']);
			$sexo 				= 	$request['sexo'];
			$direccion 			= 	strtoupper($request['direccion']);
			$doctor_id 			= 	$request['doctor_id'];
			$nombres 			= 	strtoupper($request['nombres']);
			$apellido_materno 	= 	strtoupper($request['apellido_materno']);
			$fecha_nacimiento 	= 	date('Y-m-d', strtotime($request['fecha_nacimiento']));
			$telefono 			= 	$request['telefono'];
			$control_resultado  = 	$request['tipo_cita_id'];

			if($ind_paciente == '0'){
				/**** Validaciones laravel ****/
				$this->validate($request, [
		            'dni' => 'unique:pacientes',
				], [
	            	'dni.unique' => 'Paciente ya registrado',
	        	]);
				/******************************/

				$idpaciente = $this->funciones->getCreateIdMaestra('pacientes');
				$cabecera = new Paciente;
				$cabecera->id = $idpaciente;
				$cabecera->dni = $dni;
				$cabecera->nombres = $nombres;
				$cabecera->apellido_paterno = $apellido_paterno;
				$cabecera->apellido_materno = $apellido_materno;
				$cabecera->sexo = $sexo;
				$cabecera->fecha_nacimiento = $fecha_nacimiento;
				$cabecera->telefono = $telefono;
				$cabecera->direccion = $direccion;
				$cabecera->fecha_crea = $this->fechaactual;
				$cabecera->usuario_crea = Session::get('usuario')->id;
				$cabecera->save();

			}else{



				$cabecera 	= Paciente::where('dni','=',$dni)->first();

				if($control_resultado == '2'){
					//Existe controles para tipo de cita y darle resultados
					$control = Control::where('paciente_id','=',$cabecera->id)
								  		->where('doctor_id','=',$doctor_id)
								  		->orderBy('fecha', 'desc')
								  		->first();

					if(count($control)<=0){
							return Redirect::back()->withInput()->with('errorbd', 'Peciente ' . $nombres . ' no tiene ningun historial para lectura de resultados');	
					}	
				}else{
					//ya exite controles para este paciente el dia de hoy
					$control    = Control::where('paciente_id','=',$cabecera->id)
								  ->where('doctor_id','=',$doctor_id)
								  ->where('activo','=',1)
								  ->where('fecha','=',$this->fecha_sin_hora)->first();

					if(count($control)>0){
							return Redirect::back()->withInput()->with('errorbd', 'Peciente ' . $nombres . ' ya esta en la lista de espera con el doctor seleccionado');			
					}
				}

	
				$cabecera->nombres = $nombres;
				$cabecera->apellido_paterno = $apellido_paterno;
				$cabecera->apellido_materno = $apellido_materno;
				$cabecera->sexo = $sexo;
				$cabecera->fecha_nacimiento = $fecha_nacimiento;
				$cabecera->telefono = $telefono;
				$cabecera->direccion = $direccion;
				$cabecera->fecha_mod = $this->fechaactual;
				$cabecera->usuario_mod = Session::get('usuario')->id;
				$cabecera->save();

				$idpaciente = $cabecera->id;

			}

				$orden = Control::where('fecha','=',$this->fecha_sin_hora)->count();
				$orden = $orden + 1;


				if($control_resultado == '2'){

					$control = Control::where('paciente_id','=',$cabecera->id)
								  		->where('doctor_id','=',$doctor_id)
								  		->orderBy('fecha', 'desc')
								  		->first();

					$control->fecha = date('Y-m-d',strtotime($this->fecha_sin_hora));
					$control->fecha_resultado = $this->fecha_sin_hora;
					$control->control_resultado = $control_resultado;
					$control->ind_atendido = 0;
					$control->orden = $orden;
					$control->save();

				}else{

					$idcontrol = $this->funciones->getCreateIdMaestra('controles');
					$codigo = 	$this->funciones->generar_codigo('controles',8);
					$control = new Control;
					$control->id = $idcontrol;
					$control->anamnesis = '';
					$control->examen_fisico = '';
					$control->plan_trabajo = '';
					$control->tratamiento = '';
					$control->temperatura = '';
					$control->resultado = '';
					$control->pa = '';
					$control->fr = '';
					$control->fc = '';
					$control->talla = 0;
					$control->peso = 0;
					$control->imc = 0;
					$control->ind_atendido = 0;
					$control->codigo = $codigo;
					$control->fecha = $this->fecha_sin_hora;
					$control->control_resultado = $control_resultado;
					$control->fecha_control = $this->fecha_sin_hora;
					// $control->fecha_resultado = '';
					$control->fecha_resultado = null;
					$control->doctor_id = $doctor_id;
					$control->paciente_id = $idpaciente;
					$control->fecha_crea = $this->fechaactual;
					$control->usuario_crea = Session::get('usuario')->id;
					$control->orden = $orden;
					$control->save();
				}

				return Redirect::to('/gestion-de-registro-paciente/' . $idopcion)->with('bienhecho', 'Peciente ' . $nombres . ' en lista de espera');


		}
	}



	public function actionListaAtenderPaciente($idopcion)
	{

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion,'Ver');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/
	    View::share('titulo','Lista Pacientes por atender');
		$funcion 				= 	$this;
		$fin					= 	date('Y-m-d',strtotime($this->fin));

		$listacontroles 		= 	Control::where('fecha','=',$fin)
									->where('doctor_id','=',Session::get('usuario')->id)
									->where('activo','=',1)
									//->orderby('fecha_control','desc')
									->orderby('orden','asc')
									->get();


		return View::make('atenderpaciente/listapacienteatender',
						 [				 	
						 	'idopcion' 				=> $idopcion,
						 	'funcion' 				=> $funcion,
						 	'fin' 					=> $fin,
						 	'listacontroles' 		=> $listacontroles,				 	
						 ]);
	}

	public function actionAjaxBuscarPacienteDoctor(Request $request) {

		$fecha 					= 	date('Y-m-d',strtotime($request['fecha']));
		$idopcion 				= 	$request['idopcion'];
		

		$listacontroles 		= 	Control::where('fecha','=',$fecha)
									->where('doctor_id','=',Session::get('usuario')->id)
									->where('activo','=',1)
									//->orderby('fecha_control','desc')
									->orderby('orden','asc')
									->get();
		$funcion 				= 	$this;

		return View::make('atenderpaciente/ajax/alistaatenderpaciente',
						 [				 	
						 	'funcion' 				=> $funcion,
						 	'listacontroles' 		=> $listacontroles,	
						 	'idopcion' 				=> $idopcion,
						 	'ajax' 					=> true,					 	
						 ]);


	}


	public function actionAtenderPaciente($idopcion,$idcontrol,Request $request)
	{


		$idcontrolenc  			=   $idcontrol;
		$idcontrol 				= 	$this->funciones->decodificarmaestra($idcontrol);

		if ($_POST) {

			$control 			= 	Control::where('id','=',$idcontrol)->first();
			$anamnesis 			= 	$request['anamnesis'];
			$examen_fisico 		= 	$request['examen_fisico'];
			$plan_trabajo 		= 	$request['plan_trabajo'];

			$tratamiento 		= 	$request['tratamiento'];
			$resultado 			= 	$request['resultado'];
			$temperatura 		= 	$request['temperatura'];
			$pa  				= 	$request['pa'];
			$fr 				= 	$request['fr'];
			$fc  				= 	$request['fc'];
			
			$talla  			= 	round($request['talla'],2);
			$peso  				= 	round($request['peso'],2);
			$imc  				= 	round($request['imc'],2);

			$estado  			= 	$request['estado'];


			$files 				= 	$request['files'];

			$listadetalledoc 	= 	DetalleControl::where('control_id','=',$control->id)
										->where('tipo','=','DOC')->get();

			$index 				= 	0;


			if(!is_null($files)){
				foreach($files as $file){

					$numero = count($listadetalledoc)+$index+1;
					$nombre = $control->codigo.'-'.$numero.'-'.$file->getClientOriginalName();
					\Storage::disk('local')->put($nombre,  \File::get($file));

					$iddcontrol = $this->funciones->getCreateIdMaestra('detallecontroles');
					$dcontrol = new DetalleControl;
					$dcontrol->id = $iddcontrol;
					$dcontrol->descripcion = $nombre;
					$dcontrol->tipo = 'DOC';
					$dcontrol->control_id = $idcontrol;
					$dcontrol->fecha_crea = $this->fechaactual;
					$dcontrol->usuario_crea = Session::get('usuario')->id;
					$dcontrol->save();

					$index 				= 	$index + 1;
				}	
			}



			$paciente 			= 	Paciente::where('id','=',$control->paciente_id)->first();

			$control->anamnesis = $anamnesis;
			$control->examen_fisico = $examen_fisico;
			$control->plan_trabajo = $plan_trabajo;
			$control->tratamiento = $tratamiento;
			$control->temperatura = $temperatura;
			$control->resultado = $resultado;
			$control->pa = $pa;
			$control->fr = $fr;
			$control->fc = $fc;
			
			$control->talla = $talla;
			$control->peso = $peso;
			$control->imc = $imc;

			$control->ind_atendido = 1;
			$control->fecha_mod = $this->fechaactual;
			$control->usuario_mod = Session::get('usuario')->id;
			$control->activo = $estado;
			$control->save();

			return Redirect::to('/atender-paciente/'.$idopcion.'/'.$idcontrolenc)->with('bienhecho', 'Peciente ' . $paciente->nombres . ' se atendio');


		}else{

		    View::share('titulo','Atender Paciente');
			$funcion 				= 	$this;
			$fin					= 	$this->fin;

			$control 				= 	Control::where('id','=',$idcontrol)->first();
			$listacontroles 		= 	Control::where('paciente_id','=',$control->paciente_id)
										->where('activo','=',1)
										->orderby('fecha','desc')->get();

			$paciente 				= 	Paciente::where('id','=',$control->paciente_id)->first();
			$edad 					= 	Carbon::parse($paciente->fecha_nacimiento)->age;


			$listadetallecie 		= 	DetalleControl::where('control_id','=',$control->id)
										->where('tipo','=','CIE')->where('activo','=','1')->get();

			$listadetalledoc 		= 	DetalleControl::where('control_id','=',$control->id)
										->where('tipo','=','DOC')->where('activo','=','1')->get();


			// $listadetallerec 		=	Receta::where('control_id','=',$control->id)->where('activo','=',1)->get();
			$combo_medicamentos 	=	$this->gn_generacion_combo_medicamentos('SELECCIONE MEDICAMENTO');	
			$combo_examenes 		=	$this->gn_generacion_combo_examenes('SELECCIONE EXAMEN');	
			$combo_cies 			=	$this->gn_generacion_combo_cies('SELECCIONE DIAGNOSTICO');	
			$combo_dosificacion 	=	$this->gn_generacion_combo_dosificacion('SELECCIONE DOSIFICACION');	
			$listadetallerec 		=	$listadetalledoc;
			$comboestado  			= 	array('1' => 'ACTIVO', '0' => 'ELIMINAR');

			return View::make('atenderpaciente/pacienteatender',
							 [				 	
							 	'idopcion' 				=> $idopcion,
							 	'funcion' 				=> $funcion,
							 	'fin' 					=> $fin,
							 	'listacontroles' 		=> $listacontroles,
							 	'listadetallecie' 		=> $listadetallecie,	
							 	'listadetalledoc' 		=> $listadetalledoc,
							 	'listadetallerec' 		=> $listadetallerec,
							 	'control' 				=> $control,
							 	'paciente' 				=> $paciente,
							 	'comboestado' 			=> $comboestado,
							 	'combo_medicamentos'	=> $combo_medicamentos,
							 	'combo_examenes'		=> $combo_examenes,
							 	'combo_cies'			=> $combo_cies,
							 	'combo_dosificacion'	=> $combo_dosificacion,
							 	'edad' 					=> $edad,			 	
							 ]);


		}



	}

	public function actionAjaxBuscarControlHistorial(Request $request) {

		$idcontrol 				= 	$request['control_id'];
		$idopcion 				= 	$request['idopcion'];
		$control 				= 	Control::where('id','=',$idcontrol)->first();
		$listacontroles 		= 	Control::where('paciente_id','=',$control->paciente_id)
									->orderby('fecha','desc')->get();
		$paciente 				= 	Paciente::where('id','=',$control->paciente_id)->first();
		$edad 					= 	Carbon::parse($paciente->fecha_nacimiento)->age;
		$funcion 				= 	$this;
		$listadetallecie 		= 	DetalleControl::where('control_id','=',$control->id)
										->where('tipo','=','CIE')->where('activo','=','1')->get();

		
		$listadetalledoc 		= 	DetalleControl::where('control_id','=',$control->id)
										->where('tipo','=','DOC')->where('activo','=','1')->get();

		return View::make('atenderpaciente/form/fatenderpaciente',
						 [				 	
						 	'idopcion' 				=> $idopcion,
						 	'funcion' 				=> $funcion,
						 	'listacontroles' 		=> $listacontroles,
						 	'listadetallecie' 		=> $listadetallecie,
						 	'listadetalledoc' 		=> $listadetalledoc,	
						 	'control' 				=> $control,
						 	'paciente' 				=> $paciente,
						 	'edad' 					=> $edad,
						 	'ajax' 					=> true,					 	
						 ]);


	}

	public function actionAjaxAsignarCieControl(Request $request) {

		// $codigocie 				= 	$request['codigocie'];
		// $descripcion 			= 	$request['descripcion'];
		$cie_id 				=	$request['cie_id'];
		$control_id 			= 	$request['control_id'];

		$cie  					=	Cie::where('id','=',$cie_id)->first();
		$codigocie 				=	$cie->codigo;
		$descripcion 			=	$cie->descripcion;

		////////////////////////////////////////////////////////////////////////
		$cabecera 				=	Control::where('id','=',$control_id)->first();
		////////////////////////////////////////////////////////////////////////
		$idcontrol 				= $this->funciones->getCreateIdMaestra('detallecontroles');
		$control 				= new DetalleControl;
		$control->id 			= $idcontrol;
		$control->control_id 	= $control_id;
		$control->codigocie 	= strtoupper($codigocie);
		$control->descripcion 	= strtoupper($descripcion);
		$control->cie_id 		= $cie_id;
		$control->tipo 			= 'CIE';
		$control->fecha_crea 	= $this->fechaactual;
		$control->usuario_crea 	= Session::get('usuario')->id;
		$control->save();
		////////////////////////////////////////////////////////////////////////
		$receta 				= 	new Receta;
		$idreceta 				= 	$this->funciones->getCreateIdMaestra('recetas');
		$receta->id 			= 	$idreceta;
		$receta->diagnostico_id =   $idcontrol;
		$receta->doctor_id 		=   $cabecera->doctor_id;
		$receta->paciente_id 	=   $cabecera->paciente_id;
		$receta->fecha 			= 	date('Y-m-d',strtotime($this->fechaactual));
		$receta->descripcion 	= 	strtoupper($codigocie).'-'.strtoupper($descripcion);
		$receta->fecha_crea 	= 	$this->fechaactual;
		$receta->usuario_crea 	= 	Session::get('usuario')->id;
		$receta->save();
		////////////////////////////////////////////////////////////////////////
		$DiagExamen 				= 	new DiagnosticoExamen;
		$idDiagExamen 				= 	$this->funciones->getCreateIdMaestra('diagnosticoexamen');
		$DiagExamen->id 			= 	$idDiagExamen;
		$DiagExamen->diagnostico_id =   $idcontrol;
		$DiagExamen->doctor_id 		=   $cabecera->doctor_id;
		$DiagExamen->paciente_id 	=   $cabecera->paciente_id;
		$DiagExamen->fecha 			= 	date('Y-m-d',strtotime($this->fechaactual));
		$DiagExamen->descripcion 	= 	strtoupper($codigocie).'-'.strtoupper($descripcion);
		$DiagExamen->fecha_crea 	= 	$this->fechaactual;
		$DiagExamen->usuario_crea 	= 	Session::get('usuario')->id;
		$DiagExamen->save();
		////////////////////////////////////////////////////////////////////////
		$listadetallecie 		= 	DetalleControl::where('control_id','=',$control_id)
									->where('tipo','=','CIE')->where('activo','=','1')->get();
		
		return View::make('atenderpaciente/ajax/alistadiagnostico',
						 [				 	
						 	'listadetallecie' 		=> $listadetallecie,
						 	'ajax' 					=> true,					 	
						 ]);


	}

	public function actionAjaxEliminarCieControl(Request $request) {

		$detalle_control_id 	= 	$request['detalle_control_id'];
		$control_id 			= 	$request['control_id'];
		$control 				= 	DetalleControl::where('id','=',$detalle_control_id)->first();

		$control->activo 		= 	0;
		$control->fecha_mod 	= 	$this->fechaactual;
		$control->usuario_mod 	= 	Session::get('usuario')->id;
		$control->save();


		$receta 				= 	Receta::where('diagnostico_id','=',$detalle_control_id)->first();
		if(count($receta)>0){
			$receta->activo 		= 	0;
			$receta->fecha_mod 		= 	$this->fechaactual;
			$receta->usuario_mod 	= 	Session::get('usuario')->id;
			$receta->save();			
		}

		$listadetallecie 		= 	DetalleControl::where('control_id','=',$control_id)
									->where('tipo','=','CIE')->where('activo','=','1')->get();
		
		return View::make('atenderpaciente/ajax/alistadiagnostico',
						 [				 	
						 	'listadetallecie' 		=> $listadetallecie,
						 	'ajax' 					=> true,					 	
						 ]);


	}
	public function actionAjaxEliminarDocControl(Request $request) {

		$detalle_control_id 	= 	$request['detalle_control_id'];
		$control_id 			= 	$request['control_id'];
		$control 				= 	DetalleControl::where('id','=',$detalle_control_id)->first();

		$control->activo = 0;
		$control->fecha_mod = $this->fechaactual;
		$control->usuario_mod = Session::get('usuario')->id;
		$control->save();

		$listadetalledoc 		= 	DetalleControl::where('control_id','=',$control_id)
									->where('tipo','=','DOC')->where('activo','=','1')->get();
		
		return View::make('atenderpaciente/ajax/alistadocumentos',
						 [				 	
						 	'listadetalledoc' 		=> $listadetalledoc,
						 	'ajax' 					=> true,					 	
						 ]);


	}




	public function actionPopUpDetalleControl($idcontrol,Request $request)
	{

		View::share('titulo','Detalle de Control Pop Up');

		$idcontrol 				= 	$this->funciones->decodificarmaestra($idcontrol);
		$funcion 				= 	$this;

		$control 				= 	Control::where('id','=',$idcontrol)->first();
		$listacontroles 		= 	Control::where('paciente_id','=',$control->paciente_id)
									->orderby('fecha','desc')->get();

		$paciente 				= 	Paciente::where('id','=',$control->paciente_id)->first();
		$edad 					= 	Carbon::parse($paciente->fecha_nacimiento)->age;
		$listadetallecie 		= 	DetalleControl::where('control_id','=',$control->id)
									->where('tipo','=','CIE')->where('activo','=','1')->get();

		return View::make('atenderpaciente/pacientepopup',
						 [				 	
						 	'funcion' 				=> $funcion,
						 	'listacontroles' 		=> $listacontroles,
						 	'listadetallecie' 		=> $listadetallecie,	
						 	'control' 				=> $control,
						 	'paciente' 				=> $paciente,
						 	'edad' 					=> $edad,			 	
						 ]);



	}

	public function actionPdfDetalleControl($idcontrol,Request $request)
	{

		View::share('titulo','Detalle de Control');

		$idcontrol 				= 	$this->funciones->decodificarmaestra($idcontrol);
		$funcion 				= 	$this;

		$control 				= 	Control::where('id','=',$idcontrol)->first();
		$listacontroles 		= 	Control::where('paciente_id','=',$control->paciente_id)
									->orderby('fecha','desc')->get();

		$paciente 				= 	Paciente::where('id','=',$control->paciente_id)->first();
		$edad 					= 	Carbon::parse($paciente->fecha_nacimiento)->age;
		$listadetallecie 		= 	DetalleControl::where('control_id','=',$control->id)
									->where('tipo','=','CIE')->where('activo','=','1')->get();



		$pdf 					= 	PDF::loadView('atenderpaciente.pdf.detallecontrolpedido', 
									[
								 	'funcion' 				=> $funcion,
								 	'listacontroles' 		=> $listacontroles,
								 	'listadetallecie' 		=> $listadetallecie,	
								 	'control' 				=> $control,
								 	'paciente' 				=> $paciente,
								 	'edad' 					=> $edad,								
									]);

		return $pdf->stream('download.pdf');


	}

	public function actionDescargarDocumento($iddetallecontrol,Request $request)
	{

		$iddetallecontrol 				= 	$this->funciones->decodificarmaestra($iddetallecontrol);
		$detallecontrol 				= 	DetalleControl::where('id','=',$iddetallecontrol)->first();
		$path = storage_path('app/'.$detallecontrol->descripcion);
	    if (file_exists($path)) {
	        return Response::download($path);
	    }

	}



	public function actionBuscarPaciente($idopcion)
	{

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion,'Ver');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/
	    View::share('titulo','Buscar Paciente');
		$funcion 				= 	$this;
		$listacontroles         =   array();
		$paciente         		=   array();

		return View::make('buscarpaciente/buscarpaciente',
						 [				 	
						 	'idopcion' 				=> $idopcion,
						 	'funcion' 				=> $funcion,
						 	'listacontroles' 		=> $listacontroles,	
						 	'paciente' 				=> $paciente,				 	
						 ]);
	}


	public function actionAjaxBuscarPacienteXDni(Request $request) {


		$dni 				= 	trim($request['dni']);

		$paciente 			= 	Paciente::where('dni','=',$dni)->first();
		$listacontroles  	=	array();
		if(count($paciente)>0){
			$listacontroles 	= 	Control::where('paciente_id','=',$paciente->id)
								->orderby('fecha','desc')
								->where('activo','=',1)
								->get();

		}
		$funcion 			= 	$this;


		return View::make('buscarpaciente/ajax/alistabuscarpaciente',
						 [				 	
						 	'funcion' 				=> $funcion,
						 	'listacontroles' 		=> $listacontroles,
						 	'paciente' 				=> $paciente,	
						 	'ajax' 					=> true,					 	
						 ]);


	}

	public function actionAjaxModificarPaciente(Request $request) {


		$dni 				= 	$request['dni'];
		$nombres 			= 	$request['nombres'];
		$apellido_paterno 	= 	$request['apellido_paterno'];
		$apellido_materno 	= 	$request['apellido_materno'];
		$telefono 			= 	$request['telefono'];
		$sexo 				= 	$request['sexo'];
		$fecha_nacimiento 	= 	date('Y-m-d', strtotime($request['fecha_nacimiento']));
		$direccion 			= 	$request['direccion'];


		$paciente 			= 	Paciente::where('dni','=',$dni)->first();

		$paciente->nombres  		= $nombres;
		$paciente->apellido_paterno = $apellido_paterno;
		$paciente->apellido_materno = $apellido_materno;
		$paciente->sexo 			= $sexo;
		$paciente->fecha_nacimiento = $fecha_nacimiento;
		$paciente->telefono 		= $telefono;
		$paciente->direccion 		= $direccion;
		$paciente->fecha_mod 		= $this->fechaactual;
		$paciente->usuario_mod 		= Session::get('usuario')->id;
		$paciente->save();


	}


	public function actionAjaxEliminarControl(Request $request) {


		$control_id 		= 	$request['control_id'];
		$control 			= 	Control::where('id','=',$control_id)->first();
		$control->fecha_mod = $this->fechaactual;
		$control->usuario_mod = Session::get('usuario')->id;
		$control->activo 	= 0;
		$control->save();

	}





}
