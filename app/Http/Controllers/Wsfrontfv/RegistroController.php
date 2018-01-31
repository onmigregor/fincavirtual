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

class RegistroController extends Controller
{

    var $consumirws;
    var $rutaSession;
    var $prefijoActual;
    //var $RegistroController;

    public function __construct()
    {
        $this->consumirws = new ConsumirWS();
    }

    public function Registro()
    {
            $codestado="todos";
            $codcargo="todos";
            $estadows = 'getEstado';
            $cargows = 'getCargo';
            $parametros_estados = array('codestado' => $codestado,);
            $parametros_cargo   = array('codcargo' => $codcargo,);
            $detalle_estado = $this->consumirws->consumirPorGet($estadows, $parametros_estados);
            $detalle_cargo  = $this->consumirws->consumirPorGet($cargows, $parametros_cargo);
            $parametros = array (
                                    'estados' => $detalle_estado,
                                    'cargos' => $detalle_cargo 
                                );
            
            return view('fincavirtual/Registro')->with('respuesta', $parametros);
    }



    public function registro_unidad()
    {
            $codestado="todos";
            $codcargo="todos";
            $estadows = 'getEstado';
           // $cargows = 'getCargo';
            $parametros_estados = array('codestado' => $codestado,);
           // $parametros_cargo   = array('codcargo' => $codcargo,);
            $detalle_estado = $this->consumirws->consumirPorGet($estadows, $parametros_estados);
           // $detalle_cargo  = $this->consumirws->consumirPorGet($cargows, $parametros_cargo);
            $parametros = array (
                                    'estados' => $detalle_estado,
                                   // 'cargos' => $detalle_cargo 
                                );      
        return view('fincavirtual/registro_unidad')->with('respuesta', $parametros);
    }

    public function post_registro_unidad(Request $request)
    {
        $parametros=$request->all();
        $parametros['tipo_registro']='unidad';
        $registrows = 'guardar_usuario';
        $respuesta = $this->consumirws->consumirPorPost($registrows, $parametros);

      
        return view('fincavirtual/post_registro')->with('respuesta', $respuesta);
    }

}
?>