<table id="nso" class="table table-striped table-borderless table-hover td-color-borde td-padding-7">
  <thead>
    <tr>
      <th>Paciente</th>
      <th>Doctor</th>
      <th>Fecha Cita</th>
      <th>Ver</th>
      <th>Pdf</th>
    </tr>
  </thead>
  <tbody>
    @foreach($listadatos as $index=>$item)

      <tr class = 'seleccionar'
          data_control_id = "{{$item->id}}">

        <td>{{$paciente->apellido_paterno}} {{$paciente->apellido_materno}} {{$paciente->nombres}}</td>
        <td>{{$item->user->nombre}}</td>
        <td>{{date_format(date_create($item->fecha_control), 'd-m-Y')}}</td>
        <td>
            <a href="{{ url('/pop-up-detalle-control/'.Hashids::encode(substr($item->id, -8))) }}" onclick="window.open(this.href, '', 'resizable=no,status=no,location=no,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no,width=800,left=400,height=800'); return false;">Ver</a>
        </td>
        <td>
            <a target="_blank" href="{{ url('/pdf-detalle-control/'.Hashids::encode(substr($item->id, -8))) }}">Pdf</a>
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