<table id="nso" class="table table-striped table-borderless table-hover td-color-borde td-padding-7">
  <thead>
    <tr>
      <th>Turno</th>
      <th>Paciente</th>
      <th>Doctor</th>
      <th>X</th>
    </tr>
  </thead>
  <tbody>
    @foreach($listacontroles as $index=>$item)
      <tr class="@if($item->ind_atendido == 1) online @endif">
        <td class='center'>{{$index + 1}}</td>
        <td class="cell-detail"> 
          <span>{{$item->paciente->apellido_paterno}} {{$item->paciente->apellido_materno}} {{$item->paciente->nombres}}</span>
          <span class="cell-detail-description"><b>{{$item->paciente->dni}} </b> 
          

        </td>
        <td>{{$item->user->nombre}}</td>
        <td>
            <a href="#" class="tooltipcss opciones eliminarmodalcontrol" 
            data_control_id = "{{$item->id}}"
            data_nombre_id = "{{$item->paciente->apellido_paterno}} {{$item->paciente->apellido_materno}} {{$item->paciente->nombres}}"
            >
                <span class="icon mdi mdi-delete" style="color: #eb6357;font-size: 1.6em"></span>
            </a>
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