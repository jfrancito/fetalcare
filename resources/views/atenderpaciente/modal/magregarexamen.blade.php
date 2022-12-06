

<div id="modalagregarexamen" class="modal fade colored-header colored-header-success  custom-width modalagregarexamen" role="dialog">
	{{-- <div class="modal-dialog modal-md"> --}}
	<div class="modal-dialog full-width">

		<div class="modal-content">
			{{-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//   FORMULARIO
			////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
			<form method="POST" action="#" name="formagregarexamen" id="formagregarexamen" >
			{{ csrf_field() }} {{-- CLAVE TOKEN PARA SEGURIDAD --}}

				{{-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				//   HEADER
				  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
				<div class="modal-header">
					<button type="button" data-dismiss="modal" aria-hidden="true" class="close modal-close"><span class="mdi mdi-close" style="color: #ffffff"></span></button>
					<h3 class="modal-title"> <span class="icon mdi mdi-eyedropper"> </span> AGREGAR EXAMEN </h3>
				</div>
				{{-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				//   BODY 
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
				<div class="ajaxcontenedoragregar modal-body" >
	
					<input type="hidden" value="" id="idtrabajador" name="idtrabajador">
					<div class="row">
						<div class="selectfiltro">


							<div class="col-lg-5 col-sm-5 col-md-5 col-xs-12">
								<div class="form-group">
									<label class="col-sm-12 control-label labelleft letranegrita" >DIAGNOSTICO :<span class="required">*</span></label>
									<div class="form-group ajaxcombodiagnosticoexamenes">
									<div class="col-sm-12 abajocaja">

										{!! Form::select( 'diagnostico_examen',array(), array(),
													  [
														'class'       => 'select2 form-control control input-sm' ,
														'id'          => 'diagnostico_examen',
														'data-aw'     => '1',
													  ]) !!} 
									</div>
								</div>
								</div>
							</div>
				
							<div class="col-lg-5 col-sm-5 col-md-5 col-xs-12">
								<div class="form-group">
									<label class="col-sm-12 control-label labelleft letranegrita" >EXAMEN:<span class="required">*</span></label>
									<div class="col-sm-12 abajocaja" >
										{!! Form::select( 'examen_id', $combo_examenes, array(),
												  [
													'class'       => 'select2 form-control control input-sm' ,
													'id'          => 'examen_id',
													'data-aw'     => '1',
												  ]) !!}
									</div>
								</div>
							</div>
							
							<div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
								<div class="form-group">
									<label class="col-sm-12 control-label labelleft letranegrita"> &nbsp;</label>
									<div class="col-sm-12 abajocaja">
										<button type="button" class="btn btn-primary asignarexamen" id='asignarexamen' title="Agregar Medicamento">
											AGREGAR
										</button>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-12">
									<div class="ajaxlsexamenes">
										<div class="col-sm-12">
										   <table id="lsexamenes" class="table table-striped table-borderless table-hover td-color-borde td-padding-7 lsexamenes">
											  <thead>
												<tr>
												  <th>Codigo</th>
												  <th>Descripcion</th>
												  <th>Fecha</th>
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
									href="{{ url('/pdf-diagnostico-examen/'.Hashids::encode(substr($control->id, -8)) )  }}"
            						>
									<button 
											type="button" 
											class="btn btn-space btn-danger btn-lg btnimprimirexamen" 
											id='btnimprimirexamen' 
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
