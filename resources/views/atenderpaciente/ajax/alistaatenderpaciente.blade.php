<table id="nso" class="table table-striped table-borderless table-hover td-color-borde td-padding-7">
  <thead>
    <tr>
      <th>Turno</th>
      <th>Paciente</th>
      <th>Dni</th>
      <th>Sexo</th>
      <th>Telefono</th>
      <th>Tipo Cita</th>
      <th>Doctor</th>
      <th>Estado</th>
      <th>Accion</th>
    </tr>
  </thead>
  <tbody>
    @foreach($listacontroles as $index=>$item)
      <tr class="@if($item->ind_atendido == 1) online @endif">
        <td class='center'>{{$index + 1}}</td>
        <td>{{$item->paciente->apellido_paterno}} {{$item->paciente->apellido_materno}} {{$item->paciente->nombres}}</td>
        <td>{{$item->paciente->dni}}</td>
        <td>{{$funcion->rp_sexo_paciente($item->paciente->sexo)}}</td>
        <td>{{$item->paciente->telefono}}</td>
        <td>{{$funcion->rp_tipo_cita($item->control_resultado)}}</td>
        <td>{{$item->user->nombre}}</td>
        <td>{{$funcion->rp_estado_control($item->ind_atendido)}}</td>
        <td class="rigth">
          <div class="btn-group btn-hspace">
            <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Acción <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
            <ul role="menu" class="dropdown-menu pull-right">
              <li>
                <a href="{{ url('/atender-paciente/'.$idopcion.'/'.Hashids::encode(substr($item->id, -8))) }}">
                  Atender
                </a>  
              </li>
            </ul>
          </div>
        </td>
      </tr>                    
    @endforeach
  </tbody>
</table>

@if(isset($ajax))
  <script type="text/javascript">
    $(document).ready(function(){
       App.dataTables();
    });
  </script> 
@endif