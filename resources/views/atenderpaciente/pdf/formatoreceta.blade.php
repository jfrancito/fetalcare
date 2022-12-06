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
.derecha{
    text-align: left;
}

.menu{
    overflow:hidden;
    width 	: 100px;
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
	width: 100px;
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
    width 	: 100px;
    display : table;
	border: 1px solid #000;
	border-radius: 4px;
    font-size: 0.8em;
    padding: 5px;
}

.det2 .d1,.det2 .d2,.det2 .d3{
    width	: 	5%
    float	:	left;
    display : 	table-cell;     
}

table {
    border-collapse: collapse;
    width 	: 100%;
	margin-top: 15px;
    font-size: 0.8em;    
}

td {
    padding: 8px;
    padding-top: 4px;
    padding-bottom: 4px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
/*    margin-top: 20px;*/
    padding: 8px;
    padding-top: 2px;
    padding-bottom: 2px;
    text-align: left;
    border-bottom: 2px solid #000000;
    border-top: 2px solid #000000;
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
    width 	: 100px;
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


table .contenedorreceta{
/*    font-size: 0.9em;*/
/*    width: 50%;*/
    padding-right: 10px;
    padding-left: 10px;
    width: 100%;

}

.negrita{
  font-weight: bold;
}

p .izquierda{
    float: left;
    position: relative;
}

p .derecha {
    float: right;
    position: relative;
}


.linea {
  display: flex;
  
}

.linea_izq {
  float: left;
}

.linea_der {
  float: right;
}

.tabla_datos{
    padding-top: -5px;
}


.firma_asegurado {
    text-align: center;
    width: 150px;
    position: relative;
    border-top: 1px solid;
}

.firma_medico {
    text-align: center;
    position: relative;
    width: 150px;
    border-top: 1px solid;
}

td .sinbordes {
    border: 0px;
    text-align: left;
}

td .sinbordes_centro {
    border: 0px;
    text-align: center;
}



</style>

</head>

<body>

	<div class="row">
		<div style="width: 100%;position: static;">
			<table width="100%" >
				<tr>
					<td width="100%" style="border: 2px solid;" class="contenedorreceta"> 
                   		@include('atenderpaciente.pdf.detalleformatoreceta')
					</td>
				</tr>
			</table>
		</div>
	</div>


    

</body>
</html>