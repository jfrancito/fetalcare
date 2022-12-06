@extends('template')
@section('style')

    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/select2/css/select2.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/bootstrap-slider/css/bootstrap-slider.css') }} "/>

@stop
@section('section')

<div class="be-content">
  <div class="main-content container-fluid">

    <!--Basic forms-->
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">EXAMENES<span class="panel-subtitle">Crear un nuevo Examen</span></div>
          <div class="panel-body">
            <form method="POST" action="{{ url('/agregar-examenes/'.$idopcion) }}" style="border-radius: 0px;" class="form-horizontal group-border-dashed">
                  {{ csrf_field() }}

              <div class="form-group">
                <label class="col-sm-3 control-label">Codigo</label>
                <div class="col-sm-6">

                  <input  type="text"
                          id="codigo" name='codigo' value="{{ old('codigo') }}" placeholder="Codigo"
                          required = ""
                          autocomplete="off" class="form-control" data-aw="1"/>
  @include('error.erroresvalidate', [ 'id' => $errors->has('codigo')  , 
                                                        'error' => $errors->first('codigo', ':message') , 
                                                        'data' => '1'])

                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Descripcion</label>
                <div class="col-sm-6">

                  <input  type="text"
                          id="descripcion" name='descripcion' value="{{ old('descripcion') }}" placeholder="Descripcion"
                          required = ""
                          autocomplete="off" class="form-control" data-aw="4"/>

                    @include('error.erroresvalidate', [ 'id' => $errors->has('descripcion')  , 
                                                        'error' => $errors->first('descripcion', ':message') , 
                                                        'data' => '4'])

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

    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
        App.formElements();
        $('form').parsley();
      });
    </script> 
@stop