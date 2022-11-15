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
					<b>ANAMNESIS : </b>		    	
			    </div>

			    <div class="det1">
	   				<p>
						<?php echo nl2br($control->anamnesis); ?>
	   				</p>  		    	
			    </div>
			    <div style="font-size: 0.9em;margin-top: 20px;">
					<b>EXAMEN FISICO : </b>		    	
			    </div>

			    <div class="det2">
	   				<p class="d1">
	   					<strong>Tº :</strong> {{$control->temperatura}}
	   				</p>  		    	
	   				<p class="d2">
	   					<strong>PA  :</strong> {{$control->pa}}
	   				</p>
	   				<p class="d3">
	   					<strong>FR :</strong> {{$control->fr}}
	   				</p>
	   				<p class="d3">
	   					<strong>FC  :</strong> {{$control->fc}}
	   				</p>
			    </div>

			    <div class="det1">
	   				<p>
	   					<?php echo nl2br($control->examen_fisico); ?>
	   				</p>  		    	
			    </div>

			    <div style="font-size: 0.9em;margin-top: 20px;">
					<b>PLAN DE TRABAJO : </b>		    	
			    </div>

			    <div class="det1">
	   				<p>
	   					<?php echo nl2br($control->plan_trabajo); ?>
	   				</p>  		    	
			    </div>

			    <div style="font-size: 0.9em;margin-top: 20px;">
					<b>DIAGNOSTICO : </b>		    	
			    </div>

				<table>
				    <tr>
				      <th class='titulo codigo'>CIE 10</th>
				      <th class='descripcion'>DIAGNOSTICO</th>
				    </tr>

				    @foreach($listadetallecie as $index => $item)
					    <tr>
					      <td class='titulo'>{{$item->codigocie}}</td>
					      <td >{{$item->descripcion}}</td>
					    </tr>
				    @endforeach		    

				</table>

			    <div style="font-size: 0.9em;margin-top: 20px;">
					<b>TRATAMIENTO : </b>		    	
			    </div>

			    <div class="det1">
	   				<p>
	   					<?php echo nl2br($control->tratamiento); ?>
	   				</p>  		    	
			    </div>


			</div>
        </article>




    </section>

</body>
</html>