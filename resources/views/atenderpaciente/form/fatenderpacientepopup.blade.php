
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
  <div id="home4" class="tab-pane active cont">
    <h5><b>DNI : </b>{{$paciente->dni}}</h5>
  </div>
</div>
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
  <div id="home4" class="tab-pane active cont">
    <h5><b>Nombre : </b> {{$paciente->nombres}}</h5>
  </div>
</div>
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
  <div id="home4" class="tab-pane active cont">
    <h5><b>Apellido paterno : </b> {{$paciente->apellido_paterno}}</h5>
  </div>
</div>
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
  <div id="home4" class="tab-pane active cont">
    <h5><b>Apellido materno : </b> {{$paciente->apellido_materno}}</h5>
  </div>
</div>
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
  <div id="home4" class="tab-pane active cont">
    <h5><b>Sexo : </b> {{$funcion->rp_sexo_paciente($paciente->sexo)}}</h5>
  </div>
</div>
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
  <div id="home4" class="tab-pane active cont">
    <h5><b>Fecha Nacimiento : </b> {{date_format(date_create($paciente->fecha_nacimiento), 'd-m-Y')}}</h5>
  </div>
</div>

<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
  <div id="home4" class="tab-pane active cont">
    <h5><b>Edad : </b> {{$edad}} años</h5>
  </div>
</div>

<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
  <div id="home4" class="tab-pane active cont">
    <h5><b>Telefono : </b> {{$paciente->telefono}}</h5>
  </div>
</div>
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
  <div id="home4" class="tab-pane active cont">
    <h5><b>Doctor : </b> {{$control->user->nombre}}</h5>
  </div>
</div>
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
  <div id="home4" class="tab-pane active cont">
    <h5><b>Tipo de cita : </b> {{$funcion->rp_tipo_cita($control->control_resultado)}}</h5>
  </div>
</div>
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
  <div id="home4" class="tab-pane active cont">
    <h5><b>Fecha {{$funcion->rp_tipo_cita($control->control_resultado)}} : </b> {{date_format(date_create($control->fecha), 'd-m-Y')}}</h5>
  </div>
</div>

<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
  <div id="home4" class="tab-pane active cont">
    <h5><b>Dirección : </b> {{$paciente->direccion}}</h5>
  </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

    <div class="form-group" style="padding-top: 0px;">
    <label class="col-sm-12 control-label" style="text-align: left;"><b>ANAMNESIS : </b></label>
    <div class="col-sm-12">

        <textarea 
        name="anamnesis"
        id = "anamnesis"
        
        class="form-control input-sm"
        rows="5" 
        cols="50"
        data-aw="1">{{$control->anamnesis}}</textarea>

        @include('error.erroresvalidate', [ 'id' => $errors->has('anamnesis')  , 
                                            'error' => $errors->first('anamnesis', ':message') , 
                                            'data' => '1'])

    </div>
    </div>

</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="form-group" style="padding-top: 0px;">
    <label class="col-sm-12 control-label" style="text-align: left;"><b> EXAMEN FISICO :</b></label>
    </div>
</div>



<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
    <div class="form-group" style="padding-top: 0px;">
      <label class="col-sm-12 control-label" style="text-align: left;">Tº </label>
      <div class="col-sm-12">

          <input  type="text"
                  id="temperatura" name='temperatura' 
                  value="{{$control->temperatura}}"
                  placeholder="Tº"
                  
                  autocomplete="off" class="form-control input-sm" data-aw="2"/>

          @include('error.erroresvalidate', [ 'id' => $errors->has('temperatura')  , 
                                              'error' => $errors->first('temperatura', ':message') , 
                                              'data' => '2'])

      </div>
    </div>
</div>


<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
    <div class="form-group" style="padding-top: 0px;">
      <label class="col-sm-12 control-label" style="text-align: left;">PA </label>
      <div class="col-sm-12">

          <input  type="text"
                  id="pa" name='pa' 
                  value="{{$control->pa}}"
                  placeholder="PA"
                  
                  autocomplete="off" class="form-control input-sm" data-aw="3"/>

          @include('error.erroresvalidate', [ 'id' => $errors->has('pa')  , 
                                              'error' => $errors->first('pa', ':message') , 
                                              'data' => '3'])

      </div>
    </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
    <div class="form-group" style="padding-top: 0px;">
      <label class="col-sm-12 control-label" style="text-align: left;">FR </label>
      <div class="col-sm-12">

          <input  type="text"
                  id="fr" name='fr' 
                  value="{{$control->fr}}"
                  placeholder="FR"
                  
                  autocomplete="off" class="form-control input-sm" data-aw="4"/>

          @include('error.erroresvalidate', [ 'id' => $errors->has('fr')  , 
                                              'error' => $errors->first('fr', ':message') , 
                                              'data' => '4'])

      </div>
    </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
    <div class="form-group" style="padding-top: 0px;">
      <label class="col-sm-12 control-label" style="text-align: left;">FC </label>
      <div class="col-sm-12">

          <input  type="text"
                  id="fc" name='fc' 
                  value="{{$control->fc}}"
                  placeholder="FC"
                  
                  autocomplete="off" class="form-control input-sm" data-aw="5"/>

          @include('error.erroresvalidate', [ 'id' => $errors->has('fc')  , 
                                              'error' => $errors->first('fc', ':message') , 
                                              'data' => '5'])

      </div>
    </div>
</div>




<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
    <div class="form-group" style="padding-top: 0px;">
      <label class="col-sm-12 control-label" style="text-align: left;">Talla (m) </label>
      <div class="col-sm-12">

          <input  type="text"
                  id="talla" name='talla' 
                  value="{{number_format($control->talla,2)}}"
                  placeholder="TALLA EN METROS"
                  data-parsley-maxlength="6"
                  autocomplete="off" class="form-control input-sm validarnumero" data-aw="5"/>

          @include('error.erroresvalidate', [ 'id' => $errors->has('talla')  , 
                                              'error' => $errors->first('talla', ':message') , 
                                              'data' => '12'])

      </div>
    </div>
</div>


<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
    <div class="form-group" style="padding-top: 0px;">
      <label class="col-sm-12 control-label" style="text-align: left;">Peso (Kg) </label>
      <div class="col-sm-12">

          <input  type="text"
                  id="peso" name='peso' 
                  value="{{$control->peso}}"
                  placeholder="PESO EN KG"
                  
                  autocomplete="off" class="form-control input-sm validarnumero" data-aw="5"/>

          @include('error.erroresvalidate', [ 'id' => $errors->has('peso')  , 
                                              'error' => $errors->first('peso', ':message') , 
                                              'data' => '13'])

      </div>
    </div>
</div>



<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
    <div class="form-group" style="padding-top: 0px;">
      <label class="col-sm-12 control-label" style="text-align: left;" title="INDICADOR DE MASA CORPORAL">IMC </label>
      <div class="col-sm-12">

          <input  type="text"
                  id="imc" name='imc' 
                  value="{{$control->imc}}"
                  placeholder="IMC"
                  autocomplete="off" class="form-control input-sm noeditable" data-aw="5"/>

          @include('error.erroresvalidate', [ 'id' => $errors->has('imc')  , 
                                              'error' => $errors->first('imc', ':message') , 
                                              'data' => '13'])

      </div>
    </div>
</div>



<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="form-group" style="padding-top: 0px;">
    <label class="col-sm-12 control-label" style="text-align: left;"></label>
    <div class="col-sm-12">

        <textarea 
        name="examen_fisico"
        id = "examen_fisico"
        
        class="form-control input-sm"
        rows="5" 
        cols="50"
        data-aw="6">{{$control->examen_fisico}}</textarea>

        @include('error.erroresvalidate', [ 'id' => $errors->has('examen_fisico')  , 
                                            'error' => $errors->first('examen_fisico', ':message') , 
                                            'data' => '6'])

    </div>
    </div>
</div>



<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

    <div class="form-group" style="padding-top: 0px;">
    <label class="col-sm-12 control-label" style="text-align: left;"><b>PLAN DE TRABAJO :</b> </label>
    <div class="col-sm-12">

        <textarea 
        name="plan_trabajo"
        id = "plan_trabajo"
        
        class="form-control input-sm"
        rows="5" 
        cols="50"
        data-aw="7">{{$control->plan_trabajo}}</textarea>

        @include('error.erroresvalidate', [ 'id' => $errors->has('plan_trabajo')  , 
                                            'error' => $errors->first('plan_trabajo', ':message') , 
                                            'data' => '7'])

    </div>
    </div>

</div>


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
  <div class='listajax_detalle'>
      <table class="table table-condensed table-striped">
          <thead>
            <tr>
              <th>CIE 10</th>
              <th>DIAGNOSTICO</th>
            </tr>
          </thead>
          <tbody>
          @foreach($listadetallecie as $index => $item)
              <tr>
                <td>{{$item->codigocie}}</td>
                <td>{{$item->descripcion}}</td>
              </tr>                  
          @endforeach
          </tbody>
      </table>
  </div>
</div>

<input type="hidden" name="control_id" id= 'control_id' value = '{{$control->id}}'>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

    <div class="form-group" style="padding-top: 0px;">
    <label class="col-sm-12 control-label" style="text-align: left;"><b>TRATAMIENTO : </b></label>
    <div class="col-sm-12">

        <textarea 
        name="tratamiento"
        id = "tratamiento"
        
        class="form-control input-sm"
        rows="5" 
        cols="50"
        data-aw="9">{{$control->tratamiento}}</textarea>

        @include('error.erroresvalidate', [ 'id' => $errors->has('tratamiento')  , 
                                            'error' => $errors->first('tratamiento', ':message') , 
                                            'data' => '9'])

    </div>
    </div>

</div>

<div class="row xs-pt-15">
  <div class="col-xs-6">
      <div class="be-checkbox">

      </div>
  </div>
  <div class="col-xs-12">
    <p class="text-right">
        <a  target="_blank" 
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
                    Imprimir Receta
                  </button>
                      </a>
    </p>
  </div>
</div>






