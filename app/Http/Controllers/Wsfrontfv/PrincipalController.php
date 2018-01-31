<?php

/************************************************
 *    Creado por Omar Ramirez
 *    Fecha: 09/03/2017
 *    Clase: ConsultaController.php
 ************************************************/

namespace App\Http\Controllers\Wsfrontfv;

use Curl;
use View;
use Input;
use Session;
use Response;
use File;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ConsumirWS;
//use App\Http\Controllers\LoginController;

class PrincipalController extends Controller
{

    var $consumirws;
    var $rutaSession;
    var $prefijoActual;
    //var $LoginController;

    public function __construct()
    {
        $this->consumirws = new ConsumirWS();
    }

    public function principal()
    {

        //$valijaws = 'getZoomTrack';
        //$parametros_valija = array('tipo_busqueda' => 1, 'codigo'=> 2147483647, 'trackingDHL'=> 1);
        //$detalle_trackingDHL = $this->consumirws->consumirPorGet($valijaws, $parametros_valija, $url = 'customs.url_baaszoom', "canguroazul/");
        //dump($detalle_trackingDHL);
        //dump("hola");
        return view('fincavirtual/principal');
        //return view('errors/nologin',compact('ofic','token','sesscodofi'));
    }
}
?>