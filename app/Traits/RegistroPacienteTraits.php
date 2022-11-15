<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;

use App\User;

use View;
use Session;
use Hashids;
Use Nexmo;
use Keygen;

trait RegistroPacienteTraits
{
	private function rp_generacion_combo_sexo($titulo)
	{
		$combo_sexo  		= 	array('' => $titulo , 'M' => 'Masculino', 'F' => 'Femenino');
	    return $combo_sexo;
	}


	private function rp_generacion_combo_doctores($titulo,$todo) {
		
		$array 						= 	User::where('activo','=',1)
										->where('rol_id','=','1CIX00000002')
		        						->pluck('nombre','id')
										->toArray();

		if($todo=='TODO'){
			$combo  				= 	array('' => $titulo , $todo => $todo) + $array;
		}else{
			$combo  				= 	array('' => $titulo) + $array;
		}

	 	return  $combo;					 			
	}

}