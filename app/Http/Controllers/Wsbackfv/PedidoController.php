<?php
/************************************************
 *    Creado por Omar Ramirez
 *    Fecha: 21/12/2016
 *    Clase: EstadoController.php
 ************************************************/

namespace App\Http\Controllers\Wsbackfv;


use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Wsgeneric\Dal\GenericDAL;
use App\Wsgeneric\Model\EntityResponse;
use App\Wsfincavirtual\Dal\Repre_LegalDAL;
use App\Wsfincavirtual\Dal\PedidoDAL;
use App\Wsfincavirtual\Dal\EstatusDAL;
////////////////// añadir1
use Validator;

class PedidoController extends Controller
{
    private $GenericDAL;
    private $EntityResponse;
    private $Repre_LegalDAL;
    private $PedidoDAL;
    private $DB;
///////////////////////////////// añadir 2
    public function __construct()
    {
        $this->GenericDAL       = new GenericDAL();
        $this->EntityResponse   = new EntityResponse();
        $this->Repre_LegalDAL   = new Repre_LegalDAL();
        $this->PedidoDAL        = new PedidoDAL();
        $this->EstatusDAL       = new EstatusDAL();
        $this->DB = "bd_fincavirtual";
    }
////////////////////////////////////añadir 3
    private function setMensaje($codigoMsg)
    {
        $Msg = $this->GenericDAL->getMessage($codigoMsg, $this->DB);
        $this->EntityResponse = $Msg[0];
    }

    public function RegPedido(Request $request)
    {
        
        $params = $request->all();     
                $reglas = Validator::make($request->all(),
                    [
                        'cod_tipo_rubro' => 'required|Array',
                        'cod_producto'   => 'required|Array',
                        'cantidad'   => 'required|Array',
                    ]);
        if ($reglas->fails()) 
        {
            // CODE_002: LOS PARAMETROS INGRESADOS NO SON CORRECTOS (y muestra ademas los errores de la validación)
            $this->setMensaje("CODE_002");
            $this->EntityResponse->entidadRespuesta = $reglas->errors();
        } 
        else 
        {
            $k = count($params['cod_producto']);

     
          //  dump($params);
            $rubro=  array();

            for ($i=0; $i <$k ; $i++) 
            { 
                $rubro['producto'][$i]=array(
                                    'cod_tipo_rubro'    => $params['cod_tipo_rubro'][$i],
                                    'cod_producto'      => $params['cod_producto'][$i], 
                                    'cantidad'          => $params['cantidad'][$i],
                                    );
            }

                $producto = array(
                                    'codpedido'         => "PED".$this->numpedido(),
                                     'rubro'            => json_encode($rubro),
                                     'estatus_actual'   => 1,
                                );
                 
            $result=$this->PedidoDAL->RegPedido($producto);

                if ($producto['codpedido']!=$result) 
                {
                   
                }
                else
                {
                    $estatus = array(
                                        'cod_pedido'        => $result,
                                        'cod_tipo_estatus'  => 1,
                                        'cod_usuario'       => 'US001',
                                        //'fecha_registro'    => '';
                                        'observaciones'     => NULL,
                                    );
                    $Pgestatus=$this->EstatusDAL->NewEstatus($estatus);
                }
                if ($producto['codpedido']!=$result) 
                {
                }
                else
                {
                    $this->setMensaje("COD_001");
                    $this->EntityResponse->entidadRespuesta = $result;
                }

        }
        return response()->json($this->EntityResponse);
    }


    public function EditPedido(Request $request)
    {
         $params = $request->all();     
         
                $reglas = Validator::make($request->all(),
                    [
                        'cod_tipo_rubro' => 'required|Array',
                        'cod_producto'   => 'required|Array',
                        'cantidad'       => 'required|Array',
                        'accion'         => 'required|alpha|size:1',
                        'cod_pedido'     => 'required|alpha_num'
                    ]);
        if ($reglas->fails()) 
        {
            // CODE_002: LOS PARAMETROS INGRESADOS NO SON CORRECTOS (y muestra ademas los errores de la validación)
            $this->setMensaje("CODE_002");
            $this->EntityResponse->entidadRespuesta = $reglas->errors();
        } 
        else 
        {
            $k = count($params['cod_producto']);

     
            $rubro=  array();

            for ($i=0; $i <$k ; $i++) 
            { 
                $rubro['producto'][$i]=array(
                                    'cod_tipo_rubro'    => $params['cod_tipo_rubro'][$i],
                                    'cod_producto'      => $params['cod_producto'][$i], 
                                    'cantidad'          => $params['cantidad'][$i],
                                    );
            }
            $producto = array
                            (
                                'codpedido'       => $params['cod_pedido'], 
                                'rubro'           => json_encode($rubro),
                                'estatus_actual'  => $params['cod_estatus'],
                               // 'visto_produccion'=> $this->visto_produccion($params['cod_estatus']),
                                );        

            $result=$this->PedidoDAL->EditPedido($producto);

           // dd($params);

            $estatus = array(
                                        'cod_pedido'        => $params['cod_pedido'],
                                        'cod_tipo_estatus'  => $params['cod_estatus'],
                                        'cod_usuario'       => 'US001',
                                        'observaciones'     => $params['observaciones'], 
                                        //'fecha_registro'    => '';
                                    );


            $Pgestatus=$this->EstatusDAL->NewEstatus($estatus);

                   //dd($result);
                if ($producto['codpedido']!=$result) 
                {
                }
                else
                {

                    //dd($result);
                    $this->setMensaje("COD_001");
                    $this->EntityResponse->entidadRespuesta = $result;
                }

        }
        return response()->json($this->EntityResponse);
        
    }




    public function getPedido(Request $request)
    {       
        $params = $request->all();
                $reglas = Validator::make($request->all(),
                    [
                        'pedido'          => 'string'
                    ]);

        if ($reglas->fails()) 
        {
            // CODE_002: LOS PARAMETROS INGRESADOS NO SON CORRECTOS (y muestra ademas los errores de la validación)
            $this->setMensaje("CODE_002");
            $this->EntityResponse->entidadRespuesta = $reglas->errors();
        } 
        else 
        {

            $result = $this->PedidoDAL->getPedido($params);
            
            if (count($result) > 0) {
                    if (isset($result[0]->descripcion)) 
                    {   
                        //dd("dsfdsf");
                        $result=$result[0];
                        if (!empty($params['pedido'])&&$result->visto_produccion==0) 
                        {
                            $this->PedidoDAL->cambiarvisto($params['pedido']);
                        }
                        $result->descripcion=json_decode($result->descripcion);
                        $this->setMensaje("COD_000");
                        $this->EntityResponse->entidadRespuesta = $result;
                    }
                    else 
                    {
                        $this->setMensaje("COD_000");
                        $this->EntityResponse->entidadRespuesta = $result;
                    }
            } 
            else 
            {
                $this->setMensaje("COD_002");
                $this->EntityResponse->entidadRespuesta = 'NO HAY PEDIDOS PARA MOSTRAR';
            }
        }
        return response()->json($this->EntityResponse);
    }

    public function Regcompras(Request $request)
    {       
        $params = $request->all();



                $reglas = Validator::make($request->all(),
                    [
                        'cod_pedido'          => 'required|string',
                        'cod_estatus'         => 'required|integer'
                    ]);

        if ($reglas->fails()) 
        {
            // CODE_002: LOS PARAMETROS INGRESADOS NO SON CORRECTOS (y muestra ademas los errores de la validación)
            $this->setMensaje("CODE_002");
            $this->EntityResponse->entidadRespuesta = $reglas->errors();
        } 
        else 
        {   

            $producto = array   (
                                'codpedido'       => $params['cod_pedido'], 
                                'estatus_actual'  => $params['cod_estatus'],
                                ); 

            $result = $this->PedidoDAL->Regcompras($producto);

            $estatus = array(
                                        'cod_pedido'        => $params['cod_pedido'],
                                        'cod_tipo_estatus'  => $params['cod_estatus'],
                                        'cod_usuario'       => 'US001',
                                        'observaciones'     => $params['observaciones'], 
                                        //'fecha_registro'    => '';
                                    );


            $Pgestatus=$this->EstatusDAL->NewEstatus($estatus);
            //dump($result);
            
            if (count($result) > 0) 
            {
                $this->setMensaje("COD_001");
                //$this->EntityResponse->entidadRespuesta = $result;
            } 
            else 
            {
                $this->setMensaje("COD_002");
                $this->EntityResponse->entidadRespuesta = 'NO HAY PEDIDOS PARA MOSTRAR';
            }
        }
        return response()->json($this->EntityResponse);
    }

     public function getAprobados(Request $request)
    {       
        $params = $request->only('pedido');

                $reglas = Validator::make($request->all(),
                    [
                        'pedido'          => 'string'
                    ]);

        if ($reglas->fails()) 
        {
            // CODE_002: LOS PARAMETROS INGRESADOS NO SON CORRECTOS (y muestra ademas los errores de la validación)
            $this->setMensaje("CODE_002");
            $this->EntityResponse->entidadRespuesta = $reglas->errors();
        } 
        else 
        {

            $result = $this->PedidoDAL->getAprobados($params['pedido']);
            
            
            if (count($result) > 0) 
            {
                    if (isset($result[0]->descripcion)) 
                    {
                        $result=$result[0];
                        if (!empty($params['pedido'])&&$result->visto_produccion==0) 
                        {
                            $this->PedidoDAL->cambiarvisto($params['pedido']);
                        }
                        $result->descripcion=json_decode($result->descripcion);
                        $this->setMensaje("COD_000");
                        $this->EntityResponse->entidadRespuesta = $result;
                    }
                    else 
                    {
                        $this->setMensaje("COD_000");
                        $this->EntityResponse->entidadRespuesta = $result;
                    }
            }
            else 
            {
                $this->setMensaje("COD_002");
                $this->EntityResponse->entidadRespuesta = 'NO HAY PEDIDOS APROBADOS PARA MOSTRAR';
            }
            return response()->json($this->EntityResponse);
        }
    }

    private function numpedido()
    {
        $random=mt_rand(1000000,9999999);
        if (($random%3)!=0) 
        {             
            $this->numpedido();
         }
        return $random;
    }

    private function visto_produccion($estatus)
    {
        if ($estatus==1) 
        {
            return false;
        }
        else
        {
            return true;
        }

    }

}