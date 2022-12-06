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
use App\Modelos\Examen as Registro;
use App\Modelos\Receta;
use App\Modelos\DetalleReceta;

use App\Modelos\DiagnosticoExamen;
use App\Modelos\DetalleDiagnosticoExamen;
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


class GestionDiagnosticoExamenesController extends Controller
{
	use RegistroPacienteTraits;
	use GeneralesTraits;

	public function actionAjaxAsignarComboDiagnosticoExamen(Request $request) {

		$control_id 			= 	$request['control_id'];

		$array 		= 	DetalleControl::from('detallecontroles as DC')
									->join('diagnosticoexamen as RC','DC.id','=','RC.diagnostico_id')
									->where('DC.control_id','=',$control_id)
									->where('DC.tipo','=','CIE')->where('DC.activo','=','1')
									->pluck('DC.descripcion','RC.diagnostico_id')
									->toArray();
		$combodiagnostico 		=	array(''=>'SELECCIONE DIAGNOSTICO');
		if(count($array)>0){
			$combodiagnostico 		=	array(''=>'SELECCIONE DIAGNOSTICO')+$array;			
		}

		return View::make('atenderpaciente/ajax/combodiagnosticoexamen',
						 [				 	
						 	'combodiagnostico' 		=> $combodiagnostico,
						 	'ajax' 					=> true,					 	
						 ]);


	}


	public function actionAjaxCargarListaExamenes(Request $request)	{

		$control_id			= 	$request['control_id'];
		$iddetcontrols 		=	DetalleControl::where('tipo','=','CIE')
								->where('activo','=',1)
								->where('control_id','=',$control_id)
								->pluck('id')
								->toArray();
		$idregistros 			= 	DiagnosticoExamen::whereIn('diagnostico_id',$iddetcontrols)
										->pluck('id')
										->toArray();
		////////////////////////////////////////////////////////////////////////
		$listadiagnosticosexamenes 	= 	DetalleDiagnosticoExamen::whereIn('diagnosticoexamen_id',$idregistros)
										->where('activo','=','1')
										->get();
		// dd($listadiagnosticosexamenes);
		return View::make('atenderpaciente/ajax/alistadiagnosticoexamenes',
						 [				 	
						 	'listadiagnosticosexamenes' 	=> $listadiagnosticosexamenes,
						 	'ajax' 					=> true,					 	
						 ]);
	}

	public function actionAjaxAsignarDiagnosticoExamen(Request $request) {

		$diagnosticoexamen_id 	= 	$request['diagnostico_id'];
		$examen_id 				= 	$request['examen_id'];

		$DiagExamen 			=	DiagnosticoExamen::where('diagnostico_id','=',$diagnosticoexamen_id)->first();


		$detallecontrol 		=	DetalleControl::where('id','=',$DiagExamen->diagnostico_id)->first(); //una receta
		$control_id 			=	$detallecontrol->control_id;

		$control 				= 	Control::where('id','=',$control_id)->first();
		$iddetcontrols 			=	DetalleControl::where('tipo','=','CIE')
										->where('control_id','=',$control_id)
										->where('activo','=',1)
										->pluck('id')
										->toArray();
		$idregistros 			= 	DiagnosticoExamen::whereIn('diagnostico_id',$iddetcontrols)
										->pluck('id')
										->toArray();

		////////////////////////////////////////////////////////////////////////
		$cabecera 							=	DiagnosticoExamen::where('id','=',$diagnosticoexamen_id)->first();
		$DetDiagExamen 						= 	new DetalleDiagnosticoExamen;
		$idnuevo 							= 	$this->funciones->getCreateIdMaestra('detallediagnosticoexamen');
		$DetDiagExamen->id 					= 	$idnuevo;
		$DetDiagExamen->diagnosticoexamen_id=   $DiagExamen->id;
		$DetDiagExamen->examen_id 			=   $examen_id;
		$DetDiagExamen->fecha_crea 			= 	$this->fechaactual;
		$DetDiagExamen->usuario_crea 		= 	Session::get('usuario')->id;
		$DetDiagExamen->save();

		////////////////////////////////////////////////////////////////////////
		// $listadiagnosticosexamenes 		= 	DetalleDiagnosticoExamen::where('diagnosticoexamen_id','=',$diagnosticoexamen_id)
		$listadiagnosticosexamenes 		= 	DetalleDiagnosticoExamen::whereIn('diagnosticoexamen_id',$idregistros)
									->where('activo','=','1')->get();

		return View::make('atenderpaciente/ajax/alistadiagnosticoexamenes',
						 [				 	
						 	'listadiagnosticosexamenes' 		=> $listadiagnosticosexamenes,
						 	'ajax' 					=> true,					 	
						 ]);


	}



	public function actionAjaxEliminarDiagnosticoExamen(Request $request) {

		$detalle_control_id 	= 	$request['detalle_control_id'];
		$DetDiagExamen 			= 	DetalleDiagnosticoExamen::where('id','=',$detalle_control_id)->first();

		$DiagExamen  			=	DiagnosticoExamen::where('id','=',$DetDiagExamen->diagnosticoexamen_id)->first();
		
		$detallecontrol 		=	DetalleControl::where('id','=',$DiagExamen->diagnostico_id)->first(); //una receta
		$control_id 			=	$detallecontrol->control_id;

		$control 				= 	Control::where('id','=',$control_id)->first();
		$iddetcontrols 			=	DetalleControl::where('tipo','=','CIE')
										->where('control_id','=',$control_id)
										->where('activo','=',1)
										->pluck('id')
										->toArray();
		$idregistros 			= 	DiagnosticoExamen::whereIn('diagnostico_id',$iddetcontrols)
										->pluck('id')
										->toArray();
		/////////////////////////////////////////////////////////////////////////
		$DiagExamen_id	 			=	$DetDiagExamen->diagnosticoexamen_id;
		$DetDiagExamen->activo 		= 	0;
		$DetDiagExamen->fecha_mod 	= 	$this->fechaactual;
		$DetDiagExamen->usuario_mod = 	Session::get('usuario')->id;
		$DetDiagExamen->save();
		////////////////////////////////////////////////////////////////////////
		
		$listadiagnosticosexamenes 	= 	DetalleDiagnosticoExamen::whereIn('diagnosticoexamen_id',$idregistros)
										->where('activo','=','1')->get();

		return View::make('atenderpaciente/ajax/alistadiagnosticoexamenes',
						 [				 	
						 	'listadiagnosticosexamenes' 		=> $listadiagnosticosexamenes,
						 	'ajax' 					=> true,					 	
						 ]);
	}


	public function actionPdfDiagnosticoExamen($idcontrol,Request $request)
	{

		View::share('titulo','Detalle de Examenes');
		$centro 				=	'LAMBAYEQUE';
		$local 					=	'CHICLAYO';
		$farmacia 				=	'FARMACIA EMERGENCIA';
		$area 					=	'CONSULTA EXTERNA';
		$especialidad 			=	'Ginecología y Obstetricia';
		$datosempresa 			=	'Av Luis Gonzáles 440 oficina 602';

		$idcontrol 				= 	$this->funciones->decodificarmaestra($idcontrol);
		$funcion 				= 	$this;

		$control 				= 	Control::where('id','=',$idcontrol)->first();
		$medico 				=	User::where('id','=',$control->doctor_id)->first();
		$usuario 				=	User::where('id','=',Session::get('usuario')->id)->first();

		$listacontroles 		= 	Control::where('paciente_id','=',$control->paciente_id)
									->orderby('fecha','desc')->get();

		$paciente 				= 	Paciente::where('id','=',$control->paciente_id)->first();
		$edad 					= 	Carbon::parse($paciente->fecha_nacimiento)->age;
		$listadetallecie 		= 	DetalleControl::where('control_id','=',$control->id)
									->where('tipo','=','CIE')->where('activo','=','1')->get();
		$titulo 				=	'EXAMENES C'.$control->codigo.' '.$paciente->apellido_paterno.' '.$paciente->apellido_materno.' '.$paciente->nombres;
		$iddetcontrols 			=	DetalleControl::where('tipo','=','CIE')
									->where('activo','=',1)
									->where('control_id','=',$control->id)
									->pluck('id')
									->toArray();

		$iddiagnosticoexamen 	=	DiagnosticoExamen::whereIn('diagnostico_id',$iddetcontrols)
									->pluck('id')
									->toArray();
		$listadiagnosticoexamen =	DiagnosticoExamen::whereIn('diagnostico_id',$iddetcontrols)->get();

		$listadiagnosticosexamenes 		= 	DetalleDiagnosticoExamen::from('detallediagnosticoexamen as DR')
									->join('diagnosticoexamen as R','R.id','=','DR.diagnosticoexamen_id')
									->join('detallecontroles as DC','DC.id','=','R.diagnostico_id')
									->join('controles as C','C.id','=','DC.control_id')
									->select(
											'R.diagnostico_id',
											'DR.*'
										)
									->where('DC.activo','=',1)
									->where('R.activo','=',1)
									->whereIn('DR.diagnosticoexamen_id',$iddiagnosticoexamen)
									->where('DR.activo','=',1)
									->orderBy('R.diagnostico_id','asc')
									->get();

		$pdf 				= 	PDF::loadView('atenderpaciente.pdf.formatodiagnosticoexamen', 
									[
								 	'funcion' 				=> 	$funcion,
								 	'listacontroles' 		=> 	$listacontroles,
								 	'listadetallecie' 		=> 	$listadetallecie,	
								 	'control' 				=> 	$control,
								 	'paciente' 				=> 	$paciente,
								 	'edad' 					=> 	$edad,								
								 	'listadiagnosticoexamen'			=> 	$listadiagnosticoexamen,
								 	'listadiagnosticosexamenes'		=> 	$listadiagnosticosexamenes,
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


}
