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

class Listar_empresasController extends Controller
{

    var $consumirws;
    var $rutaSession;
    var $prefijoActual;
    //var $LoginController;

    public function __construct()
    {
        $this->consumirws = new ConsumirWS();
    }

    public function Listar()
    {
       // $codestado="todos";
        $estadows = 'getempresas';
        $parametros_empresa = null;
        $detalle_empresa = $this->consumirws->consumirPorGet($estadows, $parametros_empresa);
        return view('fincavirtual/listar_empresas')->with('respuesta', $detalle_empresa);;
        
    }
}
?>