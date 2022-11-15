<div class="col-sm-12 abajocaja">
	{!! Form::select( 'diagnostico_receta', $combodiagnostico, array(),
	[
		'class'       => 'select2 form-control control input-sm' ,
		'id'          => 'diagnostico_receta',
		'data-aw'     => '1',
	]) !!}
</div>

@if(isset($ajax))
  <script type="text/javascript">
    $(document).ready(function(){
		App.formElements();
		App.dataTables();
    });
  </script> 
@endif