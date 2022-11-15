@extends('template')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datatables/css/dataTables.bootstrap.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datatables/css/responsive.dataTables.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/select2/css/select2.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/bootstrap-slider/css/bootstrap-slider.css') }} "/>
@stop
@section('section')

  <div class="be-content contenido registropaciente">
    <div class="main-content container-fluid">
          <div class="row">


            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
              <div class="panel panel-default panel-border-color panel-border-color-success">
                <div class="panel-heading">Registro paciente
                  <div class="tools tooltiptop">
                    <a href="#" class="tooltipcss opciones buscarpaciente">
                      <span class="tooltiptext">Buscar paciente</span>
                      <span class="icon mdi mdi-search"></span>
                    </a>
                  </div>
                </div>
                <div class="panel-body">
                  <div class='filtrotabla row'>
                    <div class="col-xs-12">


                      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 cajareporte">

                          <div class="form-group">
                            <label class="col-sm-12 control-label labelleft" >DNI :</label>
                            <div class="col-sm-12 abajocaja">

                                <input  type="text"
                                        id="dni_b" name='dni_b' 
                                        placeholder="DNI"
                                        required = ""
                                        autocomplete="off" class="form-control input-sm" data-aw="1"/>

                                @include('error.erroresvalidate', [ 'id' => $errors->has('dni_b')  , 
                                                                    'error' => $errors->first('dni_b', ':message') , 
                                                                    'data' => '1'])

                            </div>
                          </div>

                      </div>

                      <input type="hidden" name="idopcion" id='idopcion' value='{{$idopcion}}'>

                    </div>
                  </div>

                    <form method="POST" action="{{ url('/agregar-control-paciente/'.$idopcion) }}" style="border-radius: 0px;" class="form-horizontal group-border-dashed">
                          {{ csrf_field() }}
                        <div class='formajax'>

                        @include('registrocliente.form.fregistropaciente')
                        </div>
                    </form>

                  
                </div>
              </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
              <div class="panel panel-default panel-border-color panel-border-color-success">
                <div class="panel-heading">Atencion Paciente
                  <div class="tools tooltiptop">
                    <a href="#" class="tooltipcss opciones buscarlistaatencion">
                      <span class="tooltiptext">Buscar lista paciente</span>
                      <span class="icon mdi mdi-search"></span>
                    </a>
                  </div>
                </div>
                <div class="panel-body">
                  <div class='filtrotabla row'>
                    <div class="col-xs-12">

                      <div class="form-group ">
                        <label class="col-sm-12 control-label labelleft" >Fecha :</label>
                        <div class="col-sm-12 abajocaja" >
                          <div data-min-view="2" 
                                 data-date-format="dd-mm-yyyy"  
                                 class="input-group date datetimepicker pickerfecha" style = 'padding: 0px 0;margin-top: -3px;'>
                                 <input size="16" type="text" 
                                        value="{{$fin}}" 
                                        placeholder="Fecha"
                                        id='fecha' 
                                        name='fecha' 
                                        required = ""
                                        class="form-control input-sm"/>
                                  <span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class='listajax'>

                    @include('registrocliente.ajax.alistaatencionpaciente')

                  </div>
                </div>
              </div>
            </div>


          </div>
    </div>

  </div>

@stop

@section('script')


  <script src="{{ asset('public/lib/datatables/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/js/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/dataTables.buttons.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/jszipoo.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/pdfmake.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/vfs_fonts.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.html5.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.flash.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.print.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.colVis.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.bootstrap.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/js/app-tables-datatables.js?v='.$version) }}" type="text/javascript"></script>

  <script src="{{ asset('public/lib/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/jquery.nestable/jquery.nestable.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/moment.js/min/moment.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/select2/js/select2.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/bootstrap-slider/js/bootstrap-slider.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/js/app-form-elements.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/parsley/parsley.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/jquery.niftymodals/dist/jquery.niftymodals.js') }}" type="text/javascript"></script>

  <script type="text/javascript">


    $.fn.niftyModal('setDefaults',{
      overlaySelector: '.modal-overlay',
      closeSelector: '.modal-close',
      classAddAfterOpen: 'modal-show',
    });

    $(document).ready(function(){
      //initialize the javascript
      App.init();
      App.formElements();
      App.dataTables();
      $('[data-toggle="tooltip"]').tooltip();
      $('form').parsley();

    });

  </script>
  <script src="{{ asset('public/js/registropaciente/registropaciente.js?v='.$version) }}" type="text/javascript"></script>
  <script src="{{ asset('public/js/registropaciente/modalreceta.js?v='.$version) }}" type="text/javascript"></script>

@stop