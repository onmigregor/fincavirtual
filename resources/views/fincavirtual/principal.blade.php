
@extends('layouts/master')
@section('content')


<?php
dump(Session::get('rol'));
?>
    <div class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="panel panel-primary" style="width:100%; text-align: center; margin-top: 55px;">

        <div class="panel-heading"><strong><h3 class="panel-title" style="text-transform: uppercase;"><span class="glyphicon glyphicon-lock"></span> MENU PRINCIPAL</h3></strong></div>
        <div class="panel-body">

            <?php

            if(Session::get('rol')=='RL01')
            {

            ?>
            <button type="button" class="btn btn-success btn-lg btn-block"  onClick="window.location.href='{{ url('pedido/n/') }}  '">REALIZAR NUEVO PEDIDO</button>
            <?php
            }
            ?>


            <button type="button" class="btn btn-warning btn-lg btn-block" onClick="window.location.href='{{ url('listar_pedido') }}  '">LISTAR PEDIDOS REALIZADOS</button>
            <?php

            if(Session::get('rol')=='RL03')
            {    
            ?>
            <button type="button" class="btn btn-success btn-lg btn-block"  onClick="window.location.href='{{ url('pedidos_aprob') }}  '">DESPACHAR PEDIDOS A PROVEEDORES</button>
            <?php
            }
            ?>




          
        </div>
        <div class="panel-footer">
            <span class="glyphicon glyphicon-info-sign color"></span> <b>Nota:</b> Al posicionar el mouse sobre los iconos del formulario, podra ver una breve descripci&oacute;n del campo
            </br>
        </div>

    <div class="col-sm-4 col-md-4"></div>

    <script type="text/javascript">

    </script>
@endsection

