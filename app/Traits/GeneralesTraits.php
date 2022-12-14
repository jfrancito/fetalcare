<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use App\Modelos\WEBCuentaContable;
use App\Modelos\ALMProducto;
use View;
use Session;
use Hashids;
Use Nexmo;
use Keygen;

trait GeneralesTraits
{
	
	private function gn_generacion_combo_array($titulo, $todo , $array)
	{
		if($todo=='TODO'){
			$combo_anio_pc  		= 	array('' => $titulo , $todo => $todo) + $array;
		}else{
			$combo_anio_pc  		= 	array('' => $titulo) + $array;
		}
	    return $combo_anio_pc;
	}

	private function gn_generacion_combo($tabla,$atributo1,$atributo2,$titulo,$todo) {
		
		$array 						= 	DB::table($tabla)
        								->where('activo','=',1)
		        						->pluck($atributo2,$atributo1)
										->toArray();

		if($todo=='TODO'){
			$combo  				= 	array('' => $titulo , $todo => $todo) + $array;
		}else{
			$combo  				= 	array('' => $titulo) + $array;
		}

	 	return  $combo;					 			
	}

	private function gn_generacion_combo_tabla_osiris($tabla,$atributo1,$atributo2,$titulo,$todo) {
		
		$array 							= 	DB::table($tabla)
        									->where('COD_ESTADO','=',1)
		        							->pluck($atributo2,$atributo1)
											->toArray();
		if($titulo==''){
			$combo  					= 	$array;
		}else{
			if($todo=='TODO'){
				$combo  				= 	array('' => $titulo , $todo => $todo) + $array;
			}else{
				$combo  				= 	array('' => $titulo) + $array;
			}
		}

	 	return  $combo;					 			
	}

	private function gn_generacion_combo_categoria($txt_grupo,$titulo,$todo) {
		
		$array 						= 	DB::table('CMP.CATEGORIA')
        								->where('COD_ESTADO','=',1)
        								->where('TXT_GRUPO','=',$txt_grupo)
		        						->pluck('NOM_CATEGORIA','COD_CATEGORIA')
										->toArray();

		if($todo=='TODO'){
			$combo  				= 	array('' => $titulo , $todo => $todo) + $array;
		}else{
			$combo  				= 	array('' => $titulo) + $array;
		}

	 	return  $combo;					 			
	}


	public function gn_background_fila_activo($activo)
	{
		$background =	'';
		if($activo == 0){
			$background = 'fila-desactivada';
		}
	    return $background;
	}


	public function gn_combo_tipo_cliente()
	{
		$combo  	= 	array('' => 'Seleccione tipo de cliente' , '0' => 'Tercero', '1' => 'Relacionada');
	    return $combo;
	}

	public function rp_generacion_combo_resultado_control($titulo)
	{
		$combo  	= 	array('' => $titulo , '1' => 'Nueva Cita', '2' => 'Resultado');
	    return $combo;
	}

	public function rp_sexo_paciente($sexo_letra)
	{
		$sexo = 'Femenino';
		if($sexo_letra == 'M'){
			$sexo = 'Maculino';
		}
	    return $sexo;
	}	

	public function rp_tipo_cita($ind_tipo_cita)
	{
		$tipo_cita = 'Nueva Cita';
		if($ind_tipo_cita == 2){
			$tipo_cita = 'Resultado';
		}
	    return $tipo_cita;
	}	
	public function rp_estado_control($ind_atendido)
	{
		$estado = 'Atendido';
		if($ind_atendido == 0){
			$estado = 'Sin atender';
		}
	    return $estado;
	}	


	private function gn_generacion_combo_productos($titulo,$todo)
	{


		$array 						= 	ALMProducto::where('COD_ESTADO','=',1)
										->whereIn('IND_MATERIAL_SERVICIO', ['M','S'])
		        						->pluck('NOM_PRODUCTO','COD_PRODUCTO')
		        						->take(10)
										->toArray();

		if($todo=='TODO'){
			$combo  				= 	array('' => $titulo , $todo => $todo) + $array;
		}else{
			$combo  				= 	array('' => $titulo) + $array;
		}

	 	return  $combo;	
	}


	private function gn_generacion_combo_unidad()
	{
		$combo  	= 	array('' => 'Seleccione Unidad' , 
								'0' => 'AM', 
								'1' => 'TB',
								'2' => 'FR'
								);
	 	return  $combo;	
	}

	private function gn_generacion_combo_medicamentos($titulo,$todo='')
	{
		$array 						= 	DB::table('medicamentos')->where('activo','=',1)
		        						->selectRaw("concat(descripcion,' - UND( ',unidad,' )') as descripcion,id")
		        						->pluck('descripcion','id')
										->toArray();
		if($todo=='TODO'){
			$combo  				= 	array('' => $titulo , $todo => $todo) + $array;
		}else{
			$combo  				= 	array('' => $titulo) + $array;
		}
	 	return  $combo;	
	}


	private function gn_generacion_combo_dosificacion($titulo,$todo='')
	{
		$array 		= 	array(
							'0'=>'NINGUNO',
							'1'=>'C / 8 HORAS',
							'2'=>'C / 12 HORAS',
							'3'=>'C / 24 HORAS'
						);

		$combo  	= 	array('' => $titulo) + $array;
		
		return  $combo;	
	}


	private function gn_generacion_combo_unidad_medicamentos()
	{

		$combo  	= 	array(
					'AM' => 'AM',
					'FR' => 'FR',
					'TB' => 'TB',
				);

		return  $combo;	
	}

	private function gn_generacion_combo_examenes($titulo,$todo='')
	{
		$array 						= 	DB::table('examenes')->where('activo','=',1)
		        						->pluck('descripcion','id')
										->toArray();
		if($todo=='TODO'){
			$combo  				= 	array('' => $titulo , $todo => $todo) + $array;
		}else{
			$combo  				= 	array('' => $titulo) + $array;
		}
	 	return  $combo;	
	}

	private function gn_generacion_combo_cies($titulo,$todo='')
	{
		$array 						= 	DB::table('cies')->where('activo','=',1)
		        						->selectRaw("concat(codigo,' - ',descripcion) as descripcion,id")
		        						->pluck('descripcion','id')
										->toArray();
		if($todo=='TODO'){
			$combo  				= 	array('' => $titulo , $todo => $todo) + $array;
		}else{
			$combo  				= 	array('' => $titulo) + $array;
		}
	 	return  $combo;	
	}

	
}