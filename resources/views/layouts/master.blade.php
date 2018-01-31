<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1,maximum-scale=1,User-scalable=no">
    <link rel="shortcut icon" type="image/x-icon" href="{!! asset('favicon.ico') !!}">
    <title>Finca Virtual</title>
    <!--LLAMADO DE CSS DE BOOSTRAP-->
  <link href="{!! asset('/bootstrap_3_3_6/css/bootstrap.css')  !!}" rel="stylesheet">
    <!--<link href="{!! asset('/bootstrap_3_3_6/css/bootstrap.min.css')  !!}" rel="stylesheet">-->
   <!--LLAMADO DE CSS DE BOOSTRAP SUBMENU-->
    <link href="{!! asset('/css/bootstrap-submenu.css')  !!}" rel="stylesheet">
  <link href="{!! asset('/css/bootstrap-submenu.min.css')  !!}" rel="stylesheet">
  <link href="{!! asset('/css/bootstrap-multiselect.css')  !!}" rel="stylesheet">
  
    <!--LLAMADO DE CSS DE BOOSTRAP DATEPICKER TIME-->
    <link href="{!! asset('/bootstrap_3_3_6/datepicker/bootstrap-datetimepicker.css')  !!}" rel="stylesheet">
    <link href="{!! asset('/css/zoom_style.css')  !!}" rel="stylesheet">
  <link href="{!! asset('css/jquery-ui.css')  !!}" rel="stylesheet">
  <link href="{!! asset('css/bootstrap-select.min.css')  !!}" rel="stylesheet">
  
        <script type="text/javascript" src="{!! URL::asset('/js/jquery-2.2.3.js')  !!}"></script>
        <script type="text/javascript" src="{!! URL::asset('/js/jquery.mask.js')  !!}"></script>
  <script type="text/javascript" src="{!! URL::asset('/js/jquery-ui.js')  !!}"></script>
  
    {{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>--}}
    <!-- JS para PAGINADOS -->
  <script type="text/javascript" src="{!! URL::asset('/js/jquery.bootpag.js')  !!}"></script>
  <!-- FIN JS para PAGINADOS -->
  <script type="text/javascript"> 
    $('document').ready(function(){
      setTimeout(function() {$("#alert").fadeOut(6000);},6000);
      $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
      });
    });
  </script>
    <script>
        window.onload=Reloj;
        var Hoy = new Date("<?php echo date("d M Y H:i:s"); ?>");
        function Reloj(){
            Hora = Hoy.getHours();
            Minutos = Hoy.getMinutes();
            Segundos = Hoy.getSeconds();
            if (Hora<10) Hora = "0" + Hora;
            if (Minutos<10) Minutos = "0" + Minutos;
            if (Segundos<10) Segundos = "0" + Segundos;
            var Dia = new Array("Domingo", "Lunes", "Martes", "Mi\u00E9rcoles", "Jueves", "Viernes", "S\u00E1bado", "Domingo");
            var Mes = new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            var Anio = Hoy.getFullYear();
            var Fecha = "" + Dia[Hoy.getDay()] + ", " + Hoy.getDate() + " de " + Mes[Hoy.getMonth()] + " de " + Anio + " ";
            var Inicio, Script, Final, Total;
            //Inicio = "<p class='reloj'><span class='glyphicon glyphicon-hourglass'></span> ";
            Inicio = "<b><span class='glyphicon glyphicon-hourglass'></span> ";
            Script = Fecha + Hora + ":" + Minutos + ":" + Segundos;
            //Final = "</p>";
            Final = "</b>";
            Total = Inicio + Script + Final;
            //Total = Script;
            document.getElementById('Fecha_Reloj').innerHTML = Total;
            Hoy.setSeconds(Hoy.getSeconds() +1);
            setTimeout("Reloj()",1000);
        }
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
</head>
<body> 
  <?php $prefix=Session::get('conexion'); 
//dump(Session::all());
  //echo "estoy en master blade";
  ?>
    <nav class="navbar navbar-default navbar-fixed-top header_navbar solo-laravel">
        <div class="container-fluid">
            <div class="navbar-header navbar-logo">
  <!--          <a href="{{ url($prefix.'/login') }}"><img src="{!! asset('img/logozoom.png')  !!}"  class="visible-md visible-lg hidden" /></a>
                <a href="{{ url($prefix.'/login') }}"><img src="{!! asset('img/logozoom.png')  !!}"  class="navbar-brand hidden visible-xs visible-sm" /></a> -->
            </div>
             <ul class="nav navbar-right navbar-reloj">
                 <p id="Fecha_Reloj" style="color:#0066CC;"></p>
                <a href="{{ url('logout') }}">
                    <strong><p id="logout" style="color:#0066CC;">{{ Session::has('usuario') ? 'Salir()' :''}}</p></strong>
                </a> 
             </ul>
        </div>
    </nav>


    <div class="row navbar-menu-log">
        <div class="col-xs-12 col-lg-12 col-sm-12 col-md-12">

        </div>
    </div>
  <div class="row">
    <!--Luegar donde se mostraran los mensajes que vengan del controlador-->
    <!--Estos mensajes pueden ser de-->
    <!--ERROR::danger-->
    <!--ABVERTENCIA::warning-->
    <!--EXITO::success-->
    <!--INFORMACION::info-->
        <div id="alert" style="margin-top: {{ Session::has('entidadRespuesta') ? '-21px' : '-1px' }}">
            
        </div>
  </div>
    <div class="container">
        @yield('content')
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center;">
        <nav id="footer" class="navbar navbar-fixed-bottom solo-laravel">
            <!--si existe usuario logueado muestra el menu inferior-->
        <div id="menu_abajo">
        </div>
            <div  id="footer">
                   <p class="footer">Copyright &copy; {{ date("Y") }}<br/> Todos los derechos reservados </p>
            </div>
        </nav>
    </div>


    <script type="text/javascript" src="{!! URL::asset('/js/jquery.validate.js') !!}"></script>
    <script type="text/javascript" src="{!! URL::asset('bootstrap_3_3_6/validate/jquery-validate.bootstrap-tooltip.min.js')  !!}"></script>
    <!--LLAMADO DE JS DE BOOSTRAP DATEPICKER TIME-->
    <script type="text/javascript" src="{!! URL::asset('/bootstrap_3_3_6/datepicker/moment.js') !!}"></script>
    <script type="text/javascript" src="{!! URL::asset('/bootstrap_3_3_6/datepicker/bootstrap-datetimepicker.min.js') !!}"></script>

    <!--LLAMADO DE JS DE BOOSTRAP-->
    <script type="text/javascript" src="{!! URL::asset('/bootstrap_3_3_6/js/bootstrap-hover-dropdown.min.js')  !!}"></script>
    <script type="text/javascript" src="{!! URL::asset('/bootstrap_3_3_6/js/bootstrap.min.js')  !!}"></script>
    {{--<script type="text/javascript" src="{!! URL::asset('/js/jquery.ui.autocomplete.html.jss')  !!}"></script>--}}
    {{--<script type="text/javascript" src="{!! URL::asset('/bootstrap_3_3_6/js/tooltip.js')  !!}"></script>--}}

    <script type="text/javascript" src="{!! URL::asset('/js/bootstrap-submenu.js') !!}"></script>
    <script type="text/javascript" src="{!! URL::asset('/js/bootstrap-submenu.min.js') !!}"></script>
    <script type="text/javascript" src="{!! URL::asset('/js/bootstrap-multiselect.js') !!}"></script>
    <script type="text/javascript" src="{!! URL::asset('/js/bootstrap-select.min.js') !!}"></script>
    @yield('script')

</body>
</html>