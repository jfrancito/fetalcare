<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

    <input type="hidden" name="ind_paciente" id='ind_paciente' value='{{$ind_paciente}}'>

    <div class="form-group" style="padding-top: 0px;">
    <label class="col-sm-12 control-label" style="text-align: left;">DNI (*) <b style="color:#34a853;">({{$titulo_paciente}})</b></label>
    <div class="col-sm-12">

        <input  type="text"
                id="dni" name='dni' 
                value="@if( isset($paciente) && count($paciente)>0 ){{old('dni' ,$paciente->dni)}}@else{{old('dni')}}@endif"
                placeholder="DNI"
                {{$campo_disabled}} 
                required = ""
                autocomplete="off" class="form-control input-sm" data-aw="2"/>

        @include('error.erroresvalidate', [ 'id' => $errors->has('dni')  , 
                                            'error' => $errors->first('dni', ':message') , 
                                            'data' => '2'])

    </div>
    </div>

</div>


<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

  <div class="form-group" style="padding-top: 0px;">
    <label class="col-sm-12 control-label" style="text-align: left;">Nombres (*) </label>
    <div class="col-sm-12">

        <input  type="text"
                id="nombres" name='nombres' 
                value="@if( isset($paciente) && count($paciente)>0 ){{old('nombres' ,$paciente->nombres)}}@else{{old('nombres')}}@endif"
                placeholder="Nombre"
                required = ""
                autocomplete="off" class="form-control input-sm" data-aw="3"/>

        @include('error.erroresvalidate', [ 'id' => $errors->has('nombres')  , 
                                            'error' => $errors->first('nombres', ':message') , 
                                            'data' => '3'])

    </div>
  </div> 

</div>


<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

    <div class="form-group" style="padding-top: 0px;">
    <label class="col-sm-12 control-label" style="text-align: left;">Apellido paterno (*) </label>
    <div class="col-sm-12">

        <input  type="text"
                id="apellido_paterno" name='apellido_paterno' 
                value="@if( isset($paciente) && count($paciente)>0 ){{old('apellido_paterno' ,$paciente->apellido_paterno)}}@else{{old('apellido_paterno')}}@endif"
                placeholder="Apellido paterno"
                required = ""
                autocomplete="off" class="form-control input-sm" data-aw="4"/>

        @include('error.erroresvalidate', [ 'id' => $errors->has('apellido_paterno')  , 
                                            'error' => $errors->first('apellido_paterno', ':message') , 
                                            'data' => '4'])

    </div>
    </div>

</div>


<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

    <div class="form-group" style="padding-top: 0px;">
    <label class="col-sm-12 control-label" style="text-align: left;">Apellido materno (*) </label>
    <div class="col-sm-12">

        <input  type="text"
                id="apellido_materno" name='apellido_materno' 
                value="@if( isset($paciente) && count($paciente)>0 ){{old('apellido_materno' ,$paciente->apellido_materno)}}@else{{old('apellido_materno')}}@endif"
                placeholder="Apellido materno"
                required = ""
                autocomplete="off" class="form-control input-sm" data-aw="5"/>

        @include('error.erroresvalidate', [ 'id' => $errors->has('apellido_materno')  , 
                                            'error' => $errors->first('apellido_materno', ':message') , 
                                            'data' => '5'])

    </div>
    </div>

</div>





<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

    <div class="form-group" style="padding-top: 0px;">
    <label class="col-sm-12 control-label" style="text-align: left;">Dirección</label>
    <div class="col-sm-12" >

        <input  type="text"
                id="direccion" name='direccion' 
                value="@if( isset($paciente) && count($paciente)>0 ){{old('direccion' ,$paciente->direccion)}}@else{{old('direccion')}}@endif"
                placeholder="Dirección"
                autocomplete="off" class="form-control input-sm" data-aw="8"/>

        @include('error.erroresvalidate', [ 'id' => $errors->has('direccion')  , 
                                            'error' => $errors->first('direccion', ':message') , 
                                            'data' => '8'])

    </div>
    </div>


</div>

<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

    <div class="form-group" style="padding-top: 0px;">
    <label class="col-sm-12 control-label" style="text-align: left;">Telefono (*) </label>
    <div class="col-sm-12">

        <input  type="text"
                id="telefono" name='telefono' 
                value="@if( isset($paciente) && count($paciente)>0 ){{old('telefono' ,$paciente->telefono)}}@else{{old('telefono')}}@endif"
                placeholder="Telefono"
                required = ""
                autocomplete="off" class="form-control input-sm" data-aw="8"/>

        @include('error.erroresvalidate', [ 'id' => $errors->has('telefono')  , 
                                            'error' => $errors->first('telefono', ':message') , 
                                            'data' => '8'])

    </div>
    </div>

</div>



<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

    <div class="form-group" style="padding-top: 0px;" >

      <label class="col-sm-12 control-label" style="text-align: left;">Doctor (*) </label>
      <div class="col-sm-12">
        {!! Form::select( 'doctor_id'
                          , $combo_doctores
                          , $sel_doctor
                          ,[
                            'class'       => 'select2 form-control control input-xs' ,
                            'id'          => 'doctor_id',
                            'required'    => '',
                            'data-aw'     => '9'
                          ]) !!}

          @include('error.erroresvalidate', [ 'id' => $errors->has('doctor_id')  , 
                                              'error' => $errors->first('doctor_id', ':message') , 
                                              'data' => '9'])

      </div>
    </div>

</div>



<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

    <div class="form-group" style="padding-top: 0px;" >

      <label class="col-sm-12 control-label" style="text-align: left;">Tipo cita (*) </label>
      <div class="col-sm-12">
        {!! Form::select( 'tipo_cita_id'
                          , $combo_tipo_cita
                          , $sel_tipo_cita
                          ,[
                            'class'       => 'select2 form-control control input-xs' ,
                            'id'          => 'tipo_cita_id',
                            'required'    => '',
                            'data-aw'     => '10'
                          ]) !!}

          @include('error.erroresvalidate', [ 'id' => $errors->has('tipo_cita_id')  , 
                                              'error' => $errors->first('tipo_cita_id', ':message') , 
                                              'data' => '10'])

      </div>
    </div>


</div>

<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">


    <div class="form-group" style="padding-top: 0px;" >

      <label class="col-sm-12 control-label" style="text-align: left;">Sexo (*) </label>
      <div class="col-sm-12">
        {!! Form::select( 'sexo'
                          , $combo_sexo
                          , $sel_sexo
                          ,[
                            'class'       => 'select2 form-control control input-xs' ,
                            'id'          => 'sexo',
                            'required'    => '',
                            'data-aw'     => '6'
                          ]) !!}

          @include('error.erroresvalidate', [ 'id' => $errors->has('sexo')  , 
                                              'error' => $errors->first('sexo', ':message') , 
                                              'data' => '6'])

      </div>
    </div>

</div>


<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">


    <div class="form-group " style="padding-top: 0px;">
      <label class="col-sm-12 control-label" style="text-align: left;">Fecha Nacimiento (*) </label>
      <div class="col-sm-12" >
        <div data-min-view="2" 
               data-date-format="dd-mm-yyyy"  
               class="input-group date datetimepicker pickerfecha" style = 'padding: 0px 0;margin-top: -3px;'>
               <input size="16" type="text" 
                      value="@if( isset($paciente) && count($paciente)>0 ){{old('fecha_nacimiento' , date_format(date_create($paciente->fecha_nacimiento), 'd-m-Y') )}}@else{{old('fecha_nacimiento')}}@endif" 
                      placeholder="Fecha Nacimiento"
                      id='fecha_nacimiento' 
                      name='fecha_nacimiento' 
                      required = ""
                      class="form-control input-sm"/>  
                <span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
          </div>
      </div>
    </div>

</div>

<div class="row xs-pt-15">
  <div class="col-xs-6">
    <p class="text-left">
<!--       <button type="button" class="btn btn-space btn-success modificar_datos">Modificar datos </button> -->
    </p>
  </div>
  <div class="col-xs-12">
  <div class="col-xs-6">
    <p class="text-left">
      <button type="button" class="btn btn-space btn-success modificar_datos">Modificar datos </button>
    </p>
  </div>

  <div class="col-xs-6">
    <p class="text-right">
      <button type="submit" class="btn btn-space btn-primary">Registrar consulta </button>
    </p>
  </div>

  </div>
</div>


@if(isset($ajax))
  <script type="text/javascript">
    $(document).ready(function(){
      App.formElements();
    });
  </script> 
@endif