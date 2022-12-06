@extends('template')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/select2/css/select2.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/bootstrap-slider/css/bootstrap-slider.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datatables/css/dataTables.bootstrap.min.css') }} "/>
@stop
@section('section')

<div class="be-content">
  <div class="main-content container-fluid">

    <!--Basic forms-->
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">EXAMENES<span class="panel-subtitle">Modificar Examen : {{$registro->codigo}}</span></div>
          <div class="panel-body">


            <form method="POST" action="{{ url('/modificar-examenes/'.$idopcion.'/'.Hashids::encode(substr($registro->id, -8))) }}" style="border-radius: 0px;" class="form-horizontal group-border-dashed">
                  {{ csrf_field() }}


              <div class="form-group">
                <label class="col-sm-3 control-label">Codigo</label>
                <div class="col-sm-6">

                  <input  type="text"
                          id="codigo" name='codigo' value="{{ old( 'codigo', $registro->codigo) }}" placeholder="Codigo"
                          required = ""
                          autocomplete="off" class="form-control" data-aw="1"/>
                  
                  @include('error.erroresvalidate', [ 'id' => $errors->has('codigo')  , 
                                                        'error' => $errors->first('codigo', ':message') , 
                                                        'data' => '1'])

                </div>
              </div>

              
              <div class="form-group">
                <label class="col-sm-3 control-label">Descripcion</label>
                <div class="col-sm-5">

                  <input  type="text"
                          id="descripcion" name='descripcion' value="{{old('descripcion',$registro->descripcion)}}" placeholder="Descripcion"
                          required = ""
                          autocomplete="off" class="form-control input-sm" data-aw="4"/>

                    @include('error.erroresvalidate', [ 'id' => $errors->has('descripcion')  ,
                                                        'error' => $errors->first('descripcion', ':message') ,
                                                        'data' => '4'])

                </div>
              </div>



              <div class="form-group">
                <label class="col-sm-3 control-label">Activo</label>
                <div class="col-sm-5">
                  <div class="be-radio has-success inline">
                    <input type="radio" value='1' @if($registro->activo == 1) checked @endif name="activo" id="rad6">
                    <label for="rad6">Activado</label>
                  </div>
                  <div class="be-radio has-danger inline">
                    <input type="radio" value='0' @if($registro->activo == 0) checked @endif name="activo" id="rad8">
                    <label for="rad8">Desactivado</label>
                  </div>
                </div>
              </div>

              <div class="row xs-pt-15">
                <div class="col-xs-6">
                    <div class="be-checkbox">

                    </div>
                </div>
                <div class="col-xs-6">
                  <p class="text-right">
                    <button type="submit" class="btn btn-space btn-primary">Guardar</button>
                  </p>
                </div>
              </div>

            </form>


          </div>
        </div>
      </div>
    </div>


  </div>
</div>



@stop

@section('script')



    <script src="{{ asset('public/lib/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/jquery.nestable/jquery.nestable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/moment.js/min/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/select2/js/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/bootstrap-slider/js/bootstrap-slider.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/js/app-form-elements.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/parsley/parsley.js') }}" type="text/javascript"></script>


    <script src="{{ asset('public/lib/datatables/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/datatables/js/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/datatables/plugins/buttons/js/dataTables.buttons.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.html5.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.flash.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.print.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.colVis.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/js/app-tables-datatables.js') }}" type="text/javascript"></script>


    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
        App.dataTables();
        App.formElements();
        $('form').parsley();
      });
    </script>
    <script src="{{ asset('public/js/user/user.js?v='.$version) }}" type="text/javascript"></script>

@stop