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

          </td>
          <td class="col-md-1">
          <strong>
           <p align="center"> 
          PEDIDO #
          </p>
          </strong>
          </td>
       
          <td class="col-md-1">
          <strong>
           <p align="center"> 
          UNIDAD PRODUCCION
          </strong>
          </p>
          </td>

          <td class="col-md-1">
          <strong>
           <p align="center"> 
          FECHA REGISTRO
          </p>
          </strong>
          </td>

          <td class="col-md-1">
          <strong>
           <p align="center"> 
          ESTATUS ACTUAL
          </p>
          </strong>
          </td>

          <td class="col-md-1">
          
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
       
        <tr class="<?php echo $class?>" onclick="//location.href='pedido/e/<?php echo$clave['codpedido']?>'">

          <td >
           <input class="form-check-input" type="checkbox" id="checkpedido[]" name="checkpedido[]" value="{{ $clave['codpedido']}}">
          </td>
          <td >
            <p align="center"> 
          {{ $clave['codpedido']}}
          </p>
          </td>

          <td>
            <p align="center"> 
          OMAR RAMIREZ
          </p>
          </td>

          <td>
            <p align="center"> 
          {{ Carbon\Carbon::parse($clave['fecha_registro'])->format('d-m-Y h:i:s A') }}
          </p>
          </td>


          <td>
          <p align="center"> {{ $clave['estatus']['siglas']}}
          <span class="glyphicon glyphicon-eye-open blue-tooltip tool" data-toggle="tooltip"
                                  data-placement="top" title="{{ $clave['estatus']['descripcion'] }}"
                                  style="cursor: pointer">
          </p>
          </td>

        
            <td>
            <strong>
                <p align="center"> 
           <a href="javascript:void(0)" onclick='mostrar_pedido("{{$clave["codpedido"]}}");'>Detalles</a>
            </p>
            </strong> 

            </td>


          <td>        
          <?php
          if ($clave['visto_produccion']==FALSE) 
          {
          
          ?>
            <p align="center"> 
              <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> NUEVO PEDIDO
              </p>
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

      <button type="button" class="btn btn-success"  onClick="window.location.href='{{ url('pedido/n/') }}  '">ASIGNAR PEDIDOS</button>


      @php
      }
      @endphp


<div class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <div class="col-md-6 col-xs-6">
          <h4 class="titulo_pedido"></h4>
          </div>
          <div class="col-md-6 col-xs-6">
          <h4 class="titulo_unidad"></h4>
          </div>
           <div class="col-md-12 col-xs-12">
          <h4 align="center"></h4>
          </div>
      </div>
      <div id="prueba" class="modal-body">
        <table class="table table-bordered" id="dataTable"> 
        <tr class="active">
          <th >
              <p class="text-center">PRODUCTO</p>
          </th> 

          <th >
             <p class="text-center">CANTIDAD</p>
          </th>  
        </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>


<script type="text/javascript">

      function mostrar_pedido(pedido) 
      { 
        contador=0
         //alert(pedido)
         $(".revocar").remove();
     
        var webservice = "getPedido";
        var pagina = 'public/';
        var method = 'Get';
        var url = '{{route("getConsumirAjax")}}';
        var arrcampos = ['pedido'];
        var arrvar = [pedido];
        var data = {webservice: webservice, pagina: pagina, method: method, campos: arrcampos, valores: arrvar};
            //alert(data);
                $.ajax({
                    type: "GET",
                    //headers: {'X-CSRF-TOKEN': token},
                    url: url,
                    async: false,
                    data: data,
                    datatype: 'JSON',
                   success: function (text) {
                    //console.log(text)
                      if (text.codrespuesta=="COD_000")
                      {
                        //console.log(text)
                        cargar_descripciones(text.entidadRespuesta)
                        $('.titulo_pedido').html("Codigo Pedido:"+text.entidadRespuesta.codpedido)
                        $('.titulo_unidad').html("Nombre Responsable:"+text.entidadRespuesta.codpedido)

                       //modal_detalles(text.entidadRespuesta)
                      }
                     
                    },
                    error: function (e) {
                        alert("No se puede obtener la data. " + JSON.stringify(e));
                    }
                });
       
      }

      function  cargar_descripciones(entidadRespuesta)
      {
        producto=entidadRespuesta.descripcion.producto
        
        var webservice = "getDescripcionRubro";
        var pagina = 'public/';
        var method = 'Post';
        var url = '{{route("getConsumirAjax")}}';
        var arrcampos = ['producto'];
        var arrvar = [producto];
        var data = {webservice: webservice, pagina: pagina, method: method, campos: arrcampos, valores: arrvar};
            //alert(data);
                $.ajax({
                    type: "GET",
                    //headers: {'X-CSRF-TOKEN': token},
                    url: url,
                    data: data,
                    datatype: 'JSON',
                   success: function (text) {
                        //console.log(text)

                        //console.log(text.producto.length)
                        for (var i = 0 ; i < text.producto.length; i++) 
                        {
                          
                          insertar_fila("dataTable",text.producto[i])
                        }
                        modal_detalles()
                   
                     
                    },
                    error: function (e) {
                        alert("No se puede obtener la data. " + JSON.stringify(e));
                    }
                });


      }

      function modal_detalles(detalles)
      {
        //console.log(detalles)
        $('.modal').modal('show')
      }
      function insertar_fila(tableID,parametros) 
      {

               var table = document.getElementById(tableID);
               var rowCount = table.rows.length;
               var row = table.insertRow(rowCount);
               row.id = "fila-"+contador;

               var cell1 = row.insertCell(0);
               var element1 = document.createElement("div");
               element1.id="producto-"+contador;
               element1.innerHTML ="<p class='text-center'>"+parametros.nombre+"</p>"; 
               cell1.appendChild(element1);


               var cell2 = row.insertCell(1);
               var element2 = document.createElement('div');
               element2.id="cantidad_prod-"+contador;
               element2.innerHTML ="<p class='text-center'>"+parametros.cantidad+"</p>";
               cell2.appendChild(element2);

               $('#fila-'+contador).addClass('revocar')
               contador++

      }

          
  
</script>>

      @endsection