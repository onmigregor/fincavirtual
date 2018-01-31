@extends('layouts/master')
@section('content')

<?php

$empresa=$respuesta['entidadRespuesta'];

?>

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
    <td class="col-md-2">
    <strong>
    EMPRESA
    </strong>
    </td>

    <td class="col-md-1">
    <strong>
    RIF
    </strong>
    </td>

    <td class="col-md-1">
    <strong>
    ESTADO
    </strong>
    </td>

    <td class="col-md-1">
    <strong>
    MUNICIPIO
    </strong>
    </td>
    
    <td class="col-md-1">
    <strong>
    PARROQUIA
    </strong>
    </td>
    
    <td class="col-md-2">
    <strong>
    CIUDAD
    </strong>
    </td>

    <td class="col-md-2">
    <strong>
    NOMBRE R. LEGAL
    </strong>
    </td>

    <td class="col-md-2">
    <strong>
    APELLIDO R. LEGAL
    </strong>
    </td>

    <td class="col-md-2">

    </td>
  </tr>

<?php
  foreach ($respuesta['entidadRespuesta'] as $i => $empresa) 
  {
    $class='';
    if ($empresa['visto']==FALSE) 
    {
      $class='danger';
    }
      

?>
 
  <tr class="<?php echo $class?>" onclick="location.href='empresa/<?php echo$empresa['cod_rif']?>'">
    <td class="col-md-1">
    <?php echo $empresa['razon_social'];?>
    </td>

    <td class="col-md-1">
    <?php echo $empresa['cod_rif'];?>
    </td>

    <td class="col-md-1">
    <?php echo $empresa['estado'];?>
    </td>

    <td class="col-md-1">
    <?php echo $empresa['municipio'];?>
    </td>

    <td class="col-md-1">
    <?php echo $empresa['parroquia'];?>
    </td>

    <td class="col-md-1">
    <?php echo $empresa['ciudad'];?>
    </td>

    <td class="col-md-1">
    <?php echo $empresa['nombrerepre'];?>
    </td>

    <td class="col-md-1">
    <?php echo $empresa['apellido'];?>
    </td>

    <td class="col-md-2">
             
    <?php
    if ($empresa['visto']==FALSE) 
    {
    
    ?>
        <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> NUEVO REGISTRO
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
@endsection