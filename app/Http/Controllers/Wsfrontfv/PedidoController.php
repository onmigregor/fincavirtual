<?php

/************************************************
 *    Creado por Omar Ramirez
 *    Fecha: 09/03/2017
 *    Clase: ConsultaController.php
 ************************************************/

namespace App\Http\Controllers\Wsfrontfv;

use View;
use Input;
use Session;
use Response;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ConsumirWS;
//use App\Http\Controllers\LoginController;

class PedidoController extends Controller
{

    var $consumirws;
    var $rutaSession;
    var $prefijoActual;
    //var $RegistroController;

    public function __construct()
    {
        $this->consumirws = new ConsumirWS();
    }

    public function pedido($accion="n", $pedido=null)
    {     
        if($accion=='n')
        {
           $detalle_pedido =   array       (
                                        'parametros'    =>  null,
                                        'accion'        =>  'n',
                                        'rol'           =>  'RL01',
                                        'editar'        =>   true, 
                                        );
        }
        elseif ($accion=='e'AND  $pedido!=null ) 
        {
            
            $pedidoWS = 'getPedido';
            $parametros= array('pedido' => $pedido);
            $detalle_pedido =   array       (
                                        'parametros'    =>       $this->consumirws->consumirPorGet($pedidoWS,$parametros),
                                        'accion'        =>       'e',
                                        //'rol'           =>       $rol,
                                        'rol'           =>       Session::get('rol'),
                                        'editar'        =>       true
                                        );
            $detalle_pedido['editar']           =$this->editar(Session::get('rol'),$detalle_pedido['parametros' ]['entidadRespuesta']['estatus_actual']);
        }
            $detalle_pedido['listar_estatus']   =$this->listar_estatus(Session::get('rol'));


        return view('fincavirtual/pedido')->with('respuesta', $detalle_pedido);

    }

    public function regpedido(Request $request)
    {
        $params=$request->all();

        if ($params['accion']=='n') 
        {
            $pedidoWS = 'RegPedido';
        }
        elseif ($params['accion']=='e') 
        {
            $pedidoWS = 'EditPedido';
            if (Session::get('rol')=='RL03') 
            {
                $pedidoWS='Regcompras';
            }

        }
        $parametros= $params;
        $detalle_pedido = $this->consumirws->consumirPorPost($pedidoWS,$parametros);
       //dump($detalle_pedido);
       //die;

        return view('fincavirtual/principal');
    }

    public function listar_pedido(Request $request)
    {
        
        if (Session::get('rol')=='RL03')  
        {   
            $estatusWs = 'cambiarestatus';
            $listar_pedido = $this->consumirws->consumirPorPost($estatusWs,null);
        }

        $pedidoWS = 'getPedido';
        $parametros=array(  
                        'rol'    => Session::get('rol'),
                        'pedido' => null,
                        );
        $listar_pedido = $this->consumirws->consumirPorGet($pedidoWS,$parametros);
        return view('fincavirtual/listar_pedido')->with('respuesta', $listar_pedido);
        
    }

    public function pedidos_aprob()
    {
        if (Session::get('rol')=='RL03')  
        {   
        $pedidoWS = 'getAprobados';
        $parametros=null;
        $listar_pedido = $this->consumirws->consumirPorGet($pedidoWS,$parametros);
        //dd($listar_pedido);
        return view('fincavirtual/pedidos_aprob')->with('respuesta', $listar_pedido);
        }   
    }





    private function editar($rol,$estatus)
    {

        if (Session::get('rol')=='RL01') {
            
  
            switch ($estatus) {
                case 1:
                        $editar= FALSE ;
                    break;
                case 2:
                        $editar= FALSE ;
                    break;
                case 3:
                        $editar= FALSE ;
                    break;
                case 4:
                        $editar= FALSE ;
                    break;
                case 5:
                        $editar= FALSE ;
                    break;
                case 6:
                        $editar= FALSE ;
                    break;
                case 7:
                        $editar= TRUE;
                    break;
                
                default:
                        $editar=  FALSE;
                    break;
            }
        }
        if (Session::get('rol')=='RL02') {
       
            switch ($estatus) {
                case 1:
                        $editar= TRUE;
                    break;
                case 2:
                        $editar=  FALSE;
                    break;
                case 3:
                        $editar=  FALSE;
                    break;
                case 4:
                        $editar=  FALSE;
                    break;
                case 5:
                        $editar=  FALSE;
                    break;
                case 6:
                        $editar=  FALSE;
                    break;
                case 7:
                        $editar=  FALSE;
                    break;
                
                default:
                        $editar=  FALSE;
                    break;
            }
        }
        if (Session::get('rol')=='RL03') {

            switch ($estatus) {
                case 1:
                        $editar=  FALSE;
                    break;
                case 2:
                        $editar=  FALSE;
                    break;
                case 3:
                        $editar=  FALSE;
                    break;
                case 4:
                        $editar=  FALSE;
                    break;
                case 5:
                        $editar=  FALSE;
                    break;
                case 6:
                        $editar=  FALSE;
                    break;
                case 7:
                        $editar=  FALSE;
                    break;
                
                default:
                        $editar=  FALSE;
                    break;
            }

        }
    
      return $editar;  
    }

    private function listar_estatus($rol)
    {
        $listar_estatus=$this->consumirws->consumirPorPost('getTipoEstatus',array('rol' => $rol));
        $listar_estatus=$listar_estatus['entidadRespuesta'];
        return $listar_estatus;
    }
}
?>