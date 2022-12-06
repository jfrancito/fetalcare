<div class="col-sm-12">
  <table class="table table-condensed table-striped lsmedicamentos" id="lsmedicamentos" >
    <thead>
      <tr>
        <th>Codigo</th>
        <th>Descripcion</th>
        <th>Unidad</th>
        <th>Cantidad</th>
        <th>Indicacion</th>
        <th>Duracion</th>
        <th>Dosificacion</th>
        <th>Diagnostico</th>
        <th>X</th>
      </tr>
    </thead>
        <tbody>                              
    @foreach($listamedicamentos as $index => $item)
        <tr>
          <td >{{$item->medicamento->codigo}}</td>
          <td >{{$item->medicamento->descripcion}}</td>
          <td >{{$item->medicamento->unidad}}</td>
          <td >{{$item->cantidad}}</td>
          <td >{{$item->indicacion}}</td>
          <td >{{$item->dias}}</td>
          <td >{{$item->dosificaciondetalle()}}</td>
          <td >{{$item->receta->diagnostico->descripcion}}</td>
    
          <td>
            <a href="#" class="tooltipcss opciones eliminarmed" data_detalle_id = "{{$item->id}}">
                <span class="icon mdi mdi-delete" style="color: #eb6357;font-size: 1.3em"></span>
            </a>
          </td>
        </tr>                  
    @endforeach
    </tbody>
  </table>
</div>

