<!DOCTYPE html>

<html lang="es">

<head>
	<title>Control ({{$control->fecha_control}}) </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="icon" type="image/x-icon" href="{{ asset('public/favicon.ico') }}"> 
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('public/css/pdf.css') }} "/> --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/pdf_receta.css') }} "/>


</head>

<body>

	<div class="row">
		<div style="width: 100%;position: static;">
			<table width="100%" >
				<tr>
					<td width="50%" style="border: 2px solid;" class="contenedorreceta"> 
                   		@include('atenderpaciente.pdf.detalleformatoreceta')
					</td>
					<td width="50%" style="border: 2px solid;" class="contenedorreceta">

                    	@include('atenderpaciente.pdf.detalleformatoreceta')
					</td>
				</tr>
			</table>
		</div>
	</div>


    

</body>
</html>