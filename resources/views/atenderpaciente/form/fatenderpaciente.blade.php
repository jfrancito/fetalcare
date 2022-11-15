<form method="POST" 
action="{{ url('/atender-paciente/'.$idopcion.'/'.Hashids::encode(substr($control->id, -8))) }}" 
style="border-radius: 0px;" class="form-horizontal group-border-dashed"
enctype="multipart/form-data"
>
			{{ csrf_field() }}


<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
	<div id="home4" class="tab-pane active cont">
		<h5><b>DNI :</b></h5>
		<p>{{$paciente->dni}}</p>
	</div>
</div>
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
	<div id="home4" class="tab-pane active cont">
		<h5><b>Nombre :</b></h5>
		<p>{{$paciente->nombres}}</p>
	</div>
</div>
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
	<div id="home4" class="tab-pane active cont">
		<h5><b>Apellido paterno :</b></h5>
		<p>{{$paciente->apellido_paterno}}</p>
	</div>
</div>
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
	<div id="home4" class="tab-pane active cont">
		<h5><b>Apellido materno :</b></h5>
		<p>{{$paciente->apellido_materno}}</p>
	</div>
</div>
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
	<div id="home4" class="tab-pane active cont">
		<h5><b>Sexo :</b></h5>
		<p>{{$funcion->rp_sexo_paciente($paciente->sexo)}}</p>
	</div>
</div>
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
	<div id="home4" class="tab-pane active cont">
		<h5><b>Fecha Nacimiento :</b></h5>
		<p>{{date_format(date_create($paciente->fecha_nacimiento), 'd-m-Y')}}</p>
	</div>
</div>

<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
	<div id="home4" class="tab-pane active cont">
		<h5><b>Edad :</b></h5>
		<p>{{$edad}} años</p>
	</div>
</div>

<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
	<div id="home4" class="tab-pane active cont">
		<h5><b>Telefono :</b></h5>
		<p>{{$paciente->telefono}}</p>
	</div>
</div>
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
	<div id="home4" class="tab-pane active cont">
		<h5><b>Doctor :</b></h5>
		<p>{{$control->user->nombre}}</p>
	</div>
</div>
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
	<div id="home4" class="tab-pane active cont">
		<h5><b>Tipo de cita :</b></h5>
		<p>{{$funcion->rp_tipo_cita($control->control_resultado)}}</p>
	</div>
</div>
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
	<div id="home4" class="tab-pane active cont">
		<h5><b>Fecha {{$funcion->rp_tipo_cita($control->control_resultado)}} :</b></h5>
		<p>{{date_format(date_create($control->fecha_control), 'd-m-Y')}}</p>
	</div>
</div>

<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
	<div id="home4" class="tab-pane active cont">
		<h5><b>Dirección :</b></h5>
		<p>{{$paciente->direccion}}</p>
	</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

		<div class="form-group" style="padding-top: 0px;">
		<label class="col-sm-12 control-label" style="text-align: left;"><b>ANAMNESIS : </b></label>
		<div class="col-sm-12">

				<textarea 
				name="anamnesis"
				id = "anamnesis"
				
				class="form-control input-sm"
				rows="5" 
				cols="50"
				data-aw="1">{{$control->anamnesis}}</textarea>

				@include('error.erroresvalidate', [ 'id' => $errors->has('anamnesis')  , 
																						'error' => $errors->first('anamnesis', ':message') , 
																						'data' => '1'])

		</div>
		</div>

</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group" style="padding-top: 0px;">
		<label class="col-sm-12 control-label" style="text-align: left;"><b> EXAMEN FISICO :</b></label>
		</div>
</div>



<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
		<div class="form-group" style="padding-top: 0px;">
			<label class="col-sm-12 control-label" style="text-align: left;">Tº </label>
			<div class="col-sm-12">

					<input  type="text"
									id="temperatura" name='temperatura' 
									value="{{$control->temperatura}}"
									placeholder="Tº"
									
									autocomplete="off" class="form-control input-sm" data-aw="2"/>

					@include('error.erroresvalidate', [ 'id' => $errors->has('temperatura')  , 
																							'error' => $errors->first('temperatura', ':message') , 
																							'data' => '2'])

			</div>
		</div>
</div>


<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
		<div class="form-group" style="padding-top: 0px;">
			<label class="col-sm-12 control-label" style="text-align: left;">PA </label>
			<div class="col-sm-12">

					<input  type="text"
									id="pa" name='pa' 
									value="{{$control->pa}}"
									placeholder="PA"
									
									autocomplete="off" class="form-control input-sm" data-aw="3"/>

					@include('error.erroresvalidate', [ 'id' => $errors->has('pa')  , 
																							'error' => $errors->first('pa', ':message') , 
																							'data' => '3'])

			</div>
		</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
		<div class="form-group" style="padding-top: 0px;">
			<label class="col-sm-12 control-label" style="text-align: left;">FR </label>
			<div class="col-sm-12">

					<input  type="text"
									id="fr" name='fr' 
									value="{{$control->fr}}"
									placeholder="FR"
									
									autocomplete="off" class="form-control input-sm" data-aw="4"/>

					@include('error.erroresvalidate', [ 'id' => $errors->has('fr')  , 
																							'error' => $errors->first('fr', ':message') , 
																							'data' => '4'])

			</div>
		</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
		<div class="form-group" style="padding-top: 0px;">
			<label class="col-sm-12 control-label" style="text-align: left;">FC </label>
			<div class="col-sm-12">

					<input  type="text"
									id="fc" name='fc' 
									value="{{$control->fc}}"
									placeholder="FC"
									
									autocomplete="off" class="form-control input-sm" data-aw="5"/>

					@include('error.erroresvalidate', [ 'id' => $errors->has('fc')  , 
																							'error' => $errors->first('fc', ':message') , 
																							'data' => '5'])

			</div>
		</div>
</div>



<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
		<div class="form-group" style="padding-top: 0px;">
			<label class="col-sm-12 control-label" style="text-align: left;">Talla (m) </label>
			<div class="col-sm-12">

					<input  type="text"
									id="talla" name='talla' 
									value="{{number_format($control->talla,2)}}"
									placeholder="TALLA EN METROS"
									data-parsley-maxlength="6"
									autocomplete="off" class="form-control input-sm validarnumero" data-aw="5"/>

					@include('error.erroresvalidate', [ 'id' => $errors->has('talla')  , 
																							'error' => $errors->first('talla', ':message') , 
																							'data' => '12'])

			</div>
		</div>
</div>


<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
		<div class="form-group" style="padding-top: 0px;">
			<label class="col-sm-12 control-label" style="text-align: left;">Peso (Kg) </label>
			<div class="col-sm-12">

					<input  type="text"
									id="peso" name='peso' 
									value="{{$control->peso}}"
									placeholder="PESO EN KG"
									
									autocomplete="off" class="form-control input-sm validarnumero" data-aw="5"/>

					@include('error.erroresvalidate', [ 'id' => $errors->has('peso')  , 
																							'error' => $errors->first('peso', ':message') , 
																							'data' => '13'])

			</div>
		</div>
</div>



<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
		<div class="form-group" style="padding-top: 0px;">
			<label class="col-sm-12 control-label" style="text-align: left;" title="INDICADOR DE MASA CORPORAL">IMC </label>
			<div class="col-sm-12">

					<input  type="text"
									id="imc" name='imc' 
									value="{{$control->imc}}"
									placeholder="IMC"
									autocomplete="off" class="form-control input-sm noeditable" data-aw="5"/>

					@include('error.erroresvalidate', [ 'id' => $errors->has('imc')  , 
																							'error' => $errors->first('imc', ':message') , 
																							'data' => '13'])

			</div>
		</div>
</div>


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group" style="padding-top: 0px;">
		<label class="col-sm-12 control-label" style="text-align: left;"></label>
		<div class="col-sm-12">

				<textarea 
				name="examen_fisico"
				id = "examen_fisico"
				
				class="form-control input-sm"
				rows="5" 
				cols="50"
				data-aw="6">{{$control->examen_fisico}}</textarea>

				@include('error.erroresvalidate', [ 'id' => $errors->has('examen_fisico')  , 
																						'error' => $errors->first('examen_fisico', ':message') , 
																						'data' => '6'])

		</div>
		</div>
</div>



<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

		<div class="form-group" style="padding-top: 0px;">
		<label class="col-sm-12 control-label" style="text-align: left;"><b>PLAN DE TRABAJO :</b> </label>
		<div class="col-sm-12">

				<textarea 
				name="plan_trabajo"
				id = "plan_trabajo"
				
				class="form-control input-sm"
				rows="5" 
				cols="50"
				data-aw="7">{{$control->plan_trabajo}}</textarea>

				@include('error.erroresvalidate', [ 'id' => $errors->has('plan_trabajo')  , 
																						'error' => $errors->first('plan_trabajo', ':message') , 
																						'data' => '7'])

		</div>
		</div>

</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group" style="padding-top: 0px;">
		<label class="col-sm-12 control-label" style="text-align: left;"><b> DIAGNOSTICO :</b></label>
		</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="input-group input-group-sm">
				<span class="input-group-addon">CIE 10</span>
				<input  type="text"
								id="codigocie" name='codigocie' 
								value=""
								placeholder="CIE 10"
								autocomplete="off" 
								class="form-control input-sm w-200"/>

				<span class="input-group-addon">DIAGNOSTICO</span>
				<input  type="text"
								id="descripcion" name='descripcion' 
								value=""
								placeholder="DIAGNOSTICO"
								autocomplete="off" class="form-control input-sm"/>

				<span class="input-group-btn"><button type="button" class="btn btn-primary asignarcie">Asignar</button></span>

	</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class='listajax_detalle'>
		@include('atenderpaciente.ajax.alistadiagnostico')
	</div>
</div>

<input type="hidden" name="control_id" id= 'control_id' value = '{{$control->id}}'>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

		<div class="form-group" style="padding-top: 0px;">
		<label class="col-sm-12 control-label" style="text-align: left;"><b>TRATAMIENTO : </b></label>
		<div class="col-sm-12">

				<textarea 
				name="tratamiento"
				id = "tratamiento"
				class="form-control input-sm"
				rows="5" 
				cols="50"
				data-aw="9">{{$control->tratamiento}}</textarea>

				@include('error.erroresvalidate', [ 'id' => $errors->has('tratamiento')  , 
																						'error' => $errors->first('tratamiento', ':message') , 
																						'data' => '9'])

		</div>
		</div>

</div>

<div class="row xs-pt-15">
	<div class="col-xs-6">
			<div class="be-checkbox">

			</div>
	</div>
	<div class="col-xs-12">
		<p class="text-right">
			<button 
				class="btn btn-space btn-primary btn-lg agregarreceta"
				type="button" href="#" 
				data-toggle="modal"
				data-target="#modalagregarreceta" 
				id='agregarreceta'
				>
				<i class="icon icon-left mdi mdi-collection-plus">	
				</i> 
				Receta
			</button>
		</p>
	</div>
</div>





<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

		<div class="form-group" style="padding-top: 0px;">
		<label class="col-sm-12 control-label" style="text-align: left;"><b>RESULTADO : </b></label>
		<div class="col-sm-12">

				<textarea 
				name="resultado"
				id = "resultado"
				class="form-control input-sm"
				rows="5" 
				cols="50"
				data-aw="9">{{$control->resultado}}</textarea>

				@include('error.erroresvalidate', [ 'id' => $errors->has('resultado')  , 
																						'error' => $errors->first('resultado', ':message') , 
																						'data' => '9'])

		</div>
		</div>

</div>


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="form-group">
		<label class="col-sm-12 control-label" style="text-align: left;"><b>DOCUMENTOS : </b></label>
		<div class="col-md-12">
			<input type="file" class="form-control" name="files[]" id = "files" multiple>
		</div>
	</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class='listajax_detalle_doc'>
		@include('atenderpaciente.ajax.alistadocumentos')
	</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

		<div class="form-group" style="padding-top: 0px;" >

			<label class="col-sm-12 control-label" style="text-align: left;">ESTADO </label>
			<div class="col-sm-12">
				{!! Form::select( 'estado'
													, $comboestado
													, $control->estado
													,[
														'class'       => 'select2 form-control control input-xs' ,
														'id'          => 'estado',
														'required'    => '',
														'data-aw'     => '9'
													]) !!}


			</div>
		</div>

</div>


<div class="row xs-pt-15">
	<div class="col-xs-6">
			<div class="be-checkbox">

			</div>
	</div>
	<div class="col-xs-12">
		<p class="text-right">
			<button type="submit" class="btn btn-space btn-primary">Guardar control </button>
		</p>
	</div>
</div>

</form>


@include('atenderpaciente.modal.magregarreceta')

@if(isset($ajax))
	<script type="text/javascript">
		$(document).ready(function(){
			App.formElements();
		});
	</script> 
@endif