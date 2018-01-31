
@extends('layouts/master')
@section('content')


<?php
         

  //dump($respuesta['entidadRespuesta']);
if ($respuesta['codrespuesta']=='COD_001' ) {

$descripcion=$respuesta['entidadRespuesta'];

?>

            <div class="col-xs-12 col-sm-6 col-sm-offset-3" style="margin-top: 150 px;">
                <div class="alert alert-success" role="alert"><p align="center">{{ $descripcion}}</p></div>
            </div>
       

<?php
}else

{
?>

           
                    <div class="col-xs-12 col-sm-6 col-sm-offset-3" style="margin-top: 150 px;">
                        <div class="alert alert-danger" role="alert">
                            <p align="center"><strong> {{$respuesta['mensaje']}}</strong></p>
            @foreach ($respuesta['entidadRespuesta'] as $key => $mensaje) 
 
                            <p align="center">{{$mensaje[0]}}</p>
            @endforeach
                        </div>
                    </div>
             

<?php    


}
?>

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

