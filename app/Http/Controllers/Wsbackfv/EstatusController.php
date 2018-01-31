<?php
/************************************************
 *    Creado por Omar Ramirez
 *    Fecha: 21/12/2016
 *    Clase: EstatusController.php
 ************************************************/

namespace App\Http\Controllers\Wsbackfv;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Wsgeneric\Dal\GenericDAL;
use App\Wsgeneric\Model\EntityResponse;
use App\Wsfincavirtual\Dal\EstatusDAL;
use App\Wsfincavirtual\Dal\PedidoDAL;

use Validator;

class EstatusController extends Controller
{
    private $GenericDAL;
    private $EntityResponse;
    private $EstatusDAL;
    private $PedidoDAL;
    private $DB;

    public function __construct()
    {
        $this->GenericDAL = new GenericDAL();
        $this->EntityResponse = new EntityResponse();
        $this->EstatusDAL = new EstatusDAL();
        $this->PedidoDAL = new PedidoDAL();
        $this->DB = "bd_fincavirtual";
    }

    private function setMensaje($codigoMsg)
    {
        $Msg = $this->GenericDAL->getMessage($codigoMsg, $this->DB);
        $this->EntityResponse = $Msg[0];
    }

    public function cambiarestatus(Request $request)
    {

        $pedido=$this->PedidoDAL->cambiarestatus();

        if (count($pedido)>0)
        {
            foreach ($pedido as $key => $codpedido) 
            {

                $estatus = array(
                                    'cod_pedido'        =>$codpedido['codpedido'] ,
                                    'cod_tipo_estatus'  =>4,
                                    'cod_usuario'       =>'US001',
                                    'observaciones'     =>null,
                                );

                $this->EstatusDAL->NewEstatus($estatus);
            }

        }
        
       /* $params = $request->only('rol');

        $reglas = Validator::make($request->all(),
            [
                'cod_estatus' => 'string'
            ]);

        if ($reglas->fails()) {
            // CODE_002: LOS PARAMETROS INGRESADOS NO SON CORRECTOS (y muestra ademas los errores de la validación)
            $this->setMensaje("CODE_002");
            $this->EntityResponse->entidadRespuesta = $reglas->errors();
        } else {

            $result = $this->EstatusDAL->getEstatus($params['rol']);

            if (count($result) > 0) {
                $this->setMensaje("COD_000");
                $this->EntityResponse->entidadRespuesta = $result;
            } else {
                $this->EntityResponse->entidadRespuesta = 'NO HAY ESTATUS PARA MOSTRAR';
            }
        }

        return response()->json($this->EntityResponse);*/
    }
}