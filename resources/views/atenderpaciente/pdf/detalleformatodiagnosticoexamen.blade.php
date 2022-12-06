
	
	<div class="linea">
		<div class="linea_izq">
			Nro Orden : <b>{{ $control->codigo }}</b>  
		</div>
		<div class="linea_der">
			FECHA EMISION : <b>{{ date('Y-m-d',strtotime($funcion->fechaactual)) }}</b>
		</div>
	</div>
	<br>
	<div class="linea">
		<div class="linea_izq">
			{{ $centro }}
		</div>
		<div class="linea_der">
			
		</div>
	</div>
	<br>
	<div class="linea">
		<div class="linea_izq">
			{{ $local }}
		</div>
		<div class="linea_der">
			
		</div>
	</div>
	<br>
	<div class="linea">
		<div class="linea_izq">
			{{ $area }}
		</div>
		<div class="linea_der">
			
		</div>
	</div>

	<br>
	<div class="linea">
		<div class="linea_izq">
			{{ $especialidad }}
		</div>
		<div class="linea_der">
			{{ $farmacia }}
		</div>
	</div>
	
	<br>
	<div class="linea">
		<div class="linea_izq">
			<strong>PACIENTE:</strong>  {{$paciente->apellido_paterno}} {{$paciente->apellido_materno}} {{$paciente->nombres}}
		</div>
		<div class="linea_der">
			<strong>EDAD  :</strong> {{$edad}} años
		</div>
	</div>

	<br>
	<div class="linea">
		<div class="linea_izq">
			<strong>DOC. ID:</strong>  D.N.I. {{$paciente->dni}}
		</div>
		<div class="linea_der">
			<strong>VIGENCIA  :</strong> {{date('Y-m-d',strtotime($funcion->fechaactual)) }} 
		</div>
	</div>
	<br>	

	<div class="tabla_datos">
	  <table class="table table-condensed table-striped lsmedicamentos" id="lsmedicamentos" >
	    <thead>
	      <tr>
	        <th>NRO</th>
	        <th>CODIGO</th>
	        <th>EXAMEN</th>
	        <th>DIAGNOSTICO</th>
	      </tr>
	    </thead>

	    <tbody>                              
	    @foreach($listadiagnosticosexamenes as $index => $item)
	        <tr>
	          	<td><strong>	 {{$index+1}}</strong></td>
	          	<td> {{$item->examen->codigo}}</td>
	          	<td> {{$item->examen->descripcion}}</td>
	          	<td> {{$item->diagnosticoexamen->diagnostico->descripcion}}</td>
	        </tr>        
	    @endforeach
	    </tbody>
	  </table>
	</div>
		<br>
		<span>
			<strong>MEDICO :</strong> {{ $medico->nombre }}
		</span>
		<br>
		<br>
		<table>
			<tr>
				<td class="sinbordes">
					<div class="firma_asegurado linea_izq">
						<span>
							FIRMA DEL ASEGURADO	
						</span>
					</div>
				</td>
				<td class="sinbordes">
					<div class="firma_medico linea_der">
						<span>
							FIRMA Y SELLO DEL MEDICO
						</span>
					</div>
				</td>
			</tr>
			<tr><td colspan="2" class="sinbordes"><br></td></tr>			
			<tr>
				<td colspan="2" class="sinbordes_centro">
					<strong>TODA ENMENDADURA O DETERIORO INVALIDA LA RECETA</strong>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="sinbordes_centro">
					{{ $datosempresa }}
				</td>
			</tr>
		</table>
		<table>
			<tr>
				<td class="sinbordes izquierda">USUARIO: </td>
				<td class="sinbordes izquierda"> {{ $usuario->name }}</td>
				<td class="sinbordes derecha">FEC. IMP: </td>
				<td class="sinbordes izquierda">{{ date('Y-m-d',strtotime($funcion->fechaactual)) }}</td>
				<td class="sinbordes derecha">HORA: </td>
				<td class="sinbordes izquierda"> {{ date('H:i:s',strtotime($funcion->fechaactual)) }}</td>
			</tr>
		</table>
		<br>
