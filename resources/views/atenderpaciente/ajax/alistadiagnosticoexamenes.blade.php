<div class="col-sm-12">
  <table class="table table-condensed table-striped lsexamenes" id="lsexamenes" >
    <thead>
      <tr>
        <th>Codigo</th>
        <th>Descripcion</th>
        <th>Diagnostico</th>
        <th>X</th>
      </tr>
    </thead>
        <tbody>                              
    @foreach($listadiagnosticosexamenes as $index => $item)
        <tr>
          <td >{{$item->examen->codigo}}</td>
          <td >{{$item->examen->descripcion}}</td>
          <td >{{$item->diagnosticoexamen->diagnostico->descripcion}}</td>
          {{-- <td >{{$item->descripcion}}</td> --}}
          <td>
            <a href="#" class="tooltipcss opciones eliminardiagexam" data_detalle_id = "{{$item->id}}">
                <span class="icon mdi mdi-delete" style="color: #eb6357;font-size: 1.3em"></span>
            </a>
          </td>
        </tr>                  
    @endforeach
    </tbody>
  </table>
</div>

