@extends('layouts/master')
@section('content')

<?php

//dump($respuesta);
$pedido=$respuesta['entidadRespuesta'];


?>

</br>
</br>


@php
if ($respuesta['codrespuesta'] =='COD_000')
{
@endphp
<form class="form-inline">
  <div class="form-group">
    <label for="exampleInputName2">Buscar (RIF/Nombre Empresa)</label>
    <input type="text" class="form-control" id="exampleInputName2" placeholder="">
  </div>
  <button type="submit" class="btn btn-default">Buscar</button>
  <div class="form-group" style=" float: right;">
  <label for="Oredenar Por">Mostar</label>
    <select class="form-control" onchange=" location.href='listar_empresas'">
      <option>Todos</option>
      <option>Aceptados</option>
      <option>Nuevos Registros</option>
      <option>No aceptados</option>
    </select>
  </div>
</form>
</br>
</br>
<table class="table table-hover">
  <tr class="active">
    <td class="col-md-1">
    <strong>
    PEDIDO #
    </strong>
    </td>
 
    <td class="col-md-1">
    <strong>
    REALIZADO POR
    </strong>
    </td>

    <td class="col-md-1">
    <strong>
    FECHA REGISTRO
    </strong>
    </td>

    <td class="col-md-1">
    <strong>
    ESTATUS ACTUAL
    </strong>
    </td>


    <td class="col-md-1">

    </td>
  </tr>

<?php
  foreach ($pedido as $i => $clave) 
  {
    $class='';
    if ($clave['visto_produccion']==FALSE) 
    {
      $class='danger';
    }
      

?>
 
  <tr class="<?php echo $class?>" onclick="location.href='pedido/e/<?php echo$clave['codpedido']?>'">
    <td class="col-md-1">
    {{ $clave['codpedido']}}
    </td>

    <td>
    OMAR RAMIREZ
    </td>

    <td>
    {{ Carbon\Carbon::parse($clave['fecha_registro'])->format('d-m-Y h:i:s A') }}
    </td>

    <td>
    {{ $clave['estatus']['siglas']}}
    <span class="glyphicon glyphicon-eye-open blue-tooltip tool" data-toggle="tooltip"
                            data-placement="top" title="{{ $clave['estatus']['descripcion'] }}"
                            style="cursor: pointer">
    </td>

    <td>
             
    <?php
    if ($clave['visto_produccion']==FALSE) 
    {
    
    ?>
        <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> NUEVO PEDIDO
    <?php
    }
    ?>
    </td>
  </tr>
<?php
}
?>
  </tr>

</table>


@php
}
@endphp

@endsection