@extends('layouts/master')
@section('content')


<form id="productos">
<div class="container">

<h1 align="center">DATOS DE FACTURA</h1>
<table class="table table-bordered"> 
<tr class="active">
	<th width="300"><p class="text-center">Empresa Distribuidora</p></th> 
	<th width="150"><p class="text-center">RIF</p></th>
	<th 		><p class="text-center">Dirreción</p></th> 
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
</div>


<div class="container-inv">

<div class="productos">
 		<table class="table table-bordered" id="dataTable"> 
        <tr class="active">
        <th width="350"><p class="text-center">CODIGO</p></th> 
        <th width="150"><p class="text-center">PRODUCTO</p></th> 
        <th width="150"><p class="text-center">UNIDADES A AGREGAR</p></th>
        <th width="150"><p class="text-center"></p><button type="button" id="agregar" class="btn btn-warning" onclick="insertar_fila('dataTable')">AGREGAR PRODUCTOS</button></th>  
        </tr>
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
        <button type="button" name="refrescar" id="refrescar" class="btn btn-success"  onclick="guardar_prod();">SI</button>
        <button type="button" class="btn btn-danger"  data-dismiss="modal">NO</button> 
        </div>
      </div>
    </div>
  </div>
</div>




<script>

$(function () {
    $(document).on('click', '.borrar', function (event) {
        event.preventDefault();
        $(this).closest('tr').remove();
    });
});

var datos=null;
$(document).ready(function() {
  var dataString=('operacion');
  $.ajax( {  
     url:   '../pages/bd_consulta.php',
    type:  'post',
    data: dataString,     
    success:  function (data) {
    //alert(data);
    datos=data;
  insertar_fila('dataTable');
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
  fecha=$('#fech').val();
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
    cant=$('#cantidad_'+i).val();
    prod=$('#producto_'+i).val();
            if ((cant>0)&&(prod>0)) {
            $('#fila-'+i).removeClass('danger');  
            }
            else{
            $('#fila-'+i).addClass('danger');

            }
    }

val_productos=$("tr").hasClass("danger");
//console.log(val_factura,val_productos,val_fecha)

if ((val_factura==true)&&(val_productos==false)&&(val_fecha==true)) {
$('#example').modal('show')
}
else{
alert("Debe llenar los campos Necesarios!");
}

}

contador=0;
function insertar_fila(tableID) {

               var table = document.getElementById(tableID);
               var rowCount = table.rows.length;
               var row = table.insertRow(rowCount);
               row.id = "fila";


               var cell1 = row.insertCell(0);
               var element1 = document.createElement("text");
               element1.innerHTML ="";
               element1.id = "cod_producto";
               cell1.appendChild(element1);


               var cell2 = row.insertCell(1);
               var element2 = document.createElement("text");
               element2.id="select";
               element2.innerHTML ="<select class='selcls' id='producto' name='producto[]' onchange='select_producto("+contador+");'></select>";
               cell2.appendChild(element2);


               var cell5 = row.insertCell(2);
               var element5 = document.createElement('text');
               element5.id="cantidad";
               element5.innerHTML ="<div id='cantidad_div'><input class='input form-control' id='cantidad[]'  name='cantidad'  type='text' required placeholder='Unidades' onkeyup ='VALIDAR_NUMERO(this.id, this.value);'></div>";
               cell5.appendChild(element5);


               var cell6 = row.insertCell(3);
               var element6 = document.createElement('text');
               element6.id="eliminar";
               if (contador!=0) {
               element6.innerHTML ="<input type='button' class='borrar btn-danger' value='Eliminar' />";
               cell6.appendChild(element6);
             }
insertar_productos() ;

}


function insertar_productos(){
  var x=contador;
  $('#producto_'+x).append(datos);
  contador++;
}


function eliminar_fila(j){
$("#fila-"+j).remove();
contador=contador--;
}


function select_producto(x){
repetir=false;
  for (var i = 0; i < contador; i++) {
        if ($('#producto_'+i).val()==($('#producto_'+x).val()) &&('producto_'+x)!=('producto_'+i))  {
        repetir=true;
        break;
        }
  }
  if (repetir==true) {
        alert("Este Producto Ya ha sido Seleccionado!!")
        $('#producto_'+x).val(0);
        $("#cod_producto_"+x)     .html("");
        $("#presentacion_"+x)     .html("");
        $("#existencia_"+x)       .html("");
  }
  else{
    producto(x);
  }
}

function producto(x){
      z=($('#producto_'+x).val());
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
  }
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
        var dataString = $('#productos').serialize() + '&contador=' + contador;
  console.log('Datos: '+dataString);
          $.ajax({
            type: "POST",
            url: "../pages/bd_guardar_productos.php",
            data: dataString,contador,
            success: function(data) {
              console.log(data);
            }
        })
}

function VALIDAR_NUMERO(id,value){
      if (!/^([0-9])*$/.test(value)){
        $("#"+id).val("");
      }
}


//https://es.stackoverflow.com/questions/9141/eliminar-fila-de-tabla-html-con-jquery-o-js
//http://jsbin.com/xekofexonu/1/edit?html,js,output
//https://es.stackoverflow.com/questions/35433/c%C3%B3mo-eliminar-todas-las-filas-de-una-tabla-que-se-han-creado-en-forma-din%C3%A1mica
//http://www.lawebdelprogramador.com/codigo/JQuery/2279-Anadir-y-eliminar-filas-de-una-tabla-con-jquery.html
</script>

@endsection