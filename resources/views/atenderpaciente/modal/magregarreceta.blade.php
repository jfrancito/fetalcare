

<div id="modalagregarreceta" class="modal fade colored-header colored-header-primary custom-width modalagregarreceta" role="dialog">
	{{-- <div class="modal-dialog modal-md"> --}}
	<div class="modal-dialog full-width">

		<div class="modal-content">
			{{-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//   FORMULARIO
			////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
			<form method="POST" action="#" name="formagregarreceta" id="formagregarreceta" >
			{{ csrf_field() }} {{-- CLAVE TOKEN PARA SEGURIDAD --}}

				{{-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				//   HEADER
				  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
				<div class="modal-header">
					<button type="button" data-dismiss="modal" aria-hidden="true" class="close modal-close"><span class="mdi mdi-close" style="color: #ffffff"></span></button>
					<h3 class="modal-title"> <span class="icon mdi mdi-assignment-o"> </span> AGREGAR RECETA </h3>
				</div>
				{{-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				//   BODY 
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
				<div class="ajaxcontenedoragregar modal-body" >
	
					<input type="hidden" value="" id="idtrabajador" name="idtrabajador">
					<div class="row">
						<div class="selectfiltro">

							<div class="col-sm-12">
								<label class="col-sm-12 control-label labelleft letranegrita" >DIAGNOSTICO :<span class="required">*</span></label>
								<div class="form-group ajaxcombodiagnostico">
									<div class="col-sm-12 abajocaja">

										{!! Form::select( 'diagnostico_receta',array(), array(),
													  [
														'class'       => 'select2 form-control control input-sm' ,
														'id'          => 'diagnostico_receta',
														'data-aw'     => '1',
													  ]) !!} 
									</div>
								</div>
							</div>

							<div class="col-lg-5 col-sm-5 col-md-6 col-xs-12">
								<div class="form-group">
									<label class="col-sm-12 control-label labelleft letranegrita" >MEDICAMENTO:<span class="required">*</span></label>
									<div class="col-sm-12 abajocaja" >
										{!! Form::select( 'medicamento_id', $combo_medicamentos, array(),
												  [
													'class'       => 'select2 form-control control input-sm' ,
													'id'          => 'medicamento_id',
													'data-aw'     => '1',
												  ]) !!}
									</div>
								</div>
							</div>
							
							<div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
								<div class="form-group">
									<label class="col-sm-12 control-label labelleft letranegrita"> DOSIFICACION </label>
									<div class="col-sm-12 abajocaja">
										
										{!! Form::select( 'dosificacion',$combo_dosificacion, array(),
													  [
														'class'       => 'select2 form-control control input-sm' ,
														'id'          => 'dosificacion',
														'data-aw'     => '1',
													  ]) !!} 
									</div>
								</div>
							</div>

							<div class="col-lg-2 col-sm-2 col-md-6 col-xs-6">
								<div class="form-group">
									<label class="col-sm-12 control-label labelleft letranegrita">CANTIDAD </label>
									<div class="col-sm-12 abajocaja">
										<input type="number" step="1" 
											min='0'
											id="cantidad" name='cantidad'
											placeholder="0" 
											value=""
											class="form-control input-sm" data-aw="3"/>
									</div>
								</div>
							</div>

							<div class="col-lg-2 col-sm-2 col-md-6 col-xs-6">
								<div class="form-group">
									<label class="col-sm-12 control-label labelleft letranegrita">DURACION </label>
									<div class="col-sm-12 abajocaja">
										<input type="number" step="1" 
											min='0'
											id="dias" name='dias'
											title="# DIAS" 
											placeholder="0" 
											class="form-control input-sm" data-aw="5"/>
									</div>
								</div>
							</div>

							<div class="row">

								<div class="col-lg-10 col-sm-10 col-md-10 col-xs-10">
									<div class="form-group">
										<label class="col-sm-12 control-label labelleft letranegrita">INDICACIONES </label>
										<div class="col-sm-12 abajocaja">
											<input type="text" 
												id="indicacion" name='indicacion'
												placeholder="INDICACIONES" 
												value=""
												class="form-control input-sm" data-aw="4"/>
										</div>
									</div>
								</div>

								<div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
									<div class="form-group">
										<label class="col-sm-12 control-label labelleft letranegrita"> &nbsp;</label>
										<div class="col-sm-12 abajocaja">
											<button type="button" class="btn btn-primary asignarmedicamento" id='asignarmedicamento' title="Agregar Medicamento">
												AGREGAR
											</button>
										</div>

										{{-- <span class="input-group-btn"></span> --}}
									</div>
								</div>
							</div>


							<div class="row">
								<div class="col-sm-12">
									<div class="ajaxlsmedicamentos">
										<div class="col-sm-12">
										   <table id="lsmedicamentos" class="table table-striped table-borderless table-hover td-color-borde td-padding-7">
											  <thead>
												<tr>
												  <th>Codigo</th>
												  <th>Descripcion</th>
												  <th>Unidad</th>
												  <th>Cantidad</th>
												  <th>Indicacion</th>
												  <th>Duracion</th>
												  <th>Dosificacion</th>
												  <th>Diagnostico</th>
												  <th>X</th>
												</tr>
											  </thead>
											  <tbody>
											  </tbody>
										  </table>
										</div>
									</div>
								</div>
							</div>
							

						</div>
					</div>

				</div>

				{{-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				//   FOOTER
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
				<div class="modal-footer">
					<div class="row">
						<div class="col-sm-12">
							<div class="btn-group col-xs-6" align='center'>
							
            					<a 	target="_blank" 
									href="{{ url('/pdf-receta-control/'.Hashids::encode(substr($control->id, -8)) )  }}"
            						>
									<button 
											type="button" 
											class="btn btn-space btn-danger btn-lg btnimprimirreceta" 
											id='btnimprimirreceta' 
											{{-- data_detalle_control_id="{{ Hashids::encode(substr($control->id, -8)) }}" --}}
									>
										<i class="icon icon-left mdi mdi mdi-print">	
										</i> 
										Imprimir
									</button>
            					</a>

							</div>
							<div class="btn-group col-xs-6" align='center'>
								<button type="button" class="btn btn-space btn-primary btn-lg" data-dismiss="modal">Cerrar</button>


							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
