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
use App\User;



use PDF;
use View;
use Session;
use Hashids;
Use Nexmo;
use Keygen;
use Carbon\Carbon;

use App\Traits\GeneralesTraits;
use App\Traits\RegistroPacienteTraits;

class RecetaController extends Controller
{
	use RegistroPacienteTraits;
	use GeneralesTraits;

	public function actionRegistroReceta($idopcion)
	{

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion,'Ver');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/
	    View::share('titulo','Registro Paciente');
		$funcion 				= 	$this;
		$fin					= 	$this->fin;

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



	public function actionAjaxAsignarComboDiagnostico(Request $request) {

		$control_id 			= 	$request['control_id'];

		$array 		= 	DetalleControl::from('detallecontroles as DC')
									->join('recetas as RC','DC.id','=','RC.diagnostico_id')
									->where('DC.control_id','=',$control_id)
									->where('DC.tipo','=','CIE')->where('DC.activo','=','1')
									->pluck('DC.descripcion','RC.id')
									->toArray();
		$combodiagnostico 		=	array(''=>'SELECCIONE DIAGNOSTICO');
		if(count($array)>0){
			$combodiagnostico 		=	array(''=>'SELECCIONE DIAGNOSTICO')+$array;			
		}

		return View::make('atenderpaciente/ajax/combodiagnostico',
						 [				 	
						 	'combodiagnostico' 		=> $combodiagnostico,
						 	'ajax' 					=> true,					 	
						 ]);


	}


	public function actionAjaxCargarListaMedicamentos(Request $request)	{

		$control_id		= 	$request['control_id'];
		$iddetcontrols 	=	DetalleControl::where('tipo','=','CIE')
								->where('activo','=',1)
								->where('control_id','=',$control_id)
								->pluck('id')
								->toArray();

		$idrecetas 		=	Receta::whereIn('diagnostico_id',$iddetcontrols)
								->pluck('id')
								->toArray(); 
		////////////////////////////////////////////////////////////////////////
		$listamedicamentos 		= 	DetalleReceta::whereIn('receta_id',$idrecetas)
									->where('activo','=','1')
									->get();
		// dd($listamedicamentos);
		return View::make('atenderpaciente/ajax/alistamedicamentosreceta',
						 [				 	
						 	'listamedicamentos' 	=> $listamedicamentos,
						 	'ajax' 					=> true,					 	
						 ]);


	}

	public function actionAjaxAsignarMedicamentoReceta(Request $request) {

		$receta_id 				= 	$request['diagnostico_id'];
		$medicamento_id 		= 	$request['medicamento_id'];

		$dias 					= 	$request['dias'];
		$descripcion 			= 	$request['descripcion'];
		$dosificacion 			= 	$request['dosificacion'];
		$indicacion 			= 	$request['indicacion'];
		$cantidad 				= 	$request['cantidad'];

		if(!isset($indicacion)){
			$indicacion='Sin ind.';
		}

		if(!isset($dias)){
			$dias=0;
		}

		if(!isset($cantidad)){
			$cantidad=0;
		}

		$receta 				=	Receta::where('diagnostico_id','=',$receta_id)->first();
		$detallecontrol 		=	DetalleControl::where('id','=',$receta->diagnostico_id)->first(); //una receta
		$control_id 			=	$detallecontrol->control_id;

		$control 				= 	Control::where('id','=',$control_id)->first();
		$iddetcontrols 			=	DetalleControl::where('tipo','=','CIE')
										->where('control_id','=',$control_id)
										->where('activo','=',1)
										->pluck('id')
										->toArray();
		$idrecetas 				= 	Receta::whereIn('diagnostico_id',$iddetcontrols)
										->pluck('id')
										->toArray();

		////////////////////////////////////////////////////////////////////////
		$cabecera 						=	Receta::where('id','=',$receta_id)->first();
		$detallereceta 					= 	new DetalleReceta;
		$idnuevo 						= 	$this->funciones->getCreateIdMaestra('detallerecetas');
		$detallereceta->id 				= 	$idnuevo;
		$detallereceta->receta_id 		=   $receta_id;
		$detallereceta->medicamento_id 	=   $medicamento_id;
		$detallereceta->cantidad 		=   $cantidad;
		$detallereceta->dias 			=   $dias;
		$detallereceta->indicacion 		=   strtoupper($indicacion);
		$detallereceta->dosificacion 	=   $dosificacion;
		$detallereceta->fecha_crea 		= 	$this->fechaactual;
		$detallereceta->usuario_crea 	= 	Session::get('usuario')->id;
		$detallereceta->save();

		////////////////////////////////////////////////////////////////////////
		// $listamedicamentos 		= 	DetalleReceta::where('receta_id','=',$receta_id)
		$listamedicamentos 		= 	DetalleReceta::whereIn('receta_id',$idrecetas)
									->where('activo','=','1')->get();

		return View::make('atenderpaciente/ajax/alistamedicamentosreceta',
						 [				 	
						 	'listamedicamentos' 		=> $listamedicamentos,
						 	'ajax' 					=> true,					 	
						 ]);


	}

	public function actionAjaxEliminarMedicamentoReceta(Request $request) {

		$detalle_control_id 		= 	$request['detalle_control_id'];
		$detallereceta 				= 	DetalleReceta::where('id','=',$detalle_control_id)->first();

		$receta  				=	Receta::where('id','=',$detallereceta->receta_id)->first();
		
		$detallecontrol 		=	DetalleControl::where('id','=',$receta->diagnostico_id)->first(); //una receta
		$control_id 			=	$detallecontrol->control_id;

		$control 				= 	Control::where('id','=',$control_id)->first();
		$iddetcontrols 			=	DetalleControl::where('tipo','=','CIE')
										->where('control_id','=',$control_id)
										->where('activo','=',1)
										->pluck('id')
										->toArray();
		$idrecetas 				= 	Receta::whereIn('diagnostico_id',$iddetcontrols)
										->pluck('id')
										->toArray();
		/////////////////////////////////////////////////////////////////////////
		$receta_id	 				=	$detallereceta->receta_id;
		$detallereceta->activo 		= 	0;
		$detallereceta->fecha_mod 	= 	$this->fechaactual;
		$detallereceta->usuario_mod = 	Session::get('usuario')->id;
		$detallereceta->save();
		////////////////////////////////////////////////////////////////////////
		
		$listamedicamentos 		= 	DetalleReceta::whereIn('receta_id',$idrecetas)
									->where('activo','=','1')->get();

		return View::make('atenderpaciente/ajax/alistamedicamentosreceta',
						 [				 	
						 	'listamedicamentos' 		=> $listamedicamentos,
						 	'ajax' 					=> true,					 	
						 ]);
	}




	// public function actionPopUpDetalleControl($idcontrol,Request $request)
	// {

	// 	View::share('titulo','Detalle de Control Pop Up');

	// 	$idcontrol 				= 	$this->funciones->decodificarmaestra($idcontrol);
	// 	$funcion 				= 	$this;

	// 	$control 				= 	Control::where('id','=',$idcontrol)->first();
	// 	$listacontroles 		= 	Control::where('paciente_id','=',$control->paciente_id)
	// 								->orderby('fecha','desc')->get();

	// 	$paciente 				= 	Paciente::where('id','=',$control->paciente_id)->first();
	// 	$edad 					= 	Carbon::parse($paciente->fecha_nacimiento)->age;
	// 	$listadetallecie 		= 	DetalleControl::where('control_id','=',$control->id)
	// 								->where('tipo','=','CIE')->where('activo','=','1')->get();

	// 	return View::make('atenderpaciente/pacientepopup',
	// 					 [				 	
	// 					 	'funcion' 				=> $funcion,
	// 					 	'listacontroles' 		=> $listacontroles,
	// 					 	'listadetallecie' 		=> $listadetallecie,	
	// 					 	'control' 				=> $control,
	// 					 	'paciente' 				=> $paciente,
	// 					 	'edad' 					=> $edad,			 	
	// 					 ]);



	// }

	public function actionPdfRecetaControl($idcontrol,Request $request)
	{

		View::share('titulo','Detalle de Receta');
		$centro 			=	'RB SERVICIOS MÉDICOS ( FETALCARE - FEMICONTROL)';
		$local 				=	'CHICLAYO';
		$farmacia 			=	'';
		$area 				=	'Consulta externa';
		$especialidad 		=	'Ginecología y Obstetricia';
		$datosempresa 		=	'Av Luis Gonzáles 440 oficina 602';

		$idcontrol 			= 	$this->funciones->decodificarmaestra($idcontrol);
		$funcion 			= 	$this;

		$control 			= 	Control::where('id','=',$idcontrol)->first();
		$medico 			=	User::where('id','=',$control->doctor_id)->first();
		$usuario 			=	User::where('id','=',Session::get('usuario')->id)->first();

		$listacontroles 	= 	Control::where('paciente_id','=',$control->paciente_id)
									->orderby('fecha','desc')->get();

		$paciente 			= 	Paciente::where('id','=',$control->paciente_id)->first();
		$edad 				= 	Carbon::parse($paciente->fecha_nacimiento)->age;
		$listadetallecie 	= 	DetalleControl::where('control_id','=',$control->id)
									->where('tipo','=','CIE')->where('activo','=','1')->get();
		$titulo 			=	'RECETA C'.$control->codigo.' '.$paciente->apellido_paterno.' '.$paciente->apellido_materno.' '.$paciente->nombres;
		$iddetcontrols 		=	DetalleControl::where('tipo','=','CIE')
									->where('activo','=',1)
									->where('control_id','=',$control->id)
									->pluck('id')
									->toArray();

		$idrecetas 			=	Receta::whereIn('diagnostico_id',$iddetcontrols)
									->pluck('id')
									->toArray();
		$listarecetas 		=	Receta::whereIn('diagnostico_id',$iddetcontrols)->get();

		$listamedicamentos 	= 	DetalleReceta::from('detallerecetas as DR')
									->join('recetas as R','R.id','=','DR.receta_id')
									->join('detallecontroles as DC','DC.id','=','R.diagnostico_id')
									->join('controles as C','C.id','=','DC.control_id')
									->select(
											'R.diagnostico_id',
											'DR.*'
										)
									->where('DC.activo','=',1)
									->where('R.activo','=',1)
									->whereIn('DR.receta_id',$idrecetas)
									->where('DR.activo','=',1)
									->orderBy('R.diagnostico_id','asc')
									->get();

		$pdf 				= 	PDF::loadView('atenderpaciente.pdf.formatoreceta', 
									[
								 	'funcion' 				=> 	$funcion,
								 	'listacontroles' 		=> 	$listacontroles,
								 	'listadetallecie' 		=> 	$listadetallecie,	
								 	'control' 				=> 	$control,
								 	'paciente' 				=> 	$paciente,
								 	'edad' 					=> 	$edad,								
								 	'listarecetas'			=> 	$listarecetas,
								 	'listamedicamentos'		=> 	$listamedicamentos,
								 	'medico'				=>	$medico,
								 	'usuario'				=>	$usuario,
								 	'centro' 				=>	$centro,
									'local' 				=>	$local,
									'farmacia' 				=>	$farmacia,
									'area' 					=>	$area,
									'especialidad' 			=>	$especialidad,
									'datosempresa'			=>	$datosempresa,
									]);

		return $pdf->stream($titulo.'.pdf');

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
	    View::share('titulo','Buscar Productos');
		$funcion 				= 	$this;
		$listacontroles         =   array();
		$paciente         		=   array();

		return View::make('buscarproductos/buscarproducto',
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


		$listacontroles 	= 	Control::where('paciente_id','=',$paciente->id)
								->orderby('fecha','desc')
								->where('activo','=',1)
								->get();
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
		$fecha_nacimiento 	= 	$request['fecha_nacimiento'];
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








}
