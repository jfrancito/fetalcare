<!DOCTYPE html>

<html lang="es">

<head>
	<title>Control ({{$control->fecha_control}}) </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="icon" type="image/x-icon" href="{{ asset('public/favicon.ico') }}"> 
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/pdf.css') }} "/>


</head>

<body>
    <header>
	<div class="menu">
	    <div>
	    		<h1 style="text-align: center;">NYR</h1> 
	    		<h3 style="text-align: center;">RECETA {{ $control->codigo }}</h3> 
	    </div>

	</div>
    </header>
    <section>
        <article>

			<div class="top">
			    <div class="det2">
	   				<p class="d1">
	   					<strong>DNI :</strong> {{$paciente->dni}}
	   				</p>  		    	
	   				<p class="d2">
	   					<strong>Nombre  :</strong> {{$paciente->nombres}}
	   				</p>
	   				<p class="d3">
	   					<strong>Apellido paterno  :</strong> {{$paciente->apellido_paterno}}
	   				</p>

	   				<p class="d3">
	   					<strong>Apellido materno  :</strong> {{$paciente->apellido_materno}}
	   				</p>

			    </div>
			    <div class="det2">
	   				<p class="d1">
	   					<strong>Sexo :</strong> {{$paciente->sexo}}
	   				</p>  		    	
	   				<p class="d2">
	   					<strong>Fecha Nacimiento  :</strong> {{date_format(date_create($paciente->fecha_nacimiento), 'd-m-Y')}}
	   				</p>
	   				<p class="d3">
	   					<strong>Edad  :</strong> {{$edad}} años
	   				</p>
	   				<p class="d3">
	   					<strong>Telefono  :</strong> {{$paciente->telefono}}
	   				</p>
			    </div>

			    <div class="det2">
	   				<p class="d1">
	   					<strong>Doctor :</strong> {{$control->user->nombre}}
	   				</p>  		    	
	   				<p class="d2">
	   					<strong>Tipo de cita  :</strong> {{$funcion->rp_tipo_cita($control->control_resultado)}}
	   				</p>
	   				<p class="d3">
	   					<strong>Fecha {{$funcion->rp_tipo_cita($control->control_resultado)}}  :</strong> {{date_format(date_create($control->fecha), 'd-m-Y')}}
	   				</p>
	   				<p class="d3">
	   					<strong>Dirección  :</strong> {{$paciente->direccion}}
	   				</p>
			    </div>



			    <div style="font-size: 0.9em;margin-top: 20px;">
					<b>MEDICAMENTOS : </b>		    	
			    </div>

				  <table class="table table-condensed table-striped lsmedicamentos" id="lsmedicamentos" >
				    <thead>
				      <tr>
				        <th>NRO</th>
				        <th>CODIGO</th>
				        <th>DENOMINACION</th>
				        <th>DIAS</th>
				        <th>UM</th>
				        <th>CANT.</th>
				        <th>DIAGNOSTICO</th>
				      </tr>
				    </thead>

				    <tbody>                              
				    @foreach($listamedicamentos as $index => $item)
				        <tr>
				          	<td> {{$index+1}}</td>
				          	<td> {{$item->medicamento->codigo}}</td>
				          	<td> {{$item->medicamento->descripcion}}</td>
				          	<td> {{$item->dias}}</td>
				          	<td> {{$item->medicamento->unidad}}</td>
				          	<td> {{$item->cantidad}}</td>
				          	<td> {{$item->receta->diagnostico->descripcion}}</td>
				        </tr>  
				        <tr>
				        	<td colspan="7">
				        		<b>Ind.</b> {{ $item->indicacion }}
				          		<b>Dosific.</b> {{$item->dosificaciondetalle()}}
				        	</td>
				        </tr>                
				    @endforeach
				    </tbody>
				  </table>






			</div>
        </article>




    </section>

</body>
</html>