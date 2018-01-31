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

class RegEmpresaController extends Controller
{

    var $consumirws;
    var $rutaSession;
    var $prefijoActual;
    //var $RegistroController;

    public function __construct()
    {
        $this->consumirws = new ConsumirWS();
    }

    public function RegEmpresa(Request $request)
    {   
        $params=$request->all();
        $empresaWS = 'postRegistro';
        $parametros_registro = $params;
        $detalle_estado = $this->consumirws->consumirPorPost($empresaWS, $parametros_registro);
        dd($detalle_estado);
        return view('fincavirtual/Registro')->with('respuesta', $detalle_estado);
    }
}
?>