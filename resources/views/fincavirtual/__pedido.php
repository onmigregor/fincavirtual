@extends('layouts/master')
@section('content')


<?php




$pedido=$respuesta['entidadRespuesta']['descripcion']['producto'];
/*foreach ($pedido as $key => $rubro) {
//dump($rubro['cantidad']);
dump($rubro);

                        //dump($rubro['cantidad']);
                  $respuesta = DB::table('rubro')
                                            ->select    ('cod_rubro', 'nombre')
                                            ->where  ('cod_tipo', '=', $rubro['cod_tipo_rubro'])
                                            ->get();

                                            foreach ($respuesta as $key => $tipo) {
                                              # code...
                                            var_export($tipo->nombre);
                                            }



}*/

     

                  ?>





?>

<form role="form" action="{{ url('regpedido') }}" id="form-productos" name="form-productos" method="POST">
<div class="container">

<h1 align="center">DATOS DE FACTURA</h1>
<table class="table table-bordered"> 
<tr class="active">
  <th width="300"><p class="text-center">Empresa Distribuidora</p></th> 
  <th width="150"><p class="text-center">RIF</p></th>
  <th     ><p class="text-center">Dirreción</p></th> 
  <th width="150"><p class="text-center">Telefono</p></th> 
  <th width="150"><p class="text-center">N° Factura</p></th>
  <th width="150"><p class="text-center">Fecha Emision</p></th>
  
</tr>
  <td><select class="selcls" id="empresa" name="empresa" onchange="select_distr();" >

  </select></td>  
  <td id="rif"></td>
  <td id="dirrecion"></td>
  <td id="tlf"></td>
  <td id="div-factura"><input type="text" class="input form-control" id="fact" disabled="" name="fact" type="text" required placeholder="Ingrese Factura"  data-toggle="facturas"></td>
  <td id="div-fecha"><input type="text" class="input form-control" name="fech" id="fech" disabled="" readonly="" data-toggle="fecha"></td>
</table>


<div class="container-inv">

<div class="productos">
    <table class="table table-bordered" id="dataTable"> 
        <tr class="active">
          <th width="200">
              <p class="text-center">TIPO DE RUBRO</p>
          </th> 

          <th width="280">
             <p class="text-center">PRODUCTO</p>
          </th>  
          <th width="180">
              <p class="text-center">UNIDADES A AGREGAR</p>
          </th>

          <th width="50">
              <button type="button" id="agregar" class="btn-success" onclick="insertar_fila('dataTable')">AGREGAR PRODUCTOS</button>
          </th>  
        </tr>
       

        @foreach($pedido as $key => $rubro)
        <tr id="fila-{{$key}}">
          <th width="200">
            <div>
            <select class='input form-control' id='cod_tipo_rubro_{{$key}}' name='cod_tipo_rubro[]' onchange='llenar_rubros({{$key}});'>
            <?php
                                   //dump($rubro['cantidad']);
                  $respuesta = DB::table('tipo_rubro')
                                            ->select ('cod_tipo', 'nombre')
                                            ->get();
                                           
                                          echo '<option value="0" disabled="disabled" selected="selected">Selecione Fabricante </option>';
                                          foreach ($respuesta as $key => $clave) 
                                          {
                                            $selected=null;
                                            if ($rubro['cod_tipo_rubro']==$clave->cod_tipo) 
                                            {
                                              $selected="selected='selected'";
                                            }
                                            var_export('<option '.$selected.'value="'.$clave->cod_tipo.'">'.$clave->nombre.'</option>');
                                          }
                  ?>
              

            </select>
            </div>
          </th>

          <th width="200">
            <div>
            <select class='input form-control cod_producto' id='cod_producto_{{$key}}' name='cod_producto[]' onchange='select_producto({{$key}});'>   <?php
                                   //dump($rubro['cantidad']);
                  $respuesta = DB::table('rubro')
                                            ->select ('cod_rubro', 'nombre')
                                            ->where  ('cod_tipo', '=', $rubro['cod_tipo_rubro'])
                                            ->get();
                                           
                                          echo '<option value="0" disabled="disabled" selected="selected">Selecione Fabricante </option>';
                                          foreach ($respuesta as $key => $clave) 
                                          {
                                            $selected=null;
                                            if ($rubro['cod_producto']==$clave->cod_rubro) 
                                            {
                                              $selected="selected='selected'";
                                            }
                                            var_export('<option '.$selected.'value="'.$clave->cod_rubro.'">'.$clave->nombre.'</option>');
                                          }
                  ?>
           



            </select>
            </div>
          </th>
          
          <th width="200">
            <div>
            <input class='input form-control cantidad' id='cantidad_{{$key}}'  name='cantidad[]'  type='text' value="{{$rubro['cantidad']}}" required placeholder='Unidades' onkeyup ='VALIDAR_NUMERO(this.id, this.value);'>
            </div>
          </th>

          <th width="200">
            <div>
              <button type='button' onclick=eliminar_fila(this.td) name='btn-eliminar' id='btn-eliminar' class='btn-danger btn-center' name='agregar_equipo' id='agregar_equipo'>Eliminar</button>
            </div>
          </th>



        </tr>
        @endforeach

    </table>
</div>







<div class="btn-agregar">
<button type="button" id="guardar" class="btn btn-primary" onclick="confirmar();">GUARDAR PRODUCTOS</button>
</div>
</div>

</form>



<div  id="example" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
     <h4 class="text-center">PROCEDERA A INGRESAR LOS SIGUIENTES PRODUCTOS DENTRO DEL SISTEMA</h4>
     <div class="modal-footer">
     <h5 class="text-center">¿DESEA CONTINUAR CON LA OPERACION?</h5>
        <div class="text-center">
        <button type="submit" id="refrescar" class="btn btn-success">SI</button>
        <button type="button" class="btn btn-danger"  data-dismiss="modal">NO</button> 
        </div>
      </div>
    </div>
  </div>
</div>




<script>
contador=  <?php echo count($pedido) ; ?>+1;

//  alert(contador)
var tipo_rubros=null;

//console.log(pedido)
$(document).ready(function() 
{
    var webservice = "getTipoRubro";
    var pagina = 'public/';
    var method = 'Get';
    var url = '{{route("getConsumirAjax")}}';
    var arrcampos = ['cod_tipo_rubro'];
    var arrvar = ['todos'];
    var data = {webservice: webservice, pagina: pagina, method: method, campos: arrcampos, valores: arrvar};
          $.ajax( {  
            url:   url,
            type:  'GET',
            data: data,
            datatype: 'JSON',    
            success:  function (data) 
            {
//            
               tipo_rubros=data;
 // insertar_fila('dataTable');
              //insertar_comienzo(inicial);
            }
            });
});
            
var fecha;
$("#fech").datepicker({
changeMonth: true,
changeYear: true,
yearRange: "2017:2030",
onSelect: function (date) {
  //alert(date)
},
});

function confirmar(){
 /* fecha=$('#fech').val();
    if (fecha.length >=10) {
    val_fecha=true;
    $('[data-toggle="fecha"]').popover('destroy');
    $('#div-fecha').removeClass('danger'); 
    }  
    else{
    val_fecha=false;

    $('[data-toggle="fecha"]').popover({content:"<p class='text-danger'>Debe Ingresar Fecha</p>" , html: true,  trigger: "focus", placement: "top"}); 
    $('#div-fecha').addClass('danger');  
    }
    factura=$('#fact').val();
    if (factura.length >=10) {
    val_factura=true;
    $('#div-factura').removeClass('danger'); 
    $('[data-toggle="facturas"]').popover('destroy');  
    }
    else{
      val_factura=false;
      $('#div-factura').addClass('danger');
      $('[data-toggle="facturas"]').popover({content:"<p class='text-danger'>Debe Ingresar Factura</p>" , html: true,  trigger: "focus", placement: "top"});   
    }

    for (var i = 0; i <= contador; i++) {

    tipo_rubros =$('#cod_tipo_rubro_'+i).val();
    prod        =$('#producto_'+i).val();
    cant        =$('#cantidad_'+i).val();

//alert(prod)
    console.log(tipo_rubros,cant,prod)
                  if ((cant>0)&&(prod>0)&&(tipo_rubros>0)) {
                  $('#fila-'+i).removeClass('danger');  
                  }
                  else{
                  $('#fila-'+i).addClass('danger');

                  }
    }

val_productos=$("tr").hasClass("danger");
//console.log(val_factura,val_productos,val_fecha)

if ((val_factura==true)&&(val_productos==false)&&(val_fecha==true)) {
}
else{
alert("Debe llenar los campos Necesarios!");
}
*/
$('#example').modal('show')
}

function insertar_fila(tableID) {
  //alert(contador);

               var table = document.getElementById(tableID);
               var rowCount = table.rows.length;
               var row = table.insertRow(rowCount);
               row.id = "fila-"+contador;


               var cell1 = row.insertCell(0);
               var element1 = document.createElement("div");               
               element1.id = "tiporubro-"+contador;
               element1.innerHTML ="<select class='input form-control' id='cod_tipo_rubro_"+contador+"' name='cod_tipo_rubro[]' onchange='llenar_rubros("+contador+",0);'></select>";
               cell1.appendChild(element1);


               var cell2 = row.insertCell(1);
               var element2 = document.createElement("div");
               element2.id="producto-"+contador;
               element2.innerHTML ="<select class='input form-control cod_producto' id='cod_producto_"+contador+"' name='cod_producto[]' onchange='select_producto("+contador+");'></select>";
               cell2.appendChild(element2);


               var cell5 = row.insertCell(2);
               var element5 = document.createElement('div');
               element5.id="cantidad_prod-"+contador;
               element5.innerHTML ="<div id='cantidad_div'><input class='input form-control cantidad' id='cantidad_"+contador+"'  name='cantidad[]'  type='text' required placeholder='Unidades' onkeyup ='VALIDAR_NUMERO(this.id, this.value);'></div>";
               cell5.appendChild(element5);


               var cell6 = row.insertCell(3);
               var element6 = document.createElement('div');
               element6.id="eliminar-"+contador;  
               element6.innerHTML ="<button type='button' onclick=eliminar_fila(this.td) name='btn-eliminar' id='btn-eliminar' class='btn-danger btn-center' name='agregar_equipo' id='agregar_equipo'>Eliminar</button>";
               cell6.appendChild(element6);
insertar_productos(contador) ;

}


function insertar_productos(k){
  
  $('#cod_tipo_rubro_'+k).append('<option value="0">Seleccione Rubro</option>');
  //alert(JSON.stringify(tipo_rubros));

  var $entidadRespuesta = tipo_rubros.entidadRespuesta
  var $count = $entidadRespuesta.length;
      for (j = 0; j < $count; j++) 
      {
        $('#cod_tipo_rubro_'+k).append('<option value="' + $entidadRespuesta[j].cod_tipo + '">' + $entidadRespuesta[j].nombre + '</option>');
      }
  //$().append(tipo_rubros);
  contador++;

}

function insertar_comienzo(k){
pedido=<?php echo json_encode($pedido) ; ?>;
 //console.log(k,data);

          //console.log(pedido[3]["cod_tipo_rubro"])
  for (var i =0; i < k; i++) 
  {
    $('#cod_tipo_rubro_'+i).append('<option value="0">Seleccione Rubro</option>');
    //alert(JSON.stringify(tipo_rubros));

    var $entidadRespuesta = tipo_rubros.entidadRespuesta
    var $count = $entidadRespuesta.length;
        for (j = 0; j < $count; j++) 
        {
          $('#cod_tipo_rubro_'+i).append('<option value="' + $entidadRespuesta[j].cod_tipo + '">' + $entidadRespuesta[j].nombre + '</option>');
        }
    $('#cod_tipo_rubro_'+i).val(pedido[i]["cod_tipo_rubro"]);
    llenar_rubros(i,pedido[i]["cod_producto"]);

  }
  contador=k;
}




function eliminar_fila(){
   $(document).on('click', '.btn-danger', function (event) {
        event.preventDefault();
        $(this).closest('tr').remove();
    });
}

function llenar_rubros(f,cod_producto)
{

              var cod_tipo_rubro = $('#cod_tipo_rubro_'+f).val();
              var webservice = "getRubro";
              var pagina = 'public/';
              var method = 'Get';
              var url = '{{route("getConsumirAjax")}}';
              var arrcampos = ['cod_tipo_rubro'];
              var arrvar = [cod_tipo_rubro];
              var data = {webservice: webservice, pagina: pagina, method: method, campos: arrcampos, valores: arrvar};
              $.ajax({
                    type: "GET",
                    //headers: {'X-CSRF-TOKEN': token},
                    url: url,
                    data: data,
                    datatype: 'JSON',
                   success: function (data) {
                        console.log(data);
                     //   alert(JSON.stringify(data)); //hacer alert de un json
                        if (data.codrespuesta == 'COD_000') {
                            // Limpiamos el select
                            $("#cod_producto_"+f).find('option').remove();
                            $("#cod_producto_"+f).append('<option value="0">Seleccione rubro</option>');
                            var $entidadRespuesta = data.entidadRespuesta
                            var $count = $entidadRespuesta.length;
                            for (j = 0; j < $count; j++) {
                                $("#cod_producto_"+f).append('<option value="' + $entidadRespuesta[j].cod_rubro+ '">' + $entidadRespuesta[j].nombre + '</option>');
                            }
                      // $("#cod_producto_"+f).prop('disabled', false);
                                $('#cod_producto_'+f).val(0);
                                if (cod_producto>0) 
                                {
                                  console.log(cod_producto)
                                  $('#cod_producto_'+f).val(cod_producto);
                                }
                              }
                    },
                    error: function (e) {
                        alert("No se puede obtener la data. " + JSON.stringify(e));
                    }
                }); 


              if (cod_producto>0) 
              {
                console.log(cod_producto)
                $('#cod_producto_'+f).val(cod_producto);
              }


}


function select_producto(x){
  console.log(x,contador,$('#cod_producto_'+x).val())
repetir=false;
  for (var i = 0; i < contador; i++) {
        if ($('#cod_producto_'+i).val()==($('#cod_producto_'+x).val()) &&('cod_producto_'+x)!=('cod_producto_'+i))  {
        repetir=true;
        break;
        }
  }
  if (repetir==true) {
        alert("Este Producto Ya ha sido Seleccionado!!")
        $('#cod_producto_'+x).val(0);
     //   $("#cod_producto_"+x)     .html("");
       // $("#presentacion_"+x)     .html("");
       // $("#existencia_"+x)       .html("");
  }

}

function producto(x){
   /*   z=($('#producto_'+x).val());
      //console.log(z,x);

            var dataString = 'cod_producto='+z;
             //console.log(dataString);

            $.ajax({
            type: "POST",
            url: "../pages/bd_consulta.php",
            data: dataString,
            success: function(data) {
              //console.log(data);

              var detalles_prod=(JSON.parse(data));
              $("#cod_producto_"+x)   .html("<p class='text-center tablet-etrabajo'>"+z+"</p>");
              $("#presentacion_"+x)  .html("<p class='text-center tablet-etrabajo'>"+detalles_prod.nom_present+"</p>");
              $("#existencia_"+x)       .html("<p class='text-center tablet-etrabajo'>"+detalles_prod.cantidad_produc+"</p>"); 
            }

            });  
      
        
  if (z!=0) {
  $( "#factura_"+x ).prop( "disabled", false );
  }*/
}



var val_distri=false;
function select_distr(){
  z=($('#empresa').val());
  //alert(z);


  var dataString = 'cod_empresa='+z;
             //console.log(dataString);

            $.ajax({
            type: "POST",
            url: "../pages/bd_consulta.php",
            data: dataString,
            success: function(data) {
              //console.log(data);
                var detalles_empre=(JSON.parse(data));
              $("#rif")        .html("<p class='text-center tablet-etrabajo'>"+detalles_empre.rif_dis+"</p>");
              $("#dirrecion")  .html("<p class='text-center tablet-etrabajo'>"+detalles_empre.dir_dis+"</p>");
              $("#tlf")         .html("<p class='text-center tablet-etrabajo'>"+detalles_empre.tlf_dis+"</p>");


              activar_input();
          }
        });

 } 

function activar_input(){
if (z!=0) {
  fact.disabled=false;
  fech.disabled=false;
}
}

function guardar_prod(){
         var dataString = $('#form-productos').serialize()
  console.log('Datos: '+dataString);
         /* $.ajax({
            type: "POST",
            url: "../pages/bd_guardar_productos.php",
            data: dataString,contador,
            success: function(data) {
              console.log(data);
            }
        })*/
}

function VALIDAR_NUMERO(id,value){
      if (!/^([0-9])*$/.test(value)){
        $("#"+id).val("");
      }
}
</script>

@endsection