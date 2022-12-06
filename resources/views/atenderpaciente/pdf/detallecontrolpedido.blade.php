<!DOCTYPE html>

<html lang="es">

<head>
	<title>Control ({{$control->fecha_control}}) </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="icon" type="image/x-icon" href="{{ asset('public/favicon.ico') }}"> 


<style type="text/css">
	

	.izquierda{
	text-align: right;
}

.menu{
    overflow:hidden;
    width 	: 730px;
    display : table;
    /*border 	: 1px solid black;*/
}

.menu .left{
    width	: 	50%
    float	:	left;
    display : 	table-cell; 
    text-align: center;     
}


.menu .right{
    width	: 	50%
    float	:	left;
    border  :	1px solid black; 
    display : 	table-cell; 
    text-align: center; 
    border-radius: 4px ;    
}

.menu .left h1{
	font-size:  1.2em;
	/*border   :  1px solid red;*/
}
.menu .left h3{
	font-size:  0.8em;
	font-weight: normal;
	/*border   :  1px solid red;*/
}
.menu .left h4{
	font-size:  0.8em;
	font-weight: normal;	
	/*border: 1px solid blue;*/
}

.top .det1{
	width: 718px;
	font-size: 0.8em;
	margin-top: 5px;
	border: 1px solid #000;
	border-radius: 4px;
	padding: 5px;

}
.top .det1 p{
	margin-top: 1px;
	margin-bottom: 3px;
}

.det2{
	margin-top: 5px;
    overflow:hidden;
    width 	: 730px;
    display : table;
	border: 1px solid #000;
	border-radius: 4px;
    font-size: 0.8em;
    padding: 5px;
}

.det2 .d1,.det2 .d2,.det2 .d3{
    width	: 	32%
    float	:	left;
    display : 	table-cell;     
}

table {
    border-collapse: collapse;
    width 	: 730px;
	margin-top: 15px;
    font-size: 0.7em;    
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.titulo{
	text-align: center;
}
.codigo{
	width: 50px;
}
.descripcion{
	width: 300px;
}
.unidad{
	width: 40px;
}
.cantidad{
	width: 40px;
}
.precio{
	width: 80px;
}
.importe{
	width: 100px;
}


.totales{
	margin-top: 10px;
    overflow:hidden;
    width 	: 730px;
    display : table;
    /*border 	: 1px solid black;*/
}

.totales .left{
    width	: 	65%
    float	:	left;
    display : 	table-cell;  
   	/*border      : 1px solid red;  */ 
}


.totales .right{
    width	: 	35%
    float	:	left;
    /*border  :	1px solid black; */
    display : 	table-cell; 
      
}

.totales .right p{
	font-size 	: 0.75em;
	margin-top	: 0px;
	margin-bottom 	: 1px;	

}

.totales .right .descripcion{
	display 	: inline-block;
	width 		: 55%;

}
.totales .right .monto{
	display 	: inline-block;
	width 		: 40%;

}

.totales .left .uno{
    display     : inline-block;
    width       : 25%;
}
.totales .left .dos{
    /*border: 1px solid blue;   */ 
    display     : inline-block;
    width       : 70%;
    font-size   : 0.75em;

}
.totales .left .dos p{
    margin-top: 5px;
    margin-bottom: 5px;
}
.totales .left .derecha{
    margin-top: 55px;
}
.totales .left .uno img{
    /*border: 1px solid red;*/
    width: 100px;
    position: absolute;
    top: -87px;

}
footer .observacion{
    border-top: 1px solid #000;
    border-bottom:  1px solid #000;
}
footer .observacion h3 {
    /*border: 1px solid red;*/
    margin-top: 2px;
    margin-bottom: 2px;
    font-size: 0.9em;
}
footer .observacion p {
    /*border: 1px solid red;*/
    margin-top: 0px;
    margin-bottom: 2px;    
    font-size: 0.8em;
}

</style>

</head>

<body>
    <header>
	<div class="menu">
	    <div>
	    		<h1 style="text-align: center;">FETALCARE</h1> 
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