
@extends('layouts/master')
@section('content')



<?php
$contestado=count($respuesta['estados']['entidadRespuesta']);

?>
    <div class="col-xs-12 col-sm-12">
    <div class="panel panel-primary" style="width:100%; text-align: center; margin-top: 55px;">

        <div class="panel-heading"><strong><h3 class="panel-title" style="text-transform: uppercase;"><span class="glyphicon glyphicon-lock"></span> Registro de Unidad de Producci&oacute;n</h3></strong></div>
        <div class="panel-body">


            <form role="form" action="{{ url('post_registro_unidad') }}" id="LoginForm" name="LoginForm" method="POST">


                <div class="col-xs-12 col-sm-12">
                    <div class="col-xs-12 col-sm-12">
                        <strong>SELECCIONE TIPO DE UNIDAD SOCIALISTA</strong>
                    </div>
                </br>
                </br>
                    <div class="col-xs-6 col-sm-6">
                    <input type="radio" name="tipo_unidad[]" id="tipo_unidad-0" value="UNI001" checked=""><strong style="padding-left :15px;"> Arepera Socialista</strong>

                    </div>
                    <div class="col-xs-6 col-sm-6">
                    <input type="radio" name="tipo_unidad[]" id="tipo_unidad-1" value="UNI002"><strong style="padding-left :15px;">Panaderia Socialista</strong>
                    </div>
                    
                </div>
                

                <div class="col-xs-12 col-sm-4">
                    <p align="left" style="padding-top: 15px;"><strong>Unidad de Produci&oacute;n (Nombre)</strong></p>
                        <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="left" title='Nombre de Usuario'></i></span>
                          <input type="text" class="form-control input-sm" name="usuario" id="usuario" placeholder="Ingrese Nombre de Usuario" autofocus value="" autocomplete="off" maxlength="27"
                           data-container="body"
                           data-placement="top"
                           data-msg-required="Este campo es Requerido."
                           data-msg-minlength="Debes ingresar al menos 3 caracteres."
                           data-rule-required="true"
                           data-rule-minlength="3"
                    >
                        </div>
                </div>

                   <div class="col-xs-12 col-sm-4">
                        <p align="left" style="padding-top: 15px;"><strong>Correo Electronico</strong></p>
                        <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" data-toggle="tooltip" data-placement="left" title='Correo de la Unidad'></i></span>
                          <input type="email" class="form-control input-sm" name="correo" id="correo" placeholder=" correo@gmail.com" autofocus value="" autocomplete="off" 
                          maxlength="45"
                          data-container="body"
                          data-placement="top"
                          data-msg-required="Este campo es Requerido."
                          data-msg-minlength="Debes ingresar al menos 10 caracteres."
                          data-msg-email="Debe ingresar un  Formato de correo electronico valido"                                         
                          data-rule-required="true"
                          data-rule-minlength="10" 
                          >
                        </div> 
                    </div>

                <div class="col-xs-12 col-sm-4">
                    <p align="left" style="padding-top: 15px;"><strong>Telefono</strong></p>
                        <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="left" title='RIF'></i></span>
                          <input type="text" class="form-control input-sm" name="telefono" id="telefono" placeholder="Telefono Unidad" autofocus value="" autocomplete="off" maxlength="27"
                           data-container="body"
                           data-placement="top"
                           data-msg-required="Este campo es Requerido."
                           data-msg-minlength="Debes ingresar al menos 3 caracteres."
                           data-rule-required="true"
                           data-rule-minlength="3"
                    >
                        </div>
                </div>

                <div class="col-xs-12 col-sm-4">
                    <p align="left" style="padding-top: 15px;"><strong>Contraseña</strong></p>
                        <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="left" title='RIF'></i></span>
                          <input type="password" class="form-control input-sm" name="contrasena" id="contrasena" placeholder="Ingrese Contraseña" autofocus value="" autocomplete="off" maxlength="27"
                           data-container="body"
                           data-placement="top"
                           data-msg-required="Este campo es Requerido."
                           data-msg-minlength="Debes ingresar al menos 6 caracteres."
                           data-rule-required="true"
                           data-rule-minlength="6"
                    >
                        </div>
                </div>

                <div class="col-xs-12 col-sm-4">
                    <p align="left" style="padding-top: 15px;"><strong>Confirmar Contraseña</strong></p>
                        <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="left" title='RIF'></i></span>
                          <input type="password" class="form-control input-sm" name="confirmar_contra" id="confirmar_contra" placeholder="Condrimar Contraseña" autofocus value="" autocomplete="off" maxlength="27"
                           data-container="body"
                           data-placement="top"
                           data-msg-required="Este campo es Requerido."
                           data-msg-minlength="Debes ingresar al menos 6 caracteres."
                           data-rule-required="true"
                           data-rule-minlength="6"
                            data-match="#password" 
                             data-match-error="las Contraseñas no coinciden"
                    >
                        </div>
                </div>

                <div class="col-xs-12 col-sm-4">
                    <p align="left" style="padding-top: 15px;"><strong>RIF Unidad Produci&oacute;n</strong></p>
                        <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="left" title='RIF'></i></span>
                          <input type="text" class="form-control input-sm" name="rif" id="rif" placeholder="Ingrese RIF" autofocus value="" autocomplete="off" maxlength="27"
                           data-container="body"
                           data-placement="top"
                           data-msg-required="Este campo es Requerido."
                           data-msg-minlength="Debes ingresar al menos 3 caracteres."
                           data-rule-required="true"
                           data-rule-minlength="3"
                    >
                        </div>
                </div>

              
                <div class="col-xs-12 col-sm-4">
                    <p align="left" style="padding-top: 15px;"><strong>Estado</strong></p>
                        <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-th-list" data-toggle="tooltip" data-placement="left" title='Estado'></i></span>
                          <select class="form-control input-sm"  id="codestado" name="codestado" required="" onchange="getmunicipio();"
                          data-msg-required="Este campo es Requerido."
                          >
                            <option value=0 disabled="" selected>Seleccione Estado</option>
                            <?php for($i=0;$i<$contestado;$i++){ ?>
                            <option value="<?php echo $respuesta['estados']['entidadRespuesta'][$i]['codestado'];?>"><?php echo $respuesta['estados']['entidadRespuesta'][$i]['nombre'];?></option>
                            <?php }?>        
                          </select>
                        </div>
                </div>

                <div class="col-xs-12 col-sm-4">
                        <p align="left" style="padding-top: 15px;"><strong>Municipio</strong></p>
                        <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-th-list" data-toggle="tooltip"  data-placement="left" title='Municipio'></i></span>
                          <select class="form-control input-sm"  id="codmunicipio" name="codmunicipio" required=""  onchange="getparroquia();"
                          data-msg-required="Este campo es Requerido."
                          >
                            <option value="0" disabled="disabled" selected="selected" >Seleccione Municipio</option>        
                          </select>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-4">
                        <p align="left" style="padding-top: 15px;"><strong>Parroquia</strong></p>
                        <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-th-list" data-toggle="tooltip" data-placement="left" title='Parroquia'></i></span>
                          <select class="form-control input-sm"  id="codparroquia" name="codparroquia" required="" onchange="libciudad();"
                          data-msg-required="Este campo es Requerido."
                          >
                           <option value="0" disabled="disabled" selected="selected" >Seleccione Parroquia</option>         
                         </select>
                       </div>
                     </div>

                <div class="col-xs-12 col-sm-4">
                      <p align="left" style="padding-top: 15px;"><strong>Ciudad</strong></p>
                      <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-th-list" data-toggle="tooltip" data-placement="left"  title='Ciudad'></i></span>
                        <select class="form-control input-sm"  id="codciudad" name="codciudad" required="" onchange=""
                        data-msg-required="Este campo es Requerido."
                        >
                          <option value="0" disabled="disabled" selected="selected" >Seleccione Ciudad</option>             
                        </select>
                      </div>
                    </div>  
                


                <div class="col-xs-12 col-sm-4">
                    <p align="left" style="padding-top: 15px;"><strong>Avenida/Calle</strong></p>
                        <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="left" title='Avenida'></i></span>
                          <input type="text" class="form-control input-sm" name="avenida" id="avenida" placeholder="Avenida/Calle" autofocus value="" autocomplete="off" maxlength="27"
                           data-container="body"
                           data-placement="top"
                           data-msg-required="Este campo es Requerido."
                           data-msg-minlength="Debes ingresar al menos 3 caracteres."
                           data-rule-required="true"
                           data-rule-minlength="3"
                    >
                        </div>
                </div>

                <div class="col-xs-12 col-sm-4">
                    <p align="left" style="padding-top: 15px;"><strong>Casa/Quinta/Hangar</strong></p>
                        <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="left" title=''></i></span>
                          <input type="text" class="form-control input-sm" name="casa" id="casa" placeholder="Casa/Quinta/Hangar" autofocus value="" autocomplete="off" maxlength="27"
                           data-container="body"
                           data-placement="top"
                           data-msg-required="Este campo es Requerido."
                           data-msg-minlength="Debes ingresar al menos 3 caracteres."
                           data-rule-required="true"
                           data-rule-minlength="3"
                    >
                        </div>
                </div>

                <div class="col-xs-12 col-sm-12">
                    <p align="left" style="padding-top: 15px;"><strong>Sector/Lugar de referencia</strong></p>
                        <div style="padding-bottom: 15px;  width: 100%;" class="input-group col-xs-12 col-md-4">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="left" title='Sector'></i></span>
                          <input type="text" class="form-control input-sm" name="sector" id="sector" placeholder="Sector o lugar de Referencia cercana a la ubicacion de la Unidad" autofocus value="" autocomplete="off" maxlength="27"
                           data-container="body"
                           data-placement="top"
                           data-msg-required="Este campo es Requerido."
                           data-msg-minlength="Debes ingresar al menos 3 caracteres."
                           data-rule-required="true"
                           data-rule-minlength="3"
                    >
                        </div>
                </div>

            </div>
                <p>
                    <button type="submit" class="btn btn-primary btn-md">Aceptar</button>
                    <button type="reset" class="btn btn-default btn-md">Limpiar</button>
                </p>
            </form>
        <div class="panel-footer">
            <span class="glyphicon glyphicon-info-sign color"></span> <b>Nota:</b> Al posicionar el mouse sobre los iconos del formulario, podra ver una breve descripci&oacute;n del campo
            </br>
        </div>

        </div>

<script type="text/javascript">
        $('document').ready(function () {

        $('#telefono').mask('(0999)999-99-99');  
            $("#LoginForm").validate({
            rules: {
               contrasena: { 
                 required: true,
                    minlength: 6,
                    maxlength: 10,
               } , 

                   confirmar_contra: { 
                    equalTo: "#contrasena",
                     minlength: 6,
                     maxlength: 10
               }
           },
             messages:{
                 confirmar_contra: { 
                         equalTo:"Las contraseñas deben ser Identicas"
                       },
             },
                showErrors: function(errorMap, errorList) {
                    //LIMPIAR LOS TOOLTIPS PARA LOS ELEMENTOS VÁLIDOS
                    $.each(this.validElements(), function (index, element) {
                        var $element = $(element);
                        $element.data("title", "") // BORRAR EL TITULO - NO HAY ERROR ASOCIADO
                            .removeClass("error")
                            .tooltip("destroy");
                    });

                    // CREAR LOS TOOLTIPS PARA ELEMENTOS INVÁLIDOS
                    $.each(errorList, function (index, error) {
                        var $element = $(error.element);
                        $element.tooltip("destroy") // DESTRUIR TODO TOOLTIP EXISTENTE PARA PODER CREAR UNO NUEVO
                            .data("title", error.message)
                            .addClass("error")
                            .tooltip(); // CREAR UN NUEVO TOOLTIP CON EL MENSAJE DE ERROR ASOCIADO AL TITULO AGREGADO
                    });
                }
            });
        });

function getmunicipio()
{
    var codestado = $('#codestado').val();
    //alert(codestado);
    //Guardamos el select de proceso
    var webservice = "getMunicipio";
    var pagina = 'public/';
    var method = 'Get';
    var url = '{{route("getConsumirAjax")}}';
    var arrcampos = ['codestado'];
    var arrvar = [codestado];
    var data = {webservice: webservice, pagina: pagina, method: method, campos: arrcampos, valores: arrvar};
        //alert(data);
                $.ajax({
                    type: "GET",
                    //headers: {'X-CSRF-TOKEN': token},
                    url: url,
                    data: data,
                    datatype: 'JSON',
                   success: function (text) {
                    //alert('hola');
                    //alert(JSON.stringify(text)); //hacer alert de un json
                        if (text.codrespuesta == 'COD_000') {
                            // Limpiamos el select
                            $("#codmunicipio").find('option').remove();
                            $("#codmunicipio").append('<option value="0" disabled>Seleccione Municipio</option>');
                            var $entidadRespuesta = text.entidadRespuesta
                            var $count = $entidadRespuesta.length;
                            for (j = 0; j < $count; j++) {
                                $("#codmunicipio").append('<option value="' + $entidadRespuesta[j].codmunicipio + '">' + $entidadRespuesta[j].nombre + '</option>');
                            }
                       $("#codmunicipio").prop('disabled', false);
                       $("#codmunicipio").val(0)
                       

                       $("#codparroquia").find('option').remove();
                      // $("#parroquia").prop('disabled', true);
                       $("#codparroquia").append('<option value="0" disabled>Seleccione Parroquia</option>');

                       $("#codparroquia").val(0)





                      // $("#codciudad").prop('disabled', true);

                       getciudad();
                        }
                    },
                    error: function (e) {
                        alert("No se puede obtener la data. " + JSON.stringify(e));
                    }
                });
  


}

function getparroquia()
{
    var codmunicipio = $('#codmunicipio').val();
    //alert(codestado);
    //Guardamos el select de proceso
    var webservice = "getParroquia";
    var pagina = 'public/';
    var method = 'Get';
    var url = '{{route("getConsumirAjax")}}';
    var arrcampos = ['codmunicipio'];
    var arrvar = [codmunicipio];
    var data = {webservice: webservice, pagina: pagina, method: method, campos: arrcampos, valores: arrvar};
        //console.log(data);
                $.ajax({
                    type: "GET",
                    //headers: {'X-CSRF-TOKEN': token},
                    url: url,
                    data: data,
                    datatype: 'JSON',
                   success: function (text) {
//                      alert('hola');
//                      alert(JSON.stringify(text)); //hacer alert de un json
                        if (text.codrespuesta == 'COD_000') {
                            // Limpiamos el select
                            $("#codparroquia").find('option').remove();
                            $("#codparroquia").append('<option value="0" disabled >Seleccione parroquia</option>');
                            var $entidadRespuesta = text.entidadRespuesta
                            var $count = $entidadRespuesta.length;
                            for (j = 0; j < $count; j++) {
                                $("#codparroquia").append('<option value="' + $entidadRespuesta[j].codparroquia + '">' + $entidadRespuesta[j].nombre + '</option>');
                            }
                       $("#codparroquia").prop('disabled', false);
                       $("#codparroquia").val(0)

                       $("#codciudad").prop('disabled', true);
                        }
                    },
                    error: function (e) {
                        alert("No se puede obtener la data. " + JSON.stringify(e));
                    }
                });
  


}


function getciudad()
{
              var codestado = $('#codestado').val();
              var webservice = "getCiudad";
              var pagina = 'public/';
              var method = 'Get';
              var url = '{{route("getConsumirAjax")}}';
              var arrcampos = ['codestado'];
              var arrvar = [codestado];
              var data = {webservice: webservice, pagina: pagina, method: method, campos: arrcampos, valores: arrvar};
              $.ajax({
                    type: "GET",
                    //headers: {'X-CSRF-TOKEN': token},
                    url: url,
                    data: data,
                    datatype: 'JSON',
                   success: function (text) {
//                        alert('hola');
//                        alert(JSON.stringify(text)); //hacer alert de un json
                        if (text.codrespuesta == 'COD_000') {
                            // Limpiamos el select
                            $("#codciudad").find('option').remove();
                            $("#codciudad").append('<option value="0" disabled>Seleccione ciudad</option>');
                            var $entidadRespuesta = text.entidadRespuesta
                            var $count = $entidadRespuesta.length;
                            for (j = 0; j < $count; j++) {
                                $("#codciudad").append('<option value="' + $entidadRespuesta[j].codciudad + '">' + $entidadRespuesta[j].nombre + '</option>');
                            }
                      // $("#codciudad").prop('disabled', false);
                       $("#codciudad").val(0)
                        }
                    },
                    error: function (e) {
                        alert("No se puede obtener la data. " + JSON.stringify(e));
                    }
                });        
}

function libciudad()
{
  $("#codciudad").prop('disabled', false);
  $("#codciudad").val(0);
}



    </script>
@endsection

