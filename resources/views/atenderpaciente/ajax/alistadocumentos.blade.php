<table class="table table-condensed table-striped">
    <thead>
      <tr>
        <th>Documento</th>
        <th>Ver</th>
        <th>X</th>
      </tr>
    </thead>
    <tbody>
    @foreach($listadetalledoc as $index => $item)
        <tr>
          <td>{{$item->descripcion}}</td>
          <td>
            <a target="_blank" href="{{ url('/descargar-documento-control/'.Hashids::encode(substr($item->id, -8))) }}" class="tooltipcss opciones">
              Ver
            </a>
          </td>
          <td>
            <a href="#" class="tooltipcss opciones eliminardoc" data_detalle_id = "{{$item->id}}">
                <span class="icon mdi mdi-delete" style="color: #eb6357;font-size: 1.3em"></span>
            </a>
          </td>
        </tr>                  
    @endforeach
    </tbody>
</table>