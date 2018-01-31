
@extends('layouts/master')
@section('content')


<?php



?>
    <div class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="panel panel-primary" style="width:100%; text-align: center; margin-top: 55px;">

        <div class="panel-heading"><strong><h3 class="panel-title" style="text-transform: uppercase;"><span class="glyphicon glyphicon-lock"></span> Inicio de Sesi&oacute;n</h3></strong></div>
        <div class="panel-body">


            <form role="form" action="{{ url('postlogin') }}" id="LoginForm" name="LoginForm" method="POST">
                <div style="margin-bottom: 25px; width: 100%;" class="input-group col-xs-12 col-md-4">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="left" title='Nombre de Usuario'></i></span>
                    <input type="text" class="form-control" name="login" id="login" placeholder="Ingrese Nombre de Usuario" autofocus value="" autocomplete="off" maxlength="27"
                           data-container="body"
                           data-placement="right"
                           data-msg-required="Este campo es Requerido."
                           data-msg-minlength="Debes ingresar al menos 3 caracteres."
                           data-rule-required="true"
                           data-rule-minlength="3"
                    >
                </div>
                <div style="margin-bottom: 25px; width: 100%;" class="input-group col-xs-12">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock" data-toggle="tooltip" data-placement="left" title='Contraseña'></i></span>
                    <input type="password" class="form-control" id="claveenc" name="claveenc" placeholder="Ingrese Contraseña" maxlength="20" value=""
                           data-container="body"
                           data-placement="right"
                           data-msg-required="Este campo es Requerido."
                           data-msg-minlength="La contraseña debe tener 8 caracteres."
                           data-msg-maxlength="La contraseña debe tener 8 caracteres."
                           data-rule-required="true"
                           data-rule-minlength="3"
                           data-rule-maxlength="20"
                    >
                </div>
                <div style="margin-bottom: 25px; text-align: center;" class="input-group col-xs-12">
                    <img src="" data-toggle="tooltip" data-placement="left" onclick="" title="Código de Validación"/>
                    <h5>
                        <p class="text-info">
                            <b>
                                <i class="glyphicon glyphicon-info-sign"></i>
                                Hacer clic en la Imagen para actualizar el Código de Validación.
                            </b>
                        </p>
                    </h5>
                </div>
                <p>
                    <button type="submit" class="btn btn-primary btn-md">Aceptar</button>
                    <button type="reset" class="btn btn-default btn-md">Limpiar</button>
                </p>
            </form>
        </div>
        <div class="panel-footer">
            <span class="glyphicon glyphicon-info-sign color"></span> <b>Nota:</b> Al posicionar el mouse sobre los iconos del formulario, podra ver una breve descripci&oacute;n del campo
            </br>
        </div>
    </div>
        <a href="{{'Registro'}}"><strong>REGISTRO NUEVO USUARIO</strong></a>
        <a style="float: right" href="{{'registro_unidad'}}"><strong>REGISTRAR UNIDAD</strong></a>
    </div>
    <div class="col-sm-4 col-md-4"></div>

    <script type="text/javascript">
        $('document').ready(function () {
            $("#LoginForm").validate({
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
    </script>
@endsection

